DROP DATABASE IF EXISTS buveur;

CREATE DATABASE IF NOT EXISTS buveur;

USE buveur;

CREATE TABLE buveurs
(
	num_buv INT AUTO_INCREMENT,
    nom_buv VARCHAR(50) NOT NULL,
    prenom_buv VARCHAR(50) NOT NULL,
    ville_buv VARCHAR(180) NOT NULL,
  constraint pk_buveurs  PRIMARY KEY (num_buv)
);

CREATE TABLE commandes
(
	num_com INT AUTO_INCREMENT,
    date_com DATE NOT NULL,
    num_buv int,
    constraint pk_commandes PRIMARY KEY (num_com)
);

CREATE TABLE lignes_de_commandes
(
	num_vin INT,
    num_com INT,
    quantite int,
   constraint pk_vin_com PRIMARY KEY (num_vin, num_com)
);

CREATE TABLE vins
(
	num_vin INT AUTO_INCREMENT, 
    cru VARCHAR(70) NOT NULL ,
    millesime SMALLINT NOT NULL,
	num_vigneron INT,
    constraint pk_vin  PRIMARY KEY (num_vin)
);

CREATE TABLE vignerons
(
	num_vigneron INT AUTO_INCREMENT,
    nom_vig VARCHAR(50) NOT NULL,
    prenom_vig VARCHAR(50) NOT NULL,
    ville_vig VARCHAR(180)NOT NULL,
    PRIMARY KEY (num_vigneron)
);

CREATE TABLE ressentis_vignerons_entre_eux
(
	num_vigneron_juge INT,
    num_vigneron_evaluer INT,
    critere_appreciation TEXT(500),
    PRIMARY KEY (num_vigneron_juge, num_vigneron_evaluer)
);

ALTER TABLE commandes ADD CONSTRAINT fk_commandes_num_buveur FOREIGN KEY (num_buv) REFERENCES buveurs(num_buv);

ALTER TABLE lignes_de_commandes 
	ADD CONSTRAINT fk_lignes_de_commandes_num_vin  FOREIGN KEY (num_vin) REFERENCES vins (num_vin),
    ADD CONSTRAINT fk_lignes_de_commandes_num_com FOREIGN KEY (num_com) REFERENCES commandes (num_com);
    
ALTER TABLE vins ADD CONSTRAINT fk_vins_num_vigneron FOREIGN KEY (num_vigneron) REFERENCES vignerons (num_vigneron);

ALTER TABLE ressentis_vignerons_entre_eux 
	ADD CONSTRAINT fk_ressentis_vignerons_entre_eux_num_vigneron_juge FOREIGN KEY (num_vigneron_juge) REFERENCES vignerons (num_vigneron),
    ADD CONSTRAINT fk_ressentis_vignerons_entre_eux_num_num_vigneron_evaluer FOREIGN KEY (num_vigneron_evaluer) REFERENCES vignerons (num_vigneron);
    