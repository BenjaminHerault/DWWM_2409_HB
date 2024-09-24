/*Variable*/

int JoursNaissance;
int MoisNaissance;
int AnneeNaissance;

/*Traitement*/
DateTime localDate = DateTime.Now;

Console.WriteLine("donner moi votre jours de naissance");
JoursNaissance = int.Parse(Console.ReadLine());

Console.WriteLine("donner moi votre mois de naissance");
MoisNaissance = int.Parse(Console.ReadLine());

Console.WriteLine("donner moi votre année de naissance");
AnneeNaissance = int.Parse(Console.ReadLine());

Console.WriteLine(localDate.Year);

