<?php
/**
 * Description of ViewHandler.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Articles\Handlers;


use App\Models\Article;
use App\Services\Articles\Repositories\Statistics\ViewsArticleRepository;

class ViewHandler
{

    private ViewsArticleRepository $viewsArticleRepository;

    public function __construct(
        ViewsArticleRepository $viewsArticleRepository
    )
    {
        $this->viewsArticleRepository = $viewsArticleRepository;
    }

    public function handle(Article $article)
    {
        $this->viewsArticleRepository->incViewsCount($article);
    }

}
