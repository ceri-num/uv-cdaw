
# Objectifs du TP

Objectifs de ce TP:
* Implémenter un CRUD simple
* Implémenter une API Web REST+JSON
    - Implémenter un CRUD accessible via une API REST
    - Émettre des réponses HTTP contenant du JSON

Transformons maintenant le CRUD des utilisateurs que nous avons construit au TP1 sous la forme d'une API Web REST afin que le code du Front-end puisse ajouter ou supprimer des utilisateurs dans la base de données.
Avant de créér votre propre API Web au format REST ci-dessous quelques notions permettant de mieux comprendre tous ces termes : API, REST, HTTP, JSON, ...

#  HTTP

Cours : https://www.pierre-giraud.com/http-reseau-securite-cours/requete-reponse-session/

Les méthodes HTTP (verbs) les plus courantes :

* GET
    - n'attend pas contenu
    - réclame une représentation de la ressource
    - est sans effet de bord (i.e. ne modifie pas l'état de la ressource)
    - rend possible l'utilisation des caches
* POST
    - attent un contenu
    - peut avoir n’importe quel effet de bord (y compris non-idempotent)
    - est souvent utiliser pour créer une ressource sans connaître a priori son URL
* PUT
    - attend un contenu
    - demande la création ou la modification de la ressource
    - de sorte que le nouvel état de la ressource corresponde au contenu fourni
    - a donc un effet de bord idempotent
* DELETE
    - n'attend pas de contenu
    - demande la suppression de la ressource
    - a donc un effet de bord idempotent

# JSON

JavaScript Object Notation est un format largement utilisé pour échanger des données sur le Web

Exemple de JSON :
```
{
	"id": 1,
	"firstname": "Luke",
	"name": "Skywalker",
	"email": "luke.skywalker@galaxy.sw"
}
```
Vous pouvez valider du JSON https://jsonlint.com

# API

Application programming interface est un ensemble de règles permettant à des programmes de communiquer entre eux. Le développeur créé une API sur le serveur afin que les clients puissent communiquer avec ce dernier.


# REST

Representational State Transfer définit des règles pour structurer une API Web. Par exemple, les ressources (données) sont accessibles via une URL spécifique (endpoint).

{% hint style="alert" %}
Introduction API REST :
- https://www.smashingmagazine.com/2018/01/understanding-using-rest-api/
- https://perso.liris.cnrs.fr/pierre-antoine.champin/2017/progweb-python/cours/cm3.html
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
- On affecte à chaque ressource une URL qui l’identifie,
- et chaque URL identifie une ressource.
- Les manipulations se font en utilisant les verbes HTTP appropriés.

# Votre API REST pour le CRUD des `users`

<!-- https://developer.okta.com/blog/2019/03/08/simple-rest-api-php -->

![Exemple d'API REST pour la gestion de tâches](ressources/CRUD_REST/task_api.png)


## Documentez votre API REST

En vous inspirant de documentation REST existante ajouter dans votre dépôt une page Web qui documente l'API REST que vous allez implémenter pour la gestion des utilisateurs.

Exemples de documentation d'API :
- https://punkapi.com/documentation/v2

{% hint style="info" %}
Documenter et tester une API est important et il existe des outils pour cela comme https://swagger.io.
Mais nous n'aborderons pas cela dans ce cours.
{% endhint %}

Voici des exemples pour votre API :
- Lire toutes les utilisateurs : `GET /users` sans paramètre
    * retourne une réponse HTTP dont le contenu JSON décrit tous les utilisateurs de la base
- Créer un utilisateur : `POST /users`
    * nécessite de passer tous les champs de l'utilsateur à créer en paramètre POST (name, email) sauf le champ `id` qui sera automatique affecté par le serveur
    * En cas succès, retourne le code de statut HTTP `201 Created` et le champ `Location` de l'en-tête HTTP doit contenir l'URL de la nouvelle ressource donc son identifiant. Exemple : `Location: /user/5`
    * En cas d'erreur, retourne le code d'erreur de statut HTTP approprié parmis : https://developer.mozilla.org/en-US/docs/Web/HTTP/Status


## Implémenter `GET /users`

Commençons par implémenter un endpoint `/users` supportant la méthode `GET` sans paramètre et qui retournera la liste des utilisateurs dans la base en JSON.

1. Créer un nouveau répertoire `$PROJET_CDAW/BackEnd/tp2` avec les fichiers suivants :

- `config.php` (cf. TP1) contient les données de connexion à la base
- `bootstrap.php` :
```php
<?php

require "config.php";

// simplest auto loader cf. doc PHP
// we will revisit that later
spl_autoload_register(function ($class_name) {
    $classFile = $class_name . '.php';
    include $classFile;
});
```
- `DatabaseConnector.php` qui est un singleton stockant la connexion à la base (objet PDO)
```php
<?php

class DatabaseConnector {

    protected static $pdo = NULL;

    public static function current(){
       if(is_null(static::$pdo))
          static::createPDO();

       return static::$pdo;
    }

    protected static function createPDO() {
        // $db = new PDO("sqlite::memory");

        $connectionString = "mysql:host=". DB_HOST;

        if(defined('_MYSQL_PORT'))
            $connectionString .= ";port=". DB_PORT;

        $connectionString .= ";dbname=" . DB_DATABASE;

        static::$pdo = new PDO($connectionString,DB_USERNAME,DB_PASSWORD);
        static::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
```
- `UserModel.php` qui sera une version modifiée de votre classe `User` écrite dans le TP1
```php
<?php

	class UserModel
	{
		public static function getAllUsers() {
            // TODO ... (cf. TP1)
        }
    }
```
- `UserController.php` qui contient le code permettant de répondre aux requêtes de l'API : `GET /users` et  `POST /users`

```php
<?php

class UsersController {

    private $requestMethod;

    public function __construct($requestMethod)
    {
        $this->requestMethod = $requestMethod;
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->getAllUsers();
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getAllUsers()
    {
        // TODO ...
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}

}
```
- `api.php` qui contient est le root-endpoint de votre API REST

```php
<?php
require "bootstrap.php";

// https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Origin
header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

// https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Methods
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");

header("Access-Control-Max-Age: 3600"); // Maximum number of seconds the results can be cached.

// https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Headers
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

function getRoute($url){

    $url = trim($url, '/');
    $urlSegments = explode('/', $url);

    $scheme = ['controller', 'params'];
    $route = [];

    foreach ($urlSegments as $index => $segment){
        if ($scheme[$index] == 'params'){
            $route['params'] = array_slice($urlSegments, $index);
            break;
        } else {
            $route[$scheme[$index]] = $segment;
        }
    }

    return $route;
}

// $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
$route = getRoute($uri);

$requestMethod = $_SERVER["REQUEST_METHOD"];

$controllerName = $route['controller'];

switch($controllerName) {
    case 'users' :
        // GET api.php?/users
        // POST api.php?/users
        $controller = new UsersController($requestMethod);
        break;
    default :
        header("HTTP/1.1 404 Not Found");
        exit();
}

$controller->processRequest();
```

Tester votre API Web avec :
- votre navigateur pour les requêtes simples (GET)
- `curl` en ligne de commande
- Add-on navigateur : Advanced REST client (Chrome) ou RESTClient (Firefox)
- https://www.postman.com/


## Finir votre API

- Créer un utilisateur : `POST /users`
- Supprimer un utilisateur : `DELETE /user/{id}`
- Lire les données d'un utilisaeur : `GET /user/{id}`
- Modifier un utilisaeur : `PUT /user/{id}`