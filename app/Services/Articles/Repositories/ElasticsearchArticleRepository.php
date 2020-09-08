<?php
/**
 * Description of ElasticSearchArticleRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Articles\Repositories;

use App\Models\Article;
use Elasticsearch\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ElasticsearchArticleRepository implements ArticleRepository
{
    private Client $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function search(string $search, int $limit, int $offset = 0): Collection
    {
        $items = $this->searchOnElasticsearchTitle($search, $limit, $offset);
        dd($items);
        return $this->buildCollection($items);
    }

    private function searchOnElasticsearchTitle(string $query, int $limit, int $offset): array
    {
        $model = new Article();
        return $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => $this->generateSearchFieldsWithPriority(),
                        'query' => $query,
                    ],
                ],
            ],
            'size' => $limit,
            'from' => $offset,
        ]);
    }

    private function searchOnElasticsearchByBody(string $query, int $limit, int $offset): array
    {
        $model = new Article();
        return $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['title', 'body^5', 'tags'],
                        'query' => $query,
                    ],
                ],
            ],
            'size' => $limit,
            'from' => $offset,
        ]);
    }

    private function buildCollection(array $items): Collection
    {
        $ids = Arr::pluck($items['hits']['hits'], '_id');
        return Article::findMany($ids)
            ->sortBy(function ($article) use ($ids) {
                return array_search($article->getKey(), $ids);
            });
    }
}
