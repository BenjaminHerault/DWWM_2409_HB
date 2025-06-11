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
        require __DIR__ . '/../Vue/accueil.php';
    }

    public function inscription()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérification des champs
            $errors = [];
            if ($_POST['password'] !== $_POST['password2']) {
                $errors[] = "Les mots de passe ne correspondent pas.";
            }
            // Tu peux ajouter d'autres vérifications ici

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
            require __DIR__ . '/../Vue/accueil.php';
        }
    }

    public function connexion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->repo->signIn($_POST['mail'], $_POST['password']);
            if ($user) {
                $_SESSION['user'] = $user;
                header('Location: index.php?action=espace');
                exit;
            } else {
                $error = "Identifiants incorrects.";
                require __DIR__ . '/../Vue/connexion.php';
            }
        } else {
            require __DIR__ . '/../Vue/connexion.php';
        }
    }

    public function espacePerso()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=connexion');
            exit;
        }
        $user = $_SESSION['user'];
        require __DIR__ . '/../Vue/espace.php';
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
                // Met à jour la session
                $_SESSION['user']['nom'] = $_POST['lastname'];
                $_SESSION['user']['prenom'] = $_POST['firstname'];
                $_SESSION['user']['email'] = $_POST['mail'];
                $_SESSION['user']['departement'] = $_POST['departement'];
                $_SESSION['user']['age'] = $_POST['age'];
                $message = "Compte modifié avec succès.";
            } else {
                $message = "Erreur lors de la modification.";
            }
        }
        $user = $_SESSION['user'];
        $departements = $this->depRepo->searchAll();
        require __DIR__ . '/../Vue/modifier.php';
    }

    public function supprimerCompte()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=connexion');
            exit;
        }
        $this->repo->deleteCandidate((int)$_SESSION['user']['id_user']);
        session_destroy();
        header('Location: index.php?action=accueil');
        exit;
    }
}
