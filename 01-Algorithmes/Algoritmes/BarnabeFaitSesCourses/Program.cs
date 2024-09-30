/*Variable*/
int S = 0 ;          //Somme d'argent 
int NbmMagasin = 0;

/*Traitement*/

while (S == 0)
{
    Console.WriteLine("Barnabé a combien d'argent dans sont porte monnaie donne une valeurs ");
    S = int.Parse(Console.ReadLine());
    if (S == 0)
    {
        Console.WriteLine("La somme toi etres superier a 1");
    }
}


while (S != 0)
{
    if (S % 2 == 0)         // modulo 2 quand il reste zero reste 
    {
        S = S / 2 - 1;
    }
    else if (S % 2 == 1)    // modulo 1 quand il reste un reste 0.5 par exmple 
    {
        S = S / 2;
    }
    Console.WriteLine(S);
    NbmMagasin++;
}
/*affiche*/
Console.WriteLine("Nombre de magasin " + NbmMagasin);
