<?php

require_once __DIR__ . '/Dbconnect.php';

class DepartRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Dbconnexion::getInstance();
    }
    // mieux car securisser 
    public function searchAll()
    {
        $sql = "SELECT id_dep, dep_nom FROM departements WHERE dep_actif = 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    /**
     * Récupère les départements disponibles
     *
     * @return array
     */
    public function getDepartementsDisponibles(): array
    {
        $sql = "SELECT DISTINCT d.id_dep, d.dep_nom
                FROM institutions i
                INNER JOIN departements d
                ON i.depart = d.id_dep
                WHERE d.dep_actif = 1
                ORDER BY d.dep_nom ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
