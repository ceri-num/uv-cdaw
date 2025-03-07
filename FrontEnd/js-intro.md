# Introduction au JavaScript

## Objectif pour le projet

* Savoir créer, intégrer et appeler du code JavaScript dans sa page

## Bibliographie

Un [cours](https://www.pierre-giraud.com/javascript-apprendre-coder-cours/) très bien fait.

## Script JS

### Cours

Un script JS peut prendre deux formes : écrit dans une page HTML ou écrit dans un fichier à côté (`xyz.js`).

Pour intégrer un script directement dans une page HTML
```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- STYLES -->
        <link rel="stylesheet" href="../view/style/taskmenu.css" />
    </head>
    <body>
        <p> avant le script </p>
        <script>
            alert("Hello World");
        </script>
        <p> après le script </p>
    </body>
```

Pour intégrer un script dans une page via un fichier `.js`
```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- STYLES -->
        <link rel="stylesheet" href="../view/style/taskmenu.css" />

        <!-- SCRIPTS -->
        <script src="../model/board_global_config.js"></script>
        <script src="./folder/taskboard_pool.js"></script>
    </head>
    <body>
```

{% hint style="warning" %}
Le sens dans lequel vous chargez vos fichiers compte, et peut avoir une incidence très forte sur le temps de chargement de votre page. Plus d'info [ici](https://ceri-num.gitbook.io/uv-frontend/javascript/intro#think-of-your-scripts-loading-strategies).
`{% endhint %}`

{% hint style="info" %}
Vous pouvez aussi récupérer des scripts directement via protocole http/s en utilisant un réseau de distribution de contenu (a.k.a. CDN). Par exemple : `<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/lodash.js"></script>`
{% endhint %}

### Exo

1. Créer une page HTML simple, où vous affichez une alerte (`alert("Number One")`) dès que la page est prête.
2. Remplacer l'affichage de l'alerte par un fichier javascript qui effectue la même chose.
3. Créer deux autres fichiers `.js` avec comme contenu, respectivement, `alert("Number Two")` et `alert("Number Zero")` ; intégrer les à votre page
4. Ordonner les correctements pour avoir l'ordre des alertes suivants : 2 > 1 > 0.

## Notion de disponibilité et fonctions

### Cours
Vos fichiers `.js` de la section précédente s'exécutent directement, sans contrôle et possibilité de les rappeler. Néanmoins, une fois inclus dans votre page, ils sont connus des autres scripts subséquents.

Vous pouvez entourer vos alertes par le mot clef fonction
```javascript
function mafonction(){
    alert("Number One");
}
```

Vous pouvez aussi déclarer des variables qui, si elles sont dans le scope global de votre script, seront visibles par les scripts chargés après.

### Exo

1. Entourez au moins une de vos alertes par une fonction ; *que remarquez vous ?*
2. Comment alors appeler le code contenu dans vos fonctions ?
3. En supposant que vous avez toujours vos trois fichiers scripts qui se chargent dans l'ordre 2 > 1 > 0, dans le premier script créer une variable `let maVar1 = 2;`, dans le deuxième script créer une variable `let maVar2 = 1` et dans le troisième écrire l'instruction `alert(maVar2 - maVar1)`. *Que constatez-vous ?*

{% hint style="info" %}
Dans le cas d'une fonction, `let` créer une variable uniquement visible dans le contexte de la fonction, contrairement à `var` qui rend la variable disponible partout. `const` rend la variable constante.
{% endhint %}

## Point important

JavaScript requiert que vous codiez **PROPREMENT** ! C'est un langage de script qui interprète beaucoup de chose... Donc faites attention et soyez discipliné !

Un [exemple](https://www.destroyallsoftware.com/talks/wat), ou un autre :

```javascript
var arr = [];
arr.length → 0
arr[3] → undefined // No array bounds exception
arr[3] = "hi";
arr.length → 4 // Only one element has been added, but at the third index, misleading the length counter
arr["3"] → "hi" // Apparently "3" is coerced into a number
delete(arr[3]);
arr.length → 4 // 4??? There are no elements in the array!
arr[3] → "undefined" // 7 lines above, length was "0"...
```

{% hint style="danger" %}
Bonnes pratiques :
- toujours utiliser `"use strict";` au début de tous vos script `js` ([strict mode](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Strict_mode))
- toujours un point virgule à la fin de vos instructions
- toujours utiliser des fichiers js plutôt que des instructions "plain text"
{% endhint %}
