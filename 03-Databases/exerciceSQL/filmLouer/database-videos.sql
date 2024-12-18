/*commentaire*/
-- commentaire
/*
Création de la base de données
Sous langage : DDL / LDD
Date Definition Language
Langage de définition des données 
Principales instruction : CREATE / ALTER / DROP
CREATE = créer une structure (DATABASE, TABLE, VIEW, PROCEDURE, TRIGGER, FUNCTION)
ALTER = Modifier une structure existante
DROP = Supprimer une structure existante
*/

/* SUPPRIMER LA BASE DE DONNEES SI ELLE EXISTE */
/*IF EXISTS pour eviter l'erreure*/
DROP DATABASE IF EXISTS videos;

/*creer une base de donnees nommee "videos"*/
-- create database videos;
create database if not exists videos;

/*Selectionner / utiliser la base de donnees cree*/

-- les requetes qui suivent utiliseront
-- la base de donnees selectionne ci-dessus
use videos;

-- Les requêtes qui suivent utiliseront
-- la base de donnés sélectionné ci-dessou


/* CREER une table nommee" realisateur" */
CREATE TABLE realisateur
(
	realisateur_id INT PRIMARY KEY AUTO_INCREMENT, 
    realisateur_nom VARCHAR(100) NOT NULL,
    realisateur_prenom VARCHAR(100) NOT NULL
);

CREATE TABLE acteur
(
	acteur_id INT AUTO_INCREMENT,
    acteur_nom VARCHAR(100) NOT NULL,
    acteur_prenom VARCHAR(100) NOT NULL,
    PRIMARY KEY (acteur_id)
);

CREATE TABLE film
(
	film_id INT AUTO_INCREMENT,
    film_titre VARCHAR(255) NOT NULL,
    film_duree SMALLINT NOT NULL,
    realisateur_id  INT,
    PRIMARY KEY (film_id),
    FOREIGN KEY (realisateur_id) REFERENCES realisateur(realisateur_id)
);

CREATE TABLE film_acteur
(
	film_id INT,
    acteur_id INT,
    PRIMARY KEY(film_id, acteur_id),
    FOREIGN KEY (film_id) REFERENCES film(film_id),
    FOREIGN KEY (acteur_id) REFERENCES acteur(acteur_id)
);


/*Afficher les donnees de la table*/

/*select * from film;

select film_id, film_titre from film;*/
