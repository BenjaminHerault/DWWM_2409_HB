<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mon profil</title>
</head>

<body>
    <h1>Mon profil</h1>
    <ul>
        <li><strong>ID :</strong> <?= htmlspecialchars($user['id']) ?></li>
        <li><strong>Nom :</strong> <?= htmlspecialchars($user['name_']) ?></li>
        <li><strong>Email :</strong> <?= htmlspecialchars($user['mail_user']) ?></li>
    </ul>
    <a href="index.php?action=liste">Retour à la liste</a>
    <a href="index.php?action=modifierProfil">Modifier mon profil</a>
</body>

</html>