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
        $biens = $this->repo->searchAll();
        $departements = $this->depRepo->searchAll();
        require __DIR__ . '/../Vue/vueListe_bien_immo.php';
    }
    public function ajouterImage($titre, $chemin, $alt, $ext): int
    {
        return $this->repo->insertImage($titre, $chemin, $alt, $ext);
    }
}
