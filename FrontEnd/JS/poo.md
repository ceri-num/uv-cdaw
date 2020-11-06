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

### Constructor function and new operator
As we have seen, `{...}` operator allows us to create one new object. However, when several similar objects are required, this method is not practicable (*e.g* tiles of mahjong). Constructor functions and `new` operator are what we need to do that.

Constructor function are regular functions, with no difference to a simple function. However, they should respect these two conventions (they are not implemented in a language-level):
* The function should start with a capital letter
* The function should only be called using the `new` operator

The syntax is as follow
```js
function Quickdraw(param1, param2){
    this.weight = param1;
    this.brand = param2;
}

var myQckd = new Quickdraw(50, "Ultra poney"); // create new object Quickdraw

alert(myQckd.weight) // access , add, remove, as usual
```

When a function is executed with the `new` operator, it does the following steps:
* A new empty object is created and assigned to this.
* The function body executes. Usually it modifies this, adds new properties to it.
* The value of this is returned.

There much more to learn on constructor function and new. But we want to emphasize on OOP, thus we will lean toward a more appropriate syntax

### Module Pattern: Emulating private and public keyword
With a little imagination and knowledge about the language, it is totally possible to force function's visibility for function constructor. Use the [`()` operator, IIFE concept and the concept of closure](advanced.md).

The return statement of the Quickdraw contains our public functions. The private functions are just those that are not returned. Not returning functions makes them inaccessible outside of the Quickdraw namespace. But our public functions can access our private functions thanks to closure.

```js
var Quickdraw = (function() {
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
Quickdraw.publicMethod(); // works
Quickdraw.publicGetterMethod(); // works
Quickdraw.privateMethod(); // Uncaught ReferenceError: privateMethod is not defined
```

> ❓ A convention is to use the `_` (underscore) symbol as a prefix for protected method, and returning an anonymous object containing the public functions.

> ❓ Take some time to fully understand this code.


## Class
> In object-oriented programming, a class is an extensible program-code-template for creating objects, providing initial values for state (member variables) and implementations of behavior (member functions or methods). (Wikipedia)

A `class` is the fondamental element of the object-oriented programming paradigm, and we want that to be convenient to use and powerful. While constructor function and `new` operator help us to create many similar objects, a `class` construct give us much more features.

### Basics
The syntax of a class is:
```js
class MyClass {
    prop1;// properties are optional but its good to indicate them anyway
    prop2 = 0; //IDEM, with default value

    constructor(){...}//several constructor can be defined, with various param.

    method1(){...}
    method2(){...}
    //and so on, like Java, C++ objects
}
```

So if you retake our quickdraw example, to define a class and instantiate an object of this class
```js
class Quickdraw{
    // Class fields
    weight;
    brand;

    constructor(weight, brand){
        this.weight = weight;
        this.brand = brand;
    }

    printMe(){
        console.log("hey! it's me, "+this.brand+"!");
    }
}

// And use it
let myQckd = new Quickdraw(15, "Mario");
myQckd.printMe(); // cli : Hey! it's me, Mario
```

Even if `alert(typeof Quickdraw)` says that a class is a function, **it is not** just a syntactic sugar. One of the important thing is that in the prototype of the object, the `enumerable` flag is set to `false` for all methods of the class. That means iterations instructions, like `for...in`, will only iterate over the properties of the object, not its methods.

> ⚠️ Classes always use strict mode, even if you are in sloppy mode (the default)! All code inside the class construct is automatically in strict mode. This mean that the behavior of somes JavaScript feature can change! Be aware of that, such as `this` value and the execution scope. More information [here](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Strict_mode).

> ❓ Class fields are defined for each instance of the class, not the class itself. For example `Quickdraw.prototype.weight` is undefined, whereas `myQckd.weight` is set.

### Getter and Setter
JavaScript introduced getters and setters concept both for literal function and class. Easily enough, the syntax is:

```js
class Quickdraw{
    // Class fields
    weight;

    constructor(weight){
        this.weight = weight; // auto calling of the setter
    }

    get weight(){
        return this._weight; //note the _
    }

    set weight(w){
        if(w > 1000)
        {
            alert("error, qckd to heavy");
            return;
        }
        this._weight = w; //note the _
    }
}
```

