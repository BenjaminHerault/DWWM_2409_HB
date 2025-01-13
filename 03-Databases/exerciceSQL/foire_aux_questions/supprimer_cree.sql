
-- suprimer la base de données "mini_faq"
DROP DATABASE if EXISTS mini_faq;

-- creer la base de données "mini_faq"
CREATE DATABASE IF NOT EXISTS mini_faq;

-- Sélectionner la base de données 
USE mini_faq;

-- pour cree une table
CREATE TABLE users 
(
	user_id INT AUTO_INCREMENT,
    user_email VARCHAR(128) NOT NULL UNIQUE,
    user_lastname VARCHAR(50) NOT NULL,
    user_firstname VARCHAR(50) NOT NULL,
    PRIMARY KEY (user_id)
);

CREATE TABLE questions
(
	question_id INT AUTO_INCREMENT,
	question_date DATE NOT NULL,
	question_label VARCHAR(255) NOT NULL, 
	question_response TEXT NOT NULL,
    user_id INT NOT NULL,
    PRIMARY KEY (question_id)
);

CREATE TABLE categories 
(
	category_name VARCHAR(30) ,
    category_description VARCHAR(255),
    category_order TINYINT NOT NULL UNIQUE,
    PRIMARY KEY (category_name)
);

CREATE TABLE categories_questions
(
	question_id INT,
    category_name VARCHAR(30),
    PRIMARY KEY (question_id, category_name)
);

-- Modifier la table publication et y ajouter une clé étrangére
ALTER TABLE questions ADD CONSTRAINT fk_questions_users FOREIGN KEY (user_id) REFERENCES users(user_id);

ALTER TABLE categories_questions 
	ADD CONSTRAINT fk_categories_questions__questions FOREIGN KEY (question_id) REFERENCES questions(question_id),
    ADD CONSTRAINT fk_categories_questions__categories FOREIGN KEY (category_name) REFERENCES categories(category_name);

