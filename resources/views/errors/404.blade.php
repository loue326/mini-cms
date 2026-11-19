<x-layout>
    <x-slot:title>Page introuvable - Mini-CMS</x-slot:title>

    <x-page-header title="Page introuvable" subtitle="L'adresse demandée n'existe pas ou a été déplacée." />

    <x-alert type="info" title="Erreur 404">
        Vérifiez l'adresse, ou repartez de la page d'accueil.
    </x-alert>

    <p>
        <a class="back-link" href="{{ route('home') }}">Retour à l'accueil</a>
    </p>
</x-layout>
