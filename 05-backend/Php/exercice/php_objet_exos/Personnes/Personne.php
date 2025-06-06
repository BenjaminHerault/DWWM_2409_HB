<?php 

class Personne 
{
    protected string $nom;
    protected string $prenom;
    protected DateTime $dateNaissance;

    public function __construct(string $_nom, string $_prenom, DateTime $_dateNaissance)
    {
        $this->nom = $_nom;
        $this->prenom = $_prenom;
        $this->dateNaissance = $_dateNaissance;
    }
    public function getNom(): string
    {
        return $this->nom;
    }
    public function setNom(string $_nom): void
    {
        $this->nom = $_nom;
    }
    public function getPrenom(): string
    {
        return $this->prenom;
    }
    public function getAge(): int
    {
        $today = new DateTime();
        return $this->dateNaissance->diff($today)->y;
    }
}
