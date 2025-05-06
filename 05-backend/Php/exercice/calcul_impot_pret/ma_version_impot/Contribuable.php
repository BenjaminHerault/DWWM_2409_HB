<?php

class Contribuable
{
    private string $name;
    private float $revenue;

    //Définir les constantes pour les taux d'imposition 
    private const TAX_RATE_LOW = 0.09; //9%
    private const TAX_RATE_HIGH = 0.14; //14%
    private const REVENUE_THRESHOLD = 15000;

    public function __construct(string $name, float $revenue)
    {
        $this->name = $name;
        $this->revenue = $revenue;
    }
    public function calculImpot(): float
    {
        if($this->revenue <= self::REVENUE_THRESHOLD) return $this->revenue * self::TAX_RATE_LOW;
        else
        {
            $lowTax = self::REVENUE_THRESHOLD * self::TAX_RATE_LOW;
            $highTax = ($this->revenue - self::REVENUE_THRESHOLD) * self::TAX_RATE_HIGH;
            return $lowTax + $highTax;
        }
    }

    public function getName(): string 
    {
        return $this->name;
    }
}