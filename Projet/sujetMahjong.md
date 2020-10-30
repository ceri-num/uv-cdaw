# Projet  Web  Mah-Jong

Ce document décrit ce qui est attendu pour le projet Web de 2020 du point de vue fonctionnel.

## Aperçu du site
Réaliser un site permettant de jouer au Mah-Jong Japonnais (règles Riichi Européenne).
Vous trouverez les règles officielles ici : https://www.ffmahjong.fr/FFMJ-site/documents/riichi-fr.pdf

C’est un jeu à 4 joueurs.

Un exemple d'affichage de mahjong:
![Aperçu d'un mahjong dans FF XIV](resources/mahjong_ex_1.png)

## Fonctionnalités à réaliser
* Création de compte utilisateur (prendre en compte un rôle administrateur)
* Connexion au site
* Un utilisateur connecté peut :
   * Créer une partie publique ou privée:
      * Inviter d’autres membres
      * lancer la partie si 4 joueurs sont bien dans la partie
   * Rechercher et rejoindre des parties publiques non encore remplies
   * Consulter la fiche publique d’un joueur :
      * nombre de parties jouées
      * gagnées
      * ...
    * mettre à jour les informations de son profil (avatar, nom, prénom, pseudo, email)
* Un administrateur peut:
   * bloquer un utilisateur (il ne pourra plus se connecter, et toutes ses parties sont clôturées)
   * bloquer une adresse IP (cette adresse ne pourra plus créer de compte ni se connecter)
   * promouvoir un utilisateur au rang d’administrateur
   * supprimer le rôle d’administrateur à un utilisateur
   * modifier ou supprimer n’importe quelle partie

## Fonctionnalités supplémentaires
* Spectate une partie publique (ou privé avec un code d'accès)
* Organiser des tournois
   * Inviter d'autres joueurs (ou permettre leur inscription)
   * Définir les règles générales des parties
   * Jouer de manière synchrone les matchs
* Implémenter des émotes
* Faire une intelligence artificielle pour remplir les sièges vacants dans les parties < 4 joueurs
* Définir un chronomètre pour le tour de chaque joueur -- configurable dans les options du salon de jeu
* Liste tracking des Yakus effectués/restant à faire (en jeu et dans le profil)
* Animation

## Déroulement d’une partie
cf. règles officielles ici : https://www.ffmahjong.fr/FFMJ-site/documents/riichi-fr.pdf

Le site effectuera automatiquement les actions suivantes :
* Tirage au hasard des vents des joueurs
* Construction du mur, ouverture du mur, mur mort, indicateur de dora
* Distribution des tuiles aux joueurs

Le joueur vent d’EST jouera le premier. Pendant son tour, un joueur peut effectuer les actions décrites dans les règles (cf. section 3 : Déroulement du jeu) : chi, pioche et défausse. Lorsqu’un joueur se défausse d’une tuile à la fin de son tour, tout autre joueur peut faire un pon.

## Interface Web / UX attendue
Les 4 joueurs jouent chacun sur leur propre navigateur Web. Lorsqu’un joueur jette une tuile, cela déclenche la fin de son tour. Vous pouvez envisager de jouer en synchrone via une bibliothèque JS telle que [socket-io](https://socket.io) mais ce n’est pas obligatoire.

## Attentes des parties

### UX
### Couche Données

### Back-end
Exemple pour Backend:
* utiliser la base de données construite et les requêtes SQL pour développer la couche Modèle
* développer une API Web REST/JSON avec une architecture MVC (PHP, Laravel ou Seaside ;-))
* documenter cette API qui sera ensuite utilisée par le Front-end
Exemple d'API : https://punkapi.com/documentation/v2

### Front-end
* Conserver et exploiter la couche modèle applicatif du serveur
* Développer le front-end avec une architecture MVC autour d'une philosophie Single-Page Application
   * Adopter une approche par composants
* Déporter les calculs côtés clients et effectuer les 1ere vérifications côté client
   * CRUD côté client
   * Logique de jeu côté client
   * etc
* Utiliser l'API Web REST définie côté serveur pour communiquer
