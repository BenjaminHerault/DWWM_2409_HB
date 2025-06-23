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
        $piecesDisponibles = $this->repo->getDistinctPieces();
        require __DIR__ . '/../Vue/vueListe_bien_immo.php';
    }

    public function lesFlitre()
    {
        $nbPieces = isset($_GET['nbPieces']) ? (int)$_GET['nbPieces'] : null;
        $idDep = isset($_GET['depList']) ? (int)$_GET['depList'] : null;
        $listDesBiens = [];
        $listDesDepart = [];
        if ($nbPieces !== null && $nbPieces !== '' || $idDep !== null && $idDep !== '') {
            $listDesBiens = $this->repo->searchByPieces($nbPieces);
            $listDesDepart = $this->repo->searchByDep($idDep);
        }
        $piecesDisponibles = $this->repo->getDistinctPieces();
        $depDisponibles = $this->repo->getDepartementsDisponibles();
        require __DIR__ . '/../Vue/vueListe_bien_immo.php';
    }



    public function ajouterImage($titre, $chemin, $alt, $ext): int
    {
        return $this->repo->insertImage($titre, $chemin, $alt, $ext);
    }
}
