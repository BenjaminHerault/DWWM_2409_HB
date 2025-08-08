<?php

require_once __DIR__ . '/models/ScientistRepository.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail_scientist = trim($_POST['mail_scientist']);
    $pass_scientist = $_POST['pass_scientist'];

    $repo = new ScientistRepository();

    $utilisateur = $repo->signIn($mail_scientist, $pass_scientist);
    // var_dump($utilisateur);
    if ($utilisateur) {
        session_start();
        $_SESSION['id_scientist'] = $utilisateur['id_scientist'];
        $_SESSION['lastname_scientist'] = $utilisateur['lastname_scientist'];
        $_SESSION['firstname_scientist'] = $utilisateur['firstname_scientist'];
        $_SESSION['mail_scientist'] = $utilisateur['mail_scientist'];
        $_SESSION['level_scientist'] = $utilisateur['level_scientist'];

        if ($utilisateur['level_scientist'] == 2) {
            header('Location: ./taupe.php');
        } else {
            header('Location: ./capitaine.php');
        }
        exit;
    } else $message = "Identifiants incorrects.";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface d'authentification pour scientifiques habilités</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap-grid.min.css">
</head>

<body>

    <head>
        <nav>

        </nav>
    </head>
    <main class="bg-light">
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
                        <form method="post" action="index.php?action=connexion">
                            <div class="mb-3">
                                <input type="email" name="mail_scientist" class="form-control" required placeholder="Adresse email">
                            </div>
                            <div class="mb-3">
                                <input type="password" name="pass_scientist" class="form-control" required placeholder="Mot de passe">
                            </div>
                            <button type="submit" class="btn login-btn w-100 mb-3">SE CONNECTER</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>

    </footer>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>