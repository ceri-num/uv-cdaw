# Asynchronous programming

What is the big deal with events? It is that they allow your code to run asynchronously! And this is a very important aspect for a client side application. Indeed, without this asynchronous aspect, waiting a button to be clicked will block the entire page, thus making it unbrowsable.
More generally, code runs straight along, making instruction after instruction ; however, if your instruction is quite important and cpu-intensive and take some time to finish, the whole experience will appear to be frozen for the user, unresponding even to its clicks.

This behavior is called **blocking** : an intensive chunk of code runs without returning control to the browser, and therefore the browser appears to be frozen. The reason is that JavaScript is **single threaded**

> ⚠️ Even if JS is single threaded, this does not mean that it can't be asynchronous!





https://developer.mozilla.org/fr/docs/Learn/JavaScript/Asynchronous/Concepts

etc

this, this=that, binding, etc... : https://stackoverflow.com/questions/28668759/what-does-this-statement-do-console-log-bindconsole

hook : 
```js
var hooks = {};

function add_to_function(name, func) {
  if(!hooks[name]) hooks[name] = [];
  hooks[name].push(func);
}

function call_my_function(name, ...params){
  if(hooks[name]) 
     hooks[name].forEach(func => func(...params));
}
```
Onward custom paradigm, such as Observer/Observator !

## Changing the context
bind apply