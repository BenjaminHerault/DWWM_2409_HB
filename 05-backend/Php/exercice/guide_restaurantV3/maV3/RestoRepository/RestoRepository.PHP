<?php

class RestoRepository
{
    private $pdo;

    public function __construct($_pdo)
    {
        date_default_timezone_set('Europe/Paris');
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
            if ($stmt->rowCount() == 0) {
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

        foreach ($desc as $col) {
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
        $donnees = $this->searchAll();
        $info = $this->info_table('restaurants');
        $colonnes = $info['columns'];
        $primary = $info['primary'];

        // Créer le tableau HTML
        $html = "<table class='restos table table-bordered'>";
        // Ligne d'en-tête avec les noms de colonnes + Détail 
        $html .= "<tr>";
        foreach ($colonnes as $col) {
            $html .= "<th>" . htmlspecialchars($col) . "</th>";
        }
        $html .= "<th>Detail</th>";
        $html .= "<th>Modifier</th>";
        $html .= "<th>Supprimer</th>";
        $html .= "</tr>";

        // Lignes de données
        foreach ($donnees as $ligne) {
            $html .= "<tr>";
            foreach ($colonnes as $col) {
                $html .= "<td>" . htmlspecialchars($ligne[$col]) . "</td>";
            }
            // Lien vers la page de détail
            $id = htmlspecialchars($ligne[$primary]);
            $html .= "<td><a href='./detail.php?id=$id' class='btn btn-info btn-sm'>Voir Détails</a></td>";
            $html .= "<td><a href='../fichedetail.php?id=$id' class='btn btn-warning btn-sm'>Modifier</a></td>";

            //Formulaire de suppression
            $html .= "<td>
                <form method='post' action='' style='display:inline;' onsubmit=\"return confirm('Voulez-vous vraiment supprimer ce restaurant ?');\">
                    <input type='hidden' name='delete_id' value='$id'>
                    <button type='submit' name='delete' class='btn btn-danger btn-sm'>Supprimer</button>
                </form>
            </td>";
            $html .= "</tr>";
        }
        $html .= "</table>";
        return $html;
    }
    public function deleteRow($id): bool
    {
        $sql = "DELETE FROM restaurants WHERE id= :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function modifierRow($id, $data): bool
    {
        // On enlève la clé primaire du tableau de données (on ne la modifie pas)
        unset($data['id']);

        // Met à jour la date de modification
        $data['visite'] = date('Y-m-d H:i:s');

        // On construit la requête SQL
        $set = [];
        foreach ($data as $col => $val) {
            $set[] = "$col = :$col";
        }
        $sql = "UPDATE restaurants SET " . implode(", ", $set) . " WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        // Bind des valeurs
        foreach ($data as $col => $val) {
            $stmt->bindValue(":$col", $val);
        }
        $stmt->bindValue(":id", $id);

        return $stmt->execute();
    }
    public function addRow($nom, $adresse, $prix, $commentaire, $note): bool
    {
        $sql = "INSERT INTO restaurants (nom, adresse, prix, commentaire, note) 
            VALUES (:nom, :adresse, :prix, :commentaire, :note)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nom', $nom);
        $stmt->bindValue(':adresse', $adresse);
        $stmt->bindValue(':prix', $prix);
        $stmt->bindValue(':commentaire', $commentaire);
        $stmt->bindValue(':note', $note);
        return $stmt->execute();
    }
}
