## Authentification

Laravel propose son propre système d’authentification.

Rendez-vous sur le <a href="https://laravel.com/docs/10.x/authentication" target="_blank">site officiel de Laravel</a> ou sur <a href="https://laravel.sillo.org/cours-laravel-10-la-securite-lauthentification/" target="_blank">Cours Laravel 9 – la sécurité – l’authentification</a> et suivre la procédure. Nous utilisons Jetstream mais nous n'utilisons pas npm (génération de fichiers css et js opotimisés).
Attention, nous demandons une petite modification :  l'utilisateur aura un email, un password, un login et un pseudo.

Commande pour lister les routes
```
php artisan route:list
```
### Fonctionnalités attendues

- Faire des routes publiques / routes protégées
- Création de compte
- Connexion via un login / mot de passe
- Voir/modifier son profil (dont MàJ de l'avatar)
- Déconnexion