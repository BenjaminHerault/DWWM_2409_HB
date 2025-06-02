<?php
session_start();

// Vérifier que l'utilisateur est connecté (par exemple, que les variables existent)
if (
    !isset($_SESSION['nom']) ||
    !isset($_SESSION['prenom']) ||
    !isset($_SESSION['email']) ||
    !isset($_SESSION['departement']) ||
    !isset($_SESSION['age'])
) {
    echo "Accès refusé. Veuillez vous connecter.";
    exit;
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
                        <div class="text-center">
                            <a href="inscription.php" class="btn btn-danger">Déconnexion</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>