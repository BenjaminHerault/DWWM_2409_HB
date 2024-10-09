/*Variable*/
using System.Text.RegularExpressions;

string message;
string laLettre;
int occurences;

/*traitement*/

Console.WriteLine("Entrer un message : ");
message = Console.ReadLine().ToLower();         //ToLower() = Retourne une copie de cette chaîne convertie en minuscules.

Console.WriteLine("Quelle lettre voulez-vous compter ? ");
laLettre = Console.ReadKey().KeyChar.ToString().ToLower();  // ReaKey = Obtient le caractère suivant ou
                                                            // la touche de fonction sur laquelle l'utilisateur a appuyé.
                                                            //  KeyChar = Obtient ou définit le caractère correspondant à
                                                            //  la touche activée.
                                                            //  ToString = Retourne une chaîne qui représente l'objet actuel.
                                                            //  ToLower() = Retourne une copie de cette chaîne convertie en minuscules.

occurences = Regex.Matches(message, laLettre).Count();      // Regex.Matches = Recherche dans une chaîne d'entrée toutes les occurrences
                                                            // d'une expression régulière et retourne toutes les correspondances.
                                                            // Count = Obtient le nombre d’éléments contenus dans le List<T>.

/*Affichage*/
Console.WriteLine();
Console.WriteLine($"Votre message contient {occurences} \"{laLettre}\".");
