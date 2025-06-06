<?php
// traitement.php
// Si la méthode HTTP de la requête est "POST"
// if (!empty($_POST)) {// Variante}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Vérification que toutes les données ont bien été soumises
        // Si l'une des donnée est manquante, on lève une exception qui sera attrapée dans le bloc "catch"
        if (!isset($_POST['nom'], $_POST['age'])) {
            throw new Exception('LE formulaire est incomplet');
        }
        //Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $age = $_POST['age'];

        // Contrôle du nom : Uniquement des lettres et entre 2 et 50 caractères
        // Si le nom ne respecte pas le format attendu : erreur
        if (!preg_match('/^[a-zA-Z]{2,50}$/', $nom)) {
            throw new Exception('Le format du nom est incorrect');
        }
        // contrôle de l'age : Doit être un entier entre 1 et 120
        // Si l'âge ne respecte pas les conditions : erreur
        if (!filter_var(
            $age,
            FILTER_VALIDATE_INT,
            ["options" => ['min_range' => 1, 'max_range' => 130]]
        )) {
            throw new Exception('L\'âge renseigné est invalide');
        }
        // Une fois les contrôles effectués, et à partir de ce point, on considère les données valides. Nous pouvons donc les exploiter.
        // Afficher les données
        echo "<h2>Informations soumises :</h2>";
        echo "Nom : " . $nom . "<br>";
        echo "Âge : " . $age . "<br>";
    } catch (Exception $ex) {
        // Si une erreur est levée dans le bloc "try" ci-dessus, l'erreur correspondante est affichée et le script s'arrête
        echo $ex->getMessage();
        exit;
    }
}
