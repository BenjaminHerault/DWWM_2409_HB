<?php

require_once 'Personne.php';
require_once 'Adresse.php';
require_once 'Client.php';
require_once 'Intervenant.php';
require_once 'Intervention.php';

// Création d'une adresse pour le client

$adresseClient = new Adresse(12, "Avenue des Champs-Élysées", "75008", "Paris");

// Création d'un client
$client = new Client("CL123", new DateTime("1985-10-25"), "Alice", "Dupont", $adresseClient);

// Création d'un intervenant
$intervenant = new Intervenant(2000.0, 50000.0, new DateTime("1970-07-15"), "Jean", "Martin");

// Création d'une intervention
$dateIntervention = new DateTime("2025-05-20 10:30:00");
$intervention = new Intervention(
    "Installation d'un nouveau logiciel",
    $dateIntervention,
    $intervenant,
    $client
);


// Affichons les informations de l'intervention
echo "Client : " . $intervention->getClient()->getNom() . " " . $intervention->getClient()->getPrenom() . PHP_EOL;
echo "Adresse du client : " . $intervention->getClient()->getAdresse()->getNomRue() . ", " .
    $intervention->getClient()->getAdresse()->getCodePostal() . " " .
    $intervention->getClient()->getAdresse()->getCommune() . PHP_EOL;

echo "Intervenant : " . $intervention->getIntervenant()->getNom() . " " . $intervention->getIntervenant()->getPrenom() . PHP_EOL;
echo "Salaire de l'intervenant : " . $intervention->getIntervenant()->getSalaire() . " €" . PHP_EOL;
echo "Charges de l'intervenant : " . $intervention->getIntervenant()->calculerCharges() . " €" . PHP_EOL;

echo "Date et heure de l'intervention : " . $intervention->getDateHeure()->format('Y-m-d H:i:s') . PHP_EOL;
echo "Description de l'intervention : " . $intervention->getDescription() . PHP_EOL;

// Mise à jour de la description de l'intervention
$intervention->setDescription("Mise à jour du logiciel existant");
$intervention->setDateHeure(new DateTime("2025-05-21 15:00:00"));

echo "Nouvelle description : " . $intervention->getDescription() . PHP_EOL;
echo "Nouvelle date et heure : " . $intervention->getDateHeure()->format('Y-m-d H:i:s') . PHP_EOL;