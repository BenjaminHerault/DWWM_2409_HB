<?php
// Script pour crypter un mot de passe

// Le mot de passe en clair
$motDePasseClair = "Espadon25";

// Cryptage du mot de passe avec password_hash()
$motDePasseCrypte = password_hash($motDePasseClair, PASSWORD_DEFAULT);

// Affichage avec echo
echo "Mot de passe en clair : " . $motDePasseClair . "<br>";
echo "Mot de passe crypté : " . $motDePasseCrypte . "<br>";

// Vérification que le cryptage fonctionne
if (password_verify($motDePasseClair, $motDePasseCrypte)) {
    echo "<br>✅ La vérification du mot de passe fonctionne !";
} else {
    echo "<br>❌ Erreur dans la vérification du mot de passe.";
}
