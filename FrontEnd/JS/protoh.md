# Inheritance and prototype chain

## Method and function borrowing
bind, call, apply()
https://www.codingame.com/playgrounds/9799/learn-solve-call-apply-and-bind-methods-in-javascript

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