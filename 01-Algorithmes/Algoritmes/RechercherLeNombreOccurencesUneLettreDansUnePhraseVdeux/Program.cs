string laPhrase ="";
string rechereche = "";
int compteur = 0;

Console.WriteLine("écrivez un message");
laPhrase = Console.ReadLine().ToLower();

if (laPhrase.EndsWith("."))   //EndsWith = Détermine si la fin de cette instance de chaîne correspond à une chaîne spécifiée.
{
    if (laPhrase.Length > 1)
    {
        Console.WriteLine("Donne moi une lettre a vérifier ");
        rechereche = Console.ReadLine().ToLower();

        for (int i = 0; i < laPhrase.Length; i++)
        {
            if (laPhrase[i] == char.Parse(rechereche))// char.Parse(), int.Parse()... Convertit la valeur de la chaîne spécifiée en son caractère Unicode équivalent.
            {
                compteur++;
            }
        }
    }
    else
    {
        Console.WriteLine("LA CHAINE EST VIDE");
    }
    if (compteur == 0 && laPhrase != "" )
    {
        Console.WriteLine($"La lettre \"{rechereche}\" n’est pas présente");
    }
    else
    {
        Console.WriteLine($"Il a {compteur} occurrences avec la lettre \"{rechereche}\".");
    }
}
else if(string.IsNullOrEmpty(laPhrase))
{
    Console.WriteLine("LA CHAINE EST VIDE");  // IsNullOrEmpty = Indique si la chaîne spécifiée est null ou une chaîne vide ("")
}
else 
{
    Console.WriteLine("il manque le \".\" ");
}
