
# PHP Data Objects (PDO)

http://www.php.net/manual/fr/book.pdo.php

PDO permet d’écrire du code le plus indépendant possible d’un SGBD particulier (Mysql, Oracle, Sqlite). L’idée
est de minimiser au maximum l’effort de développement en cas de changement de SGBD.

- Connectez-vous à PHPMyAdmin afin de créer une table contenant les champs suivants : id
clé primaire entière auto-incrémentée, login, password et pseudo
- Ajouter des données dans la table
- Ecrire un programme PHP dans un fichier nommé testPDO.php permettant de se connecter
à la base de données et d’effectuer la requête suivante : select * from User;. Le code PHP
doit afficher les résultats sous forme de tableau
- Ajouter de nouvelles données dans la table via PHPMyAdmin
- En rechargeant la page testPDO.php (sans modifier le code), vous devez voir ces nouvelles
données apparaître

Dans le fichier connected.php précédemment créé :
- Ajouter du code PHP afin d’utiliser la base de données plutôt qu’un tableau dans le code
PHP
- Ajouter une nouvelle page sur ce site nommée inscription.php qui permet de créer un
nouveau compte sur le site i.e. ajoute un nouvel utilisateur dans la table User