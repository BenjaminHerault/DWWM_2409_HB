-- supprimer la base de donnees si elle existe
drop database if exists editeur;

/*cree une base de donnees nommee "editeur"*/
create database if not exists editeur;

-- les requetes qui suivent utiliseront
-- la base de donnees selectionne ci-dessus
use editeur;

/*creer une table nommee "livre"*/
create table if not exists livre
(
	livre_id int auto_increment primary key,
    livre_titre varchar(255) not null,
    livre_prix_de_vente decimal(5.2) not null
);

insert into livre