<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage tableau amortissement prêt</title>
</head>
<body>
<?php
require "./models/Pret.php";

$objPret = new Pret(10000, 5.3, 5); // Montant, Taux Annuel, Durée en années

echo $objPret->calculMensualite2();

$tableauAmor = $objPret->getTableauAmortissement();
var_export($tableauAmor);

?>

 
</body>
</html>
