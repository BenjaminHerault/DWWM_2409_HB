<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// Vérifier que l'utilisateur est connecté
if (
    !isset($_SESSION['nom']) ||
    !isset($_SESSION['prenom']) ||
    !isset($_SESSION['email']) ||
    !isset($_SESSION['departement']) ||
    !isset($_SESSION['age']) ||
    !isset($_SESSION['id_user'])
) {
    echo "Accès refusé. Veuillez vous connecter.";
    exit;
}
// Suppression du compte utilisateur
if (isset($_POST['delete_account'])) {
    require_once __DIR__ . '/src/dao/CandidateRepository.php';
    $repo = new CandidateRepository();
    $repo->deleteCandidate($_SESSION['id_user']);
    session_unset();
    session_destroy();
    header("Location: inscription.php");
    exit;
}

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['delete_account'])) {
    require_once __DIR__ . '/src/dao/CandidateRepository.php';
    $repo = new CandidateRepository();
    $id_user = $_SESSION['id_user'];
    $ok = $repo->updateCandidate(
        $id_user,
        $_POST['lastname'],
        $_POST['firstname'],
        $_POST['mail'],
        $_POST['password'] ?: null,
        (int)$_POST['departement'],
        (int)$_POST['age']
    );
    if ($ok) {
        $_SESSION['nom'] = $_POST['lastname'];
        $_SESSION['prenom'] = $_POST['firstname'];
        $_SESSION['email'] = $_POST['mail'];
        $_SESSION['departement'] = $_POST['departement'];
        $_SESSION['age'] = $_POST['age'];
        header("Location: accueil.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de la mise à jour.</div>";
    }
}

// Récupérer les informations de session
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$email = $_SESSION['email'];
$departement = $_SESSION['departement'];
$age = $_SESSION['age'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Accueil</title>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">
                            Bienvenue <?php echo htmlspecialchars($prenom . ' ' . $nom); ?> !
                        </h1>
                        <ul class="list-group mb-4">
                            <li class="list-group-item"><strong>Email :</strong> <?php echo htmlspecialchars($email); ?></li>
                            <li class="list-group-item"><strong>Département :</strong> <?php echo htmlspecialchars($departement); ?></li>
                            <li class="list-group-item"><strong>Âge :</strong> <?php echo htmlspecialchars($age); ?> ans</li>
                            <li class="list-group-item">
                                <strong>Carte du département :</strong>
                                <div class="mt-3">
                                    <iframe
                                        width="100%"
                                        height="250"
                                        style="border:0"
                                        loading="lazy"
                                        allowfullscreen
                                        referrerpolicy="no-referrer-when-downgrade"
                                        src="https://www.google.com/maps?q=<?php echo urlencode('Département ' . $departement . ', France'); ?>&output=embed">
                                    </iframe>
                                </div>
                            </li>
                        </ul>
                        <div class="text-center mb-2">
                            <a href="deconnexion.php" class="btn btn-danger">Déconnexion</a>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                                Modifier mon profil
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Bootstrap pour modification du profil -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Modifier mon profil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <input type="text" class="form-control" name="lastname" value="<?php echo htmlspecialchars($nom); ?>" required placeholder="Nom">
                        </div>
                        <div class="mb-2">
                            <input type="text" class="form-control" name="firstname" value="<?php echo htmlspecialchars($prenom); ?>" required placeholder="Prénom">
                        </div>
                        <div class="mb-2">
                            <input type="email" class="form-control" name="mail" value="<?php echo htmlspecialchars($email); ?>" required placeholder="Email">
                        </div>
                        <div class="mb-2">
                            <input type="password" class="form-control" name="password" placeholder="Nouveau mot de passe (laisser vide)">
                        </div>
                        <div class="mb-2">
                            <input type="number" class="form-control" name="departement" value="<?php echo htmlspecialchars($departement); ?>" required placeholder="Département">
                        </div>
                        <div class="mb-2">
                            <input type="number" class="form-control" name="age" value="<?php echo htmlspecialchars($age); ?>" required placeholder="Âge">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                </form>
                <form method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer votre compte ? Cette action est irréversible.');">
                    <button type="submit" name="delete_account" class="btn btn-danger mt-2">Supprimer mon compte</button>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>