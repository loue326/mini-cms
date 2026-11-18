<x-layout>
    <x-slot:title>Catégorie introuvable - Mini-CMS</x-slot:title>

    <x-page-header title="Catégorie introuvable" subtitle="Cette catégorie n'existe pas ou a été supprimée." />

    <x-alert type="info" title="Que faire ?" class="max-w-2xl">
        Vérifiez l'adresse, ou parcourez les catégories existantes.
    </x-alert>

    <p class="mt-6">
        <a href="{{ route('posts.index') }}" class="font-medium text-indigo-600 hover:underline">Voir tous les articles</a>
    </p>

    @if ($categories->isNotEmpty())
        <section class="related-posts">
            <h2>Catégories existantes</h2>

            <ul class="mt-4 space-y-2">
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('posts.category', $category) }}" class="font-medium text-indigo-600 hover:underline">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif
</x-layout>
