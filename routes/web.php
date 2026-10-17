
<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/a-propos', [PageController::class, 'about'])->name('about');

Route::get('/bonjour', function () {
    return 'Bonjour MDW3 ! Voici ma première route Laravel 13.';
});

Route::get('/bonjour-court', fn () => 'Même résultat, écrit avec une fonction fléchée.');

Route::get('/version', function () {
    return 'Laravel '.app()->version().' - PHP '.PHP_VERSION;
});

Route::get('/heure', [PageController::class, 'time'])
    ->name('time');

Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');

    Route::get('/archive/{year}', [PostController::class, 'archive'])
        ->whereNumber('year')
        ->name('archive');

    Route::get('/{slug}', [PostController::class, 'show'])
        ->where('slug', '[a-z0-9-]+')
        ->name('show');
});
