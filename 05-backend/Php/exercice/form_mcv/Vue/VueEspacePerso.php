<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
    <!-- Lien vers Bootstrap CSS -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">

    <!-- Lien vers Bootstrap JS -->
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <style>
        iframe {
            width: 100%;
            height: 300px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 0;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Mon Profil</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group mb-4">
                            <li class="list-group-item"><strong>Nom :</strong> <?= htmlspecialchars($user['lastname'] ?? '') ?></li>
                            <li class="list-group-item"><strong>Prénom :</strong> <?= htmlspecialchars($user['firstname'] ?? '') ?></li>
                            <li class="list-group-item"><strong>Email :</strong> <?= htmlspecialchars($user['mail'] ?? '') ?></li>
                            <li class="list-group-item"><strong>Âge :</strong> <?= htmlspecialchars($user['age'] ?? '') ?></li>
                            <li class="list-group-item"><strong>Département :</strong> <?= htmlspecialchars($user['departement'] ?? '') ?></li>
                        </ul>
                        <?php $departement = $user['departement'] ?? ''; ?>
                        <iframe
                            loading="lazy"
                            allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps?q=<?= urlencode('Département ' . $departement . ', France') ?>&output=embed">
                        </iframe>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal">Modifier mon profil</button>
                            <form method="post" action="index.php?action=supprimer" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre profil ?');">
                                <button type="submit" class="btn btn-danger">Supprimer mon profil</button>
                            </form>
                            <form method="post" action="index.php?action=deconnexion">
                                <button type="submit" class="btn btn-secondary">Déconnexion</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de modification du profil -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="post" action="index.php?action=modifier">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Modifier mon profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?= htmlspecialchars($user['lastname'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="firstname" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?= htmlspecialchars($user['firstname'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="mail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="mail" name="mail" value="<?= htmlspecialchars($user['mail'] ?? '') ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Âge</label>
                        <input type="number" class="form-control" id="age" name="age" value="<?= htmlspecialchars($user['age'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="departement" class="form-label">Département</label>
                        <input type="text" class="form-control" id="departement" name="departement" value="<?= htmlspecialchars($user['departement'] ?? '') ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS et dépendances -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>