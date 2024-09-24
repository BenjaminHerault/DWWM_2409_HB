using System;

namespace Exercice2a1TriDeNombresV2{
    internal class Program{
        static void Main(string[] args){

            /*VARIABLES*/
            int A,B;

            /*DEBUT PROGRAMME*/

            Console.WriteLine("Entrez une valeur pour A");
            A = int.Parse(Console.ReadLine());
            Console.WriteLine("Entrez une valeur pour B");
            B = int.Parse(Console.ReadLine());

            /*DEBUT SI*/
            if (A<B){
                Console.WriteLine(A +" < "+B);
            }
                else{
                    Console.WriteLine(B+" < "+A);
                }
        }
    }
}
