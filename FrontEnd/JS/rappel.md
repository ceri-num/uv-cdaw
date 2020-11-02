# Reminders

JavaScript is a weakly typed language, mostly used to manipulate the DOM of a web page.

Additionally, JavaScript is an object-oriented language (but it allows imperatif and also lambda calculus). However, its main difference with language like Java or C++ is that it is a **prototype based language** and **not** a class based one. We will saw the implication of such a statement in the [Object-oriented programming](poo.md) section.
Briefly said, anything but primitive types is an object in JavaScript.

This section serves as a quick reminder, mostly regarding the syntax, for several important notions.

## Language core

### Condition
#### Statement
JavaScript has **three** different conditionals, well known in other languages as well.

The `if...else` conditional.
```js
if(condition)
{
  //code
}
else if(cond2)//optionnel
{
  //code
}
else
{
  //code
}
```

The ternary statement.
```js
(condition) ? instruction;if;true; : instruction;if;false;
```

The `switch` statement.
```js
switch (expression) // NOT a condition
{
  case 1:
    code;
    break;
  case 2:
    code:
    break;
  default:// Don't forget me
    code; //no break needed, we are at the end
}
```

#### Strict egality vs. egality
JavaScript has **three** different ways to perform an egality check, either with their own specificity.

The first one is the simple equality made by the `==` operator. It **does** make a data type converstion before the comparison of the objects. You can have important side effects if not used correctly.
```js
console.log('1' ==  1);// CLI: true
```

The second equality operator is the strict operator `===` (3 `=`). The most notable difference between this operator and the simple equality operator is that if the operands are of different types, it **will not attempt** to convert them to the same type before comparing.
```js
console.log('1' ===  1);// CLI: false
```

The last equality operator is `Object.is()` operator. It determines whether two values are **the same value**. It is widely different to `==` since it does not perform coerce checks, and differ from `===` in regard that it treats the number values `-0` and `+0` as equal and treats `Number.NaN` as not equal to `NaN`.
```js
var foo = { a: 1 };
var bar = { a: 1 };
Object.is(foo, foo);         // CLI: true
Object.is(foo, bar);         // CLI: false
```
![Egality table, courtesy of MDN](resources/egality.png)

### Loops
In JavaScript, the 3 classic loop structures are available:
* `for`
* `while`
* `do...while`

The `for` loop repeats until a specified condition evaluates to false. A `for` statement looks as follow:
```js
for(let i = 0; i < selectObject.options.length; i++)
{
    //instructions goes here
}
```

The `do...while` statement repeats until a specified condition evaluates to false. It looks as follows (do not forget the semi colon at the end of the while instruction):
```js
let i = 0;
do {
    i += 1;
    console.log(i);
} while (i < 5);
```

A `while` statement executes its statements as long as a specified condition evaluates to true. It looks as follows:
```js
let i = 2;
while (i < 65536) {
  n*=n;
}
```

### Data types
JavaScript is weakly typed, meaning that the variables do not have a specific on their declaration. Instead, we use a generic keyword declaration to declare a new variable.

There is only **three** declaration keywords in JS. They are:

* `let`: allows the declaration of a block scope **local variable** (it is destroyed while outside the block) ; it can optionally be initialized to a value ;
* `var`: declares a variable, optionally initializing it to a value ;
* `const`: declares a read-only named constant.

```js
var myVar = 7;
```

### Function
Basically, a function is defined by its name, and its parameters. It **does not** have a return type: therefore you must be carreful about how the code is documented.
A function declaration looks as follow:
```js
function foo(param1, param2)
{
  //instruction
  return result; //optional
}
```

To invoke a function:
```js
foo(7777, "hello")
```
## Advanced Reminders
### Specific iteration control keywords
There is two specific keywords used to control how the iteration goes:

* `break`
* `continue`

