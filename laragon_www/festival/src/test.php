<?php
require_once __DIR__ . '/dao/CandidateRepository.php';

// Création du repository
$repo = new CandidateRepository();

// Test création d'un candidat
$result = $repo->createCandidate(
    "Durand",
    "Alice",
    "alice.durand@example.com",
    "supermotdepasse",
    68,
    30
);
echo $result ? "Insertion OK<br>" : "Erreur lors de l'insertion<br>";

// Test récupération de tous les candidats
$candidats = $repo->searchAll();
echo "<h3>Liste des candidats :</h3>";
echo "<pre>";
print_r($candidats);
echo "</pre>";

// Test recherche par âge
$age = 30;
$candidatsParAge = $repo->searchByAge($age);
echo "<h3>Candidats de $age ans :</h3>";
echo "<pre>";
print_r($candidatsParAge);
echo "</pre>";
