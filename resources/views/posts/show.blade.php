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