The `break` statement is used to terminate a loop, switch, or in conjunction with a labeled statement (more info [here](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/statements/label)). When you use `break` without a label -- the most probable way of using it -- it terminates the innermost enclosing `while`, `do-while`, `for`, or `switch` immediately. The important thing to remember is that it transfers control to the following statement.

```js
for (let i = 0; i < a.length; i++) {
  if (a[i] === theValue) {
    break;
  }
}
```
This statement is quite interesting because it prevents unnecessary iteration over the entities being iterated, in addition to being clear.

The `continue` statement can be used to restart a `while`, `do-while`, `for`, or label statement. When you use `continue` without a label, it **terminates the current iteration** of the innermost enclosing `while`, `do-while`, or `for` statement and continues execution of the loop with the next iteration. In contrast to the break statement, `continue` **does not** terminate the execution of the loop entirely. In a `while` loop, it jumps back to the condition. In a `for` loop, it jumps to the increment-expression.

```js
let i = 0;
let n = 0;
while (i < 5) {
  i++;
  if (i === 3) {
    continue;
  }
  n += i;
  console.log(n);
}
//cli: 1,3,7,12
```

### Special loops

In addition to these three loops, there also exists three more loops mostly used to iterate over element of a collection:

* `forEach`
* `for... in`
* `for... of`

`forEach` is not quite a special control structure but more a prototype method attached to the `Array` object (more information about prototype in the [OOP section](poo.md)). It executes a provided function once for each array element. Be careful however, since this method does not copy the array: it directly uses the collection and if it cause some desynchronisation or unexpected behavior, mostly if you remove/add new element in the collection.

```js
const array1 = ['a', 'b', 'c'];

list.forEach((item, index) => {
  console.log(item) //value
  console.log(index) //index
})
//index is option: list.forEach(item => console.log(item))
```
> ⚠️ The `=>` element indicates an arrow function. We will talk about that below, and in the [Errors & Promises](promisemeerror.md) part.


The `for...in` statement iterates a specified variable over all the enumerable properties of an object. For each distinct property, JavaScript executes the specified statements. A `for...in` statement looks as follows:
```js
let player = { name:"Clive", pv: 25, job: "Warrior" };
for (let item in player) {
   console.log(student[item])
}
// résultats : Clive \n 25 \n Warrior
```
> ⚠️ Use the `for...in` statement wisely! For example, it is not advise to use it for `Arrays` instead of `for`. The principal reason is that it will iterate also on the user-specified variable, not only on the numerical index.

The `for...of` statement creates a loop iterating over iterable objects (including `Array`, `Map`, arguments object and so on), invoking a custom iteration hook with statements to be executed for **the value** of each distinct property. A `for...of` statement looks as follows:
```js
const myarray = [2, 4, 8];
myarray.foo = 'someText';
for (const i of myarray) {
   console.log(i); // logs 2, 4, 8
}
```

> ❓ A `for...in` loop would have displayed `0,1,2,"someText"` instead of the value of the array.

> ❓ A hook is a special invokation function mecanism. More information below.

### Iterator and generator
#### Iterator
The notion of iterator comes from the fact that processing each item of a collection is a very common operation in computing. The important notions *behind* an iterator are that at a specific moment it points toward a specific item of the collection and that there is a well defined sequence in the collection (implied by the *specific moment*). Thus, an iterator must answer the following questions:

![Iterator example](resources/it.png)

In JavaScript an iterator is an object which defines a sequence and potentially a return value upon its termination (simply stated, this is the iteration protocols):
* Is there any element left in the collection ?
* What is this very element if it exists ?

In fact, you already have used an iterator by using loop such as `for...of` without knowing it.

Technically speaking, any object is qualifiable as an iterator if it has a `next()` method and it returns an object with the two following properties:
* `done`: a boolean value indicating whether or not there are any more items that could be iterated upon. If `true`, there is no more item.
* `value`: the current element

