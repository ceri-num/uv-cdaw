
# Objectifs du TP

Objectifs de ce TP : Refactoriser votre implémentation REST d'un CRUD en utilisant le patron architectural MVC.

{% hint style="alert" %}
Lire, comprendre et poser des questions sur le cours MVC : https://partage.imt.fr/index.php/s/XqStmtBMSswB3Tx
{% endhint %}

# Arborescences des fichiers


```
.
├── api.php                     root-endpoint de votre API REST
├── classes                     Contient les classes de base (MyObject, DatabasePDO, Request, AutoLoader,...)
│   ├── AutoLoader.class.php
│   ├── DatabasePDO.class.php   Objet Singleton pour la connexion à la base
│   ├── Dispatcher.class.php
│   ├── Request.class.php
│   └── Response.class.php
├── config                      Contient les fichiers de configuration de l'application
│   └── config.php
├── controller                  Contient les définitions des classes de la couche controleur
│   ├── Controller.class.php
│   ├── DefaultController.class.php
│   └── UsersController.class.php
├── model                       Contient les définitions des classes de la couche Modèle
│   ├── Model.class.php
│   ├── Role.class.php
│   └── User.class.php
├── README.md
└── sql
    ├── createDB.sql
    ├── Role.sql.php
    ├── sample.sql
    └── User.sql.php
```

## `api.php`

Le code complet est :

```php

<?php

	// define __ROOT_DIR constant which contains the absolute path on disk
	// of the directory that contains this file (index.php)
	// e.g. http://eden.imt-nord-europe.fr/~luc.fabresse/index.php => __ROOT_DIR = /home/luc.fabresse/public_html
	$rootDirectoryPath = realpath(dirname(__FILE__));
	define ('__ROOT_DIR', $rootDirectoryPath );

	// Load all application config
	require_once(__ROOT_DIR . "/config/config.php");

	// Load the Loader class to automatically load classes when needed
	require_once(__ROOT_DIR . '/classes/AutoLoader.class.php');

	// Reify the current request
	$request = Request::getCurrentRequest();
	Response::interceptEchos();

	try {
		$controller = Dispatcher::dispatch($request);
		$response = $controller->execute();
	} catch (Exception $e) {
		$log = Response::getEchos();
		$log .= " " . $e->getMessage();
		$response = Response::errorResponse($log);
	}

    $response->send();
```

## `Autoloader`

PHP ne charge pas automatiquement les définitions de classes. Il faut faire un require_once
avec le chemin du fichier qui contient la définition d’une classe avant de pouvoir l'utiliser. Nous
allons ajouter une classe AutoLoader qui va inclure automatiquement le fichier de définition d’une
classe lorsque celle-ci est utilisée.

Compléter le code :
```php
class AutoLoader {

	public function __construct() {
		spl_autoload_register( array($this, 'load') );
		// spl_autoload_register(array($this, 'loadComplete'));
	}

	// This method will be automatically executed by PHP whenever it encounters an unknown class name in the source code
	private function load($className) {

        // TODO : compute path of the file to load (cf. PHP function is_readable)
        // it is in one of these subdirectory '/classes/', '/model/', '/controller/'
        // if it is a model, load its sql queries file too in sql/ directory

	}
}

$__LOADER = new AutoLoader();
```

## `Request`

La classe `Request` represente les requêtes HTTP.  Cet objet `Request` devra faciliter l'accès
aux paramètres de la requête (GET, POST, ...).

Compléter le code :
```php
<?php
class Request {

	protected $controllerName;
	protected $uriParameters;

    public static function getCurrentRequest(){
       // TODO
    }

   public function __construct() {
      $this->initBaseURI();
      $this->initControllerAndParametersFromURI();
   }

   // intialise baseURI
   // e.g. http://eden.imt-nord-europe.fr/~luc.fabresse/api.php => __BASE_URI = /~luc.fabresse
   // e.g. http://localhost/CDAW/api.php => __BASE_URI = /CDAW
   protected function initBaseURI() {
      // $this->baseURI = TODO
   }

   // intialise controllerName et uriParameters
   // controllerName contient chaîne 'default' ou le nom du controleur s'il est présent dans l'URI (la requête)
   // uriParameters contient un tableau vide ou un tableau contenant les paramètres passés dans l'URI (la requête)
   // e.g. http://eden.imt-nord-europe.fr/~luc.fabresse/api.php
   //    => controllerName == 'default'
   //       uriParameters == []
   // e.g. http://eden.imt-nord-europe.fr/~luc.fabresse/api.php/user/1
   //    => controllerName == 'user'
   //       uriParameters == [ 1 ]
   //
   // Aide :
   // En utlisant la fonction PHP phpinfo et en faisant des tests
   // http://localhost/info.php/test/test
   // on peut voir que
   // $_SERVER['SCRIPT_NAME'] donne le préfixe
   // et que parse_url($_SERVER['REQUEST_URI']
   protected function initControllerAndParametersFromURI(){

      // $this->controllerName = TODO
      // $this->uriParameters = TODO
  }

   // ==============
   // Public API
   // ==============

	// retourne le name du controleur qui doit traiter la requête courante
   public function getControllerName() {
      return $this->controllerName;
   }

	// retourne la méthode HTTP utilisée dans la requête courante
   public function getHttpMethod() {
      return $_SERVER["REQUEST_METHOD"];
   }

}

```

