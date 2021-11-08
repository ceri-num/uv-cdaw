# Présentation : Framework Laravel

## Framework

- Ensemble d’outils et de librairies
- Existe pour toute sorte de langage (PHP, javascript, …)
- Frameword PHP : Laravel, Symphony, ...
- Ne remplace pas la connaissance d’un langage


## Laravel

- Système de routage
- Moteur de template (Blade)
- Object-Relational Mapping – ORM (Eloquent)
- Système d’authentification et de gestion de sessions pour les connexions
- MVC

![MVC](/ressources/tutoLaravel/MVC.png)
https://www.awesomeinc.org/tutorials/rails-blog/


## Documentation Laravel 
- <a href="https://laravel.com/docs/8.x" target="_blank">https://laravel.com/docs/8.x</a>
- <a href="https://laravel.sillo.org/laravel-8/" target="_blank">https://laravel.sillo.org/laravel-8/</a>


## Composer
- Gestionnaire de dépendances
- Configuration par un fichier JSON
- Déjà installé dans le docker fourni


## Projet Laravel

- Se placer dans le terminal de Visual Studio Code

- Création du projet "catalogue de médias" avec la dernière version stable de Laravel :
```
	composer create-project --prefer-dist laravel/laravel catalogue
```

- Donner les droits à votre projet pour apache:
```
	chown -R root.www-data laravel/
	find laravel -type d -exec chmod 750 {} \;
	find laravel -type f -exec chmod 640 {} \;
	find laravel/storage -type d -exec chmod 770 {} \;
	find laravel/storage -type f -exec chmod 660 {} \;
```

- Vérifier dans le navigateur : 
	http://localhost/catalogue/public

## Principaux dossiers et fichiers
- app : cœur de l’application (controller, model, helper, …) 
- config : les fichiers de configuration
- database : migrations, seeders
- public : images. Seul dossier accessible depuis le serveur
- resources : vues, css / scss et js
- routes : routes de l’application dans web.php
- storage : session, log
- .env : environnement de l’application
- composer.json : dépendances de l’application

![Constitution](/ressources/tutoLaravel/constitution.png)