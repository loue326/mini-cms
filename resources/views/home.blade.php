<x-layout>
    <x-slot:title>Accueil - Mini-CMS</x-slot:title>

    <x-page-header
        title="Bienvenue sur Mini-CMS"
        subtitle="Découvrez les derniers articles publiés."
    />

    <h2 class="text-2xl font-bold mb-4">Parcourir par catégorie</h2>

    <ul class="mb-10 flex flex-wrap gap-3" aria-label="Catégories">
        @foreach ($categories as $category)
            <li>
                <a
                    href="{{ route('posts.category', $category) }}"
                    class="inline-block rounded-md border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 hover:border-indigo-600 hover:text-indigo-600"
                >
                    {{ $category->name }} ({{ $category->posts_count }})
                </a>
            </li>
        @endforeach
    </ul>

    <section class="home-section home-posts">
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
