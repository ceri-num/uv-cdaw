# Reminders

JavaScript is a weakly typed language, mostly used to manipulate the DOM of a web page.

Additionally, JavaScript is an object-oriented language (but it allows imperatif and also lambda calculus). However, its main difference with language like Java or C++ is that it is a **prototype based language** and **not** a class based one. We will saw the implication of such a statement in the [Object-oriented programming](poo.md) section.
Briefly said, anything but primitive types is an object in JavaScript.

This section serves as a quick reminder, mostly regarding the syntax, for several important notions.

## Language core

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

#### Specific iteration control keywords
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

#### Special loops

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
⚠️ The `=>` element indicates a promise. We will talk about that in the [Errors & Promises](promisemeerror.md) section.


The `for...in` statement iterates a specified variable over all the enumerable properties of an object. For each distinct property, JavaScript executes the specified statements. A `for...in` statement looks as follows:
```js
let player = { name:"Clive", pv: 25, job: "Warrior" };
for (let item in player) {
   console.log(student[item])
}
// résultats : Clive \n 25 \n Warrior
```
⚠️ Use the `for...in` statement wisely! For example, it is not advise to use it for `Arrays` instead of `for`. The principal reason is that it will iterate also on the user-specified variable, not only on the numerical index.

The `for...of` statement creates a loop iterating over iterable objects (including `Array`, `Map`, arguments object and so on), invoking a custom iteration hook with statements to be executed for **the value** of each distinct property. A `for...of` statement looks as follows:
```js
const myarray = [2, 4, 8];
myarray.foo = 'someText';
for (const i of myarray) {
   console.log(i); // logs 2, 4, 8
}
```

❓ A `for...in` loop would have display `0,1,2,"someText"` instead of the value of the array.

❓ A hook is special invokat function mecanism. More information below.

#### Iterator and generator


### Condition

### Data types
JavaScript is weakly typed, meaning that the variables do not have a specific on their declaration. Instead, we use a generic keyword declaration to declare a new variable.

There is only **three** declaration keywords in JS. They are:

* `let`: allows the declaration of a block scope **local variable** (it is destroyed while outside the block) ; it can optionally be initialized to a value ;
* `var`: declares a variable, optionally initializing it to a value ;
* `const`: declares a read-only named constant.

```js
var myVar = 7;
```

## Functions
### Function

### Anonymous functions

### Arrow functions

## In depth Variable's scope
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