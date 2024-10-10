/*
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
/*variable*/
/*
string[] utilisateur;
string saisieNomPrenom;
char saisieOuiNon;

string[] tabTempo;

utilisateur = new string[] { "Allan Vitu" };

do
{
    Console.WriteLine("Saisissez votre nom et prénon");
    saisieNomPrenom = Console.ReadLine()?? "";

	tabTempo = utilisateur;

	utilisateur = new string[utilisateur.Length + 1] ;
	tabTempo.CopyTo(utilisateur, 0);
	utilisateur[utilisateur.Length - 1]= saisieNomPrenom ;

    Console.WriteLine("Souhaite-vous ajouter un utilisateur ? (N(n) ou oui(o)");

	saisieOuiNon = Console.ReadKey().KeyChar;

} while (saisieOuiNon == 'o'|| saisieOuiNon == 'O');
*/


using System.Collections;

Console.WriteLine("Enregistrement de nouveaux utilsateur");

List<string> utilisateurs;



//string[] utilisateur;
/*
string saisieNomPrenom;
char saisieOuiNon;

string[] tabTempo;

utilisateur = new string[] { "Allan Vitu" };

do
{
    Console.WriteLine("Saisissez votre nom et prénon");
    saisieNomPrenom = Console.ReadLine() ?? "";

    tabTempo = utilisateur;

    utilisateur = new string[utilisateur.Length + 1];
    tabTempo.CopyTo(utilisateur, 0);
    utilisateur[utilisateur.Length - 1] = saisieNomPrenom;

    Console.WriteLine("Souhaite-vous ajouter un utilisateur ? (N(n) ou oui(o)");

    saisieOuiNon = Console.ReadKey().KeyChar;

} while (saisieOuiNon == 'o' || saisieOuiNon == 'O');*/

