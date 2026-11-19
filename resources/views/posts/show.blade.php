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
            <div class="mt-8 flex flex-wrap items-start gap-4">
                <form method="POST" action="{{ route('posts.publication', $post) }}">
                    @csrf
                    @method('PATCH')

                    <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">{{ $post->is_published ? 'Dépublier' : 'Publier' }}</button>
                </form>

                <a href="{{ route('posts.edit', $post) }}" class="rounded-md border border-indigo-600 px-4 py-2 text-sm font-medium text-indigo-600 hover:bg-indigo-50">Modifier</a>

                @can('delete', $post)
                    <details>
                        <summary class="cursor-pointer rounded-md border border-red-600 px-4 py-2 text-sm font-medium text-red-700 hover:bg-red-50">Supprimer</summary>

                        <form method="POST" action="{{ route('posts.destroy', $post) }}" class="mt-3 rounded-md border border-red-200 bg-red-50 p-4">
                            @csrf
                            @method('DELETE')

                            <p class="mb-3 text-sm text-red-900">Cette action est définitive : l'article sera effacé de la base.</p>
                            <button type="submit" class="rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700">Confirmer la suppression</button>
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
