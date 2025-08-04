<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <!-- Bootstrap CSS COMPLET - Pas reboot ! -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-center bg-primary text-white">
                        <h2>Inscription</h2>
                    </div>
                    <div class="card-body">
                        <form action="index.php?action=inscription" method="post">
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Entrez votre nom" required>
                            </div>
                            <div class="mb-3">
                                <label for="firstname" class="form-label"> Prénom</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Entrez votre prénom" required>
                            </div>
                            <div class="mb-3">
                                <label for="departement" class="form-label">Département de naissance</label>
                                <select class="form-select" id="departement" name="dapartement" required>
                                    <option value="">Choisir un Département</option>
                                    <?php foreach ($departements as $dep): ?>
                                        <option value="<?= $dep['ide_dep'] ?>"><?= htmlspecialchars($dep['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100"> Valider</button>
                        </form>
                        <div class="card-footer text-center">
                            <a href="index.php?action=liste" class="btn btn-link">Voir tout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>