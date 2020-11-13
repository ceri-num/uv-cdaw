# Component Rendering
There is two things to figure out for rendering a component :
* What are the DOM command that can be used within the template
* How to setup the reactivity of your component, so that it becomes dynamic

{% hint style="info" %}
In this section we do not focus on binding data yet. Check the [property section](property.md) for this kind of information.
{% endhint %}

## Binding
Binding consist of

## Template syntax

## Vue.js reactivity
The most important thing to remember here is when a Vue.js instance is created, it adds all the properties found in its `data` object to reactivity system of the framework. values of those properties change, the view will “react”, updating to match the new values.

## Instance Lifecycle Hooks

![Lifecycle of a component and associated hooks, from the [Vue.js documentation](https://vuejs.org/v2/guide/instance.html)](lifecycle.png)