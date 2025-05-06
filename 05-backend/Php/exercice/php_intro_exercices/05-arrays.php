<?php
$names=['Joe', 'Jack', 'Léa', 'Zoé', 'Néo' ];

function firstItem(array $names): ?string
{
    if (empty($names))return null; // Retourne null si le tableau est vide
    return $names[0]; // Retourne le premier élément du tableau
}
echo firstItem($names)."\n";

// Test avec un tableau vide
$emptyArray = [];
var_export(firstItem($emptyArray)); // Affiche "null" 
/*
Contrairement à echo, qui ne peut pas afficher null directement, var_export() affiche une représentation textuelle de la valeur, même si c'est null. Cela est utile pour le débogage.
*/

function lastItem(array $names): ?string
{
    if (empty($names))return null; // Retourne null si le tableau est vide
    return $names[count($names)-1]; // Retourne le dernier élément du tableau
}
echo "\n".lastItem($names)."\n";
/*La fonction count() retourne le nombre total d'éléments dans le tableau $names.*/

function sortItems(array $names): array
{
    rsort($names); // Trie le tableau par ordre alphabétique
    return $names; // Retourne le tableau trié
}
print_r (sortItems($names))."\n";

function strigItems($names)
{
    sort($names); // Trie le tableau par ordre alphabétique
    return $names; // Retourne le tableau trié
}
echo "\n".implode(", ", strigItems($names))."\n"; // implode() convertit le tableau en chaîne de caractères, séparant les éléments par une virgule et un espace.