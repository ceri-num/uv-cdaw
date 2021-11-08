# Découverte : Laravel - Premiers pas

## Fonctionnalités attendues
- compréhension des appels dans le router web.php
- créer une 1ere vue et l'appeler
- créer un controller et l'utiliser
- créer un modèle et l'utiliser


## Les routes

![Routes](/ressources/tutoLaravel/MVC-routes.jpg)

NOTES 
- Fichier routes/web.php (pour les routes appelées depuis un navigateur, api.php pour les routes de l'API)
- Attention, l'ordre dans ce fichier est important ! Les routes sont analysées dans l'ordre et la 1ere trouvée est la 1ere exécutée

TODO
- Trouver l'appel à la vue par défaut de Laravel, le commenter et remplacer par l'affichage d'un « Hello world » de 2 façons
- Options des routes
-- Créer une route GET qui prend 2 paramètres (prénom et nom) et qui les affiche
-- Ajouter des contraintes avec des expressions régulières : créer une route GET qui prend 1 paramètre "title" constitué uniquement de lettres et qui l'affiche
-- Créer une route GET qui affiche le texte "Liste des films" et la nommer "listeFilms"
-- créer une route qui retourne le code HTML suivant :

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

![Vue](/ressources/tutoLaravel/MVC-vues.jpg)

NOTES

- Blade : moteur de template
- Syntaxe simplifiée :
  - `<?php echo $numero ?>` est remplacé par `{{ $numero }}`
  - Les structures de contrôle permettent de ne pas repasser en php: @if, @elseif, @endif, … (<a href="https://walkerspider.com/cours/laravel/blade" target="_blank">https://walkerspider.com/cours/laravel/blade</a>)
  - Extension d’une vue par une autre : `@extend('template.blade.php')`
  - Définir une section du template que pourront utiliser les vues enfants : `@yield('nomDuContenu')`
  - Définir le contenu d'une section du template : `@section('nomDuContenu')`

TODO 

- Intégrer le thème boostrap créé lors des premiers TP (les répertoires assets, css et js) dans le répertoire public.
- Créer le template de base de vos vues `template.blade.php`. Ce template intègrera votre thème (en-tête et pied de page) et une section `content`.
- Créer la vue `listeMedias.blade.php` qui étend le template et qui ajoute le texte de votre choix dans la section `content`.
- Tester le tout : comment tester ? Comment appeler une vue ? (<a href="https://ceri-num.gitbook.io/uv-cdaw/jalon-2/indices.md" target="_blank">Indice 1</a> - <a href="https://ceri-num.gitbook.io/uv-cdaw/jalon-2/reponses.md" target="_blank">réponse 1</a>)


## Les controlleurs

NOTES
Les controlleurs appellent le code "intelligent" pour l'envoyer à la vue. Le retour de la vue est renvoyé au navigateur.

![Vues](/ressources/tutoLaravel/MVC-controllers-vues.jpg)

TODO
- Créer un contrôleur : 
```
php artisan make:controller listeMediasController.php
```
- Appeler la vue depuis le contrôleur (<a href="https://ceri-num.gitbook.io/uv-cdaw/jalon-2/indices.md" target="_blank">Indice 2</a> - <a href="https://ceri-num.gitbook.io/uv-cdaw/jalon-2/reponses.md" target="_blank">réponse 2</a>)
- Relier une route à un contrôleur (<a href="https://ceri-num.gitbook.io/uv-cdaw/jalon-2/indices.md" target="_blank">Indice 3</a> - <a href="https://ceri-num.gitbook.io/uv-cdaw/jalon-2/reponses.md" target="_blank">réponse 3</a>)
- Récupérer des paramètres depuis la route et les passer à la vue (<a href="https://ceri-num.gitbook.io/uv-cdaw/jalon-2/indices.md" target="_blank">Indice 4</a> - <a href="https://ceri-num.gitbook.io/uv-cdaw/jalon-2/reponses.md" target="_blank">réponse 4</a>)
- Afficher ces paramètres (<a href="https://ceri-num.gitbook.io/uv-cdaw/jalon-2/indices.md" target="_blank">Indice 5</a>)


## Les modèles

NOTES
- Les modèles contiennent les algorithmes, l'intelligence du site. Ils peuvent être branchés à des tables de base de données et faciliter leur utilisation.
- Les migrations permettent de créer et mettre à jour la structure des tables.
- Les seeders permettent de remplir les tables (ajout de données).
- Les factories permettent de créer des enregistrements en quantité et d'établir facilement diverses relations entre les tables 

TODO
- Dans phpMyAdmin, créer la base de données `medias` de type `utf8_general_ci`
- Configurer la connexion à la base de données (.env et /config/database.php)  (<a href="https://ceri-num.gitbook.io/uv-cdaw/jalon-2/indices.md" target="_blank">Indice 6</a> - <a href="https://ceri-num.gitbook.io/uv-cdaw/jalon-2/reponses.md" target="_blank">réponse 6</a>)

Partie 1 : la migration
- Télécharger le fichier `2021_10_27_073728_create_categories_table` et le déposer dans le répertoire database/migrations
- Analyser les méthodes up (création) et down (suppression)
- Dans le Terminal, exécuter cette ligne pour créer la table `categories`
```
php artisan migrate
```
Attention, l'ordre d'exécution des migrations est importante (au niveau des clefs étrangères et des contraintes d'intégration). <a href="https://meet.google.com/qgz-rbsb-nce" target="_blank">Aide</a>

Partie 2 : l'alimentation
- Télécharger le fichier `CategorySeeder.php` et le déposer dans le répertoire database/seeders
- Analyser la méthode run (ajout de films). Question : combien de film le seeder va t'il créer ? (<a href="https://ceri-num.gitbook.io/uv-cdaw/jalon-2/reponses.md" target="_blank">réponse 7</a>)
- Dans le Terminal, exécuter cette ligne pour alimenter la table `Categories`
```
php artisan db:seed
```
Partie 3 : le modèle
- Créer le modèle `Categorie` (il est aussi possible de générer le modèle et le controller associé).
```
php artisan make:model category
```
- Préciser la connexion à utiliser, la table reliée à ce modèle, la clef primaire ainsi que les autres paramètres
- Afficher toutes les catégories de la table (<a href="https://laravel.com/docs/8.x/eloquent" target="_blank">site officiel Eloquent</a>, <a href="https://www.oulub.com/fr-FR/Laravel/eloquent" target="_blank">aide FR Eloquent</a>)

Question
Savez-vous ce qu'est l'auto-incrément des clefs primaires ? (<a href="https://ceri-num.gitbook.io/uv-cdaw/jalon-2/reponses.md" target="_blank">Réponse 8</a>)

A vous
- Créer la migration et le seeder pour Film.
Un film est identifié par son `ID`, il a une `category`, un `nom` et un `director`. Attention aux types et taille de chaque champs.(<a href="https://ceri-num.gitbook.io/uv-cdaw/jalon-2/indices.md" target="_blank">Indice 9</a>)
```
php artisan make:migration films_table
ou
php artisan make:migration films_table --create=films
		(Avec l’option create qui crée la table films)

php artisan make:seeder FilmSeeder
```
Avez-vous remarqué la différence entre le nom de la table `films` et le modèle associé `Film` ? Pourquoi ?

## Le tout
- Afficher tous les films avec leur catégorie grâce à une <a href="https://datatables.net/examples/styling/bootstrap5.html" target="_blank">datatable bootstrap</a>. Bien découper Route/Controller/Modèle/Vue.