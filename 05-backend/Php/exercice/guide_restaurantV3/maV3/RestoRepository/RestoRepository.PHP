<?php

class RestoRepository
{
    private $pdo;

    public function __construct($_pdo)
    {
        $this->pdo = $_pdo;
    }

    //Méthode pour récupérer tous les restaurants
    public function searchAll(): array
    {
        $sql = "SELECT id, nom, adresse, prix, commentaire, note, visite FROM restaurants";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $restaurants = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $restaurants; 
    }
    // Affiche le restaurant correspondant à l'id sous forme tabulaire
    public function searchById($id): array
    {
        $sql = "SELECT id, nom, adresse, prix, commentaire, note, visite FROM restaurants WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $restaurant = $stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() == 0)
            {
                return [];
            }
            return $restaurant;
        } else {
            return [];
        }
    }
    // Méthode privée pour extraire les noms des colonnes d'une table 
    private function info_table($table): array
    {
        $sql = "DESCRIBE $table";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $desc = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $columns = [];
        $primaryKey = null;

        foreach ($desc as $col)
        {
            $columns[] = $col['Field'];
            if ($col['Key'] === 'PRI')              // PRI = Primary Key dans Mysql
            {
                $primaryKey = $col['Field'];
            }
        }

        return [
            'columns' => $columns,
            'primary' => $primaryKey
        ];
    }
    public function rendre_hyml(): string
    {
        // Récupérer toutes les données et les noms de colonnes 
        $donnees =$this->searchAll();
        $info = $this->info_table('restaurants');
        $colonnes = $info['columns'];
        $primary = $info['primary'];

        // Créer le tableau HTML
        $html = "<table class='restos' border='1'>";
        // Ligne d'en-tête avec les noms de colonnes
        $html .= "<tr>";
        foreach ($colonnes as $col) 
        {
            $html .= "<th>" . htmlspecialchars($col) . "</th>";
        }
        $html .= "</tr>";
        // Lignes de données
        foreach ($donnees as $ligne)
        {
            $html .= "<tr>";
            foreach($colonnes as $col)
            {
                $html .= "<td>" . htmlspecialchars($ligne[$col]) . "</td>";
            }
            $html .= "</tr>";
        }
        $html .= "</table>";
        return $html;
    }
    
}
