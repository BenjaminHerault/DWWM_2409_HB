<?php

require_once __DIR__ . '/Dbconnect.php';

class ImagesRepository
{
    private $db;

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
        return $stmt->fetchAll();
    }
}
