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



