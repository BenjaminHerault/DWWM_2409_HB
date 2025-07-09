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
        require_once __DIR__ . '/../Vue/vueGestionImages.php';
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
    public function gestionImages($idBien)
    {
        // 1. Récupérer le bien
        $bien = $this->repo->getBienById($idBien);
        // 2. Récupérer toutes les images du bien (table association_img + images)
        $images = $this->imgRepo->getImagesByBienId($idBien);
        // 3. Séparer image principale et secondaires
        $imagePrincipale = null;
        $imagesSecondaires = [];
        foreach ($images as $img) {
            if (!empty($img['img_ppal']) && $img['img_ppal'] == 1) {
                $imagePrincipale = $img;
            } else {
                $imagesSecondaires[] = $img;
            }
        }
        require __DIR__ . '/../Vue/vueGestionImages.php';
    }

    public function changerImagePrincipale($idBien)
    {
        if (isset($_FILES['nouvelle_image_principale']) && $_FILES['nouvelle_image_principale']['error'] === 0) {
            $file = $_FILES['nouvelle_image_principale'];

            // Validation du type de fichier
            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!in_array($file['type'], $allowedTypes)) {
                $_SESSION['error'] = "Type de fichier non autorisé. Utilisez JPG, PNG ou GIF.";
                header("Location: index.php?action=images&id_bien=$idBien");
                exit;
            }

            // Création du nom unique
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newName = 'photo' . uniqid() . '.' . $extension;
            $destination = './public/img_immo/' . $newName;

            // Upload du fichier
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                // Créer l'entrée en base
                $titre = 'Image principale - ' . date('Y-m-d H:i:s');
                $alt = 'Image principale du bien';
                $idImage = $this->imgRepo->insertImage($titre, $destination, $alt, $extension);

                // Mettre toutes les images en secondaires
                $this->imgRepo->setAllSecondaires($idBien);

                // Créer l'association et définir comme principale
                $this->imgRepo->createAssociation($idBien, $idImage, 1);

                $_SESSION['success'] = "Image principale modifiée avec succès.";
            } else {
                $_SESSION['error'] = "Erreur lors du téléchargement de l'image.";
            }
        }

        header("Location: index.php?action=images&id_bien=$idBien");
        exit;
    }

    public function promouvoirImage($idBien, $idImage)
    {
        // Mettre toutes les images en secondaires
        $this->imgRepo->setAllSecondaires($idBien);

        // Définir l'image sélectionnée comme principale
        $this->imgRepo->setPrincipale($idBien, $idImage);

        $_SESSION['success'] = "Image définie comme principale.";
        header("Location: index.php?action=images&id_bien=$idBien");
        exit;
    }

    public function supprimerImage($idBien, $idImage)
    {
        // Récupérer le chemin de l'image avant de la supprimer
        $image = $this->imgRepo->getImageById($idImage);

        // Supprimer l'image de la base
        if ($this->imgRepo->deleteImage($idImage)) {
            // Supprimer le fichier physique si l'image existe
            if ($image && file_exists($image['chemin_image'])) {
                unlink($image['chemin_image']);
            }
            $_SESSION['success'] = "Image supprimée avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors de la suppression de l'image.";
        }

        header("Location: index.php?action=images&id_bien=$idBien");
        exit;
    }

    public function ajouterImageSecondaire($idBien)
    {
        if (isset($_FILES['ajout_image_secondaire']) && $_FILES['ajout_image_secondaire']['error'] === 0) {
            $file = $_FILES['ajout_image_secondaire'];

            // Validation du type de fichier
            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!in_array($file['type'], $allowedTypes)) {
                $_SESSION['error'] = "Type de fichier non autorisé. Utilisez JPG, PNG ou GIF.";
                header("Location: index.php?action=images&id_bien=$idBien");
                exit;
            }

            // Création du nom unique
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newName = 'photo' . uniqid() . '.' . $extension;
            $destination = './public/img_immo/' . $newName;

            // Upload du fichier
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                // Créer l'entrée en base
                $titre = 'Image secondaire - ' . date('Y-m-d H:i:s');
                $alt = 'Image secondaire du bien';
                $idImage = $this->imgRepo->insertImage($titre, $destination, $alt, $extension);

                // Créer l'association comme image secondaire
                $this->imgRepo->createAssociation($idBien, $idImage, 0);

                $_SESSION['success'] = "Image secondaire ajoutée avec succès.";
            } else {
                $_SESSION['error'] = "Erreur lors du téléchargement de l'image.";
            }
        }

        header("Location: index.php?action=images&id_bien=$idBien");
        exit;
    }
}
