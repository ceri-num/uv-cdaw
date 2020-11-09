# Client side Web API

In this section, we will see the principal Web API client-side which are built-in the browsers. As a reminder, API (Application Programming Interfaces) are a way to simplify the construction of complex functionnalities by using abstract, high-level, functionnalities. The principal API we will use are the **DOM API**, used to manipulate the DOM for your page.

For your project, you will probably need the four following API:
* DOM API
* Fetching API
* Drawing API
* Audio API

Generally speaking, an API uses JavaScript object to handle the data from the API. This means that you can manipulate these objects in your code and access API's data easily by they properties and their methods. For example, retrieving a document on the page `Object.getElementById(id)` or playing a sound `SoundObject.play()`.

{% hint style="info" %}
Most of API are events based, and handle events to change their inner state. Thus, they heavily rely on callback functions to behave correctly according to specific situation in your code (*e.g.* `xmlHttpRequest` object). Check the [Event section](event.md) for more information about callbacks.
{% endhint %}

## Entry points notion
When manipulating an API, you should identify where its entry point(s) is(are). An entry point is generally an object representing the API's data, where most of the functionnalities of the API are available and where you can begin to work with.

Obviously, the entry point for the DOM API is the Document `document`, or an instance of an HTML element that you want to affect in some way. For the 2D API `Canvas`, its the `<canvas>` element and then calling `CanvasElement.getContext()`.

{% hint style="info" %}
When you are learning a new API, check for its entry points first. They will help you to understand the "flow" of the API.
{% endhint %}

## DOM API
As you already know, the content you see in your browser is a set of HTML, CSS and JS. HTML is the content of your web page, and has a tree structure in order to be easier to be manipulate. This tree structure is called **DOM**.

