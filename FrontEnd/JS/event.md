---
author: Alexis Lebis
---
# Events handling

JavaScript has been made to handle client side application, and therefore has been designed with this objective in mind. One of the principal particularity of client side is the presence of a user, needing a highly interactive interface for browsing. Consequently, JavaScript event managment has quickly become one of its strength.

## Browser events
### Event ?
An event can be seen as a signal that something has happened. All nodes from the DOM generate such signals. Below are some useful DOM events:

**Mouse events**
* `click` – when the mouse clicks on an element (touchscreen devices generate it on a tap).
* `contextmenu` – when the mouse right-clicks on an element.
* `mouseover` / mouseout – when the mouse cursor comes over / leaves an element.

**Form element events**
* `submit` – when the visitor submits a `<form>`.
* `focus` – when the visitor focuses on an element in the form, e.g. on an `<input>`.

**Document events**
* `DOMContentLoaded` – when the HTML is loaded and processed, DOM is fully built.

**CSS events**
* `transitionend` - when a CSS-animation finishes.

When such actions are performed (*e.g.* a button is clicked), we say that the click event is fired (or dispatched).

### Event handler
To react on events (*i.e.* catch a dispatched event) we can assign a handler – a function that runs in case of an event.

There is several ways to assign handlers to HTML elements. We will only see the more flexible and less error prone here: `addEventListener` (doc. [here](https://developer.mozilla.org/en-US/docs/Web/API/EventTarget/addEventListener)). As an example, lets say we have an HTML input button

```html
<input id="elem" type="button" value="Click me">
```

To handle the `click` event, we first need to retrieve our HTML element (here the input) in our JavaScript code, then attach to it our handler.

```js
var elem = document.getElementById("elem");
elem.addEventListener('click', (e) => alert(e), false);
```
{% hint style="info" %}
> ❓ Multiple call to `addEventListener` for a same HTML element will **add** the handlers. This means that you can stack several functions for one event!
{% endhint %}

### Event object
When an event is dispatched, it is often in a specific context which is important to us in order to understand what was going on. For example, in the case of a mouse click, where was the coordinate of the mouse? 

Usually, when an event happens, the browser create what it is called an **event object**. This object contains the details of the event and is passed as an argument to the handler.

```js
elem.addEventListener('click', function(e){
  alert(event.type + " at " + event.currentTarget); // shows event type, element
  alert("Coord: " + event.clientX + ":" + event.clientY); // shows coord
})
```

### Handler with an object
It is also possible to attach to a handler not a function but an object! The only prerequisite is that the object implements a `handleEvent()` method. The method also receives the event object.

```js
  let obj = {
    handleEvent(event) {
      alert(event.type + " at " + event.currentTarget);
    }
  };
  elem.addEventListener('click', obj);
```

We can also use a class to better organize our code, especially if we want to delegate the events. In the following example we listen the up and down of the mouse with a single object, and the event is then dispatched.
```js
class Menu {
    handleEvent(event) {
      let method = 'on' + event.type[0].toUpperCase() + event.type.slice(1); //we retrieve the name of the event, the we split to conserve the name for the function
      this[method](event); //look here: calling the appropriate function according to event
    }

    onMousedown() {
      elem.innerHTML = "Mouse button pressed";
    }

    onMouseup() {
      elem.innerHTML += "...and released.";
    }
  }

  let menu = new Menu();
  elem.addEventListener('mousedown', menu);
  elem.addEventListener('mouseup', menu);
```

## Creating event
JavaScript allows you to create and manually manage your own events, which prevent you to fully reimplement an event handler. They are called **synthetic events**, as opposed to the events fired by the browser itself.

{% hint style="warning" %}
> ❓ These events are **DOM events**: they rely on the DOM API of your browser, and are considered as event targets (cf. [`EventTarget()`](https://developer.mozilla.org/en-US/docs/Web/API/EventTarget)). They are not supposed to be events produced by your objects.
{% endhint %}

To create a new event, the `Event` constructor can be call

```js
var myEvent = new Event("nameEvent");
```

Then, this new type of event can be attached to any DOM elements, and listened to.

```js
domElem.addEventListener('nameEvent', function(e){/*...*/}, false);
```

And to fire the event

```js
domElem.dispatchEvent('nameEvent');
```

You can also add custom data to the event by using the `CustomEvent` constructor

```js
var myCEvent = new CustomeEvent("custom", {detail : aVar.value, name : elem.name})

// access the data as usual in the handling function
function evtHandler(e)
{
  console.log("Details are" + e.detail);
}
```

However, you will mostly rely on already existing events, such as `'click'`, `'drag'`, etc. The full list is accessible [here](https://developer.mozilla.org/en-US/docs/Web/Events).

## Bubbling events
The principle of bubbling events is the following:

> When an event happens on an element, it first runs the handlers on it, then on its parent, then all the way up on other ancestors.

```html
<form onclick="alert('form')">FORM
  <div onclick="alert('div')">DIV
    <p onclick="alert('p')">P</p>
  </div>
</form>
```
![Example of bubbling](resources/event-order-bubbling.svg)

When, lets say, a click is made on `<p>`, the `onclick` event is run firstly on `<p>`, then `<div>`, then `<form>`.
The process is called “bubbling”, because events “bubble” from the inner element up through parents like literally an air bubble in the water.

### Target of the event
An interesting point is that an event handler on a parent element can always get the details about where the event actually happened.

The `event.target` property stores the most deeply nested element that cause the event, while `event.currentTarget` stores the element where the handler is (`this`, in the example below the form).

```js
form.onclick = function(event) {
  alert("target = " + event.target.tagName + ", this=" + this.tagName);
}
```
* `event.target` – the deepest element that originated the event.
* `event.currentTarget` (=this) – the current element that handles the event (the one that has the handler on it)
* `event.eventPhase` – the current phase (capturing=1, target=2, bubbling=3).

## Patterns
All these previous notion, and mostly *bubbling*, allow us to implement powerful event handling patterns.

### Event Delegation pattern
The idea behind the event delegation pattern, is that, when several elements on an HTML page are supposed to be handled in a similar fashion, we define a single handler on their common ancestor in charge of all these elements.

{% hint style="info" %}
> ❓ One can say that web component approach emphasize this pattern by making a specific type of component self-aware of its events. Check the [single page application topic](../SPA/intro.md) for more information.
{% endhint %}

This is made possible because we have the event object with the `target` property, alowing us to see where the event actually took place in the page.

For example, imagine that we have a table, with various element inside each cell. The objective is to overlay the clicked cell.
```js
table.addEventListener('click',function(event) {
  let td = event.target.closest('td'); // returns the nearest ancestor that matches the selector.
  if (!td) return; // if the user did not click on a td, nothing to do
  if (!table.contains(td)) return; // if there is nested table, the td could not be the td of the table we are interested in, so return

  highlight(td); // highlight the cell, for example with selectedTd.classList.add('highlight');
});
```

Delegation pattern can also be used for other uses. For example, to match action in a menu. The trivial solution is to assign for each entry of the menu an handler on the click. But there is a more elegant solution to that using delegation.

For that, we will use HTML `data` attribute, attach the **handler directly to the menu** and rely on a menu object. All the logical operation will be performed directly in the object, which is a good way to structure your code.

HTML:
```html
<div id="menu">
  <button data-action="save">Save</button>
  <button data-action="load">Load</button>
  <button data-action="search">Search</button>
</div>
```

JS
```js
 class Menu {
    constructor(elem) {
      this._elem = elem;
      elem.addEventListener('click', this.onClick.bind(this)); // (1)
    }

    save() {
      alert('saving');
    }

    load() {
      alert('loading');
    }

    search() {
      alert('searching');
    }

    onClick(event) {
      let action = event.target.dataset.action;
      if (action) {
        this[action]();
      }
    };
  }

  let menu = document.getElementById("menu");
  new Menu(menu);
```
{% hint style="warning" %}
> ❓ Please note that `this.onClick` is bound to `this` in (1). That’s important, because otherwise `this` inside `onClick` would reference the DOM element (elem), not the Menu object, and `this[action]` would not be what we need (cf. [Scope and Context](advanced.md)).
{% endhint %}

### Behavior pattern
The behavior pattern rely both the delegation pattern and the `data` attribute of HTML. The idea behind this pattern is to assigne specific action to specific data-attribute, by using a top level delegation. In other words, we attach to the `document` itself a handler and verify the very existence of the attribute.
It has thus two parts:

1. We add a custom attribute to an element that describes its behavior.
2. A document-wide handler tracks events, and if an event happens on an attributed element – performs the action.

Example of counter associate with `data-counter`:
```js
Counter: <input type="button" value="1" data-counter>
One more counter: <input type="button" value="2" data-counter>

<script>
  document.addEventListener('click', function(event) {

    if (event.target.dataset.counter != undefined) { // if the attribute exists...
      event.target.value++;
    }

  });
</script>
```
{% hint style="info" %}
> ❓ You can use this approach for toggling visibility and elements on the page.
{% endhint %}