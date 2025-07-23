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

            // === UTILISATION DE LA MÉTHODE CENTRALISÉE ===
            // On traite l'image avec notre méthode qui fait tout le travail
            $resultatTraitement = $this->traiterImage($file, './public/img_immo/');

            // === VÉRIFICATION DU RÉSULTAT ===
            if (!$resultatTraitement['success']) {
                // Si le traitement a échoué, on affiche l'erreur et on arrête
                $_SESSION['error'] = $resultatTraitement['error'];
                header("Location: index.php?action=images&id_bien=$idBien");
                exit;
            }

            // === ENREGISTREMENT DE LA NOUVELLE IMAGE ===
            // Extraction de l'extension pour la base de données
            $extension = pathinfo($resultatTraitement['vignette'], PATHINFO_EXTENSION);

            // Créer l'entrée image dans la base (on stocke la vignette optimisée)
            $titre = 'Image principale - ' . date('Y-m-d H:i:s');
            $alt = 'Image principale du bien';
            $idImage = $this->imgRepo->insertImage($titre, $resultatTraitement['vignette'], $alt, $extension);

            // Mettre toutes les images existantes en secondaires
            $this->imgRepo->setAllSecondaires($idBien);

            // Créer l'association comme image principale (1 = principale)
            $this->imgRepo->createAssociation($idBien, $idImage, 1);

            $_SESSION['success'] = "Image principale modifiée avec succès.";
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

                // === SUPPRESSION DE LA VIGNETTE ASSOCIÉE ===
                // Si l'image stockée est une vignette (commence par "vignette_"), 
                // on supprime aussi l'original
                $cheminImage = $image['chemin_image'];
                if (strpos(basename($cheminImage), 'vignette_') === 0) {
                    // L'image stockée est une vignette, supprimer l'original
                    $cheminOriginal = str_replace('/vignette_', '/', $cheminImage);
                    if (file_exists($cheminOriginal)) {
                        unlink($cheminOriginal);
                    }
                } else {
                    // L'image stockée est l'original, supprimer la vignette
                    $cheminVignette = dirname($cheminImage) . '/vignette_' . basename($cheminImage);
                    if (file_exists($cheminVignette)) {
                        unlink($cheminVignette);
                    }
                }
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

            // === UTILISATION DE LA MÉTHODE CENTRALISÉE ===
            // On traite l'image avec notre méthode qui fait tout le travail
            $resultatTraitement = $this->traiterImage($file, './public/img_immo/');

            // === VÉRIFICATION DU RÉSULTAT ===
            if (!$resultatTraitement['success']) {
                // Si le traitement a échoué, on affiche l'erreur et on arrête
                $_SESSION['error'] = $resultatTraitement['error'];
                header("Location: index.php?action=images&id_bien=$idBien");
                exit;
            }

            // === ENREGISTREMENT DE LA NOUVELLE IMAGE ===
            // Extraction de l'extension pour la base de données
            $extension = pathinfo($resultatTraitement['vignette'], PATHINFO_EXTENSION);

            // Créer l'entrée image dans la base (on stocke la vignette optimisée)
            $titre = 'Image secondaire - ' . date('Y-m-d H:i:s');
            $alt = 'Image secondaire du bien';
            $idImage = $this->imgRepo->insertImage($titre, $resultatTraitement['vignette'], $alt, $extension);

            // Créer l'association comme image secondaire (0 = secondaire)
            $this->imgRepo->createAssociation($idBien, $idImage, 0);

            $_SESSION['success'] = "Image secondaire ajoutée avec succès.";
        }

        header("Location: index.php?action=images&id_bien=$idBien");
        exit;
    }
    /**
     * Traite et redimensionne une image uploadée
     * Cette méthode fait tout le travail de traitement d'image en une seule fois
     * @param array $file Le fichier de $_FILES (ex: $_FILES['mon_input'])
     * @param string $destination Le dossier où sauver l'image (ex: './public/img_immo/')
     * @param int $largeurMax La largeur maximum pour la vignette (par défaut 300px)
     * @return array Un tableau avec le résultat : ['success' => true/false, 'original' => chemin, 'vignette' => chemin, 'error' => message]
     */
    private function traiterImage(array $file, string $destination, int $largeurMax = 300): array
    {
        // === ÉTAPE 1 : INITIALISATION DU RÉSULTAT ===
        // On prépare un tableau qui contiendra le résultat de notre traitement
        $result = [
            'success' => false,        // Est-ce que tout s'est bien passé ?
            'original' => '',          // Chemin vers l'image originale
            'vignette' => '',          // Chemin vers l'image redimensionnée
            'error' => ''              // Message d'erreur si problème
        ];

        // === ÉTAPE 2 : VALIDATION DU TYPE DE FICHIER ===
        // On vérifie que c'est bien une image (sécurité importante !)
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            $result['error'] = "Type de fichier non autorisé. Utilisez JPG, PNG ou GIF.";
            return $result; // On arrête tout et on retourne l'erreur
        }

        // === ÉTAPE 3 : EXTRACTION DE L'EXTENSION ===
        // Le type MIME est comme "image/jpeg", on veut juste "jpeg"
        $typeParts = explode('/', $file['type']); // Découpe "image/jpeg" en ["image", "jpeg"]
        $extension = $typeParts[1];               // On prend la deuxième partie : "jpeg"

        // === ÉTAPE 4 : NORMALISATION DE L'EXTENSION ===
        // On veut toujours "jpg" au lieu de "jpeg" pour simplifier
        if ($extension === 'jpeg') {
            $extension = 'jpg';
        }

        // === ÉTAPE 5 : GÉNÉRATION D'UN NOM UNIQUE ===
        // uniqid() génère un identifiant unique pour éviter les doublons
        $newName = 'photo' . uniqid() . '.' . $extension;
        $cheminOriginal = $destination . $newName; // Ex: './public/img_immo/photo507f1f77bcf86cd799439011.jpg'

        // === ÉTAPE 6 : UPLOAD DU FICHIER ORIGINAL ===
        // On déplace le fichier temporaire vers sa destination finale
        if (!move_uploaded_file($file['tmp_name'], $cheminOriginal)) {
            $result['error'] = "Erreur lors du téléchargement de l'image.";
            return $result; // Échec de l'upload, on arrête
        }

        // === ÉTAPE 7 : TRAITEMENT DE L'IMAGE (avec gestion d'erreurs) ===
        try {
            // === SOUS-ÉTAPE 7.1 : LECTURE DES DIMENSIONS ORIGINALES ===
            // getimagesize() nous donne la largeur et hauteur de l'image
            $dimensionsOriginales = getimagesize($cheminOriginal);
            if (!$dimensionsOriginales) {
                $result['error'] = "Impossible de lire les dimensions de l'image.";
                return $result;
            }

            $largeurOriginale = $dimensionsOriginales[0]; // Largeur en pixels
            $hauteurOriginale = $dimensionsOriginales[1]; // Hauteur en pixels

            // === SOUS-ÉTAPE 7.2 : CALCUL DES NOUVELLES DIMENSIONS ===
            // On garde les proportions ! Si l'image fait 800x600 et qu'on veut 300px de large :
            // Nouvelle hauteur = 300 * 600 / 800 = 225px
            $vignetteLargeur = min($largeurMax, $largeurOriginale); // Ne pas agrandir si l'image est plus petite
            $vignetteHauteur = round($vignetteLargeur * $hauteurOriginale / $largeurOriginale, 0);

            // === SOUS-ÉTAPE 7.3 : CHEMIN DE LA VIGNETTE ===
            // Ex: './public/img_immo/vignette_photo507f1f77bcf86cd799439011.jpg'
            $cheminVignette = $destination . 'vignette_' . $newName;

            // === SOUS-ÉTAPE 7.4 : CRÉATION D'UNE IMAGE VIERGE ===
            // imagecreatetruecolor() crée une "toile" vierge de la taille qu'on veut
            $imageVignette = imagecreatetruecolor($vignetteLargeur, $vignetteHauteur);

            // === SOUS-ÉTAPE 7.5 : GESTION DE LA TRANSPARENCE ===
            // Pour PNG et GIF, on veut préserver la transparence
            if ($extension === 'png' || $extension === 'gif') {
                imagealphablending($imageVignette, false);                    // Désactive le mélange de couleurs
                imagesavealpha($imageVignette, true);                        // Active la sauvegarde de la transparence
                $transparent = imagecolorallocatealpha($imageVignette, 255, 255, 255, 127); // Crée une couleur transparente
                imagefill($imageVignette, 0, 0, $transparent);               // Remplit l'image de transparent
            }

            // === SOUS-ÉTAPE 7.6 : CHARGEMENT DE L'IMAGE SOURCE ===
            // On charge l'image originale en mémoire selon son type
            $imageSource = null;
            switch ($extension) {
                case 'jpg':
                    $imageSource = imagecreatefromjpeg($cheminOriginal); // Charge un JPEG
                    break;
                case 'png':
                    $imageSource = imagecreatefrompng($cheminOriginal);  // Charge un PNG
                    break;
                case 'gif':
                    $imageSource = imagecreatefromgif($cheminOriginal);  // Charge un GIF
                    break;
            }

            // Vérification que le chargement a marché
            if (!$imageSource) {
                $result['error'] = "Impossible de traiter l'image.";
                return $result;
            }

            // === SOUS-ÉTAPE 7.7 : REDIMENSIONNEMENT AVEC HAUTE QUALITÉ ===
            // imagecopyresampled() fait un redimensionnement de haute qualité
            // Les paramètres : (destination, source, x_dest, y_dest, x_source, y_source, largeur_dest, hauteur_dest, largeur_source, hauteur_source)
            imagecopyresampled(
                $imageVignette,      // L'image de destination (notre vignette)
                $imageSource,        // L'image source (l'originale)
                0,
                0,               // On commence à copier au point (0,0) de la destination
                0,
                0,               // On commence à lire au point (0,0) de la source
                $vignetteLargeur,   // Largeur de destination
                $vignetteHauteur,   // Hauteur de destination
                $largeurOriginale,  // Largeur de source (toute l'image)
                $hauteurOriginale   // Hauteur de source (toute l'image)
            );

            // === SOUS-ÉTAPE 7.8 : SAUVEGARDE DE LA VIGNETTE ===
            // On sauvegarde selon le type, avec optimisation de qualité
            $saveSuccess = false;
            switch ($extension) {
                case 'jpg':
                    $saveSuccess = imagejpeg($imageVignette, $cheminVignette, 85); // Qualité 85% (bon compromis)
                    break;
                case 'png':
                    $saveSuccess = imagepng($imageVignette, $cheminVignette, 6);   // Compression niveau 6
                    break;
                case 'gif':
                    $saveSuccess = imagegif($imageVignette, $cheminVignette);      // GIF sans compression
                    break;
            }

            // === SOUS-ÉTAPE 7.9 : LIBÉRATION DE LA MÉMOIRE ===
            // IMPORTANT : libérer la mémoire pour éviter les fuites
            imagedestroy($imageSource);  // Supprime l'image source de la mémoire
            imagedestroy($imageVignette); // Supprime l'image vignette de la mémoire

            // === ÉTAPE 8 : RÉSULTAT FINAL ===
            if ($saveSuccess) {
                // Tout s'est bien passé !
                $result['success'] = true;
                $result['original'] = $cheminOriginal;  // Chemin vers l'image complète
                $result['vignette'] = $cheminVignette;  // Chemin vers l'image optimisée
            } else {
                $result['error'] = "Erreur lors de la création de la vignette.";
            }
        } catch (Exception $e) {
            // === GESTION D'ERREURS GÉNÉRALES ===
            // Si quelque chose se passe mal, on capture l'erreur
            $result['error'] = "Erreur lors du traitement de l'image : " . $e->getMessage();
        }

        // On retourne le résultat (succès ou échec)
        return $result;
    }

    /**
     * MÉTHODE UTILITAIRE : Migrer les anciennes images vers le nouveau système
     * 
     * Cette méthode parcourt toutes les images existantes et crée leurs vignettes
     * si elles n'existent pas déjà. Utile pour migrer un site existant.
     */
    public function migrerAnciennesImages()
    {
        // === RÉCUPÉRATION DE TOUTES LES IMAGES ===
        $toutesLesImages = $this->imgRepo->getAllImages(); // Vous devrez créer cette méthode
        $nbTraitees = 0;
        $nbErreurs = 0;

        foreach ($toutesLesImages as $image) {
            $cheminOriginal = $image['chemin_image'];

            // Vérifier si l'image originale existe
            if (!file_exists($cheminOriginal)) {
                continue; // Passer à l'image suivante si le fichier n'existe pas
            }

            // Vérifier si ce n'est pas déjà une vignette
            if (strpos(basename($cheminOriginal), 'vignette_') === 0) {
                continue; // C'est déjà une vignette, on passe
            }

            // Calculer le chemin de la vignette
            $cheminVignette = dirname($cheminOriginal) . '/vignette_' . basename($cheminOriginal);

            // Si la vignette existe déjà, on passe
            if (file_exists($cheminVignette)) {
                continue;
            }

            // === CRÉATION DE LA VIGNETTE ===
            try {
                // Simuler un fichier $_FILES pour utiliser traiterImage()
                $fakeFile = [
                    'tmp_name' => $cheminOriginal,
                    'type' => mime_content_type($cheminOriginal),
                    'size' => filesize($cheminOriginal),
                    'name' => basename($cheminOriginal)
                ];

                // Copier l'original vers un fichier temporaire
                $tempFile = $cheminOriginal . '_temp';
                copy($cheminOriginal, $tempFile);
                $fakeFile['tmp_name'] = $tempFile;

                // Traiter l'image
                $resultat = $this->traiterImage($fakeFile, './public/img_immo/');

                // Nettoyer le fichier temporaire
                if (file_exists($tempFile)) {
                    unlink($tempFile);
                }

                if ($resultat['success']) {
                    // Mettre à jour la base pour pointer vers la vignette
                    $this->imgRepo->updateImagePath($image['id'], $resultat['vignette']);
                    $nbTraitees++;
                } else {
                    $nbErreurs++;
                    error_log("Erreur migration image {$image['id']}: " . $resultat['error']);
                }
            } catch (Exception $e) {
                $nbErreurs++;
                error_log("Exception migration image {$image['id']}: " . $e->getMessage());
            }
        }

        $_SESSION['success'] = "Migration terminée : $nbTraitees images traitées, $nbErreurs erreurs.";
        header("Location: index.php?action=admin"); // Rediriger vers une page admin
        exit;
    }
}
