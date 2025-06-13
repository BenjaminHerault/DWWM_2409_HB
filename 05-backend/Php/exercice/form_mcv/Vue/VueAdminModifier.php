<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2>Modifier l'utilisateur</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="lastname" class="form-control" value="<?= htmlspecialchars($user['lastname_user']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Prénom</label>
                <input type="text" name="firstname" class="form-control" value="<?= htmlspecialchars($user['firstname_user']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="mail" class="form-control" value="<?= htmlspecialchars($user['mail_user']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Département</label>
                <select name="departement" class="form-control">
                    <?php foreach ($departements as $dep): ?>
                        <option value="<?= $dep['id_dep'] ?>"><?= htmlspecialchars($dep['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Âge</label>
                <input type="number" name="age" class="form-control" value="<?= htmlspecialchars($user['age_user']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="index.php?action=admin" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>

</html>