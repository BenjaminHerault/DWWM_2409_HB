<?php
/*
 * FICHIER PRINCIPAL DE ROUTAGE DE L'APPLICATION
 * Ce fichier sert de "chef d'orchestre" qui reçoit toutes les demandes
 * et les redirige vers les bonnes actions
 */

// Démarrer la session pour pouvoir utiliser $_SESSION (connexion utilisateur, messages...)
session_start();

// Inclure le contrôleur principal qui contient toutes les méthodes
require_once __DIR__ . '/Controleur/BiensImmoController.php';
$ctrl = new BiensImmoController();

/*
 * RÉCUPÉRATION DE L'ACTION DEMANDÉE
 * On regarde d'abord dans $_GET['action'], puis dans $_POST['action']
 * Si aucune action n'est spécifiée, on utilise 'liste' par défaut
 */
$action = $_GET['action'] ?? ($_POST['action'] ?? 'liste');

/*
 * CONTRÔLE D'ACCÈS POUR L'ESPACE ADMIN
 * IMPORTANT : Cette vérification doit être faite AVANT tout affichage HTML
 * car on peut avoir besoin de rediriger l'utilisateur
 */
if ($action === 'admin' && (!isset($_SESSION['user']) || $_SESSION['user']['id_niveau'] != 1)) {
    // L'utilisateur n'est pas connecté OU n'a pas le niveau SuperAdmin (niveau 1)
    header('Location: index.php?action=connexion');
    exit; // IMPORTANT : toujours faire exit après un header de redirection
}

/*
 * GESTION DES ACTIONS QUI FONT DES REDIRECTIONS
 * 
 * PROBLÈME RÉSOLU : "Cannot modify header information - headers already sent"
 * 
 * EXPLICATION DU PROBLÈME :
 * - Quand on inclut une vue (vueHeader.php, vueMenu.php...), du HTML est envoyé au navigateur
 * - Une fois que du HTML est envoyé, on ne peut plus envoyer de headers HTTP (comme les redirections)
 * - Résultat : erreur "headers already sent"
 * 
 * SOLUTION :
 * - Traiter d'abord TOUTES les actions qui font des redirections
 * - Seulement APRÈS, inclure les vues HTML
 */

// Liste des actions qui font des redirections (pas d'affichage HTML)
$actionsAvecRedirection = [
    'changer_image_principale',  // Remplace l'image principale d'un bien
    'promouvoir_image',         // Définit une image secondaire comme principale
    'supprimer_image',          // Supprime une image
    'ajouter_image_secondaire', // Ajoute une nouvelle image secondaire
    'migrer_images'            // Migre les anciennes images vers le nouveau système
];

// Si l'action demandée fait partie des actions avec redirection
if (in_array($action, $actionsAvecRedirection)) {

    /*
     * TRAITEMENT DES ACTIONS DE GESTION D'IMAGES
     * Toutes ces actions modifient les données puis redirigent vers la page de gestion
     */
    switch ($action) {
        case 'changer_image_principale':
            // Vérifie que l'ID du bien est présent et valide
            if (isset($_GET['id_bien']) && !empty($_GET['id_bien'])) {
                // Appelle la méthode du contrôleur qui gère le changement d'image principale
                $ctrl->changerImagePrincipale((int)$_GET['id_bien']);
            }
            break;

        case 'promouvoir_image':
            // Vérifie que l'ID du bien ET l'ID de l'image sont présents
            if (isset($_GET['id_bien']) && isset($_GET['id_image'])) {
                // Appelle la méthode qui définit une image comme principale
                $ctrl->promouvoirImage((int)$_GET['id_bien'], (int)$_GET['id_image']);
            }
            break;

        case 'supprimer_image':
            // Vérifie que l'ID du bien ET l'ID de l'image sont présents
            if (isset($_GET['id_bien']) && isset($_GET['id_image'])) {
                // Appelle la méthode qui supprime une image
                $ctrl->supprimerImage((int)$_GET['id_bien'], (int)$_GET['id_image']);
            }
            break;

        case 'ajouter_image_secondaire':
            // Vérifie que l'ID du bien est présent et valide
            if (isset($_GET['id_bien']) && !empty($_GET['id_bien'])) {
                // Appelle la méthode qui ajoute une image secondaire
                $ctrl->ajouterImageSecondaire((int)$_GET['id_bien']);
            }
            break;
    }

    /*
     * SÉCURITÉ : Si on arrive ici, c'est qu'il y a eu un problème
     * (par exemple, paramètres manquants ou erreur dans la redirection)
     * On redirige vers la liste par sécurité
     */
    header('Location: index.php?action=liste');
    exit;
}

