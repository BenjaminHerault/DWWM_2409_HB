<?php


function stringLength(string $longueur): bool
{
    // Vérifie si la longueur de la chaîne est supérieure ou égale à 9
    return strlen($longueur) >= 9;
}


//Tests de la fonction
var_dump(stringLength("MotDePasseLong"));
var_dump(stringLength("azer"));          // Affiche false (la chaîne contient moins de 9 caractères)

function passwordCheck(string $password): bool
{
    // Vérifie si le mot de passe contient au moins 9 caractères
    if (!stringLength($password)) return false;

    // Vérifie si le mot de passe contient au moins un chiffre
    if (!preg_match('/\d/', $password)) return false;

    // Vérifie si le mot de passe contien au moins une majuscules
    if (!preg_match('/[A-Z]/', $password)) return false;

    // Vérifie si le mot de passe contien au moins une minuscules
    if (!preg_match('/[a-z]/', $password)) return false;

    // Vérifie si le mot de passe contient au moins un caractère non alphanumérique
    if (!preg_match('/\W/', $password)) return false;

        // Si toutes les conditions sont remplies, retourne true
        return true;
}

// Tests de la fonction
echo "Tests de la fonction passwordCheck :\n";
var_dump(passwordCheck("MotDePasse123!")); // Affiche true (le mot de passe respecte toutes les règles)
var_dump(passwordCheck("MotDePasse"));    // Affiche false (pas de chiffre ni de caractère spécial)
var_dump(passwordCheck("123456789"));     // Affiche false (pas de majuscule ni de minuscule ni de caractère spécial)
var_dump(passwordCheck("Short1!"));       // Affiche false (moins de 9 caractères)


// Fonction pour l'identification d'un utilisateur
function userLogin(String $username, string $password, array $users): bool
{
    // Vérifie si l'utilisateur existe dans le tableau
    if(!array_key_exists($username, $users)) return false;
    // Utilisateur non trouvé

    // Vérifie si le mot de passe correspond
    if($users[$username] !== $password) return false;
    // Mot de passe incorrect

    // Vérifie si le mot de passe respecte les règles 
    if(!passwordCheck($password)) return false;
    // Mot de passe invalide 

    // Utilisateur trouvé et mot de passe valide
    return true;
}

// Tableau d'utilisateurs et de mots de passe
$users =[
    'joe' => 'Azer1234!',
    'jack' => 'Azer-4321',
    'admin' => '1234_Azer',
];
// Tests de la fonction
echo "Tests de la fonction userLogin :\n";
var_dump(userLogin('joe', 'Azer1234!', $users)); // Affiche true (utilisateur et mot de passe corrects)
var_dump(userLogin('jack', 'Azer-4321', $users)); // Affiche true (utilisateur et mot de passe corrects)
var_dump(userLogin('admin', 'wrong_password', $users)); // Affiche false (mot de passe incorrect)
var_dump(userLogin('unknown', 'Azer1234!', $users)); // Affiche false (utilisateur non trouvé)
var_dump(userLogin('joe', 'Short1!', $users)); // Affiche false (mot de passe ne respecte pas les règles)