# Object-oriented Programming

Anything that is not a primitive type (`undefined`, `null`, `number`, `string`, `boolean`, `bigInt`, `symbol`) is an object (or an instance) in JavaScript. An object is used to store keyed collections of various data and more complex entities. Object instances can contain more instances which can be functions. These specific functions belongig to an object are called `method`. That also means functions are objects.

An object can be created with the object literal syntax `{...}`. The element stored inside an object are called `property`, and we will see how add and remove them from an object. An object can also be created by using the `new` operator.

```js
let quickdraw = {}; // "empty" object ; literal syntax
let quickdraw = new Object();
```
## Object Properties
We can create our object with predefined properties as `key: value` pairs:

```js
let quickdraw = {
    weight: 15, // key= weight, value=15 ; notice the comma here
    brand: "ClimbingGoat", // key= brand, value = "ClimbingGoat"
};
```
> ❓ It is possible to also put a coma `,` at the end of the last line. This is known as *trailing*: since all the lines are alike, it makes it easier to add/move/remove properties.

> ❓ The `value` part can also be a variable!

### Access an object property
Property values can be accessed using the dot notation:
```js
console.log(quickdraw.weight); // cli: 15

quickdraw.weight = 20; // setting a new value to the property weight of the object quickdraw
```
> ❓ Remember that variable does not have a type! Thus, we could have done `quickdraw.weight="HEAVY!"` with no error at all.

A property can also be accessed by using the square brackets notation `[]`. It is more powerful that dot notation, but also more cumbersome to write. To access a property using square brackets notation:

```js
alert(quickdraw["weight"]);
quickdraw["brand"] = "Awesome Brand";
```

Square bracket also permits to use variable as `key` value, which is very convenient.

```js
var key = prompt("What info about the quickdraw?", "weight", "brand");

alert( quickdraw[key] ); // alert either the content of the key, or undefined if the key does not match a property
```

### Manage an object properties
A property can be added to an object "on the fly", after it has been created.
```js
quickdraw.hasGate = true;
//or
quickdraw[hasGate] = true;
```

To delete a property, use the `delete` keyword.
```js
delete quickdraw.hasGate;
alert(quickdraw.hasGate); // underfined.
```

Square bracket also permits to make *computed property*, using variable to create new property for an object. It can be done on the fly or while the creation of the object with the literal syntax `{...}`.

```js
var myProp = "color";
quickdraw[myProp] = "Rainbow";

const qckDraw2 = {
    [myProp + "hey, why not" + foo(10)]: "Double Rainbow", //complex instruction in [] are possible as well
    weight: 100,
    brand: "OMG It's a!",
}
```
> ⚠️ A `const` object's properties can **still be** changed! For example, suppose our `const quickdraw={weight: 15}` object. We can change its weight with no error. But we cannot change the value of the variable `quickdraw` itself (*e.g.* replacing it by another object).

### Introspection for object property
JavaScript strength is its introspection almost limitless possibilities. Consequently, it is possible to access any property of an object, and plus, there will be no error if the property doesn’t exist. Indeed, a non existing property will just return an `undefined` value. There is also the `in` operator (much more elegant than the `===` operator) to test the existence of such properties.

```js
let wgt = "weight";
alert( "weight" in quickdraw ) // TRUE
alert( wgt in quickdraw ) // TRUE, still checking for the property weight
alert( "rope" in quickdraw ) // FALSE
```
> ❓ Remember the `for...in` loop iterating over the properties of an object? No? Go review the [Advanced Section](section.md).

### Complex properties
Property can be more than just a primitive value. In fact, they can store other objects, or even functions.

```js
let quickdraw = {
    weight: 15, // key= weight, value=15 ; notice the comma here
    brand: "ClimbingGoat", // key= brand, value = "ClimbingGoat"
    printMe(){
        console.log(this.brand + " has a weight of" +this.weight); // this refer the object here, not the global
    },
};

quickdraw.open = function(){ //add another property
    console.log("Hey, I'm the open anonymous function! but could be named too!")
}

let gate = {type:fill}; //new object gate
quickdraw.gate = gate; //the new gate object is placed inside a new gate property
```

## Reference and copy
In JavaScript, objects are stored and copied by reference, as opposite to primitive type. That means a variable storing an object always have its reference as value, and the object is stored somewhere in the memory. JavaScript performs auto-dereferencing of the address stored in the variable to get the actual object (and perform the desired action).

This is important because when an object variable is copied, it is not the object that is copied, but it is the reference! The object is not duplicated.

```js
let quickdraw = {weight : 15};
qckd2 = quickdraw;
```

These two variables references the same object. Making a property modification of one of the variable will instantetly reflect on the other as well! Below an exemple to help you grasp the concept.

![Illustration of the copy by reference](resources/cp_by_reference.png)

This mean that it is not trivial to entierely copy an object which is independent of the first. This is called *cloning*. In fact, JavaScript does not has built-in function for that, and you will see that it is rarely needed. 

But if we really want that, then we need to create a new object and **replicate the structure** of the existing one by iterating over its properties and copying them. 

```js
let clone = {}; // **new** empty object
// let's copy all quickdraw properties into a clone
for (let key in quickdraw) {
  clone[key] = user[key];
}
```

> ⚠️ This copy only the primitive level of the object. If you have another level in your object (*e.g.* another object), and you want to deep copy them, you will need to go this level. There is already some function here and there to do that, you could check the [Lodash lib](https://lodash.com/docs#cloneDeep) for example.

## Towards object-oriented programming

### Function constructor and new operator

> In object-oriented programming, a class is an extensible program-code-template for creating objects, providing initial values for state (member variables) and implementations of behavior (member functions or methods). (Wikipedia)

### Class
https://javascript.info/class

## Module Pattern: Emulating private and public keyword @towrite
Use the `()` operator and IIFE concept

The return statement of the Module contains our public functions. The private functions are just those that are not returned. Not returning functions makes them inaccessible outside of the Module namespace. But our public functions can access our private functions

```js
var Module = (function() {
    function privateMethod() {
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
Module.publicGetterMethod(); // works
Module.privateMethod(); // Uncaught ReferenceError: privateMethod is not defined
```

> ❓ A convention is to use the `_` (underscore) symbol as a prefix for protected method, and returning an anonymous object containing the public functions.



https://rapides6.herokuapp.com/

## Asynchronicity in object

## Reflect & Proxy API (ES6)
https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Reflect