<x-layout>
    <x-slot:title>{{ $post->title }} - Mini-CMS</x-slot:title>

    <article class="article-detail">
        <a class="back-link" href="{{ route('posts.index') }}">Retour aux articles</a>

        <h1 class="article-title">{{ $post->title }}</h1>

        <p class="article-metadata">
            @if ($post->published_at)
                Publié le {{ $post->published_at->format('d/m/Y') }}
            @else
                Brouillon
            @endif
            - {{ $post->category?->name ?? 'Sans catégorie' }}
            - par {{ $post->user?->name ?? 'auteur inconnu' }}
        </p>

        @if ($post->tags->isNotEmpty())
            <ul class="article-tags" aria-label="Tags de l'article">
                @foreach ($post->tags as $tag)
                    <li class="article-tag">
                        {{ $tag->name }}
                    </li>
                @endforeach
            </ul>
        @endif

        @if ($post->excerpt)
            <p class="article-excerpt">{{ $post->excerpt }}</p>
        @endif

        <div class="article-body">{{ $post->body }}</div>

        @can('update', $post)
            <div class="post-actions">
                <form class="publication-form" method="POST" action="{{ route('posts.publication', $post) }}">
                    @csrf
                    @method('PATCH')

                    <button class="publication-button" type="submit">{{ $post->is_published ? 'Dépublier' : 'Publier' }}</button>
                </form>

                <a class="button-link" href="{{ route('posts.edit', $post) }}">Modifier</a>

                @can('delete', $post)
                    <details class="delete-details">
                        <summary class="delete-summary">Supprimer</summary>

                        <form method="POST" action="{{ route('posts.destroy', $post) }}" class="delete-form">
                            @csrf
                            @method('DELETE')

                            <p class="delete-warning">Cette action est définitive : l'article sera effacé de la base.</p>
                            <button class="delete-button" type="submit">Confirmer la suppression</button>
                        </form>
                    </details>
                @endcan
            </div>
        @endcan
    </article>

    @if ($related->isNotEmpty())
        <section class="related-posts">
            <h2>
                Dans la même catégorie
            </h2>

            <div class="related-posts-grid">
                @foreach ($related as $relatedPost)
                    <x-post-card :post="$relatedPost" />
                @endforeach
            </div>
        </section>
    @endif
</x-layout>
