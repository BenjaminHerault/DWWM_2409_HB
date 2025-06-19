<?php
require_once __DIR__ . '/../models/ImmoRepository.php';
require_once __DIR__ . '/../models/DepartRepository.php';
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
        $lesDepartements = $this->depRepo->searchAll();
        $piecesDisponibles = $this->repo->getDistinctPieces();
        require __DIR__ . '/../Vue/vueListe_bien_immo.php';
    }

    public function afficherParPieces()
    {
        $nbPieces = isset($_GET['nbPieces']) ? (int)$_GET['nbPieces'] : null;
        $listDesBiens = [];
        if ($nbPieces !== null && $nbPieces !== '') {
            $listDesBiens = $this->repo->searchByPieces($nbPieces);
        }
        $lesDepartements = $this->depRepo->searchAll();
        $piecesDisponibles = $this->repo->getDistinctPieces();
        require __DIR__ . '/../Vue/vueListe_bien_immo.php';
    }
    public function ajouterImage($titre, $chemin, $alt, $ext): int
    {
        return $this->repo->insertImage($titre, $chemin, $alt, $ext);
    }
}
