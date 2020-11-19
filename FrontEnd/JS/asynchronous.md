---
author: Alexis Lebis
---
# Asynchronous programming

What is the big deal with events? It is that they illustrate how your code can run asynchronously! And this is a very important aspect for a client side application. Indeed, without this asynchronous aspect, waiting a button to be clicked will block the entire page, thus making it unbrowsable.
More generally, code runs straight along, making instruction after instruction ; however, if your instruction is quite important and cpu-intensive and take some time to finish, the whole experience will appear to be frozen for the user, unresponding even to its clicks.

This behavior is called **blocking** : an intensive chunk of code runs without returning control to the browser, and therefore the browser appears to be frozen. The reason is that JavaScript is **single threaded**.

{% hint style="info" %}
Even if JS is single threaded, this does not mean that it can't be asynchronous!
{% endhint %}

Asynchronicity allows us to initiate actions at a specific time, and finish them later without worrying to call them again.

{% hint style="danger" %}
Working with an asyncrhonous requires to change the way of how your think about your code and how it is supposed to run. Otherwise, catastrophes are on the way. Thus you need to be fully aware of the code execution order. The example below will console the first and the last log ; the second being block until someone click on a button:
```js
console.log("registering click handler");

button.addEventListener('click', () => {
  console.log("get click");
});
console.log("all done");
```
{% endhint %}

## Callbacks

A callback function is a function (generally anonymous) passed into another function as an argument, which is then invoked inside the outer function to complete some kind of routine or action. This is extremelly usefull to make versatile function by attaching it a specific behavior when it has finished to run.

{% hint style="success" %}
We have already seen callbacks a lot in the [Events](event.md) section!
{% endhint %}

Callback are not always associated with events though. They can also be used with simple function (native or custom). For example with `Timeout`

```js
  setTimeout(function(){ alert("I'm callback!"); }, 3000);
```

Or custom functions
```js
function calculate(num1, num2, callbackFunction) { //take a callback function
    return callbackFunction(num1, num2);
}

function calcProduct(num1, num2) { // a callback
    return num1 * num2;
}

function calcSum(num1, num2) { // another callback
    return num1 + num2;
}
console.log(calculate(4, 25, calcProduct)); // cli: 100
console.log(calculate(4, 25, calcSum)); // cli : 29
```

It is also possible to use callback functions inside other callback functions and make a whole chain of actions triggering automaticaly (e.g. on click of the button, perform an action then draw).

{% hint style="danger" %}
Be carefull of the nesting of callbacks, since it can quickly become out of control if the depth is too important. A way to alievate this problem is to create small standalone function and do not rely on anonymous function.
{% endhint %}

## Promises
Promises have some similarities with callbacks. They are essentially a returned object to which you attach callback functions, rather than having to pass callbacks into a function.
However, promises are specifically made for handling async operations, and have many advantages over old-style callbacks:

