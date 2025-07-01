<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-5">Liste des biens immobiliers</h1>

            <!-- Formulaire simple -->
            <div class="card mb-5 border border-primary" style="border-width: 2px !important;">

                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-filter"></i> Filtres de recherche</h5>
                </div>
                <div class="card-body">
                    <form action="index.php?action=liste" method="get" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <input type="hidden" name="lib_cat" value="" id="lib_cat" />
                                <label for="depList" class="form-label" style="height: 24px; display: block;">Département</label>
                                <select name="depList" id="depList" class="form-select">
                                    <option value="">Tous les départements</option>
                                    <?php foreach ($depDisponibles as $dep): ?>
                                        <option value="<?= htmlspecialchars($dep['id_dep']) ?>"
                                            <?php if (isset($_GET['depList']) && $_GET['depList'] == $dep['id_dep']) echo 'selected'; ?>>
                                            <?= htmlspecialchars($dep['nom_dep']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="prixMax" class="form-label" style="height: 24px; display: block;">Budget maximum (€)</label>
                                <input type="number" step="10000" id="prixMax" name="prixMax" class="form-control"
                                    placeholder="300000" min="50000" max="900000000"
                                    value="<?= isset($_GET['prixMax']) ? htmlspecialchars($_GET['prixMax']) : '' ?>" />
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="nbPieces" class="form-label" style="height: 24px; display: block;">Nombre de pièces</label>
                                <select name="nbPieces" id="nbPieces" class="form-select">
                                    <option value="">Toutes</option>
                                    <?php foreach ($piecesDisponibles as $nb): ?>
                                        <option value="<?= $nb ?>" <?php if (isset($_GET['nbPieces']) && $_GET['nbPieces'] == $nb) echo 'selected'; ?>>
                                            <?= $nb ?> pièce<?= $nb > 1 ? 's' : '' ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" name="envoi">Rechercher</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Liste des biens -->
<div class="container">
    <div class="row">
        <?php foreach ($listDesBiens as $bien): ?>
            <div class="col-md-4 mb-5">
                <div class="card" style="border: 2px solid #6c757d !important; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <img src="<?php
                                if (empty($bien['chemin_image']) && $bien['id_categorie'] == 1) {
                                    echo 'public/img_immo/appartement_defaut.jpg';
                                } elseif (empty($bien['chemin_image'])) {
                                    echo 'public/img_immo/image_defaut.jpg';
                                } else {
                                    echo htmlspecialchars($bien['chemin_image']);
                                }
                                ?>"
                        class="card-img-top"
                        alt="<?= htmlspecialchars($bien['texte_alternatif'] ?? 'Image du bien') ?>"
                        style="height: 200px; object-fit: cover;">

                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($bien['titre']) ?></h5>

                        <p class="card-text">
                            <strong><?= number_format($bien['prix_vente'], 0, ',', ' ') ?> €</strong><br>
                            <?= htmlspecialchars($bien['surface']) ?> m² - <?= htmlspecialchars($bien['nbr_pieces']) ?> pièce<?= $bien['nbr_pieces'] > 1 ? 's' : '' ?>
                        </p>

                        <p class="card-text text-muted" style="margin-bottom: 2rem;">
                            <?= htmlspecialchars(mb_strimwidth($bien['description'], 0, 100, '...')) ?>
                        </p>

                        <a href="index.php?action=details&id_bien=<?= $bien['id'] ?>" class="btn btn-primary">
                            Voir les détails
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>