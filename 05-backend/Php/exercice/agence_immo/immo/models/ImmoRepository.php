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
    public function searchAll(): array
    {
        return $this->search();
    }
    public function searchByPieces(int $nbPieces): array
    {
        return $this->search('b.nbr_pieces = :pieces', [':pieces' => $nbPieces]);
    }
    public function searchByDep(int $idDep): array
    {
        return $this->search('b.num_departement = :departement ', [':departement' => $idDep]);
    }
    public function searchByPrix(int $lePrix): array
    {
        return $this->search('prix_vente = :prix ', [':prix' => $lePrix]);
    }

    public function leFlitre(?int $idDep, ?int $nbPieces, ?int $prixMax): array
    {
        // $Where contiendra les conditions SQL (ex : b.num_departement = :departement)
        $where = [];
        // $params contiendra les valeurs à passer à la requête préparée (ew : [':departement' => 68])
        $params = [];
        // Si un département est fourni, on ajoute la condition et le paramètre
        if ($idDep !== null) {
            $where[] = 'b.num_departement = :departement';
            $params[':departement'] = $idDep;
        }

        // Si un nombre de pièces est fourni, on ajoute la condition et le paramètre
        if ($nbPieces !== null) {
            $where[] = 'b.nbr_pieces = :pieces';
            $params[':pieces'] = $nbPieces;
        }

        if ($prixMax !== null) {
            $where[] = 'b.prix_vente <= :prix';
            $params[':prix'] = $prixMax;
        }
        // On assemble toutes les conditions avec "AND" pour la clause WHERE
        $whereSql = $where ? implode(' AND ', $where) : '';
        // Exécution de la recherche avec les conditions et paramètres
        return $this->search($whereSql, $params);
    }
    public function getDistinctPieces(): array
    {
        $sql = "SELECT DISTINCT nbr_pieces 
        FROM biens_immobiliers 
        ORDER BY nbr_pieces ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    public function getBienById(int $idBien): ?array
    {
        $sql = "SELECT b.id, b.titre, b.nbr_pieces, b.surface, b.prix_vente, b.description, 
                   b.ges, b.classe_eco, b.meuble, b.localisation, b.num_departement, 
                   b.ville, b.charges_annuelles, b.id_utilisateur_commercial, 
                   b.id_categorie, b.id_proprietaire,
                   i.chemin_image, i.texte_alternatif
            FROM biens_immobiliers b
            INNER JOIN association_img ai ON ai.id = b.id AND ai.img_ppal = 1
            INNER JOIN images i ON i.id_image = ai.id_image
            WHERE b.id = :idBien";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':idBien' => $idBien]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Compte le nombre total de biens immobiliers
     */
    public function countTotalBiens(): int
    {
        $sql = "SELECT COUNT(*) FROM biens_immobiliers";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    /**
     * Récupère les derniers biens créés
     */
    public function getRecentBiens(int $limit = 5): array
    {
        $sql = "SELECT b.id, b.titre, b.nbr_pieces, b.surface, b.prix_vente, b.ville, 
                       b.num_departement, i.chemin_image, i.texte_alternatif
                FROM biens_immobiliers b
                LEFT JOIN association_img ai ON ai.id = b.id AND ai.img_ppal = 1
                LEFT JOIN images i ON i.id_image = ai.id_image
                ORDER BY b.id DESC 
                LIMIT ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouveau bien immobilier
     */
    public function createBien(array $data): ?int
    {
        $sql = "INSERT INTO biens_immobiliers (
                    titre, nbr_pieces, surface, prix_vente, description, 
                    ges, classe_eco, meuble, localisation, num_departement, 
                    ville, charges_annuelles, id_utilisateur_commercial, 
                    id_categorie, id_proprietaire
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        $params = [
            $data['titre'],
            $data['nbr_pieces'],
            $data['surface'],
            $data['prix_vente'],
            $data['description'],
            $data['ges'],
            $data['classe_eco'],
            $data['meuble'],
            $data['localisation'],
            $data['num_departement'],
            $data['ville'],
            $data['charges_annuelles'],
            $data['id_utilisateur_commercial'],
            $data['id_categorie'],
            $data['id_proprietaire']
        ];

        if ($stmt->execute($params)) {
            return (int)$this->db->lastInsertId();
        }

        return null;
    }

    /**
     * Met à jour un bien immobilier
     */
    public function updateBien(int $id, array $data): bool
    {
        $sql = "UPDATE biens_immobiliers SET 
                    titre = ?, nbr_pieces = ?, surface = ?, prix_vente = ?, 
                    description = ?, ges = ?, classe_eco = ?, meuble = ?, 
                    localisation = ?, num_departement = ?, ville = ?, 
                    charges_annuelles = ?, id_utilisateur_commercial = ?, 
                    id_categorie = ?, id_proprietaire = ?
                WHERE id = ?";

        $stmt = $this->db->prepare($sql);
        $params = [
            $data['titre'],
            $data['nbr_pieces'],
            $data['surface'],
            $data['prix_vente'],
            $data['description'],
            $data['ges'],
            $data['classe_eco'],
            $data['meuble'],
            $data['localisation'],
            $data['num_departement'],
            $data['ville'],
            $data['charges_annuelles'],
            $data['id_utilisateur_commercial'],
            $data['id_categorie'],
            $data['id_proprietaire'],
            $id
        ];

        return $stmt->execute($params);
    }

    /**
     * Supprime un bien immobilier
     */
    public function deleteBien(int $id): bool
    {
        // Supprimer d'abord les associations d'images
        $sqlImg = "DELETE FROM association_img WHERE id = ?";
        $stmtImg = $this->db->prepare($sqlImg);
        $stmtImg->execute([$id]);

        // Puis supprimer le bien
        $sql = "DELETE FROM biens_immobiliers WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}
