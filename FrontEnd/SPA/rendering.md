# Component Rendering
There is three things to figure out for rendering a component :
* Where this component will be placed on the page and its objectif
* What are the DOM command that can be used within the template
* How to setup the reactivity of your component, so that it becomes dynamic

{% hint style="info" %}
In this section we do not focus on binding data yet. Check the [property section](property.md) for this kind of information.
{% endhint %}

## Binding
Binding consists of linking data in the `<script>` section of your component with the `<template>` section of the same component. In Vue.js the simpliest way to bind data is to use the `{{ Mustache }}` tag (two `{`, your data, then two `}`). While the component is rendered, the tag will be replaced with the content of the data used within the mustache.

```html
<template>
    {{ user.name }} <!--will print the attribute of the variable user -->
</template>
```

Mustache can handle complex JavaScript operation too
```html
<template>
    {{ user.getLevel() + user.increaseXP()) }}
</template>
```
{% hint style="warning" %}
Everything in the mustache tag will be interpreted! You cannot put html elements in there.
{% endhint %}

### Binding directives
Nonetheless, mustache tag has some limitation, especially within the HTML attributes since they cannot be used. For example, **you can't** write `<div id="{{myDynamicId}}">`: this will throw an error. To circumvent this issue, Vue.js introduces directives which are special-interpreted HTML attributes.

The most important one is the `v-bind` directive. This directive allows to bind a **standard** HTML attribute element to a **custom data**. For example, you can bind your data with the `id` of an element using the `v-bind`directive.

```html
<template>
    <div v-bind:id="myDynamicId"></div>
    <a v-bind:href="myDynaLink">linkmesenpai</a><!--or any other html attribute!-->
</template>
```

There also exists dynamic binding, which allows you to use varibale to determine which HTML property you want to bind your data with. Check the documentation if your are interested.

## Template syntax
We will see in this section some handful syntaxex to define how your component should render according to its state (its data).

### Conditional rendering
In your component template, you will often face the necessity to check if a variable exists in order to display specific information. For instance, you want to display user's information only if he/she is logged in your application, otherwise you don't have access to this information.

To do that, Vue.js introduce the `v-if` directive. It is used to conditionally render a block: the block will be rendered only if the expression value is computed to `true`. You also have the `v-else-if` and `v-else` directive, obviously.

```html
<template>
    <p v-if="user">Hello {{ user.name }}</p> <!--if the user exists, then we have its name-->
    <p v-else> Hey! You! Log you, Yeah! You!</p>
</template>
```

{% hint style="danger" %}
A directive **has to be attached** to **only one** element. If you want to toggle more than one HTML element with you directive, you must use it on a `<template>` element, which serves as an invisible wrapper.
```html
<template v-if="ok">
  <h1>Title</h1>
  <p>Paragraph 1</p>
  <p>Paragraph 2</p>
</template>
```
{% endhint %}

{% hint style="info" %}
There is also the `v-show` directive used to conditionnaly render a block. The cost of the rendering operations is not the same. `v-if` always destroy its content if the condition is false, while `v-show` relies on CSS property to hide the content thus don't have to recreate the all content if the variable becomes true again. If you have costly drawing often toggling, maybe `v-show` can be better.
{% endhint %}

### Loop/list rendering
Another common needs is to dynamicaly render list of elements in a page. Vue.js introduces the `v-for` directive for addressing this need. It uses a special syntax `item in items` (if `items` is the array, `item` is an alias for the array element: it can be anything else). You can also retrieve the key/index of the element iterated with the special syntax `(item, index) in items`.

You can use `v-for` to render a list based on an array.
```html
<ul>
    <li v-for="myItem in items"> <!-- items: [{ message: Foo}, {message: Bar}]-->
        {{ myItem.message }}
    </li>
</ul>
```
Here, a first `<li>` element will be rendered with the Foo message, and the second with the Bar message.

It is also possible to iterate over an object's properties with the same directive.
```html
<ul id="v-for-object">
  <li v-for="(prop, key) in myobject"> <!-- myObject { name: "Soen", level: "3Dan", xp: 150,}-->
    {{key}} is: {{ prop }}
  </li>
</ul>
```
Here, the first `<li>` will display Name is: Soen, and so on.

{% hint style="info" %}
Same as other directive, if you want to render several elements in the `v-for` directive, you must use it on a `<template>`.
{% endhint %}

Another important things for the `v-for` directive is about maintaining the state of your list up to date. Whenever possible, it is higly recommended by Vue.js assign a unique `key` to the alias element created (here `item` and `prop`) when possible (the value **must** be numeric or string). To do so:
```html
<li v-for="item in items" v-bind:key="item.id"> <!--we know that .id is unique across all the element of your array, we can use it as a key -->
```

## Vue.js reactivity
When a Vue.js instance is created, it adds all the properties found in its `data` object to the reactivity system of the framework. When values of those properties change, the view will automatically “react”, updating itself to match the new values. This is a **powerful feature** that you should intensively use (it is somewhat a reimplementation of the observer pattern).

Each component has a `data` object. For every component but the main component `Vue.vue`, data **must be** a function, otherwise, the data will be shared accross the difference instances of the same component.

In the `<script>` element of your component, you should have:
```js
data(){ // the data, declared as function
    return{ // we return all the properties that should be react on.
      name: "Yo!",
      value: 15,
    }
  },
```

Then, during using app, if you change the value of `name`, this change will reflect on the template of the component.

## Instance Lifecycle Hooks
Lifecycle hooks are special functions which allow user to perform specifics operations at certain moment of the creation and the rendering of a component. For example, just before your component goes `mounted` to the page, you can modify the component's data.

```js
data(){
    return{
        value : -1;
    }
}

mounted: function(){
    console.log("Component mounted!");
    value = DEFAULT_MOUNT_VALUE;
}
```

Below a diagram of the lifecycle of a component and the associated hooks.
![Lifecycle of a component and associated hooks, from the [Vue.js documentation](https://vuejs.org/v2/guide/instance.html)](lifecycle.png)