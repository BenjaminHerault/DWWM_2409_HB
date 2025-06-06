<?php

require_once __DIR__ . '/../Modele/Repository.php';

class ControleurResum
{
    private Repository $repo;

    public function __construct()
    {
        $this->repo = new Repository();
    }

    public function afficherTous()
    {
        $utilisateurs = $this->repo->searchAll();
        require __DIR__ . '/../Vue/vueListe.php';
    }

    public function creer($name, $mail, $password)
    {
        $this->repo->createCandidate($name, $mail, $password);
        header('Location: index.php?action=liste');
        exit;
    }

    public function modifier($id, $name, $mail, $password = null)
    {
        $this->repo->updateCandidate($id, $name, $mail, $password ?: null);
        header('Location: index.php?action=liste');
        exit;
    }

    public function supprimer($id)
    {
        $this->repo->deleteCandidate($id);
        header('Location: index.php?action=liste');
        exit;
    }
    public function connexion($mail = null, $password = null)
    {
        $message = '';
        if ($mail && $password) {
            $user = $this->repo->signIn($mail, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                header('Location: index.php?action=profil');
                exit;
            } else {
                $message = "Identifiants incorrects.";
            }
        }
        // Affiche toujours la vue de connexion si pas de POST ou si erreur
        require __DIR__ . '/../Vue/vueConnexion.php';
    }
    public function afficherProfil()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=connexion');
            exit;
        }
        $user = $_SESSION['user'];
        require __DIR__ . '/../Vue/vueProfil.php';
    }
    public function modifierProfil($name = null, $mail = null, $password = null)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=connexion');
            exit;
        }
        $user = $_SESSION['user'];
        $message = '';

        if ($name && $mail) {
            $this->repo->updateCandidate($user['id'], $name, $mail, $password ?: null);
            // Met à jour la session avec les nouvelles infos
            $user = $this->repo->signIn($mail, $password ?: $user['password']);
            $_SESSION['user'] = $user;
            header('Location: index.php?action=profil');
            exit;
        }
        require __DIR__ . '/../Vue/vueModifierProfil.php';
    }
}
