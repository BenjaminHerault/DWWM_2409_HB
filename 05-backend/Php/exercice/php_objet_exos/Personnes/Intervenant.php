<?php

require_once 'Personne.php';

class Intervenant extends Personne
{
    private float $salaire;
    private float $autresRevenus;

    public function __construct(float $_salaire, float $_autresRevenus, DateTime $_dateNaissance, string $_prenom, string $_nom)
    {
        parent::__construct($_nom, $_prenom, $_dateNaissance);
        $this->salaire = $_salaire;
        $this->autresRevenus = $_autresRevenus;
    }

    public function getSalaire(): float
    {
        return $this->salaire;
    }
    public function setSalaire(float $_salaire): void
    {
        $this->salaire = $_salaire;
    }
    public function getAutresRevenus(): float
    {
        return $this->autresRevenus;
    }
    public function setAutresRevenus(float $_autresRevenus): void
    {
        $this->autresRevenus = $_autresRevenus;
    }

    public function calculerCharges(): float
    {
        $age= $this->getAge();
        $tauxSalaire= ($age>55) ? 0.10 : 0.20;
        $tauxAutresRevenus= ($age>55) ? 0.075 : 0.15;

        return ($this->salaire * $tauxSalaire) + ($this->autresRevenus * $tauxAutresRevenus);
    }
}