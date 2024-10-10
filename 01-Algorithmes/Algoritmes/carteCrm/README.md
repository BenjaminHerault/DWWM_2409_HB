```
Solutionnez la problématique suivante dans une application en mode « Console » dans un des langages suivants : 
C#.

Au CRM, chaque stagiaire et chaque membre du personnel dispose d’une carte à son nom. 
Pour régler les consommations avec la carte, il est nécessaire de l’alimenter en €. (Principe de la « carte prépayée »). 
Pour régler un repas au restaurant du CRM, la carte est vérifiée :
-   Les données de la carte correspondent-elle à une personne enregistrée ?
-   Y’a-t-il suffisamment de fonds disponibles ?
Si les contrôles sont validés, le prix du repas est soustrait de la somme disponible sur la carte.

Votre travail consiste à développer l’algorithme de validation de la carte.

Pour simuler le fonctionnement, l’algorithme sera programmé dans une application en mode ‘Console’. 
-   Le tableau ‘utilisateurs’ contiendra 5 utilisateurs.
-   Le prix du repas sera fixé à 4 €
-   Il n’est pas possible d’être « à découvert »


Varible 
string NomDePersonne ["Paul","Toto","Benjamin","Jade","Rose"]
string nomUtulisateur
string pourMange
int sommeEnEurros = 0;
bool seOk;
string onMange = true;
int prixRepas = 4

afficher "Qui veux recharge sa carte"
lire nomUtulisateur

	debut d'une boucle do while
		do
		boucle for int i a nomDePersonne.lentge ; i++
			faire 
				debut de si le nomDePersonne et = a nomUtulisateur alors faire :
						afficher "quelle somme voulais vous mettre"
						lire sommeEnEurros
						
						faire un do
							afficher "votre solde et ",sommeEnEurros." Voulez vous mange (oui(o) ou non(n) )" ?
							lire pourMange
						while (pourMange != "oui" && pourMange != "o" && pourMange != "non" && pourMange != "n")
						
						onMange pourMange == "oui" || pourMange == "o";
						
						sinon si onMange et vrait ET que sommeEnEurros > prixRepas 
						alors
						afficher "le prix tu repas et de" ,prixRepas " Votre solde et maintendent de " ,sommeEnEurros"
						seOk = true
						
						sinon si !onMange 
							alors afficher "Bonne Journée "
							seOk = true
						
						sinon si onMange et vrait et que sommeEnEurros < prixRepas 
							alors afficher "Vous avez pas asser d'argent pour mange ! Votre solde et de " ,sommeEnEurros
								!seOk
				sinon
					afficher "Le nom saisier fait pas parti tu crm taper un nouveux nom"
					lire nomUtulisateur
					!seOk

		while !seOk 
```
