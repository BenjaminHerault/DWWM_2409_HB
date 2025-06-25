
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



// Contrôleur MVS
require_once __DIR__ . '/Controleur/BiensImmoController.php';
$ctrl = new BiensImmoController();

$action = $_GET['action'] ?? ($_POST['action'] ?? 'liste');

switch ($action) {
    case 'liste':
        // Si un filtre est appliqué (département ou pièces), on utilise lesFlitre
        if (
            (isset($_GET['nbPieces']) && !empty($_GET['nbPieces'])) ||
            (isset($_GET['depList']) && !empty($_GET['depList']))
        ) {
            $ctrl->lesFlitre();
        } else {
            $ctrl->afficherTous();
        }
        break;
    case 'modifier':
        if (isset($_GET['id_bien']) && !empty($_GET['id_bien'])) {
            $ctrl->miseAJour();
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