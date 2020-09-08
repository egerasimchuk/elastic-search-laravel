<?php
/**
 * Description of ArticleRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Articles\Repositories;


use App\Models\Article;
use Illuminate\Support\Collection;

interface ArticleRepository
{

    public function getAll(): Collection;

    public function updateViewsCount(Article $article, $viewsCount): void;

    public function update(Article $article, $data): void;

}
