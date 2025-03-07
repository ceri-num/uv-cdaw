
# Objectifs du TP

Objectifs de ce TP:
* Implémenter un CRUD simple
* Implémenter une API Web REST+JSON
    - Implémenter un CRUD accessible via une API REST
    - Émettre des réponses HTTP contenant du JSON

Transformons maintenant le CRUD des utilisateurs que nous avons construit au TP1 sous la forme d'une API Web REST afin que le code du Front-end puisse ajouter ou supprimer des utilisateurs dans la base de données.
Avant de créér votre propre API Web au format REST ci-dessous quelques notions permettant de mieux comprendre tous ces termes : HTTP, JSON, API, REST, ...

# Votre API REST pour le CRUD des `users`

Crééons maintenant une API REST pour la gestion des utilisateurs du TP1.
Créer un nouveau répertoire `$PROJET_CDAW/BackEnd/tp2`.

<!-- https://developer.okta.com/blog/2019/03/08/simple-rest-api-php -->

## Documentez votre API REST

En vous inspirant de documentations REST existantes ajouter dans votre dépôt (`tp2/doc/index.html` ou `tp2/doc/README.md`) une documentation de l'API REST que vous allez implémenter pour la gestion des utilisateurs.

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

Voici les fichiers à créer et compléter :

- `config.php` (cf. TP1) contient les données de connexion à la base

- `bootstrap.php` qui configure un autoloader PHP permettant de charger automatique les fichiers contenant les définitions de classes :

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

- `DatabaseConnector.php` qui est un singleton stockant la connexion à la base (objet PDO) :

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

- `UserModel.php` qui sera une version modifiée de votre classe `User` écrite dans le TP1 :

```php
<?php

	class UserModel
	{
		public static function getAllUsers() {
            // TODO ... (cf. TP1)
        }
    }
```

- `UsersController.php` qui contient le code permettant de répondre aux requêtes de l'API : `GET /users` et  `POST /users` :

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

- `api.php` qui est le root-endpoint de votre API REST :

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


<!-- Explique comment récuper du contenu JSON passé le contenu d'une requête
```php
$data = json_decode(file_get_contents("php://input"));

// set product property values
$user->firstname = $data->firstname;
$user->lastname = $data->lastname;
$user->email = $data->email;
$user->password = $data->password;
``` -->