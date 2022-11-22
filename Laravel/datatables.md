# Datatables

Transformer la table qui affiche les pokemons en datatables (<a href="https://datatables.net/" target="_blank">aide</a>)

Bien découper son code : 
* la route dans web.php appelle le controlleur
* le controlleur appelle le modèle qui récupère les infos dans la table (<a href="https://laravel.com/docs/8.x/eloquent" target="_blank">aide sur les requêtes eloquent</a>)
* le controlleur appelle la vue en lui passant les pokemons
* la vue construit la table
* le template contient tous les appels css et js communs à toutes les vues (@yield('style') et @yield('script')) 
* le javascript de la datatable se trouve dans un fichier js à part (dans public/js)
* la vue étend le template et complète les parties style et script pour appeler le css et js de la datatable ainsi que son js qui conient l'initialisation de la table
