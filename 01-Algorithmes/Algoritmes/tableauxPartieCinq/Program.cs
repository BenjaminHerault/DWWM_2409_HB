/*Variable*/
int[] tableau = new int[4];
bool isOk;
int N ;

/*Traitement*/
for (int i = 0; i <= tableau.Length - 1; i++)              // Pour crée ma serie de nombre dans le tableau
{
    Console.WriteLine("Rentre la premier valeur du tableux qui sera en index :" + i);
    tableau[i] = int.Parse(Console.ReadLine());
}
Array.Sort(tableau);                                   // mais les nombre par ordre croissant
for (int j = 0;j < tableau.Length; j++)                // pour afficher le tableau 
{
    //Console.Write(tableau[j] + " ");                 // afficher le tableaux 
    Console.WriteLine("Donnez moi un chiffre a vérifier dans le tableau ");
    isOk = int.TryParse(Console.ReadLine(),out N);
    if (!isOk)
    {
        Console.WriteLine("j'ai besoin d'un nombre pour fonctionner");
    }
    if (N == tableau[j]) 
    {
        Console.WriteLine("Voice l'index de votre nombre " +j);
    }
    else
    {
        Console.WriteLine("Nombre non trouvé");
    }
}


