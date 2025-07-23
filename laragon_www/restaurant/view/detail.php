<?php
require_once '../DBConnect.php';
require_once '../RestoRepository/RestoRepository.PHP';

$listeresto = new RestoRepository(getRestaurants());

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "Aucun identifiant fourni.";
    exit;
}

$restaurant = $listeresto->searchById($id);
if (!$restaurant) {
    echo "Restaurent non trouvé.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body class="bg-light">
    <div class="fiche-form card p-4 shadow mb-4">
        <h1 class="h4 mb-4 text-center text-primary">Détail du restaurant #<?= htmlspecialchars($id) ?></h1>
        <?php foreach ($restaurant as $col => $val): ?>
            <div class="mb-2">
                <strong><?= htmlspecialchars($col) ?> :</strong>
                <?= htmlspecialchars($val) ?>
            </div>
        <?php endforeach; ?>
        <div class="d-grid mt-3">
            <a href="javascript:history.back()" class="btn btn-primary btn-lg">Retour</a>
        </div>
    </div>
</body>

</html>