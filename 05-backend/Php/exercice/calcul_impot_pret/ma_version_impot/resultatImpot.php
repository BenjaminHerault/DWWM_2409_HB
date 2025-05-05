<?php
require_once 'Contribuable.php';

// Récupérer les données du formulaire
$name = $_POST['name'] ?? '';
$revenue = floatval($_POST['revenue'] ?? 0);

// Instancier un objet de la classe Contribuable
$contribuable = new Contribuable($name, $revenue);

// Calculer l'impôt 
$impot = $contribuable->calculImpot();

// Afficher le résultat
echo "<h1>Résultat du calcul de l'impôt</h1>";
echo "<p>Mr/Mme {$contribuable->getName()}, votre impôt est de " .number_format($impot, 2, ',', ' ') . " euros.</p>";