## Authentification

Laravel propose son propre système d’authentification.

Rendez-vous sur le site <a href="https://laravel.sillo.org/cours-laravel-8-la-securite-lauthentification/" target="_blank">Cours Laravel 8 – la sécurité – l’authentification</a> et suivre la procédure. Nous utilisons Jetstream.
Attention, nous demandons un petite modification :  l'utilisateur aura un email, un password et un login (non un nom).

**Pour rappel, l'ordre des migrations est important**. L'utilisateur a un rôle donc pour créer la table `user`vous devez avoir au préalable avoir créé la table `role`.

Commande pour lister les routes
```
php artisan route:list
```

Pour ne pas avoir à relancer la génération des js et css à chaque fois, il est possible de faire :
```
npm run watch
```

- Attention, dans `guest.blade.php` et `app.blade.php`, remplacez `mix('css/app.css')` par `asset(mix('css/app.css'))` et `mix('js/app.js')` par `asset(mix('js/app.js'))`