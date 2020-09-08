<?php
/**
 * Description of ArticlesService.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Articles;


use App\Models\Article;
use App\Services\Articles\Handlers\ViewHandler;
use App\Services\Articles\Repositories\Search\SearchArticleRepository;
use App\Services\Articles\Repositories\Statistics\ViewsArticleRepository;
use Illuminate\Support\Collection;

class ArticlesService
{

    private SearchArticleRepository $articleRepository;
    private ViewHandler $viewHandler;
    private ViewsArticleRepository $viewsArticleRepository;

    public function __construct(
        SearchArticleRepository $articleRepository,
        ViewsArticleRepository $viewsArticleRepository,
        ViewHandler $viewHandler
    )
    {
        $this->articleRepository = $articleRepository;
        $this->viewHandler = $viewHandler;
        $this->viewsArticleRepository = $viewsArticleRepository;
    }

    public function search(string $search, int $limit, int $offset = 0): Collection
    {
        return $this->articleRepository->search($search, $limit, $offset);
    }

    public function viewArticle(Article $article)
    {
        $this->viewHandler->handle($article);
    }

    public function findArticleViews(Article $article): int
    {
        return $this->viewsArticleRepository->getViewsCount($article);
    }

}
