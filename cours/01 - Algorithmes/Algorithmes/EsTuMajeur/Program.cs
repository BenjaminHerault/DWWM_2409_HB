// See https://aka.ms/new-console-template for more information
Console.WriteLine("Hello, World!");

//Variable
int age;
string saisiUtilisateur;
//Traitement 
try
{
    Console.WriteLine("Saisir votre age");
    saisiUtilisateur = Console.ReadLine();
    age = int.Parse(saisiUtilisateur);

    //Affichage
    if (age>=18)
    {
        Console.WriteLine("vous êtes majeur(e) !");
    }
    else if (age<0)
    {
        Console.WriteLine("vous n'êtes pas né(e) !");
    }
    else
    {
        Console.WriteLine("vous êtes mineur(e) !");
    }
}
catch(Exception ex)
{
    Console.WriteLine(ex.Message);
}





Console.ReadLine();