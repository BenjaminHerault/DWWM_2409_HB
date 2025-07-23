<?php
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    echo "Accès refusé";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Espace Admin</title>
    <!-- Lien vers Bootstrap CSS -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">

    <!-- Lien vers Bootstrap JS -->
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="public/js/script.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Liste des utilisateurs</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Département</th>
                    <th>Âge</th>
                    <th>Admin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u['lastname_user']) ?></td>
                        <td><?= htmlspecialchars($u['firstname_user']) ?></td>
                        <td><?= htmlspecialchars($u['mail_user']) ?></td>
                        <td><?= htmlspecialchars($u['departement_user']) ?></td>
                        <td><?= htmlspecialchars($u['age_user']) ?></td>
                        <td><?= $u['is_admin'] ? 'Oui' : 'Non' ?></td>
                        <td>
                            <?php if (
                                !$u['is_admin'] &&
                                $u['id_user'] != $_SESSION['user']['id_user']
                            ): ?>
                                <a href="index.php?action=admin_modifier&id=<?= $u['id_user'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="index.php?action=admin_supprimer&id=<?= $u['id_user'] ?>"
                                    class="btn btn-danger btn-sm supprimer-utilisateur">
                                    Supprimer
                                </a>
                            <?php else: ?>
                                <span class="text-muted">Aucune action</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php?action=espace" class="btn btn-secondary">Retour à mon espace</a>
    </div>
</body>

</html>