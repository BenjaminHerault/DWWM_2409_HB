<?php

require_once __DIR__ . '/models/ScientistRepository.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail_scientist = trim($_POST['mail_scientist']);
    $pass_scientist = trim($_POST['pass_scientist']);

    $repo = new ScientistRepository();

    $utilisateur = $repo->signIn($mail_scientist, $pass_scientist);
   // var_dump($utilisateur);
    if ($utilisateur) {
        session_start();
        $_SESSION['id_scientist'] = $utilisateur['id_scientist'];
        $_SESSION['lastname_scientist'] = $utilisateur['lastname_scientist'];
        $_SESSION['firstname_scientist'] = $utilisateur['firstname_scientist'];
        $_SESSION['mail_scientist'] = $utilisateur['mail_scientist'];
        $_SESSION['level_scientist'] = $utilisateur['level_scientist'];

     
            header('Location: ./taupe.php');
        
    } else $message = "Identifiants incorrects.";
}

?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface d'authentification pour scientifiques habilités</title>
    <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap-grid.min.css"> -->
     <style>
        fieldset { 
        
            border-radius: 8px;
            background-color: #f0f2f5;
            width: 30%;
            margin-left: auto;
            margin-right: auto; 
            text-align: center;   
        }
        legend { 

            font-family: Tahoma, sans-serif;
            font-size: 1.6em;
            
        }
        input[type=email] {
            border-radius: 12px;
            color: #555;
            box-shadow: 5px 5px 7px #999;
            padding: 12px 8px;
            margin-bottom: 12px;
            margin-top: 12px;
            border: 0px;
        }
        input[type=password] 
        {
            border-radius: 12px;
            color: #555;
            box-shadow: 5px 5px 7px #999;
            padding: 12px 8px;
            border: 0px;

        }
        button
        {
        border-radius: 26px;
        color: #fff;
        background-color: #ef9400;    
        padding:12px;
        margin-top: 20px;
        border: 0px; 

        }


     </style>
</head>

<body>

    <head>
        <nav>

        </nav>
    </head>
    <main class="bg-light">
        
                      
                        <?php if ($message): ?>
                            <div class="alert <?= strpos($message, 'réussie') !== false ? 'alert-success' : 'alert-danger' ?>">
                                <?= $message ?>
                            </div>
                        <?php endif; ?>

                        <fieldset> 
                        <legend>Connexion espace scientifique:</legend>
                        <form    method="POST"  action="index.php" >
                            <div class="mb-3">
                                <input type="email" name="mail_scientist" class="" required  placeholder="Ton adresse email">
                            </div>
                            <div class="mb-3">
                                <input type="password" name="pass_scientist" class="" required placeholder="Ton mot de passe">
                            </div>
                            <button type="submit"  >CONNEXION</button>
                        </form>
                        </fieldset>
                  
    </main>
    <footer>

    </footer>
    <!-- <script src="bootstrap/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>