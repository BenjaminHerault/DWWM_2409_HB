<?php
// Inclusion de la classe Repository
require_once __DIR__ . '/models/DapartRepository.php';
require_once __DIR__ . '/models/InstitutionRepository.php';

// Instanciation du repository
$departRepository = new DapartRepository();
$institutionRepository = new InstitutionRepository();

// Récupération des départements disponibles
$depDisponibles = $departRepository->getDepartementsDisponibles();
// pour la liste de tout les départements
//$depDisponibles = $departRepository->searchAll();

// Définition des colonnes à afficher dynamiquement
$colonnes = [
    'nom_etab' => 'Nom de l\'établissement',
    'type_etab' => 'Type',
    'nom_resp' => 'Nom du responsable',
    'adresse' => 'Lieu',
    'mobile' => 'Téléphone',
    'email' => 'E-mail'
];

//Récupération des filtres
$departementFiltre = isset($_GET['depList']) && !empty($_GET['depList']) ? $_GET['depList'] : null;
$typesFiltre = isset($_GET['types']) && is_array($_GET['types']) ? $_GET['types'] : [];


// Récupération des institutions avec les filtres
if ($departementFiltre === 'all' || !empty($typesFiltre)) {
    // Si "Tous les départements" est sélectionné ou si des types sont cochés
    if ($departementFiltre === 'all') {
        $departementFiltre = null; // Pour récupérer tous les départements
    } else if (is_numeric($departementFiltre)) {
        $departementFiltre = (int)$departementFiltre;
    }
    $institutions = $institutionRepository->searchWithFilters($departementFiltre, $typesFiltre);
} else {
    $institutions = []; // Si aucun filtre n'est appliqué, on affiche un tableau vide
}
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
            <br>
            <div class="container biens-container">
                <div class="row">
                    <div class="col-12">
                        <!-- Formulaire avec filtres -->
                        <div class="card filter-card">
                            <div class="card-body">
                                <form action="index.php" method="get">
                                    <div class="row">

                                        <!-- Filtre département -->
                                        <div class="col-md-4 mb-3">
                                            <input type="hidden" name="lib_cat" value="" id="lib_cat" />
                                            <label for="depList" class="form-label filter-label">Choisisser votre département</label>
                                            <select name="depList" id="depList" class="form-select">
                                                <option value="">Sélectionner un département</option>
                                                <option value="all" <?php if (isset($_GET['depList']) && $_GET['depList'] == 'all') echo 'selected'; ?>>Tous les départements</option>
                                                <?php foreach ($depDisponibles as $dep) : ?>
                                                    <option value="
                                                    <?= htmlspecialchars($dep['id_dep']) ?>"
                                                        <?php if (isset($_GET['depList']) && $_GET['depList'] == $dep['id_dep'])
                                                            echo 'selected'; ?>>
                                                        <?= htmlspecialchars($dep['dep_nom']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- Filtres types d'entreprises -->
                                        <div class="col-md-8 mb-3">
                                            <label class="form-label filter-label">type d'établissements</label>
                                            <div class="row">
                                                <?php
                                                $typesEntreprises = [
                                                    'TPE' => 'TPE',
                                                    'PME' => 'PME',
                                                    'GRANDE ENTREPRISE' => 'Grande Entreprise',
                                                    'COLLECTIVITE TER' => 'Collectivité Territoriale',
                                                    'ASSOCIATION' => 'Association',
                                                    'AUTRES (secteur public)' => 'Autres (Secteur Public)'
                                                ];
                                                ?>
                                                <?php foreach ($typesEntreprises as $valeur => $libelle) : ?>
                                                    <div class="col-md-4 mb-2">
                                                        <div class="form-check">
                                                            <input type="checkbox"
                                                                class="form-check-input"
                                                                name="types[]"
                                                                value="<?= htmlspecialchars($valeur) ?>"
                                                                id="type_<?= str_replace([' ', '(', ')'], ['_', '_', '_'], $valeur) ?>"
                                                                <?php if (
                                                                    isset($_GET['types']) &&
                                                                    in_array($valeur, $_GET['types'])
                                                                ) echo 'checked'; ?>>
                                                            <label class="form-check-label"
                                                                for="type_<?= str_replace([' ', '(', ')'], ['_', '_', '_'], $valeur) ?>">
                                                                <?= htmlspecialchars($libelle) ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Boutons -->
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">
                                                🔎Valider les filtres
                                            </button>
                                            <a href="index.php" class="btn btn-secondary ms-2">
                                                🔄️Réinitialiser
                                            </a>
                                            <span class="ms-3 text-muted">
                                                <?php if ($departementFiltre === 'all' || $departementFiltre || !empty($typesFiltre)) : ?>
                                                    <?= count($institutions) ?> résultat(s) trouvé(s)
                                                <?php else : ?>
                                                    Prêt pour la recherche
                                                <?php endif; ?>
                                            </span>
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
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <?php foreach ($colonnes as $colonne => $titre) : ?>
                                <th><?= htmlspecialchars($titre) ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($institutions) && ($departementFiltre === 'all' || $departementFiltre || !empty($typesFiltre))) : ?>
                            <tr>
                                <td colspan="<?= count($colonnes) ?>" class="text-center text-muted">
                                    Aucun résultat trouvé pour les critères sélectionnés
                                </td>
                            </tr>
                        <?php elseif (empty($institutions)) : ?>
                            <tr>
                                <td colspan="<?= count($colonnes) ?>" class="text-center text-muted">
                                    Veuillez sélectionner des critères de recherche pour afficher les résultats
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($institutions as $institution) : ?>
                                <tr>
                                    <?php foreach ($colonnes as $colonne => $titre) : ?>
                                        <td><?= htmlspecialchars($institution[$colonne] ?? '') ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
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