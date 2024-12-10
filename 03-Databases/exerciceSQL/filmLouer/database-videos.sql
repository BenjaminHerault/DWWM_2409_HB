/*commentaire*/
-- commentaire

/* SUPPRIMER LA BASE DE DONNEES SI ELLE EXISTE */
/*IF EXISTS pour eviter l'erreure*/
DROP DATABASE IF EXISTS videos;

/*creer une base de donnees nommee "videos"*/
create database if not exists videos;

/*utiliser la base de donnees cree*/

-- les requetes qui suivent utiliseront
-- la base de donnees selectionne ci-dessus
use videos;

/* creer une table nommee "film"*/
create table if not exists film
(
	film_id int auto_increment primary key,
    film_titre varchar(255) not null,
    film_duree smallint not null
);
/* Inserer le jeu d'essai dans la table film*/
insert into film 
value
(null,"Léon",120),
(null,"E.T",90),
(null,"ça", 103);

insert into film 
(film_titre, film_duree)
value
("L'exorciste",120),
("Super Papa",87),
("Gladiator 2", 117);

insert into film 
(film_duree, film_titre)
value
(98, "Loups-Garous");




/*Afficher les donnees de la table*/

select * from film;

select film_id, film_titre from film;
