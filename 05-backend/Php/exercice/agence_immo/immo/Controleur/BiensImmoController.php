<?php
require_once __DIR__ . '/../models/ImmoRepository.php';
require_once __DIR__ . '/../models/DepartRepository.php';
require_once __DIR__ . '/../models/NdpRepository.php';
class BiensImmoController
{
    private $repo;
    private $depRepo;
    private $piece;

    public function __construct()
    {
        $this->repo = new ImmoRepository();
        $this->depRepo = new DepartRepository();
        $this->piece = new NdpRepository();
    }

    public function afficherTous(): void
    {
        $listDesBiens = $this->repo->searchAll();
        $lesDepartements = $this->depRepo->searchAll();
        $nombreDePieces = $this->piece->searchAll();

        require __DIR__ . '/../Vue/vueListe_bien_immo.php';
    }
    public function ajouterImage($titre, $chemin, $alt, $ext): int
    {
        return $this->repo->insertImage($titre, $chemin, $alt, $ext);
    }
}
