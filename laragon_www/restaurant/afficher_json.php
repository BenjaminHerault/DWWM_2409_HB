<?php
$jsonFile = __DIR__ . '/dataobjet/restaurants.json';
header('Content-Type: application/json; charset=utf-8');
if (file_exists($jsonFile)) {
    readfile($jsonFile);
} else {
    echo json_encode(["error" => "Le fichier JSON n'existe pas."]);
}
