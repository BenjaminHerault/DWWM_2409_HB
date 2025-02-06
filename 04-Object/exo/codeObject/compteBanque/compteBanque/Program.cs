//using Classes;
//using System.Numerics;


//// compte a été créé pour    avec     solde initial
//// Account  was created for with initial balance.
//var account = new BankAccount("Benjamin", 1000);
//Console.WriteLine($"Un compte {account.Number} a été créé pour " +
//    $"{account.Owner} avec {account.Balance} solde initial.");


//account.MakeWithdrawal(500, DateTime.Now, "Paiement du loyer");
//Console.WriteLine(account.Balance);
//account.MakeDeposit(100, DateTime.Now, "un ami m'a remboursé");
//Console.WriteLine(account.Balance);

//Console.WriteLine(account.GetAccountHistory());

//// Testez que les soldes initiaux doivent être positifs:
//try
//{
//    var invalidAccount = new BankAccount("invalid", -55);
//}
//catch (ArgumentOutOfRangeException e)
//{
//    Console.WriteLine("Exception détectée lors de la création d'un compte avec un solde négatif");
//    Console.WriteLine(e.ToString());
//}

//// Rechercher un solde négatif
//try
//{
//    account.MakeWithdrawal(750, DateTime.Now, "Tentative de découvert");
//}
//catch (InvalidOperationException e)
//{
//    Console.WriteLine("Exception interceptée en essayant de mettre à découvert");
//    Console.WriteLine(e.ToString());
//}

//// https://learn.microsoft.com/fr-fr/dotnet/csharp/fundamentals/tutorials/classes
