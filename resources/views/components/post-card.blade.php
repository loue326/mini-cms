@props(['post'])

<article class="post-card">
    <div class="post-card-heading">
        <h2 class="post-card-title">
            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
        </h2>
        @if (! $post->is_published)
            <span class="draft-badge">Brouillon</span>
        @endif
    </div>

    <p class="post-excerpt">{{ $post->excerpt ?: Str::limit($post->body, 120) }}</p>

    <p class="post-meta">
        @if ($post->published_at)
            Publié le {{ $post->published_at->format('d/m/Y') }} -
            <a href="{{ route('posts.archive', $post->published_at->year) }}">Archive {{ $post->published_at->year }}</a>
        @else
            Non publié
        @endif
    </p>

    <a class="text-link" href="{{ route('posts.show', $post) }}">Lire l'article</a>
</article>