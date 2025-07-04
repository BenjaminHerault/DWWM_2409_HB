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
     * Méthode privée générique pour effectuer des recherches dans la base de données
     * @param string $where Clause WHERE SQL (optionnelle)
     * @param array $params Paramètres pour la requête préparée
     * @return array Tableau associatif des biens immobiliers trouvés
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

    /**
     * Récupère tous les biens immobiliers disponibles
     * @return array Liste complète des biens immobiliers avec leurs images principales
     */
    public function searchAll(): array
    {
        return $this->search();
    }

    /**
     * Recherche des biens par nombre de pièces
     * @param int $nbPieces Nombre de pièces recherché
     * @return array Liste des biens correspondant au critère
     */
    public function searchByPieces(int $nbPieces): array
    {
        return $this->search('b.nbr_pieces = :pieces', [':pieces' => $nbPieces]);
    }

    /**
     * Recherche des biens par département
     * @param int $idDep ID du département
     * @return array Liste des biens du département spécifié
     */
    public function searchByDep(int $idDep): array
    {
        return $this->search('b.num_departement = :departement ', [':departement' => $idDep]);
    }

    /**
     * Recherche des biens par prix exact
     * @param int $lePrix Prix de vente recherché
     * @return array Liste des biens au prix spécifié
     */
    public function searchByPrix(int $lePrix): array
    {
        return $this->search('prix_vente = :prix ', [':prix' => $lePrix]);
    }

    /**
     * Filtre avancé pour la recherche de biens immobiliers
     * Permet de combiner plusieurs critères de recherche
     * @param int|null $idDep ID du département (optionnel)
     * @param int|null $nbPieces Nombre de pièces (optionnel)  
     * @param int|null $prixMax Prix maximum (optionnel)
     * @return array Liste des biens correspondant aux critères
     */
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
        return null;
    }

    /**
     * Met à jour un bien immobilier
     */
    public function updateBien(int $id, array $data): bool
    {
        return false;
    }

    /**
     * Supprime un bien immobilier
     */
    public function deleteBien(int $id): bool
    {
        return false;
    }
}
