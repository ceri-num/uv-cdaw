# Présentation : Framework Laravel

## Framework

- Ensemble d'outils et de librairies
- Existe pour toute sorte de langage (PHP, javascript, …)
- Framework PHP : Laravel, Symphony, ...
- Ne remplace pas la connaissance d'un langage

![Utilisation framework en 2023](/ressources/tutoLaravel/PHP-framework-popularity.webp)

## Laravel

Les avantages du framework Laravel sont :
- MVC
- Système de routage
- Moteur de template (Blade)
- Object-Relational Mapping – ORM (Eloquent)
- Système d'authentification et de gestion de sessions pour les connexions

![MVC](/ressources/tutoLaravel/MVC.png)
https://www.awesomeinc.org/tutorials/rails-blog/


## Documentation Laravel
- <a href="https://laravel.com/docs/11.x" target="_blank">https://laravel.com/docs/11.x</a>
- <a href="https://laravel.sillo.org/laravel-10/" target="_blank">https://laravel.sillo.org/laravel-11/</a>


## Composer
- Gestionnaire de dépendances
- Configuration par un fichier JSON

## Installation
- Si ce n'est pas encore fait, intaller les serveurs Apache / MySQL / Php avec WAMP ou autre (suivant votre système d'exploitation).

- Installer composer
https://getcomposer.org/download/

- Ouvrir Visual Studio Code

- Dans un terminal, faire 
```
php -v
```
Si la version d'affiche, vous pouvez continuer.


## Projet Laravel

- Créer le projet "ticketToRide" avec la dernière version stable de Laravel :
```
	composer create-project --prefer-dist laravel/laravel ticketToRide
```
- Se déplacer dans le répertoire projet
```
	 cd ticketToRide
```
- Vérifier la version de Laravel
```
php artisan -V
```
- Lancer un serveur web :
```
	 php artisan serve
```
- Vérifier dans le navigateur :
	http://localhost:8000/ticketToRide

## Principaux dossiers et fichiers
- app : cœur de l'application (controller, model, helper, …)
- config : les fichiers de configuration
- database : migrations, seeders
- public : images. Seul dossier accessible depuis le serveur
- resources : vues, css / scss et js
- routes : routes de l'application dans web.php
- storage : session, log
- .env : environnement de l'application
- composer.json : dépendances de l'application

![Constitution](/ressources/tutoLaravel/constitution.png)