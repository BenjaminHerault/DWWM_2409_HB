<?php
/* traitement-contact.php avec contrôle de saisie */
// Si le tableau $_POST n'est pas vide, il s'agit d'une requête de type POST
if (!empty($_POST)) {

    try {
        // Vérification que toutes les données ont bien été soumises
        // Si l'une des donnée est manquante, on affiche un message d'erreur
        if (!isset($_POST['nom'], $_POST['dateDeNaissance'], $_POST['email'], $_POST['message'])) {
            throw new Exception('Le formulaire est incomplet');
        }

        // Récupérer les données du formulaire dans des variables
        $nom = $_POST['nom'];
        $dateDeNaissance = $_POST['dateDeNaissance'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        // contrôle des données une par une

        // Si le nom ne respecte pas le format attendu : erreur
        if (!preg_match('/^[a-zA-Z]{2,}$/', $nom)) {
            throw new Exception('Le format du nom est incorrect');
        }

        // Contrôler le format de la date
        // Si le format est incorrect, Datetime lève une exception.
        $date = new DateTime($dateDeNaissance); // date fournie par l'utilisateur
        $auj = new DateTime(); // date et heure courante
        // Définit l'heure minute et seconde à 0 pour $auj (aujourd'hui)
        $auj->setTime(0, 0, 0, 0);

        // Si la date fournie est supérieure ou égale à la date du jour: erreur
        if ($date >= $auj) {
            throw new Exception('La date doit être dans le passé !');
        }

        // Si le format de l'email est incorrect : erreur
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Le format de l\'adresse e-mail est incorrect.');
        }

        // Nettoyage du message (suppression des balises HTML)
        $message = strip_tags($message);
        // Convertit les sauts de lignes en balises `<br>`
        $message = nl2br($message);

        // A partir de ce point, on estime que les données sont correctes (aucune erreur levée)

        // Afficher les données
        echo "<h2>Informations soumises :</h2>";
        echo "Nom : " . $nom . "<br>";
        echo "Date de naissance : " . $dateDeNaissance . "<br>";
        echo "Adresse Email : " . $email . "<br>";
        echo "Message : <div>" . $message . "</div><br>";
    } catch (Exception $ex) {
        // Si une erreur est levée dans le bloc "try" ci-dessus, l'erreur correspondante est affichée
        echo $ex->getMessage();
        exit;
    } // fin du try/catch 

} // fin du if !empty($_POST)