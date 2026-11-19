<x-layout>
    <x-slot:title>Utilisateurs - Mini-CMS</x-slot:title>

    <x-page-header title="Utilisateurs" subtitle="Gérez les rôles des comptes." />

    <div class="table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Rôle</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            @if ($user->is(auth()->user()))
                                <span class="user-name">Vous-même</span>
                            @else
                                <form method="POST" action="{{ route('admin.users.role', $user) }}">
                                    @csrf
                                    @method('PATCH')

                                    <input type="hidden" name="role" value="{{ $user->isAdmin() ? 'author' : 'admin' }}">

                                    <button type="submit" class="button-secondary">
                                        {{ $user->isAdmin() ? 'Retirer admin' : 'Promouvoir admin' }}
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="empty-row" colspan="4">Aucun utilisateur pour l'instant.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>