If you have a custom type and want to make it iterable so that you can use the `for...of` loop construct, you need to implement the iteration protocols.
The following code creates a `Sequence` object that returns a list of numbers in the range of (`start`, `end`) with an interval between subsequent numbers.
```js
class Sequence {
    constructor(start = 0, end = Infinity, interval = 1 ) {
        this.start = start;
        this.end = end;
        this.interval = interval;
    }
    [Symbol.iterator]() {
        let counter = 0;
        let nextIndex = this.start;
        return  {
            next: () => {
                if ( nextIndex <= this.end ) {
                    let result = { value: nextIndex,  done: false } // done is important!
                    nextIndex += this.interval;
                    counter++;
                    return result;
                }
                return { value: counter, done: true }; // IDEM, done is important
            }
        }
    }
};
```
To use the built-in iterator of `Sequence`, there is mainly two ways:
```js
let nbPair = new Sequence(2, 10, 2);

for (const num of nbPair) {
    console.log(num);
} //cli: 2 4 6 8 10

// OU
let iterator = nbPair[Symbol.iterator]();//Retrieving the iterator through the well-known symbol

let result = iterator.next();

while( !result.done ) // while there is still something
{
    console.log(result.value);
    result = iterator.next();
}
```
> ❓ A well though iterator can be very efficient and versatile. For example, for your Mahjong project, you could define an iterator iterating over a familly, and making it also generate this very familly (somewhat like `Sequence`).

#### Generator & Iterable
One issue with custome iterators is that their creation requires careful programming since their internal state has to be explicitly maintained.
To circumvent this issue, generator functions allow the definition of a single function whose execution **is not continuous**.

When called, generator functions do not initially execute their code. Instead, they return a special type of iterator, called a Generator. When a value is consumed by calling the generator's next method, the Generator function executes until it encounters the `yield` keyword. In other hand, the execution is suspended once a `yield` is encountered, and resumed after it at the next call.

The function can be called as many times as desired, and returns a new Generator each time.

Generator functions are written using the `function*` syntax, as follow (taking the `Sequence` example above, droping the class aspect):
```js
function* Sequence(start = 0, end = Infinity, step = 1) {
    let iterationCount = 0;
    for (let i = start; i < end; i += step) {
        iterationCount++;
        yield i;
    }
    return iterationCount;
}

const s = Sequence(1, 10, 2);
for(let x in s)
{
    console.log(x); //CLI: 1 3 5 7 9
}
```

Generators compute their yielded values on demand, which allows them to efficiently represent sequences that are expensive to compute (or even infinite sequences, as demonstrated above). An advanced generator could be, for the fibonacci sequence:
```js
function* fibonacci() {
  let current = 0;
  let next = 1;
  while (true) {
    let reset = yield current;
    [current, next] = [next, next + current];
    if (reset) {
        current = 0;
        next = 1;
    }
  }
}

const sequence = fibonacci();
console.log(sequence.next().value);     // 0
console.log(sequence.next().value);     // 1
console.log(sequence.next().value);     // 1
console.log(sequence.next().value);     // 2
console.log(sequence.next().value);     // 3
console.log(sequence.next().value);     // 5, etc
```

To conclude, an object is **directly iterable** if it has an iteration behavior by implementing the `@@iterator` method. This simply means that the object needs to have a property `[Symbol.iterator]`.

To make your own iterables:
```js
const myIterable = {
    *[Symbol.iterator]() {
        yield 1;
        yield 2;
        yield 3;
    }
}
```
In the difference of generators where their iterator can be iterated only once, an iterable can be used several times.
```js
function* makeIterator() {
    yield 1;
    yield 2;
}

let it = makeIterator();

for (const itItem of it) { // CLI: 1 2
    console.log(itItem);
}

for (const itItem of it) { //this loop is not exectued, it.next() has done:true
    console.log(itItem);
}
console.log(it[Symbol.iterator]() === it) // true;

it[Symbol.iterator] = function* () {
  yield 2;
  yield 1;
};

for (const itItem of it) { // CLI: 2 1
    console.log(itItem);
}

for (const itItem of it) { //this loop is executed again, CLI : 2 1
    console.log(itItem);
}
console.log(it[Symbol.iterator]() === it) // false;
```

