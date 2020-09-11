<?php
/**
 * Description of ArticleFactory.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */
/* @var $factory \Illuminate\Database\Eloquent\Factory */
use App\Models\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    $tags = collect(['php', 'ruby', 'java', 'javascript', 'bash', 'node', 'go', 'python'])
        ->random(2)
        ->values()
        ->all();

    return [
        'title' => $faker->sentence(),
        'body' => $faker->text(),
        'tags' => $tags,
        'views' => rand(0, 500),
    ];
});
