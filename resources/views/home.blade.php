<x-layout>
    <x-slot:title>Accueil - Mini-CMS</x-slot:title>

    <x-page-header
        title="Bienvenue sur Mini-CMS"
        subtitle="Découvrez les derniers articles publiés."
    />

    <section class="home-section">
        <h2 class="section-title">Derniers articles publiés</h2>

        <div class="cards-grid">
            @forelse ($latestPosts as $post)
                <x-post-card :post="$post" />
            @empty
                <x-alert type="info" title="Aucun article publié">
                    Il n'y a pas encore d'article publié.
                </x-alert>
            @endforelse
        </div>
    </section>
</x-layout>