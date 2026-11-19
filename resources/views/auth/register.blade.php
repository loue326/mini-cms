<x-layout>
    <x-slot:title>Inscription - Mini-CMS</x-slot:title>

    <x-page-header title="Créer un compte" subtitle="Un compte auteur permet d'écrire et de modifier ses propres articles." />

    @if ($errors->any())
        <x-alert type="error" title="Le formulaire contient des erreurs">
            Corrigez les champs signalés, puis envoyez à nouveau.
        </x-alert>
    @endif

    <form class="post-form auth-form" method="POST" action="{{ route('register.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nom</label>
            <input class="form-control" type="text" id="name" name="name" maxlength="255" value="{{ old('name') }}" autocomplete="name">
            @error('name')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Adresse e-mail</label>
            <input class="form-control" type="email" id="email" name="email" maxlength="255" value="{{ old('email') }}" autocomplete="email">
            @error('email')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Mot de passe (8 caractères au moins)</label>
            <input class="form-control" type="password" id="password" name="password" autocomplete="new-password">
            @error('password')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
        </div>

        <div class="form-actions">
            <button class="button-primary" type="submit">Créer mon compte</button>
            <a class="cancel-link" href="{{ route('login') }}">Se connecter</a>
        </div>
    </form>
</x-layout>
