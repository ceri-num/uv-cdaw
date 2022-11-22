# Tests

## Tests unitaires
- PHP Unit
Vérifier  qu'il est installé
```
php vendor\phpunit\phpunit\phpunit --version
```
- Aide
```
php vendor\phpunit\phpunit\phpunit –-help
```
ou 
https://laravel.sillo.org/cours-laravel-8-les-tests/

De base, il existe 2 répertoires de test : `Feature` et `Unit`
Dans Unit, on va y mettre les tests unitaires et dans Feature les tests plus importants (tests sur plusieurs objects, ...). Mais vous pouvez vous mettre dans l'un ou l'autre.

- Lancer les tests 
```
php artisan test
```
- Lancer un test particulier
```
php artisan test --filter ExampleTest
```

- Créer quelques tests pour tester votre application

