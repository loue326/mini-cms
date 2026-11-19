<x-layout>
    <x-slot:title>Catégorie introuvable - Mini-CMS</x-slot:title>

    <x-page-header title="Catégorie introuvable" subtitle="Cette catégorie n'existe pas ou a été supprimée." />

    <x-alert type="info" title="Que faire ?">
        Vérifiez l'adresse, ou parcourez les catégories existantes.
    </x-alert>

    <p>
        <a class="back-link" href="{{ route('posts.index') }}">Voir tous les articles</a>
    </p>

    @if ($categories->isNotEmpty())
        <section class="related-posts">
            <h2>Catégories existantes</h2>

            <ul class="category-list">
                @foreach ($categories as $category)
                    <li>
                        <a class="text-link" href="{{ route('posts.category', $category) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif
</x-layout>
