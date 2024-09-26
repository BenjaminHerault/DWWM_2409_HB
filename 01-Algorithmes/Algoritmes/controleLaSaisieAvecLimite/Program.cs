/*Varible*/
using System.Numerics;

string motDePasse = "formation";
string saisirUtilisateur;
bool isOk;                      // c'est ok
int compteur =0;

/*Traitement*/

do
{
    Console.WriteLine("Saisir un mot de passe");
    saisirUtilisateur = Console.ReadLine();
    isOk = motDePasse.Equals(saisirUtilisateur);
    compteur++;
    /*Affichage*/
    if (!isOk && compteur <3)
    {
        Console.WriteLine("mauvais mot de passe, " + compteur + "/3");
        isOk = false;
    }
    else if (!isOk && compteur < 4)
    {
        Console.WriteLine("Votre compte est bloqué");
    }
    else
    {
        Console.WriteLine("Vous êtes connecté");
        isOk=true;
    }
}
while (!isOk && compteur < 3 );
