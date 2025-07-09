<?php

require_once __DIR__ . '/Dbconnect.php';

class ImageRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Dbconnexion::getInstance();
    }
    public function searchByBienImmo(int $_id_bienImmo): array
    {
        $sql = "SELECT titre_image, chemin_image, texte_alternatif, extension  FROM images
        INNER JOIN association_img ON images.id_image = association_img.id_image
        WHERE id = ?  ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$_id_bienImmo]);
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
    public function getImagesByBienId(int $idBien): array
    {
        $sql = "SELECT images.id_image, images.titre_image, images.chemin_image, images.texte_alternatif, images.extension, association_img.img_ppal
                FROM images
                INNER JOIN association_img ON images.id_image = association_img.id_image
                WHERE association_img.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idBien]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteImage(int $idImage): bool
    {
        try {
            // Démarrer une transaction pour s'assurer de la cohérence
            $this->db->beginTransaction();

            // Supprimer d'abord l'association
            $sqlAssoc = "DELETE FROM association_img WHERE id_image = ?";
            $stmtAssoc = $this->db->prepare($sqlAssoc);
            $stmtAssoc->execute([$idImage]);

            // Ensuite supprimer l'image
            $sqlImg = "DELETE FROM images WHERE id_image = ?";
            $stmtImg = $this->db->prepare($sqlImg);
            $result = $stmtImg->execute([$idImage]);

            // Valider la transaction
            $this->db->commit();
            return $result;
        } catch (Exception $e) {
            // En cas d'erreur, annuler la transaction
            $this->db->rollBack();
            return false;
        }
    }
    public function setAllSecondaires($idBien)
    {
        $sql = "UPDATE association_img 
                SET img_ppal = 0 
                WHERE id = :idBien";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['idBien' => $idBien]);
    }
    public function setPrincipale($idBien, $idImage)
    {
        $sql = "UPDATE association_img 
                SET img_ppal = 1
                WHERE id = :idBien 
                AND id_image = :idImage";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['idBien' => $idBien, 'idImage' => $idImage]);
    }

    public function createAssociation($idBien, $idImage, $isPrincipal = 0)
    {
        $sql = "INSERT INTO association_img (id, id_image, img_ppal) 
                VALUES (:idBien, :idImage, :isPrincipal)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'idBien' => $idBien,
            'idImage' => $idImage,
            'isPrincipal' => $isPrincipal
        ]);
    }

    public function getImageById(int $idImage): ?array
    {
        $sql = "SELECT id_image, titre_image, chemin_image, texte_alternatif, extension 
                FROM images 
                WHERE id_image = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idImage]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
}
