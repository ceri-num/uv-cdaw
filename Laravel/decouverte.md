# Découverte : Laravel - Premiers pas

## Objectifs
- Comprendre les appels dans le router web.php
- Créer une 1ere vue et l'appeler
- Créer un controller et l'utiliser
- Créer un modèle et l'utiliser


## Les routes

![Routes](/ressources/tutoLaravel/MVC-routes.JPG)

NOTES
- Fichier routes/web.php (pour les routes appelées depuis un navigateur, api.php pour les routes de l'API)
- Attention, l'ordre dans ce fichier est important ! Les routes sont analysées dans l'ordre et la 1ere trouvée est la 1ere exécutée
- Appel d'une route : http://localhost:8000/leNomDeMaRoute ou http://localhost:8000/ pour accéder à la route '/'

TODO
- Trouver l'appel à la vue par défaut de Laravel, le commenter et remplacer par l'affichage d'un « Hello world » de 2 façons différentes
- Options des routes
  - Créer une route GET qui prend 2 paramètres (prénom et nom) et qui les affiche
  - Ajouter des contraintes avec des expressions régulières : créer une route GET qui prend 1 paramètre "title" constitué uniquement de lettres et qui l'affiche
  - Créer une route GET qui affiche le texte "Liste des joueurs" et la nommer "listeJoueurs"
  - Créer une route qui retourne le code HTML suivant :

``` HTML
<!doctype html>
<html lang="fr">
  <head>
      <meta charset="UTF-8">
      <title>Mauvaise façon</title>
  </head>
  <body>
      <p>Le fichier risque d'être longggggg</p>
  </body>
</html>
```

Est-ce une bonne façon de faire ? Pourquoi ?


## Les vues

![Vue](/ressources/tutoLaravel/MVC-vues.JPG)

NOTES

- Blade : moteur de template, permet de créer des pages HTML à partir de simple instructions PHP
- Syntaxe simplifiée :
  - `<?php echo $numero ?>` est remplacé par `{{ $numero }}`
  - Les structures de contrôle permettent de ne pas repasser en php: @if, @elseif, @endif, … (<a href="https://walkerspider.com/cours/laravel/blade" target="_blank">https://walkerspider.com/cours/laravel/blade</a>)
  - Extension d’une vue par une autre : `@extends('template.blade.php')`
  - Définir une section du template que pourront utiliser les vues enfants : `@yield('nomDuContenu')`
  - Définir le contenu d'une section du template : `@section('nomDuContenu')`

TODO

- Créer le template de base de vos vues `template.blade.php`. Ce template intègrera votre thème (en-tête et pied de page) et une section `content`.
- Créer la vue `accueil.blade.php` qui étend le template et qui ajoute le texte de votre choix dans la section `content`.
- Tester le tout : comment tester ? Comment appeler une vue ? [indice1](../ressources/tutoLaravel/indices.md) [Réponse1](../ressources/tutoLaravel/reponses.md)

## Les controlleurs

NOTES
Les controlleurs appellent le code "intelligent" des modèles pour ensuite l'envoyer à la vue. Le retour de la vue est renvoyé au navigateur.

![Vues](/ressources/tutoLaravel/MVC-controllers-vues.JPG)

TODO
- Créer un contrôleur :
```
php artisan make:controller accueilController
```
- Appeler la vue depuis le contrôleur. [Indice 2](../ressources/tutoLaravel/indices.md) - [Réponse 2](../ressources/tutoLaravel/reponses.md)
- Relier une route à un contrôleur. [Indice 3](../ressources/tutoLaravel/indices.md) - [Réponse 3](../ressources/tutoLaravel/reponses.md)
- Récupérer des paramètres depuis la route et les passer à la vue [Indice 4](../ressources/tutoLaravel/indices.md) - [Réponse 4](../ressources/tutoLaravel/reponses.md)
- Afficher ces paramètres. [Indice 5](../ressources/tutoLaravel/indices.md) 

## Les modèles

NOTES
- Les modèles contiennent les algorithmes, l'intelligence du site. Ils peuvent être branchés à des tables de base de données et faciliter leur utilisation.
- Les migrations permettent de créer et mettre à jour la structure des tables.
- Les seeders permettent de remplir les tables (ajout de données).
- Les factories permettent de créer des enregistrements en quantité et d'établir facilement diverses relations entre les tables

TODO
- Dans phpMyAdmin (connexion en root/root), créer la base de données `adolices` de type `utf8_general_ci`r
- Configurer la connexion à la base de données (.env et /config/database.php)  [Indice 6](../ressources/tutoLaravel/indices.md) - [Réponse 6](../ressources/tutoLaravel/reponses.md)

Partie 1 : la migration
- Télécharger le fichier [2021_10_27_073728_create_boutique_table](../ressources/tutoLaravel/bd/migrations/2024_03_11_073728_create_boutique_table.php) et le déposer dans le répertoire database/migrations de votre projet Laravel
- Analyser les méthodes up (création) et down (suppression)
- Dans le Terminal, exécuter cette ligne pour créer la table `boutique`
```
php artisan migrate
```
Attention, l'ordre d'exécution des migrations est importante (au niveau des clefs étrangères et des contraintes d'intégration).

Partie 2 : l'alimentation
- Télécharger le fichier [BoutiqueSeeder.php](../ressources/tutoLaravel/bd/seeders/BoutiqueSeeder.php) et le déposer dans le répertoire database/seeders
- Analyser la méthode run. Question : combien de boutique le seeder va t'il créer ? [Réponse 7](../ressources/tutoLaravel/reponses.md)
- Dans le Terminal, exécuter cette ligne pour alimenter la table `boutique`
```
php artisan db:seed --class=BoutiqueSeeder
```
Vous avez aussi la possibilité d'ajouter l'appel au BoutiqueSeeder dans la méthode run() de DatabaseSeeder.php et d'exécuter tous les seeders par la commande :
```
php artisan db:seed
```
- L'alimentation en quantité : dans le seeder, remplacer l'étape 1 par l'étape 2.
- Télécharger le fichier [BoutiqueFactory.php](../ressources/tutoLaravel/bd/factories/BoutiqueFactory.php) et le déposer dans le répertoire database/factories
- Vider la table `boutique` et exécuter le seeder.

Partie 3 : le modèle
- Créer le modèle `boutique` (il est aussi possible de générer le modèle et le controller associé).
```
php artisan make:model boutique
```
- Préciser la connexion à utiliser, la table reliée à ce modèle, la clef primaire ainsi que les autres paramètres
- Afficher toutes les boutiques de la table. (<a href="https://laravel.com/docs/10.x/eloquent" target="_blank">site officiel Eloquent</a>, <a href="https://laravel.sillo.org/cours-laravel-10-les-donnees-jouer-avec-eloquent/" target="_blank">aide FR Eloquent</a>, <a href="https://grafikart.fr/tutoriels/orm-eloquent-laravel-2115" target="_blank"> tuto vidéo</a>)

Question
Savez-vous ce qu'est l'auto-incrément des clefs primaires ? [Réponse 8](../ressources/tutoLaravel/reponses.md)

A vous
- Créer la migration pour joueur.
Un joueur est identifié par son `ID`, il a un `pseudo`, un `email`, un `mot de passe` et un `path` (chemin vers l'avatar du joueur). Attention aux types et taille de chaque champs. [Indice 9](../ressources/tutoLaravel/indices.md)
```shell
php artisan make:migration joueur_table
ou
php artisan make:migration joueur_table --create=joueur
		(Avec l’option create qui crée la table joueur)
```
- Remplir la table `joueur` (une cinquantaine) grâce à un seeder ou une factory

## Le tout
- Afficher tous les joueurs grâce à un tableau (on verra les datatables plus tard). Bien découper Route/Controller/Modèle/Vue.

## Debug
Installer <a href="https://github.com/barryvdh/laravel-debugbar" target="_blank">Barryvdh - Laravel Debugbar</a>
``` 
composer require barryvdh/laravel-debugbar
```
Dans le navigateur, une barre apparaît en bas de la fenêtre.