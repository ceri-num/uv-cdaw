## Objectif

Réaliser une application Web pour jouer à un dérivé du jeu Pokemon. A travers cette application, vous incarnerez un joueur qui dirige des pokemons et les fait combattre contre d'autres pokemons.

## Joueur et Pokemons

Sur le site, un __visiteur__ (utilisateur non connecté) peut :

- Parcourir l'ensemble des pokemons existants (bestiaire)
- Créer un compte joueur
- Se connecter
- Consulter les stats des joueurs
- Consulter les derniers matchs et les voir en replay

Un __pokemon__:
-  a un nom (e.g Pikachu)
-  a une seule énergie (plante, électrique, eau, feu, ...)
-  a un niveau (entre 1-10)
-  un nombre de points de vie max
-  un score de dégât de son attaque normale
-  un nom d'attaque spéciale
-  un score de dégât de son attaque spéciale
-  un nom de défense spéciale
-  un score de défense de sa défense spéciale

Un __joueur__ (utilisateur connecté) :
- a un pseudo
- a un email
- a un mot de passe
- a un niveau (niveau 1 au départ). Un joueur ne peut jouer que les pokemons qui ont un niveau inférieur ou égal au sien. Un joueur gagne 1 point de niveau par 10 combats gagnés.
- maîtrise un ensemble d'énergies (plante, électrique, eau, feu, ...). Un joueur ne peut jouer que les pokemons qui ont une énergie qu'il maîtrise. Au départ, un joueur maîtrise une seule énergie tirée au hasard.

## Modes de combats

Un __combat__ consiste en l'affrontement de 2 joueurs. Lors d'un combat, chaque joueur a 3 pokemons qui vont s'affronter dans un ordre précis.

__Combat en mode aléatoire automatique__ : 3 pokemons sont tirés aléatoirement pour chacun des deux joueurs parmis l'ensemble des pokémons du bestiaire qu'il peut jouer. L'ordre dans lequel les pokemons combattent est tirés aléatoirement. Un pokémon utilisera systématiquement son attaque spéciale lors de sa première attaque et sa défense spéciale lors de sa première défense.

__Combat en choix manuel + tour par tour__ : les joueurs vont s'affronter à tour de rôle. Un tour a une durée fixe de 30s. Tours:

- Tour1 - Joueur 1 (tiré aléatoirement) : choisi son 1er pokemon
- Tour2 - Joueur 2 : choisi son 1er pokemon
- Tour2 - Joueur 2 : choisi son 1er pokemon
- Tour3 - Joueur 1 : choisi son 2eme pokemon
- Tour4 - Joueur 2 : choisi son 2eme pokemon
- Tour5 - Joueur 1 : choisi son 3eme pokemon
- Tour6 - Joueur 2 : choisi son 3eme pokemon
- Tour7 - Joueur 1 : décide de l'action de son 1er pokemon sur le 1er pokemon du Joueur 2 parmi attaque de base, attaque spéciale ou défense spéciale.
- Tour8 - Joueur 2 : décide de l'action de son 1er pokemon sur le 1er pokemon parmi attaque de base, attaque spéciale ou défense spéciale.
- ...
- Lorsque les points de vie d'un pokemon tombent à 0, il est remplacé par le pokemon suivant du joueur.
Le joueur dont tous les pokemons sont morts a perdu le combat.

__Combat en choix aléatoire + tour par tour.__ Le choix des pokemons est tiré aléatoirement mais le combat est en tour par tour.

## Gains de victoire

Lorsqu'il a gagné 1 combat, le joueur gagne une énergie.
Lorsqu'il a gagné 10 combats, un joueur gagne un niveau.

## Evolutions possibles

- __Jouer vite.__ Un pokémon régénère ses points de vie pendant la durée du tour de l'adversaire.
