<?php
/**
 * Description of ArticlesService.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Articles;


use App\Services\Articles\Repositories\ArticleRepository;
use Illuminate\Support\Collection;

class ArticlesService
{

    private ArticleRepository $articleRepository;

    public function __construct(
        ArticleRepository $articleRepository
    )
    {
        $this->articleRepository = $articleRepository;
    }

    public function search(string $search, int $limit, int $offset = 0): Collection
    {
        return $this->articleRepository->search($search, $limit, $offset);
    }

    public function addToSearch(string $search, int $limit, int $offset = 0): Collection
    {
        return $this->articleRepository->search($search, $limit, $offset);
    }

}
