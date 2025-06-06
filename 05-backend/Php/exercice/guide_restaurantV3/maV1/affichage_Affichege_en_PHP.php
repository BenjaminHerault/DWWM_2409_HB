<?php

try 
{
    $connect = new PDO('mysql:host=localhost;port=3306;dbname=guide;charset=utf8', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    /*
    est utilisée pour configurer le comportement de gestion des erreurs pour l'objet PDO ($connect).

    PDO::ATTR_ERRMODE :
C'est une constante de PDO qui définit le mode de gestion des erreurs.
Elle permet de spécifier comment PDO doit réagir lorsqu'une erreur survient (par exemple, une erreur de requête SQL).

    PDO::ERRMODE_EXCEPTION :
C'est une constante qui indique que PDO doit lever une exception (PDOException) en cas d'erreur.
Cela permet de capturer et de gérer les erreurs dans un bloc try-catch.

    Pourquoi l'utiliser ?
Par défaut, PDO ne lève pas d'exception en cas d'erreur. Il retourne simplement false ou une erreur silencieuse, ce qui peut rendre le débogage difficile.
En activant PDO::ERRMODE_EXCEPTION, vous forcez PDO à signaler les erreurs de manière explicite, ce qui facilite leur gestion et leur correction.
    */ 
} 
catch (Exception $e) 
{
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Requête préparée
$rq = "SELECT id, nom, adresse, prix, commentaire, note, visite FROM restaurants";

try 
{
    $stmt = $connect->prepare($rq);
    $test = $stmt->execute();

    if ($test == true) 
    {
        $tabglobal = $stmt->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($tabglobal); $i++) 
        {
            echo 
            "ID : ". $tabglobal[$i]["id"]. PHP_EOL .
            "nom : " . $tabglobal[$i]["nom"] . PHP_EOL .
            "adresse : " . $tabglobal[$i]["adresse"] . PHP_EOL .
            "prix : " . $tabglobal[$i]["prix"].'€' . PHP_EOL .
            "commentaire : " . $tabglobal[$i]["commentaire"] . PHP_EOL .
            "note : " .$tabglobal[$i]["note"] .  PHP_EOL .
            "Visite : " .$tabglobal[$i]["visite"]. PHP_EOL;
        }
    } 
    else 
    {
        echo "La requête a échoué";
    }
} 
catch (PDOException $e) 
{
    die("Erreur lors de l'exécution de la requête : " . $e->getMessage());
}