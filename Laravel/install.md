# Utilisation de docker

- Récupérer votre projet GIT et le mettre dans le répertoire www de wamp

- Ouvrir le projet avec Visual Studio Code

- Dans le terminal, faire
```
> composer update

> php artisan key:generate
```

 Donner les droits à votre projet pour apache:
```
	chown -R root.www-data catalogue/
	find catalogue -type d -exec chmod 750 {} \;
	find catalogue -type f -exec chmod 640 {} \;
	find catalogue/storage -type d -exec chmod 770 {} \;
	find catalogue/storage -type f -exec chmod 660 {} \;
```

