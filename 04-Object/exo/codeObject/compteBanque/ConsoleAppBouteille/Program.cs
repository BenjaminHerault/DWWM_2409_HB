using ClassLibraryBouteille;


//contenanceEnLitre contenuEnLitre estOuverte 
Bouteille b;

b = new Bouteille();

b = new Bouteille(2,1.5,false);

b = new Bouteille(2,2,false);

//Bouteille clone = new Bouteille(b);

// Pour la méthode Ouvrir 
bool testOuvire = b.Ouvrir();

// Pour la méthode fermer
//bool testFermer = b.Fermer();

int a = 0;