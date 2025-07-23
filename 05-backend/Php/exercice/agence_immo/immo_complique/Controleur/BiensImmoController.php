<?php
require_once __DIR__ . '/../models/ImmoRepository.php';
require_once __DIR__ . '/../models/DepartRepository.php';
require_once __DIR__ .  '/../models/ImageRepository.php';
require_once __DIR__ . '/../models/UserRepository.php';

class BiensImmoController
{
    private $repo;
    private $depRepo;
    private $imgRepo;
    private $userRepo;

    public function __construct()
    {
        $this->repo = new ImmoRepository();
        $this->depRepo = new DepartRepository();
        $this->imgRepo = new ImageRepository();
        $this->userRepo = new UserRepository();
    }

    public function afficherTous(): array
    {
        $listDesBiens = $this->repo->searchAll();
        $piecesDisponibles = $this->repo->getDistinctPieces();
        $depDisponibles = $this->depRepo->getDepartementsDisponibles();
        return [
            'listDesBiens' => $listDesBiens,
            'piecesDisponibles' => $piecesDisponibles,
            'depDisponibles' => $depDisponibles
        ];
    }

    /**
     * Applique les filtres de recherche avec paramètres validés
     * @param int|null $idDep ID du département (optionnel)
     * @param int|null $nbPieces Nombre de pièces (optionnel)
     * @param int|null $prixMax Prix maximum (optionnel)
     */
    public function lesFlitre(?int $idDep = null, ?int $nbPieces = null, ?int $prixMax = null): array
    {
        if ($idDep === null && $nbPieces === null && $prixMax === null) {
            $nbPieces = isset($_GET['nbPieces']) && $_GET['nbPieces'] !== '' ? (int)$_GET['nbPieces'] : null;
            $idDep = isset($_GET['depList']) && $_GET['depList'] !== '' ? (int)$_GET['depList'] : null;
            $prixMax = isset($_GET['prixMax']) && $_GET['prixMax'] !== '' ? (int)$_GET['prixMax'] : null;
        }
        $listDesBiens = $this->repo->leFlitre($idDep, $nbPieces, $prixMax);
        $piecesDisponibles = $this->repo->getDistinctPieces();
        $depDisponibles = $this->depRepo->getDepartementsDisponibles();
        return [
            'listDesBiens' => $listDesBiens,
            'piecesDisponibles' => $piecesDisponibles,
            'depDisponibles' => $depDisponibles
        ];
    }
    public function detailBien($idBien): array
    {
        $detail = $this->repo->getBienById($idBien);
        return ['detail' => $detail];
    }


    public function ajouterImage($titre, $chemin, $alt, $ext): int
    {
        return $this->imgRepo->insertImage($titre, $chemin, $alt, $ext);
    }


    public function miseAJour(): array
    {
        $id = $_GET['id_bien'];
        $erreur = '';
        $message = '';
        if (isset($_FILES['img'])) {
            $type = $_FILES['img']['type'];
            $tab_ref = ['gif', 'png', 'jpg', 'JPG', 'jpeg', 'JPEG'];
            $tab_split = explode('/', $type);
            $extension = $tab_split[1] ?? '';
            if (in_array($extension, $tab_ref)) {
                $name = $_FILES['img']['name'];
                $origine = $_FILES['img']['tmp_name'];
                $img_path = './public/img_immo/';
                $newName = 'bien';
                $destination = $img_path . $newName . '.' . $extension;
                if (move_uploaded_file($origine, $destination) == true) {
                    $message = 'Image transférée !';
                } else {
                    $erreur = 'Erreur lors du transfert de l\'image.';
                }
            } else {
                $erreur = 'Format de fichier non autorisé.';
            }
        }
        return ['erreur' => $erreur, 'message' => $message];
    }
    public function espaceAdmin(): array
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['id_niveau'] != 1) {
            header('Location: index.php?action=connexion');
            exit;
        }
        $users = $this->repo->searchAll();
        return ['users' => $users];
    }


    public function aFaire()
    {
        // Dans ton contrôleur d'inscription
        // if ($this->userRepo->emailExists($email)) {
        //     $error = "Cet email est déjà utilisé !";
        // } else {
        //     // OK, on peut créer le compte
        //     $this->userRepo->createUtilisateurs($nom, $prenom, $email, $password);
        // }
    }
}
