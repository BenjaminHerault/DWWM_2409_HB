<?php

require_once __DIR__ . '/Dbconnect.php';

class DepartRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Dbconnexion::getInstance();
    }

    // pas conseil
    // public function searchAll()
    // {
    //     $sql = "SELECT id_dep, Name AS name FROM departements WHERE dep_actif = 1";
    //     $stmt = $this->db->query($sql);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }


    // mieux car securisser 
    public function searchAll()
    {
        $sql = "SELECT id_dep, Name AS name FROM departements WHERE dep_actif = 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
