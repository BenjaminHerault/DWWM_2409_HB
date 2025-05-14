<?php

class Adresse
{
    private int $numeroRue;
    private string $nomRue;
    private string $codePostal;
    private string $commune;

    public function __construct(int $_numeroRue, string $_nomRue, string $_codePostal, string $_commune)
    {
        $this->numeroRue = $_numeroRue;
        $this->nomRue = $_nomRue;
        $this->codePostal = $_codePostal;
        $this->commune = $_commune;
    }

    public function getNumeroRue(): int
    {
        return $this->numeroRue;
    }
    public function getNomRue(): string
    {
        return $this->nomRue;
    }
    public function getCodePostal(): string
    {
        return $this->codePostal;
    }
    public function getCommune(): string
    {
        return $this->commune;
    }
}