* Chainning multiple async operations together is simple and easier to read (including the passing of the result to the following promise)
* They assure consistency in the event queue
* Error handling is better
* They avoid [inversion control](https://medium.com/@viktor.kukurba/dependency-injection-and-inversion-of-control-in-javascript-303e07e7f43f)

### Executor and states
Concretely, the constructor syntax for a promise looks like:
```js
let promise = new Promise(function(resolve, reject) { /*the EXECUTOR code here*/});
```

{% hint style="info" %}
When `new Promise` is created, the executor runs automatically! For now, this is not so powerful ; below you will see why this is very important.
{% endhint %}

A promise involve always two "entities" in your code, and bind them together. The concept is the following, there is the concept of
* An  `executor`, that does/returns something and generally take time. For instance, retrieving data over the network according to your REST API.
* A *consuming code*, that wants the result of the `executor` **once it’s ready** (not before! Because it is useless).

The `executor`'s arguments `resolve` and `reject` are callbacks automatically provided by JavaScript itself (no need to create them). They should always be present in the definition of the executor of your promise. When the executor **obtains the result**, be it soon or late, doesn’t matter, it should **call one** of these callbacks:
* `resolve(value)`: if the job finished successfully, with result value.
* `reject(error)`: if an error occurred, error is the error object.

![Illustration on how the executor moves promise into one of these two states](resources/promise-resolve-reject.svg)

(Please mind the three differents states of a promise, as well as the value of the `result` property)
Now, let's illustrate how this works with a simple `executor` code using `setTimeout`.
```js
let promise = new Promise(function(resolve, reject) { // reminds that the executor is automatically executed when the promise is constructed
  setTimeout(() => resolve("done"), 1000); // after 1 second, we consider the operation successful and we return the result "done"
});
```
After one second of “processing” the `executor` calls `resolve("done")` to produce the result. This changes the state of the promise object from `pending` to `fulfilled`.

This goes the same for the executor rejecting the promise with an error:
```js
let promise = new Promise(function(resolve, reject) { // reminds that the executor is automatically executed when the promise is constructed
  setTimeout(() => reject(new Error("Whoops!")), 1000); // after 1 second, we consider the operation failed and we return an error object
});
```
{% hint style="info" %}
A promise which is either `resolve`d or `reject`ed is called *settled*.
{% endhint %}

{% hint style="danger" %}
There can be only a single result or an error. The executor should call only one resolve or one reject. Subsequent call to `resolve` or `reject` are simply ignored : any **state change is final**. HOWEVER, instructions after the call to `resolve` or `reject` are still performed.
{% endhint %}

{% hint style="warning" %}
`resolve`/`reject` expect only one argument (or none) and will ignore additional arguments.
{% endhint %}

### Consumming promise
As stated before, a promise bind an `executor` with a "consumer" which will receive the result or the error from the executor. A "consumer" is represented by consuming functions that are subscribed to the promise using one the three following methods/handlers:
* `.then`
* `.catch`
* `.finally`

#### then
The `.then` handler is the fundamental one for promises. It dispatches the executor's `result` variable to the appropriate consuming function according to the executor's `state`. The syntax is:
```js
promise.then(
  function(result) { /* handle a successful result */ },
  function(error) { /* handle an error */ }
);
```
The first argument of `.then` is the function to run when the promise is `resolve`d, and takes the `result`. The second argument is the function to run when the promise is `reject`ed, and receives the `error` from the executor. It can be used as follow:
```js
let promise = new Promise(function(resolve, reject) { //don't forget ! the code runs automatically, but we wait 1 sec
  setTimeout(() => resolve("done!"), 1000);
});
promise.then(
  result => alert(result), // shows "done!" after 1 second since we always resolve
  error => alert(error) // doesn't run
);
``` 
{% hint style="info" %}
In case you don't ever handle error in your promise, you can ommit the second parameter like and simplify the writting like : `promise.then(alert);` because alert only take one argument.
{% endhint %}

#### catch
The `.catch` handler is designed to simplify the retrieve of the error if you are only interested by it. Instead of using `.then` with a `null` value for the `resolve` like `.then(null, errorHandlingFunction)`, we can use `.catch(errorHandlingFunction)` which does exactly the same.
```js
let promise = new Promise((resolve, reject) => {
  setTimeout(() => reject(new Error("Whoops!")), 1000);
});
// .catch(f) is the same as promise.then(null, f)
promise.catch(alert); // shows "Error: Whoops!" after 1 second
```
#### finally
The call to `.finally` will always run the consuming function associated with when the promise is **settled** (*i.e.* has been `resolve`d or `reject`ed). It is a good handler for performing cleanup (*e.g.* stopping our loading animations, etc.).

{% hint style="warning" %}
`.finally` has no arguments: we do not know whether the promise is successful or not. This should not bother you because the kind of operations here are supposed to be "global", like stoping loading animation, etc.
{% endhint %}

{% hint style="info" %}
`.finally` does not process any promise: it passes through `results` and `errors` to the next handler.
{% endhint %}

```js
new Promise((resolve, reject) => {
  setTimeout(() => resolve("result"), 2000)
})
  .finally(() => alert("Promise ready. Do global task"))
  .then(result => alert(result)); // .then still handles the result. IDEM for reject
```

### Chaining promise
Promises offer a really convenient way to deal with a sequence of asynchronous tasks to be performed one after another, which is call **chaining**. The idea beyond chaining is that the result is passed through the chain of `.then` handlers.

![Illustration of chaining](resources/promise-then-chain.svg)

The chaining process is possible because a call to `promise.then` returns a [**thenable**](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Promise/resolve) object (quite equivalent to a **promise**). Therefore, we can also call the next `.then` on it.

```js
new Promise(function(resolve, reject) {

  setTimeout(() => resolve(1), 1000); // asyncrhonous

}).then(function(result) { // when the above executor finishes, execute this one

  alert(result); // 1
  return result * 2;

}).then(function(result) { // handle the return value of the previous executor (result * 2)

  alert(result); // 2
  return result * 3;

}).then(function(result) { // handle the return value of the previous executor (result * 3)

  alert(result); // 4
  return result * 4;

});
```

The triggering of the chaining is asynchrone, but even if the two last executors looks like they run in a synchronous way, they don't. They indeed wait the previous executor to finish, but if you are writing code below a `.then` handler the code will run probably before the handler.

You can also reintroduce asynchronicity in the chaining by creating and returning a new promise.

```js
new Promise(function(resolve, reject) {

  setTimeout(() => resolve(1), 1000);

}).then(function(result) { // triggered after 1sec

  alert(result); // 1

  return new Promise((resolve, reject) => { // returning a new promise. REMEMBER! a new promise constructor automatically run the executor!
    setTimeout(() => resolve(result * 2), 5000);
  });

}).then(function(result) { // triggered after 5 sec (so ~6sec in total since the begigning)

  alert(result); // 2

  return new Promise((resolve, reject) => { //Idem
    setTimeout(() => reject(result * 3), 2000); //this time we trigger an error for the sake of example
  });

}).then(null, function(error) { // or (error) => alert(error)

  alert(error); // 6, in the error state
});
```

Let's see another, more concrete, example with the [`fetch`](https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API) method (more powerfull and flexible than `XMLHttpRequest`). We will retrieve my GitHub avatar, by finding my name in the commit history of the CDAW project on github, then display it for 3sec before removing it.

```js
fetch('https://api.github.com/repos/ceri-num/uv-cdaw/commits')
  .then(response => response.json())
  .then(commits => fetch("https://api.github.com/users/"+commits[10].author.login))
  .then(response => response.json())
  .then(githubUser => {
    let img = document.createElement('img');
    img.src = githubUser.avatar_url;
    img.className = "promise-avatar-example";
    document.body.append(img);

    setTimeout(() => img.remove(), 3000); // async callback, removing the img
  });
```
{% hint style="info" %}
Do not forget that you can split your code into reusable function! For example, one for retrieving the GitHub username.
{% endhint %}

Remember, anyway, that : **Promise handling is always asynchronous!** Even if a `.then` wait the previous `.then` to finish, all the rest of your code is still running!

## Micro-managing the synchronicity

### async
The `async` keyword, put in front of a function declaration, turn the function into an `async function`. An `async function` is a function that knows how to expect the possibility of the `await` keyword being used to invoke asynchronous code. An `async function` in fact returns **-- automatically or not --** a promise.

```js
async function f() {
  return 7;
}

f().then(console.log); // cli : 7
```
Is equivalent to
```js
function f(){
  return new Promise((resolve, reject) => resolve(7));
}
```
So, `async` ensures that the function always returns a promise, wrapping anything non-promises in a promise.

### await
The `await` keyword works only inside `async function`s. It makes JavaScript actually wait that the promise's state settles and return its result.

The syntax looks like:
```js
let value = await promise; // works only inside async functions
```

The important thing to note is that the execution is "paused" until the promise is settled. That means that the code below the `await` instruction will not be executed until the promise is finished.

```js
async function f() {
  let promise = new Promise((resolve, reject) => { // our previous example with the executor waiting 1 sec
    setTimeout(() => resolve("done!"), 1000)
  });
  // here the clock is already running
  let result = await promise; // BLOCK! Wait until the promise resolves. Result store the result of the promise, here "done"

  alert(result); // trigger an alert after waiting the promise to end, ~1 sec. after
}
f();
```

{% hint style="info" %}
`await` doesn’t cost any CPU resources (unless the executor consumes CPU, ofc), because the JavaScript engine can do other jobs in the meantime: execute other scripts, handle events, etc.
{% endhint %}

Roughly speaking, it can be seen as a more elegant way to deal with `.then` handlers. 

```js
async function myGitHubAvatar(){
  let response = await fetch('https://api.github.com/repos/ceri-num/uv-cdaw/commits');
  let commits = await response.json();
  let user = await fetch("https://api.github.com/users/"+commits[10].author.login);
  let githubUser = await user.json();
 	
  let img = document.createElement('img');
  img.src = githubUser.avatar_url;
  img.className = "promise-avatar-example";
  document.body.append(img);

  await new Promise((resolve, reject) => setTimeout(resolve, 3000)); // async callback, removing the img
  
  img.remove();
  return githubUser
}
myGitHubAvatar();
```

To conclude, to call an `async function` from an non-async, do not forget that you receive a promise!
```js
async function waitingF() {
  await new Promise(resolve => setTimeout(resolve, 1000)); //wait 1 sec
  return 7;
}
function f() { //non async function, we can't use await here!
  waitingF().then(result => alert(result)); //simply use .then
}
f();
```
{% hint style="warning" %}
Handling error for `async`/`await` function is relying on `try...catch` syntax, instead of the `.catch` handler.
{% endhint  %}