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

        @if ($post->excerpt)
            <p class="article-excerpt">{{ $post->excerpt }}</p>
        @endif

        <div class="article-body">{{ $post->body }}</div>

        <div class="form-actions">
            <a class="button-link" href="{{ route('posts.edit', $post) }}">Modifier</a>
        </div>
    </article>
</x-layout>