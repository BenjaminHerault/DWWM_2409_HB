```
## Déroulement du programme

1. Le programme demande à l'utilisateur de saisir un nom et un prénom.
      - L’utilisateur saisit un nom et un prénom.

2. Le programme demande à l'utilisateur de saisir la date de naissance.
      - L'utilisateur saisit la date de naissance.

3. Le programme calcule l'âge de la personne en cours d'ajout.
      - Si l’âge est supérieur ou égal à 18 (majeur)
            - Le programme demande à l'utilisateur de saisir son métier.
      - Si l’âge est inférieur à 18 (mineur)
            - Le programme demande à l'utilisateur de saisir sa couleur préférée.

4. Lorsque toutes les informations sont saisies
      - Le programme enregistre l'utilisateur

5. Le programme demande à l'utilisateur s'il souhaite ajouter une autre personne.
      - Si oui
            - Retour à l'étape 1 (saisir nom et prénom)
      - Si non
            - Afficher tous les utilisateurs enregistrés en respectant ce format :
            - Nom Prénom - Date de naissance (âge) - Métier/Couleur préférée

6. Le programme remercie l'utilisateur et se termine


declaration des variable 
string saisierNomPrenom;
string metier;
string couleurPref;
string ageString ;          // je converti un int en string 
string dateNaissanceString  // je converti un int en string 
int dateNaissance;
int age;
Regex jourNaissance;
Regex moisNaissance;
Regex annesNaissance;
char saisieOuiNon;

// craction de ma liste utilisateur qui sera fortement typée
Liste<string> utilisateur = new Liste<string>();

    /*regex implamatation*/
    jourNaissance = new Regex  ("[0-9]{2}\/")
    moisNaissance = new Regex  ("[0-9]{2}\/")
    annesNaissance = new Regex ("[0-9]{4}")

    debut du do while
        do
            // Pour demande le nom et le prenom de la personne 
            afficher "Saisier un Nom et un Prénom."
            lire saisierNomPrenom

            // Pour demande l'age d'une personne
            afficher "Saisiez une date de naissance (01/01/2000)"
            lire dateNaissance
            si dateNaissance == jourNaissance && moisNaissance && annesNaissance
                faire un si 
                    debut de si
                        si jourNaissance > 31 || moisNaissance > 12
                            faire 
                                afficher "La date n'est pas correte"
                        sinon
                            age <-- annesCourante - annesNaissance;
                                si age >= 18
                                    alors   
                                        afficher "Quelle est votre métier"
                                        lire metier
                                sinon 
                                    alors
                                        afficher "Quelle est votre couleur préferée."
                                        lire couleurPref
                                fin de si
                        ageString <-- age.Tostring 
                        dateNaissanceString <-- dateNaissance.toString 
                    fin de si

            // on enregistre les reponse dans un tableaux 
            utilisateur.Add(saisierNomPrenom,dateNaissanceString,ageString,metier || couleurPref); 

            afficher "Voulez vous rajouter un autre utilisateur ? Non(n) ou Oui (o)"
            lire saisieOuiNon <-- Console.ReadKey(true).KeyChar;    // pour appyer sur un touche et valide le choix la toucher appuier va pas apparaietre 

        while (saisieOuiNon =='o' || saisieOuiNon =='O' )

        faire un foreach 
            debut du foreach
                foreach string info int utilisateur
                afficher personne
            fin du foreach

        afficher "Merci d'etres passer !"



```