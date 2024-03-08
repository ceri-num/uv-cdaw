# Projet Web Pokemon

Ce document décrit ce qui est attendu pour le projet Web de 2022 du point de vue fonctionnel.

## Aperçu du site

Réaliser un site catalogue de média (films, séries, mangas, ...) avec des fonctionnalités personnalisées : suggestions, suivi, playlists, ...

<!-- ![Aperçu d'un mahjong dans FF XIV](resources/mahjong_ex_1.png) -->

## Description des média

Un média :

  * a un type : film, série, manga, dessin animé, ...
  * une ou plusieurs annotation : suspense, action, enfant, comédie, ...
  * des métadonnées :
    * durée
    * année
    * réalisateur
    * acteurs
    * ...

Construire un jeu de données en utilisant par exemple : <a href="https://www.imdb.com/" target="_blank">https://www.imdb.com/ </a>


## Fonctionnalités à réaliser

* Création d'un compte utilisateur
* Connexion au site
* Un utilisateur connecté peut :
  * mettre à jour son profil (avatar, nom, prénom, pseudo, email)
  * consulter, rechercher et trier les média disponibles
  * marquer un média comme vu
  * attribuer un "j'aime" à média
  * consulter son historique de visonnage par date, annotation, ...

* Un administrateur peut:
  * bloquer un compte utilisateur. L'utilisateur ne pourra plus se connecter mais toutes ses playlists seront conservées.

## Playlists

* Un utilisateur connecté peut :
  * créer une playlist
     * manuelle et y ajouter des médias
     * automatique
       * Exemple : tous les média Marvel
       * Exemple : tous les films dont Clint Eastwood est le réalisateur et l'un des acteurs
  * s'abonner à une playlist d'un autre utilisateur

* Proposer une playlist de recommandation générée automatiquement sur la base de l'historique de visionnage de l'utilisateur connecté

## Commentaires et modération

* Un utilisateur connecté peut :
  * ajouter un commentaire à média

* Un modérateur peut :
  * consulter tous les nouveaux commentaires qui n'ont pas encore été modérés
  * modérer un commentaire c'est-à-dire modifier son contenu avec l'ajout automotatique d'un message indiquant que le commentaire a été modéré
  * signaler un utilisateur pour banissement éventuel par l'administrateur

* Un administrateur peut:
  * consulter tous les commentaires d'un utilisateur donné
  * bannir un utilisateur :
    * temporairement. Lorsqu'il se connectera, il ne pourra rien faire sur le site et verra un message indiquant pourquoi il a été banni et jusque quand.
    * définitivement c'est-à-dire bloquer le compte utilisateur. On pourra même envisager un blocage par IP pour éviter toute nouvelle création de compte.
  * promouvoir un utilisateur au rang de modérateur
  * supprimer le rôle de modérateur à un utilisateur
