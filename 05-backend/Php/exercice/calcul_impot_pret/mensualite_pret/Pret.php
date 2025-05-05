<?php

class Pret
{
    private float $capital;
    private float $tauxAnnuel;
    private float $dureeAnnees;

    public function __construct(float $capital, float $tauxAnnuel, int $dureeAnnees)
    {
        $this->capital = $capital;
        $this->tauxAnnuel = $tauxAnnuel;
        $this->dureeAnnees = $dureeAnnees;
    }

    public function calculMensualite(): float 
    {
        $tauxMensuel = $this->tauxAnnuel / 12 / 100;
        $nbMois = $this->dureeAnnees * 12;
        $q = 1 - pow(1 + $tauxMensuel, -$nbMois);
        return ($this->capital * $tauxMensuel) / $q;
    }

    public function tableauAmortissement(): string
    {
        // Génère le tableau d'amortissement sous forme HTML
        $mensualite = $this->calculMensualite();
        $tauxMensuel = $this->tauxAnnuel / 12 / 100;
        $nbMois = $this->dureeAnnees * 12;
        $capitalRestant = $this->capital;

        // $html = "<table class='table table-bordered'>";
        $html = "<table class='table table-dark table-hover'>";
        $html .= "<thead><tr><th>Mois</th><th>Intérêts (€)</th><th>Amortissement (€)</th><th>Capital restant dû (€)</th></tr></thead>";

        for ($mois = 1; $mois <= $nbMois; $mois++)
        {
            $interet = $capitalRestant * $tauxMensuel;
            $amortissement = $mensualite - $interet;
            $capitalRestant -= $amortissement;

            $html .= "<tr>";
            $html .= "<td>$mois</td>";
            $html .= "<td>" . number_format($interet, 2, ',', ' ') . "</td>";
            $html .= "<td>" . number_format($amortissement, 2, ',', ' ') . "</td>";
            $html .= "<td>" . number_format(max($capitalRestant, 0), 2, ',', ' ');
            $html .= "</tr>";
        }
        $html .= "</tbody></table>";
        return $html;
    }
    public function getTableauAmortissement(): array
    {
        $mensualite = $this->calculMensualite();
        $tauxMensuel = $this->tauxAnnuel / 12 / 100;
        $nbMois = $this->dureeAnnees * 12;
        $capitalRestant = $this->capital;

        $tableau = [];

        for ($mois = 1; $mois <= $nbMois; $mois++)
        {
            $interet = $capitalRestant * $tauxMensuel;
            $amortissement = $mensualite - $interet;
            $capitalRestant -= $amortissement;

            $tableau[] = [
                'mois' => $mois,
                'interet' => round($interet, 2),
                'amortissement' => round($amortissement, 2),
                'capital_restant' => round(max($capitalRestant, 0), 2),
            ];
        }

        return $tableau;

    }
}