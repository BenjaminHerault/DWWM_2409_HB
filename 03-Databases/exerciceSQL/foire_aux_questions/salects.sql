use mini_faq;

SELECT * FROM users ;
SELECT * FROM questions;
SELECT * FROM categories;
SELECT * FROM categories_questions;

-- 1

SELECT user_id, user_lastname, user_firstname, user_email
FROM users; 

-- 2 
SELECT question_date, question_label, question_response, user_id
FROM questions
ORDER BY question_date ASC;

-- 3
SELECT question_id, question_date, question_label, question_response
FROM questions
WHERE user_id = 2;


-- 4
/* Avec jointure */
SELECT question_date, question_label, question_response, questions.user_id
FROM questions
JOIN users ON questions.user_id = users.user_id
WHERE user_lastname = "Satiti" AND user_firstname = "Eva";

/*SANS jointure*/
SELECT question_date, question_label, question_response, questions.user_id
FROM questions, users
WHERE questions.user_id = users.user_id AND user_lastname = "Satiti" AND user_firstname = "Eva";

-- 5
SELECT question_id, question_date, question_label, question_response, user_id
FROM questions
WHERE question_label LIKE "%SQL%"
ORDER BY question_label DESC;

-- 6 

SELECT category_name, category_description
FROM categories
LEFT JOIN categories_question ON categories.category_name = categories_questions.category_name;


