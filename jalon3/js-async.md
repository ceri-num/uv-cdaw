# Asynchronicité en JavaScript

## Objectif pour le projet

* Comprendre le principe de base de l'asynchronicité
* Apprendre à modéliser l'orchestration des éléments
* Identifier les différents éléments du langage concernés
* Vérifier l'exactitude d'un formulaire d'après votre serveur
* Modifier des éléments de la page en fonction d'une réponse serveur
* Gérer un JSON

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


https://developer.mozilla.org/fr/docs/Learn/JavaScript/Objects/JSON

## Faire bootstrap datatable