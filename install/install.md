
# Configuration de votre environnement de développement

* Installer un navigateur Web : Firefox ou Google Chrome \(Edge est INTERDIT\)
* Installer VSCode - [https://code.visualstudio.com](https://code.visualstudio.com)

## git

**git** est un gestionnaire de versions décentralisé.

1. Installer git - [https://git-scm.com/downloads](https://git-scm.com/downloads)
2. Créer un compte github - [https://github.com](https://github.com)
3. Forker le dépôt [https://github.com/ceri-num/uv-cdaw-template](https://github.com/ceri-num/uv-cdaw-template) sur votre compte github en *public*
4. Renseigner l'URL de son dépôt public ici : [partage](https://partage.imt.fr/index.php/s/rXaTrsx59LPrSaJ)

Tutoriels de découverte de git:
* [Cours git](https://www.pierre-giraud.com/git-github-apprendre-cours/)
* [Livre git](https://git-scm.com/book/en/v2)
* [tuto git](https://githowto.com)
* [tuto2 git](https://learngitbranching.js.org/)
<!-- * [cours git](https://ceri-num.gitbook.io/fa-projinfo/s3-collaborative-project/git) -->


## Serveur Web

Deux solutions sont possibles pour déployer un site web en local sur sa machine.

### Logiciel tout intégré

- WAMPServer pour Windows [https://www.wampserver.com/en/](https://www.wampserver.com/en/)
- MAMP pour mac [https://www.mamp.info/en/mac/](https://www.mamp.info/en/mac/)
- LAMP pour Linux (cf. votre distribution Linux)

### Docker

1. Installer Docker - [https://docs.docker.com/get-docker/](https://docs.docker.com/get-docker/)
   Note: Utiliser Docker sous Windows n'est pas si simple [Docker on Windows](install/dockerWSL.md)
2. Installer l'extension "remote container" de VSCode
3. Ouvrir ce projet avec VSCode. Cela va automatiquement installer et exécuter les logiciels nécessaires à l'UV via l'extension "remote container" de VSCode.

### Tester son environnement

Au final, sur votre machine locale devez oblogatoirement avoir :

* Un serveur Mysql
* PhpMyAdmin accessible via une URL locale comme : [http://localhost:8080](http://localhost:8080) (attention le port peut être différent pour vous)
* Un serveur Web + PHP [http://localhost:8888/](http://localhost:8888/) (attention le port peut être différent pour vous)
* Un dossier __DOCUMENT_ROOT__ qui est la racine de votre serveur Web. Par exemple : __C:\WAMP\public_html__

### Projet CDAW

Pour réaliser les TPs et jalons du projet, vous devez :
1. Cloner votre dépôt github dans le répertoire  __DOCUMENT_ROOT__ de votre serveur Web. Par exemple : __C:\WAMP\public_html\CDAW__
2. Faire tous vos exercices de TP et votre projet dans des sous-répertoires et committer régulièrement

