<?php

require_once __DIR__ . '/Dbconnect.php';

class ImmoRepository
{
    private PDO $db;

    /**
     * Constructeur : utilise la connexion partagée via Dbconnexion (singleton)
     */
    public function __construct()
    {
        $this->db = Dbconnexion::getInstance();
    }

    /**
     * Récupère tous les bien immobiliers de la table immo
     * @return array Tableau associatif de tous les bien immobiliers 
     */
    private function search($where = '', $params = []): array
    {
        $sql = "SELECT b.id, b.titre, b.nbr_pieces, b.surface, b.prix_vente, b.description, 
                   b.ges, b.classe_eco, b.meuble, b.localisation, b.num_departement, 
                   b.ville, b.charges_annuelles, b.id_utilisateur_commercial, 
                   b.id_categorie, b.id_proprietaire,
                   i.chemin_image, i.texte_alternatif
            FROM biens_immobiliers b
            INNER JOIN association_img ai ON ai.id = b.id AND ai.img_ppal = 1
            INNER JOIN images i ON i.id_image = ai.id_image";
        if ($where) {
            $sql .= " WHERE $where";
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insertImage($titre, $chemin, $alt, $ext): int
    {
        $sql = 'INSERT INTO images (titre_image, chemin_image, texte_alternatif, extension) 
                VALUES (:titre, :chemin, :alt, :ext)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':titre' => $titre,
            ':chemin' => $chemin,
            ':alt' => $alt,
            ':ext' => $ext
        ]);
        return $this->db->lastInsertId();
    }
    public function searchAll(): array
    {
        return $this->search();
    }
    public function searchByPieces(int $nbPieces): array
    {
        return $this->search('b.nbr_pieces = :pieces', [':pieces' => $nbPieces]);
    }

    public function getDistinctPieces(): array
    {
        $sql = "SELECT DISTINCT nbr_pieces FROM biens_immobiliers ORDER BY nbr_pieces ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
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
