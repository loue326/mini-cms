<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            TagSeeder::class,
        ]);

        $users = collect([
            User::factory()->create(['name' => 'Nadia Ben Salem', 'email' => 'nadia@example.com']),
            User::factory()->create(['name' => 'Amine Trabelsi', 'email' => 'amine@example.com']),
            User::factory()->create(['name' => 'Salma Gharbi', 'email' => 'salma@example.com']),
        ]);

        $categories = Category::query()
            ->whereIn('slug', ['laravel', 'php', 'bases-de-donnaes', 'front-end'])
            ->get()
            ->keyBy('slug');
        $tags = Tag::query()
            ->whereIn('slug', ['dabutant', 'astuce', 'sacurita', 'performance', 'tests', 'blade'])
            ->get()
            ->keyBy('slug');

        $articles = [
            [
                'title' => 'Introduction à Laravel',
                'slug' => 'introduction-a-laravel',
                'excerpt' => 'Découvrez la structure de Laravel et les outils qui accélèrent le développement web.',
                'body' => 'Laravel est un framework PHP qui organise une application autour de routes, de contrôleurs, de modèles et de vues. Cette structure permet de séparer les responsabilités et de faire évoluer le projet sans mélanger l’accès aux données et l’affichage. Pour commencer, suivez une requête depuis son URL jusqu’à la réponse rendue par Blade.',
                'category' => 'laravel',
                'tags' => ['dabutant', 'astuce'],
            ],
            [
                'title' => 'Comprendre les relations entre les modèles Eloquent',
                'slug' => 'relations-entre-modeles-eloquent',
                'excerpt' => 'Les relations Eloquent décrivent les liens entre utilisateurs, articles, catégories et tags.',
                'body' => 'Eloquent représente chaque table par un modèle et permet de décrire ses associations avec des méthodes. Une relation hasMany convient à une catégorie qui regroupe plusieurs articles, tandis qu’une relation belongsToMany relie les articles et les tags par une table pivot. Des relations explicites rendent les requêtes plus lisibles et facilitent le chargement des données associées.',
                'category' => 'laravel',
                'tags' => ['dabutant', 'tests'],
            ],
            [
                'title' => 'Créer des pages réutilisables avec les composants Blade',
                'slug' => 'composants-blade-reutilisables',
                'excerpt' => 'Les composants Blade évitent de répéter les mêmes cartes et formulaires dans les vues.',
                'body' => 'Blade permet de découper une interface en éléments réutilisables. Un composant peut recevoir un article, afficher son titre, son auteur et ses tags, puis être appelé depuis plusieurs pages. Cette organisation réduit les duplications et garde les vues principales faciles à parcourir.',
                'category' => 'php',
                'tags' => ['blade', 'astuce'],
            ],
            [
                'title' => 'Comprendre les bases des bases de données relationnelles',
                'slug' => 'bases-des-bases-de-donnees',
                'excerpt' => 'Tables, clés étrangères et contraintes assurent des données organisées et cohérentes.',
                'body' => 'Une base relationnelle répartit les informations dans des tables reliées par des clés. Les clés étrangères garantissent qu’un article ne référence qu’une catégorie existante, et les tables pivot représentent les associations multiples. Des contraintes adaptées empêchent les incohérences avant même que l’application ne les affiche.',
                'category' => 'bases-de-donnaes',
                'tags' => ['tests', 'performance'],
            ],
            [
                'title' => 'Sécuriser une application web Laravel',
                'slug' => 'securiser-application-web-laravel',
                'excerpt' => 'Validez les entrées et vérifiez les autorisations avant chaque modification.',
                'body' => 'La sécurité commence par la validation de toutes les données reçues et la vérification des droits de la personne connectée. Les protections CSRF, l’échappement des sorties Blade et des règles d’autorisation adaptées réduisent les risques courants. Il faut aussi éviter d’exposer des informations sensibles dans les messages d’erreur.',
                'category' => 'laravel',
                'tags' => ['sacurita', 'dabutant'],
            ],
            [
                'title' => 'Écrire des tests fonctionnels avec Pest',
                'slug' => 'tests-fonctionnels-avec-pest',
                'excerpt' => 'Décrivez les parcours attendus pour repérer rapidement les régressions.',
                'body' => 'Pest propose une syntaxe concise pour vérifier le comportement d’une application Laravel. Un test fonctionnel peut créer des modèles avec les factories, envoyer une requête HTTP et contrôler le contenu de la réponse. Des scénarios ciblés documentent les règles importantes sans dépendre de données préexistantes.',
                'category' => 'php',
                'tags' => ['tests', 'astuce'],
            ],
            [
                'title' => 'Améliorer les performances d’une application',
                'slug' => 'ameliorer-performances-application',
                'excerpt' => 'Le chargement anticipé et les compteurs SQL réduisent les requêtes inutiles.',
                'body' => 'Une page qui parcourt plusieurs articles peut déclencher de nombreuses requêtes si chaque relation est chargée au moment de l’affichage. Eloquent propose le chargement anticipé avec with() et le calcul de compteurs avec withCount(). Ces outils réduisent les lectures répétées et évitent de charger des collections complètes pour afficher un simple total.',
                'category' => 'bases-de-donnaes',
                'tags' => ['performance', 'sacurita'],
            ],
            [
                'title' => 'Gérer les utilisateurs et les autorisations',
                'slug' => 'utilisateurs-et-autorisations',
                'excerpt' => 'Distinguez l’authentification de la décision d’autoriser une action.',
                'body' => 'L’authentification établit l’identité de la personne connectée. L’autorisation détermine ensuite si elle peut consulter ou modifier une ressource. En centralisant ces règles et en les appliquant côté serveur, on protège les données même lorsqu’une personne contourne l’interface du navigateur.',
                'category' => 'laravel',
                'tags' => ['sacurita', 'tests'],
            ],
            [
                'title' => 'Valider les formulaires et afficher les erreurs',
                'slug' => 'validation-formulaires-et-erreurs',
                'excerpt' => 'Une validation claire protège la base et aide la personne à corriger sa saisie.',
                'body' => 'Les règles de validation vérifient les champs avant leur enregistrement : format, longueur, présence ou existence d’une clé étrangère. Après un échec, Laravel redirige vers le formulaire et conserve les anciennes valeurs. La vue peut alors afficher un message près du champ concerné et éviter une nouvelle saisie complète.',
                'category' => 'php',
                'tags' => ['dabutant', 'tests'],
            ],
            [
                'title' => 'Organiser une interface front-end accessible',
                'slug' => 'interface-front-end-accessible',
                'excerpt' => 'Une structure HTML claire améliore la navigation au clavier et avec les lecteurs d’écran.',
                'body' => 'Une interface accessible repose sur des éléments HTML adaptés à leur rôle, des libellés explicites et un ordre de navigation prévisible. Les contrastes lisibles et les états de focus visibles aident toutes les personnes à utiliser le site. Les composants réutilisables permettent d’appliquer ces choix de manière cohérente.',
                'category' => 'front-end',
                'tags' => ['blade', 'astuce'],
            ],
            [
                'title' => 'Créer une navigation par catégorie et par tag',
                'slug' => 'navigation-categories-et-tags',
                'excerpt' => 'Des slugs stables rendent les pages thématiques faciles à partager.',
                'body' => 'Les catégories et les tags permettent de parcourir les articles selon leur sujet. Une route utilisant le slug identifie une ressource sans exposer son identifiant numérique dans l’adresse. Les liens de navigation doivent conserver les mêmes clés étrangères en base et ne changer que la manière de retrouver la ressource.',
                'category' => 'front-end',
                'tags' => ['blade', 'performance'],
            ],
            [
                'title' => 'Publier et maintenir un site de contenu',
                'slug' => 'publier-et-maintenir-site-contenu',
                'excerpt' => 'Un cycle de publication fiable sépare les brouillons du contenu visible.',
                'body' => 'Un site de contenu doit distinguer les brouillons des articles publiés et enregistrer la date de publication. Les filtres côté serveur empêchent les brouillons d’apparaître dans les pages publiques. Des tests réguliers vérifient les parcours de création, de modification et de consultation.',
                'category' => 'bases-de-donnaes',
                'tags' => ['performance', 'sacurita'],
            ],
        ];

        foreach ($articles as $index => $article) {
            $isPublished = $index < 9;

            $post = Post::factory()->create([
                'title' => $article['title'],
                'slug' => $article['slug'],
                'excerpt' => $article['excerpt'],
                'body' => $article['body'],
                'user_id' => $users[$index % 3]->id,
                'category_id' => $categories[$article['category']]->id,
                'is_published' => $isPublished,
                'published_at' => $isPublished ? now() : null,
            ]);

            $post->tags()->sync(array_map(
                fn (string $slug) => $tags[$slug]->id,
                $article['tags'],
            ));
        }
    }
}
