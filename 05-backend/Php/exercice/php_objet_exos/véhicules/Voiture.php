<?php

require_once 'Moteur.php'; // Inclusion de la classe Moteur
class Voiture 
{
    // Attributs protégés
    protected string $marque;
    protected string $modele;
    protected int $poids;
    protected Moteur $moteur; // Attribut de type Moteur

    /*
    Les attributs sont définis comme protected pour respecter l'encapsulation et permettre l'accès dans  des classes héritées.
    */ 

    // Constructeur de la classe Voiture
    public function __construct(string $_marque, string $_modele, int $_poids=1000, Moteur $_moteur) 
    {
        $this->marque = $_marque;
        $this->modele = $_modele;
        $this->poids = $_poids;
        $this->moteur = $_moteur; // Initialisation de l'attribut moteur
    }
    // getters pour la marque
    public function getMarque(): string 
    {
        return $this->marque;
    }
    // getters pour le modèle
    public function getModele(): string 
    {
        return $this->modele;
    }
    // getters pour le poids
    public function getPoids(): int 
    {
        return $this->poids;
    }
    // Setters pour le poids
    public function setPoids(int $_poids): void 
    {
        $this->poids = $_poids;
    }
    // getters pour le moteur
    public function getMoteur(): Moteur 
    {
        return $this->moteur;
    }
    // Setters pour le moteur
    public function setMoteur(Moteur $_moteur): void 
    {
        $this->moteur = $_moteur;
    }
    // Méthode pour obtenir les détails de la voiture
    public function VoirInfo(): string
    {
        return "{$this->marque} {$this->modele}, {$this->poids} Kg, Moteur: {$this->moteur->getMarque()} ({$this->moteur->getVitesseMax()} Km/h)";
    }
    // Méthode pour calculer la vitesse maximale de la voiture 
    public function getVitesseMax(): float
    {
        $vitesse = $this->moteur->getVitesseMax() - ($this->poids * 0.3);
        return max(0, $vitesse); // Retourne 0 si la vitesse calculée est négative

    }
}
// Exemple d'utilisation 
    // $moteur = new Moteur("Ferrari", 300);
    // $voiture = new Voiture("Renault", "Clio", 1200, $moteur);
    // echo $voiture->VoirInfo(); // Affiche : Renault Clio, 1200 Kg, Moteur: Ferrari (300 km/h)
    // echo "\nVitesse max: " . $voiture->getVitesseMax() . " Km/h"; // Affiche la vitesse max calculée

    // $moteur2 = new Moteur("Peugeot", 200);
    // $voiture2 = new Voiture("Peugeot", "208", 1100, $moteur2);
    // echo "\n" . $voiture2->VoirInfo(); // Affiche : Peugeot 208, 1100 Kg, Moteur: Peugeot (200 km/h)
    // echo "\nVitesse max: " . $voiture2->getVitesseMax() . " Km/h"; // Affiche la vitesse max calculée

    // $moteur3 = new Moteur("Renault", 600);
    // $voiture3 = new Voiture("Renault", "Talisman", 1100, $moteur3);
    // echo "\n" . $voiture3->VoirInfo(); // Affiche : Renault Talisman, 1100 Kg, Moteur: Renault (600 km/h)
    // echo "\nVitesse max: " . $voiture3->getVitesseMax() . " Km/h"; // Affiche la vitesse max calculée

    // $moteur4 = new Moteur("Peugeot", 500);
    // $voiture4 = new Voiture("Peugeot", "508",1000,  $moteur4);
    // echo "\n" . $voiture4->VoirInfo(); // Affiche : Peugeot 508, 1000 Kg, Moteur: Peugeot (700 km/h)
    // echo "\nVitesse max: " . $voiture4->getVitesseMax() . " Km/h"; // Affiche la vitesse max calculée