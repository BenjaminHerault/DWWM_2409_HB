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

        regexMinuscules = "[a-z]{1,}"; // {1,} = 1 ou plusieurs lettres minuscules

        regexMajuscules = "[A-Z]+"; // + = 1 ou plusieurs lettres majuscules

        regexChiffres = "[0-9]+"; // 1 ou plusieurs lettres

        regexCaracteresSpeciaux = "[^a-zA-Z0-9]+";  // + = 1 ou plusieurs caractères non alphanumériques


        Console.WriteLine("Saisissez un mot de passe : ");

        motDePasse = Console.ReadLine() ?? "";      


        if (
            Regex.IsMatch(motDePasse, regexMinuscules) &&
            Regex.IsMatch(motDePasse, regexMajuscules) &&
            Regex.IsMatch(motDePasse, regexChiffres) &&
            motDePasse.Length >= 12 &&
            (Regex.IsMatch(motDePasse, regexCaracteresSpeciaux) || motDePasse.Length > 20)
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