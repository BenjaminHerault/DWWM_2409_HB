<?php

require_once __DIR__ . '/src/dao/CandidateRepository.php';
require_once __DIR__ . '/src/dao/Dbconnect.php';
require_once __DIR__ . '/src/dao/DepartRepository.php';

// Récupération des départements pour la liste déroulante
$departRepo = new DepartRepository();
$departements = $departRepo->searchAll();

$candidateRepo = new CandidateRepository();

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $mail = filter_var(trim($_POST['mail']), FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $departement = intval($_POST['departement']);
    $age = intval($_POST['age']);

    // Vérification des champs (exemple simple)
    if ($lastname && $firstname && $mail && $password && $password_confirm && $departement && $age) {
        if ($password === $password_confirm) {
            $ok = $candidateRepo->createCandidate($lastname, $firstname, $mail, $password, $departement, $age);
            $message = $ok ? "Inscription réussi !" : "Erreur lors de l'inscription.";
        } else {
            $message = "Les mots de passe ne correspondent pas.";
        }
    } else {
        $message = "Merci de remplir tous les champs correctement.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.prod.js"></script>
    <script src="src/js/password-strength.js" type="module"></script>
    <title>Inscription Jeu-Concours</title>
</head>

<body class="bg-light">
    <div id="app">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h2 class="mb-4 text-center">Inscription au jeu-concours</h2>
                    <?php if ($message): ?>
                        <div id="message-alert"
                            class="alert <?= strpos($message, 'réussi') !== false ? 'alert-success' : 'alert-danger' ?>">
                            <?= $message ?>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="" class="border p-4 bg-white rounded shadow-sm">
                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" name="lastname" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="firstname" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="mail" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mot de passe</label>
                            <div class="input-group">
                                <input :type="showPassword ? 'text' : 'password'" name="password" class="form-control" v-model="password" required>
                                <span class="input-group-text" style="cursor:pointer;" @click="showPassword = !showPassword">
                                    <i :class="showPassword ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                                </span>
                            </div>
                            <div class="password-strength-bar" :class="barClass" :style="{width: barWidth}"></div>
                            <div class="password-strength-text" :class="textClass">{{ strengthText }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirmer le mot de passe</label>
                            <div class="input-group">
                                <input :type="showPasswordConfirm ? 'text' : 'password'" name="password_confirm" class="form-control" v-model="password_confirm" required>
                                <span class="input-group-text" style="cursor:pointer;" @click="showPasswordConfirm = !showPasswordConfirm">
                                    <i :class="showPasswordConfirm ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                                </span>
                            </div>
                            <div class="password-strength-bar" :class="confirmBarClass" :style="{width: confirmBarWidth}"></div>
                            <div class="password-strength-text" :class="confirmTextClass">{{ confirmStrengthText }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Département</label>
                            <select name="departement" class="form-select" required>
                                <option value="">--Choisir--</option>
                                <?php foreach ($departements as $dep): ?>
                                    <option value="<?= htmlspecialchars($dep['id_dep']) ?>"><?= htmlspecialchars($dep['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Âge</label>
                            <input type="number" name="age" min="1" max="130" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
                        <div class="text-center mt-3">
                            <span>Déjà inscrit ?</span>
                            <a href="src/public/login.php" class="btn btn-link">Se connecter</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>