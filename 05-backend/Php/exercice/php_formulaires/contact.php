<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de contact</title>
</head>

<body>
    <h1>Formulaire de contact</h1>
    <form action="traitement-contact.php" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="date_naissance">Date de naissance :</label>
        <input type="date" id="date_naissance" name="date_naissance" required><br><br>

        <label for="email">Adresse email :</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="message">Message :</label>
        <textarea id="message" name="message" required></textarea><br><br>

        <button type="submit">Envoyer</button>
    </form>
</body>

</html>