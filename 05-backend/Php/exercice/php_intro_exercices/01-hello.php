<?php
/**
* Affiche "Hello World !"
*/
function helloWorld() : void
{
 echo "Hello World !";
}
// test de la fonction (la fonction affiche directement le résultat)
helloWorld();
/**
 * Retourne "Hello $name !" ou "Hello Nobody !" si $name est vide
 * @param string $name le nom à afficher 
 */
function hello(?string $name):string
{
    if(empty($name))$name = "Nobody";
    
    return "Hello $name";
}

// test de la fonction (la fonction n'affiche rien. "echo" affichera la valeur retournée par la fonction)
echo hello(null); // test avec une chaîne vide
echo hello("Benji");    // test avec un nom