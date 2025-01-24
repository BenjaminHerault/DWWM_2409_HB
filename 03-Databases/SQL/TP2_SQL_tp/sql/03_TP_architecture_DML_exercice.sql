use db_architecte;

/* 1. Sélectionner l'identifiant, le nom de tous les clients dont le numéro de téléphone commence par '04' */

SELECT client_ref, client_nom, client_telephone 
FROM clients
WHERE client_telephone LIKE "04%";

/* 2. Sélectionner l'identifiant, le nom et le type de tous les clients qui sont des particuliers */

SELECT client_ref, client_nom, clients.type_client_id, type_clients.type_client_libelle
FROM clients
INNER JOIN type_clients ON  clients.type_client_id = type_clients.type_client_id
WHERE type_client_libelle = "Particulier";

-- version 2
SELECT client_ref, client_nom, clients.type_client_id, type_clients.type_client_libelle
FROM clients
NATURAL JOIN type_clients
WHERE type_client_libelle = "Particulier";

/* 3. Sélectionner l'identifiant, le nom et le type de tous les clients qui ne sont pas des particuliers */

SELECT client_ref, client_nom, clients.type_client_id, type_clients.type_client_libelle
FROM clients
INNER JOIN type_clients ON  clients.type_client_id = type_clients.type_client_id
WHERE type_client_libelle <> "Particulier";

/* 4. Sélectionner les projets qui ont été livrés en retard */

SELECT projet_ref
FROM projets
WHERE projet_date_fin_prevue < projet_date_fin_effective; 

/* 5. Sélectionner la date de dépôt, la date de fin prévue, les superficies, le prix de tous les projets 
    avec le nom du client et le nom de l'architecte associés au projet */
    
    -- Version 1
    
    SELECT projet_date_depot, projet_date_fin_prevue, projet_superficie_totale, 
    projet_superficie_batie, projet_prix, client_nom, emp_nom AS "Architecte Nom"
    FROM projets
    JOIN clients ON projets.client_ref = clients.client_ref
    JOIN employes ON projets.emp_matricule = employes.emp_matricule
    JOIN fonctions ON employes.fonction_id = fonctions.fonction_id
    WHERE fonction_nom = "Architecte";
    
    -- Version 2
    
    SELECT projet_date_depot, projet_date_fin_prevue, projet_superficie_totale,
    projet_superficie_batie , projet_prix, client_nom, emp_nom
	FROM projets
	JOIN clients
	ON projets.client_ref = clients.client_ref
	JOIN employes
	ON projets.emp_matricule = employes.emp_matricule
	WHERE fonction_id = (SELECT fonction_id 
							FROM fonctions 
                            WHERE fonction_nom = 'Architecte');
    
/* 6. Sélectionner tous les projets (dates, superficies, prix) 
avec le nombre d'intervenants autres que le client et l'architecte */

SELECT participer.projet_ref, projet_date_depot, projet_date_fin_prevue, projet_date_fin_effective, 
projet_superficie_totale,projet_superficie_batie, projet_prix, count(participer.emp_matricule) AS "Nombre d'employer"
FROM projets
INNER JOIN participer ON projets.projet_ref = participer.projet_ref
GROUP BY participer.projet_ref 
ORDER BY participer.projet_ref ASC;



/* 7. Sélectionner les types de projets avec, pour chacun d'entre eux, 
le nombre de projets associés et le prix moyen pratiqué */

SELECT type_projet_libelle, COUNT(projet_ref), AVG(projet_prix)
FROM type_projets
JOIN projets ON type_projets.type_projet_id = projets.type_projet_id
GROUP BY type_projet_libelle;

/* 8. Sélectionner les types de travaux avec, 
pour chacun d'entre eux, la superficie du projet la plus grande */

SELECT max(projet_superficie_totale), type_travaux_id, type_travaux_libelle
FROM projets
NATURAL JOIN type_travaux 
GROUP BY type_travaux_id 
ORDER BY type_travaux_id  ASC ;

/* 9. Sélectionner l'ensembles des projets (dates, prix) 
avec les informations du client (nom, telephone, adresse), le type de travaux et le type de projet. */

SELECT projet_date_depot, projet_date_fin_prevue, projet_date_fin_effective, projet_prix, client_telephone, client_nom, 
CONCAT(adresse_code_postal," ", adresse_ville," ", adresse_num_voie," ", adresse_voie) AS "Une adresse", type_travaux_libelle, type_projet_libelle
FROM projets
INNER JOIN clients ON projets.client_ref = clients.client_ref
INNER JOIN adresses ON clients.adresse_id = adresses.adresse_id
INNER JOIN type_travaux ON projets.type_travaux_id = type_travaux.type_travaux_id
INNER JOIN type_projets ON projets.type_projet_id = type_projets.type_projet_id;

/* 10. Sélectionner les projets dont l'adresse est identique au client associé */





