<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemapPath = public_path('sitemap.xml');

        $sitemap = Cache::remember('sitemap_xml', 86400, static function () use ($sitemapPath) {
            \Spatie\Sitemap\SitemapGenerator::create(config('app.url'))
                ->writeToFile($sitemapPath);

            return file_get_contents($sitemapPath);
        });

        if (! file_exists($sitemapPath)) {
            \Spatie\Sitemap\SitemapGenerator::create(config('app.url'))
                ->writeToFile($sitemapPath);
            $sitemap = file_get_contents($sitemapPath);
        }

        $this->ensureRobotsHasSitemap();

        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }

    private function ensureRobotsHasSitemap(): void
    {
        $robots = public_path('robots.txt');

        if (! file_exists($robots)) {
            file_put_contents($robots, "User-agent: *\nAllow: /\nSitemap: /sitemap.xml");

            return;
        }

        $content = file_get_contents($robots);

        if (strpos($content, 'Sitemap:') === false) {
            file_put_contents($robots, $content . "\nSitemap: /sitemap.xml");
        }
    }
}
