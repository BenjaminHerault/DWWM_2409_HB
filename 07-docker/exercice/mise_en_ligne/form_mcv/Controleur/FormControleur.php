<?php
require_once __DIR__ . '/../Modele/FormRepository.php';
require_once __DIR__ . '/../Modele/DepartRepository.php';

class FormControleur
{
    private $repo;
    private $depRepo;

    public function __construct()
    {
        $this->repo = new FormRepository();
        $this->depRepo = new DepartRepository();
    }

    public function afficherAccueil()
    {
        $departements = $this->depRepo->searchAll();
        require __DIR__ . '/../Vue/VueAccueil.php';
    }

    public function inscription()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérification des champs
            $errors = [];
            if ($_POST['password'] !== $_POST['password2']) {
                $errors[] = "Les mots de passe ne correspondent pas.";
            }
            if (empty($errors)) {
                $ok = $this->repo->createCandidate(
                    $_POST['lastname'],
                    $_POST['firstname'],
                    $_POST['mail'],
                    $_POST['password'],
                    (int)$_POST['departement'],
                    (int)$_POST['age']
                );
                if ($ok) {
                    header('Location: index.php?action=connexion');
                    exit;
                } else {
                    $errors[] = "Erreur lors de l'inscription.";
                }
            }
            $departements = $this->depRepo->searchAll();
            require __DIR__ . '/../Vue/VueAccueil.php';
        }
    }

    public function connexion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->repo->signIn($_POST['mail'], $_POST['password']);
            if ($user != false) {
                $_SESSION['user'] = $user;
                $_SESSION['is_admin'] = $user['is_admin'];
                if ($user['is_admin']) {
                    header('Location: index.php?action=admin');
                } else {
                    header('Location: index.php?action=espace');
                }
                exit;
            }
        } else {
            require __DIR__ . '/../Vue/VueConnexion.php';
        }
    }
    public function deconnexion()
    {
        session_unset();
        session_destroy();
        header('Location: index.php?action=connexion');
        exit;
    }


    public function espacePerso()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=connexion');
            exit;
        }
        $user = $_SESSION['user'];
        require __DIR__ . '/../Vue/VueEspacePerso.php';
    }

    public function modifierCompte()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=connexion');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok = $this->repo->updateCandidate(
                $_POST['lastname'],
                $_POST['firstname'],
                $_POST['mail'],
                $_POST['password'] ?? null,
                (int)$_POST['departement'],
                (int)$_POST['age'],
                (int)$_SESSION['user']['id_user']
            );
            if ($ok) {
                // Mets à jour la session avec les nouvelles infos
                $_SESSION['user'] = $this->repo->getById((int)$_SESSION['user']['id_user']);
            }
            // Redirige vers l'espace perso après modification
            header('Location: index.php?action=espace');
            exit;
        }
    }

    public function supprimerCompte()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=connexion');
            exit;
        }
        $this->repo->deleteCandidate((int)$_SESSION['user']['id_user']); // Utilise bien id_user
        session_unset();
        session_destroy();
        header('Location: index.php?action=accueil');
        exit;
    }
    public function espaceAdmin()
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) {
            header('Location: index.php?action=connexion');
            exit;
        }
        $users = $this->repo->searchAll();
        require __DIR__ . '/../Vue/VueAdmin.php';
    }
    public function adminSupprimer()
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) {
            header('Location: index.php?action=connexion');
            exit;
        }
        $id = (int)($_GET['id'] ?? 0);
        if ($id && $id != $_SESSION['user']['id_user']) {
            $user = $this->repo->getById($id);
            if ($user && !$user['is_admin']) {
                $this->repo->deleteCandidate($id);
            }
        }
        header('Location: index.php?action=admin');
        exit;
    }
    public function adminModifier()
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) {
            header('Location: index.php?action=connexion');
            exit;
        }
        $id = (int)($_GET['id'] ?? 0);
        if (!$id) {
            header('Location: index.php?action=admin');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok = $this->repo->updateCandidate(
                $_POST['lastname'],
                $_POST['firstname'],
                $_POST['mail'],
                $_POST['password'] ?? null,
                (int)$_POST['departement'],
                (int)$_POST['age'],
                $id
            );
            header('Location: index.php?action=admin');
            exit;
        } else {
            $user = $this->repo->getById($id);
            $departements = $this->depRepo->searchAll();
            require __DIR__ . '/../Vue/VueAdminModifier.php';
        }
    }
}
