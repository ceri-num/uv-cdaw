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

In this simple exercice, you will create your first Vue.js project. To do so use the CLI scafolder : follow the instructions in the [Project setup](setup.md), no more no less.

{% hint style="success" %}
Take time to explore and understand the source code automatically generated!
{% endhint %}

## Exercice 3

In this exercice, you will create a new component designed to handle the loggin display for an user. More precisely, we want to display different information whether or not the user is logged in. Usually, this kind of component is in the top right corner of your website. For example, if the user is logged, we want to display its avatar and its pseudo, and when clicked -- or hovered, the component displays an option menu (which can be another component). In the other case, if the user is not logged in, we want to notify it and, if clicked, display to him/her either the loggin form and the registration form (both other components).

![Example of the component behavior when not logged.](resources/full_not_log.png)

This kind of component is usefull to allow user to browse your website while not being authenticated to your website, and quickly do so when required. It could become handy for your project, depending on how your plateform will be accessible.

To realize such a component you will need:

1. Create a new component
2. Templating your component according to the existance or not of an object (here, the user)
3. Display the correct block (instead of a HTML block, it could also be another component dedicated either to display the user pseudo and avatar, or a placeholder and the login message).
4. Handle the hover event, in order to display the menu. In the above figure, this will make visible the *Deja Client?* and *Nouveau Client?* components if the user is not connected yet.

{% hint style="info" %}
It is strongly to make the login/registering as component, since you will be able to use them anywhere on your application, and embed all the asynchronous communication within it.
{% endhint %}

{% hint style="info" %}
A good trick consists of defining a `fullPage` boolean property, conditionning how your login/registering component renders (either in full page or not). Like this, you can both use it as a component in your component dedicated to display login information in the header, or in full page.
{% endhint %}

## Exercice 4
In this exercise, you will familiarise yourself with routing. You will first implement a new route to display user information, then define the route used for playing a majhong game.

{% hint style="warning" %}
Take care! Defining routes is a complex task! You really should have correctly modelise your app beforehand, otherwise you will face problems especially in complex situation involving nested routing! 
{% endhint %}

First, you need to know how your users will be accessed in your application, to define the route accordingly. I suggest you something simple and readable in the URL, like `/user/`. Accessing any user will be made by adding its pseudo (***iif*** it is unique in your database and did not has special characters! Otherwise, use something else such as id), like `/user/pseudo`. That means we have identified our dynamic segment: `pseudo`.
Then, define a new component used to display user information (no need for it to be exhaustive, you will be able to enrich it later). Make an query to your user endpoint to retrieve the corresponding user and customise your page accordingly.

{% hint style="info" %}
To improve performance, instead of querying your endpoint if the user profile accessed is the one of the logged user, you could user the `params` property. More info [here](https://router.vuejs.org/guide/essentials/dynamic-matching.html#reacting-to-params-changes) and [here](https://stackoverflow.com/questions/62755202/how-to-pass-object-in-another-component-and-redirect-in-vuejs).
{% endhint %}

Now, do the same and define a game component, used for a majhong game. Think carefully about the props of such a component, as well as its dynamic segment. For example, making a dynamic segment on the `id` of the game will allow you to handle futur spectating mode, but will require that you have permission implemented. Indeed, any user can type `game/12345` and land in a game.

## Exercice 5
In this section I will suggest you some way of handling administration. Since this is a dangerous role (a missclick can happen), I suggest you to make the administration role toggable in the client side as well. This means that the administration options and additionnal administration components will only appear once the administration role has been toggled on (and this is possible ***iif*** the user is indeed an admin).

A good way to do that firstly to make a toggleable component (like a bubble button on the top left corner) always visible to the admin. If the user is not the admin, it does not see it. When clicking on it, administration options and components appears. To do so, you have to manage a boolean variable (*e.g.* `hasAdminRight`) and give it to all your components that requires administrator privileges, unlocking additional features. 

## Exercice 6
This isa more advanced exercice. Don't forget! Since your web app is a SPA, that means you want a smooth navigation and the user can expect that switching from a current game to its profile and coming back to the game will not affect the game at all (no desynchronisation, no reload of the game, no forfeit...). To do so, you need to configure your component to run behind the scene, and when reloaded, not refreshing it. A good entry point to this problem is [here](https://vuejs.org/v2/guide/components-dynamic-async.html).