<!-- Espace Admin - Gestion des biens immobiliers -->
<link rel="stylesheet" href="public/css/biens.css">
<div class="container mt-4">
    <h2 class="mb-4 text-center">Espace Admin - Gestion des biens</h2>

    <!-- Formulaire d'ajout d'un bien -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Ajouter un bien</div>
        <div class="card-body">
            <form action="index.php?action=ajouter" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="prix_vente" class="form-label">Prix (€)</label>
                        <input type="number" class="form-control" id="prix_vente" name="prix_vente" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="surface" class="form-label">Surface (m²)</label>
                        <input type="number" class="form-control" id="surface" name="surface" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="nbr_pieces" class="form-label">Nombre de pièces</label>
                        <input type="number" class="form-control" id="nbr_pieces" name="nbr_pieces" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="ville" class="form-label">Ville</label>
                        <input type="text" class="form-control" id="ville" name="ville" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="num_departement" class="form-label">Département</label>
                        <input type="text" class="form-control" id="num_departement" name="num_departement" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="2" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="chemin_image" class="form-label">Image principale</label>
                    <input type="file" class="form-control" id="chemin_image" name="chemin_image">
                </div>
                <button type="submit" class="btn btn-success">Ajouter le bien</button>
            </form>
        </div>
    </div>

    <!-- Tableau de gestion des biens -->
    <div class="card">
        <div class="card-header bg-secondary text-white">Liste des biens</div>
        <div class="card-body">
            <form method="get" action="index.php" class="mb-2">
                <input type="hidden" name="action" value="admin">
                <div class="row g-2 align-items-center">
                    <div class="col-auto">
                        <label for="tri" class="col-form-label">Trier par&nbsp;:</label>
                    </div>
                    <div class="col-auto">
                        <select name="tri" id="tri" class="form-select form-select-sm">
                            <option value="prix_vente" <?= (isset($_GET['tri']) && $_GET['tri'] === 'prix_vente') ? 'selected' : '' ?>>Prix</option>
                            <option value="surface" <?= (isset($_GET['tri']) && $_GET['tri'] === 'surface') ? 'selected' : '' ?>>Surface</option>
                            <option value="nbr_pieces" <?= (isset($_GET['tri']) && $_GET['tri'] === 'nbr_pieces') ? 'selected' : '' ?>>Nombre de pièces</option>
                            <option value="titre" <?= (isset($_GET['tri']) && $_GET['tri'] === 'titre') ? 'selected' : '' ?>>Titre</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <select name="ordre" id="ordre" class="form-select form-select-sm">
                            <option value="asc" <?= (isset($_GET['ordre']) && $_GET['ordre'] === 'asc') ? 'selected' : '' ?>>Croissant</option>
                            <option value="desc" <?= (isset($_GET['ordre']) && $_GET['ordre'] === 'desc') ? 'selected' : '' ?>>Décroissant</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-outline-light btn-sm">Trier</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Prix</th>
                            <th>Surface</th>
                            <th>Pièces</th>
                            <th>Ville</th>
                            <th>Département</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $bien): ?>
                            <tr>
                                <td style="width:90px">
                                    <img src="<?php
                                                if (empty($bien['chemin_image']) && $bien['id_categorie'] == 1) {
                                                    echo 'public/img_immo/appartement_defaut.jpg';
                                                } elseif (empty($bien['chemin_image'])) {
                                                    echo 'public/img_immo/image_defaut.jpg';
                                                } else {
                                                    echo htmlspecialchars($bien['chemin_image']);
                                                }
                                                ?>" alt="<?= htmlspecialchars($bien['texte_alternatif'] ?? 'Image du bien') ?>" style="width:80px; height:60px; object-fit:cover; border-radius:8px;">
                                </td>
                                <td><?= htmlspecialchars($bien['titre']) ?></td>
                                <td><?= number_format($bien['prix_vente'], 0, ',', ' ') ?> €</td>
                                <td><?= htmlspecialchars($bien['surface']) ?> m²</td>
                                <td><?= htmlspecialchars($bien['nbr_pieces']) ?></td>
                                <td><?= htmlspecialchars($bien['ville']) ?></td>
                                <td><?= htmlspecialchars($bien['num_departement']) ?></td>
                                <td>
                                    <a href="index.php?action=modifier&id_bien=<?= $bien['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                                    <a href="index.php?action=supprimer&id_bien=<?= $bien['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce bien ?');">Supprimer</a>
                                    <a href="index.php?action=images&id_bien=<?= $bien['id'] ?>" class="btn btn-primary mb-2">📸Modifier l'images</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>