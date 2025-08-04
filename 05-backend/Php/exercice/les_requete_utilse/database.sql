-- ========================================
-- Base de données simple pour les démos PHP
-- ========================================

CREATE DATABASE IF NOT EXISTS test_simple CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE test_simple;

-- Table des utilisateurs
CREATE TABLE IF NOT EXISTS utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Données de test
INSERT IGNORE INTO utilisateurs (nom, email) VALUES 
('Jean Dupont', 'jean@example.com'),
('Marie Martin', 'marie@example.com'),
('Paul Durand', 'paul@example.com');