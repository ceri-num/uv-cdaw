- Si ce n'est pas encore fait, intaller les serveurs Apache / MySQL / Php avec WAMP ou autre (suivant votre système d'exploitation).



- Installer npm (voir sur google pour votre système d'exploitation).
Pour info, commande pour mettre à jour npm
```
npm install -g npm@8.1.4
```



- Donner les droits à votre projet pour apache:
```
	chown -R root.www-data catalogue/
	find catalogue -type d -exec chmod 750 {} \;
	find catalogue -type f -exec chmod 640 {} \;
	find catalogue/storage -type d -exec chmod 770 {} \;
	find catalogue/storage -type f -exec chmod 660 {} \;
```


Pour ne pas avoir à relancer la génération des js et css à chaque fois, il est possible de faire :
```
npm run watch
```
- Attention, dans `guest.blade.php` et `app.blade.php`, remplacez `mix('css/app.css')` par `asset(mix('css/app.css'))` et `mix('js/app.js')` par `asset(mix('js/app.js'))`