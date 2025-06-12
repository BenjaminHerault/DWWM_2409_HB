<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header text-center bg-primary text-white">
                        <h2>Connexion</h2>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                        <?php endif; ?>
                        <form method="post" action="index.php?action=connexion">
                            <div class="mb-3">
                                <label for="mail" class="form-label">Adresse mail</label>
                                <input type="email" class="form-control" id="mail" name="mail" placeholder="Votre email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="index.php?action=accueil" class="btn btn-link">Pas encore inscrit ? S'inscrire</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>