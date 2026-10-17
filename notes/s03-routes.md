# Session 03 - Routes, contrôleurs et layout

## Défi

URL produite par route('about') : /a-propos

URL produite par route('posts.show', 'routes-et-controleurs') : /posts/routes-et-controleurs

URL produite par route('posts.archive', 2025) : /posts/archive/2025

Pourquoi /posts/archive/abc et /posts/article-inconnu répondent toutes deux 404, et quelle ligne de code en est responsable dans chaque cas ?

/posts/archive/abc répond 404 car la route utilise whereNumber('year'), qui accepte uniquement une année numérique.

/posts/article-inconnu répond 404 car le slug n'existe pas dans le tableau des articles. Dans PostController, la condition array_key_exists($slug, $posts) est suivie de abort(404) si l'article n'existe pas.

Que se passe-t-il si une vue appelle route('posts.show') sans paramètre ?

Laravel déclenche une erreur de génération d'URL, car la route posts.show exige le paramètre slug.
