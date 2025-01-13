using System.Xml.Serialization;
using Users.ConsoleApp.Objects;

namespace Users.ConsoleApp.Serializer
{
    internal class Program
    {
        static void Main(string[] args)
        {
            Console.WriteLine("Sérialisation XML !");

            List<Utilisateur> users = new();

            Utilisateur u1 = new Utilisateur("DEV Mike", "12/11/1981");
            u1.SetMetier("Formateur");

            Utilisateur u2 = new Utilisateur("POG Cindy", "02/12/2009");
            u2.SetCouleurPreferee("Vert Pomme");

            Utilisateur u3 = new Utilisateur("GOLAY Jerry", "19/10/1999");
            u3.SetMetier("Artisan Boulanger");

            users.AddRange([u1, u2, u3]);

            XmlSerializer s = new(users.GetType());
            using StringWriter sw = new();
            s.Serialize(sw, users);

            Console.WriteLine(sw.ToString());
        }
    }
}
