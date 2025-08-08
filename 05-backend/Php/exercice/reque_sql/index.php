<?php

/**
 * INDEX.PHP - Page principale du projet CRUD
 * 
 * Point d'entrée de l'application qui utilise le pattern MVC
 */

// Démarrage de la session pour pouvoir stocker des messages
session_start();

// Inclusion du contrôleur principal
require_once __DIR__ . '/Controleur/FormControleur.php';

// Création du contrôleur
$ctrl = new FormControleur();

// Récupération de l'action demandée (par défaut = accueil)
$action = $_GET['action'] ?? 'accueil';

// Traitement des différentes actions
switch ($action) {
    case 'accueil':
        $ctrl->afficherAccueil();
        break;
    default:
        $ctrl->afficherAccueil();
        break;
}
