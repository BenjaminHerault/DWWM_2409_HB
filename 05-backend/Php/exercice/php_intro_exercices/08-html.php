<?php

function htmlList(string $listName, array $item): string
{
    // Vérifie si le tableau est vide
    if (empty($item)) {
        return "<h3>$listName</h3>\n<p>Aucun résultat</p>";
    }

    // Trie les éléments du tableau par ordre alphabétique
    sort($item);

    // Génère la liste HTML
    $html = "<h3>$listName</h3>\n<ul>\n";
    foreach ($item as $element) {
        $html .= "    <li>$element</li>\n";
    }
    $html .= "</ul>\n";

    return $html;
}

// Exemple d'utilisation
$names = ['Joe', 'Jack', 'Léa', 'Zoé', 'Néo'];
echo htmlList("Liste des personnes", $names);

$emptyList = [];
echo htmlList("Liste vide", $emptyList);