![HTML tree using Ian Hickson's [Live DOM viewer](https://software.hixie.ch/utilities/js/live-dom-viewer/)](resources/html_tree.png)

In the above tree example, we can highlight important concepts:
* **Element node**: It is an element as it exists in an HTML file (*e.g.* `<p>`)
* **Root node**: The top node in the tree, which is always `HTML` for HTML file
* **Child node**: The direct node of a chosed node
* **Descendant node**: A node contained inside a chosed node, independantly of its depths
* **Parent node**: The node of a descendant node
* **Sibling nodes**: Nodes that are in the same level in the DOM tree
* **Text node**: A node containing a text string

JavaScript has been made principally to manipulate the DOM of a page.

### Retrieving DOM elements
DOM elements retrieval is more than a common operation: it allows you to get the element to listen to, the element you want to update and so on. There is a lot of way for selecting DOM elements in JS. We will see the more common and convenient here.

Old selector functions are `getElementByClass` and `getElementById`. They select specific elements in the DOM according, respectively, to their class or their id. They are used with a direct reference with the document.

```js
let myIdElm = document.getElementById("idOfMyHTML"); //returns only the html object maching, or undefined
let myClassElems = document.getElementByClass("myclassHTML"); //return an array-like object of all the elements found with myclassHTML
```

In more recent JavaScript version, [`querySelector`](https://developer.mozilla.org/en-US/docs/Web/API/Document/querySelector) has been introduced. It is more powerfull and versatile than the `getElementByXXX` since it combines all these functions in one. Concretly, `querySelector` relies on CSS selector to perform the search in the DOM tree, somewhat unifying the selecting keywords in JS and CSS.

The above example can be written as follow using `querySelector`

```js
let myIdElm = document.querySelector("#idOfMyHTML");
let myClassElems = document.querySelectorAll(".myclassHTML"); //Note we use querySelectorAll here, returning an array-like 
```

Consequently, since you can use CSS selector in `querySelector`, you can now make complex query (taken from [MDN](https://developer.mozilla.org/en-US/docs/Web/API/Document/querySelector))
```js
let myElm = document.querySelector("div.user-panel.main input[name='login']")
```
### Adding/removing elements to the DOM
You can manually add (therefore creating) new elements to the DOM using JavaScript. To create programmatically a new HTML element, the keyword is `createElement(ANY_HTML_ELMT)`, and it is used like that:

```js
let newElm = document.createElement("p"); // create a new <div> element
newElm.textContent = "Let's make some content here";
```

Now, we just need to attach this new paragraph to our document. Let's say that we want to attach it to the main div of our page, then we first need to select these div, and attach its the new paragraph.

```js
let divToAttach = document.querySelector("div#main");
divToAttach.appendChild(newElm); // p is attached (to the end) of the div now !
```

{% hint style="info" %}
Applying several time appendChild with the same object will not duplicate it in the reference node. If you need to duplicate an element, use the `.cloneNode` method.
{% endhint %}

### Attributes, Properties and Data

#### Attributes
HTML element can have attributes (*e.g.* an `id`, a `src`). Since getting DOM elements returns us objects, we can directly access these attributes in their properties! 

```js
let elm = document.querySelector("#superId");
alert(elm.id); // superId from the object elm
```

Sometimes, though, the attributes attached to an HTML element can be **non-standard** (*i.e.* either not expected for the element, or does not exist in the standard). For non-standard attributes, their corresponding properties **are not created** in the object! 

```js
<div id="standard" plop="non-standard"></div>

let elm = document.querySelector("#standard");
alert(elm.plop); //undefined!
```

However, you can access/modify/remove such non-standard attributes by using the following methods:
* `.hasAttribute(name)`
* `.getAttribute(name)`
* `.setAttribute(name, value)`
* `.removeAttribute(name)`

#### Syncrhonization
When a **standard** attribute changes, the change also reflects in the corresponding property. The other way is also true. So when you perform a `elm.setAttribute("attr", value)`, the changed is reported back to the HTML element's attribute.

However, their is (ofc...) exceptions to this. For example, the `input.value` synchronises itself only in the attribute -> propertye way, not the other. That means that you cannot perform a `.setAttribute("value", "someVal")` on an input element. 

#### Properties and Dataset
Non-standard properties are usefull to pass some specific data to your HTML elements. However, since the HTML evolves continiously, it may happen that your non standard property becomes a standard property, possibly making huge mess in your code.

That is why to avoid conflict dataset has been introduced for the `data-*` attributes. All HTML object has a dataset property listing all the data attributes an HTML element has.

{% hint style="info" %}
All attributes starting with “data-” are reserved for programmers’ use. They are available in the dataset property.
{% endhint %}

For example, if your element has an data attribute named `data-family`, you can access it:

```js
let elm = document.querySelector("#idTest");
alert(elm.dataset.family) // bamboo
elm.dataset.family = "circle"; //setting non standard elm
```

{% hint style="warning" %}
Multiword attributes like `data-my-family` become camel-cased: `dataset.orderMyFamily`.
{% endhint %}

In addition, data attribute can even be used to store other object (use it with parsimony). Since they are HTML attributes however, we can't store an object reference directly, we have to transform it in a compatible string. That is good because an object can be encoded as a JSON object, so with can do the following:

```js
let myObj = {
    name: "MyName",
    tileVal: "2",
}
let elm = document.querySelector("#idTest");
myObj.json().then(data => elm.dataset.tile = data);
```

{% hint style="info" %}
It is also possible to manipulate the styles of your DOM elements! More information [here](https://developer.mozilla.org/en-US/docs/Learn/JavaScript/Client-side_web_APIs/Manipulating_documents).
{% endhint %}

### Shadow DOM notions
In a web component paradigm (we will see that with Vue.js), an important aspect is the encapsulation of markup structure, styles and behaviors: they should nenot be leaking between components. However, due to how the DOM and the DOM API are made, this is not possible by simply using the standard DOM specification.

That is why the concept of Shadow DOM has been introduced. Shadow DOMs are hidden DOMs, not parsed by the DOM API, and only sensible to what happen inside them. We will cover this aspect in more detail in the Single Page Application section.

More information about [shadow dom here](https://developer.mozilla.org/en-US/docs/Glossary/Shadow_tree).

## Forms
Form and control elements are one of the principal source of interaction between your user and the server. That is why they have special properties and events attached to make their use more convenient in JavaScript.

```html
<form id="myId" name="myForm">
  <input type="radio" name="one" value="radioInput">
  <input type="password" name="two" value="mypwd">
  <input type="text" name="two" value="name">
</form>
```

Despite forms can be retrieved as any HTML elements using selector (*e.g.* `querySelector`), they are also member of a special named (and ordered) property collection of the `document`, called `forms`. And, each form of this `document.forms` collection has a named (and ordered) collection `elements`, listing all the elements contained in the form. Therefore, you can then easily access any form and form's elements in a page simply by name.

```js
let form = document.forms.myForm; //get the above form object!
let radio = form.elements.radio; //get the radio input object
let collec = form.elements.two; //get a collection containing the password input object and the text input object
```

{% hint style="info" %}
No matter how a form element is deep in the form, it is listed in the `elements` property of the form object.
{% endhint %}

If you organise your form with `<fieldset>` element, you gain even more control on how your form is structured. Each `fieldset` element also has an `elements` property listing all its child form elements. And since a `fieldset` is a form element, it is also retrievable by its name.

```js
let myFS = form.elements.myFieldsetName; //retrieving the myFieldsetName FS
let anElm = myFS.elements.name; // retrieving the input element name from the FS
```
{% hint style="info" %}
In case of Fieldset, that means your fieldset's elements exists both in the `form.elements` and in the `fieldset.elements`!
{% endhint %}

{% hint style="info" %}
There is a **backreferencing** for each element of a form. That means you can get the form where the element belongs. Simply use the `form` property of the form element.
```js
let circularForm = document.forms.myForm.radio.form; // get the myForm form!
```
{% endhint %}

### Form control
Form control is related to accessing, setting and checking form's elements value. To access their value, we can use the `value` property. Note that its content depends obviously of the type of input checked.

```js
let rdio = document.forms.myForm.radio.value; // the content of the radio value
let pwd =  document.forms.myForm.two[0].value; // the pwd
```

You can also set the element value.


{% hint style="danger" %}
Generally speaking, the information of interest in an element form is stored in the `value` property, not in the `innerHTML`.
{% endhint %}

### Form events
So far, we have seen how to access forms' elements. However, this is not really useful if we did not know when to check for their value! Luckily, JavaScript trigger a lot of events when elements are used.

#### Input
Every time an element's value is modified by the user, this event is triggered.

The input event does not only trigger with keyboard events, but also with other device, such as mouse (*e.g.* pasting a text from the clipboard) or with text recognition device. However, non altering action, such as pressing `^` alone (or directional arrow) does not trigger this event.

```js
let radio = document.forms.myForm.myRadio;
radio.addEventListener("input", function(data){
    alert("onInput!");
})
```
This event is good if you need a fine management on the element.

#### Change
However, we often don't need such a fine management over an element. We prefer to check the element once it has lost focused. The event is `change` and can be used as follow.

```js
let radio = document.forms.myForm.myRadio;
radio.addEventListener("change", function(data){
    alert("onChange!");
})
```

{% hint style="succes" %}
If you want to check if a name is free or already taken in your form for example, you will want to wait until the user leaves the field ; otherwise if you use the input event, for each input, you will interrogate your server which is a total waste of resources!
{% endhint %}

#### Submit
The `submit` event triggers when a form is submitted. This means that either an input of `type="submit"` as been clicked or enter has been pressed in a field. This is usually used to validate the form before sending it to the server or to abort the submission and process it in JavaScript.

{% hint style="danger" %}
**Never ever trust** the user side of your application. It is possible to get rid of your data control. User side verification should be design with reducing the server side load in mind, not replacing it!
{% endhint %}

However, the `submit` event is not attached to the submit input, but to the form!

```js
let form = document.forms.myForm;
form.addEventListener("submit", function(data){
    alert("youhou! Soshin!");
    // perform form verif here !
})
```

The method `submit()` of a form allows to initiate form sending, from a JavaScript standpoint. This is useful to manually send our own forms to our server.

```js
let form = document.createElement('form');
form.action = 'https://google.com/search';
form.method = 'GET';
form.innerHTML = '<input name="form" value="test">';

// the form must be in the document to submit it
document.body.append(form);

form.submit();
```

{% hint style="info" %}
When using the `submit()` method, no submit event is triggered! Keep that in mind.
{% endhint %}


## Communicating with the server

### The old xmlHttpRequest

### Use Fetch!

## 2D and Sound