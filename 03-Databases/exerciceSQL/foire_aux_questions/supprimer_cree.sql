
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
	question_response TEXT(65535) NOT NULL,
    PRIMARY KEY (question_id)
);
CREATE TABLE categories 
(
	
);




