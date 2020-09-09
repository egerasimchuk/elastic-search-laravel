<?php
/**
 * Description of ReindexArticleQueue.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Articles\Repositories\Search\Queues;


use App\Models\Article;
use App\Services\Queues\SimpleQueue;

class ReindexArticleQueue
{

    const QUEUE_NAME = 'reindex_articles';

    private SimpleQueue $simpleQueue;

    public function __construct(
        SimpleQueue $simpleQueue
    )
    {
        $this->simpleQueue = $simpleQueue;
    }

    public function addReindexArticleJob(Article $article)
    {
        $this->simpleQueue->push($this->getQueueName(), $article->id);
    }

    public function pop(): ?Article
    {
        $id = $this->simpleQueue->pop($this->getQueueName());
        if (!$id) {
            return null;
        }
        return Article::find($id);
    }

    private function getQueueName()
    {
        return self::QUEUE_NAME;
    }

}
