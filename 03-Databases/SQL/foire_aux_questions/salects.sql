
USE mini_faq;

SELECT * FROM users;
SELECT * FROM questions;
SELECT * FROM categories;
SELECT * FROM categories_questions;

-- 1. Sélectionner tous les utilisateurs (identifiant, nom, prénom, email).
SELECT user_id, user_lastname, user_firstname, user_email
FROM users;

-- 2. Sélectionner toutes les questions (date, intitulé, réponse, identifiant utilisateur) 
-- triées par date de la plus ancienne à la plus récente.
 SELECT question_date, question_label, question_response, user_id
 FROM questions
 ORDER BY question_date ASC;
 
 -- 3. Sélectionner les questions (identifiant, date, intitulé, réponse) de l’utilisateur n°2.
 SELECT question_id, question_date, question_label, question_response
 FROM questions
 WHERE user_id = 2;

-- 4. Sélectionner les questions (date, intitulé, réponse, identifiant utilisateur) de l’utilisateur Eva Satiti.
/* Avec jointure */
SELECT question_date, question_label, question_response, question_id
FROM questions
JOIN users ON questions.user_id = users.user_id

WHERE user_lastname = "Satiti" AND user_firstname = "Eva";

/*SANS jointure
SELECT question_date, question_label, question_response, questions.user_id
FROM questions, users
WHERE questions.user_id = users.user_id AND user_lastname = "Satiti" AND user_firstname = "Eva";
*/

-- 5. Sélectionner les questions (identifiant, date, intitulé, réponse, identifiant utilisateur) 
-- dont l’intitulé contient “SQL”. Le résultat est trié par le titre et par ordre décroissant.
SELECT question_id, question_date, question_label, question_response, user_id
FROM questions
WHERE question_label LIKE "%SQL%" -- LIKE = comme qui ressemble a 
ORDER BY question_label DESC;  -- ORDER BY pour ranger 

/*WHERE upper(question_label) = "%SQL%"    upper() pour avoir que les majuscules */
/*WHERE lower(question_label) = "%SQL%"    lower() pour avoir que les minuscules */

-- 6. Sélectionner les catégories (nom, description) sans question associée.
SELECT categories.category_name, category_description
FROM categories LEFT JOIN categories_questions ON categories.category_name = categories_questions.category_name
WHERE categories_questions.category_name IS NULL;
-- ON = Pour faire une comparaison sur une valeur d'une table a une autre  

-- 7. Sélectionner les questions triées par titre (ordre alphabétique) 
-- avec le nom et prénom de l’auteur (nécessite une jointure).
SELECT question_id, question_date, question_label, question_response, user_lastname, user_firstname
FROM questions
JOIN users ON users.user_id = questions.question_id;

-- 8. Sélectionner les catégories (nom) avec, pour chaque catégorie 
-- le nombre de questions associées (nécessite une jointure).
SELECT categories.category_name, count(categories_questions.question_id) as nb_questions 




/*
SELECT categories.category_name, count(categories_questions.question_id) as nb_questions 
count() = 
En SQL, la fonction d’agrégation COUNT() permet de compter 
le nombre d’enregistrement dans une table. Connaître le nombre 
de lignes dans une table est très pratique dans de nombreux cas, 
par exemple pour savoir combien d’utilisateurs sont présents dans 
une table ou pour connaître le nombre de commentaires sur un article.

as = 
Dans le langage SQL il est possible d’utiliser des alias pour renommer 
temporairement une colonne ou une table dans une requête. Cette astuce 
est particulièrement utile pour faciliter la lecture des requêtes.
*/

