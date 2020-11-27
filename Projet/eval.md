# Modalités pratiques pour le Projet

## Versionning avec git

Vous *devez* utiliser un dépôt git pour votre projet et travailler en équipe sur ce dépôt.
L'un des membres du groupe doit créer le projet git sur gvippers ou gitub, puis devra donner les droits d'accès et de modification à son binôme. Rien n'empêche le binôme de forker le projet, mais nous pensons qu'il sera plus simple si vous travaillez directement dans le même projet.
Vous devez communiquer l'URL du dépôt git de votre projet aux enseignants.

Ce dépôt doit contenir *TOUTES* les ressources du projet. Exemple d'organisation de votre dépôt git :

```
Readme.md         # décrit l'organisation de votre dépôt, où trouver les docs, les auteurs, ...
doc/
   sujet.md       # votre sujet de projet
   REST_API/      # contient la doc de votre API WEB
   Deploiement.md # décrit comment déployer et configurer votre Projet

UX/
   Maquettes/     # contient les maquettes de votre site
   static/        # contient une maquette statique HTML/CSS de votre site
   ...
AGL/
   Conception/
      mcd
      ...
   BD/
      createDatabase.sql   # fichier de création de votre BD (create table, ...)
      insertSampleData.sql # fichier insérant des données de tests dans la base
      ...
BackEnd/
   tpX/  # contient vos code pour les TPs
   src/  # contient le code de la partie BackEnd du projet
      config/        # contient la configuration du BackEnd (config BD, ...)
      model/         # contient les modèles
      controller/   # contient les contrôleurs
      view/
         templates_json/   # contient les templates JSON pour la construction des réponses HTTP
      index.php
FrontEnd/
   # Le contenu sera créer automatiquement et manuellement. Cf le lien ci-dessous
Laravel/
   ...
```

{% hint style="warning" %}
Pour la partie Front End, référez vous à [ce document](../FrontEnd/TP/setup.md) pour bien configurer votre projet ! Votre dossier Front End **doit** avoir l'organisation énnoncée dans ce document.
{% endhint %}

## Rendre son projet

La date limite de rendu de votre projet est le **vendredi 4 à 23h**.
A cette date, votre projet doit être commité sur votre dépôt git (gvippers ou github).
Eventuellement déployé sur le serveur `eden`.
Chaque *groupe* doit envoyer une email à Luc Fabresse en respectant le template suivant :

```
Objet : [projet CDAW]
Contenu :
   membres du groupe : <NOM prenom>, <NOM prenom>
   dépôt git : https://gvipers.imt-lille-douai.fr/prenom.nom/projet-cdaw (<url_depot_git>)
   vidéo de démonstration : https://youtubexxxx (<url_vidéo>)
   site déployé : https://eden.imt-lille-douai.fr/prenom.nom/ (<url_site>)
   Identifiants : admin/w;efh039 (identifiants admin sur le site déployé si besoin)

```

## Démarche d'un évaluateur

```
git clone <url_depot_git>
```

* Lire Readme.md
* Regarder <url_vidéo>
* Tester le site via <url_site>
* Évaluer les éléments dans le dépôt git : maquettes, code source, documentations (API REST, déploiement, ...)
* Analyse historique des versions
   - travail régulier ?
   - travail équitablement réparti entre les membres du groupe ?


