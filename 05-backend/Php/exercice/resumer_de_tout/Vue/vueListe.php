<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des utilisateurs</title>
</head>

<body>
    <?php if (isset($_SESSION['user'])): ?>
        <a href="index.php?action=profil">Mon profil</a>
    <?php endif; ?>
    <a href="index.php?action=connexion">Se connecter</a>
    <h1>Utilisateurs</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($utilisateurs as $u): ?>
            <tr>
                <td><?= htmlspecialchars($u['id']) ?></td>
                <td><?= htmlspecialchars($u['name_']) ?></td>
                <td><?= htmlspecialchars($u['mail_user']) ?></td>
                <td>
                    <!-- Formulaire de suppression -->
                    <form method="post" action="index.php?action=supprimer" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $u['id'] ?>">
                        <button type="submit" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
                    </form>
                    <!-- Formulaire de modification (inline) -->
                    <form method="post" action="index.php?action=modifier" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $u['id'] ?>">
                        <input type="text" name="name" value="<?= htmlspecialchars($u['name_']) ?>" required>
                        <input type="email" name="mail" value="<?= htmlspecialchars($u['mail_user']) ?>" required>
                        <input type="password" name="password" placeholder="Nouveau mot de passe (optionnel)">
                        <button type="submit">Modifier</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Créer un nouvel utilisateur</h2>
    <form method="post" action="index.php?action=creer">
        <input type="text" name="name" placeholder="Nom" required>
        <input type="email" name="mail" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Créer</button>
    </form>
</body>

</html>