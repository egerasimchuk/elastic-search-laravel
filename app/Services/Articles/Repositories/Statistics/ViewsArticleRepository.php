<?php
/**
 * Description of StatisticsArticleRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Articles\Repositories\Statistics;


use App\Models\Article;

interface ViewsArticleRepository
{
    public function getViewsCount(Article $article): int;
    public function incViewsCount(Article $article): void;
}
