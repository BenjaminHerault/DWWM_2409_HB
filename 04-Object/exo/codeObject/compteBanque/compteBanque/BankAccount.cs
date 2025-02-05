using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Classes;

public class BankAccount
{
    private static int s_accountNumberSeed = 1234567890;
    // propriétés
    public string Number { get; }       // Number = Nombre
    public string Owner { get; set; }   // Owner = Propriétaire
    public decimal Balance { get; }


    // constructeur 
    public BankAccount(string name, decimal initialBalance)
    {
        this.Owner = name;
        this.Balance = initialBalance;
        Number = s_accountNumberSeed.ToString();
        s_accountNumberSeed++;
    }
    private List<Transaction> allTransactions = new List<Transaction>();

    // méthodes
    public void MakeDeposit(decimal amount, DateTime date, string note) // MakeDeposit = Faire un dépôt
    {
    }

    public void MakeWithdrawal (decimal amount, DateTime date, string note) // MakeWithdrawal = Effectuer un retrait
    {
    }
}

