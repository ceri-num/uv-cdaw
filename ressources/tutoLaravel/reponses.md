## Réponses

# Réponse 1
Appeler la vue depuis web.php

# Réponse 2
```php
return view('leNomDeLaVue', ['prenom' => 'Isabelle']);
```
La 1ere partie est le nom de la vue a appeler, le seconde partie est un tableau de paramètres à passer à la vue pour qu'elle puisse se construire.

# Réponse 3
L'appel du controlleur en GET
```php
Route::get('cheminDansURL', 'App\Http\controllers\MonController@laFonctionAExecuter');
```
Exemple : 
```php
Route::get('listeMedias', 'App\Http\controllers\listeMediasController@getListeMedias');
```

La déclaration de la méthode dans le controlleur `listeMediasController.php`
```php
public function getListeMedias() {
      return view('listeMedias');
  }
```

# Réponse 4
```php
Route::get('cheminDansURL\type\annee', 'App\Http\controllers\MonController@laFonctionAExecuterAvecParametres');
```
La déclaration de la méthode dans le controlleur `listeMediasController.php`
```php
public function getListeMedias($type, $annee) {
      return view('listeMedias', ['type' => $type, 'annee' => $annee]);
  }
```

# Réponse 6
Dans le .env :
```
DB_CONNECTION=mysql
DB_DATABASE=medias
DB_USERNAME=root
```

# Réponse 7
10

# Réponse 8
La commande AUTO_INCREMENT est utilisée dans le langage SQL afin de spécifier qu’une colonne numérique avec une clé primaire (PRIMARY KEY) sera incrémentée automatiquement à chaque ajout d’enregistrement dans celle-ci. (<a href="https://sql.sh/cours/create-table/auto_increment" target="_blank">source</a>).