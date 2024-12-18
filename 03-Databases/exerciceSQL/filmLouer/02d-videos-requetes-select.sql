/* 
REQUETES SQL A IMPLEMENTER 
Sous langage : DQL / LRD
Date Query Language
Langage de requête sur les données 
principales instruction : 
SELECT : Sélectionner des données existantes dans 1 ou plusieurs tables 


*/

/* 1. Sélectionner toutes les lignes et colonnes de la table acteurs */
SELECT *  FROM acteur;

SELECT acteur_id, acteur_nom, acteur_prenom FROM acteur;


/* 2. Sélectionner l'acteur dont l'identifiant est "2" */
SELECT acteur_id, acteur_prenom, acteur_nom
FROM acteur
WHERE acteur_id = 2;
;
/* 2. Sélectionner l'acteur dont l'identifiant différent de "2" */
SELECT acteur_id, acteur_prenom, acteur_nom
FROM acteur
WHERE acteur_id <> 2;


/* 3. Sélectionner l'acteur dont le nom est "Réno" */
SELECT acteur_nom, acteur_prenom
FROM acteur
WHERE acteur_nom = "Réno";

/* 4. Sélectionner les acteurs dont le prénom commence par "E" */
SELECT acteur_nom, acteur_prenom
FROM acteur
WHERE acteur_prenom LIKE "E%";

/* 4. Sélectionner les acteurs dont le nom se termine par "n" */
SELECT acteur_nom, acteur_prenom
FROM acteur
WHERE acteur_nom LIKE "%n";

/* 4. Sélectionner les acteurs dont leprenom contient la lettre "a" */
SELECT acteur_nom, acteur_prenom
FROM acteur
WHERE acteur_prenom LIKE "%a%";


/* 4. Sélectionner les acteurs dont le prenom fait partie de la liste ["Jean","Eva"] */
SELECT acteur_nom, acteur_prenom
FROM acteur
WHERE acteur_prenom IN("Jean","Eva");


SELECT acteur_nom, acteur_prenom
FROM acteur
WHERE acteur_prenom = "Jean" OR acteur_prenom = "Eva";

/* 4. Sélectionner les réalisateurs (nom, prénom) triés par nom et par ordre décroissant */






