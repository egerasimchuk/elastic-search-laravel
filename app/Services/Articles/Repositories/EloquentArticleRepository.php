<?php
/**
 * Description of EloquentArticleRepositoey.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Articles\Repositories;


use App\Models\Article;
use Illuminate\Support\Collection;

class EloquentArticleRepository implements ArticleRepository
{

    public function search(string $search, int $limit, int $offset = 0): Collection
    {
        $qb = Article::query();
        if ($search) {
            $qb->where('body', 'like', "%{$search}%");
            $qb->orWhere('title', 'like', "%{$search}%");
        }
        $qb->take($limit);
        $qb->skip($offset);

        return $qb->get();
    }
}
