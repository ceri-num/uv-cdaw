
# Objectifs du TP

Objectifs de ce TP : Implémenter l'authentification dans notre API REST.

Documentation : https://restfulapi.net/security-essentials/

Il existe différents mécanismes pour l'authentification basées sur *HTTP Authentication Schemes* : Basic, Bearer, Digest ou encore OAuth.
Pour une API RESTful, il faut :
- utiliser http**s**
- que l'authentification soit sans état i.e. l'authentication ne doit pas reposer sur les cookies ou les sessions par exemple.

<!-- - Basic. La chaîne `username:password` est encodé en Base64 (https://en.wikipedia.org/wiki/Base64) et insérée dans l'en-tête de la requête HTTP :
```
Authorization: Basic bG9sOnNlY3VyZQ==
```
Attention, le codage en Base64 n'assure aucunement la sécurité. Elle assurée par l'utilisation de http**s**. -->

Dans la suite de ce TP, nous allons modifier notre API REST pour utiliser le standard JWT (https://jwt.io/).

Ce TP s'inspire des tutoriels JWT suivants :
- https://codeofaninja.com/2018/09/rest-api-authentication-example-php-jwt-tutorial.html
- https://www.techiediaries.com/php-jwt-authentication-tutorial/

## Principe

Certaines requêtes de l'API nécessitent d'être authentifié pour que le backend exécute ce qui est attendu.
Par exemple, une requête de modification d'un utilisateur (`PUT /user/{id}`) ne réussira que si l'utilisateur qui envoie cette requête est bien authentifié soit en tant que l'utilisateur `id`, soit en tant qu'admin.
Si ce n'est pas le cas, une erreur HTTP 401 est retournée par le backend.


![Principe général de l'authentification par jeton JWT](ressources/Auth/authenticationJWT.png)

## Stockage des hashs des mots de passe

Commençons par ajouter un champs `USER_PASSWORD` dans la table `USER` de la base de données :

1. Ajouter le champs `USER_PASSWORD` dans la table `users` de la base de donnée
2. Vous devez maintenir à jour le fichier `sql/createDB.sql` par rapport à votre code PHP. Ce fichier contient le code SQL de création de la base :

```
SET foreign_key_checks = 0;
drop table if exists USER;
create table USER
(
   USER_ID       smallint not null AUTO_INCREMENT,
   USER_LOGIN			varchar(25) not null,
   USER_EMAIL   varchar(255) not null,
   USER_PASSWORD  varchar(255),
   USER_FIRSTNAME  varchar(50) not null,
   USER_LASTNAME  varchar(50) not null,
   USER_ROLE             smallint not null,
   primary key (USER_ID)
) DEFAULT CHARSET=utf8;
```

3. Ajouter des utilisateurs dans la base.
Attention, il ne faut **jamais** stocker des mots de passe en clair dans une base de données.
Le champs `USER_PASSWORD` contiendra donc le __hash__ du mot de passe de l'utilisateur.
Un algorithme de hachage est asymétrique c'est-à-dire que l'on peut calculer le `hash` d'une chaîne de caractères mais on ne peut pas (ou difficilement) retrouver la chaîne initiale à partir d'un `hash`.
Dans ce projet, le `hash` d'un mot de passe sera calculé en utilisant la méthode `BCRYPT`. Vous pouvez calculer le hash d'une chaîne de caractères :
- en utilisant un site tel que : https://bcrypt-generator.com/
- ou directement avec du code PHP :

```php
$password_hash = password_hash($password, PASSWORD_BCRYPT);
```

## Installation d'une bibliothèque PHP JWT

Il existe de nombreuses implémentations de JWT. Attention, toutes ne sont pas équivalentes en terme de fonctionnalités, de respect du standard ou encore de bugs.
Dans ce projet vous utiliserez (ce n'est pas une assurance que bibliothèque soit la meilleure) : https://github.com/firebase/php-jwt

Téléchager le zip du dépôt et décompressez l'archive dans un nouveau répertoire nommé `libs`.
Renommez les répertoires afin d'obtenir la hiérarchie suivante :

```
.
├── api.php
├── libs
│   └── php-jwt
│       ├── composer.json
│       ├── LICENSE
│       ├── README.md
│       └── src
│           ├── BeforeValidException.php
│           ├── ExpiredException.php
│           ├── JWT.php
│           └── SignatureInvalidException.php
...
```

## Implémentation du endpoint `login` et génération d'un token JWT

Nous allons ajouter un nouvel endpoint `POST /login` dans l'API Web :

```
POST /login
{
    "login" : "<login>",
    "password" : "<hashed_password>"
}
```

Ce endpoint nécessite 2 paramètres passés en JSON :
- le `<login>` de l'utlisateur qui se connecte
- `<hashed_password>` qui est le hash du mot de passe (la même méthode de hashage doit être utilisée par le back et le front, `BCRYPT` dans ce projet).

Si la base contient bien un utilisateur avec l'email `<email>` dont le hash du mot de passe est bien `<hashed_password>` alors cette requête retournera un code
de succès avec un **token JWT** ou une erreur HTTP.
Les hashs doivent être comparés avec la fonction PHP `hash_equals` et non pas `==` ou `===` pour éviter des attaques basées sur le temps de comparaison.

Travail à faire :

1. Ajouter les définitions de 2 nouvelles constantes dans `config.php` :

```php
define( 'JWT_BACKEND_KEY', '6d8HbcZndVGNAbo4Ih1TGaKcuA1y2BKs-I5CmP' );
define( 'JWT_ISSUER', $_SERVER['HTTP_HOST'] . $_SERVER['CONTEXT_PREFIX']);
```

2. Ajouter `controller/LoginController.php` avec le code suivant :

```php
<?php
include_once __ROOT_DIR . '/libs/php-jwt/src/BeforeValidException.php';
include_once __ROOT_DIR . '/libs/php-jwt/src/ExpiredException.php';
include_once __ROOT_DIR . '/libs/php-jwt/src/SignatureInvalidException.php';
include_once __ROOT_DIR . '/libs/php-jwt/src/JWT.php';
use \Firebase\JWT\JWT;

class LoginController extends Controller {

   public function __construct($name, $request) {
      parent::__construct($name, $request);
   }

	public function processRequest() {
      if($this->request->getHttpMethod() !== 'POST')
         return Response::errorResponse('{ "message" : "Unsupported endpoint" }' );

      $json = $this->request->jsonContent();

      if(!isset($json->pwd) || !isset($json->login)) {
         $r = new Response(422,"login and pwd fields are mandatory");
			$r->send();
      }

      $user = User::tryLogin($json->login);
		if(empty($user) || !hash_equals($json->pwd,$user->password())) {
			$r = new Response(422,"wrong credentials");
			$r->sendWithLog();
      }

      // generate json web token
      $issued_at = time();
      $expiration_time = $issued_at + (60 * 60); // valid for 1 hour

      $token = array(
         "iat" => $issued_at,
         "exp" => $expiration_time,
         "iss" => JWT_ISSUER,
         "data" => array(
            "id" => $user->id(),
            "firstname" => $user->firstname(),
            "lastname" => $user->lastname(),
            "email" => $user->email()
         )
      );

      $jwt = JWT::encode( $token, JWT_BACKEND_KEY );
      $jsonResult = json_encode(
            array(
               "jwt_token" => $jwt
            )
      );

		return Response::okResponse($jsonResult);
	}
}
```

3. Testez une requête `POST /login` avec des identifiants valides afin d'obtenir un token JWT :

```
{
    "jwt_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDU2NDMyNDYsImV4cCI6MTYwNTY0Njg0NiwiaXNzIjoiaW8iLCJkYXRhIjp7ImlkIjpudWxsLCJmaXJzdG5hbWUiOm51bGwsImxhc3RuYW1lIjpudWxsLCJlbWFpbCI6bnVsbH19.X4PMcAyT30FtX-dkua3Jlyiv3UwEMmuta3ogoKZdBlQ"
}
```

## Émettre une requête authentifiée

Que ce soit pour tester avec Postman ou via le front-end, il faut émettre des requêtes avec le token JWT récupéré en réponse d'une authentification réussie.
Ce token doit être passé dans toutes les requêtes nécessitant de l'authentification.
Plusieurs solutions possibles pour passer le token JWT dans une requête.
Dans ce TP nous utliserons le champs *Authorization* de l'en-tête de la requête et la méthode `Bearer`. Exemple :

```
Authorization: Bearer <YOUR_JWT_TOKEN_HERE>
```

## Recevoir une requête authentifiée

Pour tester nous allons implémenter un endpoint **temporaire** `GET /validatetoken` pour tester le décodage du token JWT.

1. Ajouter la méthode  `getJwtToken` dans `Request` :

```php
// returns JWT token in Authorization header or throw an exception
public function getJwtToken() {
    $headers = getallheaders();
    $autorization = $headers['Authorization'];
    $arr = explode(" ", $autorization);

    if(count($arr)<2)
        throw new Exception("Missing JWT token");

    $jwt_token = $arr[1];

    return $jwt_token;
}
```

2. Ajouter un controller nommé `ValidatetokenController` :

```php
<?php

include_once __ROOT_DIR . '/libs/php-jwt/src/BeforeValidException.php';
include_once __ROOT_DIR . '/libs/php-jwt/src/ExpiredException.php';
include_once __ROOT_DIR . '/libs/php-jwt/src/SignatureInvalidException.php';
include_once __ROOT_DIR . '/libs/php-jwt/src/JWT.php';
use \Firebase\JWT\JWT;

class ValidatetokenController extends Controller {

   public function __construct($name, $request) {
      parent::__construct($name, $request);
   }

	public function processRequest() {
      try {
         $jwt_token = $this->request->getJwtToken();
         // echo "jwt = $jwt_token";
         $decodedJWT = JWT::decode($jwt_token, JWT_BACKEND_KEY, array('HS256'));
         $jsonResult = json_encode(array(
             "message" => "Access granted.",
             "data" => $decodedJWT
         ));

      } catch (Exception $e){
         header('WWW-Authenticate: Bearer realm="'.JWT_ISSUER.'"');

         $jsonResult =  json_encode(array(
             "message" => "Access denied.",
             "error" => $e->getMessage()
         ));
         return Response::unauthorizedResponse($jsonResult);
      }
      $response = Response::okResponse($jsonResult);
      return $response;
	}
}
```

En envoyant une requête correcte avec un token JWT dans le header `Authorization` vous devez obtenir les informations stockée dans le token JWT ainsi :

```json
{
    "message": "Access granted.",
    "data": {
        "iat": 1605645134,
        "exp": 1605648734,
        "iss": "io",
        "data": {
            "id": "3",
            "firstname": "Luke",
            "lastname": "Skywalker",
            "email": "luke@luke.com"
        }
    }
}
```

Si vous envoyez une requête sans token JWT ou avec un token erroné, vous devez obtenir :

```json
{
    "message": "Access denied.",
    "error": "Missing JWT token"
}
```

## Modifiez `PUT /user/{id}`

1. Implémenter le endpoint `PUT /user/{id}` qui permet de modifier l'email de l'utilisateur `{id}`
2. En vous inspirant du code précédent de `ValidatetokenController`, modifier ce endpoint pour que seul l'utilisateur authentifié `{id}` puisse modifier son email

## Documentation

Mettez à jour la documentation de votre API Web en indiquant les requêtes qui nécessitent d'être authentifié et donc d'envoyer un token JWT.

