<?php


function getTodayv2()
{
    // Définir le fuseau horaire sur "Europe/Paris"
    date_default_timezone_set('Europe/Paris');

    $dateTuJours = new DateTime();
    return $dateTuJours->format('d-m-Y H:i:s'); // Affiche la date et l'heure au format français
}
echo getTodayv2(); // Affiche la date et l'heure actuelles au format 'YYYY-MM-DD HH:MM:SS'
function getToday(){

    // Définir le fuseau horaire sur "Europe/Paris"
    date_default_timezone_set('Europe/Paris');
    $dateTuJours = new DateTime();
    return $dateTuJours->format('d-m-Y');
}
echo getToday()."\n"; // Affiche la date et l'heure actuelles au format 'YYYY-MM-DD HH:MM:SS'

function getTimeLeft(string $date): string
{
    // Définir le fuseau horaire sur "Europe/Paris" 
    date_default_timezone_set('Europe/Paris');

    

}