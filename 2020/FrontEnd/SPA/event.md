---
author: Alexis Lebis
---
# Event handling in Vue.js

This is just an overview of event handling in Vue.js. For more information, check the [event documentation](https://vuejs.org/v2/guide/events.html) and the [custom event documentation](https://vuejs.org/v2/guide/components-custom-events.html).

## Event
Vue.js change the event listener (handler) paradigm, and how and where they should be introduced in the code. The frameworks encourages listener to be DOM-free manipulation and focus only on logic. To achieves this, the listener are now attached directly to HTML document using the `v-on` directive. An advantage is it's easier to locate handler function by skimming your HTML template instead of the JS code, another is that Vue.js handle all the creation and desctruction of the listeners.

Easily enough, an event is handle using the `v-on` directive, followed by `:eventName` the name of the event to listen to. This is directly followed by `="method"` the handler to call for the specified event.

```html
<template>
<div id="example-1">
  <button v-on:click="incrementCounter">Add 1</button> <!--incrementCounter is a method of the component-->
  <p>Button click {{ counter }} times.</p>
</div>
</template>
```

However, the method needs to be defined in the component using the `methods` attribute:
```js
export default {
  name: 'HelloWorld',
  data: {
          counter: Number,
    }
  methods: {
      incrementCounter: function(event){
          alert("Hey! I'm the incrementor, the one we call to increment you");
          this.counter++;
          if(event)
            alert(event.target.tagName)
      }
  }
```

We can even use event modifiers to change the default behaviour of an event, *e.g.* `event.preventDefault()` for a form. Vue.js introduces a list of keywords related to the event modifier, and to use them, suffix your directive by the keyword, like `v-on:submit.prevent="onSubmit"`.

## Custom event
You can fired custom event using Vue.js. To do so, you can use the `this.$emit("myEvent")` function call. This will fire the event "myEvent", which can be handle with the `v-on` handler.

{% hint style="warning" %}
Despite it is the case for almost everything in Vue.js, the name of an event **is not** transformed automatically into kebab-case name (`my-event`) in the template. You must refert it by its actual name. Consequently, it is recommended to **always** use kebab-case for events.
{% endhint %}

```html
<my-component v-on:myEvent="doSmth"></my-component>
``` 

## Introducing two way binding for a prop 
{% hint style="warning" %}
Two-way binding, if badly executed, can cause undesired behaviors, time consuming debuging session and even disastrous performance. Use it carefully!
{% endhint %}

To reduce the impact of the mentioned issues, Vue.js strongly recommend the use of events to update a parent data.
For example:
```js
this.$emit('update:pseudo', newPseudo)
```
{% hint style="success" %}
A good practice is to prefix your update event with `update:`. Like that, you will know that this kind of event is only used as for the double way binding mecanism.
{% endhint %}

It's used as follow:
```html
<text-document
  v-bind:pseudo="user.pseudo"
  v-on:update:pseudo="user.pseudo = $event" # JS interpretation here: we store the value of the $event received into the pseudo.
></text-document>
```

For convenience, Vue.js introduced the `.sync` keyword which do exatcly the same thing, but is a shorthand for above (supposing that your event is called `update:theNameOfTheData`).
```html
<text-document
    v-bind:pseudo.sync="user.pseudo"
></text-document>

```

https://vuejs.org/v2/guide/components-custom-events.html#sync-Modifier