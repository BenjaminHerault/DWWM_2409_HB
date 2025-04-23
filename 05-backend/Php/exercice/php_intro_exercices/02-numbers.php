<?php

// Fonction qui calcule la somme de deux nombres entiers
function getSum($a, $b): int
{
    return $a + $b; // Retourne la somme des deux paramètres
}
echo getSum(5, 3) . PHP_EOL; // Affiche le résultat de la somme avec un retour à la ligne

// Fonction qui calcule la soustraction de deux nombres entiers
function getSub($c, $d): int
{
    return $c - $d; // Retourne la différence entre les deux paramètres
}
echo getSub(c: 5, d: 3) . PHP_EOL; // Affiche le résultat de la soustraction (5 - 3)
echo getSub(c: 3, d: 5) . PHP_EOL; // Affiche le résultat de la soustraction (3 - 5)

// Fonction qui calcule la multiplication de deux nombres (entiers ou flottants)
function getMulti($e, $f): float
{
    return $e * $f; // Retourne le produit des deux paramètres
}
echo getMulti(e: 5.6, f: 3) . PHP_EOL; // Affiche le résultat de la multiplication (5.6 * 3)
echo getMulti(e: 5.6, f: -3.7) . PHP_EOL; // Affiche le résultat de la multiplication (5.6 * -3.7)

// Fonction qui calcule la division de deux nombres (entiers ou flottants)
// Si le diviseur est 0, retourne 0 pour éviter une erreur
function getDiv($g, $h): float
{
    if ($h == 0) { // Vérifie si le diviseur est égal à 0
        return 0; // Retourne 0 si le diviseur est 0
    }
    return round($g / $h, 2); // Retourne le résultat de la division arrondi à 2 décimales
}
echo getDiv(g: 20, h: 3) . PHP_EOL; // Affiche le résultat de la division (20 / 3), arrondi à 2 décimales
echo getDiv(g: 20, h: 0) . PHP_EOL; // Affiche 0 car le diviseur est 0