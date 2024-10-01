/*Varible*/
string laPhrase = "";
string rechereche = "";
int compteur = 0;

/*Traitement*/

Console.WriteLine("Donnez moi une phrase");
laPhrase = Console.ReadLine().ToLower();

if (laPhrase[laPhrase.Length - 1] == '.' )
{
    if (laPhrase.Length > 1)
    {
        Console.WriteLine("Donne moi une lettre a verrifier  ");
        rechereche = Console.ReadLine().ToLower();
        for (int i = 0; i < laPhrase.Length; i++)
        {
            if (laPhrase[i] == char.Parse(rechereche)) // char.Parse(), int.Parse()... pour convertir
            {
                compteur++;
            }
        }
    }
}
else
{
    Console.WriteLine("la phrase se termine PAS par un .");
}
//La phrase est vide
if (laPhrase == "" || laPhrase == ".")
{
    Console.WriteLine("je suis vide");
}

//La lettre n’est pas présente
else if (compteur == 0 && laPhrase != "")
{
    Console.WriteLine("pas la lettre");
}

//La lettre est présente une ou plusieurs fois
else
{
    Console.WriteLine(compteur);
}
