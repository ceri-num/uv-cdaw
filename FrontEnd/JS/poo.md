# Object-oriented Programming



* Anything that is not a primitive type (`undefined`, `null`, `number`, `string`, `boolean`) is an object (or an instance) in JavaScript. That means function inherits from object.
* Object instances can contain more instances which can be functions. That's what we call a `method` (since it has an automatic `this` variable).
* Since you can't "call" every Object instance, not every object is a function.

## Module Pattern: Emulating private and public keyword @towrite
Use the `()` operator and IIFE concept

The return statement of the Module contains our public functions. The private functions are just those that are not returned. Not returning functions makes them inaccessible outside of the Module namespace. But our public functions can access our private functions

```js
var Module = (function() {
    function _privateMethod() {
        // do something
    }

    function publicGetterMethod()
    {
        // do smth
    }

    return {
        publicGetterMethod: publicGetterMethod,
        publicMethod: function() {
            // can call privateMethod();
        },
    };
})();
Module.publicMethod(); // works
Module.privateMethod(); // Uncaught ReferenceError: privateMethod is not defined
```

> ❓ A convention is to use the `_` (underscore) symbol as a prefix for private method, and returning an anonymous object containing the public functions.



https://rapides6.herokuapp.com/

## Reflect & Proxy API (ES6)
https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Reflect