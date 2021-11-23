# Asynchronicité en JavaScript

## Objectif pour le projet

* Comprendre le principe de base de l'asynchronicité
* Modéliser l'orchestration des entités
* Identifier les différents éléments du langage concernés
* Vérifier l'exactitude d'un formulaire d'après votre serveur
* Modifier des éléments de la page en fonction d'une réponse serveur
* Gérer un JSON

## Cours
Le concept d'asynchronicité s'oppose à la syncrhonicité des opérations effectuées dans un code source. L'éxecution des instructions devient non linéaire dans le temps et donc, certains instructions sont non blocantes : elles s'éxecutent "à côté" le temps qu'elles finissent leur tâche.

{% hint style="warning" %}
Attention ! L'asynchronicité ne sous-entends pas multi-coeur, ni multi-threading.
{% endhint %}

### Notion de Callback
Une fonction de callback est une fonction $$f$$ (généralement anonyme) qui est passée à une autre fonction $$g$$ qui va l'éxecuter ultérieurement. Cette technique est largement utilisée dans l'asynchronicité.

Exemple de callback avec une fonction du langage JavaScript 
```javascript
setTimeout(function(){ alert("I'm callback!"); }, 3000);
```

Exemple de callback "custom"
```javascript
function calculate(num1, num2, callbackFunction) { //take a callback function
    return callbackFunction(num1, num2);
}

function calcProduct(num1, num2) { // a callback
    return num1 * num2;
}

function calcSum(num1, num2) { // another callback
    return num1 + num2;
}
console.log(calculate(4, 25, calcProduct)); // cli: 100
console.log(calculate(4, 25, calcSum)); // cli : 29
```


### Fonction anonyme vs. fonction arrow
Vous devez avoir remarqué depuis le temps l'utilisation des fonctions anonymes en callback (notamment dans les listener d'évènements) (*i.e.* `addEventListener("click", function(){})`). Vous pouvez aussi utiliser des arrows/arrows functions/fonction fléchées qui fonctionnent **PRESQUE** de la même manière. Leurs deux principales particularités sont :
1. Une modification du contexte pour l'operateur d'introspection (*i.e.* `this`)
2. Une simplification du mécanisme de cascade de callback (notamment pour [les promesses](./js-async#les-promesses).)

Exemple pour l'opérateur d'introspection :

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

### Les Promesses
Les promesses sont assez similaires aux callbacks. Ce sont toutefois des objets retournés auquels est attaché des fonctions de callbacks, plutôt que de passer des callbakcs à une fonction. Les promesses sont conçues pour **spécifiquement** simplifier la gestion des opérations asynchrone, comme communiqué avec le serveur. Elles permettent notamment :
* De rendre le chaînage de plusieurs opérations asynchrones beaucoup plus simple et plus lisible (cela inclus le passage du résultat d'une promesse à une autre)
* D'assurer la cohérence dans la queue évènementiel
* D'avoir une meilleur gestion d'erreurs
* Eviter les attaques par [inversion de contrôle](https://viktor-kukurba.medium.com/dependency-injection-and-inversion-of-control-in-javascript-303e07e7f43f)

[Explication détaillée sur les promesses](https://ceri-num.gitbook.io/uv-frontend/javascript/asynchronous#promises).

### Requête asynchrone au serveur
Imaginons que votre serveur -- pour accélerer le traitement et réduire le coût -- ne construise le catalogue des (millions de) média qu'avec le titre et le lien URL de l'image du film au moment de servir la page à un utilisateur. Au moment où l'utilisateur passera la souris au dessus d'un média, ce dernier vous enverra une requête à votre serveur pour récupérer les informations supplémentaires et les afficher.

Cela s'appele faire une requête asynchrone : échanger avec votre serveur (et ici récupérer des données supplémentaires) sans changer de page (*i.e.* sans se faire resservir une nouvelle page HTML).

Pour faire cela, il existe deux approches :
* L'objet [XMLHttpRequest](https://developer.mozilla.org/fr/docs/Web/API/XMLHttpRequest) (la méthode "old school")
* La méthode [`fetch`](https://developer.mozilla.org/fr/docs/Web/API/fetch) du mixin `WindowOrWorkerGlobalScope` (nouvelle approche)

La méthode `fetch` à l'avantage d'être concise et plus facilement lisible grâce à l'utilisation de promesses. Par exemple, ci dessous le code qui interroge le répertoire CDAW sur GitHub pour récupérer d'abord les commits, puis va chercher de nouveau des informations avec un deuxième fetch pour récupérer les informations de la personne qui a réalisé le second commit du repo.
```javascript
"use strict";
fetch('https://api.github.com/repos/ceri-num/uv-cdaw/commits')
  .then(response => response.json())
  .then(commits => fetch("https://api.github.com/users/"+commits[2].author.login))//deuxième fetch !
  .then(response => response.json())
  .then(githubUser => {
    let img = document.createElement('img');
    img.src = githubUser.avatar_url;
    img.className = "promise-avatar-example";
    document.body.append(img);

    setTimeout(() => img.remove(), 3000); // async callback, removing the img
  });
```

Généralement, un serveur offre une API pour favoriser la communication et l'accès aux informations *via* une approche asynchrone (*e.g.* [API GitHub](https://docs.github.com/en/rest/guides/getting-started-with-the-rest-api)). Une API n'est ni plus ni moins que des routes spécifiques dédiées à gérer ces requêtes asynchrones. N'hésitez pas à faire la votre.

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

## Exercice AJAX

Imaginons que votre serveur vous ait servi cette page de catalogue de média :

```html
<div id="medias">
    <div id="m1" data-anime="1">
        <h4 class="title">Cowboy Beepop</h4>
        <p hidden class="descr"></p>
    </div>
</div>
```

Et que votre serveur vous propose une API pour récupérer des informations sur les médias. L'API est : `https://api.jikan.moe/v3/anime/`, et l'identifiant de votre média est dans le `data-attribute` appelé `data-anime`. Pour récupérer les informations d'un média avec, disons, le data-attribute `data-anime=5` vous requêterez donc `https://api.jikan.moe/v3/anime/5`.

{% hint style="info" %}
Vous pouvez accéder aux data-attributes *via* `monElement.dataset.leNomApresData`.
{% endhint %}

1. Faîtes une requête et afficher le contenu de `https://api.jikan.moe/v3/anime/10`, imprégnez vous des champs accessibles ;
2. Lorsque vous cliquez sur votre média, récupérez les informations relatives qui sont liées, et enrichissez le champ description ;
3. Lorsque vous survolez votre média, le trailer associé doit se lancer. Vous utiliserez une balise `iframe` ;
4. Maintenant, on ne veut plus faire d'autres requête au serveur si on a déjà demandé au serveur les informations pour un media spécifique. Par exemple, si on clique sur le media, et ensuite qu'on le survole, rien ne sera demandé au serveur dans ce deuxième évènement et le client réutilisera les informations stockées.
5. Faîtes la même chose, mais en utilisant `XMLHttpRequest` à la place de `fetch` ! 