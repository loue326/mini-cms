<x-layout>
    <x-slot:title>Accueil - Mini-CMS</x-slot:title>

    <x-page-header
        title="Bienvenue sur Mini-CMS"
        subtitle="Découvrez les derniers articles publiés."
    />

    <h2 class="section-title">Parcourir par catégorie</h2>

    <ul aria-label="Catégories">
        @foreach ($categories as $category)
            <li>
                <a href="{{ route('posts.category', $category) }}">
                    {{ $category->name }} ({{ $category->posts_count }})
                </a>
            </li>
        @endforeach
    </ul>

    @if ($tags->isNotEmpty())
        <section class="home-section">
            <h2 class="section-title">Tags populaires</h2>

            <ul class="home-tag-list" aria-label="Tags populaires">
                @foreach ($tags as $tag)
                    <li>
                        <a href="{{ route('posts.tag', $tag->slug) }}">
                            {{ $tag->name }} ({{ $tag->published_posts_count }})
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif

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
