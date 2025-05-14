<?php
class Pret
{
    // Attributs
    private float $capital;
    private float $tauxMensuel;
    private int $nbMois;

    // propriétés
    // accesseurs
    public function getCapital(): float
    {
        return $this->capital;
    }
public function getTauxMensuel(): float
    {
        return $this->tauxMensuel;
    }
public function getNbMois(): int
    {
        return $this->nbMois;
    }

    // Modifieur
public function setMois(int $nbNouvMois): void
    {
        $this->nbMois = $nbNouvMois;
    }

    // Constructeur
    public function __construct(float $_montant, float $_tauxAnnuel, int $_dureeAnnees)
   {
        $this->capital = $_montant;
        $this->tauxMensuel = $_tauxAnnuel/1200; 
        $this->nbMois = $_dureeAnnees * 12; // Convertir les années en mois
    }

    // Méthodes
    public function calculMensualite(): float
    {
        // Formule de calcul de la mensualité constante
        $Q = (1- pow((1+$this->tauxMensuel),-$this->nbMois ));
        $mensualite = ($this->capital * $this->tauxMensuel) / $Q;
        return round($mensualite,2);
    }

    //methode pour afficher la mensualité avec le formatage
    
    public function calculMensualite2(): string
    {
        // Formule de calcul de la mensualité constante
        $Q = (1- pow((1+$this->tauxMensuel),-$this->nbMois ));
        $mensualite = ($this->capital * $this->tauxMensuel) / $Q;
        return number_format($mensualite, 2, ',', ' ') . " €";
    }
       

    public function getTableauAmortissement(): array
    {
        $data=[];
        $numeroMois = 0;
        $parInteret = 0;
        $partAmortissement = 0;
        $mensualite = $this->calculMensualite();
        $capitalRestant = $this->capital;

        for ($i=0;$i <$this->nbMois; $i++){
     
            $parInteret=$capitalRestant*$this->tauxMensuel;
            $partAmortissement=$mensualite-$parInteret;
            if($i>0)
            {
                $capitalRestant-=$partAmortissement;
            }
            $numeroMois++;

            array_push($data,[
                'num_mois' => $numeroMois,
                'partInteret' =>round($parInteret,2),
                'partAmortissement' => round($partAmortissement,2),
                'capital_restant' => round($capitalRestant,2),
                'mensualite' => round($mensualite,2),
            ]);
        }
        return $data;
    }

}