# Jalon 2 : site connecté

## Fonctionnalités attendues

- création de compte
- connexion via un login / mot de passe
- voir/modifier profil
- déconnexion

## Architecture logicielle

- Backend en PHP/Laravel
-- 1 modèle : User (login, password, email)
- BD avec 1 table User
- Frontend en Vue.js
-- gestion des erreurs : si mauvais mdp, ...
- API REST :
-- création de compte
-- connexion / token JWT ?
-- profil
- tests avec Postman
