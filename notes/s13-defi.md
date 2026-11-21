# Session 13 - Défi

/api/posts/9 affiche tags avec des noms : oui
/api/posts ne contient aucun body, /api/posts/9 en contient un : oui
Aucune LazyLoadingViolationException : oui

Pourquoi ne pas envoyer body dans la liste, et qui en profite ?
Le corps d'un article peut être long : l'envoyer dans la liste alourdirait la réponse JSON et ralentirait le chargement pour tous les articles. Seule la page de détail en a besoin. La liste reste légère pour les clients qui affichent uniquement titres, extraits et liens ; le détail, lui, en profite quand le contenu complet est demandé.

Un brouillon renvoie 403. Quel avantage aurait un 404 pour un brouillon ?
Un 404 cacherait l'existence même du brouillon : un client ne pourrait pas deviner qu'un article non publié existe à cette adresse. Le 403 confirme au contraire que la ressource existe mais que l'accès est refusé, ce qui est plus précis pour un utilisateur autorisé mais qui tente d'accéder à un brouillon.
