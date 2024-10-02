/*Créez une fonction « capitalCity() » qui accepte un argument de type string (le pays dont on cherche la capitale).
Elle devra retourner le nom de la capitale des pays suivants :
France => Paris
Allemagne => Berlin*/

internal class Program
{
    private static void Main(string[] args)
    {
        string? pays;
        string capitale;

        Console.WriteLine("Saisissez un nom de pays: ");

        pays = Console.ReadLine();

        capitale = CapitalCity(pays);

        Console.WriteLine(capitale);
    }

    static string CapitalCity(string _pays)
    {
        /* if (_pays == "France")
           {
               return "Paris";
           }
           else if (_pays == "Allemagne")
           {
               return "Berlin";
           }
           else 
           {
               return "Capitale inconus";
           }*/

        string resulat ;

        switch (_pays)
        {
            case "France":
 /* return */   resulat = "Paris";
                break;
            case "Allemagne":
                resulat = "Berlin";
                break;
            default:
                resulat ="Capital inconnue";
                break;
        }
        return resulat;
    } 
}
