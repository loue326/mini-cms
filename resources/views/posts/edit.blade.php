<x-layout>
    <x-slot:title>Modifier {{ $post->title }} - Mini-CMS</x-slot:title>

    <x-page-header title="Modifier l'article" subtitle="Mettez à jour ses informations." />

    @if ($errors->any())
        <x-alert type="error" title="Le formulaire contient des erreurs">
            Corrigez les champs signalés, puis envoyez à nouveau.
        </x-alert>
    @endif

    <form class="post-form" method="POST" action="{{ route('posts.update', $post) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Titre</label>
            <input class="form-control" type="text" id="title" name="title" value="{{ old('title', $post->title) }}">
            @error('title')<p class="field-error">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
            <label for="slug">Slug (minuscules, chiffres et tirets)</label>
            <input class="form-control" type="text" id="slug" name="slug" value="{{ old('slug', $post->slug) }}">
            @error('slug')<p class="field-error">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
            <label for="excerpt">Résumé (facultatif)</label>
            <textarea class="form-control" id="excerpt" name="excerpt" maxlength="255" rows="3">{{ old('excerpt', $post->excerpt) }}</textarea>
            @error('excerpt')<p class="field-error">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
            <label for="body">Contenu</label>
            <textarea class="form-control" id="body" name="body" rows="8">{{ old('body', $post->body) }}</textarea>
            @error('body')<p class="field-error">{{ $message }}</p>@enderror
        </div>

        <div class="form-checkbox">
            <input type="checkbox" id="is_published" name="is_published" value="1" @checked(old('is_published', $post->is_published))>
            <label for="is_published">Article publié</label>
        </div>

        <div class="form-actions">
            <button class="button-primary" type="submit">Modifier l'article</button>
            <a class="cancel-link" href="{{ route('posts.show', $post) }}">Annuler</a>
        </div>
    </form>
</x-layout>