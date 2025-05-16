<?php

class RestoRepository
{
    private $pdo;

    public function __construct($_pdo)
    {
        $this->pdo = $_pdo;
    }

    //Méthode pour récupérer tous les restaurants
    public function searchAll()
    {
        $sql = "SELECT id, nom, adresse, prix, commentaire, note, visite FROM restaurants";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $restaurants = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $restaurants; 
    }
    // Affiche le restaurant correspondant à l'id sous forme tabulaire
    public function searchById($id)
    {
        $sql = "SELECT id, nom, adresse, prix, commentaire, note, visite FROM restaurants WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $restaurant = $stmt->fetch(PDO::FETCH_ASSOC);
        if($restaurant)
        {
            // Afficher sous forme de tableau HTML
            echo "<table border='1'><tr>";
            foreach($restaurant as $key => $value)
            {
                echo "th" . htmlspecialchars($key) . "</th>";
            } 
            echo "</tr><tr>";
            foreach($restaurant as $key => $value)
            {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr></table>";
        }
        else
        {
            echo "Aucun restaurant trouvé avec cet ID : " . htmlspecialchars($id);
        }
    }
}