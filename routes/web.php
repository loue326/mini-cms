
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bonjour', function () {
    return 'Bonjour MDW3 ! Voici ma première route Laravel 13.';
});

Route::get('/bonjour-court', fn () => 'Même résultat, écrit avec une fonction fléchée.');

Route::get('/bienvenue', function () {
    return view('bienvenue', [
        'etudiant' => 'Loue Bessaadi',
        'groupe' => 'MDW3.3',
        'cours' => 'Atelier Framework Côté Serveur',
    ]);
});

Route::get('/version', function () {
    return 'Laravel ' . app()->version() . ' - PHP ' . PHP_VERSION;
});

Route::get('/heure', function () {
    return view('heure', [
        'heure' => now()->format('H:i'),
        'date' => now()->format('d/m/Y'),
    ]);
});

Route::get('/a-propos', function () {
    return view('a-propos', [
        'auteur' => 'Loue Bessaadi',
        'groupe' => 'MDW3.3',
    ]);
});
Route::get('/a-propos', function () {
    return view('a-propos', [
        'auteur' => 'Prenom Nom',
        'groupe' => 'MDW32',
    ]);
});