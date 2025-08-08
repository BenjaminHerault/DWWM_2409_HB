<?php
require_once __DIR__ . '/../models/FormRepository.php';
require_once __DIR__ . '/../models/DepartRepository.php';


class FormControleur
{
    private $repo;
    private $departRepo;

    public function __construct()
    {
        // Initialisation des repositories
        $this->repo = new FormRepository();
        $this->departRepo = new DepartRepository();
    }

    public function afficherAccueil()
    {
        $departements = $this->departRepo->searchAll();
        require __DIR__ . '/../vue/VueAccueil.php';
    }
}
