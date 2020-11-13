---
author: Alexis Lebis
---
# Towards OOP in Vue.js 

In this section, we will see how you can conjuge an OOP approach with Vue.js

## Exporting your class
The first thing you need to do is to export your class declaration. If you have a one class per file project organisation, a `Weapon.js` class could look as
```js
export default class Weapon{
    constructor(val, type)
    {
      this.val = val;
      this.family = type;
    }
  }
```

Once your class is exported, you can still use it within other classes (or even inherit from them). For example, a `NPC.js` class using a weapon:
```js
import Weapon from "./my/path/Weapon.js"; //Weapon variable is available, we can construct new weapon is `new`

export default class NPC{ //don't forget to export this class too!
  constructor()
  {
    this.weapons = [];
    this.weapons[0] = new Weapon(5,"bamboo"); //new instance of weapon!
  }

  pickWeapon(wpn)
  {
    this.weapons.push(weapons);  
  }

  throwWeapon()
  {
    this.weapons.pop();
  }
}
```

Then, in a component, you can use this class. Example:
```html
<template>
  <div class="hello">
        <h1>{{ msg }}</h1>
        <p v-if="hand">
        yo!
        {{ npc.weapons.length }}<br/> <!--displaying size of the weapons array of the npc-->
        </p>
    </div>
</template>
<script>
```
```js
import Weapon from '../model/Weapon.js' //don't forget to import them
import NPC from '../model/NPC.js'

export default {
  name: 'myComponents',
  props: {
    msg: String
  },
  data(){
    return{
      npc: null, //our npc object
    }
  },
  mounted(){ //hook on mounted, we init the object. It could have been done before.
    this.npc = new NPC();

    this.npc.pickWeapon(new Weapon(7, "chakram"));
    console.log("New weapon acquired! GG");

    setTimeout(() => { //update of the weapons, we will throw a weapon in 2 sec, for testing reactivity since we print the array length!
      this.npc.throwWeapon();
      console.log("Weapon throws");
      this.npc.weapons[0].family = "reactivIsIt?"; //re-render once modified!
      }, 2000);
  }
}
```
```html
</script>
```

With that, you have all you need to adopt an OOP approach in your Front End app! Have fun!