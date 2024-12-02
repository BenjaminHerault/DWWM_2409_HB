// See https://aka.ms/new-console-template for more information

using MdevoldereTools;

Console.WriteLine("Tri de Nombres ++");

// VARIABLES

int numA;
int numB;
int numC;
int[] nombres;

// TRAITEMENT

numA = ConsoleTools.DemanderNombreEntier("Entrez le premier nombre");
numB = ConsoleTools.DemanderNombreEntier("Entrez le deuxième nombre");
numC = ConsoleTools.DemanderNombreEntier("Entrez le troisième nombre");

nombres = [numA, numB, numC];

Array.Sort(nombres);

// AFFICHAGE

    for (int i = 0; i < nombres.Length; i++)
    {
        Console.WriteLine(nombres[i]);
    }
    
Console.ReadLine();
