<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\Articles\ArticlesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ArticlesController extends Controller
{

    const ARTICLES_PER_PAGE = 100;

    private ArticlesService $articlesService;

    public function __construct(
        ArticlesService $articlesService
    )
    {
        $this->articlesService = $articlesService;
    }

    public function index(Request $request)
    {
        $search = (string) $request->get('q', '');
        $limit = (int) $request->get('limit', self::ARTICLES_PER_PAGE);
        $offset = (int) $request->get('offset', 0);

        $articles = $this->articlesService->search($search, $limit, $offset);

        View::share([
            'articles' => $articles,
            'search' => $search,
        ]);
        return view('articles.index');
    }

    public function show(Article $article)
    {
        View::share([
            'article' => $article,
        ]);
        return view('articles.show');
    }
}
