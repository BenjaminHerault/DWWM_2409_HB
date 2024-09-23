Console.WriteLine("Donner moi une valeur pour a !");
int A = int.Parse(Console.ReadLine());
Console.WriteLine("Donner moi une valeur pour b !");
int B = int.Parse(Console.ReadLine());
Console.WriteLine("Donner moi une valeur pour c !");
int C = int.Parse(Console.ReadLine());

int[] triNombre = new int[] {
    A,B,C
};

Array.Sort(triNombre);
foreach(int i in triNombre){
    Console.WriteLine(i);
}
