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
    public function getDepartementsDisponibles(): array
    {
        $sql = "SELECT DISTINCT d.id_dep, d.nom_dep
                FROM biens_immobiliers b
                INNER JOIN departements d ON b.num_departement = d.id_dep
                WHERE d.dep_actif = 1
                ORDER BY d.nom_dep ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
