<?php
/**
 * Description of RedisStatisticArticleRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Articles\Repositories\Statistics;


use App\Models\Article;
use Redis;
use Illuminate\Redis\Connections\Connection;


class RedisViewsArticleRepository implements ViewsArticleRepository
{

    const ARTICLES_VIEW_COUNT_SET_PREFIX = 'articles:views_counts:';

    private Redis $redis;

    public function __construct(
        Connection $redisConnection
    )
    {
        $this->redis = $redisConnection->client();
    }

    public function getViewsCount(Article $article): int
    {
        return $this->redis->get($this->generateKey($article));
    }

    public function incViewsCount(Article $article): void
    {
        $this->redis->incr($this->generateKey($article));
    }

    private function generateKey(Article $article): string
    {
        return self::ARTICLES_VIEW_COUNT_SET_PREFIX . $article->id;
    }

}
