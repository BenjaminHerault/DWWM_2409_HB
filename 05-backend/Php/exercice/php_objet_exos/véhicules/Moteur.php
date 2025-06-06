<?php

class Moteur
{
    // Attributs protégés
    protected string $marque;
    protected int $vitesseMax;

    // Constructeur 
    public function __construct(string $_marque, int $_vitesseMax)
    {
        $this->marque = $_marque;
        $this->vitesseMax = $_vitesseMax;
    }
    // Getters pour la marque
    public function getMarque(): string
    {
        return $this->marque;
    }
    // Getters pour la vitesse max
    public function getVitesseMax(): int
    {
        return $this->vitesseMax;
    }
}