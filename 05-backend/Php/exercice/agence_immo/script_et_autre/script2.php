<?php
require_once __DIR__ . '/models/Dbconnect.php';
$db = Dbconnexion::getInstance();

// Récupère tous les id des biens existants
$ids = $db->query("SELECT id FROM biens_immobiliers")->fetchAll(PDO::FETCH_COLUMN);

foreach ($ids as $i) {
    // Vérifie si l'association existe déjà
    $check = $db->prepare("SELECT COUNT(*) FROM association_img WHERE id = :id AND id_image = :id_image");
    $check->execute([':id' => $i, ':id_image' => $i]);
    if ($check->fetchColumn() == 0) {
        $sql = "INSERT INTO association_img (id, id_image, img_ppal) VALUES (:id, :id_image, 1)";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $i, ':id_image' => $i]);
        echo "Association bien $i <-> image $i créée<br>";
    } else {
        echo "Association bien $i <-> image $i déjà existante<br>";
    }
}
