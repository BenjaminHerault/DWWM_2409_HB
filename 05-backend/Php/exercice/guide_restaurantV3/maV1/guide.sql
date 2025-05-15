-- Pour supprimer la base de donner si elle existe
-- DROP DATABASE IF EXISTS Guide;

-- Pour crée la base de donner si elle existe pas 
-- CREATE DATABASE IF NOT EXISTS Guide;

USE guide;

CREATE TABLE restaurants
(
	id INT AUTO_INCREMENT,	-- PRIMARY key
	nom VARCHAR(50) NOT NULL,
	adresse VARCHAR(250) NOT NULL,
	prix DECIMAL(10,2) UNSIGNED NOT NULL,
	commentaire TEXT NOT NULL,
	note DOUBLE UNSIGNED NOT NULL,
	visite TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- définisse automatiquement la date et l'heure
	CONSTRAINT pk_id_restaurants PRIMARY KEY (id)
)ENGINE=INNODB DEFAULT CHARSET=UTF8;

-- pour vide la table

-- TRUNCATE TABLE restaurants;

INSERT INTO restaurants 
VALUES
-- id, nom, adresse, prix, commentaire, note, visite
(id, 'JEAN-YVES SCHILLINGER','17 Rue de la Poissonnerie,68000 Colmar',50,'Le JY\'S est un restaurant différent des autres avec un décor cosy et résolument contemporain qui attire une
très belle clientèle cosmopolite. Jean-Yves Schillinger est un chef doublement étoilé créatif qui vous entraînera
dans une ronde dépaysante à souhait où la cuisine du monde est à l\'honneurLe chef décline la cuisine fusion à
sa façon. Une carte régulièrement renouvelée s\'égaye de créations audacieuses et de plats revisités avec
modernité et pertinence.',9 ,'2019-12-05 00:00:00'),
(id, 'L\’ADRIATICO','6 route de Neuf Brisach, 68000, Colmar, France',25,'Une des meilleurs pizzéria de la région Service très agréable, efficace et souriant Salle principale un peu
bruyante mais cela donne un côté italien je recommande',8,'2020-02-04 00:00:00');
