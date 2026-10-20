# Session 05 - Défi : articles récents sur l'accueil

latestPosts contient au plus 3 articles : oui

Seuls les articles publiés sont transmis à la vue : oui

home.blade.php utilise x-post-card et @forelse : oui

Le nouveau test passe et php artisan test est vert : oui

Pourquoi get() et pas paginate(3) sur la page d'accueil ?

get() récupère les trois articles sélectionnés par la requête Eloquent. paginate(3) sert à afficher les résultats sur plusieurs pages avec des liens de pagination, ce qui n'est pas nécessaire ici.
