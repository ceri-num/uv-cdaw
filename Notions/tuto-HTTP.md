# HTTP

Cours : https://www.pierre-giraud.com/http-reseau-securite-cours/requete-reponse-session/

Les méthodes HTTP (verbs) les plus courantes :

* GET
    - n'attend pas contenu
    - réclame une représentation de la ressource
    - est sans effet de bord (i.e. ne modifie pas l'état de la ressource)
    - rend possible l'utilisation des caches
* POST
    - attent un contenu
    - peut avoir n’importe quel effet de bord (y compris non-idempotent)
    - est souvent utiliser pour créer une ressource sans connaître a priori son URL
* PUT
    - attend un contenu
    - demande la création ou la modification de la ressource
    - de sorte que le nouvel état de la ressource corresponde au contenu fourni
    - a donc un effet de bord idempotent
* DELETE
    - n'attend pas de contenu
    - demande la suppression de la ressource
    - a donc un effet de bord idempotent
