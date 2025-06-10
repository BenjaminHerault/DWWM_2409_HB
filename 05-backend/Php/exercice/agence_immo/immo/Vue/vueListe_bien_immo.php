<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leste des biens immobiliers</title>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <?php foreach ($biens as $bien): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <!-- Image principale si tu l'as, sinon une image par défaut -->
                        <img src="<?= htmlspecialchars($bien['chemin_image'] ?? 'chemin/vers/image_defaut.jpg') ?>"
                            class="card-img-top"
                            alt="<?= htmlspecialchars($bien['texte_alternatif'] ?? 'Image du bien') ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($bien['titre']) ?></h5>
                            <p class="card-text">
                                <strong>Ville :</strong> <?= htmlspecialchars($bien['ville']) ?><br>
                                <strong>Surface :</strong> <?= htmlspecialchars($bien['surface']) ?> m²<br>
                                <strong>Prix :</strong> <?= htmlspecialchars($bien['prix_vente']) ?> €<br>
                                <strong>Nombre de pièces :</strong> <?= htmlspecialchars($bien['nbr_pieces']) ?><br>
                                <strong>Description :</strong> <?= htmlspecialchars($bien['description']) ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>