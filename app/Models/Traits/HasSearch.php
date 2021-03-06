<?php
/**
 * Description of HasSearch.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Models\Traits;


use Illuminate\Database\Eloquent\Model;

/**
 * Trait HasSearch
 * @package App\Models\Traits
 * @mixin Model
 */
trait HasSearch
{
    public function getSearchIndex()
    {
        return $this->getTable();
    }

    public function getSearchType()
    {
        if (property_exists($this, 'useSearchType')) {
            return $this->useSearchType;
        }
        return $this->getTable();
    }

    public function toSearchArray()
    {
        return $this->toArray();
    }
}
