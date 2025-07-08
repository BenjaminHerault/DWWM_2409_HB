<?php
session_start();
require_once __DIR__ . '/Controleur/BiensImmoController.php';
$ctrl = new BiensImmoController();

$action = $_GET['action'] ?? ($_POST['action'] ?? 'liste');

// CONTRÔLE D'ACCÈS ET REDIRECTION AVANT TOUT AFFICHAGE HTML OU INCLUSION DE VUE !
if ($action === 'admin' && (!isset($_SESSION['user']) || $_SESSION['user']['id_niveau'] != 1)) {
    header('Location: index.php?action=connexion');
    exit;
}

/* HEADER entete avec dépendances CSS 
  ================================================== */
include_once __DIR__ . '/Vue/vueHeader.php';

/*NAVBAR
    ================================================== */
include_once __DIR__ . '/Vue/vueMenu.php';

/* Carousel
    ================================================== */
include_once __DIR__ . '/Vue/vueSlider.php';

switch ($action) {
    case 'liste':
        // Si un filtre est appliqué (département ou pièces), on utilise lesFlitre
        if (
            (isset($_GET['nbPieces']) && !empty($_GET['nbPieces'])) ||
            (isset($_GET['depList']) && !empty($_GET['depList'])) ||
            (isset($_GET['prixMax']) && !empty($_GET['prixMax']))
        ) {
            $ctrl->lesFlitre();
        } else {
            $ctrl->afficherTous();
        }
        break;
    case 'details':
        if (isset($_GET['id_bien']) && !empty($_GET['id_bien'])) {
            $ctrl->detailBien((int)$_GET['id_bien']);
        }
        break;
    case 'connexion':
        $ctrl->connexion();
        break;
    case 'admin':
        $ctrl->espaceAdmin();
        break;
    case 'modifier':
        if (isset($_GET['id_bien']) && !empty($_GET['id_bien'])) {
            $ctrl->miseAJour();
        }
        break;
    case 'images':
        if (isset($_GET['id_bien']) && !empty($_GET['id_bien'])) {
            $ctrl->gestionImages((int)$_GET['id_bien']);
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
