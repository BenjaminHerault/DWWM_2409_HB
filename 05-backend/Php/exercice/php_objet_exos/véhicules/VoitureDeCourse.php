<?php

require_once 'Voiture.php'; // Inclusion de la classe Voiture
require_once 'Moteur.php'; // Inclusion de la classe Moteur

class VoitureDeCourse extends Voiture 
{
    // constructeur spécifique pour la VoitureDeCourse
    public function __construct(string $_marque, string $_modele, int $_poids = 1000, Moteur $_moteur)
    { 

               
        // Appel du constructeur parent
        parent::__construct($_marque, $_modele, $_poids, $_moteur);

        // Vérifier que le moteur est de la même marque que la voiture
               if($this->marque !== $_moteur->getMarque()) throw new Exception("Le moteur doit être de la même marque que la voiture de course.");
    }

    //Redéfinir le setter pour le moteur avec la contrainte de marque
    public function setMoteur(Moteur $_moteur): void
    {
        if($this->marque !== $_moteur->getMarque())throw new Exception("Le moteur doit être de la même marque que la voiture de course.");
        $this->moteur = $_moteur;
    }

    // Redéfinir la méthode pour calculer la vitesse maximale 
    public function getVitesseMax(): float
    {
        return $this->moteur->getVitesseMax() - ($this->poids * 0.5);
    }
    // Rédéfinir la méthode pour obtenir les détails 
    public function getDetails(): string 
    {
        $vitesseMax = $this->getVitesseMax();
        return "{$this->marque} {$this->modele}, {$this->poids} Kg. Vitesse max : $vitesseMax Km/h.";
    }
}
// Exemple d'utilisation
try
{
    $moteur = new Moteur("Peugeot", 8000);
    $voitureDeCourse = new VoitureDeCourse("Renault", "F1", 450, $moteur);

    // $moteur2 = new Moteur("Peugeot", 800);
   
//    $voitureDeCourse->setMoteur($moteur2); // Cela lancera une exception car la marque ne correspond pas

//     echo $voitureDeCourse->getDetails(); // Affiche : Renault F1, 450 Kg. Vitesse max : 350 Km/h.


} catch (Exception $e) 
{
    echo "Erreur : " . $e->getMessage();
}