<x-layout>
    <x-slot:title>Tags - Mini-CMS</x-slot:title>

    <x-page-header title="Tags" subtitle="Associez des mots-clés aux articles." />

    <div class="admin-toolbar">
        <a class="button-link" href="{{ route('admin.tags.create') }}">Nouveau tag</a>
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
                @forelse ($tags as $tag)
                    <tr>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->slug }}</td>
                        <td>{{ $tag->posts_count }}</td>
                        <td>
                            <div class="admin-actions">
                                <a class="button-secondary" href="{{ route('admin.tags.edit', $tag) }}">Modifier</a>

                                <details class="delete-details">
                                    <summary class="delete-summary">Supprimer</summary>

                                    <form method="POST" action="{{ route('admin.tags.destroy', $tag) }}" class="delete-form">
                                        @csrf
                                        @method('DELETE')

                                        <p class="delete-warning">Supprimer ce tag ? Ses articles resteront sans ce tag.</p>
                                        <button class="delete-button" type="submit">Confirmer la suppression</button>
                                    </form>
                                </details>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="empty-row" colspan="4">Aucun tag pour l'instant.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>
