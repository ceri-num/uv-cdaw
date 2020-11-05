# Modalités pratiques pour le Projet

## Versionning avec git sur gvipers

Vous *devez* utiliser un dépôt git sur le serveur gvipers pour votre projet et travailler en équipe sur ce dépôt.
L'URL de votre dépôt devra *obligatoirement* avoir la forme suivante :  https://gvipers.imt-lille-douai.fr/prenom.nom/projet-cdaw.

Ce dépôt doit contenir *TOUTES* les ressources du projet :
- Maquetage
- Documentation
- Modèles de données / SQL
- Scripts de déploiement
- Codes source des Back et Front-end
- Readme.md qui décrit le contenu du dépôt, l'organisation des fichiers, comment déployer le site.

## Rendre son projet

La date limite de rendu de votre projet est le XXXX.
A cette date, votre projet doit être déployé sur le serveur `eden` et commitée dans votre dépot git sur le serveur `gvipers`.
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


