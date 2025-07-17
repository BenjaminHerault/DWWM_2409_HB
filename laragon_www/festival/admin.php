<?php

session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    echo "Accès refusé";
    exit;
}

require_once __DIR__ . '/src/dao/CandidateRepository.php';
$repo = new CandidateRepository();
$candidats = $repo->searchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Admin - Liste des profils</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Liste des profils inscrits</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Département</th>
                    <th>Âge</th>
                    <th>Admin</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($candidats as $candidat): ?>
                    <tr>
                        <td><?= htmlspecialchars($candidat['lastname_user']) ?></td>
                        <td><?= htmlspecialchars($candidat['firstname_user']) ?></td>
                        <td><?= htmlspecialchars($candidat['mail_user']) ?></td>
                        <td><?= htmlspecialchars($candidat['departement_user']) ?></td>
                        <td><?= htmlspecialchars($candidat['age_user']) ?></td>
                        <td><?= $candidat['is_admin'] == 1 ? 'Oui' : 'Non' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="accueil.php" class="btn btn-secondary">Retour à l'accueil</a>
    </div>
</body>

</html>