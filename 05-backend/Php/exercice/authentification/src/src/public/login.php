<?php

require_once __DIR__ . '/../dao/CandidateRepository.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = trim($_POST['mail']);
    $password = $_POST['password'];

    $repo = new CandidateRepository();

    $utilisateur = $repo->signIn($mail, $password);
    if ($utilisateur) {
        session_start();
        $_SESSION['id_user'] = $utilisateur['id_user'];
        $_SESSION['nom'] = $utilisateur['nom'];
        $_SESSION['prenom'] = $utilisateur['prenom'];
        $_SESSION['email'] = $utilisateur['email'];
        $_SESSION['departement'] = $utilisateur['departement'];
        $_SESSION['age'] = $utilisateur['age'];
        header('Location: ../../accueil.php');
        exit;
    } else {
        $message = "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">

</head>

<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h2 class="mb-4 text-center">Connexion</h2>
                    <?php if ($message): ?>
                        <div class="alert <?= strpos($message, 'réussie') !== false ? 'alert-success' : 'alert-danger' ?>">
                            <?= $message ?>
                        </div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3">
                            <input type="email" name="mail" class="form-control" required placeholder="Adresse email">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" required placeholder="Mot de passe">
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">
                                    Souviens-toi de moi
                                </label>
                            </div>
                            <a href="#" class="text-decoration-none">Mot de passe oublié ?</a>
                        </div>
                        <button type="submit" class="btn login-btn w-100 mb-3">SE CONNECTER</button>
                    </form>
                    <div class="text-center mb-2">
                        vous inscrire ? <a href="../../inscription.php" class="text-primary text-decoration-none">S'inscrire</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>