# Front end project set-up & organisation

For the project, you will:

1. Intensively use git. Thus you need to have a GitLab gVipers account accessible.
2. Use Vue.js as your web-application framework
3. Use the riichi mahjong tiles assets available [here](https://github.com/FluffyStuff/riichi-mahjong-tiles). These are svg assets of all the icons, as well as back and black of a tile : you will have to assemble them yourself in your game.

We will consider this majhong tiles project as a deleguate third party work: we don't handle its developpement and therefore you need to conserve a dependency of it in your project. Consequently, we will use **git submodule**.

{% hint style="info" %}
A git submodule is a way to use another git project within yours. More information [here](https://git-scm.com/book/en/v2/Git-Tools-Submodules)
{% endhint %}

{% hint style="info" %}
All the examples are shown using **Linux (Debian)**
{% endhint %}

## Create a new repository in Gvipers for your front end project
Go to [Gvipers](https://gvipers.imt-lille-douai.fr/) and login.

It is supposed that you already have created your git repository. If not, check the [Project presentation page](../../Projet/eval.md). We will store all the content of the front end project in a `frontend` directory which will be automatically created by the Vue.js assistant.

For the rest of this section, this repository is called `projet-cdaw`.


## Initialize your Vue.js project

### Prerequisites
You will need to have both Node.js and Vue.js installed for this section.

```bash
sudo apt install nodejs npm
```

Afterwards, you want to install Vue.js CLI globally (more details about the [Vue.js CLI](https://cli.vuejs.org/))

```bash
sudo npm install -g @vue/cli
```

This installs the command `vue` globally on your system, which is the command you use to create new workspaces, new projects or produce builds to share or distribute. `npm`will be used to serve your application during development.

### Workflow
{% hint style="warning" %}
This step should be made by only one person (preferably the manager of the project), then, once push to the remote, all the other collaborators should clone it.
{% endhint %}

First, clone your cdaw repository, and then access it:
```bash
cd your/Path
git clone https://gvipers.imt-lille-douai.fr/prenom.nom/projet-cdaw
cd projet-cdaw
```

If you have already created some other directories, they should be visible by now. Here, we will create our `frontend` directory, then populate it with a new empty pre-configured Vue.js project, acting as a backbone for the front-end for now. While being in your local repository `projet-cdaw`, type:

```bash
vue create frontend
```
Then, answer the prompt like the following:
* `Please pick a preset` answer with `Manually select features`
* In the radio list, pick: `Choose Vue version`, `Babel`, `Router`, `Linter/Formatter`
* Version of Vue.js: `2.x` (we will not use the beta version of Vue.js)
* `Use history mode for router` answer with `n`
* `Pick a linter` answer`ESLint with error prevention only`
* `Pick additionnal Lint features` answer `Lint on save`
* `Where do you prefer placing config for Babel` answer `DTC`.. oops answer `In dedicated config files`
* `Save this as a preset` -> answer this question as you want

After the installation of some additional packages, your local repository should looks like that:

![After NG init](resources/vue_init.png)

To check if your project works correctly, stay at the root of your project, then compile and serve it:
```bash
cd frontend
npm run serve
```
Then connect to `http://localhost:8080`: you should see Vue.js saying that everything works fine!

Now, we will create a new directory used to store the model of your application (remember, Vue.js is mostly view/controller based in a MVC/MMV approach). Go into the src directory, then create a new `model` directory, and an readme:

```bash
projet-cdaw/frontend> cd src
projet-cdaw/frontend/src> mkdir model && cd model
projet-cdaw/frontend/src/model> echo "# MODEL DIRECTORY FOR FRONT END APP" > README.md
```

Last step: add all these modifications to your project by commiting the change, then pushing them to the remote.
```bash
git add -A
git commit -m "Vue js init"
git push
```

### Correctly clone your project whith Vue.js
When you commit changes to your projet created with the Vue scafolder, all dependencies are ignored (due to the `.gitignore.git` file). Therefore, your project on your remote does not have the required dependencies required to be run. This means that, when you clone your remote on your local, you will not be able to run your app out of the box. First, you will need to retrieve the dependencies of your projet. To do so, use npm:

```bash
git clone https://gvipers.imt-lille-douai.fr/prenom.nom/projet-cdaw
cd projet-cdaw/frontend
npm update
```

After a few moments of installation, your projet should now be runnable:
```bash
npm run serve
```

## Set up your dependencies

### Correctly initialize your project

{% hint style="warning" %}
This step should be made by only one person (preferably the manager of the project), then, once push to the remote, all the other collaborators should clone it (cf. *Correctly clone your project* section)
{% endhint %}

If your front end repo is not yet on your local machine:

```bash
cd your/Path
git clone https://gvipers.imt-lille-douai.fr/prenom.nom/projet-cdaw
cd projet-cdaw
```

Now, we need to add the GitHub repo about riichi tiles as a submodule of our project. To do this:

```bash
git submodule add https://github.com/FluffyStuff/riichi-mahjong-tiles.git ./frontend/src/assets/img/mahjong-tiles
git status
```

After cloning the submodule in your local repository, printing the status of your local should show you some changes, like:

![Git Status after a Submodule Add](resources/submodule.png)

Indicating that you have correctly added the repository (and now located in assests/img/majhong-tiles).
You are all good to start working with Angular now for your front end!

Don't forget to **add/commit** your changes! Then push them to the remote.

### Correctly clone your project when it has submodule

When a project with submodules is cloned using git clone, it creates the directories that contain submodules, but none of the files within them! To retrieve their content, you need to perform two additional information.
1. `git submodule init` will update the local .git/config with the mapping from the .gitmodules file.
2. `git submodule update` will then fetch all the data from the submodule project and check out the mapped commit in the parent project.

From then, your project is correctly cloned, and all the dependencies are available.

To sum up all the actions:
```bash
cd your/Path
git clone https://gvipers.imt-lille-douai.fr/prenom.nom/projet-cdaw
cd projet-cdaw
git submodule init
git submodule update
```

### A word about submodules
Once properly init and update within a parent repository, a submodule can be used exactly like a standalone repository. This means it can be modified, commited, etc... 

More information: [Atlassian Submodule Tuto](https://www.atlassian.com/git/tutorials/git-submodule)
