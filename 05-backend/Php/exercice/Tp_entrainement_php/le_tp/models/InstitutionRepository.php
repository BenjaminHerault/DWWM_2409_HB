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

    /**
     * Recherche des institutions avec filtres
     * @param int|null $departementId ID du département (optionnel)
     * @param array $types Types d'établissements (optionnel)
     * @return array
     */

    public function searchWithFilters(?int $departementId = null, array $types = []): array
    {
        $sql = "SELECT i.identifiant, i.nom_etab, i.type_etab, i.nom_resp, i.adresse, i.mobile, i.email
            FROM institutions i";

        $conditions = [];
        $params = [];

        // Filtre par département si spécifié
        if ($departementId !== null) {
            $conditions[] = "i.depart = :dept_id";
            $params['dept_id'] = $departementId;
        }

        // Filtre par types d'établissements si spécifiés
        if (!empty($types)) {
            $placeholders = [];
            foreach ($types as $index => $type) {
                $placeholder = ":type_" . $index;
                $placeholders[] = $placeholder;
                $params[$placeholder] = $type;
            }
            $conditions[] = "i.type_etab IN (" . implode(', ', $placeholders) . ")";
        }

        // Ajout des conditions WHERE si nécessaire
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }

        $sql .= " ORDER BY i.nom_etab ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
