# Web Component

![Decomposition of a web page in web component](resources/tmpComponentExplain.png)

Where the following HTML code could be a transcription of the above example using component:
```html
<div id="app">
  <app-nav></app-nav>
  <app-view>
    <app-sidebar></app-sidebar>
    <app-content></app-content> <!--Contain a lot of <app-story> components-->
  </app-view>
</div>
```

## Template principle

## Binding

https://www.w3jar.com/vuejs-directives-and-data-binding-with-two-way-data-binding/