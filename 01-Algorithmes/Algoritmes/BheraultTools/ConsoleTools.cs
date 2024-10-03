namespace BheraultTools
{
    public class ConsoleTools
    {
        public static int DemanderNombreENtier(string _question)
        {
            string saisieUtilisateur;

            int valeurRetour;

            bool saisieOk;

            do
            {
                Console.WriteLine(_question);

                saisieUtilisateur = Console.ReadLine() ?? "";

                saisieOk = int.TryParse(saisieUtilisateur, out valeurRetour);
                Console.WriteLine(valeurRetour);

                if (!saisieOk)
                {
                    Console.WriteLine("Saisie invalide, recommencez !");
                }

            } while (!saisieOk);

            return valeurRetour;
        }
    }
}
// valeurRetour = int.Parse(saisieUtilisateur);             fond la meme chose
// valeurRetour = Convert.ToInt32(saisieUtilisateur);       fond la meme chose avec une verification 

// ?? = Console.ReadLine() ?? ""; si readLine envoy null il va crée un caracteur "" sinon si il envoy pas nul va affiche la saisir

//saisieOk = int.TryParse(saisieUtilisateur, out valeurRetour);


// out =  ce le retour de ma varible avec la valeur traitée 
