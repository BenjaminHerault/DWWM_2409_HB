<?php

require_once __DIR__ . '/Modele/Dbconnect.php';
require_once __DIR__ . '/Modele/DepartRepository.php';
require_once __DIR__ . '/Modele/FormRepository.php';

// Récupération des départements pour la liste déroulante
$departRepo = new DepartRepository();
$departements = $departRepo->searchAll();

session_start();
require_once __DIR__ . '/Controleur/FormControleur.php';
$ctrl = new FormControleur();

$action = $_GET['action'] ?? 'accueil';

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
    case 'espace':
        $ctrl->espacePerso();
        break;
    case 'modifier':
        $ctrl->modifierCompte();
        break;
    case 'supprimer':
        $ctrl->supprimerCompte();
        break;
    default:
        $ctrl->afficherAccueil();
}
