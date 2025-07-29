<?php
// Inclusion de la classe Repository
require_once __DIR__ . '/models/DapartRepository.php';

// Instanciation du repository
$departRepository = new DapartRepository();

// Récupération des départements disponibles
$depDisponibles = $departRepository->getDepartementsDisponibles();

// Récupération des touts les départements 
//$depDisponibles = $departRepository->searchAll();


// Inclusion de la classe InstitutionRepository
require_once __DIR__ . '/models/InstitutionRepository.php';
$institutionRepository = new InstitutionRepository();

// Récupération des institutions
$institutions = $institutionRepository->searchAll();
?>
<!doctype html>
<html lang="Fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Entrainement Centre de Readaptation</title>
    <!-- Bootstrap CSS depuis CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tes styles personnalisés -->
    <link rel="stylesheet" media="screen" href="css/style.css">
    <link href="public/css/global.css" rel="stylesheet">
</head>

<body>
    <div id="page">
        <div id="header">
            <img src="contenu/header.jpg" width="980" height="176" alt="colblanc entete">
        </div>

        <div id="menu">
            <ul>
                <li><a href="#">Entreprises</a>
                    <ul>
                        <li><a href="#" target="_self">Visualiser</a>
                        </li>
                        <li><a href="filtre.php">Rechercher</a>
                        </li>
                        <li><a href="#">Ajouter</a>
                        </li>
                    </ul>
                </li>
                <li><a href="#">Candidats</a>
                    <ul>
                        <li><a href="#" target="_self">Listing</a>
                        </li>
                        <li><a href="#">rechercher</a>
                        </li>
                        <li><a href="#">Ajouter</a>
                        </li>
                        <li><a href="#">CVthèque</a>
                        </li>
                    </ul>
                </li>
                <li><a href="#">Projets</a>

                </li>
                <li><a href="#">offres</a>
                    <ul>

                        <li><a href="#">Par secteur</a>

                        </li>

                        <li><a href="#">Par entreprises</a>

                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <main>
            <div class="container biens-container">
                <div class="row">
                    <div class="col-12">
                        <!-- Formulaire simple -->
                        <div class="card filter-card">
                            <div class="card-body">
                                <form action="index.php?action=liste" method="get" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <input type="hidden" name="lib_cat" value="" id="lib_cat" />
                                            <label for="depList" class="form-label filter-label">Choisisser votre dépatement</label>
                                            <select name="depList" id="depList" class="form-select">
                                                <option value="">Tous les départements</option>
                                                <?php foreach ($depDisponibles as $dep) : ?>
                                                    <option value="<?= htmlspecialchars($dep['id_dep']) ?>" <?php if (isset($_GET['depList']) && $_GET['depList'] == $dep['id_dep']) echo 'selected'; ?>>
                                                        <?= htmlspecialchars($dep['dep_nom']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <article>
            <div class="container mt-5">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nom de l'établissement</th>
                            <th>Type</th>
                            <th>Nom du responsable</th>
                            <th>Lieu</th>
                            <th>Téléphone</th>
                            <th>E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($institutions as $institution) : ?>
                            <tr>
                                <td><?= htmlspecialchars($institution['nom_etab'] ?? '') ?></td>
                                <td><?= htmlspecialchars($institution['type_etab'] ?? '') ?></td>
                                <td><?= htmlspecialchars($institution['nom_resp'] ?? '') ?></td>
                                <td><?= htmlspecialchars($institution['adresse'] ?? '') ?></td>
                                <td><?= htmlspecialchars($institution['mobile'] ?? '') ?></td>
                                <td><?= htmlspecialchars($institution['email'] ?? '') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </article>

        <footer>
            Copyright
        </footer>
    </div>

    <!-- Bootstrap JS depuis CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>