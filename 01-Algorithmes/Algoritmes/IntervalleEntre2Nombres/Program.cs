/*Varible*/
int A;
int B;

/*Traitement */
Console.WriteLine("Donner moi un nombre entier pour A");
A = int.Parse(Console.ReadLine());
Console.WriteLine("Donner moi un nombre entier pour B");
B = int.Parse(Console.ReadLine());

while (A < B-1)
{
    A++;
    Console.Write(A + " ");
}
while (A >= B)
{
    A--;
    Console.Write(A + " ");
}




