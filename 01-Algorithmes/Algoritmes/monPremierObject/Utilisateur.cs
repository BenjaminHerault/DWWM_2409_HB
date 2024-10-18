using System;
namespace monPremierObject
{
    public class Utilisateur
    {
        //private Guid id;

        private string nom;

        private string prenom;

        private DateTime dateDeNaissance;

        private string? metier;

        private string? couleurPreferee;


        public Utilisateur(string _nomPrenom, string _dateDeNaissance)
        {
            string[] nomPrenomSepare = _nomPrenom.Split(" ");
            this.nom = nomPrenomSepare[0];
            this.prenom = nomPrenomSepare[1];

            if(!DateTime.TryParse(_dateDeNaissance, out dateDeNaissance))
            {
                throw new ArgumentException("Date de naissance invalide !");
            }
            if (dateDeNaissance > DateTime.Now)
            {
                throw new ArgumentException("La date doit êtres dans le passé !");
            }

        }

        public int GetAge()
        {
            TimeSpan intervalle = DateTime.Now - dateDeNaissance;
            int age = (int)(intervalle.Days / 365.25);
            return age;
        }

        public bool IsMajeur()
        {
            return this.GetAge() > 18;
        }

        public string? GetCouleurOuMetier()
        {
            if(metier == null && couleurPreferee == null)
            {
                throw new NullReferenceException("Le métier ou la couelur préférée doivent être renseignés ?");
            }
            if (this.IsMajeur())
            {
                return this.metier;
            }
            else
            {
                return this.couleurPreferee;
            }

            //return this.IsMajeur() ? this.metier : this.couleurPreferee;
        }

        public string GetDateDeNaissance()
        {
            return dateDeNaissance.ToShortDateString();
        }
        public void SetMetier(string _valeur)
        {
            this.metier = _valeur;
        }
        public void SetCouleursPreferee(string _valeur)
        {
            this.metier = _valeur;
        }

        public string GetNomComplet()
        {
            return prenom + " " + nom;
        }
            

    }
}