### Functions
#### Anonymous functions
There is a difference between a function delcaration and a function expression. A function The later can have its name omitted, defining an anonymous function.
The main difference between a function expression and a function declaration is the function name, which can be omitted in function expressions to create anonymous functions. 

```js
function()
{
  console.log("Hi! I'm anon");
}
```

> ⚠️ An anonymous function will do **nothing** on its own (except enclosed in a grouping operator -- see beelow). It need to be "manually" invoked.

These kind of functions are commonly used along event handler or callback function.

```js
document.addEventListener("DOMContentLoaded", function() {
  console.log("Hi! I'm anon once the DOM is loaded");
});
```

However, anonymous functions are not condamned to be used only once. In fact, a function expression can be assign to a variable, making it invokable wherever needed.
```js
var maVar = function()
{
  console.log("Hi! I'm anon");
}

// then invoke it
maVar();
```

> ❓ Stored anonymous function can be a good way to separate your functions -- which actually do things -- from your event handlers -- which triggers things. Example:
> ```js
> // Do stuff on scroll
> var onScrollHandler = function (event) {
>	 // Do something on scroll...
> };
>
> // Listen for scroll events
> window.addEventListener('scroll', onScrollHandler, false);
> ```

#### IIFE (Immediately Invoked Function Expression)
A function expression can be used as an IIFE (Immediately Invoked Function Expression) which runs as soon as it is defined.
In addition of being directly interpreted, an IIFE has its lexical scope enclosed within the `Grouping Operator ()`. This prevents accessing variables within the IIFE idiom as well as polluting the global scope.

An IIFE cannot be stored in a variable. Assigning it to a variable stores its return value instead of its definition. An `IIFE` statement looks as foolow:
```js
(function(){console.log("IIFE1")})();

var result =( function () 
              {
                var name = "IIFE2"; 
                return name; 
              } 
            )(); 
result; // Contains "IIFE2"
console.log(name); // throws "Uncaught ReferenceError: name is not defined"
```

#### Arrow function
An arrow function expression is a compact alternative to a traditional function expression, but is limited and cannot be used in all situations. One of the major reason arrow functions were introduced was to alleviate scope complexities ( `this` ) thus making functions execution much more intuitive. There is several way of declaring an arrow function. The two most common are:
```js
() => 5 * 2; //no parameter, return is implicit, one line

(a,x) => { // multi line, multi param, return mandatory
  a += 5;
  return a * x;
}
```

Check [MDN](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Functions/Arrow_functions) for more in depth information about arrow functions.

> ❓ Arrow function are best suited for non-method functions, mostly due by the scope (non-)modification implied. By using it as an object method, since an object does not create a new scope the `this` context does not change, and the arrow-function does not have its own `this`.

### In depth Variable's scope
anon function define its local scope but this keyword

```js
var x = 10;

function a()
{
	var x = 7;
	console.log(this.x);
  console.log(x);
}

var y = function()
{
	var x = 2;
  console.log(this.x);
  console.log(x);
}

a(); // CLI: 10, 7
y(); // CLI: 10, 2
```

Defining an object does not create a new scope.

this redefined in each ctx
```js
window.age = 10; // <-- notice me?
function Person() {
  this.age = 42; // <-- notice me?
  setTimeout(function () { // <-- Traditional function is executing on the window scope
    console.log("this.age", this.age); // yields "10" because the function executes on the window scope
  }, 100);
}
```
#### Closure
check closure example :http://www.javascriptkit.com/javatutors/closures2.shtml

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

var and hoisting : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/var#var_hoisting