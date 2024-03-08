# Projet Web Ticket to ride

Ce document décrit ce qui est attendu pour le projet Web du point de vue fonctionnel.

## Aperçu du site

Réaliser une application Web pour jouer au jeu Aventuriers du rail (ticket to ride).

<!-- ![Aperçu](2024/ttr.png) -->

# Fonctionnalités

Sur le site, un visiteur (utilisateur non connecté) peut :
* Consulter les stats des meilleurs joueurs
* Créer un compte joueur
* Se connecter

Un administrateur peut:
  * bloquer un compte utilisateur. L'utilisateur ne pourra plus se connecter mais toutes ses playlists seront conservées.


Un joueur (utilisateur connecté) :

 * a un profil : pseudo, email, mot de passe et peut le modifier
 * une liste d'amis
 * peut parcourir l'ensemble des parties ouvertes non démarrées
 * peut rejoindre une partie incomplète
 * consulter l'historique de ses parties : date, participants, scores, vainqueur

Une partie :
- est créé par un joueur
- peut être publique ou privée:
    * Une partie privée nécessite que le créateur de la partie invite d'autres membres du site
    * Une partie publique peut être rejointe par n'impore quel joueur connecté
- peut être limitée en nombre de joureur par le créateur

# Extensions

- Jouer vite. Le créateur d'une partie impose un nombre de secondes maximum pour jouer son tour.
- ajouter un chat pour que les joueurs puissent discuter pendant la partie
