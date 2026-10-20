@props(['post' => null])

<form class="post-form" method="POST" action="{{ $post ? route('posts.update', $post) : route('posts.store') }}">
    @csrf

    @if ($post)
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="title">Titre</label>
        <input class="form-control" type="text" id="title" name="title" maxlength="255" value="{{ old('title', $post?->title) }}">
        @error('title')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="slug">Slug (minuscules, chiffres et tirets)</label>
        <input class="form-control" type="text" id="slug" name="slug" maxlength="255" value="{{ old('slug', $post?->slug) }}">
        @error('slug')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="excerpt">Extrait (facultatif, 255 caractères au plus)</label>
        <input class="form-control" type="text" id="excerpt" name="excerpt" maxlength="255" value="{{ old('excerpt', $post?->excerpt) }}">
        @error('excerpt')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="body">Contenu</label>
        <textarea class="form-control" id="body" name="body" rows="8">{{ old('body', $post?->body) }}</textarea>
        @error('body')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-checkbox">
        <input type="hidden" name="is_published" value="0">
        <input type="checkbox" id="is_published" name="is_published" value="1" @checked(old('is_published', $post?->is_published))>
        <label for="is_published">Publié</label>
    </div>

    <div class="form-actions">
        <button class="button-primary" type="submit">{{ $post ? 'Mettre à jour' : 'Enregistrer' }}</button>
        <a class="cancel-link" href="{{ $post ? route('posts.show', $post) : route('posts.index') }}">Annuler</a>
    </div>
</form>