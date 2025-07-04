<?php

?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Carousel Template Bootstrap</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Le styles -->
  <link href="public/css/bootstrap.css" rel="stylesheet">
  <link href="public/css/bootstrap-theme.min.css" rel="stylesheet">
  <link href="public/css/global.css" rel="stylesheet">

  <?php
  // Système de chargement CSS intelligent selon l'action
  $action = $_GET['action'] ?? 'liste';

  // Mapping des CSS par action
  $cssFiles = [
    'liste' => ['liste-biens.css', 'accueil.css'], // Page d'accueil avec liste
    'details' => ['detail-bien.css'],
    'connexion' => ['connexion.css']
  ];

  // Chargement des CSS spécifiques à l'action avec vérification d'existence
  if (isset($cssFiles[$action])) {
    foreach ($cssFiles[$action] as $cssFile) {
      $cssPath = __DIR__ . '/../public/css/' . $cssFile;
      if (file_exists($cssPath)) {
        echo '<link href="public/css/' . $cssFile . '" rel="stylesheet">' . PHP_EOL . '  ';
      } else {
        // En mode développement, on peut loguer l'erreur
        error_log("CSS file not found: " . $cssPath);
      }
    }
  }
  ?>

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

  <!-- Fav and touch icons -->
  <!--  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">-->
</head>