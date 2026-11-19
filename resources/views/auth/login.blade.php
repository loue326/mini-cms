<x-layout>
    <x-slot:title>Connexion - Mini-CMS</x-slot:title>

    <x-page-header title="Connexion" subtitle="Connectez-vous pour écrire et modifier vos articles." />

    @if ($errors->any())
        <x-alert type="error" title="Le formulaire contient des erreurs">
            Corrigez les champs signalés, puis envoyez à nouveau.
        </x-alert>
    @endif

    <form class="post-form auth-form" method="POST" action="{{ route('login.store') }}">
        @csrf

        <div class="form-group">
            <label for="email">Adresse e-mail</label>
            <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="email">
            @error('email')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input class="form-control" type="password" id="password" name="password" autocomplete="current-password">
            @error('password')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-actions">
            <button class="button-primary" type="submit">Se connecter</button>
        </div>

        <p class="auth-switch">
            Pas encore de compte ?
            <a class="text-link" href="{{ route('register') }}">Créer un compte</a>
        </p>
    </form>
</x-layout>
