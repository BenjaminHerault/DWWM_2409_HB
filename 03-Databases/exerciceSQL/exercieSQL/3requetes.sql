SELECT nom_utilisateur, email
FROM utilisateur;

SELECT pub_titre, pub_date, pub_contenu, id
FROM publication
WHERE pub_date ORDER BY pub_date DESC;

SELECT pub_id, pub_date, pub_titre
FROM publication
WHERE id = 2;

SELECT pub_id, pub_titre, pub_contenu
FROM publication
WHERE pub_titre LIKE "%a%" ORDER BY pub_titre DESC;

SELECT id, nom_utilisateur, email
FROM utilisateur
WHERE email LIKE "%com";
