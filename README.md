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

## <span style="color:green">Création de la base de données et ses tables.</span>

- ### <span style="color: purple">Création d'utilisateur et mot de passe mysql en local avec tout les droits pour ce projet</span>

Dans un terminal : 

```angular2html
mysql -u root -p  
```
mettre votre mot de passe si vous en avez un.

ensuite tapez : 

```angular2html
CREATE USER 'nom_user_choisi'@'%' IDENTIFIED BY 'mot_de_passe_choisi';
```
il faut donnée les droits a votre nouvel utilisateur :

```angular2html
GRANT ALL PRIVILEGES ON nom_base.* TO 'nom_user_choisi'@'%';
```

```angular2html
FLUSH PRIVILEGES;
```

Vérifier :

```angular2html
SHOW GRANTS FOR 'nom_user_choisi'@'%';
```

Voici le resultat obtenu :

```angular2html
+---------------------------------------------------------------+
| Grants for nom_user_choisi@%                                  |
+---------------------------------------------------------------+
| GRANT USAGE ON *.* TO `nom_user_choisi`@`%`                   |
| GRANT ALL PRIVILEGES ON `nom_base`.* TO `nom_user_choisi`@`%` |
+---------------------------------------------------------------+
```

- ### <span style="color: purple">Création de la base de données avec Symfony</span>

#### Paramétrage de Symfony

J'ai commencé par créer un fichier .env.local à la racine du projet pour suivre la recommandation commenter dans .env 

```angular2html
# DO NOT DEFINE PRODUCTION SECRETS IN THIS FILE NOR IN ANY OTHER COMMITTED FILES.
```
et ainsi éviter que mes identifiant et mot de passe de la base de données soit commité.

Ensuite dans j'ai commenté dans .env 

```angular2html
# DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=16&charset=utf8"
```
et décommenté 
```angular2html
DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8.0.32&charset=utf8mb4"
```
j'ai copié et collé ce dernier dans .env.local et remplacé les infos de connection à la base comme suit :

```angular2html
DATABASE_URL="mysql://nom_user_choisi:mot_de_passe_choisi@127.0.0.1:3306/nom_base?serverVersion=8.0.32&charset=utf8mb4"
```

#### Après avoir paramétré les fichiers .env, création de la base de donnée avec doctrine

Dans le terminal je créé la base avec la commande :

```angular2html
php bin/console doctrine:database:create
```
j'ai vérifié que la base a bien été créé en me connectant a mysql avec mes nouveaux identifiants et en lançant la commande :

```angular2html
SHOW DATABASES;
```
Ça fonctionne 

```angular2html
+--------------------+
| Database           |
+--------------------+
| nom_base           |
| information_schema |
| performance_schema |
+--------------------+

```

#### Retour sur l'IDE pour créer les entités

L'entité User avec ```php bin/console make:user```,

mise en place de Trait pour regrouper les champs communs pour chaque entités et installation de StofDoctrineExtensionsBundle  avec ```composer require stof/doctrine-extensions-bundle``` pour gérer les createdAt, updatedAt et slug.

J'ai active bundle dans config/packages/stof_doctrine_extensions.yaml :

```angular2html
stof_doctrine_extensions:
    default_locale: fr_FR
    orm:
        default:
            timestampable: true # not needed: listeners are not enabled by default
            sluggable: true
            sortable: true
```

Les autres entités ```php bin/console make:entity```.

- ### <span style="color: purple">Création des tables dans la base de données</span>

#### Génération des entités avec

```php bin/console make:migrations```

j'ai eu un souci de compatibilité entre StofDoctrineExtensionsBundle et doctrine/orm, pour le régler j'ai downgradé doctrine/orm de "^3.2" vers "^2.19.5" (ne pas oublier de faire un ```composer update```).

#### Execution des migrations 

```php bin/console doctrine:migrations:migrate```

Voilà la base de données s'est remplie de ses tables...

- ### <span style="color: purple">Création de la base de données et des tables sans passer par la migration de Symfony</span>

```angular2html
# Création de la base
CREATE DATABASE arcadia DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# Création de tables
create table animal
(
    id                 int auto_increment primary key not null,
    habitat_id         int                            not null,
    nikname            varchar(128)                   not null,
    classification     varchar(128)                   not null,
    area               varchar(128)                   not null,
    consultation_count int                            null,
    name               varchar(128)                   not null,
    slug               varchar(128)                   not null unique,
    description        longtext                       null,
    created_at         datetime                       not null,
    updated_at         datetime                       not null,
    foreign key (habitat_id) references habitat (id)
);

create table food_consumption
(
    id        int auto_increment primary key not null,
    animal_id int                            not null,
    food      varchar(128)                   null,
    quantity  int                            null,
    foreign key (animal_id) references animal (id)
);

create table habitat
(
    id          int auto_increment primary key not null,
    name        varchar(128)                   not null,
    slug        varchar(128)                   not null unique,
    description longtext                       null,
    created_at  datetime                       not null,
    updated_at  datetime                       not null,
    state       varchar(128)                   null,
    comment     longtext                       null
);

create table image
(
    id          int auto_increment primary key not null,
    name        varchar(128)                   not null,
    slug        varchar(128)                   not null unique,
    description longtext                       null,
    created_at  datetime                       not null,
    updated_at  datetime                       not null,
    animal_id   int                            not null,
    habitat_id  int                            not null,
    user_id     int                            not null,
    priority    int                            null,
    path        varchar(128)                   not null,
    size        double                         not null,
    foreign key (animal_id) references animal (id),
    foreign key (habitat_id) references habitat (id),
    foreign key (user_id) references user (id)
);

create table opening_hour
(
    id           int auto_increment primary key not null,
    day          varchar(128),
    opening_time varchar(128),
    closing_time varchar(128)
);

create table service
(
    id          int auto_increment primary key not null,
    name        varchar(128)                   not null,
    slug        varchar(128)                   not null unique,
    description longtext                       null,
    created_at  datetime                       not null,
    updated_at  datetime                       not null
);

create table testimonial
(
    id         int auto_increment primary key not null,
    pseudo     varchar(128)                   not null,
    is_visible boolean                        not null,
    created_at datetime                       not null,
    updated_at datetime                       not null
);

create table user
(
    id         int auto_increment primary key not null,
    lastname   varchar(255)                   not null,
    firstname  varchar(255)                   not null,
    email      varchar(180)                   not null unique,
    roles      json                           not null,
    password   varchar(255)                   not null,
    created_at datetime                       not null,
    updated_at datetime                       not null
);

create table vet_report
(
    id        int auto_increment primary key not null,
    animal_id int                            not null,
    content   longtext                       null,
    foreign key (animal_id) references animal (id)
);
```

