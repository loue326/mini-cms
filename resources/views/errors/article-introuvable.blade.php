<x-layout>
    <x-slot:title>Article introuvable - Mini-CMS</x-slot:title>

    <x-page-header title="Article introuvable" subtitle="Cet article n'existe pas ou a été supprimé." />

    <x-alert type="info" title="Que faire ?" class="max-w-2xl">
        Vérifiez l'adresse, ou parcourez la liste des articles.
    </x-alert>

    <p class="mt-6">
        <a href="{{ route('posts.index') }}" class="font-medium text-indigo-600 hover:underline">Voir tous les articles</a>
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
