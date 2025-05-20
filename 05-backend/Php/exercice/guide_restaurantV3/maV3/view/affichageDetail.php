   <?php

require_once '../DBConnect.php';
require_once '../RestoRepository/RestoRepository.PHP';



$connect=getRestaurants();
$listeresto = new RestoRepository($connect);
/*
// elle marche
var_dump($listeresto->searchAll());
*/

// var_dump($listeresto->searchById(1))."\n";
// var_dump($listeresto->searchById(0))."\n";
// var_dump($listeresto->searchById("test"));
// var_dump($listeresto->searchById(2))."\n";


$message = '';
// Traitement ajout
if(isset($_POST['ajouter']))
{
    if(
        !empty($_POST['nom']) &&
        !empty($_POST['adresse']) &&
        !empty($_POST['prix']) &&
        !empty($_POST['commentaire']) &&
        !empty($_POST['note'])
    )
    {
        $listeresto->addRow(
            $_POST['nom'],
            $_POST['adresse'],
            floatval($_POST['prix']),
            $_POST['commentaire'],
            floatval($_POST['note'])
        );
        $message = "Restaurant ajouté avec succès !";
    }
    else
    {
        $message = "Merci de remplir tous les champs";
    }

}

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
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
  <div class="container">
    <a class="navbar-brand" href="#">Guide Restaurants</a>
    <div>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#ajout">Ajouter un restaurant</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#liste">Liste des restaurants</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <?php if ($message): ?>
    <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>
<form method="post" class="card p-4 shadow-sm mb-4">
    <h2 class="h5 mb-3">Ajouter un restaurant</h2>
    <div class="mb-2">
        <input type="text" name="nom" class="form-control" placeholder="Nom" required>
    </div>
    <div class="mb-2">
        <input type="text" name="adresse" class="form-control" placeholder="Adresse" required>
    </div>
    <div class="mb-2">
        <input type="number" step="0.01" name="prix" class="form-control" placeholder="Prix" required>
    </div>
    <div class="mb-2">
        <input type="text" name="commentaire" class="form-control" placeholder="Commentaire" required>
    </div>
<div class="mb-2">
    <label class="form-label">Note</label>
    <div class="d-flex justify-content-between gap-2">
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <input type="radio" class="btn-check" name="note" id="note<?= $i ?>" value="<?= $i ?>" autocomplete="off" <?= (isset($_POST['note']) && $_POST['note'] == $i) ? 'checked' : '' ?>>
            <label class="btn btn-outline-primary flex-fill" style="min-width:40px; height:40px; display:flex; align-items:center; justify-content:center;" for="note<?= $i ?>"><?= $i ?></label>
        <?php endfor; ?>
    </div>
</div>
    <button type="submit" name="ajouter" class="btn btn-success">Ajouter</button>
</form>
    <?php
    echo $listeresto->rendre_hyml();
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</body>
</html>

<?php
