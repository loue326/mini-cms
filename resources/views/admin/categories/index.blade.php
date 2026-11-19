<x-layout>
    <x-slot:title>Catégories - Mini-CMS</x-slot:title>

    <x-page-header title="Catégories" subtitle="Organisez les articles par catégorie." />

    <div class="admin-toolbar">
        <a class="button-link" href="{{ route('admin.categories.create') }}">Nouvelle catégorie</a>
    </div>

    <div class="table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Articles</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->posts_count }}</td>
                        <td>
                            <div class="admin-actions">
                                <a class="button-secondary" href="{{ route('admin.categories.edit', $category) }}">Modifier</a>

                                <details class="delete-details">
                                    <summary class="delete-summary">Supprimer</summary>

                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="delete-form">
                                        @csrf
                                        @method('DELETE')

                                        <p class="delete-warning">Supprimer cette catégorie ? Ses articles resteront sans catégorie.</p>
                                        <button class="delete-button" type="submit">Confirmer la suppression</button>
                                    </form>
                                </details>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="empty-row" colspan="4">Aucune catégorie pour l'instant.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>
