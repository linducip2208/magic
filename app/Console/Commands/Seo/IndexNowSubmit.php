<?php

namespace App\Console\Commands\Seo;

use App\Services\Seo\IndexNowService;
use Illuminate\Console\Command;

class IndexNowSubmit extends Command
{
    protected $signature = 'seo:indexnow {--blogs : Submit blog post URLs} {--sitemap : Submit sitemap URL} {--all : Submit both}';

    protected $description = 'Submit URLs to IndexNow search engines (Bing, Yandex, Seznam, Naver)';

    public function handle(IndexNowService $indexNow): int
    {
        $submitBlogs = $this->option('blogs') || $this->option('all');
        $submitSitemap = $this->option('sitemap') || $this->option('all');

        if (! $submitBlogs && ! $submitSitemap) {
            $submitBlogs = true;
            $submitSitemap = true;
        }

        if ($submitBlogs) {
            $this->info('Submitting blog post URLs...');
            $indexNow->submitBlogs();
            $this->info('Done.');
        }

        if ($submitSitemap) {
            $this->info('Submitting sitemap...');
            $indexNow->submitSitemap();
            $this->info('Done.');
        }

        return self::SUCCESS;
    }
}