/*
 * BUFFER DE SORTIE (OUTPUT BUFFERING)
 * 
 * POURQUOI C'EST UTILE :
 * - ob_start() met en "pause" l'envoi du HTML au navigateur
 * - Tout le HTML est stocké en mémoire (buffer)
 * - ob_end_flush() envoie tout d'un coup à la fin
 * - Cela évite certains problèmes de headers et améliore les performances
 */
ob_start();

/*
 * INCLUSION DES VUES DE STRUCTURE DE LA PAGE
 * Ces fichiers contiennent le HTML de base (header, navigation, slider)
 * IMPORTANT : Ces inclusions sont maintenant APRÈS le traitement des redirections
 */

/* HEADER avec les balises <head>, CSS, etc. */
include_once __DIR__ . '/Vue/vueHeader.php';

/* BARRE DE NAVIGATION (menu) */
include_once __DIR__ . '/Vue/vueMenu.php';

/* CARROUSEL D'IMAGES en haut de page */
include_once __DIR__ . '/Vue/vueSlider.php';

/*
 * TRAITEMENT DES ACTIONS QUI AFFICHENT DU CONTENU
 * Contrairement aux actions précédentes, celles-ci affichent des pages HTML
 */
switch ($action) {

    case 'liste':
        /*
         * AFFICHAGE DE LA LISTE DES BIENS IMMOBILIERS
         * Avec ou sans filtres (département, nombre de pièces, prix)
         */

        // Vérification si des filtres sont appliqués
        if (
            (isset($_GET['nbPieces']) && !empty($_GET['nbPieces'])) ||
            (isset($_GET['depList']) && !empty($_GET['depList'])) ||
            (isset($_GET['prixMax']) && !empty($_GET['prixMax']))
        ) {
            // Des filtres sont appliqués : utiliser la méthode de recherche filtrée
            $ctrl->lesFlitre();
        } else {
            // Aucun filtre : afficher tous les biens
            $ctrl->afficherTous();
        }
        break;

    case 'details':
        // AFFICHAGE DU DÉTAIL D'UN BIEN IMMOBILIER
        if (isset($_GET['id_bien']) && !empty($_GET['id_bien'])) {
            // Convertir l'ID en entier pour sécurité et appeler la méthode
            $ctrl->detailBien((int)$_GET['id_bien']);
        }
        break;

    case 'connexion':
        // AFFICHAGE ET TRAITEMENT DU FORMULAIRE DE CONNEXION
        $ctrl->connexion();
        break;

    case 'admin':
        // AFFICHAGE DE L'ESPACE ADMINISTRATEUR
        // (La vérification d'accès a déjà été faite plus haut)
        $ctrl->espaceAdmin();
        break;

    case 'modifier':
        // AFFICHAGE ET TRAITEMENT DU FORMULAIRE DE MODIFICATION D'UN BIEN
        if (isset($_GET['id_bien']) && !empty($_GET['id_bien'])) {
            $ctrl->miseAJour();
        }
        break;

    case 'images':
        // AFFICHAGE DE LA PAGE DE GESTION DES IMAGES D'UN BIEN
        if (isset($_GET['id_bien']) && !empty($_GET['id_bien'])) {
            $ctrl->gestionImages((int)$_GET['id_bien']);
        }
        break;

    default:
        // CAS PAR DÉFAUT : si l'action n'est pas reconnue, afficher la liste
        $ctrl->afficherTous();
        break;
}

/*
 * INCLUSION DES VUES DE FIN DE PAGE
 */

/* Section d'accès membre (probablement des liens de connexion/déconnexion) */
include_once __DIR__ . '/Vue/vueAcces_membre.php';

/* Pied de page avec les scripts JavaScript, fermeture des balises HTML */
include_once __DIR__ . '/Vue/vueFooter.php';

/*
 * ENVOI DU BUFFER DE SORTIE
 * Maintenant on envoie tout le HTML d'un coup au navigateur
 */
ob_end_flush();
