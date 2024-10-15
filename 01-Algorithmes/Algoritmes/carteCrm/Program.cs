/*Varible*/

using System.Numerics;

string[] nomDePersonne;
string nomUtulisateur;
string pourMange;
int sommeEnEurros =0;
int prixRepas = 4;
int i = 0;
bool seOk = false;
bool onMange = true;
bool utilisateurTrouve = false;

/*traitement*/
try
{
    /*Declaration du tableux */
    nomDePersonne = new string[] {"Paul","Toto","Benjamin","Jade","Rose"};

    Console.WriteLine("Qui veux recharger sa carte du CRM ?");
    nomUtulisateur = Console.ReadLine();

    /*Debut du do while*/
    do
    {
        for (i = 0;i<nomDePersonne.Length; i++)
        {
            if (nomDePersonne[i] == nomUtulisateur)
            {
                utilisateurTrouve = true;
                Console.WriteLine("Quelle Somme voulais vous mettre ?");
                sommeEnEurros = int.Parse(Console.ReadLine());
                do
                {
                    Console.WriteLine($"Votre solde est {sommeEnEurros} Voulez vous mange oui (o) ou non (n)");
                    pourMange = Console.ReadLine().ToLower();
                } while (pourMange != "oui" && pourMange != "o" && pourMange != "non" && pourMange != "n");

                 onMange = pourMange == "oui" || pourMange == "o";

                if (onMange && sommeEnEurros > prixRepas)
                {
                    sommeEnEurros = sommeEnEurros - prixRepas;
                    Console.WriteLine(
                        $"Le prix tu repas et de {prixRepas} votre solde et maintendent de {sommeEnEurros}"
                        );
                    seOk = true;
                }
                else if (!onMange)
                {
                    Console.WriteLine("Bonne Journée a bientôt !");
                    seOk = true;
                }
                else if (onMange && sommeEnEurros < prixRepas)
                {
                    Console.WriteLine($"Vous avez pas asser d'argent pour mange ! Votre solde et de {sommeEnEurros} ");
                    seOk = false;
                }
            }
            else
            {
               /* Console.WriteLine("Le nom saisier fait pas parti tu crm taper un nouveux nom");
                nomUtulisateur = Console.ReadLine();*/
                seOk = true;
            }
        }
    }while (!seOk);

    if(!utilisateurTrouve)
    {
        Console.WriteLine("Le nom saisier fait pas parti tu crm");
    }
}
catch(Exception ex)
{
    Console.WriteLine("Il a une erreure concater le service tectinque " +ex);
}
