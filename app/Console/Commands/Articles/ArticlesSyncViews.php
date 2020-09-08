<?php

namespace App\Console\Commands\Articles;

use App\Models\Article;
use App\Services\Articles\Repositories\Statistics\ViewsArticleRepository;
use Elasticsearch\Client;
use Illuminate\Console\Command;

class ArticlesSyncViews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:views:sync';
    /**
     * @var ViewsArticleRepository
     */
    private ViewsArticleRepository $statisticsArticleRepository;

    public function __construct(
        ViewsArticleRepository $statisticsArticleRepository
    )
    {
        parent::__construct();
        $this->statisticsArticleRepository = $statisticsArticleRepository;
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Indexing all articles. This might take a while...');
        foreach (Article::cursor() as $article)
        {
            $viewsCount = $this->statisticsArticleRepository->getViewsCount($article);
            $article->update([
                'views' => $viewsCount,
            ]);
            $this->output->write('.');
        }
        $this->info('\\nDone!');
    }
}
