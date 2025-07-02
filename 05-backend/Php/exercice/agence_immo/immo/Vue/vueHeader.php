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
  $cssFiles = [
    'liste' => 'liste-biens.css',
    'details' => 'detail-bien.css',
    'admin' => 'admin.css',
    'connexion' => 'connexion.css'
  ];

  if (isset($cssFiles[$action])) {
    echo '<link href="public/css/' . $cssFiles[$action] . '" rel="stylesheet">';
  }

  // CSS spécifique pour l'accueil (page par défaut)
  if ($action === 'liste' || empty($action)) {
    echo '<link href="public/css/accueil.css" rel="stylesheet">';
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