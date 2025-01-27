
DROP DATABASE IF EXISTS bibliotheque;

CREATE DATABASE IF NOT EXISTS bibliotheque;

USE bibliotheque;

CREATE TABLE livre
(
	num_ISBN CHAR(13) NOT NULL,
	titre VARCHAR(100) NOT NULL,
    CONSTRAINT PK_num_ISBN PRIMARY KEY (num_ISBN)
);

CREATE TABLE exemplaire
(
	num_exempl INT NOT NULL AUTO_INCREMENT,	-- PRIMARY KEY
    num_ISBN CHAR(13),			-- PRIMARY KEY et FOREIGN KEY
    etat CHAR(2) NOT NULL DEFAULT 'D',
    CONSTRAINT pk_num_exempl PRIMARY KEY(num_exempl, num_ISBN),
    CONSTRAINT fk_livre FOREIGN KEY (num_ISBN) REFERENCES livre(num_ISBN),
    CONSTRAINT CK_etat CHECK (etat in ("D","E","P"))  -- d = disponible    e = emprumté    p = perdu , 
);

INSERT INTO livre
(num_ISBN, titre)
VALUES
("5454545", "SQL poche pour les Nuls");

INSERT INTO exemplaire
VALUES
(num_exempl, "5454545" , etat);
