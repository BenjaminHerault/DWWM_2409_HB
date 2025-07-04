<?php
session_start();


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

// Préparation des données et de la vue à afficher
$vue = '';
$data = [];
switch ($action) {
    case 'liste':
        $nbPieces = validateAndSanitize($_GET['nbPieces'] ?? '', 'int');
        $depList = validateAndSanitize($_GET['depList'] ?? '', 'int');
        $prixMax = validateAndSanitize($_GET['prixMax'] ?? '', 'int');
        if (isset($_GET['nbPieces']) || isset($_GET['depList']) || isset($_GET['prixMax']) || isset($_GET['envoi'])) {
            $data = $ctrl->lesFlitre($depList, $nbPieces, $prixMax);
        } else {
            $data = $ctrl->afficherTous();
        }
        $vue = 'vueListe_bien_immo.php';
        break;
    case 'details':
        $idBien = validateAndSanitize($_GET['id_bien'] ?? '', 'int');
        if ($idBien !== null && $idBien > 0) {
            $data = $ctrl->detailBien($idBien);
            $vue = 'vueDetailBien.php';
        } else {
            header('Location: index.php?action=liste');
            exit;
        }
        break;
    case 'admin':
        $data = $ctrl->espaceAdmin();
        $vue = 'VueAdmin.php';
        break;
    case 'modifier':
        $idBien = validateAndSanitize($_GET['id_bien'] ?? '', 'int');
        if ($idBien !== null && $idBien > 0) {
            $data = $ctrl->miseAJour();
            $vue = 'vueMaj_bien.php';
        } else {
            header('Location: index.php?action=liste');
            exit;
        }
        break;
    default:
        $data = $ctrl->afficherTous();
        $vue = 'vueListe_bien_immo.php';
        break;
}

// HEADER, NAVBAR, SLIDER
include_once __DIR__ . '/Vue/vueHeader.php';
include_once __DIR__ . '/Vue/vueMenu.php';
include_once __DIR__ . '/Vue/vueSlider.php';

// Affichage de la vue principale
if ($vue) {
    if (is_array($data)) extract($data);
    include __DIR__ . '/Vue/' . $vue;
}

include_once __DIR__ . '/Vue/vueAcces_membre.php';
include_once __DIR__ . '/Vue/vueFooter.php';
