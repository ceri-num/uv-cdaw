---
author: Alexis Lebis
---
# Vue.js Component Properties
{% hint style="warning" %}
Though you can use camelCase naming convention in the declaration of your component, or even the component's variables, you need to reference to them using a kebab-case (hyphenation) convention in the template of your component!
{% endhint %}

We will see how we declare a component, how the data flow is configurated, as well as how events are handled.

## Declare and register your component
Registration is making your component known by your application so that it can be used during rendering. We will not see global registration here. Check [the doc](https://vuejs.org/v2/guide/components-registration.html#Global-Registration) for more information.

Instead, local registration, in addition of providing some advantage about the weight of your app, allows a better organisation and uses the pre-defined model given by the CLI scafolder you used to create your Vue.js project. Lets review the step needed for registration.

As you can see, your `Home.vue` component has the following code in `<script>`
```js
// @ is an alias to /src
import HelloWorld from '@/components/HelloWorld.vue' //Import of another component, declared similarly to this one

export default { //we "export" this object, making it available to import elsewhere
  name: 'Home', //the name of our component used in the template <home></home>
  components: { // we register here the components used in this Home component
    HelloWorld
  }
}
```

In the `main.js` of your file, you should have something like (if you used the configuration with router)
```js
import Vue from 'vue'
import App from './App.vue'
import router from './router'

Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
```

**Stop!** What is happening here? Well, in this specifc case, we register our `HelloWorld` component into our `Home` component: it is then available to use. The `new Vue` here create our Vue application. The specificity here is that we specify the `router` component (automaticaly created with the CLI with routing configuration), which in turn register (well, in a specific way for routing purpose) `Home`.

So, every of the components you plan to use in a component **must be** declared in the `components` object of the host component.

```js
components: { // we register here the components used in this Home component
    HelloWorld,
    Comp2,
    Comp3,
  }
}
```

We can use a component only if it has been `export`ed. To do so, you need to use the `export` keyword in the file where the component is described.
```js
export default { //we "export" this object, making it available to import elsewhere
  name: 'Home',...
```
{% hint style="danger" %}
Exported modules are in strict mode whether you declare them as such or not. The export statement cannot be used in embedded scripts.
{% endhint %}

And to add a component to the array of `components`, this component needs to be `import`ed! When you use the `import Obj from 'my/path/to/Obj.vue`, you create an instance of this object.

## Define the interface of your component
In a real application, you will often have components which will depend on specific data -- data most of the time provided by their parent. For example, lets imagine that your main `App` has a `user` object. We want to pass this object to the `userSetting` component, in charge of displaying its avatar, and all its information. Passing off the data could be as follow:

```html
<user-setting user="userObj"></user-setting> <!--the name of the attribute can be different of the variable!-->
```

The parent gives the object `userObj` to its child. To receive such a variable, the child component must define its **interface** (called `props` in Vue.js), namely all the receivable variables and their alias. In the above example, the alias for the attribute is `user`. Defining the interface of your child component is by filling up its props array:

```js
export default {
  name: 'HelloWorld',
  props: {
    user: Object,
    //can be other prop here!
  },
  ...
```
{% hint style="info" %}
This is called a One-Way data flow. The flow goes from the parent to the child. If the value is changed **in the child**, the changes are **not** reflected to the parent. However, if the value of the object given to the child component change **in the parent**, the change is reflected in the variable of the child. This default behavior prevent uncontrolled mutation from the state of the parent.
{% endhint %}

{% hint style="danger" %}
Note that objects and arrays in JavaScript are passed by reference, so if the prop is an array or object, mutating the object or array itself inside the child component will affect the parent state! Be mindful of your mutation (that is why you should heavily rely on getter and setter -- check [the related section](../JS/poo.md))
{% endhint %}

You can perform prop validation by specifying type requirement in the `props` attribute of the component, as we perform above:

```js
user: Object,
```
means that user **is** an object, and should not be otherwise. You have different keywords available, such as `String`, `Boolean`, etc...

{% hint style="success" %}
Tend to prefer this notation for the `props`! It is always a good idea to introduce some verifications in your code!
{% endhint %}

At least, if you want two ways data binding, you can use the `v-model` directive. Check [here for the doc](https://vuejs.org/v2/guide/forms.html) and here for an [example in SO](https://stackoverflow.com/questions/48979636/vue-two-way-prop-binding). However, it is recommended to use `.sync` instead alonside event. Check the [event section](event.md) for more information.

## Reactivity with your props
One thing to be noted though: your `props` **are not** registered into the reactivity system of the framework. Here is apparently some rules (from [vue.js forum](https://forum.vuejs.org/t/props-reactivity-in-the-documentation/9095)):

If you face issue with reactivity with your propos, check the following list, maybe you fall into one of these case:
* primitive props (String, Number, … ) can be reactive in a component only if made dynamic via v-bind:
* * they are reactive if used in computed properties or in methods
* * they are not reactive if used in data as initial value - unless being referenced by a watch function. Also note that when used as non-reactive initial data the assigned value will be the props value at the moment of component creation*.
* Object (or Array) props can be reactive whether or not passed via v-bind if the object itself is being passed and stored in data - and not just primitive values of the object.
* * If the Object reference is stored in data any use of this data will be reactive towards the props value
* * If the Object is cloned or only primitives are stored in data the same rules apply as for primitive props above


