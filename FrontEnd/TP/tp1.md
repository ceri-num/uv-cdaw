# JavaScript -- TP1

## Exercice 1

## Exercice 2
Make a completely stand alone event system without relying on DOM events. You will want to use a pattern like the reactor pattern.

## Exercice 3
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