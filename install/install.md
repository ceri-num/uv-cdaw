
# Configuration de votre environnement de développement

* Installer discord [https://discord.com/](https://discord.com/)
  S'inscrire sur le discord de l'UV avec un pseudo "Prenom NOM" \(cf. lien d'invitation sur MLS\)

* Installer un navigateur Web : Firefox ou Google Chrome \(Edge est INTERDIT\)

### git

**git** est un gestionnaire de versions décentralisé.

1. Installer git - [https://git-scm.com/downloads](https://git-scm.com/downloads)
2. Créer un compte github - [https://github.com](https://github.com)

Tutoriels de découverte de git:
* [Cours git](https://www.pierre-giraud.com/git-github-apprendre-cours/)
* [Livre git](https://git-scm.com/book/en/v2)
* [tuto git](https://githowto.com)
* [tuto2 git](https://learngitbranching.js.org/)
<!-- * [cours git](https://ceri-num.gitbook.io/fa-projinfo/s3-collaborative-project/git) -->

### VSCode & Docker

1. Installer Docker - [https://docs.docker.com/get-docker/](https://docs.docker.com/get-docker/)
2. Installer VSCode - [https://code.visualstudio.com](https://code.visualstudio.com)
3. Installer l'extension "remote container" de VSCode


### Projet CDAW

Pour réaliser les TPs et jalons du projet, vous devez :

1. Forker le dépôt [https://github.com/ceri-num/uv-cdaw-template](https://github.com/ceri-num/uv-cdaw-template) sur votre compte github en *public*
2. Renseigner l'URL de son dépôt public ici : [partage](https://partage.imt.fr/index.php/s/rXaTrsx59LPrSaJ)
3. Ouvrir ce projet avec VSCode. Cela va automatiquement installer et exécuter les logiciels nécessaires à l'UV via l'extension "remote container" de VSCode.
* Testez votre BD Mysql via PhpMyAdmin [http://localhost:8081](http://localhost:8081). 2 comptes sont configurés: root/root and mysql/mysql
* Testez votre serveur Web + PHP [http://localhost:8080/infos.php](http://localhost:8080/infos.php)
* Tester la connexion PHP + BD [http://localhost:8080/test-pdo/test-PDO.php](http://localhost:8080/test-pdo/test-PDO.php)
