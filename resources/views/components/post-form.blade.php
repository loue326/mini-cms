@props(['post' => null, 'categories', 'tags'])

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

    <fieldset class="form-group">
        <legend>Tags</legend>
        @foreach ($tags as $tag)
            <div class="form-checkbox">
                <input type="checkbox" id="tag-{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}"
                    @checked(in_array($tag->id, old('tags', $post?->tags->modelKeys() ?? [])))>
                <label for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
            </div>
        @endforeach
        @error('tags')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </fieldset>

    <div class="form-group">
        <label for="category_id">Catégorie</label>
        <select class="form-control" id="category_id" name="category_id">
            <option value="">Aucune catégorie</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $post?->category_id) == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
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
