//using System;
//using System.Collections.Generic;
//using System.Linq;
//using System.Reflection.Metadata;
//using System.Text;
//using System.Threading.Tasks;

//namespace Classes;

//public class BankAccount
//{
//    // propriétés
//    public string Number { get; }       // Number = Nombre
//    public string Owner { get; set; }   // Owner = Propriétaire
//    // Utilisez la directive #Region pour spécifier un bloc de code à développer ou à réduire
//    // à l’aide de la fonctionnalité du mode Plan de Visual Studio IDE. Vous pouvez placer,
//    // ou imbriquer, des régions dans d’autres régions pour regrouper des régions semblables.
//    #region BalanceComputation              
//    public decimal Balance
//    {
//        get
//        {
//            decimal balance = 0;
//            foreach (var item in _allTransactions)
//            {
//                balance += item.Amount;
//            }

//            return balance;
//        }
//    }


//    // constructeur 
//    public BankAccount(string name, decimal initialBalance)
//    {
//        Number = s_accountNumberSeed.ToString();
//        s_accountNumberSeed++; 

//        Owner = name;
//        MakeDeposit(initialBalance, DateTime.Now, "Solde initial");
//    }
//    // DateTime.Now = est une propriété qui retourne la date et l'heure actuelles
//    private List<Transaction> _allTransactions = new List<Transaction>();


//    // méthodes
//    public void MakeDeposit(decimal amount, DateTime date, string note) // MakeDeposit = Faire un dépôt
//    {
//        if (amount <= 0) 
//        {
//            throw new ArgumentOutOfRangeException(nameof(amount), "Le montant du dépôt doit être positif");
//        }
//        var deposit = new Transaction(amount, date, note);
//        _allTransactions.Add(deposit);
//    } 

//    public void MakeWithdrawal (decimal amount, DateTime date, string note) // MakeWithdrawal = Effectuer un retrait
//    {
//        if (amount <= 0) 
//        {
//            throw new ArgumentOutOfRangeException(nameof(amount), "Le montant du retrait doit être positif");
//        }
//        if (Balance - amount < 0 )
//        {
//            throw new InvalidOperationException("Pas de fonds suffisants pour ce retrait");
//        }
//        var withdrawal = new Transaction(-amount, date, note);
//        _allTransactions.Add(withdrawal);
//    }
//}

