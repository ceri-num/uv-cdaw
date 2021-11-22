# Asynchronicité en JavaScript

## Objectif pour le projet

* Comprendre le principe de base de l'asynchronicité
* Modéliser l'orchestration des entités
* Identifier les différents éléments du langage concernés
* Vérifier l'exactitude d'un formulaire d'après votre serveur
* Modifier des éléments de la page en fonction d'une réponse serveur
* Gérer un JSON

## Cours

Point sur arrow versus anonyme
```js
function Personne () {
  // Le constructeur Personne() définit `this` comme lui-même.
  this.age = 0;

  setInterval(function grandir () {
    // En mode non strict, la fonction grandir() définit `this`
    // comme l'objet global et pas comme le `this` defini
    // par le constructeur Personne().
    // En mode strict, vous receverez une erreur car this est undefined
    this.age++;
  }, 1000);
}

var p = new Personne(); //Btw, vous pouvez faire de l'objet en JS
```

```javascript
function Personne () {
  this.age = 0;

  setInterval(() => {
    this.age++;
    // |this| fait bien référence à l'objet personne
  }, 1000);
}

var p = new Personne();
```

### JSON
JSON est un format de données qui se présente sous la forme d'une chaîne de caractères. Il a la particularité de pouvoir facilement représenter les objets JavaScripts (vous pouvez même stocker des tableaux !). Si vous utilisez une API, ou communiquez de manière asynchrone avec votre serveur, il y a de forte chance que votre serveur vous communique des informations dans ce format. Un exemple de JSON (qui vient d'[ici](https://developer.mozilla.org/fr/docs/Learn/JavaScript/Objects/JSON)) :

```json
{
  "squadName": "Super hero squad",
  "homeTown": "Metro City",
  "formed": 2016,
  "secretBase": "Super tower",
  "active": true,
  "members": [
    {
      "name": "Molecule Man",
      "age": 29,
      "secretIdentity": "Dan Jukes",
      "date":"2017-11-30T12:00:00.000Z",
      "powers": [
        "Radiation resistance",
        "Turning tiny",
        "Radiation blast"
      ]
    },
    {
      "name": "Madame Uppercut",
      "age": 39,
      "secretIdentity": "Jane Wilson",
      "date":"2018-11-30T12:00:00.000Z",
      "powers": [
        "Million tonne punch",
        "Damage resistance",
        "Superhuman reflexes"
      ]
    },
    {
      "name": "Eternal Flame",
      "age": 1000000,
      "secretIdentity": "Unknown",
      "date":"2019-11-30T12:00:00.000Z",
      "powers": [
        "Immortality",
        "Heat Immunity",
        "Inferno",
        "Teleportation",
        "Interdimensional travel"
      ]
    }
  ]
}
```


Néanmoins, vous ne pouvez pas utiliser du JSON directement en JS, vous devez le parser pour le faire correspondre à des objets JavaScript. Heureusement pour vous, le langage possède déjà une fonction toute prête appelée `JSON.parse`. Son prototype et utilisation est le suivant :

```javascript
let value = JSON.parse(str, [reviver]);
```

{% hint style="info" %}
Un reviver vous permet d'appliquer un comportement spécifique lorsqu'un couple clef/valeur JSON est lue. Par exemple pour le champ `date` de l'exemple précédent.
{% endhint %}

https://developer.mozilla.org/fr/docs/Learn/JavaScript/Objects/JSON

## Faire bootstrap datatable


## Exercice JSON
### Linéariser l'objet suivant 1
Supposons que vous voulez communiquer à votre serveur de manière asynchrone la création d'un nouveau média :

```javascript
class Media{ //Pour info, ceci est une classe en JavaScript
    name;
    type;

    constructor(name, type){
      this.name = name;
      this.type=type;
    }

    printMe()
    {
      console.log("Hey ! I'm "+this.name+"!");
    }
  }

  let myMedia = new Media("Hope", "Drama");
  myMedia.printMe();
```

1. Linéariser cet objet en JSON.

### Linéariser l'objet suivant 2 (avec cycle)
Supposons que vous voulez communiquer à votre serveur de manière asynchrone la création d'un nouveau média auquel vous associez un score d'après le retour de certains utilisateurs :
```javascript
  class Media{ //Pour info, ceci est une classe en JavaScript
    name;
    type;

    constructor(name, type){
      this.name = name;
      this.type=type;
    }

    printMe()
    {
      console.log("Hey ! I'm "+this.name+"!");
    }
  }

  let likers = { //Une autre manière de faire des objets en JS, moins lourde que les classes mais moins flexible
    likeScore : 87,
    users : [ //un tableau d'objets !!!!
      {
        "name" : "user1"
      },
      {
        "name" : "user2"
      },
    ]
  };

  let myMedia = new Media("Sword of the Stranger", "Anime");
  myMedia.score = likers;
  likers.associatedTo = myMedia;
```
1. Linéariser cet objet en JSON
2. Comment faire pour régler le problèle ?

### Parser

Supposons que lors d'une requête asynchrone, votre serveur vous réponde avec ce JSON là :
```json
{
  "name" : "Yojimbo",
  "type" : "Film",
  "annotations" : [
    "Drame",
    "Thriller"
  ],
  "realisateur" : "Akira Kurosawa"
}
```
1. Effectuer l'analyse syntaxique (parser) du JSON reçu.

### Parser et "reviver" la date
Supposons maintenant que lors d'une requête asynchrone, votre serveur vous réponde avec ce JSON là :
```json
{
  "name" : "Yojimbo",
  "type" : "Film",
  "annotations" : [
    "Drame",
    "Thriller"
  ],
  "realisateur" : "Akira Kurosawa",
  "date":"1961-09-13T12:00:00.000Z"
}
```
1. Effectuer l'analyse syntaxique du JSON reçu
2. Une fois l'objet créer, exécuter `monObjetCréer.date.getDate()` ; que constatez-vous ?
3. Utiliser un reviver pour traiter correctement la date !

## Exercice Asynchrone

API https://api.jikan.moe/v3/anime/1 -> Beepop