-- Pour supprimer la base de donner si elle existe 
DROP DATABASE IF EXISTS excavator;

-- Pour crée la base de donner si elle existe pas 
CREATE DATABASE IF NOT EXISTS excavator;

-- Pour utiliser la base de donner
USE excavator;

-- Pour creat la table SCIENTISTS
CREATE TABLE IF NOT EXISTS SCIENTISTS (
id_scientist int UNSIGNED NOT NULL AUTO_INCREMENT,
lastname_scientist varchar(100) NOT NULL,
firstname_scientist varchar(50) NOT NULL,
mail_scientist varchar(150) NOT NULL,
pass_scientist varchar(500) NOT NULL,
level_scientist smallint NOT NULL,
CONSTRAINT PK_SCIENTISTS PRIMARY KEY (id_scientist)
) ENGINE=InnoDB;


-- pour insert des untilisateur avec le mot de passe crypte
-- INSERT INTO scientists VALUES
-- (id_scientist,'MORTIMER','Philip','p.mortimer@mifivesec.eu','et le mot de passe crypte ', 2),
