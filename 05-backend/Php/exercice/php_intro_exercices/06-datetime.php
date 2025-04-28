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

    // Vérifier si la date est valide et au bon format
    $targetDate = DateTime::createFromFormat('Y-m-d', $date);
    if (!$targetDate || $targetDate->format('Y-m-d') !== $date) return "La date fournie est invalide";

    //Créer un objet DateTime pour la date actuelle
    $currentDate = new DateTime();

    $interval = $currentDate->diff($targetDate);

    // si la date est égale à aujourd'hui
    if ($interval->days ===0) return "Aujourd'hui";

    // si la date est passée
    if ($targetDate < $currentDate) return "Évènement passé";

    //si la date est future, formater la différence
    $years = $interval->y;
    $months = $interval->m;
    $days = $interval->d;
//L'opérateur -> en PHP est utilisé pour accéder aux propriétés ou méthodes d'un objet.
    $result = "Dans ";

    if($years > 0) $result .="$years an".($years>1 ? "s":"")." ";

    if($months > 0) $result .="$months mois ";
                            //condition ? valeur_si_vrai : valeur_si_faux;
    if($days > 0)$result .="$days jour" . ($days > 1 ? "s" : " ");
    //L'opérateur .= en PHP est un opérateur de concaténation avec affectation. Il permet d'ajouter une chaîne de caractères à une variable existante.
        return trim($result);
}
    
    // Appels de la fonction avec différents exemples 
echo getTimeLeft("2019-09-29") . "\n"; // Exemple : Évènement passé
echo getTimeLeft("2025-04-28") . "\n"; // Exemple : Aujourd'hui
echo getTimeLeft("2025-05-15") . "\n"; // Exemple : Dans 16 jours
echo getTimeLeft("2026-08-30") . "\n"; // Exemple : Dans 1 an 4 mois 1 jours
echo getTimeLeft("invalid-date") . "\n"; // Exemple : Date invalide
echo getTimeLeft(date:"2026-02-30"). "\n"; // Exemple : Date invalide 
