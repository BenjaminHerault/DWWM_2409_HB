-- Pour supprimer la base de donner si elle existe 
DROP DATABASE IF EXISTS resum;

-- Pour crée la base de donner si elle existe pas 
CREATE DATABASE IF NOT EXISTS resum;

-- Pour utiliser la base de donner
USE resum;

-- Pour creat la table  vegetables 

CREATE TABLE resum
(
	id INT AUTO_INCREMENT,			
	name_ VARCHAR(50) NOT NULL,
    mail_user VARCHAR(150) NOT NULL,
    pass_user VARCHAR(500) NOT NULL,
    CONSTRAINT pk_id_resum PRIMARY KEY (id) -- PRIMARY key
);