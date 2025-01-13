/*
Exercice 3a.1 : Contrôler la saisie
L’utilisateur est invité à saisir son prénom.

Le programme affiche ensuite “Bonjour” suivi du prénom saisi.

Le prénom doit contenir au moins 2 caractères.

Si 
- le prénom contient moins de 2 caractères, 
- le prénom ne contient pas que des lettres

l’utilisateur doit recommencer la saisie.

L’utilisateur dispose d’un nombre d’essai illimité.
*/

using System.Runtime.CompilerServices;
using System.Text.RegularExpressions;

internal class Program
{
    private static void Main(string[] args)
    {
        try
        {
            string? prenom;
            Console.WriteLine("Bonjour, Entrer votre prénom : ");
            prenom = Console.ReadLine();

            String formatPrenom = @"^[a-z]{2,32}$";

            while (!Regex.IsMatch(prenom, formatPrenom, RegexOptions.IgnoreCase))
            {
                Console.WriteLine("Saissez un vrai prénom !");
                prenom = Console.ReadLine();
            }

            Console.WriteLine("Bonjour " + prenom);
        }
        catch(Exception ex)
        {
            Console.WriteLine("Contactez le service informatique !");
        }

        
    }
}