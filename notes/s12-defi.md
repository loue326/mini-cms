# Session 12 - Défi

1. Pourquoi role n'est-il pas dans #[Fillable], et comment votre contrôleur le modifie-t-il quand même ?

`role` reste hors de `#[Fillable]` pour rester protégé contre l'affectation de masse : le contrôleur d'inscription ne passe que `name`, `email` et `password` à `create()`, mais si un jour un contrôleur passe `$request->all()` ou si une règle `role` apparaît dans une Form Request, le champ ne peut pas être modifié par l'utilisateur. Le contrôleur du niveau 1 l'affecte explicitement, avec une valeur validée (`Rule::in(['author', 'admin'])`), après l'autorisation via `UserPolicy::changeRole`, puis appelle `save()` : `$user->role = $request->validated()['role']; $user->save();`.

2. Pourquoi le callback de Gate::before doit-il renvoyer null, et non false, pour un auteur ?

`false` est une réponse définitive : Laravel refuserait alors tout à un auteur, même modifier ses propres articles. `null` signifie « pas d'avis » : Laravel continue et demande au Gate ou à la méthode de la Policy concernés de trancher. Le callback exclut aussi la capacité `changeRole` : sinon un administrateur contournerait la règle qui l'empêche de changer son propre rôle.
