
# Objectifs du TP

- Réaliser un programme PHP et déployer en local et sur le serveur *eden*
- Versionner avec git sur le serveur *gvipers*
- Persister des données avec MySql et PDO

## Versionner

1. Créer votre dépôt git sur github
2. Installer git sur votre machine locale (cf. [Git for Windows](https://gitforwindows.org/)) et cloner votre dépôt

Dans la suite de ce sujet, `$PROJET_CDAW` désigne l'emplacement sur disque de la racine de votre dépôt git.

## Environnement local

Pour travailler efficacement vous *devez* être capable de développer et tester localement votre site Web (sans connexion internet) sur votre machine. Pour cela, il faut installer un serveur Web avec le module PHP et le serveur de base de données MySql (SGBD utilisé dans cette UV). Installer __uWamp__ par exemple.

1. Créer le fichier PHP `$PROJET_CDAW/BackEnd/tp1/infos.php` avec le contenu suivant:
```php
<?php
    phpinfo();
```
2. Committer ce fichier dans votre dépôt git
3. Copier ce fichier dans la racine de votre serveur Web (par exemple dans `c:\uWamp\www`). Dans la suite de ce sujet, `$DOCUMENT_ROOT` désigne l'emplacement sur disque où le serveur va chercher les fichiers.
4. Tester votre installation à travers un navigateur http://localhost/infos.php.
    Cette page vous donne beaucoup d'informations importantes sur le serveur (variable globales, extensions installées, ...). C'est une source d'information importante en cas d'erreur.

{% hint style="alert" %}
Si vous placez le clone de votre dépôt git (`$PROJET_CDAW`) dans `$DOCUMENT_ROOT`, vous n'aurez pas à copier/coller vos fichiers PHP à chaque modification pour voir les changements dans votre navigateur.
{% endhint %}

## PDO (version simplifiée avec `FETCH_OBJ`)

[PHP Data Objects](tuto-PDO.md) fournit une couche d'abstraction permettant de ce connecter à une base de données.
Nous allons tester cela en local et sur *eden*.

### Créer une table users dans base locale avec PhpMyAdmin

Si vous avez installé uWamp correctement, vous avez le SGBD MySql installé ainsi que PhpMyAdmin qui permet de paramétrer vos bases de données.

1. Accéder à MySQL via l'URL : http://localhost/phpmyadmin
2. Utiliser les identifiants par défaut : root/root ou root/<vide> ou cf. doc
3. Créer une base de données nommée `dbtest` avec l'encodage *utf8_general_ci*
4. Créer une table nommée `users` avec 3 champs : id, name et email. id est la clé primaire en auto incrément. name et email sont des VARCHAR.
5. Ajouter quelques données fictives dans cette table

![Table uses dans PhpMyAdmin](/ressources/tutoPDO/users_phpmyadmin.png)

### Afficher le contenu de la table `users` avec PDO

En utilisant PHP et PDO, afficher le contenu de la table `users` sous la forme d'une tableau HTML.

Créer un fichier `$PROJET_CDAW/BackEnd/tp1/initPDO.php` avec le contenu suivant:

```php
<?php
define('_MYSQL_HOST','127.0.0.1');
define('_MYSQL_PORT',3306);
define('_MYSQL_DBNAME','dbtest');
define('_MYSQL_USER','root');
define('_MYSQL_PASSWORD','pwd');

$connectionString = "mysql:host=". _MYSQL_HOST;

if(defined('_MYSQL_PORT'))
    $connectionString .= ";port=". _MYSQL_PORT;

$connectionString .= ";dbname=" . _MYSQL_DBNAME;
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' );

try {
    $pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $erreur) {
        myLog('Erreur : '.$erreur->getMessage());
}
```

Créer et **compléter** le fichier `$PROJET_CDAW/BackEnd/tp1/test-PDO.php`:
```php
<?php
    // initialise une variable $pdo connecté à la base locale
	require_once("initPDO.php");    // cf. doc / cours

	$request = $pdo->prepare("select * from users");
    // à vous de compléter...
    // afficher un tableau HTML avec les donnéees en utilisant fetch(PDO::FETCH_OBJ)

    /*** close the database connection ***/
    $pdo = null;

```

L'objectif est de voir dans une page Web un tableau HTML qui affiche les utilisateurs stockés dans la table `users`.

![Table HTML affichant les utilisateurs stockés en base](/ressources/tutoPDO/pdo_users.png)

Si vous ajoutez ou supprimez un utilisateur dans la table `users` via PhpMyAdmin, il suffit de raffraichir la page du navigateur pour que la table HTML se mette à jour.

## Ajout d'utilisateurs dans la base

Créer un fichier `$PROJET_CDAW/BackEnd/tp1/test-PDO-post.php` qui reprend le même exercice que précédemment mais ajout un formulaire Web sous le tableau HTML qui permet d'ajouter un nouvel utlisateur dans la table `users`. Remarqez que le champ id ne doit pas être saisi par l'utilisateur car c'est un champ en auto-incrément dans la base.

![Formulaire POST d'ajout d'un utilisateur](/ressources/tutoPDO/pdo_users_post.png)

## PDO avec `FETCH_CLASS`

Reprendre l'exercice précédant en utilisant une approche plus objet via l'utilisation d'une classe `User` et  `FETCH_CLASS` de PDO.
Créer un fichier `$PROJET_CDAW/BackEnd/tp1/test-PDO-class.php` reprenant le code précédent en ajoutant une classe `User`. Cette classe doit contenir tout votre code et notamment les méthodes suivantes :

- `getAllUsers` méthode statique pour récupérer tous les utilisateurs dans la tabe `users` sous forme d'objets instances de la classe `User`
- `showAllUsersAsTable` méthode statique pour afficher tous les utilisateurs sous forme de tableau HTML
- `toHtml` méthode retournant une chaîne caractères contenant les infos de l'objet user qui reçoit le message (`$user->toHtml()`)

Découpez votre code et ajouter plus de méthodes si nécessaire. Dans votre code HTML, affichez un tableau avec l'ensemble des utilisateurs dans la base ainsi:

```php
<h1>Users</h1>
<?php
	User::showAllUsersAsTable();
?>
```

## PDO avec `FETCH_CLASS` et `PDO::FETCH_PROPS_LATE`

Créer un fichier `$PROJET_CDAW/BackEnd/tp1/test-PDO-propslate.php` reprenant le code précédent et ajoutant l'utilisation de `PDO::FETCH_PROPS_LATE`.
Modifier le code de la class `User` en conséquence. Notamment, essayer de comprendre quelles sont les variables d'instance d'un objet user par rapport à la version précédente.

## CRUD avec PDO

CRUD signifie Create, Read, Update et Delete qui sont les opérations courantes sur des données.
Créer un fichier `$PROJET_CDAW/BackEnd/tp1/test-PDO-CRUD.php` qui reprend la dernière version du TP1 et affiche un tableau avec tous les utilisateurs.
Travail à faire :

1. Ajouter un bouton permettant de créer un nouvel utilisateur (formulaire POST)
2. Pour chaque utilisateur dans le tableau, ajoutez des boutons permettant de :
- modifier cet utilisateur
- supprimer cet utilisateur

![Exemple de table avec opérations CRUD](/ressources/CRUD_REST/CRUD_table.png)

