
        /*Variable*/

    int AnneeNaissance;
    int Age;

        /*Traitement*/
    DateTime localDate = DateTime.Now;
    Console.WriteLine("donner moi votre année de naissance");
    AnneeNaissance = int.Parse(Console.ReadLine());

    Age = localDate.Year - AnneeNaissance;

        /*Affichage*/
    if (18 <= Age)
    {
        Console.WriteLine("Vous êtes majeur vous avez "+Age+ " ans");
    }   
        else if (18 >= Age && 1<= Age)
        {
            Console.WriteLine("Vous êtes mineur vous avez " + Age+" ans");
        }
            else
            {
                Console.WriteLine("Vous n'êtes pas encore né ");
            }

    Console.WriteLine();
