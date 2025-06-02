<?php

date_default_timezone_set('Europe/Paris'); // Définit le fuseau horaire sur Paris


// Vérifier que la méthode utilisée est POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Méthode non autorisée.";
    exit;
}

// Récupérer les données du formulaire
$nom = $_POST['nom'] ?? '';
$date_naissance = $_POST['date_naissance'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

// Initialiser un tableau pour les erreurs
$erreurs = [];

// Vérification du nom : au moins 2 caractères et que des lettres
if (strlen($nom) < 2 || !preg_match('/^[a-zA-ZÀ-ÿ\-\' ]+$/u', $nom)) {
    $erreurs[] = "Le nom doit contenir au moins 2 lettres et uniquement des lettres.";
}

// Vérification de la date de naissance : doit être dans le passé
if (!$date_naissance || strtotime($date_naissance) >= time()) {
    $erreurs[] = "La date de naissance doit être dans le passé.";
}

// Vérification de l'email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erreurs[] = "L'adresse email n'est pas valide.";
}

// Vérification du message : pas de balises HTML
if ($message !== strip_tags($message)) {
    $erreurs[] = "Le message ne doit pas contenir de balises HTML.";
}

// Calcul de l'âge
$age = null;
if ($date_naissance && strtotime($date_naissance) < time()) {
    $date_naissance_obj = new DateTime($date_naissance);
    $now = new DateTime();
    $age = $now->diff($date_naissance_obj)->y;
}

// Vérification de l'âge
if ($age !== null && $age < 18) {
    $erreurs[] = "Vous êtes mineur, accès interdit.";
}

// Affichage des erreurs ou des données
if (!empty($erreurs)) {
    echo "<h2>Erreurs :</h2><ul>";
    foreach ($erreurs as $erreur) {
        echo "<li>" . htmlspecialchars($erreur) . "</li>";
    }
    echo "</ul>";
    echo '<a href="contact.php">Retour au formulaire</a>';
} else {
    echo "<h2>Données reçues :</h2>";
    echo "Nom : " . htmlspecialchars($nom) . "<br>";
    echo "Date de naissance : " . htmlspecialchars($date_naissance) . "<br>";
    echo "Adresse email : " . htmlspecialchars($email) . "<br>";
    echo "Message : " . nl2br(htmlspecialchars($message)) . "<br>";
    echo "Âge : " . $age . " ans<br>";
    echo '<a href="contact.php">Retour au formulaire</a>';
}
