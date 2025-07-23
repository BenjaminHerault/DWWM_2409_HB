<?php
require_once './DBConnect.php';
require_once './RestoRepository/RestoRepository.PHP';


$listeresto = new RestoRepository(getRestaurants());
$listeresto->chercherCollection();

echo "Fichier JSON généré dans le dossier dataobjet.";
