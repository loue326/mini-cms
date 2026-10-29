<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $examples = [
            [
                'title' => 'Découvrir Laravel et ses principaux outils',
                'excerpt' => 'Laravel fournit une base claire pour construire une application web maintenable.',
                'body' => 'Laravel réunit le routage, les contrôleurs, les modèles et les vues dans une structure cohérente. En suivant le parcours d’une requête, on comprend comment ces outils collaborent pour produire une page fiable.',
            ],
            [
                'title' => 'Comprendre les relations avec Eloquent',
                'excerpt' => 'Les relations Eloquent relient les modèles et simplifient les requêtes associées.',
                'body' => 'Eloquent permet de décrire les liens entre les données avec des méthodes lisibles. Une relation bien définie facilite la récupération des auteurs, des catégories et des tags associés à un article.',
            ],
            [
                'title' => 'Créer une interface avec les composants Blade',
                'excerpt' => 'Les composants Blade rendent les vues plus faciles à réutiliser et à organiser.',
                'body' => 'Blade permet de composer les pages à partir de petits éléments réutilisables. Un composant peut recevoir des données, afficher un formulaire ou présenter une carte d’article sans répéter le même balisage.',
            ],
            [
                'title' => 'Concevoir une base de données cohérente',
                'excerpt' => 'Des tables bien pensées protègent la cohérence des données de l’application.',
                'body' => 'Une base relationnelle organise les informations en tables reliées par des clés. Les contraintes et les index évitent les incohérences et rendent les recherches fréquentes plus efficaces.',
            ],
            [
                'title' => 'Sécuriser les formulaires d’une application web',
                'excerpt' => 'La validation côté serveur protège les données reçues par les formulaires.',
                'body' => 'Chaque donnée envoyée par un navigateur doit être considérée comme non fiable. Laravel permet de vérifier les champs, de contrôler les autorisations et de présenter des erreurs utiles sans enregistrer de valeurs invalides.',
            ],
            [
                'title' => 'Écrire des tests fonctionnels avec Pest',
                'excerpt' => 'Pest aide à décrire clairement les comportements attendus d’une application.',
                'body' => 'Un test fonctionnel envoie une requête à l’application et vérifie la réponse ainsi que les changements en base. Des scénarios courts documentent les parcours importants et détectent les régressions.',
            ],
            [
                'title' => 'Améliorer les performances des pages Laravel',
                'excerpt' => 'Le chargement anticipé des relations réduit les requêtes répétées.',
                'body' => 'Une page qui affiche plusieurs articles peut déclencher une requête pour chaque relation. Le chargement anticipé regroupe ces lectures et le comptage en base évite de charger des collections complètes pour afficher un simple nombre.',
            ],
            [
                'title' => 'Gérer les utilisateurs et leurs autorisations',
                'excerpt' => 'Une gestion claire des rôles limite chaque action aux personnes autorisées.',
                'body' => 'L’authentification identifie la personne connectée, tandis que l’autorisation décide ce qu’elle peut faire. Les règles doivent être vérifiées côté serveur sur chaque action qui modifie une ressource.',
            ],
        ];
        $article = fake()->randomElement($examples);

        return [
            ...$article,
            'slug' => Str::slug($article['title']).'-'.fake()->unique()->numerify('########'),
            'is_published' => $isPublished = fake()->boolean(),
            'published_at' => $isPublished ? fake()->dateTimeThisYear() : null,
        ];
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => true,
            'published_at' => now(),
        ]);
    }
}
