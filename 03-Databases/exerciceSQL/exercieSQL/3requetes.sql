SELECT nom_utilisateur, email
FROM utilisateur;

SELECT pub_titre, pub_date, pub_contenu, id
FROM publication
WHERE pub_date ORDER BY pub_date DESC;

SELECT pub_id, pub_date, pub_titre
FROM publication
WHERE id = 2;

/*SQL ORDER BY
La commande ORDER BY permet de trier les lignes dans un résultat d’une requête SQL. 
Il est possible de trier les données sur une ou plusieurs colonnes, par ordre ascendant 
ou descendant.*/
SELECT pub_id, pub_titre, pub_contenu
FROM publication
WHERE pub_titre LIKE "%a%" ORDER BY pub_titre DESC;

SELECT id, nom_utilisateur, email
FROM utilisateur
WHERE email LIKE "%com";

SELECT pub_id, pub_date, pub_titre, pub_contenu
FROM publication
/*Dans le langage SQL la commande INNER JOIN, aussi appelée EQUIJOIN, 
est un type de jointures très communes pour lier plusieurs tables entre-elles. 
Cette commande retourne les enregistrements lorsqu’il y a au moins une ligne 
dans chaque colonne qui correspond à la condition.*/
INNER JOIN utilisateur ON publication.id = utilisateur.id ORDER BY pub_titre ;