---
author: Alexis Lebis
---

# Front end & SPA

## TP Objective
From now on, we suppose your backend is fully configurated and you can now query it.

* Perform your first authentication to your server
* Handle JWT token
* Create your first SPA
* Create components and use them
* Manage routes for your SPA

The objective of these exercices is to give you some hints for the refactoring of your front end toward a SPA. They will also emphasize some aspects of the front-back communication.

## Exercice 1

### Exercice 1.1
{% hint style="danger" %}
We never, ever, store passwords in clear, either in database or anywhere else! Instead, we use a bijective function on this password to produce a hash and, with the correct passphrase, decrypt this hash to obtain the password in clear. The passphrase should only be known by the user.
{% endhint %}

If you did not think about that yet, we will improve our login/registering form by hashing the user's password. To do that, we will use the `bcrypt` algorithm. An implementation of this algorithm, used a lot too, is the [bcrypt npm package](https://www.npmjs.com/package/bcrypt).

Thus, using the `hash()` function of `bcrypt`, hash the password -- entered in clear in the password field -- before sending it to the server endpoint. Take some times to understand how the function works.

{% hint style="info" %}
Denpending on how you perform your authentication, maybe you will need the `compate()` function too.
{% endhint %}

### Exercice 1.2
The idea here is to work with the JWT received from your backend once logged in. Generally speaking, JWT must be provided in the header of your query to the endpoint. Consequently, when accessing protected content, you will need to programmatically attach your JWT in your `fetch` command.

First, a point about the pattern used for JWT. According to the standard introduced by the W3C in HTTP 1.0, your header should have the following field:
```html
Authorization: <type> <credentials>
```
A direct consequence of this is that web sites that use this pattern are more than likely to implement OAuth 2.0 bearer tokens. Maybe your server implements this framework too (more infos on [OAauth 2.0](https://tools.ietf.org/html/rfc6749)). In that case, you will probably need the `Bearer` type prefixing your authentication token, like:
```js
Authorization = "Bearer " + authToken
```

Thus, you need to attache this `Authorization` field to the header of your fetch command.

## Exercice 2

## Ex x
Don't forget ! Since your web app is a SPA, this means when you change the main composant, you are not obliged to lost all the ifnormation in it. Usefull for the game