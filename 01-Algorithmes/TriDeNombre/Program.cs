using System;

namespace TriDeNombre{
    internal class Program{
        
        static void Main(string[] args){
            /* VARIABLES */

            int nombreA,nombreB,nombreC;

            /* DEBUT PROGRAMME */

            Console.WriteLine("Entrez un nombre A : ");
            nombreA = int.Parse(Console.ReadLine());
            Console.WriteLine("Entrez un nombre B : ");
            nombreB = int.Parse(Console.ReadLine());
            Console.WriteLine("Entrez un nombre C : ");
            nombreC = int.Parse(Console.ReadLine());

                /*DEBUT du grand si*/

                 if(nombreA<=nombreB && nombreA<=nombreC)
                {
                    /*DEBUT petit si 1*/
                    if(nombreB<=nombreC){
                        Console.WriteLine(nombreA+ "<= "+ nombreB+ "<=" + nombreC);
                    }
                        else{
                            Console.WriteLine(nombreA+ "<="+ nombreC + "<=" + nombreB);
                        }
                }
                    /*FIN petit si 1*/
                        else if (nombreB <= nombreA && nombreB <= nombreC)
                        {
                            /*DEBUT petit si 2*/
                            if( nombreA <= nombreC){
                                Console.WriteLine(nombreB+ "<=" + nombreA+ "<="+nombreC );
                            }
                            else{
                                Console.WriteLine(nombreB+ "<="+ nombreC+"<="+ nombreA );
                            }
                            /*fin du petit si 2 */
                        }
                        else
                        {
                            /*DEBUT du petit si 3*/
                            if(nombreA <=nombreB){
                                Console.WriteLine( nombreC+"<="+ nombreA+"<="+nombreB);
                            }
                            else{
                                Console.WriteLine(nombreC +"<="+nombreB+"<="+nombreA);
                            }
                            /*FIN petit si 3*/
                        }
                 /*FIN du grand si*/
            /* FIN PROGRAMME */
        }
    }
}

