Console.WriteLine("J'ai besoin d'une valeur !");
int A = int.Parse(Console.ReadLine());
Console.WriteLine("J'ai besoin d'une valeur !");
int B = int.Parse(Console.ReadLine());
Console.WriteLine("\n");

int[] triNombre = new int[] {
    A,B
};

Array.Sort(triNombre);
foreach(int i in triNombre){
    Console.WriteLine(i);
}
