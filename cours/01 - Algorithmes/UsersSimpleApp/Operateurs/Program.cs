namespace Operateurs
{
    internal class Program
    {
        static void Main(string[] args)
        {
            Console.WriteLine("Hello, World!");

            string? nom = null;
            string? prenom = "";

            string affichage = nom ?? "Toto"; 

            string affichage2 = (nom != null) ? nom : "Toto";

            string affichage3;

            if(nom != null)
            {
                affichage3 = nom;
            } 
            else
            {
                affichage3 = "Toto";
            }

            Console.WriteLine(affichage);

            affichage = Console.ReadLine() ?? "";


        }
    }
}
