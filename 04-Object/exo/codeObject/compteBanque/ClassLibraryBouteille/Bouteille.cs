using static System.Reflection.Metadata.BlobBuilder;

namespace ClassLibraryBouteille
{
    public class Bouteille
    {
        //attributs
        private double contenanceEnLitre { get; init; }
        private double contenuEnLitre { get; set; }
        private bool estOuverte { get; set; }

        //private string nom; fait en cours

        //constructeurs

        //constructeur par défaut 
        public Bouteille()
        {       

            this.contenanceEnLitre = 1.5;
            this.contenuEnLitre = 1.5;
            this.estOuverte = false;
            //this.nom = "bouteilleDeEau"; fait en cours
        }

        //public override string ToString()
        //{
        //    return base.ToString() + " contenanceEnLitre="+contenanceEnLitre;//etc..
        //}

        //public override bool Equals(object? obj)
        //{
        //    return this.nom.Equals(((Bouteille)obj).nom);
        //}                                                     fait en cours


        // constructeur classique 
        /// <summary>
        /// les parametre d'une bouteille 
        /// </summary>
        /// <param name="contenanceEnLitre"></param>
        /// <param name="contenuEnLitre"></param>
        /// <param name="estOuverte"></param>
        /// <exception cref="ArgumentException"></exception>
        public Bouteille(double contenanceEnLitre, double contenuEnLitre, bool estOuverte)
        {
            if (contenanceEnLitre <= 0) 
            {
                throw new ArgumentException("La contenanceEnLitre d'une bouteille ne peut pas être negative",nameof(contenanceEnLitre));
            }
            
            if (contenuEnLitre < 0)
            {
                throw new ArgumentException("La contenuEnLitre d'une bouteille ne peut pas être negative", nameof(contenuEnLitre));
            }
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
            //this.nom=bouteilleACopier.nom;        fait en cours
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
            if(quantiteEnLitre < 0)
            {
                throw new ArgumentException("value pas prix en compte", nameof(quantiteEnLitre));
            }
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
        /// si la bouteille et ouverte on peux la remplire  
        /// </summary>
        /// <returns>si la bouteille et ouverte contenuEnLitre = contenanceEnLitre</returns>
        public bool Remplir()
        {
            if (estOuverte && contenuEnLitre >= 0)
            {
                contenuEnLitre = contenanceEnLitre;
                return true;
            }
            else
            {
                return false;
            }
        }
        /// <summary>
        /// si la bouteille et ouverte on peux la remplire  on depasse pas la contenance 
        /// </summary>
        /// <param name="quantiteEnLitre"></param>
        /// <returns>si la bouteille et ouverte contenuEnLitre = contenuEnLitre + quantiteEnLitre;</returns>
        public bool Remplir(double quantiteEnLitre)
        {
            if (quantiteEnLitre<0)
            {
                throw new ArgumentException("value negatif impossible",nameof(quantiteEnLitre));
            }
            if (estOuverte && quantiteEnLitre <= (contenanceEnLitre - contenuEnLitre))
            {
              
                contenuEnLitre = contenuEnLitre + quantiteEnLitre;
                return true;
            }
            else
            {
                return false;
            }
        }
    }
}

