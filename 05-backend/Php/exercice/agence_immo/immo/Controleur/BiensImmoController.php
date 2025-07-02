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

    public function afficherTous(): void
    {
        $listDesBiens = $this->repo->searchAll();
        $piecesDisponibles = $this->repo->getDistinctPieces();
        $depDisponibles = $this->depRepo->getDepartementsDisponibles();
        require __DIR__ . '/../Vue/vueListe_bien_immo.php';
    }

    /**
     * Applique les filtres de recherche avec paramètres validés
     * @param int|null $idDep ID du département (optionnel)
     * @param int|null $nbPieces Nombre de pièces (optionnel)
     * @param int|null $prixMax Prix maximum (optionnel)
     */
    public function lesFlitre(?int $idDep = null, ?int $nbPieces = null, ?int $prixMax = null)
    {
        // Si aucun paramètre n'est fourni, on récupère depuis $_GET (pour compatibilité)
        if ($idDep === null && $nbPieces === null && $prixMax === null) {
            $nbPieces = isset($_GET['nbPieces']) && $_GET['nbPieces'] !== '' ? (int)$_GET['nbPieces'] : null;
            $idDep = isset($_GET['depList']) && $_GET['depList'] !== '' ? (int)$_GET['depList'] : null;
            $prixMax = isset($_GET['prixMax']) && $_GET['prixMax'] !== '' ? (int)$_GET['prixMax'] : null;
        }

        // On effectue la recherche des biens immobiliers en fonction des filtres sélectionnés
        $listDesBiens = $this->repo->leFlitre($idDep, $nbPieces, $prixMax);

        // On récupère la liste des nombres de pièces distincts pour alimenter la liste déroulante du formulaire
        $piecesDisponibles = $this->repo->getDistinctPieces();

        // On récupère la liste des départements disponibles pour alimenter la liste déroulante du formulaire
        $depDisponibles = $this->depRepo->getDepartementsDisponibles();

        // On inclut la vue qui affichera le formulaire et la liste des biens filtrés
        require __DIR__ . '/../Vue/vueListe_bien_immo.php';
    }
    public function detailBien($idBien): void
    {
        $detail = $this->repo->getBienById($idBien);
        require __DIR__ . '/../Vue/vueDetailBien.php';
    }


    public function ajouterImage($titre, $chemin, $alt, $ext): int
    {
        return $this->imgRepo->insertImage($titre, $chemin, $alt, $ext);
    }


    public function miseAJour(): void
    {
        $id = $_GET['id_bien'];
        if (isset($_FILES['img'])) {
            $type = $_FILES['img']['type'];
            echo $type;
            $tab_ref = ['gif', 'png', 'jpg', 'JPG', 'jpeg', 'JPEG'];
            $tab_split = explode('/', $type);
            $extension = $tab_split[1];
            if (in_array($extension, $tab_ref)) {
                $name = $_FILES['img']['name'];
                $origine = $_FILES['img']['tmp_name'];
                $img_path = './public/img_immo/';
                $newName = 'bien';
                $destination = $img_path . $newName . '.' . $extension;
                if (move_uploaded_file($origine, $destination) == true) {
                    echo 'image transféré ! ! !';
                } else {
                    echo 'Erreur';
                }
            }
        }
        require_once __DIR__ . '/../Vue/vueMaj_bien.php';
    }
    public function espaceAdmin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rien;
        }

        if (isset($_SESSION['user']) && $_SESSION['user']['id_niveau'] == 1) {
            $rien;
        } else {
            $rien;
        }
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
