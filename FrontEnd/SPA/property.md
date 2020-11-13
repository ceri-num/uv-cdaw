https://www.w3jar.com/vuejs-directives-and-data-binding-with-two-way-data-binding/


Instead, a component’s data option must be a function, so that each instance can maintain an independent copy of the returned data object:

data: function () {
  return {
    count: 0
  }
}