/*Variable*/
using System.Text.RegularExpressions;

string leTexte;
string[] recherche;
int occurences;
Regex aAz;

/*Pour ranger un tableaux* avec une boucle for/
//string abc = "abcdefghijklmnopqrstuvwxyz";
//string[] rangementABC;
/*rangementABC = new string[26];
for (int i = 0; i < abc.Length; i++)
{
    renchementABC[i]=abc[i].ToString();
    Console.WriteLine(renchementABC[i]);
}*/

/*Traitement*/
try
{
    Console.WriteLine("donne moi un texte");
    leTexte = Console.ReadLine()??"";

    aAz = new Regex("[a-z]");
    
     


   /* /*declaration du tableau
    recherche = new string[] { "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z" };
    Console.WriteLine("Ecrivez un texte de 120 caractères (à contrôler) ");
    leTexte = Console.ReadLine().ToLower();*/
}

catch(Exception ex)
{
    Console.WriteLine(ex.Message);
}


