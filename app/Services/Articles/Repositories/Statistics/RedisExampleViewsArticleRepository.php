<?php
/**
 * Description of RedisExampleViewsArticleRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Articles\Repositories\Statistics;


use Carbon\Carbon;
use Redis;
use App\Models\Article;
use Illuminate\Redis\Connections\Connection;

class RedisExampleViewsArticleRepository implements ViewsArticleRepository
{

    const ARTICLES_VIEWS_COUNT_KEY = 'ARTICLES_VIEWS_COUNT:';

    private Redis $client;

    public function __construct(
        Connection $connection
    )
    {
        $this->client = $connection->client();
    }

    public function getViewsCount(Article $article): int
    {
        $key = $this->generateKey($article);
        return $this->client->get($key);
    }

    public function incViewsCount(Article $article): void
    {
        $key = $this->generateKey($article);
        $this->client->incr($key);
    }

    private function generateKey(Article $article)
    {
        return self::ARTICLES_VIEWS_COUNT_KEY . $article->id;
    }

}
