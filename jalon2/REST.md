# API Web

Les API (Application Programming Interface) Web sont un moyen d'inter-connecter des programmes entre eux.
Par exemple, je peux écrire un programme qui analyse les tweets en utilisant l'API offerte par twitter.
Pour utiliser une API Web, il faut généralement comprendre plusieurs notions comme JSON, REST, ...

## JSON

JavaScript Object Notation est un format largement utilisé pour échanger des données sur le Web. Exemple de JSON :

```
{
	"id": 1,
	"firstname": "Luke",
	"name": "Skywalker",
	"email": "luke.skywalker@galaxy.sw"
}
```

{% hint style="alert" %}
Aller plus loin sur JSON :
- [https://restfulapi.net/introduction-to-json/](https://restfulapi.net/introduction-to-json/)
- Valider du code JSON : [https://jsonlint.com](https://jsonlint.com).
{% endhint %}

## API

Application programming interface est un ensemble de règles permettant à des programmes de communiquer entre eux. Le développeur créé une API sur le serveur afin que les clients puissent communiquer avec ce dernier.

## REST

Representational State Transfer définit des règles pour structurer une API Web. Par exemple, les ressources (données) sont accessibles via une URL spécifique (endpoint).

{% hint style="alert" %}
Introduction aux APIs REST :
- [https://restfulapi.net/](https://restfulapi.net/)
- [https://www.smashingmagazine.com/2018/01/understanding-using-rest-api/](https://www.smashingmagazine.com/2018/01/understanding-using-rest-api/)
<!-- - https://perso.liris.cnrs.fr/pierre-antoine.champin/2017/progweb-python/cours/cm3.html -->
{% endhint %}


<!-- ## REST Web API

Une requête HTTP est constituée de 4 éléments.

### endpoint

Le *endpoint* est l'URL de la requête.

Le *root-endpoint* est l'URL de base de l'API.
Par exemple, le root-endpoint de l'API :
- de Github est https://api.github.com
- de Twitter est  https://api.twitter.com

Le *chemin* (path) est le nom de la ressource que l'on souhaite accéder et vient après le root-endpoint dans l'URL.
Doc : https://developer.github.com/v3/repos/#list-repositories-for-a-user
Exemple : https://api.github.com/users/raysan5/repos
permet de récupérer la liste des dépôts git de l'utilsateur raysan5 sur github.


- method :
- headers
- body -->

API RESTful :
- chaque ressource est identifiée et accessible via une URI
- les traitements (CRUD) à appliquer sont décrits par les verbes HTTP (GET, POST, ...)

![Exemple d'API RESTful pour gérer des tâches](../ressources/CRUD_REST/task_api.png)

Exemples de documentation d'API : [https://punkapi.com/documentation/v2](https://punkapi.com/documentation/v2)

{% hint style="info" %}
Documenter et tester une API est important et il existe des outils pour cela comme [https://swagger.io](https://swagger.io).
Mais nous n'aborderons pas cela dans ce cours.
{% endhint %}

## Exercice

Choisir une API Web publique (par exemple dans la liste : [https://github.com/public-apis/public-apis](public Web API)). Exemples intéressants :

- [https://punkapi.com/](https://punkapi.com/)
- [https://ladataverte.fr/](https://ladataverte.fr/)

Explorez l'API choisie en utilisant l'un des logiciels suivant :

- votre navigateur Web (requêtes `GET`)
- un plugin pour votre navigateur ([https://addons.mozilla.org/en-US/firefox/addon/restclient/](exemple))
- [https://reqbin.com/](https://reqbin.com/)
- le logiciel [https://www.postman.com/downloads/](Postman)

Dans le cas de [https://ladataverte.fr/](https://ladataverte.fr/), essayez de répondre aux questions suivantes :
- La crise sanitaire a t-elle réduit les émissions de CO2. Comparez 2019 et 2020 pour différents pays, régions du monde ou le monde entier.
- ...