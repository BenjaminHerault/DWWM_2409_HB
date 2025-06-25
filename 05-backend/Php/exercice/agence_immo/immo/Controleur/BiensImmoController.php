<?php
require_once __DIR__ . '/../models/ImmoRepository.php';
require_once __DIR__ . '/../models/DepartRepository.php';
require_once __DIR__ . '/../models/ImagesRepository.php';
class BiensImmoController
{
    private $repo;
    private $depRepo;

    public function __construct()
    {
        $this->repo = new ImmoRepository();
        $this->depRepo = new DepartRepository();
    }

    public function afficherTous(): void
    {
        $listDesBiens = $this->repo->searchAll();
        $piecesDisponibles = $this->repo->getDistinctPieces();
        $depDisponibles = $this->repo->getDepartementsDisponibles();
        require __DIR__ . '/../Vue/vueListe_bien_immo.php';
    }

    public function lesFlitre()
    {
        var_dump($_GET['depList']);
        // On récupère le nombre de pièces depuis le formulaire (GET), ou null si non renseigné
        $nbPieces = isset($_GET['nbPieces']) && $_GET['nbPieces'] !== '' ? (int)$_GET['nbPieces'] : null;

        // On récupère le département depuis le formulaire (GET), ou null si non renseigné
        $idDep = isset($_GET['depList']) && $_GET['depList'] !== '' ? (int)$_GET['depList'] : null;

        // On effectue la recherche des biens immobiliers en fonction des filtres sélectionnés
        // (département et/ou nombre de pièces)
        $listDesBiens = $this->repo->leFlitre($idDep, $nbPieces);

        // On récupère la liste des nombres de pièces distincts pour alimenter la liste déroulante du formulaire
        $piecesDisponibles = $this->repo->getDistinctPieces();

        // On récupère la liste des départements disponibles pour alimenter la liste déroulante du formulaire
        $depDisponibles = $this->repo->getDepartementsDisponibles();

        // On inclut la vue qui affichera le formulaire et la liste des biens filtrés
        require __DIR__ . '/../Vue/vueListe_bien_immo.php';
    }



    public function ajouterImage($titre, $chemin, $alt, $ext): int
    {
        return $this->repo->insertImage($titre, $chemin, $alt, $ext);
    }
    public function miseAJour(): void
    {

        $id = $_GET['id_bien'];
        if (isset($_FILES['img'])) {

            $type = $_FILES['img']['type'];
            echo $type;
        } else {
            echo 'form non activé';
        }

        require_once __DIR__ . '/../Vue/vueMaj_bien.php';
    }
}
