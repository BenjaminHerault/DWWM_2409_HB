<?php

require_once __DIR__ . '/../models/ImmoRepository.php';

class BiensImmoController
{
    private ImmoRepository $repo;

    public function __construct()
    {
        $this->repo = new ImmoRepository();
    }

    public function afficherTous(): void
    {
        $biens = $this->repo->searchAll();
        require __DIR__ . '/../Vue/vueListe_bien_immo.php';
    }
}
