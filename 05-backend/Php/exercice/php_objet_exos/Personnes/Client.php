<?php

require_once 'Personne.php';
require_once 'Adresse.php';

class Client extends Personne
{
    private string $numeroClient;
    private Adresse $adresse;
    public function __construct(string $_numeroClient, DateTime $_dateNaissance, string $_prenom, string $_nom, Adresse $_adresse)
    {
        parent::__construct($_nom, $_prenom, $_dateNaissance);
        $this->numeroClient = $_numeroClient;
        $this->adresse = $_adresse;
    }
    public function getNumeroClient(): string
    {
        return $this->numeroClient;
    }
    public function getAdresse(): Adresse
    {
        return $this->adresse;
    }
    public function setAdresse(Adresse $_adresse): void
    {
        $this->adresse = $_adresse;
    }
}