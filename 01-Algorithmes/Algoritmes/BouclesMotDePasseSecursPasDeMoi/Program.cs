/*
L'utilisateur entre un mot de passe
Le programme contrôle si le mot de passe respecte les règles en vigueur
- 12 caractères minimum
   ET Au moins 1 minuscule
   ET Au moins 1 majuscule
   ET Au moins 1 chiffre
   ET Au moins 1 caractère spécial
OU
- 20 caractères minimum
   ET Au moins 1 minuscule
   ET Au moins 1 majuscule
   ET Au moins 1 chiffre
*/

using System.Text;
using System.Text.RegularExpressions;

internal class Program
{
    private static void Main(string[] args)
    {
        string motDePasse;
        string regexMinuscules;
        string regexMajuscules;
        string regexChiffres;
        string regexCaracteresSpeciaux;

        Console.WriteLine("Saisissez un mot de passe : ");

        motDePasse = Console.ReadLine() ?? "";


        regexMinuscules = "[a-z]{1,}"; // {1,} = 1 ou plusieurs     

        regexMajuscules = "[A-Z]+"; // + = 1 ou plusieurs

        regexChiffres = "[0-9]+";

        regexCaracteresSpeciaux = "[^a-zA-Z0-9]+";

        // @"^[a-z]{2,32}$";

        // @ = pour prendre en compte le caractère d'échappement \ sans avoir a mettre \\  @"^[a-z\]{2,32}$"
        // "" = pour mettre la regex 
        // [^] = lorsque ^ est à l'intérieur [^a-z] ça veux dire que le caractère est interdit
        // ^[] = lorsque ^ est à l'extérieur ^[a-z] ça veux dire que le caractère est obligatoire au debut de la chaine 
        // [a-zA-z] = ce qui se trouve entre [] sont les valeurs qu'on va controler 
        // {2,32} ou {1,} ou {,1} ou {2} ou + ou * ou ? = pour donne une taille
        // $ = lorsque il est utiliser, la chaine il marque la fin de la chaine  

        if (
            Regex.IsMatch(motDePasse, regexMinuscules) &&
            Regex.IsMatch(motDePasse, regexMajuscules) &&
            Regex.IsMatch(motDePasse, regexChiffres) &&
            Regex.IsMatch(motDePasse, regexCaracteresSpeciaux) &&
            motDePasse.Length >= 12
        )
        {
            Console.WriteLine("Mot de passe OK");
        }
        else
        {
            Console.WriteLine("Mot de passe trop faible !");
        }
    }
}