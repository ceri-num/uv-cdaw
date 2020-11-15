# TP JavaScript

## TP Objective

* Reflect on your front end project
* * Prerequisites
* * Features
* * Modelisation
* * ...
* Promise: first use
* Asynchronous communication
* Events handling
* Object oriented programming

The main objective of these few exercices is to guide you for the realisation of your project. If you finish these exercices, continue to develop the model of your front end (*i.e.* your classes and their interraction, without taking into account your view).

Except for the first exercice, you can do the exercices in the order of your choice. This is not important, since you will had a strong thought of your front end app.

{% hint style="info" %}
Since we will introduce SPA in the future exercices, these ones are deliberately JS oriented and do not suggest you to make any "fancy" rendering.
{% endhint %}

## Exercice 1
{% hint style="danger" %}
Take some time to think abour your front end! This is maybe the most important part of all the developpement you will done. Try to identify the features of your front end, how they can be performed, in which order. How your front end will comunicate with your back end, how your classes will work together, etc. **THIS CANNOT BE DONE -- AND SHOULD NEVER BE DONE** during the developpement of your application. Despite the fact that some (major) revisions may appear during the process, this preliminary thinking will serve you as the backbone of **all** your developpement.
{% endhint %}

{% hint style="info" %}
To help you modelise your thoughts, you can use UML diagram.
* Use case diagram, for identifying user's interaction and pointing relation between him and your use case
* Sequence diagram, to identify when your front end needs to comunicate with your back end
* Class diagram, to modelise your classes and how they will work together
{% endhint %}

<!--## Exercice 2
Make a completely stand alone event system without relying on DOM events. You will want to use a pattern like the reactor pattern.-->

## Exercice 2
This section concerns promise and asyncrhonous communication.

### Exercice 2.1
Your objective here is to implement the player timer of your game, using `setTimeOut`. If it goes to 0, then a tile should be thrown, and the player's turn ended. Do not forget to consider that:
* If the player makes a move, the timeout should be aborted (or at least not taken into consideration)
* Mind that your application should be playable when the timer is running.

You can use the concept of closure to help you in this task.

{% hint style="info" %}
Maybe you will come up with a better approach than `setTimeOut` to handle this feature. Can you see the possible drawback of using `setTimeOut` in your **own** application?
{% endhint %}

### Exercice 2.2
Here, you will try to make your authentication form! If your database is already setup (and have a user), you will be able to use it! Otherwise, you can use fake data (for example using the GitHub API).

1. First, create your HTML form for login into your app. It will probably be a simple "Pseudo/Email", "Password" form, though. Then, once submitting the form, and while using the `Fetch` API, retrieve the corresponding user on your back end. If you don't have your back end yet, try to retrieve a GitHub user more elegantly than in the course.
2. Create a registration form with mandatory fields (pseudo, password, ...). Then, save the user into your front end (**ONLY IF** this function already exists in your back end).
3. Allow a **connected** user to upload an avatar to your backend.

## Exercice 3
This section is mostly event related.

### Exercice 3.1
To familiarise yourself with events, and DOM manipulation, consider the following html code. Lets imagine for an instant that this is how you will represent your game model.
```html
<div id="board">
  <div id="p1">
    <div class="avatar info"><img id="img" src=""/></div>
    <div class="hand">
      <button class="tile" data-value="5" data-family="bamboo">5 b</button>
      <button class="tile" data-value="5" data-family="bamboo">5 b</button>
      <button class="tile" data-value="5" data-family="bamboo">5 b</button>
    </div>
    <div class="actionZone">
      <p> Action zone </p>
      <div class="pon" data-turn="3" data-status="visible">
        <!--Some tiles here-->
      </div>
    </div>
  </div>
</div>
<button id="drawForExample"></button>
```
Once you will click on the `drawForExample` you will draw a new 5 bamboo (represented in your view as `<button class="tile" data-value="5" data-family="bamboo">5 b</button>`). Since you will have four identic tiles, you automatically call a hidden *Kan*, placing all your tiles into your "action zone".

The objectives are the following:
* On hover of the user `img`, insert the number of tiles available in the hand in the parent `div` of `img`
* Handle the click for `drawForExample` and attach it a method inserting the drawn 5 bamboo into the `hand`
* Attach a listener to the `hand`. Its callback should check if four identicaly tiles are presented and if so, call `theFollowingMethod`. Additionnaly, you should indicated at which turn the *Kan* has been made (cf. the `pon` div).
* `theFollowingMethod` is design to move all the given tiles to the `actionZone` div.

