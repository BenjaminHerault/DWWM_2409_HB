/*Varible */
string prenom;
bool prenomOk;
/*Traitement*/

do
{
    prenomOk = true;
    Console.WriteLine("Saisir votre prénom");
    prenom = Console.ReadLine();
    if (prenom.Length < 2)
    {
        Console.WriteLine("Il faut minimum 2 caractères !");
        prenomOk = false;
    }
    else if (!prenom.All(char.IsLetter))
    {
        Console.WriteLine("Merci de mettre que des lettres"!);
        prenomOk = false;
    } 
}
while ( !prenomOk);
Console.WriteLine(prenom);
