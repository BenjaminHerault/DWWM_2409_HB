<?php

require_once './DBConnect.php';
require_once './RestoRepository/RestoRepository.PHP';

$listeresto = new RestoRepository(getRestaurants());

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">Modifier le restaurant #<?= htmlspecialchars($id) ?></h1>
<form method="post" class="card p-4 shadow-sm">
    <?php foreach ($restaurant as $col => $val): ?>
        <?php if ($col == 'id'): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($val) ?>">
        <?php elseif ($col == 'note'): ?>
            <div class="mb-3">
        <div class="d-flex justify-content-between gap-2">
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <input type="radio" class="btn-check" name="note" id="note<?= $i ?>" value="<?= $i ?>" autocomplete="off" <?= ($val == $i) ? 'checked' : '' ?>>
                <label class="btn btn-outline-primary flex-fill" style="min-width:40px;" for="note<?= $i ?>"><?= $i ?></label>
            <?php endfor; ?>
                </div>
                        <?php elseif ($col == 'date'): ?>
            <div class="mb-3">
                <label class="form-label">Date :</label>
                <input type="text" class="form-control" value="<?= date('Y-m-d H:i:s') ?>" readonly>
            </div>
            </div>
        <?php else: ?>
            <div class="mb-3">
                <label class="form-label"><?= htmlspecialchars($col) ?> :</label>
                <input type="text" class="form-control" name="<?= htmlspecialchars($col) ?>" value="<?= htmlspecialchars($val) ?>">
            </div>

        <?php endif; ?>
    <?php endforeach; ?>
    <button type="submit" name="submit" class="btn btn-primary">Enregistrer</button>
</form>
    </div>
    <!-- Bootstrap JS (optionnel) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



