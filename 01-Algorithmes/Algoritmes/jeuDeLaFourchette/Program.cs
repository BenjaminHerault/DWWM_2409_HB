/*Varible*/
Random aleatoire = new Random();             //Reaction d'un nombre aleatoir
int NombreAleatoire = aleatoire.Next(0, 101); //application du min a 0 et le max a 100
int NombreMax = 100;                        //Pour pouvoir stocker le max 
int NombreMin = 0;                          // Pour pouvoir stocker le min
int saisieUtulisateur = 0;                  
int NombreEssai = 1;                        // le compteur du nombre essai avent réussi

/*Traitement*/
Console.WriteLine("Saisier un nombre entres " + NombreMin + " et " + NombreMax);
saisieUtulisateur = int.Parse(Console.ReadLine());
/*Affichage*/
while (saisieUtulisateur != NombreAleatoire)     // Une boucler pour repet les etapes jusqu'a quon trouve le bon nombre 
{
    if (saisieUtulisateur > NombreAleatoire)     // Un si si le nombres Utilisateur et plus grand que le nombre Aleatoir alors on recommence
    {
        NombreMax = saisieUtulisateur;  // Nombre aleatoir Max prend saisie utulisateur 
        Console.WriteLine("Saisir un nombre plus petit entre " +NombreMin + " et " + NombreMax);
        saisieUtulisateur = int.Parse(Console.ReadLine());
    }
    else if (saisieUtulisateur < NombreAleatoire)    // Un si si le nombres Utilisateur et plus petit que le nombre Aleatoir alors on recommence
    {
        NombreMin = saisieUtulisateur;  // Nombre aleatoir Max prend saisie utulisateur 
        Console.WriteLine("Saisir un nombre plus grand entre " +NombreMin+ " et " + NombreMax);
        saisieUtulisateur = int.Parse(Console.ReadLine());
    }
    NombreEssai++;                                     // On rajoute plus un au compteur 
}
Console.WriteLine("Bravo vous avez réussi en " +NombreEssai + " coup le bon nombre etais "+ saisieUtulisateur+" Essayez de le fair un 1 !" );     
