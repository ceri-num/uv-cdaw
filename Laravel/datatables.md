# Datatables

Transformer la table qui affiche les utilisateurs en datatable (<a href="https://datatables.net/" target="_blank">aide</a>)

Bien découper son code : 
* la route dans web.php appelle le controlleur
* le controlleur appelle le modèle qui récupère les infos dans la table (<a href="https://laravel.com/docs/11.x/eloquent" target="_blank">aide sur les requêtes eloquent</a>)
* le controlleur appelle la vue en lui passant les utilisateurs
* la vue construit la table
* le template contient tous les appels css et js communs à toutes les vues (@yield('style') et @yield('script')) 
* le javascript de la datatable se trouve dans un fichier js à part (dans public/js)
* la vue étend le template et complète les parties style et script pour appeler le css et js de la datatable ainsi que son js qui conient l'initialisation de la table

Dans le tableau, vous pouvez afficher les boutiques créées par l'utilisateur. Pour cela, vous pouvez indiquer au modèle Utilisateur qu'il y a une relation avec le modèle Boutique (voir belongsTo).
Lors de l'appel de la méthode statique qui retourne la liste des utilisateurs, ajouter la jointure à votre requête eloquent.
N'oubliez pas le get() à la fin de la requête pour récupérer les résultats.

Question : pourquoi la méthode est statique ?