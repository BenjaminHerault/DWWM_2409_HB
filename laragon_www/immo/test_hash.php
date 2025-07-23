<?php
// Script de test pour vérifier le hash d'un mot de passe
//mail admin@agence.com
$motdepasse = 'motdepasse123'; // Remplacez par le mot de passe à tester
$hash = '$argon2id$v=19$m=65536,t=4,p=1$R0tPOGRzdlN0WURjYi5iag$NicLmBYOBMjAUFCf4N603wRYd/DaYcB7nHRtg57CabY'; // Remplacez par le hash copié depuis la base

if (password_verify($motdepasse, $hash)) {
    echo "OK : le mot de passe correspond au hash.";
} else {
    echo "NON : le mot de passe ne correspond pas au hash.";
}
