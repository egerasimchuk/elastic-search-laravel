<?php /** @var \App\Models\Article $article */ ?>
<article class="mb-3">
    <h2>{{ $article->title }}</h2>
    <p class="m-0">{{ $article->body }}</body>
    <div>
        @foreach ($article->tags as $tag)
            <span class="badge badge-light">{{ $tag}}</span>
        @endforeach
    </div>
</article>
