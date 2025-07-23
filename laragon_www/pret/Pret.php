<?php

class Pret {
    private $capital;
    private $tauxAnnuel;
    private $dureeAnnees;

    /**
     * Constructeur de la classe Pret
     * @param float $capital Capital emprunté
     * @param float $tauxAnnuel Taux d'intérêt annuel en pourcentage
     * @param int $dureeAnnees Durée de remboursement en années
     */
    public function __construct($capital, $tauxAnnuel, $dureeAnnees) {
        $this->capital = $capital;
        $this->tauxAnnuel = $tauxAnnuel / 100; // Convertir le pourcentage en décimal
        $this->dureeAnnees = $dureeAnnees;
    }

    /**
     * Calcul de la mensualité constante
     * @return float Mensualité constante
     */
    public function calculMensualite() {
        $tauxMensuel = $this->tauxAnnuel / 12; // Taux mensuel
        $nbMois = $this->dureeAnnees * 12; // Nombre total de mois

        // Formule de calcul de la mensualité constante
        return ($this->capital * $tauxMensuel) / (1 - pow(1 + $tauxMensuel, -$nbMois));
    }

    /**
     * Génère le tableau d'amortissement
     * @return string Tableau d'amortissement sous forme de HTML
     */
    public function tableauAmortissement() {
        $mensualite = $this->calculMensualite();
        $resteCapital = $this->capital;
        $tauxMensuel = $this->tauxAnnuel / 12;
        $nbMois = $this->dureeAnnees * 12;

        $html = "<table class='table table-bordered'><thead><tr><th>Mois</th><th>Mensualité</th><th>Intérêts</th><th>Capital remboursé</th><th>Reste à payer</th></tr></thead><tbody>";

        for ($mois = 1; $mois <= $nbMois; $mois++) {
            $interet = $resteCapital * $tauxMensuel;
            $capitalRembourse = $mensualite - $interet;
            $resteCapital -= $capitalRembourse;

            $html .= "<tr>
                        <td>$mois</td>
                        <td>" . number_format($mensualite, 2, ',', ' ') . " €</td>
                        <td>" . number_format($interet, 2, ',', ' ') . " €</td>
                        <td>" . number_format($capitalRembourse, 2, ',', ' ') . " €</td>
                        <td>" . number_format(max($resteCapital, 0), 2, ',', ' ') . " €</td>
                      </tr>";
        }

        $html .= "</tbody></table>";
        return $html;
    }

    /**
     * Génère le tableau d'amortissement sous forme de tableau PHP
     * @return array Tableau d'amortissement
     */
    public function getTableauAmortissement() {
        $mensualite = $this->calculMensualite();
        $resteCapital = $this->capital;
        $tauxMensuel = $this->tauxAnnuel / 12;
        $nbMois = $this->dureeAnnees * 12;

        $tableau = [];

        for ($mois = 1; $mois <= $nbMois; $mois++) {
            $interet = $resteCapital * $tauxMensuel;
            $capitalRembourse = $mensualite - $interet;
            $resteCapital -= $capitalRembourse;

            $tableau[] = [
                'mois' => $mois,
                'mensualite' => round($mensualite, 2),
                'interet' => round($interet, 2),
                'capitalRembourse' => round($capitalRembourse, 2),
                'resteCapital' => round(max($resteCapital, 0), 2),
            ];
        }

        return $tableau;
    }
}