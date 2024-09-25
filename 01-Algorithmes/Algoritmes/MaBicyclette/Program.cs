/*Variable*/

using System.Formats.Asn1;

bool ReparationsImmédiates = new Random().Next(100) <= 50 ? true : false;
bool trouveLeLivreMaison = new Random().Next(100) <= 50 ? true : false;
bool trouverLeLivreBibliotheque = new Random().Next(100) <= 50 ? true : false;
string pluie;
bool beau;

/*
// maVariable = (Si maCondition) (alors (?) ok (true)), (sinon (:) !ok(false))
bool bicycleState = new Random().Next(100) <= 50 ? true : false;

int var1 = 100;
int var2 = 1000;

string var3 = var1 > var2 ? "var1 est + grand (true)" : "var1 est plus petit (false)";

Console.WriteLine(var3);*/
/*traitement*/

do
{
    Console.WriteLine("Fait-il beau ? oui (o) ou Non (n)");
    pluie = Console.ReadLine();
    pluie = pluie.ToLower();    // Une lettres en majuscule serra convertie en minuscules  
} while (pluie != "oui" && pluie != "o" && pluie != "non" && pluie != "n" && pluie != "y" );    //les touche qui vont avoir une action

beau = pluie == "oui" || pluie == "o" || pluie == "y";      //les touche qui fon accepter si il faut beau 


if (beau)
{
    if (ReparationsImmédiates)
    {
        Console.WriteLine("j'irai faire une balade à bicyclette");
    }
    else 
    {
        Console.WriteLine("j’irai à pied jusqu’à l’étang pour cueillir les joncs");
    }
}

else
{
    Console.WriteLine("je consacrerai ma journée à la lecture");
    if (trouveLeLivreMaison)
    {
        Console.WriteLine("je m’installerai confortablement dans un fauteuil et je me plongerai dans la lecture de Game of Thrones");
    }
    else if (trouverLeLivreBibliotheque)
    {
        Console.WriteLine("J'emprunter le livre à la bibliothèque et je rentre a la maison pour le lire Game of Thrones ");
    }
    else
    {
        Console.WriteLine("j’emprunterai un roman policier et je rentre a la maison pour lire");
    }
}

