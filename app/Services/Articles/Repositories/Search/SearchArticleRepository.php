<?php
/**
 * Description of ArticleRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Articles\Repositories\Search;


use Illuminate\Support\Collection;

interface SearchArticleRepository
{

    public function search(string $search, int $limit, int $offset = 0): Collection;

}
