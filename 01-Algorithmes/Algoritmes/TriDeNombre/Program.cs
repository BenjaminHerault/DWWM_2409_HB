using System;

using BheraultTools;
// on appele notre ConoleTools pour l'utiliser
// nombreA = ConsoleTools.DemanderNombreENtier 
// ConsoleTools.DemanderNombreENtier = insigne la variable avec le nom pour l'utiliser

namespace TriDeNombre
{
    internal class Program{
        
        static void Main(string[] args){
            /* VARIABLES */

            int nombreA,nombreB,nombreC;

            /* DEBUT PROGRAMME */

            nombreA = ConsoleTools.DemanderNombreENtier("Entrez un nombre A : ");
            nombreB = ConsoleTools.DemanderNombreENtier("Entrez un nombre B : ");
            nombreC = ConsoleTools.DemanderNombreENtier("Entrez un nombre C : ");

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