{% hint style="info" %}
To listen to DOM modification, you can use the `MutationObserver` interface. [Here](https://developer.mozilla.org/en-US/docs/Web/API/MutationObserver) are some documentation.
{% endhint %}

### Exercice 3.2
We will suppose that in your app, you will have a top-right corner menu for your user -- like most in the website nowadays. Imagine that this menu varies when you are in game (*e.g.* a pause option is available), creating a game (*e.g.* authorising hot-join) or in a lobby. Your objective here is to handle all the events using an event delagation pattern.

## Exercice 4
This section is OOP related.

### Exercice 4.1
For now, your objective is to create a new class `User` dedicated to store all user related information (mostly received from the back end). If you have made the **Exercice 2.2**, try to update the code so that when you retrieve the user, all data are stored as attributes of the instance of your object.

{% hint style="info" %}
Don't forget to implement `get`ter and `set`ter for your class.
{% endhint %}

### Exercice 4.2

#### Exercice 4.2.1
Using inheritance, create a `Tile` class, then its direct child class `RichiiTile`. This `RichiiTile` class will have child classes as well, such as `BambooTile`, `WindTile`, etc. Don't forget to set define their attribute at the correct level!

#### Exercice 4.2.2
Using mixins, we will perform a multipe inheritance for the `RichiiTile` class. Lets imagine that we have an object handling the flipping of any element of your game: this behaviour is particularly interesting for our tiles! Firstly, define a new object `Flippable`.

```js
let Flippable = {
  faceUp: false,

  toggleVisibility()
  {
    this.faceUp != this.faceUp;
  },

  hide()
  {
    this.faceUp = false;
    load("path/to/rsc"+back+".svg");//this is not so generic for the moment.
  },

  visible()
  {
    this.faceUp = true;
    load("path/to/rsc"+this.name+".svg");//imaginary load function. We use the name of the element that use it as a mixin
  }
}
```
Then, using `Object.assign`, try to assign this `Flippable` behaviour to your tiles!

{% hint style="info" %}
The naming convention here (-able) is borrowed from Java interface. But sometimes, it sounds and looks ugly :p
{% endhint %}

#### Exercice 4.2.3
In the exercice, we will rely on polymorphism principle to create the wall.
Create a new `Wall` class. It should stores all the tiles of a game. Amongst its methods, create one called `initialize` and another called `pickTile`. The first one create a wall with the appropriate number of tiles (and randomized too). The second one, `pickTile` represents the action of picking up the first pickable tile in the wall.

In this method, alert the user with the family of the tiles he/she drawn (*e.g.* "You picked a Bamboo" or "You picked a Dragon").

{% hint style="info" %}
You can also think your wall as a parent class of a dead wall (the wall with the tile returned announcing the dora) and an "active" wall where tiles are actually picked from. If the active wall as 0 tiles, the game is over for example.
{% endhint %}

#### Exercice 4.2.4
Hyaku will probably be one of the most difficult part to implement without thinking them a little. Here I suggest you to handle Hyakus as classes owning there verification logic.

{% hint style="info" %}
Maybe there is a better way to do it for your project! Do not hesitate to think about it!
{% endhint %}

We will have a parent class `Hyaku`, with an empty constructor and a `verify(hand, zone)` (or whatever the name is) method, returning a boolean. The `zone` parameter contains all the tiles already "used" and visibile, such as visible pung. Then, for each type of hyaku, you can define a new class, like `HyakuFullPung`, and surcharge the definition of the `verify` method. Then, you just have to globally declare an instance of each type of hyaku in an array and, using polymorphism, check which hyaku is true.

{% hint style="info" %}
You maybe have noticed that, with this current definition of the `verify` method, you cannot know if you have a hyaku until you pick the tile from your opponent. For example, full pung will not work until you pick the opponent tile.
{% endhint %}
### Exercice 4.2.5
Try to implement a generator for your `Wall` object, such that when you do `myWall.next()` you generate the next tile, and draw it.

{% hint style="info" %}
It is up to you to conserve the generator approach in your final release. 
{% endhint %}

## Exercice 5
Using Mixins, create an event mixing object handling subscription to specific event, trigerring and cancel the subscription.

The object should have three methods :
* `.on(eventName, handler)`: assigns function handler to run when the event with that name occurs (you can store this in a protected field like `_eventHandlers[eventName]`).
* `.off(eventName, handler)`: cancel the subsectiption of the handler on the specified event.
* `.trigger(eventName, ...args)`: generates the event: all handlers from `_eventHandlers[eventName]` are called, with a list of arguments `...args`.

Usage :
```js
// Make a class
class Menu {
  choose(value) {
    this.trigger("select", value);
  }
}
// Add the mixin with event-related methods
Object.assign(Menu.prototype, eventMixin);

let menu = new Menu();

// add a handler, to be called on selection:
menu.on("select", value => alert(`Value selected: ${value}`));

// triggers the event => the handler above runs and shows:
// Value selected: 123
menu.choose("123");
```