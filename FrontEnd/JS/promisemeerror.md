# Errors handling

## Faillure case scenarios
As you have noticed from now, JavaScript is a very flexible language, allowing you to perform things that is usually not possible in more conventional language like Java or C (*e.g.* non-typed variable and polymorphism). However, the drawback of this flexibility lays often in code instability and weird behaviors (`this` has an important part to do here).

Exploiting the non-typed approach of JavaScript, a way to allievate weird behaviors is to heavily rely on `return;` to stop the execution of a function that either does nothing to do, or has face a faillure/unauthorised case. To foster maintenable code, and well documented, the checkings is often made at the begin of the function -- regrouping all the verification in a single place which can be easily documented.

```js
function foo(var1, var2, callback){
    if(!callback) //if callback is null or undefined, we stop here
        return; //return undefined
    if(var1 < 0)
        return;
    if(var2 > var1*this._someGlobalVar)
        return;
    if(!this.registerCallback(callback))//callback already exists for example
        return;

    // Now we can run the function's code
}
```

{% hint style="info" %}
That is why you want to rely on `get` and `set` for your class! You can handle these scenarios and sometimes correct them with default behaviours (*e.g.* set a negative variable to 0).
{% endhint %}

## Errors
However, no matter how hard you try, your code will fail one time or another (because of you, the user, the hardware, etc.). Despite `return` is a good approach in several cases, sometimes you need more powerful error managment. Indeed, when your script fails, it usually "dies" -- stops immediatly. However, maybe you want to recover from this error and do some specific actions instead of stopping your script (*e.g.* reinitializing your interface).

{% hint style="success" %}
My advice is to **break hard and break soon!** Even if your code growth in size and take you more time by doing so, this is always a good practice, and it will help you when your code will become important.
{% endhint %}

{% hint style="info" %}
A constructor should **never** failled! If it fails, an error should be thrown, or the construction of the object should be delegate to a builder (cf. [Builder pattern](https://en.wikipedia.org/wiki/Builder_pattern)): there should not be other possibility IMO.
{% endhint %}

### Try...catch
JavaScript, as several other language, introduced the `try...catch` syntax:
```js
try {
  // code...
} 
catch (error)
{
  // error handling
}
```
When JavaScript arrives on a `try...catch` statement, first the code in `try` is executed. If no error are thrown inside this block, then the `catch` block is ignored. Otherwise, the rest of the `try` block is ignored once an error is thrown. The error is then handled by the `catch` block and stored in a variable (here `error`). Consequently, an error does not stop your script of running if it happens in a `try` block.

The catched error by `catch` is also an object. The built-in erros has the following useful properties:
* name
* message
* stack

```js
let json = "{ bad json }";

try {
  let user = JSON.parse(json); // <-- when an error occurs...
  alert( user.name ); // doesn't executed

} catch (e) {
  // ...the execution jumps here
  alert( "The JSON seems to be corrupted." );
  alert( e.name );
  alert( e.message );
  alert("We will try to retrieve it again soon");
}
```

{% hint style="warning" %}
Variable inside `try...catch` are local! You cannot declare a new variable inside a `try` block and use it elsewhere. This gives some confusion at the beginning, since it may change how your code is structured, especially with nested `try...catch`.
{% endhint %}

### Finally
There is an additionnal clause to the `try...catch` which is `finally`. If attached to a `try` or a `try...catch` statement, the content of the `finally` block is **always** executed. This is usefull to end/finalise something that has been started. For example, closing a communication socket. The syntax:
```js
try {
   // try to perfoms the code
} catch(e) {
   // lands here if an error happens
} finally {
   // always executed!
}
```

{% hint style="info" %}
The `finally` clause works for any exit! That means if you `return` from a `try` or `block` explicitly, you will land in the `finally` block!
{% endhint %}

### Custom error and throwing
You can produce your own error during the execution of your code. For example, parsing a JSON string and noticing that there is no information about an expected state of a game (*i.e.* `gameState` is set to undefined). To do so, we simply use the `throw` keyword:

```js
throw new Error(message);
```

`Error` is the super type of all the errors in JavaScript. But there is more specific built-in errors, like `SyntaxError`, that can be used as `Error` depending on the situation.

When you `throw` an error, you create an exit point in code: all the instructions below are no longer executed (like a `return`).

In a complete example:
```js
let json = '{ "nbPlayer": 4 }'; // incomplete data

try {
  let game = JSON.parse(json);
  if (!game.state) {
    throw new SyntaxError("Incomplete data: no game state send by the server!"); // <- We leave the try block here and be catched by the catch below
  }
  alert( game.state );//never executed!
} catch(e) {// It catches both the JSON.parse error and OUR OWN ERROR!!
  alert( "JSON Error: " + e.message ); // JSON Error: Incomplete data: no game state send by the server!
}
```

You can **rethrow** a handled error in a `catch`. Rethrowing is used when the error received cannot be correctly handled where it happens and needs to go back up the execution stack.

```js
catch(e) {
  if (e instanceof SyntaxError) {
    alert( "JSON Error: " + e.message );
  } else { //if it is not a syntaxerror, we do not handle it here, we throw above
    throw e; // rethrowing
  }
}
```

You can define your own errors by extending the built-in errors in the language, like any class. And then use it as any other errors:

```js
class MyError extends Error {
  constructor(message) {
    super(message);
    this.name = "MyError";
  }
}

try{
    try{
        throw new MyError("hey, i'm the message");
    }
    catch(e){
        if(e instanceof MyError)
            throw e; //rethrowing
        else
            console.log("Error but not ours")
    }
catch(e){
    console.log("This is a MyError error!!");
}
```
{% hint style="info" %}
A good practice in your custom error could be to keep a reference on the object which has failed.
{% endhint %}

{% hint style="success" %}
Since MyError is a class, you can inherit from it too!
{% endhint %}

## Error and synchronicity

An important things to note is that `try...catch` works synchronously. In other words, if an error happens in a "scheduled" code, like in a event callback or in `TimeOut`, `try...catch` will not catch it. That is because the function is executed later in the code, when the engine has alread left the statement.
```js
try {
  setTimeout(function() {
    noSuchVariable; // script will die here
  }, 1000);
} catch (e) {
  alert( "not catched!" );
}
```

Thus, to catch an error in an asynchronous, the `try...catch` need to be in this very function!
```js
setTimeout(function() {
  try {
    noSuchVariable; // try..catch handles the error!
  } catch {
    alert( "error is caught here!" );
  }
}, 1000);
```

In addition, in the case of a `async/await` situation, it is possible for a promise rejects an error, just as if there were a `throw` statement at the line of the `.reject(new Error)`.
```js
async function f() { //note the async and await
  await Promise.reject(new Error("Error here!")); // equivalent to throw new Error("msg");
}
```

However, in real situation, the promise will take some times before it rejects. In that case, we can use `try...catch` to catch the error throw by `await`ing.

```js
async function f() {
  try {
    let response = await fetch('/bad-url-lol');
    let user = await response.json();
  } catch(err) {
    // catches errors both in fetch and response.json
    alert(err);
  }
}
f();
```
{% hint style="info" %}
You can wrap multiple await line in one `try` as showed above!
{% endhint %}

{% hint style="info" %}
If you don't use `try...catch`, you can still catch the error by using the `.catch` statement when f() becomes a rejected promise: `f().catch(alert)`.
{% endhint %}

## Browser debug
Use your browser to debug your code!!
A [good tutorial](https://developers.google.com/web/tools/chrome-devtools/javascript) from the Chrome DevTools.
