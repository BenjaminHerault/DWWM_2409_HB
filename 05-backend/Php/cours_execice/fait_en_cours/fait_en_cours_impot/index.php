<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Calcul impot</title>
</head>
<body>
    <form action="#" method="GET" enctype="texte/plain">

        <label for="nom">Votre nom :</label>
        <input type="text" maxlength="50" name="nom" id="nom" size="30" required>
        <br>
        <label for="revenu">salaire annuel</label>
        <input type="number" name="revenu" id="revenu" step="0.01" required>
        <br>
        <input type="submit" value="Calculer" name="calculer" id="calcul">
        <label for="">montant de l'impôt sur le revenu</label>
        <br>
        <input type="text" name="impot" id="impot" readonly size="10">
    
    </form>
</body>

<?php

const TAUX_REDUIT=0.09;
const TAUX_MAX=0.14;
function calculImpot(float $_salaire): float
{
    $montant =0.01;
    if($_salaire <= 15000)
    {
        $montant = $_salaire * TAUX_REDUIT;
    }
    else{
        $tranch1 = 15000 * TAUX_REDUIT;
        $tranch2 = ($_salaire - 15000) * TAUX_MAX;
        $montant = $tranch1 + $tranch2;
    }
    return $montant;
}
if(isset($_GET["revenu"]) && !empty($_GET["revenu"]))
{
   $montantImpot = calculImpot(floatval($_GET["revenu"]));
   echo "votre impot sur le revenu est de : ".$montantImpot."€";
}

?>
</html>