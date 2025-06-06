<h1>Modifier mon profil</h1>
<form method="post" action="index.php?action=modifierProfil">
    <input type="text" name="name" value="<?= isset($user['name']) ? htmlspecialchars($user['name']) : '' ?>" required>
    <input type="email" name="mail" value="<?= isset($user['mail']) ? htmlspecialchars($user['mail']) : '' ?>" required>
    <input type="password" name="password" placeholder="Nouveau mot de passe (laisser vide pour ne pas changer)">
    <button type="submit">Enregistrer</button>
</form>
<a href="index.php?action=profil">Annuler</a>