<?php
// Script temporaire pour promouvoir un utilisateur en admin
// Place ce fichier à la racine de ton projet et lance-le UNE FOIS dans le navigateur
// Supprime-le après usage pour la sécurité

// === CONFIGURATION ===
$host = 'localhost';
$dbname = 'form'; // À adapter
$user = 'root'; // À adapter
$pass = ''; // À adapter
$mail = 'benji@benji.fr'; // Mets ici l'email de l'utilisateur à promouvoir
$table = 'candidats'; // À adapter si besoin

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare("UPDATE $table SET is_admin = 1 WHERE mail_user = ?");
    $stmt->execute([$mail]);
    if ($stmt->rowCount() > 0) {
        echo "Utilisateur $mail promu admin !";
    } else {
        echo "Aucun utilisateur trouvé avec cet email.";
    }
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
