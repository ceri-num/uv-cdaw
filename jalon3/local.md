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
Pour info, commande pour mettre à jour npm
```
npm install -g npm@8.1.4
```
Pour installer NPM dans docker, ajouter dans .devcontainer/php/Dockerfile
```
RUN apt-get update && apt-get install -y \
    software-properties-common \
    npm
RUN npm install npm@latest -g && \
    npm install n -g && \
    n latest
```
- l'url sera désormais : http://localhost/catalogue/public/films