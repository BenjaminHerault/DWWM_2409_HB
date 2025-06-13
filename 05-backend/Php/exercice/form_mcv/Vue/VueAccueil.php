<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <div class="card-body">
                            <?php if (!empty($errors)): ?>
                                <div class="alert alert-danger">
                                    <?php foreach ($errors as $err): ?>
                                        <div><?= htmlspecialchars($err) ?></div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <form method="post" action="index.php?action=inscription">
                                <div class="mb-3">
                                    <label for="lastname" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="votre nom" required>
                                </div>
                                <div class="mb-3">
                                    <label for="firstname" class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="votre prénom" required>
                                </div>
                                <div class="mb-3">
                                    <label for="mail" class="form-label">email</label>
                                    <input type="email" class="form-control" id="mail" name="mail" placeholder="identifiant" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mot de passe</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password2" class="form-label">Vérification du Mot de passe</label>
                                    <input type="password" class="form-control" id="password2" name="password2" required>
                                </div>
                                <div class="mb-3">
                                    <label for="departement" class="form-label">Département de votre domicile principal</label>
                                    <select class="form-select" id="departement" name="departement" required>
                                        <option value="">Choisir un Département</option>
                                        <?php foreach ($departements as $dep): ?>
                                            <option value="<?= $dep['id_dep'] ?>"><?= htmlspecialchars($dep['name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="age" class="form-label">Votre age</label>
                                    <input type="number" class="form-control" id="age" name="age" placeholder="18" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Valider</button>
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <a href="index.php?action=connexion" class="btn btn-link">Déjà inscrit ? Se connecter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>