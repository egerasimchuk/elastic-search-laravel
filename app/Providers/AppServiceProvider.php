<?php

namespace App\Providers;

use App\Services\Articles\Repositories\Search\SearchArticleRepository;
use App\Services\Articles\Repositories\Search\ElasticsearchSearchArticleRepository;
use App\Services\Articles\Repositories\Search\EloquentSearchArticleRepository;
use App\Services\Articles\Repositories\Statistics\RedisViewsArticleRepository;
use App\Services\Articles\Repositories\Statistics\ViewsArticleRepository;
use App\Services\Queues\RedisSimpleQueue;
use App\Services\Queues\SimpleQueue;
use Elasticsearch\Client as ElasticsearchClient;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public $bindings = [
        ViewsArticleRepository::class => RedisViewsArticleRepository::class,
        SimpleQueue::class => RedisSimpleQueue::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            SearchArticleRepository::class,
            ElasticsearchSearchArticleRepository::class
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
