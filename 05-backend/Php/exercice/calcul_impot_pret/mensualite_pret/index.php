<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcul de Mensualité</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">
    <div class="container mt-5">
        <h1 class="text-center">Calcul de Mensualité</h1>
        <form action="index.php" method="post" class="p-4 bg-white shadow rounded">
            <div class="mb-3">
                <label for="capital" class="form-label">Capital emprunté (€) :</label>
                <input type="number" id="capital" name="capital" class="form-control" value="<?=(isset($_POST['capital']))? $_POST['capital'] : 0 ?>" required>
            </div>
            <div class="mb-3">
                <label for="taux" class="form-label">Taux d'intérêt annuel (%) :</label>
                <input type="number" step="0.01" id="taux" name="taux" class="form-control" value="<?=(isset($_POST['taux']))? $_POST['taux'] : 0 ?>" required>
            </div>
            <div class="mb-3">
                <label for="annees" class="form-label">Durée de remboursement (années) :</label>
                <input type="number" id="annees" name="annees" class="form-control" value="<?=(isset($_POST['annees']))? $_POST['annees'] : 0 ?>" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Calculer</button>
        </form>

        <?php
        require_once 'Pret.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $capital = floatval($_POST['capital']);
            $taux = floatval($_POST['taux']);
            $annees = intval($_POST['annees']);

            $pret = new Pret($capital, $taux, $annees);
            $mensualite = $pret->calculMensualite();

            echo "<div class='mt-4 p-4 bg-white shadow rounded'>";
            echo "<h2>Résultat</h2>";
            echo "<p>Mensualité constante : <strong>" . number_format($mensualite, 2, ',', ' ') . " €</strong></p>";
            echo "<h3>Tableau d'amortissement</h3>";
            echo $pret->tableauAmortissement();
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>