<?php

require_once 'Client.php';
require_once 'Intervenant.php';

class Intervention
{
   private DateTime$dateHeure;
   private string $description;
   private Intervenant $intervenant;
    private Client $client;

    public function __construct(string $_description, DateTime $_dateHeure , Intervenant $_intervenant, Client $_client)
    {
        $this->description = $_description;
        $this->dateHeure = $_dateHeure;
        $this->intervenant = $_intervenant;
        $this->client = $_client;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getIntervenant(): Intervenant
    {
        return $this->intervenant;
    }

    public function getDateHeure(): DateTime
    {
        return $this->dateHeure;
    }

    public function setDateHeure(DateTime $_dateHeure): void
    {
        $this->dateHeure = $_dateHeure;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $_description): void
    {
        $this->description = $_description;
    }


}