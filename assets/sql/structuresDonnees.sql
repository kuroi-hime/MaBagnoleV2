drop database mabagnolev2;

create database if not exists mabagnolev2;

use mabagnolev2;
-- 
create table if not exists utilisateurs(
    id_user int auto_increment,
    nom_user varchar(50),
    cin varchar(6) unique,
    role varchar(20) default 'client',
    email varchar(100) unique not null,
    mot_passe_hash varchar(100) not null,
    telephone varchar(13),
    adresse varchar(250),
    ville varchar(100),
    statut boolean default 1,
    date_inscription DateTime default current_date,
    PRIMARY KEY(id_user)
);

create table if not exists categories(
    id_categorie int auto_increment,
    nom_categorie varchar(100),
    description_categorie varchar(600),
    PRIMARY KEY(id_categorie)
);
-- delete image
create table if not exists vehicules(
    id_vehicule int auto_increment,
    marque varchar(100),
    modele varchar(100),
    prix float,
    disponibilite boolean default 1,
    nbr_portes int,
    nbr_places int,
    moteur varchar(100),
    boite_vitesse varchar(100),
    climatisation boolean,
    airbag boolean,
    description_vehicule varchar(600),
    categorie_id int,
    PRIMARY KEY(id_vehicule),
    FOREIGN KEY(categorie_id) REFERENCES categories(id_categorie)
);

create table if not exists reservations(
    id_reservation int auto_increment,
    date_debut DateTime,
    duree int,
    lieu_depart varchar(100),
    lieu_reteur varchar(100),
    statut varchar(100),
    vehicule_id int,
    client_id int,
    PRIMARY KEY(id_reservation),
    FOREIGN KEY(vehicule_id) REFERENCES vehicules(id_vehicule),
    FOREIGN KEY(client_id) REFERENCES utilisateurs(id_user)
);
-- 
create table if not exists options(
    id_option int auto_increment,
    nom_option varchar(100),
    prix_unitaire float default 0,
    PRIMARY KEY(id_option)
);
-- 
create table if not exists reservations_options(
    reservation_id int,
    option_id int,
    FOREIGN KEY(reservation_id) REFERENCES reservations(id_reservation),
    FOREIGN KEY(option_id) REFERENCES options(id_option),
    PRIMARY KEY(reservation_id, option_id)
);

create table if not exists themes(
    id_theme int auto_increment,
    nom_theme varchar(200),
    description_theme varchar(600),
    PRIMARY KEY(id_theme)
);

create table if not exists articles(
    id_article int auto_increment,
    titre_article varchar(200),
    contenu_article varchar(600),
    statut varchar(50) default 'En attente',
    date_creation DateTime default current_date,
    date_publication DateTime,
    user_id int,
    theme_id int,
    PRIMARY KEY(id_article),
    FOREIGN KEY(user_id) REFERENCES utilisateurs(id_user),
    FOREIGN KEY(theme_id) REFERENCES themes(id_theme)
);

create table if not exists images(
    id_image int auto_increment,
    url_image varchar(300),
    article_id int,
    vehicule_id int,
    PRIMARY KEY(id_image),
    FOREIGN KEY(article_id) REFERENCES articles(id_article),
    FOREIGN KEY(vehicule_id) REFERENCES vehicules(id_vehicule)
);

create table if not exists tags (
    id_tag int auto_increment,
    nom_tag varchar(100),
    PRIMARY KEY(id_tag)
);
-- 
create table if not exists articles_tags(
    article_id int,
    tag_id int,
    FOREIGN KEY(article_id) REFERENCES articles(id_article),
    FOREIGN KEY(tag_id) REFERENCES tags(id_tag),
    PRIMARY KEY(article_id, tag_id)
);
-- 
create table if not exists commentaires(
    id_commentaire int auto_increment,
    contenu varchar(300),
    note int,
    date_commentaire DateTime default current_date,
    statut varchar(100),
    client_id int,
    vehicule_id int,
    article_id int,
    PRIMARY KEY(id_commentaire),
    FOREIGN KEY(client_id) REFERENCES utilisateurs(id_user),
    FOREIGN KEY(vehicule_id) REFERENCES vehicules(id_vehicule),
    FOREIGN KEY(article_id) REFERENCES articles(id_article)
);

create table if not exists likes(
    client_id int,
    commentaire_id int,
    statut boolean,
    FOREIGN KEY(client_id) REFERENCES utilisateurs(id_user),
    FOREIGN KEY(commentaire_id) REFERENCES commentaires(id_commentaire),
    PRIMARY KEY(client_id, commentaire_id)
);
-- 
create table if not exists favoris(
    id_favoris int auto_increment,
    client_id int,
    vehicule_id int,
    article_id int,
    statut boolean,
    FOREIGN KEY(client_id) REFERENCES utilisateurs(id_user),
    FOREIGN KEY(vehicule_id) REFERENCES vehicules(id_vehicule),
    FOREIGN KEY(article_id) REFERENCES articles(id_article),
    PRIMARY KEY(id_favoris)
);

create table if not exists historique(
    id_consultation int auto_increment,
    date_consultation DateTime default current_date,
    client_id int,
    categorie_id int,
    vehicule_id int,
    article_id int,
    FOREIGN KEY(client_id) REFERENCES utilisateurs(id_user),
    FOREIGN KEY(categorie_id) REFERENCES categories(id_categorie),
    FOREIGN KEY(vehicule_id) REFERENCES vehicules(id_vehicule),
    FOREIGN KEY(article_id) REFERENCES articles(id_article),
    PRIMARY KEY(id_consultation)
);