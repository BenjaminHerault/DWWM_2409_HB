/*Variable */
int age = 0;
int ageRetraite = 60;
int anneeRetraite;

/*Traitement*/
Console.WriteLine("Saisi votre âge");

try
{
    age = int.Parse(Console.ReadLine());
}
catch(Exception ex)
{
    Console.WriteLine("L'age fourni n'est pas valide ! " + ex.Message);
    Environment.Exit(1);
}


/*Affichage*/

if (age>60)
{
    anneeRetraite = age - ageRetraite;
    Console.WriteLine("Vous êtes à la retraite depuis "+anneeRetraite+" années");
}
else if (age < 60)
{
    anneeRetraite = ageRetraite - age;
    Console.WriteLine("Il vous reste "+anneeRetraite+" années avant la retraite.");
}
else
{
    Console.WriteLine("C'est le moment de prendre sa retraite");
}

Console.WriteLine();
