using Classes;
using System.Numerics;


// compte a été créé pour    avec     solde initial
// Account  was created for with initial balance.
var account = new BankAccount("Benjamin", 1000);
Console.WriteLine($"Un compte {account.Number} a été créé pour " +
    $"{account.Owner} avec {account.Balance} solde initial.");


// https://learn.microsoft.com/fr-fr/dotnet/csharp/fundamentals/tutorials/classes