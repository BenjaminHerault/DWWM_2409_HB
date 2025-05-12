<?php

class Voiture 
{
    // Attributs protégés
    protected string $marque;
    protected string $modele;
    protected int $poids;

    /*
    Les attributs sont définis comme protected pour respecter l'encapsulation et permettre l'accès dans  des classes héritées.
    */ 

    // Constructeur de la classe Voiture
    public function __construct(string $_marque, string $_modele, int $_poids=1000) 
    {
        $this->marque = $_marque;
        $this->modele = $_modele;
        $this->poids = $_poids;
    }
    // getters pour la marque
    public function getMarque(): string 
    {
        return $this->marque;
    }
    // Setters pour la marque
    public function setMarque(string $_marque): void 
    {
        $this->marque = $_marque;
    }
    // getters pour le modèle
    public function getModele(): string 
    {
        return $this->modele;
    }
    // Setters pour le modèle
    public function setModele(string $_modele): void 
    {
        $this->modele = $_modele;
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
    // Méthode pour afficher les informations de la voiture
    public function afficherInfos(): string 
    {
        return "{$this->marque} {$this->modele} pèse {$this->poids} kg.";
    }
}
// Exemple d'utilisation de la classe Voiture
$voiture = new Voiture("Renault", "Mégane", 750);
echo $voiture->afficherInfos(); // Affiche "Renault Mégane pèse 750 kg."