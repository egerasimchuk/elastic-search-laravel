<?php
/**
 * Description of ArticlesQueueWorker.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Console\Commands\Articles;


use App\Services\Articles\Repositories\Search\Handlers\ReindexArticleHandler;
use App\Services\Articles\Repositories\Search\Queues\ReindexArticleQueue;
use Illuminate\Console\Command;

class ArticlesQueueWorker extends Command
{

    protected $signature = 'articles:queue:worker';

    private ReindexArticleQueue $reindexArticleQueue;
    private ReindexArticleHandler $reindexArticleHandler;

    public function __construct(
        ReindexArticleQueue $reindexArticleQueue,
        ReindexArticleHandler $reindexArticleHandler
    )
    {
        parent::__construct();

        $this->reindexArticleQueue = $reindexArticleQueue;
        $this->reindexArticleHandler = $reindexArticleHandler;
    }

    public function handle()
    {
        $article = $this->reindexArticleQueue->pop();
        if (!$article) {
            return;
        }
        $this->reindexArticleHandler->handle($article);
    }

}
