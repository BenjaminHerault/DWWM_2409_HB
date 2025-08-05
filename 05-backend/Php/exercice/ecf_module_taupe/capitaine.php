<?php

session_start();
if (!isset($_SESSION['level_scientist']) || $_SESSION['level_scientist'] != 1) {
    echo "Accès refusé";
    exit;
}

require_once __DIR__ . '/models/ScientistRepository.php';
$repo = new scientistRepository();
$scientist = $repo->searcheAll();
?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace réservé aux scientifiques autorisés</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            /* Espace entre les cartes */
            background-color: #f4f4f4;
            padding: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 600px;
            /* Largeur fixe pour les cartes */
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            /* Effet au survol */
        }

        .card img {
            width: 100%;
            height: 200px;
            /* Hauteur fixe pour les images */
            object-fit: cover;
            /* S'assure que l'image couvre l'espace sans déformation */
            border-bottom: 1px solid #eee;
        }

        .card-content {
            padding: 15px;
        }

        .card-content h3 {
            margin-top: 0;
            color: #333;
        }

        .card-content p {
            color: #555;
            font-size: 0.9em;
            line-height: 1.5;
        }
    </style>
</head>

<body>
    <div class="card">
        <p><?php echo "Bienvenue M(e) " . $_SESSION["firstname_scientist"] . " " . $_SESSION["lastname_scientist"]; ?></p>
        <p>Cher confrère
            Bienvenue sur notre page de présentation et de localisation de notre invention révolutionnaire :
            l’excavatrice de poche nommé « La Taupe » piloté par un conducteur et un navigateur mécanicien.</p>
    </div>

    <main>
        <div class="card">
            <img src="img/excavatrice_taupe.png" alt="Excavatrice de poche">
            <div class="card-content">
                <h3>Excavatrice de poche dit "La Taupe"</h3>
                <p>Ceci est une brève description pour la première image. Elle donne un aperçu la machine, du prototype du professeur MORTIMER surnommée "La Taupe" pour creuser des galeries dans tous types des roches kartisques et calcaires .</p>
            </div>
        </div>

        <div class="card">
            <img src="img/localisation1.png" alt="localisation de La Taupe">
            <div class="card-content">
                <h3>Localisation du prototype "La Taupe" au Royaumes Unis</h3>
                <p>La machine se trouve dans une des grottes de Cornouaille en Angleterre près de la baie du village de "PERRANPORT" </p>
            </div>
        </div>
    </main>
</body>

</html>