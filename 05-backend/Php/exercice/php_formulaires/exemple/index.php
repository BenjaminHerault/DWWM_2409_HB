<?php
require_once __DIR__ . "/traitement.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaires</title>
</head>

<body>
    <form action="traitement.php" method="post">
        <label for="monNom">Nom :</label>
        <input type="text" id="momNom" name="nom" required>

        <label for="monAge">Age :</label>
        <input type="number" id="monAge" name="age" required>

        <button type="submit">Envoyer</button>
    </form>
</body>

</html>