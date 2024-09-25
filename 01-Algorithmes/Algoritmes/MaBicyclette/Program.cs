/*Variable*/

bool beau = false;
bool ReparationsImmédiates = false;
bool trouveLeLivreMaison = false;
bool trouverLeLivreBibliotheque = false;

/*traitement*/
if (beau == true)
{
    if (ReparationsImmédiates == true)
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
    if (trouveLeLivreMaison == true)
    {
        Console.WriteLine("je m’installerai confortablement dans un fauteuil et je me plongerai dans la lecture de Game of Thrones");
    }
    else if (trouverLeLivreBibliotheque == true)
    {
        Console.WriteLine("J'emprunter le livre à la bibliothèque et je rentre a la maison pour le lire Game of Thrones ");
    }
    else
    {
        Console.WriteLine("j’emprunterai un roman policier et je rentre a la maison pour lire");
    }
}

