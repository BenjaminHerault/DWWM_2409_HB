<?php
require_once '../DBConnect.php';
require_once '../RestoRepository/RestoRepository.PHP';

$listeresto = new RestoRepository(getRestaurants());

$id = $_GET['id'] ?? null;
if(!$id) {
	echo "Aucun identifiant fourni.";
	exit;
}

$restaurant = $listeresto->searchById($id);
if(!$restaurant) {
	echo "Restaurent non trouvé.";
	exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">Détail du restaurant #<?= htmlspecialchars($id) ?></h1>
        <div class="card p-4 shadow-sm">
            <?php foreach($restaurant as $col => $val): ?>
                <div class="mb-2">
                    <strong><?= htmlspecialchars($col) ?> :</strong>
                    <?= htmlspecialchars($val) ?>
                </div>
            <?php endforeach; ?>
            <a href="javascript:history.back()" class="btn btn-secondary mt-3">Retour</a>
        </div>
    </div>
</body>
</html>