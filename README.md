## Création d'un site au vue de passer un ECF Développeur wed et web mobile 



# <p align=center style="color:blue">Bienvenue sur ARCADIA</p>


## <span style="color: green">Livrable attendu pour l'examen de ce bloc</span>

### <span style="color: purple">Toutes les compétences du titre professionnel développeur Web et Web Mobile seront analysées grâce à ce projet.</span>

#### Activité – Type 1 : Développer la partie front-end d'une application web ou web mobile sécurisée.

- Installer et configurer son environnement de travail en fonction du projet web ou web mobile.

- Maquetter des interfaces utilisateur web ou web mobile.

- Réaliser des interfaces utilisateur statiques web ou web mobile.

- Développer la partie dynamique des interfaces utilisateur web ou web mobile.

#### Activité – Type 2 : Développer la partie back-end d'une application web ou web mobile sécurisée.

- Mettre en place une base de données relationnelle.

- Développer des composants d'accès aux données SQL et NoSQL.

- Développer des composants métier coté serveur.
 
- Documenter le déploiement d'une application dynamique web ou web mobile.

## <span style="color:green">Voici un extrait du sujet proposé par 
![studi, logo](https://app.studi.fr/app-angularjs/assets/tenants/studi/logo-header.svg)</span>
                                        

#### <span style="color:orange">Présentation de l’entreprise<span>

Arcadia est un zoo situé en France près de la forêt de Brocéliande, en bretagne depuis 1960. Ils possèdent tout un panel d’animaux, réparti par habitat (savane, jungle, marais) et font extrêmement attention à leurs santés. Chaque jour, plusieurs vétérinaires viennent afin d’effectuer les contrôles sur chaque animal avant l’ouverture du zoo afin de s’assurer que tout se passe bien, de même, toute la nourriture donnée est calculée afin d’avoir le bon grammage (le bon grammage est précisé dans le rapport du vétérinaire).
Le zoo, se porte très bien financièrement, les animaux sont heureux. Cela fait la fierté de son directeur, José, qui a de grandes ambitions.
A ce jour, l’informatique et lui ça fait deux, mais, il a envie d’une application web qui permettrai aux visiteurs de visualiser les animaux, leurs états et visualiser les services ainsi que les horaires du zoo. Ne sachant pas comment faire, José à demander à Josette, son assistante, de trouver une entreprise lui permettant d’obtenir cette application et augmenter ainsi la notoriété et l’image de marque du zoo.
Après l’obtention de votre diplôme, vous avez été embauché au sein de DevSoft, entreprise qui a été choisi par Josette afin de réaliser l’application.

#### <span style="color:orange">Description du projet<span>

Après avoir été missionné par DevSoft pour travailler sur ce projet, José se permet de venir vous consulter afin de vous donner une information importante : “Je souhaite avoir une application web dont les couleurs et le thème font penser à de l’écologie, le zoo est entièrement indépendant au niveau des énergies et il faut que lorsqu’un utilisateur consulte l’application, il ressente les valeurs de l’écologie dont nous somme fier”

## <span style="color:green">Stack technique que j'ai choisi pour créer ce site</span>

- Mockups : Figma.
- Front-end : React.js 18.3.1 avec javaScript.
- Back-end : Symfony 7 avec  php 8.3.4
- Css : tailwindcss.
- Base de donnée :  sur Supabase.
- Timer : toggl track ( j' ai oublié souvent de l'actionner ou de le stopper donc le temps passé est surtout au mental :unamused: )
- pour le déploiement : <font color='red'>a déinir (peut-être Vercel)</font>

### <span style="color: purple">Pour l'installation sur votre environnement en local</span>

```git clone https://github.com/gahette/arcadia.git```

suivi de :
```composer install```
et ```composer update```

> Ma version de composer est 2.7.2

on continue avec :

```npm install```

on ouvre le server Symfony avec 

```symfony serve -d```

(ne pas oublier de paramétrer votre base de donnée dans le fichier .env ou .env.local)

lancer react avec :

```npm run watch```


[//]: # (todo : definir le déploiement, voir si bdd sur Supabase ou autre)

## <span style="color:green">Chartre graphique</span>

![chatre graphique](/docs/mockups/graphic_chart.png)

## <span style="color:green">Maquettes de la page d'accueil</span>

![page d'accueil](/docs/mockups/mochup-home_page.png)

## <span style="color:green">Maquettes de la page Services</span>

![page services](/docs/mockups/mockup-services_page.png)

## <span style="color:green">Maquettes de la page Contact</span>

![pade de contact](/docs/mockups/mockup-contact_page.png)


## <span style="color:green">Étapes pour la mise en place du projet</span>

- ### <span style="color: purple">création d'un repository github.</span>

- ### <span style="color: purple">installation de symfony 7.</span>

en suivant essentiellement la doc de [Symfony](https://www.symfony.com).

```symfony new arcadia --version="7.1.*" --webapp```

```
cd arcadia
composer install
composer update
```

**Même si beaucoup de dépendances sont déjà installés avec --webapp.**

```composer require --dev debug``` (pour utiliser dd et dump)


Installation de l'ORM Doctrine.
```
composer require symfony/orm-pack
composer require --dev symfony/maker-bundle
```

Installation de twig.

```composer require twig```

Installation de [php-cs-fixer](https://cs.symfony.com/doc/installation.html) pour vérifier les standards et l'uniformisation du code.

```composer require friendsofphp/php-cs-fixer --dev```

Installation de [phpStan](https://phpstan.org/) pour faire une analyse statique du code, cherche les incohérences, avec les [extensions](https://phpstan.org/user-guide/extension-library) de Doctrine, PHPUnit et Symfony.

``` composer require --dev phpstan/phpstan phpstan/extension-installer phpstan/phpstan-symfony phpstan/phpstan-phpunit phpstan/phpstan-doctrine```

j'ai paramétré phpStan avec le fichier phpstan.dist.neon en mettant le level à 9 et donnant les chemins des dossiers src et tests.

>Configuration dans composer.json, dans script ajouter

```angular2html
  "fix": "php-cs-fixer fix",
    "check": [
      "phpstan",
      "php-cs-fixer fix --dry-run --diff"
    ]
  },
```

- ### <span style="color: purple">installation de tailwindcss.</span>

Pour utiliser tailwindcss dans Symfony, il faut installer webpack encore.

j'ai decidé de supprimer tout les fichiers en rappport avec importmap (importmap.php, les liens dans le head, ... ) pour ne pas avoir de conflit avec webpack encore lorsque je vais installer Symfony/ux-react.
Et en même temps supprimer aussi tout les fichiers, dossiers en rapport avec docker que je n'utilise pas sur ce projet.

```composer require symfony/webpack-encore-bundle```

```
npm install -D tailwindcss postcss postcss-loader autoprefixer
npx tailwindcss init -p
```

ajouter dans le fichier webpack.config.js 

> .enablePostCssLoader();

Dans le fichier tailwind.config.js 

```angular2html
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./assets/**/*.jsx",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
```

Dans le app.css dans le dossier assets/styles/

```
@tailwind base;
@tailwind components; 
@tailwind utilities;
```

relancer la commande 

```npm run watch```

et s'assurer que dans "base.html.twig" que le css compile.

ajouter dans {% block stylesheets %} si ce n'est pas mis

> {{ encore_entry_link_tags('app') }}

- ### <span style="color: purple">installation de React dans Symfony.</span>

Pour installer React

```composer require symfony/ux-react```

ensuite 

```npm install -D @babel/preset-react --force```

dans le fichier webpack.config.js décommenter 

> .enableReactPreset()

vérifier que le fichier app.js dans le dossier assets ressemble à 

```angular2html
import { registerReactControllerComponents } from '@symfony/ux-react';
import './bootstrap.js';
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

registerReactControllerComponents(require.context('./react/controllers', true, /\.(j|t)sx?$/));
```

et que dans "base.html.twig" il y a dans le block javaScript

> {{ encore_entry_script_tags('app') }}


vérifier que le fichier controllers.json dans dossier assets ressemble à 

```angular2html
{
    "controllers": {
        "@symfony/ux-react": {
            "react": {
                "enabled": true,
                "fetch": "eager"
            }
        },
    },
    "entrypoints": []
}
```


J'ai aussi installer StimulusBundle mais pas sur qu'il soit utilisé

```composer require symfony/stimulus-bundle```

un fichiers hello_controller.js dans un dossier assets/controllers a été créé.

le fichier boottstrap.js dans le dossier assets doit ressembler à 

```
import {startStimulusApp} from '@symfony/stimulus-bridge';

// Registers Stimulus controllers from controllers.json and in the controllers/ directory
export const app = startStimulusApp(require.context(
'@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
true,
/\.[jt]sx?$/
));
```

et ajouter dans le fichier webpack.config.js

> .enableStimulusBridge('./assets/controllers.json')

relancer les commande 

```
npm install
npm run watch
```

## <span style="color:green">Vérification de l'installation de symfony et de React dans Symfony</span>

Création d'un controller HomeController.php dans le dossier src/Controller avec la commande : 

```php bin/console make: controller HomeController```

un fichier index.html.twig dans un dossier templates/home est créé que j'ai modifié comme suit :

```angular2html
{% extends 'base.html.twig' %}

{% block title %}Accueil{% endblock %}

{% block body %}
<div {{ react_component('Home') }}></div>
{% endblock %}
```

Ensuite j'ai créé un fichier Home.jsx dans un dossier assets/react/controllers :

```angular2html
import React from 'react';

export default function Home() {
    return (
        <>
            <div className="text-5xl text-center text-yellow-200">
                Test
            </div>
        </>

    )
}
```

j'obtiens :

![capture test](/docs/Capture-test.png)

## <span style="color:green">Diagramme de séquence</span>

![diagramme_sequence](/docs/diagrammes/diagramSequence.svg)

## <span style="color:green">Diagramme de cas d'utilisation</span>

![diagramme_d'utilisation](/docs/diagrammes/diagramUseCase.svg)

## <span style="color:green">Diagramme de classe</span>

![diagramme_classe](/docs/diagrammes/diagramClass.svg)


### Super on peut attaquer le code !!!






