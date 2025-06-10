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
    public function searchAll(): array
    {
        try {
            $sql = "SELECT b.id, b.titre, b.nbr_pieces, b.surface, b.prix_vente, b.description, 
                           b.ges, b.classe_eco, b.meuble, b.localisation, b.num_departement, 
                           b.ville, b.charges_annuelles, b.id_utilisateur_commercial, 
                           b.id_categorie, b.id_proprietaire,
                           i.chemin_image, i.texte_alternatif
                    FROM biens_immobiliers b
                    INNER JOIN association_img ai ON ai.id = b.id AND ai.img_ppal = 1
                    INNER JOIN images i ON i.id_image = ai.id_image";
            $stml = $this->db->query($sql);
            return $stml->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
    public function insertImage($titre, $chemin, $alt, $ext): int
    {
        $sql = 'INSERT INTO images (titre_image, chemin_image, texte_alternatif, extension) VALUES (:titre, :chemin, :alt, :ext)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':titre' => $titre,
            ':chemin' => $chemin,
            ':alt' => $alt,
            ':ext' => $ext
        ]);
        return $this->db->lastInsertId();
    }
}
