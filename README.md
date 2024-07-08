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
CREATE DATABASE arcadia DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# Création de tables
create table animal
(
id                 int auto_increment primary key not null,
habitat_id         int                            null,
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
id         int auto_increment primary key not null,
animal_id  int                            not null,
food       varchar(128)                   null,
quantity   int                            null,
created_at datetime                       not null,
updated_at datetime                       not null,
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
animal_id   int                            null,
habitat_id  int                            null,
user_id     int                            not null,
priority    int                            null,
path        varchar(128)                   not null,
size        int                            null,
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
id         int auto_increment primary key not null,
animal_id  int                            not null,
content    longtext                       null,
state      varchar(128)                   null,
food       varchar(128)                   null,
quantity   int                            null,
created_at datetime                       not null,
updated_at datetime                       not null,
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

## <span style="color:green">Système d'administration avec EasyAdmin.</span>

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

- ### <span style="color: purple">Système de connexion à la base</span>

#### Composant de sécurité

j'ai commencé par installer```composer require symfony/security-bundle```

J'avais déjà commencé à créer mon entity User avec la commande ```php bin/console make:user``` en même temps que mes autres entités.

Ne pas oublier de faire une migration.

#### Se créer un utilisateur

je suis allé dans la base de donnée, j'ai rempli les champs et pour obtenir un mot de passe hasher j'ai lancé la commande ```php bin/console security:hash-password```

Pour remplir la colonne Roles j'ai mis [ROLE_SUPER_ADMIN]

#### Formulaire de connexion

Avec ```php bin/console make:security:form-login``` j'ai créé un controller securityController avec dans un premier temps un template security/login.html.twig

et ensuite j'ai changé le template en prenant celui de EasyAdmin en changeant la route de dans le securityController par "@EasyAdmin/page/login.html.twig"

et en adaptant les paramètres.

Dans Security.yaml, j'ai décommenté 
```
  access_control:
    - { path: ^/admin, roles: ROLE_ADMIN }
```

j'ai aussi ajouté une hiérarchie de ROLE :

```angular2html
  role_hierarchy:
    ROLE_ADMIN: [ ROLE_USER ]
    ROLE_EMPLOYEE: [ ROLE_EMPLOYEE, ROLE_ADMIN ]
    ROLE_VETERINARIAN: [ ROLE_VETERINARIAN, ROLE_ADMIN ]
    ROLE_SUPER_ADMIN: [ ROLE_ADMIN, ROLE_ALLOWED_TO_SWITCH ]
```

#### Création du CRUD Utilisateur

j'ai remplacé le champs password par un champs plainPassword pour hasher à la création le mot de passe avant de l'enregistrer dans la base de donnée.

```TextField::new('plainPassword', 'Mot de passe')->onlyOnForms(),```

#### Création d'un EventSubscriber 

Avec la commande ```php bin/console make:subscriber``` j'ai créé la classe "PasswordUpdateSubscriber.php"
en écoutant l'élément "EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent"

Avec cette class on hashe le mot de passe avant de l'enregistrement dans la base de donnée à la création ou à la mise à jour.

j'ai ajouté dans l'entité User 

```angular2html
  #[Assert\NotBlank]
    #[Assert\Length(min: 4)]
    private ?string $plainPassword = null;
```
avec une contrainte de validation,

avec son getter et setter 

et

```angular2html
 public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }
```
Pour effacer les traces de mot de passe par exemple dans un cookie (je n'ai pas creusé la question).

- ### <span style="color: purple">Mise en place des ROLES</span>

Pour que seuls les ROLE_ADMIN puissent se connecter au système d'administration, j'ai ajouté dans le DashboardController un attribut 

```angular2html
class DashboardController extends AbstractDashboardController
{
    #[Route(path: '/admin', name: 'admin_dashboard_index')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    { ...
```

Après pour répartir les droits en fonction des ROLES, j'ai mis en place des conditions sur chaque CRUD

Exemple :

```angular2html
    yield MenuItem::section('Données');
        if (!$this->isGranted('ROLE_VETERINARIAN')) {
            yield MenuItem::linkToCrud('Services', 'fas fa-bell-concierge', Service::class);
        }
```

Et dans les CRUDs, j'ai aussi mis des restriction en fonction des ROLES 

exemple extrait de AnimalCrudController.php :

```angular2html
    if ($this->isGranted('ROLE_VETERINARIAN')) {
            return [
                IdField::new('id')->hideOnForm(),
                TextField::new('nikname', 'Prénom')->hideOnForm(),
                TextField::new('name', 'Race')->hideOnForm(),
                $imagesField->hideOnForm(),
                CollectionField::new('images')
                    ->setEntryType(ImageType::class)
                    ->allowDelete()
                    ->allowAdd()
                    ->onlyOnForms()
                    ->hideOnForm(),
                SlugField::new('slug')->setTargetFieldName('name')->hideOnForm(),
                ChoiceField::new('classification', 'Classification')
                    ->setChoices([
                        'Mammifères' => 'Mammifères',
                        'Oiseaux' => 'Oiseaux',
                        'Poissons' => 'Poissons',
                        'Amphibiens' => 'Amphibiens',
                        'Reptiles' => 'Reptiles',
                    ])->hideOnForm(),
                ChoiceField::new('area', 'Région')
                    ->setChoices([
                        'Afrique' => 'Afrique',
                        'Amérique du Nord' => 'Amérique du Nord',
                        'Amérique du Sud' => 'Amérique du Sud',
                        'Asie' => 'Asie',
                        'Europe' => 'Europe',
                        'Océanie' => 'Océanie',
                    ])->hideOnForm(),
                AssociationField::new('habitat')->hideOnForm(),
                TextEditorField::new('description')->hideOnForm(),
                $vetReportsField->hideOnForm(),
                $foodConsumptionField->hideOnForm(),
                NumberField::new('consultation_count', 'Nombre de vue')->hideOnForm(),
            ];
        }
```

Ce qui m'a permis de bien répartir les rôles.

- ### <span style="color: purple">Mise en place d'un temps de connexion</span>

En créant 2 classes :

- Dans un dossier Security:

un fichier LoginSussessHandler.php utilisé pour définir le timeout de session après une authentification réussie.

- Dans le dossier EventListener déjà mis en place :

un fichier SessionIdleTimeoutListener.php pour vérifier le timeout de session sur chaque requête et redirige l'utilisateur vers la page de connexion si la session a expiré.

Sans oublier de les enregistrer dans services.yaml :

```angular2html
    App\EventListener\SessionIdleTimeoutListener:
        tags:
            - { name: kernel.event_listener, event: kernel.request, method: onKernelRequest }

    App\Security\LoginSuccessHandler:
        arguments: [ '@router' ]
        tags:
            - { name: monolog.logger, channel: security }
```

Et dans security.yaml :

```angular2html
    main:
      lazy: true
      provider: app_user_provider
      form_login:
        login_path: app_login
        check_path: app_login
        always_use_default_target_path: true
        default_target_path: admin_dashboard_index
        success_handler: App\Security\LoginSuccessHandler
        enable_csrf: true
      logout:
        path: app_logout
        # where to redirect after logout
        # target: app_any_route
      remember_me:
        secret: '%kernel.secret%'
        lifetime: 3600 # Durée de la session en secondes (1 heure)
        path: /
        name: REMEMBERME
```

- ### <span style="color: purple">Configuration de tailwindcss.</span>

Dans tailwind.config.js, j'ai mis en place les couleurs et police correspondant à la chartre graphique.

```angular2html
theme: {
extend: {
screens: {
'sm': '640px',
'md': '768px',
'lg': '1024px',
'xl': '1280px',
'2xl': '1536px',
},
colors: {
transparent: "transparent",
arcadia: "#22C55E",
bgColor2: "#F7F7F7",
primaryText: "#15803D",
bgColor: '#3EBE83',
black: '#000000',
dark: '#000000BF',
darkGrey: '#454545',
grey: '#828282',
},
fontFamily: {
        'sans': 'Inter, sans-serif'
            },
            fontSize: {
                'h1Mobile': ['1.5rem', {
        lineHeight: '1.813rem',
                letterSpacing: '-0.02em',
                fontWeight: '700',
        }],
'h1Tablet': ['3rem', {
lineHeight: '3.5rem',
letterSpacing: '-0.02em',
fontWeight: '700',
}],
'h1Desktop': ['4rem', {
lineHeight: '4.813rem',
letterSpacing: '-0.02em',
fontWeight: '700',
}],
'logoDesktop': ['2.25rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '700',
}],
'logoTablet': ['1.5rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '700',
}],
'logoMobile': ['1.25rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '700',
}],
'h2Desktop': ['2.5rem', {
lineHeight: '110%',
letterSpacing: '0',
fontWeight: '600',
}],
'h2Tablet': ['2.25rem', {
lineHeight: '110%',
letterSpacing: '0',
fontWeight: '600',
}],
'h2Mobile': ['1.5rem', {
lineHeight: '110%',
letterSpacing: '0',
fontWeight: '600',
}],
'h3Desktop': ['1.25rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '700',
}],
'h3Tablet': ['1.25rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '700',
}],
'h3Mobile': ['1.25rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '700',
}],
'nav': ['1.25rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '500',
}],
'navLg': ['1rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '500',
}],
'pDesktop': ['1.5rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '400',
}],
'pTablet': ['1.5rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '400',
}],
'pMobile': ['1.5rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '400',
}],
'cardTablet': ['1rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '400',
}],
'cardMobile': ['1rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '400',
}],
'buttonDesktop': ['1.5rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '600',
}],
'buttonTablet': ['1.25rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '600',
}],
'buttonMobile': ['1rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '600',
}],
'footerDesktop': ['1rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '500',
}],
'footerTablet': ['1rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '500',
}],
'footerMobile': ['1rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '500',
}],
'textDesktop': ['1.25rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '400',
}],
'textTablet': ['1.25rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '400',
}],
'textMobile': ['1rem', {
lineHeight: '150%',
letterSpacing: '0',
fontWeight: '400',
}],
},
},
},
```

## <span style="color:green">Réinstallation de React.</span>

Après les problèmes rencontrés lors de ma première mise en place du système de navigation;

J'ai créé un composant ErrorBoundary.jsx, ce qui a réglé quelques erreurs de la console.

Mon principal souci était que lorsque je souhaitais accéder à la page administration, j'avais une erreur 404. Je n'étais pas redirigé vers /admin.

Comme par un commun accord avec moi-même, j'ai désinstallé tout ce qui avait un rapport avec stimulus, reconfiguré webpack, 

J'ai réinstallé React.

J'ai modifié le app.js,

```angular2html
import React from 'react';
import ReactDOM from 'react-dom/client';
import './styles/app.css';
import App from "./react/App";

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

const rootElement = document.getElementById('root');
if (rootElement) {
    const root = ReactDOM.createRoot(rootElement);
    root.render(
        <React.StrictMode>
            <App />
        </React.StrictMode>
    );
}
```

ainsi que le templates base.html.twig

```angular2html
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{% block title %}Welcome!{% endblock %}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    {% block stylesheets %}
        {{ encore_entry_link_tags('app') }}
    {% endblock %}

    {% block javascripts %}
        {{ encore_entry_script_tags('app') }}
    {% endblock %}
</head>
<body>
<div id="root"></div>
</body>
</html>
```

j'ai relancé un npm run build

- ### <span style="color: purple">Mise en place de la navigation responsive.</span>

Pour recommencer, j'ai créé un dossier pages et un dossier components :

- dans le dossier page toutes les pages (ah ah ah)
- dans le dossier components les composants, petits morceaux de pages

Pour relier toutes mes pages React au projet Symfony, j'ai mis en place les contrôleurs correspondants et les templates.

exemple : 

Home.jsx avec HomeController.php et home/index.html.twig

Pour faire la navigation, j'ai créé dans le dossier react un fichier App.jx pour définir le routage :

```angular2html
import React from 'react';
import {BrowserRouter, Route, Routes} from "react-router-dom";
import Home from "./pages/Home";
import Service from "./pages/Service";
import Habitat from "./pages/Habitat";
import Animal from "./pages/Animal";
import About from "./pages/About";
import Contact from "./pages/Contact";
import Error from "./pages/_utils/Error";
import ErrorBoundary from "./components/ErrorBoundary";

const App = () => {
    return (
        <BrowserRouter>
            <ErrorBoundary>
                <div className="App">
                    <Routes>
                        <Route index element={<Home/>}/>

                        <Route path="/" element={<Home/>}/>
                        <Route path="/service" element={<Service/>}/>
                        <Route path="/habitat" element={<Habitat/>}/>
                        <Route path="/animal" element={<Animal/>}/>
                        <Route path="/about" element={<About/>}/>
                        <Route path="/contact" element={<Contact/>}/>
                        <Route path="/admin" action="/login"/>

                        <Route path="*" element={<Error/>}/>

                    </Routes>
                </div>
            </ErrorBoundary>
        </BrowserRouter>
    )
        ;
};
export default App;
```
Pour la bar de navigation, je l'ai codé dans un composant Header.jsx car je l'utilise dans plusieurs pages.

- ### <span style="color: purple">Mise en place composant Footer.jsx.</span>

Avant de commencer le footer, j'ai créé un layout dans pages pour centraliser le Header et le Footer sur toutes les pages.

```angular2html
import React from 'react';
import {Outlet} from "react-router-dom";
import Header from "../components/public/Header";
import Footer from "../components/public/Footer";

const Layout = () => {
    return (
        <div>
            <Header/>
            <Outlet/>
            <Footer/>
        </div>
    );
};

export default Layout;
```

Pour simplifier le code, j'ai aussi mis en place un index.jsx dans pages

```angular2html
export {default as Layout} from './Layout';
export {default as Home} from './Home';
export {default as About} from './About';
export {default as Contact} from './Contact';
export {default as Animal} from './Animal';
export {default as Habitat} from './Habitat';
export {default as Service} from './Service';
```

Ce qui me permet d'avoir par exemple cette écriture lorsqu'un élément est appelé :

```angular2html
import {About, Animal, Contact, Habitat, Home, Layout, Service} from "./pages";
```

Pour palier au problème de redirection avec symfony lorsque je cliquais sur connexion ou que je tapais un chemin qui n'existait.

je mis en place un nouveau contrôleur ReactController.php 

```angular2html
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReactController extends AbstractController
{
    #[Route('/{reactRouting}', name: 'react_homepage', requirements: ['reactRouting' => '^(?!login).+'], defaults: ['reactRouting' => null])]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }
}
```

Et ensuite, j'ai codé le Footer.jsx.

- ### <span style="color: purple">Mise en place composant HeroSection.jsx</span>
