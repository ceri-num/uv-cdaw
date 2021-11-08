## Indices

Indice 1 : appeler la vue depuis un autre fichier

Indice 2 : un controlleur doit appeler la vue et doit retourner le code html générée. Regarder l'exemple.

Indice 3 : appeler le controlleur depuis le fichier qui gère les routes. Utiliser la méthode GET.

Indice 4 : faire un mix entre le dernier appel étudié et celui du début où il fallait passer des paramètres dans la route.

Indice 5 : on les utile normalement

Indice 6 : on ne touche pas à database.php. Dans .env, on doit spécifier quelle connexion on utilise et remplir les champs dont la valeur par défaut dans database.php ne sont pas les bonnes. 

Indice 9 : les clefs étragères sont créées grâce à foreignId, les varchar sont du type `string`. Il existe aussi les types `id`, `increments`, `text`, `integer`, `timestamp`, `longText`, et des options `primary`, `index`, `nullable`