<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>

<body>
    <h1>Connexion</h1>
    <form method="post" action="index.php?action=connexion">
        <input type="email" name="mail" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
    <?php if (isset($message)) echo "<p style='color:red;'>$message</p>"; ?>
    <a href="index.php?action=liste">Retour à la liste</a>
</body>

</html>