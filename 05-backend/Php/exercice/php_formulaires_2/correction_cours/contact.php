<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de contact</title>
</head>

<body>
    <h1>Formulaire de contact</h1>
    <form action="traitement-contact.php" method="post">

        <div>
            <label for="monNom">Votre Nom :</label>
            <input type="text" id="monNom" name="nom" required>
        </div>
        <div>
            <label for="maDate">Votre Date de naissance :</label>
            <input type="date" id="maDate" name="dateDeNaissance" required>
        </div>
        <div>
            <label for="monEmail">Votre Adresse email :</label>
            <input type="email" id="monEmail" name="email" required>
        </div>
        <div>
            <label for="monMessage">Votre message :</label>
            <textarea id="monMessage" name="message" required></textarea>
        </div>

        <button type="submit">Envoyer</button>
    </form>
</body>

</html>