<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello World</title>
</head>
<body>
    <h1>Bienvenue sur ma page</h1>
    <?php
    /**
     * Affiche "Hello World !"
     */
    function helloWorld():void
    {
        echo "<p>Hello World !</p>";
    }

    //test de la fonction (la fonction affiche directement le résultat)
    helloWorld();
    ?>
    
</body>
</html>