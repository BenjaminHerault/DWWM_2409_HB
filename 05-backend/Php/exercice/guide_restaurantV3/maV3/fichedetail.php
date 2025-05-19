<?php

require_once './DBConnect.php';
require_once './RestoRepository/RestoRepository.PHP';

$listeresto = new RestoRepository(getRestaurants($pdo));

$id = $_GET['id'] ?? null;
if (!$id)
{
    echo "Aucun identifiant fourni.";
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $data = $_POST;
    unset($data['submit']);
    if ($listeresto->modifierRow($id, $data))
    {
        header("Location: view/affichageDetail.php?id=$id");
        exit;
    }
    else
    {
        echo "<p>Erreur lors de la modification.</p>";
    }
}

// Récupérer les informations du restaurant
$restaurant = $listeresto->searchById($id);
if (!$restaurant)
{
    echo "Restaurant non trouvé.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un restaurant</title>
</head>
<body>
    <h1>Modifier le restaurant #<?= htmlspecialchars($id) ?></h1>
    <form method="post">
        <?php foreach ($restaurant as $col => $val): ?>
            <?php if ($col == 'id'): ?>
                <input type="hidden" name="id" value="<?= htmlspecialchars($val) ?>">
            <?php else: ?>
                <label><?= htmlspecialchars($col) ?> : 
                    <input type="text" name="<?= htmlspecialchars($col) ?>" value="<?= htmlspecialchars($val) ?>">
                </label><br>
            <?php endif; ?>
        <?php endforeach; ?>
        <input type="submit" name="submit" value="Enregistrer">
    </form>
</body>
</html>



