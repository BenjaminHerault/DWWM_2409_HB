<?php

require_once __DIR__ . "/Dbconnect.php";

class DepartRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Dbconnexion::getInstance();
    }

    public function searchAll()
    {
        $sql = "SELECT id_dep, Name FROM departements WHERE dep_actif = 1";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
