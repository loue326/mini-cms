<x-layout>
    <x-slot:title>Article introuvable - Mini-CMS</x-slot:title>

    <x-page-header title="Article introuvable" subtitle="Cet article n'existe pas ou a été supprimé." />

    <x-alert type="info" title="Que faire ?">
        Vérifiez l'adresse, ou parcourez la liste des articles.
    </x-alert>

    <p>
        <a class="back-link" href="{{ route('posts.index') }}">Voir tous les articles</a>
    </p>

    @if ($recentPosts->isNotEmpty())
        <section class="related-posts">
            <h2>Articles récents</h2>

            <div class="related-posts-grid">
                @foreach ($recentPosts as $recentPost)
                    <x-post-card :post="$recentPost" />
                @endforeach
            </div>
        </section>
    @endif
</x-layout>
