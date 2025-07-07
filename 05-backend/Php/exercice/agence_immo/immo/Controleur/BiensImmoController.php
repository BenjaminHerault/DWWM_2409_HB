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

    public function lesFlitre()
    {
        // On récupère le nombre de pièces depuis le formulaire (GET), ou null si non renseigné
        $nbPieces = isset($_GET['nbPieces']) && $_GET['nbPieces'] !== '' ? (int)$_GET['nbPieces'] : null;

        // On récupère le département depuis le formulaire (GET), ou null si non renseigné
        $idDep = isset($_GET['depList']) && $_GET['depList'] !== '' ? (int)$_GET['depList'] : null;

        // On récupère le prix maximum depuis le formulaire (GET), ou null si non renseigné
        $prixMax = isset($_GET['prixMax']) && $_GET['prixMax'] !== '' ? (int)$_GET['prixMax'] : null;

        // On effectue la recherche des biens immobiliers en fonction des filtres sélectionnés
        // (département et/ou nombre de pièces)
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
            // echo $type;
            $tab_ref = ['gif', 'png', 'jpg', 'JPG', 'jpeg', 'JPEG', 'GIF', 'PNG'];
            $tab_split = explode('/', $type);
            $extension = $tab_split[1];
            if (in_array($extension, $tab_ref)) {
                $name = $_FILES['img']['name'];
                $origine = $_FILES['img']['tmp_name'];
                $img_path = './public/img_biens/';
                $newName = 'photo' . uniqid() . '.' . $extension;     //uniqid() pour générer un nom unique
                $destination = $img_path . $newName;
                if (move_uploaded_file($origine, $destination) == true) {
                    $tab_dim = getimagesize($destination);
                    $largeur = $tab_dim[0];
                    $hauteur = $tab_dim[1];
                    $vignette_largeur = 300; //pixels
                    $vignette_hauteur = round($vignette_largeur * $hauteur / $largeur, 0); // Calcul de la hauteur de la vignette en gardant les proportions
                    $vignette_emplacement = "./public/img_immo/vignette_" . $newName;
                    $image = imagecreatetruecolor($vignette_largeur, $vignette_hauteur);
                    switch ($extension) {
                        case 'jpg':
                        case 'jpeg':
                            $source = imagecreatefromjpeg($destination);
                            break;
                        case 'png':
                            $source = imagecreatefrompng($destination);
                            break;
                        case 'gif':
                            $source = imagecreatefromgif($destination);
                            break;
                        default:
                            $source = null;
                    }
                    imagecopyresampled($image, $source, 0, 0, 0, 0, $vignette_largeur, $vignette_hauteur, $largeur, $hauteur);
                    switch ($extension) {
                        case 'jpg':
                        case 'jpeg':
                            imagejpeg($image, $vignette_emplacement);
                            break;
                        case 'png':
                            imagepng($image, $vignette_emplacement);
                            break;
                        case 'gif':
                            imagegif($image, $vignette_emplacement);
                            break;
                    }
                } else {
                    echo 'Erreur';
                }
            }
        }
        require_once __DIR__ . '/../Vue/vueMaj_bien.php';
    }
    public function espaceAdmin()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['id_niveau'] != 1) {
            require __DIR__ . '/../Vue/vueAccesRefuse.php';
            return;
        }
        $users = $this->repo->searchAll();
        require __DIR__ . '/../Vue/vueEspaceAdmin.php';
    }
    public function connexion(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->userRepo->authenticateUtilisateur($_POST['mail'], $_POST['pwd']);
            if ($user != false) {
                $_SESSION['user'] = $user;
                // Affichage direct de la vue correspondante selon le niveau
                if ($user['id_niveau'] == 1) {
                    // SuperAdmin : espace admin
                    $users = $this->repo->searchAll();
                    require __DIR__ . '/../Vue/vueEspaceAdmin.php';
                } else {
                    // Autres niveaux : liste des biens
                    $this->afficherTous();
                }
            } else {
                // Authentification échouée, on peut afficher un message d'erreur
                $error = "Identifiant ou mot de passe incorrect.";
                echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
            }
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
