<?php
session_start();
require_once __DIR__ . '/Controleur/ControleurResum.php';
$ctrl = new ControleurResum();

$action = $_GET['action'] ?? ($_POST['action'] ?? 'liste');

switch ($action) {
    case 'liste':
        $ctrl->afficherTous();
        break;
    case 'creer':
        $ctrl->creer($_POST['name'], $_POST['mail'], $_POST['password']);
        break;
    case 'modifier':
        $ctrl->modifier($_POST['id'], $_POST['name'], $_POST['mail'], $_POST['password'] ?? null);
        break;
    case 'supprimer':
        $ctrl->supprimer($_POST['id']);
        break;
    case 'connexion':
        $ctrl->connexion($_POST['mail'] ?? null, $_POST['password'] ?? null);
        break;
    case 'profil':
        $ctrl->afficherProfil();
        break;
    case 'modifierProfil':
        $ctrl->modifierProfil(
            $_POST['name'] ?? null,
            $_POST['mail'] ?? null,
            $_POST['password'] ?? null
        );
    default:
        $ctrl->afficherTous();
}
