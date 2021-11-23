# Gestion des formulaires

## Objectif pour le projet 

* Savoir gérer des formulaires plus ou moins complexes
* Être capable d'attacher des comportements au formulaire, notamment à une adresse mail

## Cours

### Généricité
Les formulaires et les éléments de contrôle d'une page comme `<input>` ont de nombreuses propriétés et évènements propres. Il appartiennent à une collection nommée et ordonnée, appelée `document.forms`. Vous pouvez donc y accéder de deux manières :

```js
"use strict";

document.forms.myform; //récupère le formulaire myform
document.forms[0]; // récupère le 1er formulaire dans le dom
```

Pour un formulaire `forms[x]` donné, tous ses éléments sont accessibles simplement grâce à `form.elements`, qui est également une collection nommée et ordonnée.

{% hint style="warning" %}
Attention, il se peut que plusieurs éléments d'un formulaire porte le même nom (e.g. dans le cas de radio buttons). Dans ce cas là, `form.elements[name]` est une **collection**.
{% endhint %}

Chaque élément `element` d'un formulaire fait référence au formulaire qui le contient *via* `element.form`.

En fonction des éléments, les attributs disponibles varies. Par exemple, pour les éléments de type `input` et `textfield`, vous pouvez directement modifier leur valeur *via* `input.value = "newValue";` et `mytextFiled.value = "new value";`. Pour la liste des détails, aller voir sur les documentations MDN et W3School.


### Gérer les évènements propre à un formulaire

En général, lors d'un formulaire, il est intéressant d'avoir recourt à du JS pour rajouter de l'intéractivité sur la page, ainsi que des contrôles -- ces derniers permettent de décharger le serveur.

{% hint style="danger" %}
Votre serveur **DOIT TOUJOURS, TOUJOURS** vérifier les données reçus, même si votre client les vérifie également ; JS peut être bypassé facilement et des données fausses/malicieuses peuvent être injectées facilement.
{% endhint %}

Trois évènements nous intéresses ici : le `change`, l'`input` et le `submit`.

* `change` est émis lorsqu'un élément a terminé d'être modifié. Par exemple pour les champs de texte, c'est dès qu'ils perdent le focus, pour les sélecteur, dès qu'une nouvelle valeur est choisie. Pour capturer le changement, on peut attacher à l'élément en question le handler `change` : `myElement.addEventListener("change", myfunction);`
* `input` est émis à chaque fois que la valeur est modifiée par l'utilisateur, que ce soit une frappe clavier, un copier coller, un text to speach (T2S), etc. De la même manière que change, on l'utilise via l'handler : `myElement.addEventListener("input", myfunction);`

**Le cas de submit**
Submit est émis lorsqu'un formulaire est envoyé (submitted), généralement par l'entremise d'un bouton `<button type="submit" value="Submit">` dans le code HTML ou d'un appuie sur Entrée dans un des champs du formulaire. C'est à ce moment là où on peut vérifier les informations ; si une erreur est présente, appeler la fonction `myevent.preventDefault()` dans le handler de soumission permet d'empecher l'envoie au serveur : pratique !
On écoute le formulaire, et non pas le bouton qui fait office de submit.

Exemple :
```html
<form id="form1">
            <input type="text" value="text"><br>
            <input type="submit" value="Submit">
</form>
```
```js
"use strict";

function myVerif(e)
{
    let valToCheck = e.currentTarget.elements[0].value; //récupère la valeur du texte dans le premier input

    if(valToCheck != "expectedValOrRegexp") //si on a une regexp pour valider la valeur, et que ça ne match pas, on ne veut pas envoyer ça au serveur !
        e.preventDefault();
}

document.forms["form1"].addEventListener("submit", myVerif);
```

{% hint style="success" %}
Il est également possible de submit manuellement un formulaire en JS grâce à la méthode `form.submit()`. À noter qu'en effectuant un appel manuel à `submit`, l'évènement associé **n'est pas généré** !
{% endhint %}


### Un peu d'UX

Étant particulièrement fainéant, j'apprécie pouvoir naviguer sur mon site sans une souris. Vous avez la possibilité de savoir quel élément possède le focus actuellement sur votre page, et à quel moment l'élément perd se focus (`focusout`), ainsi que quand un élément à la focus (`focusin`).

À partir de là, vous pouvez forcer des éléments à avoir le focus, et aussi vous assurer que des champs sont correctement remplis au moment d'un `focusout`.

{% hint style="info" %}
Toutefois, je vous conseil maintenant d'utiliser l'attribut `required` et `pattern` HTML !
{% endhint %}

Pour ordonner l'ordre des tabulations, vous pouvez utiliser l'attribut HTML `tabindex`. Par exemple :
```html
<ul>
  <li tabindex="1">One</li>
  <li tabindex="2">Two</li>
  <li tabindex="3">Three</li>
</ul>
```
Qui va du plus petit au plus grand, et qui permet également à des éléments HTML de devenir focusable (par exemple les `ul` et `li`).


### REGEXP
Les expressions régulières (REGEX, REGEXP) sont un moyen synthétique pour appliquer des filtrages à grand échelle. Ils sont très utiles pour les formulaires et la vérification de données, mais sont de prime abord très obscur. Vous avez de très bon tuto sur internet, par exemple [celui là](https://www.lucaswillems.com/fr/articles/25/tutoriel-pour-maitriser-les-expressions-regulieres).

Surtout, lorsque vous pratiquez les REGEXP, munissez vous d'un interpréteur capable de vous résumer ce que vous êtes en train d'écrire. Un très bon outil : [regex101](https://regex101.com/).

## Exercice

En reprenant le code précédent que vous avez écrit précédement ([Manipulation du Document Object Model](./js-dom.md)), nous voulons maintenant pouvoir modifier directement le commentaire avec du vrai contenu, par exemple si jamais l'on y décèle une faute d'orthographe.

Pour cela, vous aurez besoin d'un formulaire pour écrire le texte, et l'envoyer au serveur (pour le moment, on fera comme si). Ce formulaire n'apparaîtra que lorsque l'on clique sur un des boutons "Modifier".

1. Rajouter après le bouton `addNew` un formulaire `myForm` composé de deux éléments : un textarea (attention, le contenu s'écrit entre les deux balises textarea...) et un input de type submit.
2. Lorsqu'un utilisateur clique sur un bouton "Modifier", le contenu du `textarea` se met à jour avec le commentaire.
3. Lorsque l'utilisateur soumet son formulaire, vérifiez si le commentaire est valide. Un commentaire valide peut par exemple être un commentaire non nul. Si le commentaire est invalide, vous ne devez pas envoyer votre formulaire au serveur -- vous pouvez notifier l'utilisateur que la saisie n'est pas bonne.
4. Si le commentaire modifié est valide, indiquez quel user est concerné via une fenêtre alerte, puis n'oubliez pas de mettre à jour le commentaire dans la section commentaire.
5. On veut maintenant cacher ce formulaire tant que l'utilisateur n'a pas cliqué sur un des boutons "Modifier". Jouer avec la bonne propriété CSS pour cacher/afficher.
6. Pour vous prémunir de tout soucis lorsque le formulaire est caché, désactivez aussi l'élement `input` avec l'attribut `disabled` ; vous le réactiverez manuellement lorsqu'il sera affiché pour modifier un élément.
