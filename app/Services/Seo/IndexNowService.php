<?php

namespace App\Services\Seo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class IndexNowService
{
    protected string $key;

    protected array $engines = [
        'https://www.bing.com/indexnow',
        'https://yandex.com/indexnow',
        'https://search.seznam.cz/indexnow',
        'https://en.nauver.com/indexnow',
    ];

    protected array $submittedUrls = [];

    public function __construct()
    {
        $this->key = $this->getOrCreateKey();
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getKeyLocation(): string
    {
        return url('/' . $this->key . '.txt');
    }

    protected function getOrCreateKey(): string
    {
        $path = public_path('indexnow-key.txt');

        if (file_exists($path)) {
            return trim(file_get_contents($path));
        }

        $key = Str::uuid()->toString();
        file_put_contents($path, $key);
        file_put_contents(public_path($key . '.txt'), $key);

        return $key;
    }

    public function submit(array $urls, bool $skipCache = false): void
    {
        $urls = array_values(array_filter($urls, function ($url) use ($skipCache) {
            if ($skipCache) {
                return true;
            }

            return ! in_array($url, $this->submittedUrls, true);
        }));

        if (empty($urls)) {
            return;
        }

        $payload = [
            'host'        => parse_url(config('app.url'), PHP_URL_HOST),
            'key'         => $this->key,
            'keyLocation' => $this->getKeyLocation(),
            'urlList'     => $urls,
        ];

        $results = [];

        foreach ($this->engines as $engine) {
            try {
                $response = Http::timeout(10)
                    ->withHeaders(['Content-Type' => 'application/json'])
                    ->post($engine, $payload);

                $code = $response->status();
                $results[$engine] = $code;

                if ($code === 200 || $code === 202) {
                    Log::info("IndexNow: submitted to $engine", ['urls' => $urls]);
                }
            } catch (\Throwable $e) {
                $results[$engine] = $e->getMessage();
                Log::warning("IndexNow: failed to submit to $engine: " . $e->getMessage());
            }
        }

        if ($results) {
            Log::info('IndexNow: submission results', $results);
        }

        $this->submittedUrls = array_merge($this->submittedUrls, $urls);
    }

    public function submitUrl(string $url, bool $skipCache = false): void
    {
        $this->submit([$url], $skipCache);
    }

    public function submitBlogs(): void
    {
        $posts = \App\Models\Blog::where('status', 1)
            ->whereNotNull('created_at')
            ->orderBy('created_at', 'desc')
            ->limit(100)
            ->get();

        if ($posts->isEmpty()) {
            return;
        }

        $urls = $posts->map(fn ($post) => url('blog/' . $post->slug))->toArray();

        $this->submit($urls);
    }

    public function submitSitemap(): void
    {
        $sitemapUrl = url('sitemap.xml');
        $this->submit([$sitemapUrl]);
    }

    public function getKeyFilePath(): string
    {
        return public_path('indexnow-key.txt');
    }
}
