# Modalités pratiques

Tout au long de cette UV, vous devez réaliser les exercices et les jalons qui sont décrits.

Les exercices sont à réaliser seul et à livrer sur son git personnel.
Les jalons correspondent à une partie du projet final et ils peuvent être réalisés seul ou en binôme maximum.
Les jalons sont à livrer sur le dépôt git d'un des membres du groupe.

## Livraison d'un exercice ou d'un jalon dans un dépôt git

Tous vos jalons (ou exercices) doivent être livrés dans le dépôt git du groupe (ou personnel) qui a été créé lors de l'installation en forkant le dépôt le dépôt [Template git CDAW](https://github.com/ceri-num/uv-mlod-vscode-template).

Pour livrer un jalon, il faut:

1. créer un sous-répertoire `RACINEPROJET/public/jalonX`
2. créer et compléter le fichier `RACINEPROJET/public/jalonX/Readme.md` avec les infos suivantes :
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
   par manque de temps, nous n'avons pas terminié la connexion
   il manque : xxx et yyy
- ...

Identifiants admin sur le site :
   - utilisateur 1 : bob / leponge
   - utilisateur 1 : riri / loulou
   - admin/w;efh039

Vidéo de démonstration : https://youtubexxxx
```

Bien évidemment, voud devez changer les infos fictives de ce template par les vraies infos qui concernent votre exercice/jalon.

## Démarche d'un évaluateur

1. clone de votre dépôt
```
git clone https://github.com/<pseudo_github>/xxx (<url_depot_git>)
```
1. Lecture du Readme.md d'un exercice ou d'un jalon
2. Tester le site en local via VSCode
3. Évaluer les éléments supplémetaires dans le dépôt git : maquettes, code source, documentations (API REST, ...)
4. Analyse de l'historique des versions
   - travail régulier ?
   - travail équitablement réparti entre les membres du groupe ?
