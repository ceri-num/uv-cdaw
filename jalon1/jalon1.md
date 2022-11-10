# Jalon 1 : Maquette statique du projet

Les objectifs de ce premier jalon sont:
- réfléchir à la maquette de votre site Web projet en analysant le sujet du projet
- réaliser une maquette __fonctionnelle__ HTML / CSS de votre projet

Normalement, deux métiers sont à distinguer :
- le web designer qui réalise une maquette du site avec des logiciels tel que Adobe XD ou autre
- le développeur front-end qui à partir d'une maquette (image, ...) réalise une maquette fonctionnelle en HTML/CSS/JS

Vous aller réaliser ces deux étapes pour votre projet.
L'idée est de vous sensibiliser à ces deux métiers distinct.

## Analyser le sujet

Prenez du temps pour :
1. Lire attentivement le sujet du projet
2. Dégagez des `users stories` (fonctionnalités utilisateurs)
3. Ordonnez ces fonctionnalités selon ce qui vous parait important. On ne peut pas réaliser un site Web d'un seul coup et il est important d'avoir un résultat fonctionnel rapidement pour montrer aux clients (les enseignants). Donc choisissez dans quel ordre vous allez réaliser les fonctionnalités. Il vaut mieux un projet incomplet qui fonctionne parfaitement et propose une expérience utilisateur paufinée plus qu'un projet plus ambitieux où rien ne fonctionne vraiment.
4. Sur __papier__, dessinez entre 5 et 10 pages de votre site, les infos qu'elles affiches, l'enchaînement des pages, ...
    - Essayer de qualifier l'expérience utilisateur : Par exemple, combien de clics pour réaliser telle action? ou encore, que voit l'utilisateur si telle erreur se produit ?
5. Prenez des photos de vos dessins et committez-les sur git dans `public/jalon1/analyse/`
6. Vous pouvez ajouter des notes dans `public/jalon1/analyse/README.md` pour mieux décrire ce que vous souhaitez réaliser et dans quel ordre.

## Réaliser une maquette

1. Choisissez un template Bootstrap CSS pour vous inspirer pour réaliser votre projet. Choisissez un thème gratuit et __simple__. Par exemple : https://startbootstrap.com/theme/freelancer
2. Installez ce template dans `public/jalon1`
3. Testez-le (http://localhost:8080/jalon1/)
4. Modifiez ce template pour réaliser une maquette des pages que vous avez imaginé précédemment. Par exemple :
   - Accueil non connecté
   - Formulaire de connexion
   - Accueil connecté avec bouton de déconnexion
   - Page de profil
   - Page d'admnistration de type CRUD avec une datatable par exemple

Vous devez remplir vos pages avec des données fictives.
Vous devez simplifier au maximum vos pages (i.e. supprimez le code que vous ne comprenez pas).
Aidez-vous des cours HTML/CSS et de la documentation de Bootstrap CSS (cf. [Bib](../infos/prerequis.md)).

- Cours HTML/CSS [https://www.pierre-giraud.com/html-css-apprendre-coder-cours/](https://www.pierre-giraud.com/html-css-apprendre-coder-cours/)
- Cours Bootstrap [https://www.pierre-giraud.com/bootstrap-apprendre-cours/menu-navigation/](https://www.pierre-giraud.com/bootstrap-apprendre-cours/menu-navigation/)
- Doc Bootstrap CSS [https://getbootstrap.com/docs/](https://getbootstrap.com/docs/)

## Travail en équipe

Après avoir réalisé une ou plusieurs pages à deux, répartissez-vous le travail.
Par exemple, vous travaillez sur deux pages distinctes.
Chacun doit commiter son travail sur le même dépôt git (celui du groupe) dans `public/jalon1`.
Cela vous entraînera à travailler en équipe et éventuellement résoudre des conflits de versions.
L'historique des versions du jalon1 doit __impérativement__ avoir des commits des deux membres du groupe.

## Livraison

Suivez les [instructions](../infos/eval.md) pour rendre ce premier jalon.
