/*Variable*/
using System.Text.RegularExpressions;


string nomPrenom = "";
string metierOuCouleur = "";
string ageString = "";              // Je converti age qui et en int en string  
string maDateString = "";           // Je converti dateNaissance qui et en int en string 
string dateNaissance = "";     
int age = 0;
char saisieOuiNon;
bool nomValide = true;

// craction de ma liste utilisateur qui sera fortement typée
// List <List<string>> quand on aura plusier list et List <string> quand on a une list !
// Une list normal ressemble a sa List List<string>utilisateurs = new List<string>();
List<List<string>> utilisateurs = new List<List<string>>();

/*Regex implemantation*/
Regex regexVerificationNomPrenom;
// on assigne une valeur a la regex 
regexVerificationNomPrenom = new Regex(@"^[a-zàâéèëêïîôöùüûçñ -]+$", RegexOptions.IgnoreCase);
/*Traitement*/
// debut du do while
do
{
    //On verifier que le nom et correct 
    do
    {
        // Pour demandele nom et le prenom de la personne 
        Console.WriteLine("Saisier un nom et prénom.");
        nomPrenom = Console.ReadLine() ?? "";
        //IsMatch = Indique si l’expression régulière trouve une correspondance dans la chaîne d’entrée.
        nomValide = regexVerificationNomPrenom.IsMatch(nomPrenom);
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

    //DateTime = Représente un instant, généralement exprimé sous la forme d’une date ou d’une heure.
    if (DateTime.TryParse(dateNaissance, out DateTime maDate)) 
    {
        // Pour recupere la date d'aujourd'hui avec DateTime.Now
        DateTime dateActuelle = DateTime.Now;
        //TimeSpan = Représente un intervalle de temps. Pour avoir une valeur precise
        TimeSpan ageEnIntervaleDeTemps = dateActuelle - maDate;
        //Pour cacluer l'age en annee on utilise un Cast = Pour converti le TimeSpan.Days en int
        age = (int)(ageEnIntervaleDeTemps.Days/365.25);     
        if(age <18)
        {
            Console.WriteLine("Quelle est votre couleur préferée.");
        }
        else
        {
            Console.WriteLine("Quelle est votre métier");
        }
        // Comment on a deux demande qui prennet la meme variable on peux assigner la valeur a la fin pour eviter les repetition
        metierOuCouleur = Console.ReadLine() ?? "";
    }
    else
    {
        Console.WriteLine("Pas valide");
    }

    //  On converti un int en string avec ToString
    ageString = age.ToString();       
    // ToLongDateString = Convertit la valeur de
    // l'objet DateTime actuel en sa représentation sous forme de chaîne de date longue équivalente.
    // execmple : Mecredi 1 mai 1996
    maDateString = maDate.ToLongDateString();

    // utilisateurs et une liste et on lui donne comme valeur  nomPrenom, maDateString, ageString, metierOuCouleur
    utilisateurs.Add([nomPrenom, maDateString, ageString, metierOuCouleur]);

    //On demander si on toi rajouter un utilisateur 
    Console.WriteLine("Voulez vous rajouter un autre utilisateur ? Non(n) ou Oui (o)");
    // pour appyer sur un touche et valide le choix la toucher appuier va pas apparaietre 
    saisieOuiNon = Console.ReadKey(true).KeyChar;    

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

