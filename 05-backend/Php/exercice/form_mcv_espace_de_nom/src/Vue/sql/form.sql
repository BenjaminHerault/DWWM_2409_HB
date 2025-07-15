-- Supprimer la base si elle existe
DROP DATABASE IF EXISTS form;

-- Créer la base si elle n'existe pas
CREATE DATABASE IF NOT EXISTS form;

-- Utiliser la base
USE form;

-- Table departements
CREATE TABLE IF NOT EXISTS departements (
    id_dep INT UNSIGNED NOT NULL,
    Name VARCHAR(50) NOT NULL,
    dep_actif INT UNSIGNED NOT NULL,
    dep_taux DECIMAL(5,2) NOT NULL,
    CONSTRAINT pk_id_dep_departements PRIMARY KEY (id_dep)
) ENGINE=InnoDB;

-- Table candidats
CREATE TABLE IF NOT EXISTS candidats (
    id_user INT UNSIGNED NOT NULL AUTO_INCREMENT,
    lastname_user VARCHAR(50) NOT NULL,
    firstname_user VARCHAR(50) NOT NULL,
    mail_user VARCHAR(150) NOT NULL,
    pass_user VARCHAR(500) NOT NULL,
    departement_user INT UNSIGNED NOT NULL,
    age_user TINYINT UNSIGNED NOT NULL,
    CONSTRAINT pk_id_user_candidats PRIMARY KEY (id_user),
    CONSTRAINT fk_candidats_departements FOREIGN KEY (departement_user) REFERENCES departements(id_dep)
) ENGINE=InnoDB;

-- Ajout de la colonne is_admin si elle n'existe pas déjà
ALTER TABLE candidats ADD COLUMN is_admin TINYINT(1) DEFAULT 0;