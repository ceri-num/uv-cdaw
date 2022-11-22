- Installer npm (voir sur google pour votre système d'exploitation).
Pour info, commande pour mettre à jour npm
```
npm install -g npm@8.1.4
```
-
Pour ne pas avoir à relancer la génération des js et css à chaque fois, il est possible de faire :
```
npm run watch
```
- Attention, dans `guest.blade.php` et `app.blade.php`, remplacez `mix('css/app.css')` par `asset(mix('css/app.css'))` et `mix('js/app.js')` par `asset(mix('js/app.js'))`