<x-layout>
    <x-slot:title>Nouvel article - Mini-CMS</x-slot:title>

    <x-page-header title="Nouvel article" subtitle="Chaque champ est vérifié par le serveur." />

    @if ($errors->any())
        <x-alert type="error" title="Le formulaire contient des erreurs">
            Corrigez les champs signalés, puis envoyez à nouveau.
        </x-alert>
    @endif

    <form class="post-form" method="POST" action="{{ route('posts.store') }}">
        @csrf

        <div class="form-group">
            <label for="title">Titre</label>
            <input class="form-control" type="text" id="title" name="title" value="{{ old('title') }}">
            @error('title')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="slug">Slug (minuscules, chiffres et tirets)</label>
            <input class="form-control" type="text" id="slug" name="slug" value="{{ old('slug') }}">
            @error('slug')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="excerpt">Extrait (facultatif, 255 caractères au plus)</label>
            <input class="form-control" type="text" id="excerpt" name="excerpt" maxlength="255" value="{{ old('excerpt') }}">
            @error('excerpt')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="body">Contenu</label>
            <textarea class="form-control" id="body" name="body" rows="8">{{ old('body') }}</textarea>
            @error('body')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-checkbox">
            <input type="checkbox" id="is_published" name="is_published" value="1" @checked(old('is_published'))>
            <label for="is_published">Publier immédiatement</label>
        </div>

        <div class="form-actions">
            <button class="button-primary" type="submit">Enregistrer</button>
            <a class="cancel-link" href="{{ route('posts.index') }}">Annuler</a>
        </div>
    </form>
</x-layout>