<?php
// filepath: c:\Users\bherault\Documents\GitHub\DWWM_2409_HB\05-backend\Php\exercice\authentification\src\deconnexion.php
session_start();
session_unset();
session_destroy();

// Empêche le cache navigateur
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// Redirige vers la page d'inscription ou de connexion
header("Location: inscription.php");
exit;
