<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    private function posts(): array
    {
        return [
            'decouvrir-laravel-13' => [
                'slug' => 'decouvrir-laravel-13',
                'title' => 'Decouvrir Laravel 13',
                'excerpt' => 'Decouvrez les changements apportes a la structure de Laravel 13.',
                'author' => 'Loue',
                'date' => '2026',
                'year' => 2026,
                'featured' => true,
                'body' => [
                    'Laravel 13 simplifie la structure du projet.',
                    'La configuration des middlewares et des exceptions se fait dans bootstrap/app.php.',
                ],
            ],
            'routes-et-controleurs' => [
                'slug' => 'routes-et-controleurs',
                'title' => 'Routes et controleurs',
                'excerpt' => 'Comprenez comment les routes et les controleurs organisent une application Laravel.',
                'author' => 'Loue',
                'date' => '2026',
                'year' => 2026,
                'featured' => false,
                'body' => [
                    'Une route associe une URL a une methode de controleur.',
                    'Le controleur prepare les donnees, puis la vue les affiche.',
                ],
            ],
            'premiers-pas-avec-blade' => [
                'slug' => 'premiers-pas-avec-blade',
                'title' => 'Premiers pas avec Blade',
                'excerpt' => 'Apprenez les bases du moteur de vues Blade et de son affichage securise.',
                'author' => 'Loue',
                'date' => '2025',
                'year' => 2025,
                'featured' => false,
                'body' => [
                    'Blade est le moteur de vues de Laravel.',
                    'Les doubles accolades echappent le contenu affiche.',
                ],
            ],
        ];
    }

    public function index(): View
    {
        return view('posts.index', [
            'heading' => 'Tous les articles',
            'posts' => $this->posts(),
        ]);
    }

    public function archive(string $year): View
    {
        $posts = array_filter(
            $this->posts(),
            fn (array $post) => $post['year'] === (int) $year
        );

        return view('posts.index', [
            'heading' => 'Articles de '.$year,
            'posts' => $posts,
        ]);
    }

    public function show(string $slug): View
    {
        $posts = $this->posts();

        if (! array_key_exists($slug, $posts)) {
            abort(404);
        }

        return view('posts.show', [
            'post' => $posts[$slug],
        ]);
    }
}
