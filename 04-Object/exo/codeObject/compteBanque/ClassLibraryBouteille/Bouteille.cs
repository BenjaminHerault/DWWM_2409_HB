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
        /// <summary>
        /// si estOuverte et vrai
        /// alors la méthode Ouvrir() retourne faux 
        /// car on peux pas la réouvrir
        /// sinon la bouteille et fermer
        /// on l'ouvre et la méthode Ouvrir() retourner vrai 
        /// </summary>
        /// <returns>si la bouteille et fermer on l'ouvre</returns>
        public bool Ouvrir()                
        {
            if (estOuverte)     
            {
                return false;           
            }                           
            else
            {
                estOuverte = true;         
                return true;             
            } 
        }
        /// <summary>
        /// si estOuverte est vrai
        /// alors la méthode Fermer() retourne vrai
        /// car on peux fermer la bouteille
        /// sinon la bouteille et fermer
        /// on peux pas la re fermer
        /// </summary>
        /// <returns>si la boutielle et ouverte on la ferme</returns>
        public bool Fermer()
        {
            if (estOuverte )     
            {        
                estOuverte = false;
                return false;
            }                           
            else
            {                           
                return false;           
            }    
        }
        /// <summary>
        /// estOuverte == true && contenuEnLitre >=0
        /// si (estOuverte et vrai et que contenuEnLitre >=0)
        /// alors
        ///contenuEnLitre = 0
        ///on retourne vrai
        ///sinon
        ///on retourne false 
        /// </summary>
        /// <returns>pour vider la bouteille si elle et ouverte et quelle contiens un liquide </returns>
        public bool Vider()
        {
            if (estOuverte  && contenuEnLitre >=0)
            {
                contenuEnLitre = 0;
                return true;
            }
            else
            {
                return false;
            }
        }
        /// <summary>
        /// si estOuverte == true && quantiteEnLitre <= contenuEnLitre && quantiteEnLitre > 0
        ///                                   2      <= 1       et          1 > 0
        ///   sinon 
        ///   rien se passe 
        /// </summary>
        /// <param name="quantiteEnLitre"></param>
        /// <returns></returns>
        public bool Vider(double quantiteEnLitre)
        {
            if (estOuverte && quantiteEnLitre <= contenuEnLitre && quantiteEnLitre > 0)                                        
            {
                contenuEnLitre = contenuEnLitre - quantiteEnLitre;
                return true;
            }
            else
            {
                return false;
            }
        }

        /// <summary>
        /// 
        /// </summary>
        /// <returns></returns>
        public bool Remplir()
        {
            if (estOuverte && contenuEnLitre >= 0)
            {
                contenuEnLitre = 0;
                return true;
            }
            else
            {
                return false;
            }
        }
        //public bool Remplir(double quantiteEnLitre)
        //{
        //    return true;
        //}
    }
}

