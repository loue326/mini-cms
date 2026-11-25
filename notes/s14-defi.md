# Session 14 - Défi

Connexion enregistre le jeton toute seule : oui
Créer un article répond 201 sans copier le jeton : oui
Le fichier exporté ne contient aucun jeton : oui

Le dépôt est public. Que risquez-vous si le fichier exporté contient un jeton, et comment l'annuler ?
N'importe qui peut lire le fichier et rejouer les requêtes avec ce jeton : les écritures
passent alors pour les miennes, et Sanctum ne fait pas expirer un jeton tout seul.
L'annulation se fait en révoquant le jeton : `POST /api/logout` avec le jeton concerné,
ou en supprimant sa ligne dans `personal_access_tokens` (Tinker, ou la page des jetons
du profil). Ensuite, on retire le jeton du fichier, on réexporte avec la variable `token`
vide et on change le mot de passe si nécessaire : les anciens jetons restent valables
jusqu'à leur révocation.

Pourquoi les écritures de l'API passent-elles par les Form Requests et PostPolicy plutôt que par des règles écrites dans Api\PostController ?
Parce que les règles et les autorisations doivent être écrites une seule fois : le site et
l'API partagent les mêmes `StorePostRequest`, `UpdatePostRequest` et `PostPolicy`. Si une
règle change (un champ obligatoire, un auteur qui ne peut modifier que ses articles), elle
change partout à la fois et les tests couvrent les deux portes. Le contrôleur d'API reste
mince : il publie, enregistre et renvoie la Resource, sans dupliquer la validation.
