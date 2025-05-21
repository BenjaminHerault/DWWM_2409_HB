<?php

require_once './DBConnect.php';
require_once './RestoRepository/RestoRepository.PHP';

$listeresto = new RestoRepository(getRestaurants());

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "Aucun identifiant fourni.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    unset($data['submit']);
    if ($listeresto->modifierRow($id, $data)) {
        header("Location: view/affichageDetail.php?id=$id");
        exit;
    } else {
        echo "<p>Erreur lors de la modification.</p>";
    }
}

// Récupérer les informations du restaurant
$restaurant = $listeresto->searchById($id);
if (!$restaurant) {
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
    <link rel="stylesheet" href="./view/style.css">
</head>

<body>
    <section>
        <form method="post" class="card p-4 shadow mb-4 fiche-form">
            <h1 class="h4 mb-4 text-center text-primary">Modifier le restaurant #<?= htmlspecialchars($id) ?></h1>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom du restaurant" maxlength="255" required
                    value="<?= htmlspecialchars($restaurant['nom']) ?>">
            </div>
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" name="adresse" id="adresse" class="form-control" placeholder="Adresse" maxlength="255" required
                    value="<?= htmlspecialchars($restaurant['adresse']) ?>">
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Prix moyen (€)</label>
                <input type="number" step="0.01" name="prix" id="prix" class="form-control" placeholder="Prix" required
                    value="<?= htmlspecialchars($restaurant['prix']) ?>">
            </div>
            <div class="mb-3">
                <label for="commentaire" class="form-label">Commentaire</label>
                <textarea name="commentaire" id="commentaire" class="form-control" placeholder="Votre avis" maxlength="255" required><?= htmlspecialchars($restaurant['commentaire']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="note-range" class="form-label">Note</label>
                <div class="d-flex align-items-center gap-2">
                    <span>1</span>
                    <input type="range" min="1" max="10" value="<?= htmlspecialchars($restaurant['note']) ?>" class="form-range flex-grow-1" id="note-range" name="note" oninput="noteValue.value = this.value" required>
                    <span>10</span>
                    <output id="noteValue"><?= htmlspecialchars($restaurant['note']) ?></output>
                </div>
            </div>
            <div class="d-grid">
                <button type="submit" name="submit" class="btn btn-primary btn-lg">Enregistrer</button>
            </div>
        </form>
    </section>
</body>

</html>