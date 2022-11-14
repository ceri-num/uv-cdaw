# Modalités pratiques

Tout au long de cette UV, vous devez réaliser les exercices et les jalons qui sont décrits.

Les exercices sont à réaliser seul et à livrer sur son git personnel.
Les jalons correspondent à une partie du projet final et ils peuvent être réalisés seul ou en binôme (pas plus de 2 personnes / groupe).
Les jalons sont à livrer sur le dépôt git d'un des membres du groupe.
Attention, les 2 membres du groupes doivent committer (puisque les 2 codent) sur ce dépôt car nous regarderons l'historique Git pour juger de l'implication de chacun.
Il faut donc donc que le propriétaire du dépôt donne les droits au 2eme membre du groupe.

## Livraison d'un exercice ou d'un jalon

Tous vos jalons (ou exercices) doivent être livrés dans le dépôt git du groupe (ou personnel) qui a été créé lors de l'installation.

Pour livrer un jalon, il faut:

1. créer un sous-répertoire `RACINEPROJET/public/jalonX`
2. créer et compléter le fichier `RACINEPROJET/public/jalonX/README.md` avec les infos suivantes :
   Ce fichier doit contenir les infos suivantes:

```
# Auteur(s)
- <NOM prenom>
- <NOM prenom>

# Jalon X

<description>

Fonctionnalités implémentées :
- création de compte
- connexion au site
   par manque de temps, nous n'avons pas terminé la connexion
   il manque : xxx et yyy
- ...

Méthode pour initialiser la base de données :
par les migrations / seeders ou par fichier sql (préciser le chemin).

Route :
http://localhost/netflix_cdaw/public/accueil

Identifiants sur le site :
   - utilisateur 1 : bob / leponge
   - utilisateur 1 : riri / loulou
   - admin/w;efh039


Vidéo de démonstration : https://youtubexxxx
```

Bien évidemment, voud devez changer les infos fictives de ce template par les vraies infos qui concernent votre exercice/jalon.

## Démarche d'un évaluateur

1. clone de votre dépôt
   `git clone https://github.com/<pseudo_github>/xxx (<url_depot_git>)`
2. Lecture du README.md d'un exercice ou d'un jalon
3. Test en local
4. Évaluation des éléments supplémetaires dans le dépôt git : maquettes, code source, documentations (API REST, ...)
5. Analyse de l'historique des versions
   - travail régulier ?
   - travail équitablement réparti entre les membres du groupe ?

