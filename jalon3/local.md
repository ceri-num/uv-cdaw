# Passer d'une installation avec Docker sous windows avec wampServer

- Intaller les serveurs Apache / MySQL / Php avec WAMP ou autre (suivant ce que vous avez déjà et votre système d'exploitation).

- Installer composer 
https://getcomposer.org/download/

- Récupérer votre projet GIT et le mettre dans le répertoire www de wamp
- Ouvrir le projet avec Visual Studio Code
- Dans le terminal, faire
```
composer update

php artisan key:generate
```
- Installer npm (voir sur google pour votre système d'exploitation)

- l'url sera désormais : http://localhost/catalogue/public/films

- Attention, dans `guest.blade.php` et `app.blade.php`, remplacez `mix('css/app.css')` par `asset(mix('css/app.css'))` et `mix('js/app.js')` par `asset(mix('js/app.js'))`