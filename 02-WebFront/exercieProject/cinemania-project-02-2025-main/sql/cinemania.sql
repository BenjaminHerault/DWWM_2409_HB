CREATE DATABASE Cinemania;

USE Cinemania;

CREATE TABLE article
(
    article_id INT PRIMARY KEY AUTO_INCREMENT not null,
    article_title VARCHAR(100) not null,
    author VARCHAR(50) not null,
    publication_date DATE not null, 
    rating DECIMAL (3,1) not null,
    review TEXT not null
);

INSERT INTO article (article_title, author, publication_date, rating, review) VALUES
    ("Captain America: Brave New World - Une Renaissance Héroïque ou un Échec ?", "Jean Dupont","2025-02-25",13.5, "moyen"),
    ("Dune: Partie 2 - Une Épopée Monumentale qui Redéfinit la Science-Fiction ", "Sophie Martin", "2025-02-25", 15, "excellent"),
    ("Le Comte de Monte-Cristo (2024) - Une Vengeance Magistrale à l’Écran", "Marc Lefebvre", "2025-02-25", 14.5, "correct"),
    ("Gladiator 2 - Peut-il Réinventer la Légende du Premier Chef-d’Œuvre ?", "Élise Bernard", "2025-02-25", 14, "bon film"),
    ("Mufasa: Le Roi Lion - Une Origine Majestueuse ou un Préquel Inutile ?", "Thomas Girard", "2025-02-25", 13, "insatisfait"),
    ("Nosferatu (2024) - L’Horreur Gothique Revient-elle en Force ?", "Camille Rousseau", "2025-02-25", 14.5, "correct");


CREATE TABLE review
(
    review_id INT PRIMARY KEY AUTO_INCREMENT not null,
    name_firstname VARCHAR(70) not null,
    email VARCHAR(50) not null, 
    rating INT(1) not null, 
    description_review TEXT not null,
    comment_date DATETIME not null

);

INSERT INTO review (name_firstname, email, rating, description_review,comment_date) VALUES
    ("CETIN Hülya", "hulya@hotmail.fr", 3, "so so", "2025-02-26 10:05:30");