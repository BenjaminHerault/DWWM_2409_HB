<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <title>Leste des biens immobiliers</title>
</head>

<body>
    <h1>Liste des biens immobiliers</h1>
    <form action="index.php?action=liste" method="get" enctype="multipart/form-data">
        <fieldset>
            <legend>Rechercher un Bien immobilier</legend>
            <div class="form-group">
                <input type="hidden" name="lib_cat" value="" id="lib_cat" />
                <label for="dept">Choisir le département</label>
                <select name="dep" id="dep" class="form-control" style=" max-width:300px">
                    <?php foreach ($lesDepartements as $dep): ?>
                        <option value="<?= $dep['id_dep'] ?>"><?= htmlspecialchars($dep['nom_dep']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="budget">Montant budget maximum</label>
                <span class="currencyinput">
                    <input type="number" step="10000" id="bugdet" name="budget" placeholder="Budget Max" min="50000" max="900000000" /> €
                </span>
            </div>
            <div class="form-group">
                <label for="nbpiece">Nombre de pièces souhaitées:</label>
                <select name="nbPieces" id="nbPieces">
                    <option value="">--Choisir--</option>
                    <?php foreach ($piecesDisponibles as $nb): ?>
                        <option value="<?= $nb ?>" <?php if (isset($_GET['nbPieces']) && $_GET['nbPieces'] == $nb) echo 'selected'; ?>>
                            <?= $nb ?> pièce<?= $nb > 1 ? 's' : '' ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group form-button" id="btnsub">
                <button type="submit" class="btn btn-primary" name="envoi">Submit</button>
            </div>
        </fieldset>
    </form>
    <div class="container mt-4">
        <div class="row g-0"><!-- Ajout de g-0 -->
            <?php foreach ($listDesBiens as $bien): ?>
                <div class="col-md-4"><!-- Suppression de mb-4 -->
                    <div class="card h-100">
                        <img
                            src="<?php
                                    if (empty($bien['chemin_image']) && $bien['id_categorie'] == 1) {
                                        echo 'public/img_immo/appartement_defaut.jpg';
                                    } elseif (empty($bien['chemin_image'])) {
                                        echo 'public/img_immo/image_defaut.jpg';
                                    } else {
                                        echo htmlspecialchars($bien['chemin_image']);
                                    }
                                    ?>"
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