- ### <span style="color: purple">Gestion des fichiers images</span>

#### mise en place VichUploader pour gérer les fichiers ici les images

j'ai commencé par charger le bundle Symfony:

```composer require vich/uploader-bundle```

et j'ai paramétré le config/packages/vich_uploader.yaml nouvellement installé comme suit:

```angular2html
vich_uploader:
    db_driver: orm

    metadata:
        type: attribute

    mappings:
        images:
            uri_prefix: /images
            upload_destination: '%kernel.project_dir%/public/images'
            namer: Vich\UploaderBundle\Naming\SmartUniqueNamer
```
En suivant la documentation de VichUploaderBundle, j'ai ajouté dans l'entité Image:

```angular2html
  // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Vich\UploadableField(mapping: 'images', fileNameProperty: 'path', size: 'size')]
    private ?File $file = null;

    public function getFile(): ?File
    {
    return $this->file;
    }

    /**
    * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
    * of 'UploadedFile' is injected into this setter to trigger the update. If this
    * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
    * must be able to accept an instance of 'File' as the bundle will inject one here
    * during Doctrine hydration.
    */
    public function setFile(File|UploadedFile|null $file): void
    {
    $this->file = $file;

    if (null !== $file) {
    // It is required that at least one field changes if you are using doctrine
    // otherwise the event listeners won't be called and the file is lost
    $this->updatedAt = new \DateTimeImmutable();
    }
    }
```

comme dans la documentation utilise int au lieu de float pour le size, j'ai modifié cette attribut dans mon entité Image,
et refait une migration pour que ce soit pris en compte dans la bdd.

ensuite j'ai créé un dossier Namer pour que les images chargées soit placées dans des sous-dossiers :

```angular2html
<?php

namespace App\Namer;

use App\Entity\Image;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\DirectoryNamerInterface;

class ImageDirectoryNamer implements DirectoryNamerInterface
{
    /**
     * @param Image $object
     *
     * @throws \Exception
     */
    public function directoryName($object, PropertyMapping $mapping): string
    {
        $habitat = $object->getHabitat();
        $animal = $object->getAnimal();
        if (!is_null($animal)) {
            $habitat = $animal->getHabitat();
        }

        if (is_null($habitat)) {
            throw new \Exception('Habitat and Animal MUST not be empty in images');
        }

        $directoryName = $habitat->getSlug();

        if (!is_null($animal)) {
            $directoryName .= '/'.$animal->getId();
        }

        return $directoryName;
    }
}
```

et ajouté dans le mappings de config/packages/vich_uploader.yaml

```angular2html
            directory_namer:
                service: App\Namer\ImageDirectoryNamer
```

- ### <span style="color: purple">Administration du zoo</span>

Pour gestion du zoo en fonction des roles de chaque utilisateur.

#### installation du bundle Easyadmin

```composer require easycorp/easyadmin-bundle ```

et ensuite créé le dashboard avec ```php bin/console make:admin:dashboard```

J'ai défini une route et créé le template qui correspond "dashboard.html.twig" dans un dossier admin/fields

 #### ensuite j'ai créé un CRUD pour chaque entité avec ```php bin/console make:admin:crud```

créé un champs pour les images "VichImageField.php" (pour au final ne pas m'en servir)

Pour alimenter les collections dans les CRUDs j'ai mis en place un dossier form dans lequel j'ai créé plusieurs Types

c'est ce que j'ai utilisé pour gérer les images.

C'est dans cette partie que j'ai supprimé le dossier Namer et supprimé aussi "directory_namer:..." dans config/packages/vich_uploader.yaml

par contre j'ai ajouté
```angular2html
        inject_on_load: true
        delete_on_update: true
        delete_on_remove: true
```

je me suis battu avec ma base de donnée pour que tous fonctionne (j'ai supprimé, j'ai rajouté, j'ai modifié...)


- ### <span style="color: purple">Envoie d'Email au nouvel utilisateur créé</span>

#### Système mailer pour envoyer un mail et MailTrap pour simuler une boite email.

installation de ```composer require symfony/mailer```

je me suis créé un compte Mailtrap pour simuler la reception de mail

dans mon .env.local j'ai rajouter les paramètre qui me permet de communiquer avec MailTrap

pour qu'il n'y ai pas de conflit, j'ai modifié messenger.yaml dans config/packages

en remplaçant les async par sync (bien, pas bien ??)

Et ajout des fichiers Eventlistener/NewUserListener.php et emails/welcome.html.twig qui le relie

Dans services.yaml :
```angular2html
parameters:
    admin_email: 'jose@arcadia.com'
```
et
```
    App\EventListener\NewUserListener:
        arguments:
            $mailer: '@mailer.mailer'
        tags:
            - { name: kernel.event_subscriber }
```

- ### <span style="color: purple"></span>









[//]: # todo sql avec image