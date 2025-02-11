using ClassLibraryBouteille;


//contenanceEnLitre contenuEnLitre estOuverte 
Bouteille b;


//contenanceEnLitre, contenuEnLitre, estOuverte 

//Bouteille clone = new Bouteille(b);

// Pour la méthode Ouvrir 
//bool testOuvire = b.Ouvrir();

// Pour la méthode fermer
//bool testFermer = b.Fermer();

// Pour la méthode vider
//bool testVider = b.Vider();



//bool testcremplir = b.Remplir();

try
{
    b = new Bouteille(2, -1, true);
    //Pour la méthode vider avec quantiter 
    bool testVideravec = b.Vider(0.5);
    //bool testcremplir = b.Remplir(-3);
}
catch (ArgumentException e)
{
    Console.WriteLine("Valeur negatif");
}

