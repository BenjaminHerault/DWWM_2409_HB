<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcul de Mensualité</title>
    <!-- Inclusion de Bootstrap pour le style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">
    <div class="container mt-5">
        <h1 class="text-center">Calcul de Mensualité</h1>
        <!-- Formulaire pour saisir les données nécessaires au calcul -->
        <form action="index.php" method="post" class="p-4 bg-white shadow rounded">
            <!-- Champ pour le capital emprunté -->
            <div class="mb-3">
                <label for="capital" class="form-label">Capital emprunté (€) :</label>
                <input type="number" id="capital" name="capital" class="form-control" placeholder="0" value="<?=(isset($_POST['capital'])) ? $_POST['capital'] : "" ?>" required>
            </div>
            <!-- Champ pour le taux d'intérêt annuel -->
            <div class="mb-3">
                <label for="taux" class="form-label">Taux d'intérêt annuel (%) :</label>
                <input type="number" step="0.01" id="taux" name="taux" class="form-control" placeholder="0" value="<?=(isset($_POST['taux'])) ? $_POST['taux'] : "" ?>" required>
            </div>
            <!-- Champ pour la durée de remboursement -->
            <div class="mb-3">
                <label for="annees" class="form-label">Durée de remboursement (années) :</label>
                <input type="number" id="annees" name="annees" class="form-control" placeholder="0" value="<?=(isset($_POST['annees'])) ? $_POST['annees'] : "" ?>" required>
            </div>
            <!-- Boutons pour soumettre le formulaire -->
            <button type="submit" name="action" value="calcul" class="btn btn-primary w-100">Calculer</button>
            <button type="submit" name="action" value="json" class="btn btn-secondary w-100 mt-2">Obtenir JSON</button>
        </form>

        <?php
        // Inclusion des fichiers nécessaires pour les classes utilisées
        require_once 'Pret.php'; // Classe pour gérer les prêts
        require_once 'historique_prets.php'; // Classe pour gérer l'historique des prêts

        // Création d'une instance pour gérer l'historique des prêts
        $historiquePrets = new HistoriquePrets();

        // Vérification si une requête POST a été envoyée
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            // Récupération des données du formulaire
            $capital = floatval($_POST['capital']); // Capital emprunté
            $taux = floatval($_POST['taux']); // Taux d'intérêt annuel
            $annees = intval($_POST['annees']); // Durée de remboursement en années
            $action = $_POST['action']; // Action choisie (calcul ou json)

            // Création d'une instance de la classe Pret
            $pret = new Pret($capital, $taux, $annees);

            // Action pour calculer la mensualité
            if ($action === 'calcul') 
            {
                // Calcul de la mensualité
                $mensualite = $pret->calculMensualite();
                // Affichage des résultats
                echo "<div class='mt-4 p-4 bg-white shadow rounded' id='resultContainer'>"; // Ajout de l'ID
                echo "<div class='d-flex justify-content-between align-items-center'>";
                echo "<h2>Résultat</h2>";
                echo "<button class='btn btn-secondary' onclick='copyToClipboard(\"resultContainer\")'>Copier</button>"; // Mise à jour de l'ID
                echo "</div>";
                echo "<p>Mensualité constante : <strong>" . number_format($mensualite, 2, ',', ' ') . " €</strong></p>";
                echo "<h3>Tableau d'amortissement</h3>";
                echo $pret->tableauAmortissement(); // Affichage du tableau d'amortissement
                echo "</div>";
            } 
            // Action pour générer le JSON
            elseif ($action === 'json') {
                // Récupération du tableau d'amortissement
                $tableauAmortissement = $pret->getTableauAmortissement();

                // Ajouter le prêt à l'historique
                $historiquePrets->ajouterPret([
                    'capital' => $capital,
                    'taux' => $taux,
                    'annees' => $annees,
                    'tableauAmortissement' => $tableauAmortissement,
                ]);

                // Créer un fichier JSON pour le prêt actuel
                $filePath = './report/tableau_amortissement.json';
                $jsonData = json_encode($tableauAmortissement, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                file_put_contents($filePath, $jsonData);

                // Créer un fichier JSON pour l'historique des prêts
                $historiqueFilePath = './report/historique_prets.json';
                
                $historiqueData = json_encode($historiquePrets->getHistorique(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                file_put_contents($historiqueFilePath, $historiqueData);

                // Afficher le JSON sur la page
                echo "<div class='mt-4 p-4 bg-white shadow rounded'>";
                echo "<div class='d-flex justify-content-between align-items-center'>";
                echo "<h2>JSON Généré</h2>";
                echo "<button class='btn btn-secondary' onclick='copyToClipboard(\"jsonOutput\")'>Copier</button>";
                echo "</div>";
                echo "<pre id='jsonOutput' class='mb-0'>" . htmlspecialchars($jsonData) . "</pre>";
                echo "</div>";
            }
        }
        ?>
    </div>

    <script>
    function copyToClipboard(elementId) 
    {
        const element = document.getElementById(elementId);
        const textToCopy = element.innerText; // Copie uniquement le texte visible
        navigator.clipboard.writeText(textToCopy).then(() => {
            alert('Contenu copié dans le presse-papiers !');
        }).catch(err => {
            alert('Erreur lors de la copie : ' + err);
        });
    }
    </script>
</body>
</html>