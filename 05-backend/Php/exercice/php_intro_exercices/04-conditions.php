<?php

function isMajor($age): bool // Correction du type de retour en bool
{
    if ($age < 18) return false; // mineur
    else return true; // majeur
}

// Utilisation de var_export pour afficher "true" ou "false"
echo var_export(isMajor(17), true) . PHP_EOL; // Affiche "false"
echo var_export(isMajor(18), true) . PHP_EOL; // Affiche "true"
echo var_export(isMajor(19), true) . PHP_EOL; // Affiche "true"

function getRetired(int $age): string
{
    if ($age < 0) return "Vous n'êtes pas encore né !"; // Cas où l'âge est négatif
    if ($age < 60) {
        $annerRestantes = 60 - $age; // Calcul des années restantes avant la retraite
        return "Il vous reste $annerRestantes ans avant la retraite.";
    }
    if ($age > 60) {
        $annerDepuis = $age - 60; // Calcul des années depuis la retraite
        return "Vous êtes à la retraite depuis $annerDepuis ans.";
    }
    return "Vous êtes à la retraite cette année."; // Cas où l'âge est exactement 60
}

// Appels de la fonction avec différents âges
echo getRetired(12) . PHP_EOL; // Affiche "Il vous reste 48 ans avant la retraite."
echo getRetired(60) . PHP_EOL; // Affiche "Vous êtes à la retraite cette année."
echo getRetired(72) . PHP_EOL; // Affiche "Vous êtes à la retraite depuis 12 ans."
echo getRetired(-2) . PHP_EOL; // Affiche "Vous n'êtes pas encore né !"

function getMax(float $a, float $b, float $c): float
{
    // Vérifie si au moins deux des valeurs sont égales
    if ($a === $b || $a === $c || $b === $c) return 0; // Retourne 0 si au moins deux valeurs sont égales
   

    // Trouve le plus grand des trois nombres
    $max = max($a, $b, $c);

    // Limite le résultat à 3 décimales
    return round($max, 3);
}

// Appels de la fonction avec différents ensembles de valeurs
echo getMax(1.2345, 2.3456, 3.4567) . PHP_EOL; // Affiche "3.457"
echo getMax(5.6789, 5.6789, 3.4567) . PHP_EOL; // Affiche "0" (deux valeurs sont égales)
echo getMax(7.8912, 6.5432, 7.8912) . PHP_EOL; // Affiche "0" (deux valeurs sont égales)
echo getMax(1.1111, 2.2222, 3.3333) . PHP_EOL; // Affiche "3.333"

function captitalCity($pays): string
{
    switch ($pays){
        case 'France':
            return 'Paris';
        case 'Allemagne':
            return 'Berlin';
        case 'Italie':
            return 'Rome';
        case 'Maroc':
            return 'Rabat';
        case 'Espagne':
            return 'Madrid';
        case 'Portugal':
            return 'Lisbonne';
        case 'Angleterre':
            return 'Londres';
        default:
            return 'Capitale inconnue';
    }
}
echo captitalCity('France') . PHP_EOL; // Affiche "Paris"
echo captitalCity('Allemagne') . PHP_EOL; // Affiche "Berlin"
echo captitalCity('Italie') . PHP_EOL; // Affiche "Rome"
echo captitalCity('Maroc') . PHP_EOL; // Affiche "Rabat"
echo captitalCity('Espagne') . PHP_EOL; // Affiche "Madrid"
echo captitalCity('Portugal') . PHP_EOL; // Affiche "Lisbonne"  
echo captitalCity('Angleterre') . PHP_EOL; // Affiche "Londres"
echo captitalCity('Suisse') . PHP_EOL; // Affiche "Capitale inconnue"