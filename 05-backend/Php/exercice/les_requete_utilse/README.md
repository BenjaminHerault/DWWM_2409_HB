# 🎯 PHP Simple - PDO & POO

## 📋 Description

Version **ultra-simplifiée** pour apprendre les bases de PHP avec PDO et POO.

**Tout est dans un seul fichier `index.php` !** 🚀

## 🚀 Installation rapide

1. **Créer la base de données** :

    ```sql
    -- Copier-coller ce code dans phpMyAdmin ou MySQL
    CREATE DATABASE test_simple CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    USE test_simple;

    CREATE TABLE utilisateurs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(100) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    INSERT INTO utilisateurs (nom, email) VALUES
    ('Jean Dupont', 'jean@example.com'),
    ('Marie Martin', 'marie@example.com');
    ```

2. **Ou utiliser le script** :

    ```bash
    mysql -u root -p < database.sql
    ```

3. **Modifier la config** dans `index.php` si besoin :

    ```php
    $host = 'localhost';
    $dbname = 'test_simple';
    $username = 'root';
    $password = '';  // Votre mot de passe MySQL
    ```

4. **Ouvrir** `index.php` dans votre navigateur !

## 📚 Concepts illustrés

✅ **PDO** : Connexion simple et requêtes préparées  
✅ **POO** : Classe `Utilisateur` basique  
✅ **CRUD** : Create, Read, Delete  
✅ **Formulaires** : Traitement POST sécurisé  
✅ **Sessions** : `session_start()` de base  
✅ **Sécurité** : Protection XSS et injection SQL

## 🎯 Parfait pour apprendre

-   **Un seul fichier** = facile à comprendre
-   **Code commenté** = explications claires
-   **Exemples visuels** = voir le code en action
-   **Sécurité de base** = bonnes pratiques

## 🔧 Structure simple

```
📁 Projet/
├── 📄 index.php      # TOUT est ici !
├── 🗃️ database.sql   # Script pour créer la BDD
└── 📖 README.md      # Ce fichier
```

Beaucoup plus simple que la version précédente avec 15 fichiers ! 😄
