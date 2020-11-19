---
author: Alexis Lebis
---
# Routing
Dynamic routing is the heart of any SPA application. Instead of changing and loading a new web page when the website URL changed, the idea is to update the page by adding and removing new component on the page. To do so, The HTTP request is caught by a dedicated `router` component, and if the desired URL match the routing rules of the router, then components are invoked and destroyed in order to update the page.

![Illustration of the routing in SPA](resources/router.svg)

{% hint style="info" %}
The official Vue.js router documentation is accessible [here](https://router.vuejs.org/).
{% endhint %}


## Overview
If you have created your Vue.js application using the CLI as writen [here](../TP/setup.md), then you should have a router component called `index.js` in the folder `@/src/router/` (@ is the root of your Vue.js project). Let's have a look

```js
// ----- 1 ------
import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'

Vue.use(VueRouter)

// ----- 2 ------
const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home //this method of referencing component is better for now!
  },
  {
    path: '/about',
    name: 'About',
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  }
]

// ----- 3 ------
const router = new VueRouter({
  routes
})

// ----- 4 ------
export default router
```
In order:
1. Import and global configuration for your router component. You need `vue-router` to be able to route HTTP request. Don't fort `Vue.use` to say Vue to use the router!
2. Define some routes. Each route should map to a component. So a route has a path where it trigger (*e.g.* when writting server/url`/about`) and the component to call.
3. Create the router instance and pass the `routes` options
4. Export the router (it is used in Vue.js, go check there!)

The important thing to note here is the `path` property. This property indicates which queries has to be caught -- any uncaught path generate a new server call. The `/` indicated the root of your website. Therefore, when accessing the index of your website, you will instead load/render the `Home` component ; when accessing the `/about` URL, it will be the `About` imported component.

In addition, when an URL maps a route definition, the component(s) specified in the `components` property will somewhat "replace" the `<router-view/>` component. Think of it as an anchor.

{% hint style="success" %}
That's it! Do you see the advantage of web components now? Each page relies on either one or several components!
{% endhint %}

## Dynamic routing
Most of the time, your website will access very similar resources, discriminated only by a specific information. For example, you can access your users `Sol` and `Ky` with the `/user` URL suffixed with their pseudi, like in `/user/sol` and `/user/ky`.

In a web component approach though, this will be the same component that will handle this data processing and rendering (and request). So we need a way to map several routes to a same component: this is dynamic routing. To do so, we can use **dynamic segment** in the path expression:

```js
const User = {
  template: '<div>User name: {{ $route.params.id }}</div>' //when a route is matched, a $route object is create and usable as in here
}
const router = new VueRouter({ // or simply router if you import it!
  routes: [
    // dynamic segments start with a colon
    { path: '/user/:id', component: User }
  ]
})
```
You can have multiple dynamic segments in your url. Say that we want to retrieve a specific game information (the 315th) of the user `Baiken`, the dynamic path could be:
```js
{ path: '/user/:username/game/:id_game', component: Game }
```
The content of the `$route.params` here will be `{username: "Baiken", id_game: 315}`.

{% hint style="info" %}
The navigation performed by the router component is lazy. That means if you navigates from a user (*e.g.* Potemkin) to another one (*e.g.* Sol), the same component instance will be used! This for performance consideration, however this can be a little constraining because your component may not react very well on change. To fix that, you should use the `watch` method. More info [here](https://router.vuejs.org/guide/essentials/dynamic-matching.html#reacting-to-params-changes).
{% endhint %}

## Props and routes
As we have seen, we can use `$route` both in the template of your component, and also in the JavaScript of your component. However, this may create intricate coupling between your route and your component, and this is not very good for maintenance and scaling. A good way to do so is to pass the `$route.params` as `props` for your component.

Here is how you can do that:
```js
const User = {
  props: ['id'],
  template: '<div>User {{ id }}</div>'
}
const router = new VueRouter({// or simply router if you import it!
  routes: [
    { path: '/user/:id', component: User, props: true },
  ]
})
```
Thus, your componant can now be used everywhere in your app: its interface is clearly specified -- it waits an `id`. The `true` boolean in the route declaration is used to transform your `params` into `props`. You need to set it to `true` to use this feature.

You can even set a function which returns props. Check [the doc](https://router.vuejs.org/guide/essentials/passing-props.html#function-mode)!

## Nested routes and views
In complex application, the page is often composed of several components nested at various levels. For example, we could imagine that accessing the games information for a specific user is still made in the user component, as well as accessing its profile.

![Illustration of nested routes](resources/nested_route.svg)

The routing logic here should not be entierely made at the top level, but instead to the component-level. The top-level application should indeed redirect to the `User` component, but any further route mapping should be handled by this component, such as accessing the `profile` of the user.

Thus we could used the `<router-view></router-view>` component to host the nested component and react according to the end of the URL. 
```js
const User = {
  template: '
    <div class="user">'+
      '<h2>User {{ $route.params.id }}</h2>'+
      '<router-view></router-view>'+ //router-view will be replaced with the specified child component.
    '</div>'
}
```
To indicate that a component is supposed to be nested according to a specific route, you need to used the `children` property of a route. Moreover, if you want to keep access to the parent page (here: /user/Sol), you will need to specify an empty subroute.

```js
const router = new VueRouter({//router-view will be replaced with the specified child component.
  routes: [
    { path: '/user/:id', component: User,
      children: [
        { path: '', component: UserHome }, // empty subroute, redirecting to the homepage for /user/Sol
        {
          // UserProfile will be rendered inside User's <router-view>
          // when /user/:id/profile is matched
          path: 'profile',
          component: UserProfile
        },
        {
          // UserPosts will be rendered inside User's <router-view>
          // when /user/:id/games is matched
          path: 'games',
          component: UserGames
        }
      ]
    }
  ]
})

```

Maybe you will also have complex view in your application, and consequently several `<router-view>` in one same component. You can name them and specify which view has to be updated when a path is matched. More information in [the doc!](https://router.vuejs.org/guide/essentials/named-views.html)

{% hint style="info" %}
You can also programmatically (manually) navigate accros your site. Again, the doc is here for you if you need that.
{% endhint %}