> ⚠️ Getters and setters are specific functions. When declaring a get/set over a property of your object, JavaScript actually replace this property with a specific function. That is why you need to change the name of the property and -- by convention -- we used the `_` to do that. Otherwise, you will have an infinite recursive loop. Thus, when we do myQckd.weight = 15, it is actually the setter that is called, not a value affection for the property! More information about getters and setters [here](https://medium.com/javascript-in-plain-english/javascript-classes-an-in-depth-look-part-2-88b666ed3546).

### Bounding your method with event
Your class can represents objects aiming to be interact with in the view of your application. Consequently, maybe some of its methods need to be called when specific events are dispatched.
The inconvenient with JavaScript is that `this` is dynamic. Therefore, we cannot "simply" give a method as a callback to a function.

```js
class Quickdraw{
    constructor(w){ this.weight = w }
    myClick(){alert(this.weight);}
}
let qck = new Quickdraw(150);
setTimeout(qck.myClick, 1000); // undefined ! Oops!
```

This is called "losing `this`". There is several approach for fixing this issue, but an elegant solution is relying on class fields, since they are object based, and not prototype based. Thus the method `myClick` will be created on a per-object basis, with `this` always referencing the object.

```js
class Quickdraw{
    constructor(w){ this.weight = w }
    myClick = () => {alert(this.weight);} // this is now a class field (i.e. attribute)!
}
let qck = new Quickdraw(150);
setTimeout(qck.myClick, 1000); // 150
```
### Static
> ⚠️ This is a recent implementation and could not work with all the browsers.

It is possible to associate a method to a class itself, not to its `prototype` with the keyword `static`. Usually, static methods are used to implement functions that belong to the class itself, but not to any particular instance (object) of it. Simply prefix the method of the keyword to obtain such a behavior.

This goes the same for static property.

> ⚠️ Again, mind `this`! It refers to the class itself, not a particular instance. Therefore, if we had a static method in our `Quickdraw` class, and inside the method, `alert(this === Quickdraw)//true`.

### Visibility of fields
OOP imply visibility for fields class. In JavaScript, because it is a prototype based language, all the fields are `public` by default. That means all properties and functions of an object are visible and modifiable anywhere if there is a reference to this object.

#### Protected
Protected fields are not implemented in JavaScript on the language level, but in practice they are very convenient, so they are emulated. In our Quickdraw example, `weight` and `brand`, as well as `method1` are public.
```js
class Quickdraw{
    weight;
    brand;

    method1(){};
}
```
The **convention** (since it is not implemented on the language level) is to prefix the protected element with an `_` (underscore). So, if our protected should be protected, they will become `_weight` and `_brand`.

> ⚠️ Do not be fooled! They are still publicly accessible. But since you will be probably looking for weight instead of _weight, you will not find them. You will also avoid all properties starting with `_` in iterations instruction like `for...in`.

The same goes for methods. Prefix the class methods with `_` to indicate they are protected. However, tend to favor **get** and **set** when possible!

#### Private
In the recent additions of the language, a private symbol as been introduced at the language-level. Any element prefixed by `#` is meant to be private, and therefore is only accessible from inside the class whether it is a method or a property.

Relying on `#` while defining a class element also has an impact on its syntactic declaration: two elements (*e.g.* properties) can share a same name if one is either public or protected, and the other private. You can also combine this with getter and setter to have a powerful encapsulation.

```js
class Quickdraw{
    #weight; //private class field

    set weight(value){ // setter, defined on weight
        if(value > 0)
            this.#weight = value; //ok to access private elmt from inside
        else
            throw new Error("Check Manage error section ;)");
    }
}

let qck = new Quickdraw();
qck.weight = 150; // OK! Call the setter, and set the value of the private weight
```

### Check belongings
The `instanceof` operator allows to check whether an object belongs to a certain class. It also takes [inheritance](protoh.md) into account. In case of *polymorphic* objects, for example, this operator is handful. It is applicable to class, but works also with constructor functions.

The syntax is simple.
```js
myObj instanceof ClassName
```
It returns `true` if `myObj` belongs to the class `ClassName` or a **class inheriting from it**.

## Asynchronicity in object
Another way to bing method of an object with any event is by relying on `async` and Promise. `async` can be added in front of class/object methods to make them return promises, and `await` promises inside them.

```js
class Quickdraw{
    async makeAwait() {
        return await (new Promise( (resolve, reject) => setTimeout(() => resolve("Hi! I'm resolved"),3000)));
    }
};

let qck = new Quickdraw();
qck.makeAwait().then(console.log); //cli : Hi! I'm resolved ; after 3 sec.
console.log("Don't forget!"); // <-- This code prints after the above log!
```

## Meta-programming (ES6)
This is a brief introduction to meta-programming via `Proxy` and `Reflect` new features introduced in JavaScript by ES6. Meta programming is about code that have a direct effect on the code we use to write the application (or core).

### Proxy
The `Proxy` object enables you to create a proxy for another object, which can intercept and redefine fundamental operations for that object (cf. [MDN](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Proxy)). In other word, it allows us to create some kind of a layer between an object and its consuming entities. We can then control the behavior of the object, like deciding what should be done when accessing a property in a object or the `set` is used.

The syntax is:
```js
var p = new Proxy(target, handler);
```
Where the `target` is the object for which you want to create the proxy, and the `handler` is the object defining the custom behavior. The `handler` traps some predefined functions, such as:
* apply()
* construct()
* get()
* has()
* set()

```js
const target = {
  notProxied: "original value",
  proxied: "original value"
};

const handler = { //defining a handler for get
  get: function(target, prop, receiver) {
    if (prop === "proxied") {
      return "replaced value";
    }
    return Reflect.get(...arguments);
  }
};

const proxy = new Proxy(target, handler); //creating the proxy

console.log(proxy.notProxied); // cli : original value
console.log(proxy.proxied);    // cli : replaced value.
```
With the above example, we saw that each time we access an object property, we call the `get` `handler` and perform the instruction within, instead of directly accessing target attributes.

This example is somewhat identical to the use of `get` from a `class` as we saw before.

> ❓ Proxy can be used to make some quite elegant solution for protecting property access. You need the traps on `get`, `set` `ownKeys` and `deleteProperty` to check if the property start with `_`. If this is the case, then throw an error.

### Reflect
`Reflect` is a built-in object that provides static functions for interceptable JavaScript operations. Some of these functions are the same as corresponding method on object (yet [subtle differences](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Reflect/Comparing_Reflect_and_Object_methods) can apply). Put in other words, it simplifies creation of `Proxy` since it is a minimal wrapper around the interal methods trappable.

Some examples
```js
const dog = {
    race: "tamaskan",
    color: "grey",
    bark: function(){console.log("woof");},
}
Reflect.ownKeys(dog); // list all the properties ["race", "color", "bark"]
Reflect.set(dog, "color", "purple"); // set the dog's color to purple
Reflect.has(dog, "corol"); // false
```

> If you want to test your knowledge about Reflect API and Proxy API, you can go [here](https://rapides6.herokuapp.com/templates/get-by-proxy.html). There is also lot of other cool stuff on the net! Go check out!