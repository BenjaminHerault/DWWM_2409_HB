/*
L’utilisateur est invité à saisir un mot de passe.

Si le mot de passe saisi est correct, le programme affiche “Vous êtes connecté”.

Dans le cas contraire, l’utilisateur doit recommencer la saisie.

L’utilisateur dispose de 3 essais maximum.

Au 3ème échec, le programme affiche “Votre compte est bloqué” et se termine.

Note : Le bon mot de passe est formation 
*/
namespace Boucles.ControleMotDePasse
{
    internal class Program
    {
        static void Main(string[] args)
        {
            /*Variable*/
            const string BON_MOT_DE_PASSE = "formation";
            const int ESSAIS_MAX = 3;

            string motDePasse;
            int compteur = 1;


            /*Traitement*/
            Console.WriteLine("Donner moi un mot de passe à verifier !");
            motDePasse = Console.ReadLine();

            while (!motDePasse.Equals(BON_MOT_DE_PASSE) && compteur <ESSAIS_MAX)
            {
                compteur++;
                Console.WriteLine($"mauvais mot de passe essais {compteur}/{ESSAIS_MAX}");
                Console.WriteLine("Re essais !");
                motDePasse = Console.ReadLine();
            }
            /*Affichage*/
            if (motDePasse.Equals(BON_MOT_DE_PASSE))
            {
                Console.WriteLine("Connecter");
            }
            else
            {
                Console.WriteLine("Votre compte est bloqué");
            }
            

        }
    }
}
