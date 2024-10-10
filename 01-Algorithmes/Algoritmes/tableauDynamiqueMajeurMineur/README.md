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
int dateNaissance;
int age;
Regex jourNaissance;
Regex moisNaissance;
Regex annesNaissance;

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
            lite dateNaissance
            faire un si 
                debut de si
                    si jourNaissance > 31 && moisNaissance > 12
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
        while

        afficher "Merci d'etres passer !"



```