<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/Controleur/FormControleur.php';
$ctrl = new FormControleur();

$action = $_GET['action'] ?? 'Accueil';

switch ($action) {
    case 'accueil':
        $ctrl->afficherAccueil();
        break;
    case 'inscription':
        $ctrl->inscription();
        break;
    case 'connexion':
        $ctrl->connexion();
        break;
    case 'deconnexion':
        $ctrl->deconnexion();
        break;
    case 'espace':
        $ctrl->espacePerso();
        break;
    case 'modifier':
        $ctrl->modifierCompte();
        break;
    case 'supprimer':
        $ctrl->supprimerCompte();
        break;
    case 'admin':
        $ctrl->espaceAdmin();
        break;
    case 'admin_modifier':
        $ctrl->adminModifier();
        break;
    case 'admin_supprimer':
        $ctrl->espaceAdmin();
        break;

    default:
        $ctrl->afficherAccueil();
}
