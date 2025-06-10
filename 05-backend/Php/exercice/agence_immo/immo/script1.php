<?php
require_once __DIR__ . '/Controleur/BiensImmoController.php';

$ctrl = new BiensImmoController();

for ($i = 1; $i <= 11; $i++) {
    $titre = "Bien $i";
    $chemin = "Vue/img/bien_$i.jpg";
    $alt = "Photo bien $i";
    $ext = "jpg";
    $idImage = $ctrl->ajouterImage($titre, $chemin, $alt, $ext);
    echo "Image bien_$i.jpg insérée avec l'id : $idImage<br>";
}
