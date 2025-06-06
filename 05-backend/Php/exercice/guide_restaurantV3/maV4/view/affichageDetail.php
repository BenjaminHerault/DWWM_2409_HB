   <?php

    require_once '../DBConnect.php';
    require_once '../RestoRepository/RestoRepository.PHP';



    $connect = getRestaurants();
    $listeresto = new RestoRepository($connect);

    // GESTION DU MESSAGE DE SUCCÈS
    // On récupère le message depuis l'URL s'il existe
    $message = '';
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
    }

    // TRAITEMENT CRÉATION JSON
    if (isset($_POST['creer_json'])) {
        $listeresto->chercherCollection();
        header("Location: " . $_SERVER['PHP_SELF'] . "?section=liste&message=" . urlencode("Fichier JSON généré dans le dossier dataobjet."));
        exit;
    }

    /*
// elle marche
var_dump($listeresto->searchAll());
*/

    // var_dump($listeresto->searchById(1))."\n";
    // var_dump($listeresto->searchById(0))."\n";
    // var_dump($listeresto->searchById("test"));
    // var_dump($listeresto->searchById(2))."\n";


    // TRAITEMENT AJOUT RESTAURANT
    // Si le formulaire d'ajout est soumis et tous les champs sont remplis
    // Traitement ajout
    if (isset($_POST['ajouter'])) {
        if (
            !empty($_POST['nom']) &&
            !empty($_POST['adresse']) &&
            !empty($_POST['prix']) &&
            !empty($_POST['commentaire']) &&
            !empty($_POST['note'])
        ) {
            $listeresto->addRow(
                $_POST['nom'],
                $_POST['adresse'],
                floatval($_POST['prix']),
                $_POST['commentaire'],
                floatval($_POST['note'])
            );

            // REDIRECTION VERS LA LISTE AVEC MESSAGE
            // On encode le message pour l'URL et on redirige vers la liste
            // Redirection vers la liste avec message
            header("Location: " . $_SERVER['PHP_SELF'] . "?section=liste&message=" . urldecode("Restaurant ajouté avec succès !"));
            exit;
        } else {
            $message = "Merci de remplir tous les champs";
        }
    }


    // TRAITEMENT SUPPRESSION RESTAURANT
    if (isset($_POST['delete_id'])) {
        $listeresto->deleteRow($_POST['delete_id']);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
    ?>
   <!DOCTYPE html>
   <html lang="FR">

   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Liste des restaurants</title>
       <link rel="stylesheet" href="../view/style.css">
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   </head>

   <body>
       <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
           <div class="container">
               <a class="navbar-brand" href="https://github.com/BenjaminHerault">Guide Restaurants</a>
               <div>
                   <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                       <li class="nav-item">
                           <a class="nav-link" href="?section=ajout">Ajouter un restaurant</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="?section=liste">Liste des restaurants</a>
                       </li>
                       <!-- Bouton pour créer le fichier JSON -->
                       <li class="nav-item">
                           <form action="" method="post" class="form-inline">
                               <button type="submit" name="creer_json" class="btn btn-success btn-sm ms-2">Créér le fichier JSON</button>
                           </form>
                       </li>
                       <!-- Bouton pour afficher le fichier JSON -->
                       <li class="nav-item">
                           <a href="../afficher_json.php" class="btn btn-success btn-sm ms-2" target="_blank">Afficher le JSON</a>
                       </li>
                   </ul>
               </div>
           </div>
       </nav>

       <main>
           <!-- AFFICHAGE DU MESSAGE DU SUCCÈS -->
           <?php if ($message): ?>
               <div class="alert alert-info" id="alert-message"><?= htmlspecialchars($message) ?></div>
           <?php endif; ?>

           <?php

            // AFFICHAGE DE LA SECTION DEMANDÉE

            $section = isset($_GET['section']) ? $_GET['section'] : 'liste';
            if ($section === 'ajout'): ?>
               <section>
                   <form method="post" class="card p-4 shadow mb-4 fiche-form">
                       <h2 class="h4 mb-4 text-center text-primary">Ajouter un restaurant</h2>
                       <div class="mb-3">
                           <label for="nom" class="form-label">Nom</label>
                           <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom du restaurant" required>
                       </div>
                       <div class="mb-3">
                           <label for="adresse" class="form-label">Adresse</label>
                           <input type="text" name="adresse" id="adresse" class="form-control" placeholder="Adresse" required>
                       </div>
                       <div class="mb-3">
                           <label for="prix" class="form-label">Prix moyen (€)</label>
                           <input type="number" step="0.01" name="prix" id="prix" class="form-control" placeholder="Prix" required>
                       </div>
                       <div class="mb-3">
                           <label for="commentaire" class="form-label">Commentaire</label>
                           <textarea name="commentaire" id="commentaire" class="form-control" placeholder="Votre avis" required></textarea>
                       </div>
                       <div class="mb-3">
                           <label for="note-range" class="form-label">Note</label>
                           <div class="d-flex align-items-center gap-2">
                               <span>1</span>
                               <input type="range" min="1" max="10" value="5" class="form-range" id="note-range" name="note" oninput="noteValue.value = this.value" required>
                               <span>10</span>
                               <output id="noteValue">5</output>
                           </div>
                       </div>
                       <div class="d-grid">
                           <button type="submit" name="ajouter" class="btn btn-primary btn-lg">Ajouter</button>
                       </div>
                   </form>
               </section>
           <?php elseif ($section === 'liste'): ?>
               <section id="liste">
                   <?php
                    echo $listeresto->rendre_hyml();
                    ?>
               </section>
           <?php endif; ?>
       </main>

       <!-- SCRIPT POUR MASQUER LE MESSAGE APRÈS 5 SECONDES -->
       <script>
           setTimeout(function() {
               var alert = document.getElementById('alert-message');
               if (alert) alert.style.display = 'none';
           }, 5000);
       </script>
       <footer class="bg-primary text-white text-center py-3">
           © <?= date('Y') ?> - Guide Restaurants
       </footer>
   </body>

   </html>
   <?php
