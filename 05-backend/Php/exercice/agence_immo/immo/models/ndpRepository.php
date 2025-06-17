<?php

require_once __DIR__ . 'Dbconnect.php';

class NdpRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Dbconnexion::getInstance();
    }

    public function searchAll(): array
    {
        $sql = "SELECT id, nbr_pieces FROM biens_immobiliers";
        $stml = $this->db->prepare($sql);
        $stml->execute();
        return $stml->fetchAll();
    }
}
