<?php

namespace App\Providers;

use App\Services\Articles\Repositories\ArticleRepository;
use App\Services\Articles\Repositories\ElasticsearchArticleRepository;
use App\Services\Articles\Repositories\EloquentArticleRepository;
use Elasticsearch\Client as ElasticsearchClient;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ArticleRepository::class,
            ElasticsearchArticleRepository::class
        );
        $this->bindSearchClient();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    private function bindSearchClient()
    {
        $this->app->bind(ElasticsearchClient::class, function () {
            return ClientBuilder::create()
                ->setHosts(config('services.search.hosts'))
                ->build();
        });
    }
}
