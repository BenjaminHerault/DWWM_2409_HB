using static System.Reflection.Metadata.BlobBuilder;

namespace ClassLibraryBouteille
{
    public class Bouteille
    {
        //attributs
        private double contenanceEnLitre { get; init; }
        private double contenuEnLitre { get; set; }
        private bool estOuverte { get; set; }

        //constructeurs

        //constructeur par défaut 
        public Bouteille()
        {
            this.contenanceEnLitre = 1.5;
            this.contenuEnLitre = 1.5;
            this.estOuverte = false;
        }
        // constructeur classique 
        public Bouteille(double contenanceEnLitre, double contenuEnLitre, bool estOuverte)
        {
            this.contenanceEnLitre = contenanceEnLitre;
            this.contenuEnLitre = contenuEnLitre;
            this.estOuverte = estOuverte;
        }
        //constructeur hybride classique defaut
        public Bouteille(double contenanceEnLitre,
            double contenuEnLitre)
            :this(contenanceEnLitre,contenuEnLitre,false)
        {
        }
        //constructeur hybride classique autre exemple
        public Bouteille(double contenanceEnLitre)
            :this(contenanceEnLitre, contenanceEnLitre, false)
        {
        }

        //constructeur par clonage
        public Bouteille(Bouteille bouteilleACopier)
        {
            this.contenanceEnLitre = bouteilleACopier.contenanceEnLitre;
            this.contenuEnLitre = bouteilleACopier.contenuEnLitre;
            this.estOuverte = bouteilleACopier.estOuverte;
        }

        public bool Ouvrir()                
        {
            if (estOuverte == true)     // si estOuverte et vrai
            {
                return false;           // alors la méthode Ouvrir() retourne faux 
            }                           // car on peux pas la réouvrir
            else
            {
                estOuverte = true;       // sinon la bouteille et fermer 
                return true;            // on l'ouvre et la méthode Ouvrir() retourner vrai 
            } 
        }
        public bool Fermer()
        {
            if (estOuverte == true)     //si estOuverte est vrai
            {                           //alors la méthode Fermer() retourne vrai
                return true;
            }                           //car on peux fermer la bouteille
            else
            {                           //sinon la bouteille et fermer
                return false;           //on peux pas la re fermer
            }    
        }
        //public bool Vider()
        //{
        //    if(estOuverte == true && )
        //}
    }
}
