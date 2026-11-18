# Session 10 - Robustesse

TagAdminTest contient 5 tests verts : oui
/posts/categorie/inconnue affiche Catégorie introuvable avec le statut 404 : oui
php artisan test est vert : oui

1. Pourquoi le message de messages() l'emporte-t-il sur celui de lang/fr/validation.php ?
Parce que Laravel transmet les messages de la FormRequest au validateur : la clé « slug.unique » y est définie pour ce champ et cette règle, et elle remplace le message général du fichier de langue pour cette règle et ce champ.

2. Pourquoi phpunit.xml fixe-t-il APP_LOCALE ?
Pour que les tests s'exécutent toujours en français, quel que soit le .env du poste ou d'un clone propre : les assertions sur les textes français donnent ainsi le même résultat partout.

3. Pourquoi CategoryController n'a-t-il besoin d'aucun try/catch ?
Parce que la liaison de modèle lance une ModelNotFoundException que Laravel convertit en NotFoundHttpException et rend lui-même la page 404 ; le contrôleur n'est jamais exécuté, il n'y a donc rien à intercepter.
