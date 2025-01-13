/*
Créez une fonction « capitalCity() » qui accepte un argument de type string (le pays dont on cherche la capitale).
Elle devra retourner le nom de la capitale des pays suivants :
France => Paris
Allemagne => Berlin
Italie => Rome
Maroc => Rabat
Espagne => Madrid
Portugal => Lisbonne
Angleterre => Londres
Si le pays ne fait pas partie de la liste ci-dessus, la fonction retourne la valeur « Capitale inconnue ».
Note : Utilisez la structure SWITCH pour faire cet exercice.
*/
using System.Numerics;

internal class Program
{
    private static void Main(string[] args)
    {
        string ?pays;
        string capitale;

        Console.WriteLine("Saisissez un nom de pays: ");

        pays = Console.ReadLine();

        capitale = CapitalCity(pays);

        Console.WriteLine(capitale);



    }

    static string CapitalCity(string _pays)
    {
        /*if(_pays == "France")
        {
            return "Paris";
        }
        else if (_pays == "Allemagne")
        {
            return "Berlin";
        } 
        else
        {
            return "Capitale inconnue";
        }*/

        string resultat;

        switch (_pays)
        {
            case "France":
                resultat = "Paris";
                break;
            case "Allemagne":
                resultat = "Berlin";
                break;
            default:
                resultat = "Capitale inconnue";
                break;
        }

        return resultat;
    }


}