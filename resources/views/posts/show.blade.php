<x-layout>
    <x-slot:title>{{ $post->title }} - Mini-CMS</x-slot:title>

    <article class="article-detail">
        <a class="back-link" href="{{ route('posts.index') }}">Retour aux articles</a>

        <h1 class="article-title">{{ $post->title }}</h1>

        <p class="article-date">
            @if ($post->published_at)
                Publié le {{ $post->published_at->format('d/m/Y') }}
            @else
                Brouillon
            @endif
        </p>

        <div class="article-body">{{ $post->body }}</div>
    </article>
</x-layout>