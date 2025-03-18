<?php
$nomPrenom = "";
if (isset($_POST["nom_prenom"]) && ($_POST["nom_prenom"] != "")) {
    $nomPrenom = ($_POST["nom_prenom"]);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta
        name="viewport"
        content="width=device-width, 
    initial-scale=1.0" />
    <!-- titre de la page -->
    <title>Cours HTML de zéro</title>
    <!-- Icone de l'anglet -->
    <link rel="shortcut icon" href="./icone.jpg" />
</head>

<body>
    <nav>
        <!-- UL = Unordered List -->
        <ul>
            <li>Accueil</li>
            <li>Boutique</li>
            <li>Formulaire</li>
        </ul>
    </nav>
    <header>
        <!-- h1 a h6 sont des titre -->
        <!-- un seul h1 par page  -->
        <h1>Ceci est le tire principal</h1>
        <p>
            Texte classique
            <em>Texte en italique </em>
            <strong>Texte en gras</strong>
        </p>
        <!--Lorem = pour genere du texte-->
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse accusamus
            in, quo blanditiis eaque adipisci quidem possimus quod nam repellat
            minus temporibus tenetur sed iste architecto reprehenderit inventore
            vero voluptatibus!
        </p>
    </header>

    <main>
        <section>
            <h2>Ordered List</h2>
            <ol>
                <li>Ceci est une</li>
                <li>liste dans</li>
                <li>l'ordre</li>
            </ol>
        </section>

        <section>
            <h3>Image en HTML</h3>
            <img src="./bg.webp" height="400"
                alt="image-section"> <!-- alt= pour les personne mal voyant et l'accessibilite-->

            <div>
                <h4>Tableaux</h4>
                <table border="4"
                    cellpadding="10"
                    cellspacing="4"
                    style="text-align: center;">
                    <!-- thead est pour l'entete du tableau -->
                    <thead>
                        <tr>
                            <th>Col 1</th>
                            <th>Col 2</th>
                            <th>Col 3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Cell 1</td>
                            <td>Cell 2</td>
                            <td>Cell 3</td>
                        </tr>
                        <tr>
                            <td>Cell 4</td>
                            <td>Cell 5</td>
                            <td>Cell 6</td>
                        </tr>
                        <tr>
                            <td>Cell 7</td>
                            <td>Cell 8</td>
                            <td>Cell 9</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <div>
            <form action="" method="post">
                <p>
                    <label for="nom_prenom">
                        Nom Prenom
                    </label>
                    <input type="text" id="nom_prenom" name="nom_prenom">
                </p>
                <p>
                    <input type="submit" value="Ok">
                </p>
            </form>
        </div>
        <div>
            <p>
                <?php
                echo $nomPrenom;
                ?>
            </p>
        </div>
    </main>
    <footer></footer>
</body>

</html>