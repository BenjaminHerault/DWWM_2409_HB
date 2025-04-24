<?php
// Fonction qui retourne le nom de l'inventeur de la formule "E = MC²" en majuscules
function getMC2(): string
{
    return "Albert Einstein" . PHP_EOL; 
}
echo getMC2(); // Affiche "ALBERT EINSTEIN"

// Fonction qui retourne le nom et le prénom concaténés
function getUserName($nom, $prenom): string
{
    return $nom . ' ' . $prenom . PHP_EOL; // Concatène le nom et le prénom avec un espace
}
echo getUserName("Harkel", "benji"); // Affiche "herault benjamin"

// Fonction qui retourne le nom et le prénom en majuscules
function getFullName($nom, $prenom): string
{
    return ucfirst(strtolower($prenom))." ".strtoupper($nom); // Convertit le nom et le prénom en majuscules
}
echo getFullName("Harkel", "benji"); // Affiche "HERAULT BENJAMIN"

function askUser(string $nom, string $prenom): string
{ //$test=; // Appel de la fonction getMC2() pour récupérer le nom de l'inventeur
    $coupe = strrchr(getMC2()," ");
    return PHP_EOL."Bonjour " . getFullName($nom, $prenom) . ", Connaissez-vous" . $coupe . " ?"; // Concatène le nom et le prénom avec un espace
}
echo askUser("Harkel", "benji");