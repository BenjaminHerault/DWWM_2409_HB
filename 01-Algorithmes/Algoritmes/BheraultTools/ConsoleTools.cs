using System.Text.RegularExpressions;

namespace BheraultTools
{
    public class ConsoleTools
    {
        public static int DemanderNombreENtier(string _question)
        {
            /*Varible*/
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

        public static float DemanderFloatPositif(string _question)
        {
            /*Varible*/
            string saisieUtilisateur;

            float valeurRetour;

            bool saisieOk;

            do
            {
                Console.WriteLine(_question);

                saisieUtilisateur = Console.ReadLine() ?? "";

                
                saisieOk = float.TryParse(saisieUtilisateur, out valeurRetour) && valeurRetour >= 0;
                Console.WriteLine(valeurRetour);

                if (!saisieOk)
                {
                    Console.WriteLine("Saisie invalide, recommencez !");
                }

            } while (!saisieOk);

            return valeurRetour;
        }
        public static string DemanderUnNumeroValide(string _question)
        {
            /*Variable*/
            string numeroDeTelephoneValide;
            string regexNumeroDeTelephone;      // String/ Int premier letre en mascule pour les regex 
            bool saisieOk;

            /*Regex*/
            regexNumeroDeTelephone = "^0[1-79]{1}[0-9]{8}$";

            do
            {
                Console.WriteLine(_question);
                // les ?? "" pour retourne une valeurs null 
                numeroDeTelephoneValide = Console.ReadLine() ?? "";

                // saisieOk verifier si ce vrai Regex.IsMatch(regexNumeroDeTelephone, numeroDeTelephoneValide);
                // on quitte la boucle dans se cas la 
                saisieOk = Regex.IsMatch(numeroDeTelephoneValide, regexNumeroDeTelephone);
                // numeroDeTelephoneValide la chose a verifier avec regexNumeroDeTelephone 
                Console.WriteLine(numeroDeTelephoneValide);

                int mesZeros = 0;

                // 06 02030005
                for (int i = 2; i < numeroDeTelephoneValide.Length; i++)
                {
                   /* if (numeroDeTelephoneValide[i] == '0')
                    {
                        mesZeros = mesZeros + 1;
                    } else
                    {
                        mesZeros = 0;
                    }*/

                   // 01 00456000
                    mesZeros = (numeroDeTelephoneValide[i] == '0') ? mesZeros + 1 : 0;
                    //mesZeros = (numeroDeTelephoneValide[i] == '0') ? mesZeros + 1 : 0;
                    // mesZeros mon compteur de 0
                    // numeroDeTelephoneValide le numero a virifer avec quoi == '0'
                    // ? = sinon mesZeros +1 quand il a un zero on fait +1 
                    // : sinon = le compteur mesZeros reviend a 0 si on trouve pas le zero 
                    if (mesZeros == 3)
                    {
                        saisieOk = false;
                    }
                }

                // on demande une valeur valide pour quitter la boucle 
                if (!saisieOk ) {
                    Console.WriteLine("Ceci n'est pas un numéro de téléphone valide ");
                }

            } while (!saisieOk);
            Console.WriteLine($"Le numero {numeroDeTelephoneValide} fonctionne");
            return numeroDeTelephoneValide;

        }

        public static string DemanderNbrOccurences(string _question)
        {
            string texteALire;
            Regex test;

            test = new Regex("[a-z]");
        }

    }
}





// valeurRetour = int.Parse(saisieUtilisateur);             fond la meme chose
// valeurRetour = Convert.ToInt32(saisieUtilisateur);       fond la meme chose avec une verification 

// ?? = Console.ReadLine() ?? ""; si readLine envoy null il va crée un caracteur "" sinon si il envoyer pas nul va affiche la saisir

//saisieOk = int.TryParse(saisieUtilisateur, out valeurRetour);


// out =  ce le retour de ma varible avec la valeur traitée 
