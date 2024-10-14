/*Variable*/
using System.Net.WebSockets;
using System.Text.RegularExpressions;
using System.Threading.Channels;

string NomPrenom = "";
string metierOuCouleur = "";
string ageString = "";              // Je converti age qui et en int en string  
string maDateString = "";           // Je converti dateNaissance qui et en int en string 
string dateNaissance = "";     
int age = 0;
char saisieOuiNon;
Regex regexVerificationNomPrenom ;
bool nomValide = true;

// craction de ma liste utilisateur qui sera fortement typée
// List <List<string>> quand on aura plusier list et List <string> quand on a une list !  
List<List<string>> utilisateurs = new List<List<string>>();

/*Regex implemantation*/
regexVerificationNomPrenom = new Regex(@"^[a-zàâéèëêïîôöùüûçñ -]+$", RegexOptions.IgnoreCase);
/*Traitement*/
// debut du do while
// Pour demandele nom et le prenom de la personne 

do
{
    do
    {
        Console.WriteLine("Saisier un nom et prénom.");
        NomPrenom = Console.ReadLine() ?? "";
        nomValide = regexVerificationNomPrenom.IsMatch(NomPrenom);
        if (!nomValide)
        {
            Console.WriteLine("Format invalide.");
        }
    }
    while (!nomValide);

    // Pour demande l'age d'une personne 
    Console.WriteLine("Saisiez une date de naissance (01/01/2000");
    dateNaissance = Console.ReadLine()??"";
    // debut de si
    if (DateTime.TryParse(dateNaissance, out DateTime maDate)) //DateTime = Représente un instant, généralement exprimé sous la forme d’une date ou d’une heure.
    {
        DateTime dateActuelle = DateTime.Now;   // Pour recupere la date d'aujourd'hui avec DateTime.Now
        TimeSpan ageEnIntervaleDeTemps = dateActuelle - maDate;  //TimeSpan = Représente un intervalle de temps. Pour avoir une valeur precise 
        age = (int)(ageEnIntervaleDeTemps.Days/365.25);     //Pour cacluer l'age en annee on utilise un Cast = Pour converti le TimeSpan.Days en int
        if(age <18)
        {
            Console.WriteLine("Quelle est votre couleur préferée.");
            metierOuCouleur = Console.ReadLine() ?? "";
        }
        else
        {
            Console.WriteLine("Quelle est votre métier");
            metierOuCouleur = Console.ReadLine() ?? "";
        }
    }
    else
    {
        Console.WriteLine("Pas valide");
    }

    //  On converti un int en string avec ToString
    ageString = age.ToString();       
    // ToLongDateString = Convertit la valeur de l'objet DateTime actuel en sa représentation sous forme de chaîne de date longue équivalente.
    // Mecredi 1 mai 1996
    maDateString = maDate.ToLongDateString();      

    // [] le numero de chaque objects premier object qui commence a 0   [] les objects avec leurs attributs qui commence a 0 
    utilisateurs.Add([NomPrenom, maDateString, ageString, metierOuCouleur]);

    Console.WriteLine("Voulez vous rajouter un autre utilisateur ? Non(n) ou Oui (o)");
    saisieOuiNon = Console.ReadKey(true).KeyChar;    // pour appyer sur un touche et valide le choix la toucher appuier va pas apparaietre 

} while (saisieOuiNon == 'o' || saisieOuiNon == 'O');

//foreach on afficher info in = pour chaque index du tableaux (list) utilisateurs
foreach (List<string> info in utilisateurs)
{
    // on affiche s in= pour chaque s (string) du tableaux (list) info 
    /*Affichage*/
    foreach (string s in info)
    {
        Console.WriteLine(s);
    }
}
Console.WriteLine("Merci d'etres passer !");

