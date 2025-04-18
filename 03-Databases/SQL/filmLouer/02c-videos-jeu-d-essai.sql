
/* 
INSERER LE JEU D'ESSAI DANS LA TABLE FILMS 
Sous langage DML / LMD
Data Manipulation Language
Langage de manipulation des données
Principales instruction : 
INSERT : Ajouter des nouvelles données dans une table
UPDATE : Mettre à jour des données existantes dans une table
DELETE : Supprimer des données existantes dans une table
TRUNCATE : VIDER une table
*/

-- Sélectionner la base de données 
USE videos;

DELETE FROM realisateurs; -- supprime toutes les données de la table realisateur

TRUNCATE TABLE film_acteur; -- vider la table acteur et la réinitialise l'auto_increment 
TRUNCATE TABLE film; -- vider la table acteur et la réinitialise l'auto_increment 
TRUNCATE TABLE acteur; -- vider la table acteur et la réinitialise l'auto_increment 
TRUNCATE TABLE realisateur; -- vider la table realisateur et la réinitialise l'auto_increment 


/* Insertion des données dans la table " realisateur " */

INSERT INTO videos.realisateur
VALUES 
(NULL, "besson" ,"luc"),
(NULL, "Spielberg" ,"Steven"),
(NULL, "Carpenter" ,"John");


INSERT INTO acteur
(acteur_prenom, acteur_nom)
VALUES
("Jean", "Réno"),
("Mel", "Gibson"),
("Tom", "Holland"),
("Eva", "Green"),
("Emma", "Watson");



