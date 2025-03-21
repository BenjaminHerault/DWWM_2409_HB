﻿/*
Au démarrage, il n'y a aucun utilisateur enregistré.

1. Le programme demande à l'utilisateur de saisir un nom et un prénom.
	- L’utilisateur saisit un nom et un prénom.

2. Lorsque toutes les informations sont saisies
	- Le programme enregistre l'utilisateur

3. Le programme demande à l'utilisateur s'il souhaite ajouter une autre personne.
	- Si oui
		- Retour à l'étape 1 (saisir nom et prénom)
	- Si non
		- Afficher tous les utilisateurs enregistrés

4. Le programme se termine
*/

using System.Collections;
using System.Linq;

namespace Collections.Listes
{
    internal class Program
    {
        static void Main(string[] args)
        {
            Console.WriteLine("Enregistrement de nouveaux utilisateurs");

            List<string> utilisateurs = new List<string>(); // Liste fortement typée

            utilisateurs.Add("Tata"); // Add = Augmente la taille de la collection de 1 et ajoute l'élément à la fin de la collection 
            utilisateurs.Add("Toto2");

            utilisateurs.AddRange(["toto3", "toto4"]);

            utilisateurs.Insert(2, "Titi");

            utilisateurs.InsertRange(1, ["Tata", "Tutu"]);

            utilisateurs.Prepend("Riri"); // ajout au début
            utilisateurs.Append("Fifi"); // ajout a la fin

            utilisateurs.Remove("Tata");

            utilisateurs.RemoveAll(chaine => chaine == "Tata");



            string saisieNomPrenom;
            
            char saisieOuiNon;                   

            do
            {
                Console.WriteLine("Saisissez votre nom et prénom : ");
                
                saisieNomPrenom = Console.ReadLine() ?? "";
                                
                utilisateurs.Add(saisieNomPrenom);
                

                Console.WriteLine("Souhaitez vous ajouter un autre utilisateur ? (N/O)");

                saisieOuiNon = Console.ReadKey(true).KeyChar;
            }
            while (saisieOuiNon == 'o' || saisieOuiNon == 'O');

            for(int i = 0; i < utilisateurs.Count; i++)
            {
                Console.WriteLine(utilisateurs[i]);
            }

            foreach(string personne in utilisateurs)
            {
                Console.WriteLine(personne);
            }


        }
    }
}
