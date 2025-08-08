<?php
session_start();

// ========================================
// Configuration simple
// ========================================

$host = 'localhost';
$dbname = 'test';  // ← Changez vers une base existante
$username = 'root';
$password = '';

// ========================================
// Connexion PDO simple
// ========================================

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<div style='color: green;'>✅ Connexion réussie à la base de données</div>";
} catch (PDOException $e) {
    echo "<div style='color: red;'>❌ Erreur de connexion : " . $e->getMessage() . "</div>";
    echo "<p><strong>Créez d'abord la base de données 'test_simple' !</strong></p>";
    $pdo = null;
}

// ========================================
// Classe Utilisateur simple
// ========================================

class Utilisateur
{
    public $id;
    public $nom;
    public $email;

    public function __construct($nom = '', $email = '')
    {
        $this->nom = $nom;
        $this->email = $email;
    }

    public function afficher()
    {
        return "👤 {$this->nom} ({$this->email})";
    }
}

// ========================================
// Fonctions CRUD simples
// ========================================

function creerUtilisateur($pdo, $nom, $email)
{
    $sql = "INSERT INTO utilisateurs (nom, email) VALUES (:nom, :email)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute(['nom' => $nom, 'email' => $email]);
}

function lireUtilisateurs($pdo)
{
    $sql = "SELECT * FROM utilisateurs ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function supprimerUtilisateur($pdo, $id)
{
    $sql = "DELETE FROM utilisateurs WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute(['id' => $id]);
}

// ========================================
// Traitement des formulaires
// ========================================

$message = '';

if ($_POST && $pdo) {
    if (isset($_POST['ajouter'])) {
        $nom = trim($_POST['nom']);
        $email = trim($_POST['email']);

        if ($nom && $email) {
            if (creerUtilisateur($pdo, $nom, $email)) {
                $message = "<div style='color: green;'>✅ Utilisateur ajouté avec succès !</div>";
            } else {
                $message = "<div style='color: red;'>❌ Erreur lors de l'ajout</div>";
            }
        } else {
            $message = "<div style='color: orange;'>⚠️ Veuillez remplir tous les champs</div>";
        }
    }

    if (isset($_POST['supprimer'])) {
        $id = (int)$_POST['id'];
        if (supprimerUtilisateur($pdo, $id)) {
            $message = "<div style='color: green;'>✅ Utilisateur supprimé !</div>";
        }
    }
}

// Récupérer les utilisateurs
$utilisateurs = $pdo ? lireUtilisateurs($pdo) : [];

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Simple - PDO & POO</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #f5f5f5;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin: 15px 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background: #007cba;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #005a87;
        }

        .btn-danger {
            background: #dc3545;
            padding: 5px 10px;
            font-size: 12px;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #f8f9fa;
            font-weight: bold;
        }

        .code-block {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
            font-family: 'Courier New', monospace;
            font-size: 14px;
        }

        .concept {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 15px;
            margin: 20px 0;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>🎯 PHP Simple - PDO & POO</h1>

        <div class="concept">
            <h3>📚 Concepts illustrés dans cette page :</h3>
            <ul>
                <li><strong>PDO</strong> : Connexion et requêtes préparées</li>
                <li><strong>POO</strong> : Classe Utilisateur simple</li>
                <li><strong>CRUD</strong> : Create, Read, Delete</li>
                <li><strong>Formulaires</strong> : Traitement POST sécurisé</li>
                <li><strong>Sessions</strong> : session_start() de base</li>
            </ul>
        </div>

        <?php echo $message; ?>

        <!-- Script SQL pour créer la table -->
        <?php if (!$pdo): ?>
            <div class="code-block">
                <h3>📝 Script SQL à exécuter :</h3>
                <pre>
CREATE DATABASE test_simple CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE test_simple;

CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Données de test
INSERT INTO utilisateurs (nom, email) VALUES 
('Jean Dupont', 'jean@example.com'),
('Marie Martin', 'marie@example.com');
        </pre>
            </div>
        <?php endif; ?>

        <!-- Formulaire d'ajout -->
        <h2>➕ Ajouter un utilisateur</h2>
        <form method="post">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>

            <button type="submit" name="ajouter">➕ Ajouter</button>
        </form>

        <!-- Liste des utilisateurs -->
        <h2>👥 Liste des utilisateurs (<?= count($utilisateurs) ?>)</h2>

        <?php if (empty($utilisateurs)): ?>
            <p>Aucun utilisateur trouvé. Ajoutez-en un ci-dessus !</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Date création</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($utilisateurs as $user): ?>
                        <?php
                        // Démonstration POO : créer un objet Utilisateur
                        $utilisateur = new Utilisateur($user['nom'], $user['email']);
                        $utilisateur->id = $user['id'];
                        ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= htmlspecialchars($user['nom']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= $user['date_creation'] ?></td>
                            <td>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                    <button type="submit" name="supprimer" class="btn-danger"
                                        onclick="return confirm('Supprimer cet utilisateur ?')">
                                        🗑️ Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <!-- Exemples de code -->
        <h2>💻 Code utilisé</h2>

        <h3>🔗 Connexion PDO</h3>
        <div class="code-block">
            try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            }
        </div>

        <h3>👤 Classe Utilisateur</h3>
        <div class="code-block">
            class Utilisateur {
            public $id;
            public $nom;
            public $email;

            public function __construct($nom = '', $email = '') {
            $this->nom = $nom;
            $this->email = $email;
            }

            public function afficher() {
            return "👤 {$this->nom} ({$this->email})";
            }
            }
        </div>

        <h3>📊 Requête préparée (CREATE)</h3>
        <div class="code-block">
            function creerUtilisateur($pdo, $nom, $email) {
            $sql = "INSERT INTO utilisateurs (nom, email) VALUES (:nom, :email)";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute(['nom' => $nom, 'email' => $email]);
            }
        </div>

        <h3>📖 Requête de lecture (READ)</h3>
        <div class="code-block">
            function lireUtilisateurs($pdo) {
            $sql = "SELECT * FROM utilisateurs ORDER BY id DESC";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        </div>

        <h3>🛡️ Traitement sécurisé des formulaires</h3>
        <div class="code-block">
            if ($_POST && isset($_POST['ajouter'])) {
            $nom = trim($_POST['nom']); // Nettoyage
            $email = trim($_POST['email']); // Nettoyage

            if ($nom && $email) {
            // Utilisation de requête préparée (protection injection SQL)
            creerUtilisateur($pdo, $nom, $email);
            }
            }
        </div>

        <div class="concept">
            <h3>🔐 Sécurité mise en place :</h3>
            <ul>
                <li><strong>Requêtes préparées PDO</strong> : Protection contre injection SQL</li>
                <li><strong>htmlspecialchars()</strong> : Protection contre XSS</li>
                <li><strong>trim()</strong> : Nettoyage des données</li>
                <li><strong>Validation côté serveur</strong> : Vérification des champs</li>
            </ul>
        </div>

    </div>

</body>

</html>