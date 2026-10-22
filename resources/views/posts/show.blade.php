<x-layout>
    <x-slot:title>{{ $post->title }} - Mini-CMS</x-slot:title>

    <article class="article-detail">
        <a class="back-link" href="{{ route('posts.index') }}">Retour aux articles</a>

        <h1 class="article-title">{{ $post->title }}</h1>

        <p class="text-sm text-gray-500 mb-4">
            @if ($post->published_at)
                Publié le {{ $post->published_at->format('d/m/Y') }}
            @else
                Brouillon
            @endif
            - {{ $post->category?->name ?? 'Sans catégorie' }}
            - par {{ $post->user?->name ?? 'auteur inconnu' }}
        </p>

        @if ($post->tags->isNotEmpty())
            <ul class="mb-6 flex flex-wrap gap-2" aria-label="Tags de l'article">
                @foreach ($post->tags as $tag)
                    <li class="rounded-full bg-indigo-50 px-2 py-0.5 text-xs font-medium text-indigo-700">
                        {{ $tag->name }}
                    </li>
                @endforeach
            </ul>
        @endif

        @if ($post->excerpt)
            <p class="article-excerpt">{{ $post->excerpt }}</p>
        @endif

        <form class="publication-form" action="{{ route('posts.publication', $post) }}" method="POST">
            @csrf
            @method('PATCH')

            @if ($post->is_published)
                <button class="publication-button" type="submit">Dépublier</button>
            @else
                <button class="publication-button" type="submit">Publier</button>
            @endif
        </form>
        <div class="article-body">{{ $post->body }}</div>

        <div class="post-actions">
            <a class="button-link" href="{{ route('posts.edit', $post) }}">Modifier</a>

            <details class="delete-details">
                <summary class="delete-summary">Supprimer</summary>

                <form method="POST" action="{{ route('posts.destroy', $post) }}" class="delete-form">
                    @csrf
                    @method('DELETE')

                    <p class="delete-warning">
                        Cette action est définitive : l'article sera effacé de la base.
                    </p>

                    <button class="delete-button" type="submit">Confirmer la suppression</button>
                </form>
            </details>
        </div>
    </article>
</x-layout>
