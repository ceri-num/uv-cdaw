# Découverte : Laravel - Premiers pas

## Fonctionnalités attendues
- compréhension des appels dans le router web.php
- créer une 1ere vue et l'appeler
- créer un controller et l'utiliser
- créer un modèle et l'utiliser

## Les routes

![ Texte alternatif](/ressources/tutoLaravel/MVC-routes.png "Routes")

- Fichier routes/web.php (pour les routes appelées depuis un navigateur, api.php pour les routes de l'API)
- Attention, l'ordre dans ce fichier est important ! Les routes sont analysées dans l'ordre et la 1ere trouvée est la 1ere exécutée
- Trouver l'appel à la vue par défaut de Laravel, le commenter et remplacer par l'affichage d'un « Hello world » de 2 façons
- Options des routes
-- Créer une route GET qui prend 2 paramètres (prénom et nom) et qui les affiche
-- Ajouter des contraintes avec des expressions régulières : créer une route GET qui prend 1 paramètre "title" constitué uniquement de lettres et qui l'affiche
-- Créer une route GET qui affiche le texte "Liste des films" et la nommer "listeFilms"
-- créer une route qui retourne le code HTML suivant :

```
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

![ Texte alternatif](/ressources/tutoLaravel/MVC-vues.png "Vues")

- Blade : moteur de template
- Créer la vue listeMedias.blade.php


<?php echo $numero ?>  {{ $numero }}
@if, @elseif, @endif, … (https://walkerspider.com/cours/laravel/blade)
@extend : extension d’une vue par une autre
@section : permet de définir du contenu 
@yield : section que pourront utiliser les vues enfants
