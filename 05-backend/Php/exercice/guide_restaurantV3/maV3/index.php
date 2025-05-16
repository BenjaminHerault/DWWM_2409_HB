<?php
// Inclure le fichier affichage.php
include_once 'DBConnect.php';

// Appeler la fonction pour récupérer les restaurants
$restaurants = getRestaurants();

// Vérifier si un formulaire a été soumis pour ajouter un restaurant
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'] ?? '';
    $adresse = $_POST['adresse'] ?? '';
    $prix = $_POST['prix'] ?? 0;
    $commentaire = $_POST['commentaire'] ?? '';
    $note = $_POST['note'] ?? 0;

    // Ajouter le restaurant dans la base de données
    addRestaurant($nom, $adresse, $prix, $commentaire, $note);
    // Recharger la page pour afficher le nouveau restaurant
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Inclusion de Bootstrap pour le style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Guide des restaurants</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <!-- Barre de navigation -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="add-tab" data-bs-toggle="tab" href="#add-restaurant">Ajouter un Restaurant</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="list-tab" data-bs-toggle="tab" href="#list-restaurants">Liste des Restaurants</a>
            </li>
        </ul>

        <!-- Contenu des onglets -->
        <div class="tab-content mt-4">
            <!-- Onglet Ajouter un Restaurant -->
            <div class="tab-pane fade show active" id="add-restaurant">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Ajouter un Restaurant</h5>
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <div class="mb-3">
                                <label for="adresse" class="form-label">Adresse</label>
                                <input type="text" class="form-control" id="adresse" name="adresse" required>
                            </div>
                            <div class="mb-3">
                                <label for="prix" class="form-label">Prix</label>
                                <input type="number" class="form-control" id="prix" name="prix" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label for="commentaire" class="form-label">Commentaire</label>
                                <textarea class="form-control" id="commentaire" name="commentaire" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Note</label>
                                <input type="number" class="form-control" id="note" name="note" min="0" max="10" step="0.1" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Onglet Liste des Restaurants -->
            <div class="tab-pane fade" id="list-restaurants">
                <div class="row">
                    <?php if (!empty($restaurants)): ?>
                        <?php foreach ($restaurants as $restaurant): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($restaurant['nom']) ?></h5>
                                        <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($restaurant['adresse']) ?></h6>
                                        <p class="card-text">
                                            <strong>Prix :</strong> <?= htmlspecialchars($restaurant['prix']) ?> €<br>
                                            <strong>Note :</strong> <?= htmlspecialchars($restaurant['note']) ?>/10<br>
                                            <strong>Commentaire :</strong> <?= htmlspecialchars($restaurant['commentaire']) ?>
                                        </p>
                                        <p class="text-muted"><small>Dernière visite : <?= htmlspecialchars($restaurant['visite']) ?></small></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center">Aucun restaurant trouvé.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Inclusion de Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>