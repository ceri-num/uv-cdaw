#

## Exercice 1

## Exercice 2
```js
function Event(name){
  this.name = name;
  this.callbacks = [];
}
Event.prototype.registerCallback = function(callback){
  this.callbacks.push(callback);
}

function Reactor(){
  this.events = {};
}

Reactor.prototype.registerEvent = function(eventName){
  var event = new Event(eventName);
  this.events[eventName] = event;
};

Reactor.prototype.dispatchEvent = function(eventName, eventArgs){
  this.events[eventName].callbacks.forEach(function(callback){
    callback(eventArgs);
  });
};

Reactor.prototype.addEventListener = function(eventName, callback){
  this.events[eventName].registerCallback(callback);
};
```

Use it like DOM events model
```js
var reactor = new Reactor();

reactor.registerEvent('big bang');

reactor.addEventListener('big bang', function(){
  console.log('This is big bang listener yo!');
});

reactor.addEventListener('big bang', function(){
  console.log('This is another big bang listener yo!');
});

reactor.dispatchEvent('big bang');
```