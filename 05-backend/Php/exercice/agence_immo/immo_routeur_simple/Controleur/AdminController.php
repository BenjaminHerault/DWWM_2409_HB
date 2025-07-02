<?php

require_once __DIR__ . '/../models/UserRepository.php';
require_once __DIR__ . '/../models/ImmoRepository.php';
require_once __DIR__ . '/../models/DepartRepository.php';
require_once __DIR__ . '/../models/ImageRepository.php';

class AdminController
{
    private $userRepo;
    private $immoRepo;
    private $departRepo;
    private $imageRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
        $this->immoRepo = new ImmoRepository();
        $this->departRepo = new DepartRepository();
        $this->imageRepo = new ImageRepository();
    }

    /**
     * Vérifie si l'utilisateur connecté est un SuperAdmin
     */
    private function checkSuperAdminAccess(): bool
    {
        if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
            return false;
        }

        return isset($_SESSION['user']['id_niveau']) && $_SESSION['user']['id_niveau'] == 1;
    }

    /**
     * Redirige vers l'accueil si l'utilisateur n'est pas SuperAdmin
     */
    private function redirectUnauthorized(): void
    {
        header('Location: index.php?action=liste');
        exit;
    }

    /**
     * Affiche le tableau de bord principal de l'admin
     */
    public function dashboard(): void
    {
        if (!$this->checkSuperAdminAccess()) {
            $this->redirectUnauthorized();
        }

        // Récupération des statistiques pour le dashboard
        $stats = $this->getAdminStats();

        require_once __DIR__ . '/../Vue/admin/vueAdminDashboard.php';
    }

    /**
     * Gestion des utilisateurs - liste
     */
    public function gestionUtilisateurs(): void
    {
        if (!$this->checkSuperAdminAccess()) {
            $this->redirectUnauthorized();
        }

        $utilisateurs = $this->userRepo->getAllUtilisateurs();

        require_once __DIR__ . '/../Vue/admin/vueGestionUtilisateurs.php';
    }

    /**
     * Création d'un nouvel utilisateur
     */
    public function creerUtilisateur(): void
    {
        if (!$this->checkSuperAdminAccess()) {
            $this->redirectUnauthorized();
        }

        $message = '';
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $id_niveau = (int)($_POST['id_niveau'] ?? 3); // Par défaut : Propriétaire

            // Validation des données
            if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
                $error = "Tous les champs sont obligatoires.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Email invalide.";
            } elseif (strlen($password) < 6) {
                $error = "Le mot de passe doit contenir au moins 6 caractères.";
            } elseif ($this->userRepo->emailExists($email)) {
                $error = "Cet email est déjà utilisé.";
            } else {
                // Création de l'utilisateur
                $userId = $this->userRepo->createUtilisateurs($nom, $prenom, $email, $password, $id_niveau);
                if ($userId) {
                    $message = "Utilisateur créé avec succès !";
                    // Redirection après succès
                    header('Location: index.php?action=admin&sub=users&success=1');
                    exit;
                } else {
                    $error = "Erreur lors de la création de l'utilisateur.";
                }
            }
        }

        require_once __DIR__ . '/../Vue/admin/vueCreerUtilisateur.php';
    }

    /**
     * Suppression d'un utilisateur
     */
    public function supprimerUtilisateur(): void
    {
        if (!$this->checkSuperAdminAccess()) {
            $this->redirectUnauthorized();
        }

        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = (int)$_GET['id'];

            // Vérification : ne pas supprimer son propre compte
            if ($id === $_SESSION['user']['id']) {
                header('Location: index.php?action=admin&sub=users&error=self_delete');
                exit;
            }

            $success = $this->userRepo->deleteUtilisateur($id);

            if ($success) {
                header('Location: index.php?action=admin&sub=users&success=delete');
            } else {
                header('Location: index.php?action=admin&sub=users&error=delete_failed');
            }
            exit;
        }

        $this->redirectUnauthorized();
    }

    /**
     * Gestion des biens immobiliers
     */
    public function gestionBiens(): void
    {
        if (!$this->checkSuperAdminAccess()) {
            $this->redirectUnauthorized();
        }

        $biens = $this->immoRepo->searchAll();

        require_once __DIR__ . '/../Vue/admin/vueGestionBiens.php';
    }

    /**
     * Récupère les statistiques pour le dashboard
     */
    private function getAdminStats(): array
    {
        $stats = [
            'total_biens' => $this->immoRepo->countTotalBiens(),
            'total_users' => $this->userRepo->countTotalUtilisateurs(),
            'total_departments' => $this->departRepo->countTotalDepartements(),
            'recent_biens' => $this->immoRepo->getRecentBiens(5), // 5 derniers biens
            'recent_users' => $this->userRepo->getRecentUtilisateurs(5) // 5 derniers utilisateurs
        ];

        return $stats;
    }

    /**
     * Connexion admin
     */
    public function connexion(): void
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($email) || empty($password)) {
                $error = "Email et mot de passe sont requis.";
            } else {
                $user = $this->userRepo->authenticateUtilisateur($email, $password);

                if ($user && $user['id_niveau'] == 1) { // SuperAdmin seulement
                    $_SESSION['user'] = $user;
                    header('Location: index.php?action=admin');
                    exit;
                } else {
                    $error = "Accès refusé. Seuls les SuperAdmin peuvent accéder à cette zone.";
                }
            }
        }

        require_once __DIR__ . '/../Vue/admin/vueConnexionAdmin.php';
    }

    /**
     * Déconnexion admin
     */
    public function deconnexion(): void
    {
        session_destroy();
        header('Location: index.php?action=liste');
        exit;
    }
}
