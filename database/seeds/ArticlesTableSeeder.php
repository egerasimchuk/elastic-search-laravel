<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('articles')->truncate();
        factory(\App\Models\Article::class)
            ->times(10000)
            ->create();
    }
}
