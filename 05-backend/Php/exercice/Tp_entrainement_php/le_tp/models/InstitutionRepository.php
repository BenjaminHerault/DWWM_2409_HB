<?php
require_once __DIR__ . "/Dbconnect.php";

class InstitutionRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Dbconnexion::getInstance();
    }

    public function searchAll(): array
    {
        $stmt = $this->db->query("SELECT identifiant, nom_etab, type_etab, nom_resp, adresse, mobile, email FROM institutions");
        return $stmt->fetchAll();
    }
}
