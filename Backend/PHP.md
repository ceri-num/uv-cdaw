
![PHP](../ressources/tutoPHP/coverPHP.jpg)

# Programmation orientée Objet en PHP

## Pré-requis

Ce cours suppose que vous connaissez :

- Éléments de base PHP : boucles, fonctions, tableaux, ...
- HTTP (header, ...)
- PHP CGI (GET, POST, COOKIES, SESSION)
- traitement des formulaires Web (forms)

{% hint style="danger" %}
Auto-formation :
- cf. cours PHP de l'UV IDAW
-
- cf. [https://www.php.net/manual/en/](https://www.php.net/manual/en/)
- cf. [https://www.pierre-giraud.com/php-mysql-apprendre-coder-cours/](https://www.pierre-giraud.com/php-mysql-apprendre-coder-cours/)
{% endhint %}

## A propos

La documentation officielle est : [https://www.php.net/manual/en/language.oop5.php](Doc PHP OO). Testez les exemples en même temps que lisez en utilisant : [https://repl.it](https://repl.it) par exemple.

{% hint style="alert" %}
Cette page est en cours de migration.
Les slides originaux sont ici : [https://partage.imt.fr/index.php/s/XqStmtBMSswB3Tx](https://partage.imt.fr/index.php/s/XqStmtBMSswB3Tx)
{% endhint %}


Exercices :
- Faire tout le tutoriel [https://www.learn-php.org](https://www.learn-php.org)
- Faire qq exercices [https://exercism.org/tracks/php/exercises](https://exercism.org/tracks/php/exercises)
- Faire qq exercices de la rubrique Web Server de [https://www.root-me.org](https://www.root-me.org)

<!-- ## Les classes

```php
class Persone
{
    private $firstname;       // attribut privé
    protected $lastname;   // attribut protégé
    public $age;         // attribut public

    function __construct() { }  // contructeur
    function __destruct() { }  // destructeur

    public function maFonction() { } // Méthode publique
}
```

`private`, `protected` et `public` définissent la visibilité d’une méthode ou d’un attribut. Par défaut, un élément est `public`.

En php il est possible de déclarer des membres ou des méthodes comme statiques. La déclaration `static` doit être faite après la déclaration de visibilitée.

```php
class Personne
{
    public static $nombreDeJambes = 2;

    public static function staticFunction() {
        // ...
    }
}
```

L'opérateur `::` permet d'accéder aux champs (attributs ou méthodes) statiques d'une classe.


![PHP OO](../ressources/tutoPHP/LucDamas-PHP_OO.jpg)

![PHP](../ressources/tutoPHP/LucDamas-PHP_sale.jpg)
 -->