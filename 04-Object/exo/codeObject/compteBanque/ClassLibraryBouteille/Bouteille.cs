namespace ClassLibraryBouteille
{
    public class Bouteille
    {
        //attributs
        private double contenanceEnLitre;
        private double contenuEnLitre;
        private bool estOuverte;

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
        
        public Bouteille(double contenanceEnLitre,
            double contenuEnLitre)
            :this(contenanceEnLitre,contenuEnLitre,false)
        {
        }
    }
}
