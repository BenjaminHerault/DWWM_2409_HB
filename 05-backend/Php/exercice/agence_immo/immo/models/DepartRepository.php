<?php

require_once __DIR__ . '/Dbconnect.php';

class DepartRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Dbconnexion::getInstance();
    }
    public function searchAll(): array
    {
        $sql = "SELECT id_dep, nom_dep FROM departements WHERE dep_actif=1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
