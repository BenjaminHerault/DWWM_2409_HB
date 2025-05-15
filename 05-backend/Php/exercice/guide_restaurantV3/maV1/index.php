<?php
// Inclure le fichier affichage.php
include_once 'DBConnect.php';

// Appeler la fonction pour récupérer les restaurants
$restaurants = getRestaurants();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Inclusion de Bootstrap pour le style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>L guide des restaurants !</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="texte-center mb-4">Liste des restaurants</h1>
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Adresse</th>
                    <th>Prix (€)</th>
                    <th>Commentaire</th>
                    <th>Note</th>
                    <th>Visite</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($restaurants)): ?>
                    <?php foreach ($restaurants as $restaurant): ?>
                        <tr>
                            <td><?= htmlspecialchars($restaurant['id']) ?></td>
                            <td><?= htmlspecialchars($restaurant['nom']) ?></td>
                            <td><?= htmlspecialchars($restaurant['adresse']) ?></td>
                            <td><?= htmlspecialchars($restaurant['prix']) ?></td>
                            <td><?= htmlspecialchars($restaurant['commentaire']) ?></td>
                            <td><?= htmlspecialchars($restaurant['note']) ?></td>
                            <td><?= htmlspecialchars($restaurant['visite']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Aucun restaurant trouvé</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script>"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"</script>
</body>
</html>