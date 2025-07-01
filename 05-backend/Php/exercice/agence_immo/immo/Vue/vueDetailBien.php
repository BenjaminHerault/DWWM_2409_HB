<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4 text-center">Détails du bien</h2>

            <?php if ($detail): ?>
                <div class="card shadow-lg">
                    <div class="row no-gutters">
                        <div class="col-md-6">
                            <img src="<?= htmlspecialchars($detail['chemin_image']) ?>"
                                alt="<?= htmlspecialchars($detail['texte_alternatif']) ?>"
                                class="card-img img-fluid" style="width: 100%; height: 450px; object-fit: cover; border-radius: 0.375rem 0 0 0.375rem;" />
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h3 class="card-title text-primary"><?= htmlspecialchars($detail['titre']) ?></h3>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <p class="card-text">
                                            <i class="fas fa-map-marker-alt text-danger"></i>
                                            <strong>Ville :</strong> <?= htmlspecialchars($detail['ville']) ?>
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="card-text">
                                            <i class="fas fa-expand-arrows-alt text-info"></i>
                                            <strong>Surface :</strong> <?= htmlspecialchars($detail['surface']) ?> m²
                                        </p>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <p class="card-text">
                                            <i class="fas fa-euro-sign text-success"></i>
                                            <strong>Prix :</strong>
                                            <span class="text-success font-weight-bold"><?= number_format($detail['prix_vente'], 0, ',', ' ') ?> €</span>
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="card-text">
                                            <i class="fas fa-door-open text-warning"></i>
                                            <strong>Pièces :</strong> <?= htmlspecialchars($detail['nbr_pieces']) ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h5 class="text-secondary">Description :</h5>
                                    <p class="card-text text-justify"><?= htmlspecialchars($detail['description']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning text-center" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    Bien introuvable.
                </div>
            <?php endif; ?>

            <div class="text-center mt-4">
                <a href="index.php?action=liste" class="btn btn-secondary btn-lg">
                    <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
            </div>
        </div>
    </div>
</div>