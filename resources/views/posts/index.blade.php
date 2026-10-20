<x-layout>
    <x-slot:title>{{ $heading }} - Mini-CMS</x-slot:title>

    <x-page-header :title="$heading" />

    <a class="button-link" href="{{ route('posts.create') }}">Nouvel article</a>

    <div class="cards-grid">
        @forelse ($posts as $post)
            <x-post-card :post="$post" />
        @empty
            <x-alert type="warning" title="Aucun article">
                Il n'y a pas encore d'article.
            </x-alert>
        @endforelse
    </div>

    <div class="pagination-wrap">
        {{ $posts->links() }}
    </div>
</x-layout>