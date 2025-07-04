<?php
/* HEADER entete avec dépendances CSS 
  ================================================== */
include_once __DIR__ . '/vueHeader.php';

/*NAVBAR
    ================================================== */
include_once __DIR__ . '/vueMenu.php';

/* Carousel
    ================================================== */
include_once __DIR__ . '/vueSlider.php';
?>
<div class="container biens-container">
    <div class="row">
        <div class="col-12">
            <h1 class="biens-title">Liste des biens immobiliers</h1>

            <!-- Formulaire simple -->
            <div class="card filter-card">

                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-filter"></i> Filtres de recherche</h5>
                </div>
                <div class="card-body">
                    <form action="index.php?action=liste" method="get" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <input type="hidden" name="lib_cat" value="" id="lib_cat" />
                                <label for="depList" class="form-label filter-label">Département</label>
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
                                <label for="prixMax" class="form-label filter-label">Budget maximum (€)</label>
                                <input type="number" step="10000" id="prixMax" name="prixMax" class="form-control"
                                    placeholder="300000" min="50000" max="900000000"
                                    value="<?= isset($_GET['prixMax']) ? htmlspecialchars($_GET['prixMax']) : '' ?>" />
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="nbPieces" class="form-label filter-label">Nombre de pièces</label>
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

                        <div class="search-button-container">
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
                <div class="card bien-card">
                    <img src="<?php
                                if (empty($bien['chemin_image']) && $bien['id_categorie'] == 1) {
                                    echo 'public/img_immo/appartement_defaut.jpg';
                                } elseif (empty($bien['chemin_image'])) {
                                    echo 'public/img_immo/image_defaut.jpg';
                                } else {
                                    echo htmlspecialchars($bien['chemin_image']);
                                }
                                ?>"
                        class="card-img-top bien-card-img"
                        alt="<?= htmlspecialchars($bien['texte_alternatif'] ?? 'Image du bien') ?>">

                    <div class="card-body bien-card-body">
                        <h5 class="card-title bien-title"><?= htmlspecialchars($bien['titre']) ?></h5>

                        <p class="card-text">
                            <span class="bien-price"><?= number_format($bien['prix_vente'], 0, ',', ' ') ?> €</span><br>
                            <span class="bien-details"><?= htmlspecialchars($bien['surface']) ?> m² - <?= htmlspecialchars($bien['nbr_pieces']) ?> pièce<?= $bien['nbr_pieces'] > 1 ? 's' : '' ?></span>
                        </p>

                        <p class="card-text bien-description">
                            <?= htmlspecialchars(mb_strimwidth($bien['description'], 0, 100, '...')) ?>
                        </p>

                        <a href="index.php?action=details&id_bien=<?= $bien['id'] ?>" class="btn btn-primary bien-btn">
                            Voir les détails
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>