## `Response`

La classe `Response` sert à faciliter l'envoie de réponse HTTP avec différents codes et contenus.
Elle intègre également un mécanisme pour intercepter tous les echos et éventuellement les envoyer plus tard dans la réponse (cf. doc PHP `ob_start`, `ob_get_contents` et  `ob_get_clean`).

```php
<?php
class Response {
   protected $code;
   protected $body;

   public function __construct($code = 404, $msg = "") {
      $this->code = $code;
      $this->body = $msg;
   }

   public static function errorResponse($message = "") {
      return new Response(400,$message);
   }

   public static function serverErrorResponse($message = "")
   {
      return new Response(500,$message);
   }

   public static function okResponse($message = "")
   {
      return new Response(200,$message);
   }

   public static function notFoundResponse($message = "")
   {
      return new Response(404,$message);
   }

   public static function errorInParametersResponse($message = "")
   {
      return new Response(400,$message);
   }

   public static function interceptEchos() {
      ob_start();
   }

   public static function getEchos() {
      return ob_get_contents();
   }

   public function send() {
      // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Origin
      header("Access-Control-Allow-Origin: *");

      header("Content-Type: application/json; charset=UTF-8");

      // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Methods
      header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");

      header("Access-Control-Max-Age: 3600"); // Maximum number of seconds the results can be cached.

      // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Headers
      header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

      http_response_code($this->code);
      ob_get_clean();
      echo $this->body;
      exit; // do we keep that?
   }
}
```

## `Dispatcher`

Le dispatcher courant doit permettre d’aiguiller la requête courante sur le bon contrôleur en fonction des paramètres de la requête.
Pour cela, il instancie la classe correspondant au contrôleur courant et passe des paramètres à son contructeur.

Compléter le code :
```php
<?php

/*
* Analyses a request, created the right Controller passing it the request
*/

class Dispatcher {

	public static function dispatch($request) {
		return static::dispatchToController($request->getControllerName(),$request);
	}

	public static function dispatchToController($controllerName, $request) {
      // TODO
      // une requête GET /users doit retourner new UsersController($controllerName, $request)
      // une requête GET /user/1 doit retourner new UserController($controllerName, $request)
	}
}
```

## `Controller`

```php
<?php

/*
* A Controller is dedicated to process a request
* its responsabilities are:
* - analyses the action to be done
* - analyses the parameters
* - act on the model objects to perform the action
* - process the data
* - call the view and passes it the data
* - return the response
*/

abstract class Controller {

	protected $name;
	protected $request;

	public function __construct($name, $request) {
		$this->request = $request;
		$this->name = $name;
	}

	public abstract function processRequest();

	public function execute() {
		$response = $this->processRequest();
		if(empty($response)) {
			// $response = Response::serverErrorResponse("error processing request in ". self::class); // Oh my PHP!
			$response = Response::serverErrorResponse("error processing request in ". static::class);
		}
		return $response;
	}


}
```

## DefaultController

Le contrôleur par défaut retourne une réponse d'erreur.

```php
<?php

class DefaultController extends Controller {

   public function __construct($name, $request) {
      parent::__construct($name, $request);
   }

	public function processRequest() {
      return Response::errorResponse('{ "message" : "Unsupported endpoint"}' );
	}

}
```
Tester votre code via l'URL : http://localhost/cdaw/api.php
Vous devez obtenir une réponse HTTP contenant le JSON suivant :

```json
{ "message" : "Unsupported endpoint" }
```

## `UsersController`

