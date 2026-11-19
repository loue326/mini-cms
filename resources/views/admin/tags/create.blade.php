<x-layout>
    <x-slot:title>Nouveau tag - Mini-CMS</x-slot:title>

    <x-page-header title="Nouveau tag" subtitle="Le slug sert dans l'adresse de la page publique du tag." />

    @if ($errors->any())
        <x-alert type="error" title="Le formulaire contient des erreurs">
            Corrigez les champs signalés, puis envoyez à nouveau.
        </x-alert>
    @endif

    <form class="post-form admin-form" method="POST" action="{{ route('admin.tags.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nom</label>
            <input class="form-control" type="text" id="name" name="name" maxlength="255" value="{{ old('name') }}">
            @error('name')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input class="form-control" type="text" id="slug" name="slug" maxlength="255" value="{{ old('slug') }}">
            @error('slug')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-actions">
            <button class="button-primary" type="submit">Créer</button>
            <a class="cancel-link" href="{{ route('admin.tags.index') }}">Annuler</a>
        </div>
    </form>
</x-layout>
