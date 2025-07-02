
<?php
session_start();
/* HEADER entete avec dépendances CSS 
  ================================================== */
include_once __DIR__ . '/Vue/vueHeader.php';

/*NAVBAR
    ================================================== */
include_once __DIR__ . '/Vue/vueMenu.php';

/* Carousel
    ================================================== */
include_once __DIR__ . '/Vue/vueSlider.php';

//require("./dao/connection.php");

/*  Marketing mainpage 
    ================================================== 
   Wrap the rest of the page in another container to center all the content. */



// Contrôleur MVC avec validation sécurisée
require_once __DIR__ . '/Controleur/BiensImmoController.php';
$ctrl = new BiensImmoController();

/**
 * Fonction de validation et nettoyage des données utilisateur
 */
function validateAndSanitize($input, $type = 'string', $maxLength = 255)
{
    // Pour les entiers, on accepte 0 comme valeur valide
    if ($type === 'int') {
        // Si c'est vide ou non numérique, retourne null
        if (empty($input) || !is_numeric($input)) {
            return null;
        }
        $intValue = (int)$input;
        return $intValue > 0 ? $intValue : null; // On refuse les valeurs négatives ou zéro
    }
    
    if (empty($input)) return null;

    switch ($type) {
        case 'email':
            return filter_var($input, FILTER_VALIDATE_EMAIL) ?: null;
        case 'string':
        default:
            $sanitized = trim(htmlspecialchars($input, ENT_QUOTES, 'UTF-8'));
            return strlen($sanitized) <= $maxLength ? $sanitized : null;
    }
}

// Validation sécurisée de l'action
$allowedActions = ['liste', 'details', 'admin', 'modifier'];
$action = $_GET['action'] ?? ($_POST['action'] ?? 'liste');
$action = in_array($action, $allowedActions) ? $action : 'liste';

switch ($action) {
    case 'liste':
        // Validation des filtres
        $nbPieces = validateAndSanitize($_GET['nbPieces'] ?? '', 'int');
        $depList = validateAndSanitize($_GET['depList'] ?? '', 'int');
        $prixMax = validateAndSanitize($_GET['prixMax'] ?? '', 'int');

        // Si un filtre est présent dans l'URL (même s'il est vide), on utilise lesFlitre
        if (isset($_GET['nbPieces']) || isset($_GET['depList']) || isset($_GET['prixMax']) || isset($_GET['envoi'])) {
            $ctrl->lesFlitre($depList, $nbPieces, $prixMax);
        } else {
            $ctrl->afficherTous();
        }
        break;

    case 'details':
        $idBien = validateAndSanitize($_GET['id_bien'] ?? '', 'int');
        if ($idBien !== null && $idBien > 0) {
            $ctrl->detailBien($idBien);
        } else {
            // Redirection si ID invalide
            header('Location: index.php?action=liste');
            exit;
        }
        break;

    case 'admin':
        $ctrl->espaceAdmin();
        break;

    case 'modifier':
        $idBien = validateAndSanitize($_GET['id_bien'] ?? '', 'int');
        if ($idBien !== null && $idBien > 0) {
            $ctrl->miseAJour();
        } else {
            header('Location: index.php?action=liste');
            exit;
        }
        break;

    default:
        $ctrl->afficherTous();
        break;
}

include_once __DIR__ . '/Vue/vueAcces_membre.php';
/* Pied de page avec dépendances Javascript...
    ================================================== */

include_once __DIR__ . '/Vue/vueFooter.php';
?>