/*Variable*/
using System.Text.RegularExpressions;
using System.Threading.Channels;

string saisierNomPrenom;
string metier;
string couleurPref;
string ageString;              // Je converti age qui et en int en string  
string dateNaissance;    // Je converti dateNaissance qui et en int en string  
int age;
Regex regexJourNaissance;
Regex regexMoisNaissance;
Regex regexAnnesNaissance;
char saisieOuiNon;

// craction de ma liste utilisateur qui sera fortement typée
List<string> utilisateur = new List<string>();

/*regex omplamatation */

regexJourNaissance = new Regex("[0-9]{2}/");
regexMoisNaissance = new Regex("[0-9]{2}/");
regexAnnesNaissance = new Regex("[0-9]{4}");

// debut du do while
do
{
    // Pour demandele nom et le prenom de la personne 
    Console.WriteLine("Saisier un nom et prénom.");
    saisierNomPrenom = Console.ReadLine()??"";

    // Pour demande l'age d'une personne 
    Console.WriteLine("Saisiez une date de naissance (01/01/2000");
    dateNaissance = Console.ReadLine()??"";
    // debut de si
    if (DateTime.TryParse(dateNaissance, out DateTime maDate))
    {

    }


} while (saisieOuiNon == 'o' || saisieOuiNon == 'O');
