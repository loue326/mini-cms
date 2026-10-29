# Session 08 — Défi

La route `posts.tag` utilise `{tag:slug}` : oui

La page d'un tag n'affiche ni brouillon ni article d'un autre tag : oui

Les tags des cartes sont des liens : oui

L'accueil n'affiche que les tags qui ont au moins un article publié : oui

Les trois nouveaux tests passent et `php artisan test` est vert : oui

Pourquoi filtrer les tags vides après `get()` plutôt que d'afficher (0) ?

Réponse : le filtrage masque les tags sans article publié au lieu d'afficher un compteur égal à zéro.

Combien de requêtes ajoute la liste des tags populaires, et pourquoi pas une par tag ?

Réponse : une requête SQL récupère les tags avec leurs compteurs grâce à `withCount()`. Le compteur est calculé dans cette requête, ce qui évite une requête supplémentaire pour chaque tag.
