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

    <p class="text-xs text-gray-500">
        {{ $post->category?->name ?? 'Sans catégorie' }}
        - par {{ $post->user?->name ?? 'auteur inconnu' }}
    </p>

    <p class="post-excerpt">{{ $post->excerpt ?: Str::limit($post->body, 120) }}</p>

    @if ($post->tags->isNotEmpty())
        <ul class="flex flex-wrap gap-2" aria-label="Tags de l'article">
            @foreach ($post->tags as $tag)
                <li class="rounded-full bg-indigo-50 px-2 py-0.5 text-xs font-medium text-indigo-700">
                    {{ $tag->name }}
                </li>
            @endforeach
        </ul>
    @endif

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
