<?php

namespace App\Models;

use App\Models\Traits\HasSearch;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    use HasSearch;

    protected $casts = [
        'tags' => 'json',
    ];

    public function toSearchArray()
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'tags' => $this->tags,
        ];
    }
}
