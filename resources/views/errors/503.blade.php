<x-layout>
    <x-slot:title>Service indisponible - Mini-CMS</x-slot:title>

    <x-page-header title="Service momentanément indisponible" subtitle="Le site ne peut pas traiter cette demande pour le moment." />

    <x-alert type="warning" title="Erreur 503">
        {{ $exception->getMessage() ?: 'Le site est en maintenance. Réessayez dans quelques minutes.' }}
    </x-alert>

    <p>
        <a class="back-link" href="{{ route('home') }}">Retour à l'accueil</a>
    </p>
</x-layout>
