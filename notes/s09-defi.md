# Session 09 - Défi

Le bandeau s'affiche sur toutes les pages quand SITE_READ_ONLY=true : oui
Le bandeau disparaît quand SITE_READ_ONLY=false : oui
La page Article introuvable propose au plus trois articles publiés, sans brouillon : oui
Aucune LazyLoadingViolationException sur /posts/999 : oui
Les deux nouveaux tests passent et php artisan test est vert : oui

Pourquoi le bandeau est-il dans le layout et pas dans chaque vue ?
Parce que le layout entoure toutes les pages, y compris la page d'erreur « Article introuvable » : un seul bloc couvre tout le site et une correction ne se fait qu'à un seul endroit.

Pourquoi le test du bandeau n'a-t-il pas besoin de modifier .env ?
Parce que config(['site.read_only' => true]) ne change la valeur que pour ce test ; phpunit.xml garde SITE_READ_ONLY=false pour tous les autres tests, donc .env n'a pas à être touché.
