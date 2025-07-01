<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>

<body>
    <h1>Connexion</h1>
    <form method="post" action="index.php?action=connexion">
        <label for="identifiant">e-mail</label>
        <input type="email" name="identifiant" placeholder="Email" required>

        <label for="password"></label>
        <input type="password" name="password" placeholder="Mot de passe" required>

        <button type="submit" value="je me connecte">Se connecter</button>
    </form>
    <?php if (isset($message)) echo "<p style='color:red;'>$message</p>"; ?>
    <a href="index.php?action=liste">Retour à la liste</a>
</body>

</html>