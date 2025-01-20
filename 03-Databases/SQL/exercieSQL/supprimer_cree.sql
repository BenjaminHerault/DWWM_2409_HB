
DROP DATABASE IF EXISTS rezoSocial;

CREATE DATABASE IF NOT EXISTS rezoSocial;

USE rezoSocial;

CREATE TABLE utilisateur
(
	id INT,
    nom_utilisateur VARCHAR(32) NOT NULL,
    email VARCHAR(128) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE publication
(
	pub_id INT AUTO_INCREMENT,
    pub_date DATETIME NOT NULL,
    pub_titre VARCHAR(255) NOT NULL,
    pub_contenu TEXT NOT NULL,
    id INT,
    PRIMARY KEY (pub_id),
    FOREIGN KEY (id) REFERENCES utilisateur(id)
);

CREATE TABLE aimer 
(
	id int,
    pub_id int,
    PRIMARY KEY (id, pub_id),
    FOREIGN KEY (id) REFERENCES utilisateur(id),
    FOREIGN KEY (pub_id) REFERENCES publication(pub_id)
);
