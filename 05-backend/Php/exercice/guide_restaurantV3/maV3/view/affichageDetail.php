   <?php

require_once '../DBConnect.php';
require_once '../RestoRepository/RestoRepository.PHP';



$connect=getRestaurants();
$listeresto = new RestoRepository($connect);
/*
// elle marche
var_dump($listeresto->searchAll());
*/

// var_dump($listeresto->searchById(1))."\n";
// var_dump($listeresto->searchById(0))."\n";
// var_dump($listeresto->searchById("test"));
// var_dump($listeresto->searchById(2))."\n";

?>
<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des restaurants</title>
    <link rel="stylesheet" href="../view/style.css">
</head>
<body>
    <?php
    echo $listeresto->rendre_hyml();
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</body>
</html>



<?php
//    if($restaurant)
//         {
//             // Afficher sous forme de tableau HTML
//             echo "<table border='1'><tr>";
//             foreach($restaurant as $key => $value)
//             {
//                 echo "th" . htmlspecialchars($key) . "</th>";
//             } 
//             echo "</tr><tr>";
//             foreach($restaurant as $key => $value)
//             {
//                 echo "<td>" . htmlspecialchars($value) . "</td>";
//             }
//             echo "</tr></table>";
//         }
//         else
//         {
//             echo "Aucun restaurant trouvé avec cet ID : " . htmlspecialchars($id);
//         }