Voici le code incomplet de `UsersController` :

```php
<?php

class UsersController extends Controller {

	public function __construct($name, $request) {
		parent::__construct($name, $request);
	}

	public function processRequest()
    {
         switch ($this->request->getHttpMethod()) {
            case 'GET':
				return $this->getAllUsers();
                break;
        }
        return Response::errorResponse("unsupported parameters or method in users");
    }

    protected function getAllUsers()
    {
        $users = User::getList();
        // TODO
        return $response;
    }
}
```

Pour compléter le code de la méthode `getAllUsers` afin qu'une requête `GET /api.php/users` retourne tous les utilisateurs de la base en JSON, vous devez d'abord :
- créer les classes modèles : `Model`, `User`
- créeer la classe `DatabasePDO`

## `DatabasePDO`

```php
<?php

class DatabasePDO extends PDO {

   protected static $singleton = NULL;

   public static function singleton(){
      if(is_null(static::$singleton))
         static::$singleton = new static();

      return static::$singleton;
   }

   public function __construct() {
	   // $db = new PDO("sqlite::memory");

	   $connectionString = "mysql:host=". DB_HOST;

	   if(defined('DB_PORT'))
		   $connectionString .= ";port=". DB_PORT;

	   $connectionString .= ";dbname=" . DB_DATABASE;
	   $connectionString .= ";charset=utf8";

      parent::__construct($connectionString,DB_USERNAME,DB_PASSWORD);
      $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
}
```

## `Model`

Créer une classe Model qui sert à factoriser les éléments communs à tous vos modèles. Par
exemple, toutes vos classes de modèle devront communiquer avec la base de donnée. Pour cela, les
modèles utiliseront l’unique objet permettant d’accéder à la base de données qui est instance de
DatabasePDO.

Implémentation **partielle** de classe Modèle :

```php
<?php

class Model {

   protected $props;

	public function __construct($props = array()) {
		$this->props = $props;
	}

	public function __get($prop) {
		return $this->props[$prop];
	}

	public function __set($prop, $val) {
		$this->props[$prop] = $val;
	}

	protected static function db(){
		return DatabasePDO::singleton();
	}

	// *** Queries in sql/model.sql.php ****
	protected static $requests = array();

	public static function addSqlQuery($key, $sql){
		static::$requests[$key] = $sql;
	}

	public static function sqlQueryNamed($key){
		return static::$requests[$key];
	}

	protected static function query($sql){
		$st = static::db()->query($sql)  or die("sql query error ! request : " . $sql);
		$st->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class());
		return $st;
	}

	protected static function exec($sqlKey,$values=array()){
		$sth = static::db()->prepare(static::sqlQueryNamed($sqlKey));
		$sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class());
		$sth->execute($values);
		return $sth;
    }
}
```

## `User`

Implémentation partielle de la classe `User` :

```php
<?php

class User extends Model {

   protected static $table_name = 'USER';

   // load all users from Db
   public static function getList() {
      $stm = parent::exec('USER_LIST');
      return $stm->fetchAll();
   }
}
```

Exemple de fichier de requêtes pour `User` dans `sql/User.sql.php` :

```php
<?php

User::addSqlQuery('USER_LIST',
	'SELECT * FROM  USER ORDER BY USER_LOGIN');

User::addSqlQuery('USER_GET_WITH_LOGIN',
	'SELECT * FROM USER WHERE USER_LOGIN=:login');

User::addSqlQuery('USER_CREATE',
	'INSERT INTO USER (USER_ID, USER_LOGIN, USER_EMAIL, USER_ROLE, USER_PWD, USER_NAME, USER_SURNAME) VALUES (NULL, :login, :email, :role, :pwd, :name, :surname)');

User::addSqlQuery('USER_CONNECT',
	'SELECT * FROM USER WHERE USER_LOGIN=:login and USER_PWD=:password');
```

## Compléter votre MVC

Compléter le MVC en veillant à implémenter les fonctionnalités dans les bonnes couches (modèle ou controller).
Veiller aussi à généraliser au mieux votre code dans les super-classes `Model` et `Controller` pour éviter les duplications.

A faire :

- `GET /api.php/users` retourne tous les utilisateurs de la base en JSON
- `GET /api.php/user/1` retourne tous les informations de l'utilisateur 1 en JSON
- `PUT /api.php/user/1` avec du JSON en paramètre permet de mettre à jour les informations de l'utilisateur 1 dans la base
...

