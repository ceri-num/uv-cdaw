# Events handling

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