<?php

require_once __DIR__ . '/Dbconnect.php';

class UserRepository
{
    private $db;

    /**
     * Initialise la connexion à la base de données via le singleton
     */
    public function __construct()
    {
        $this->db = Dbconnexion::getInstance();
    }

    /**
     * Récupère tous les utilisateurs (sans mot de passe)
     * @return array Liste de tous les utilisateurs avec leurs informations de base
     */
    public function getAllUtilisateurs(): array
    {
        $sql = "SELECT id_utilisateur, nom_utilisateur, prenom_utilisateur, mail_utilisateur, id_niveau FROM utilisateurs";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Crée un nouvel utilisateur dans la base de données
     * @param string $lastname Nom de famille
     * @param string $firstname Prénom
     * @param string $mail Adresse email (doit être unique)
     * @param string $password Mot de passe en clair (sera hashé)
     * @param int $niveau Niveau d'accès (1=SuperAdmin, 2=Agent, 3=Propriétaire)
     * @return bool True si la création a réussi, false sinon
     */
    public function createUtilisateurs(
        string $lastname,
        string $firstname,
        string $mail,
        string $password,
        int $niveau = 0
    ): bool {

        $hash = password_hash($password, PASSWORD_ARGON2ID);
        $sql = "INSERT INTO utilisateurs (nom_utilisateur, prenom_utilisateur, mail_utilisateur, pass_utilisateur, id_niveau)VALUES(?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$lastname, $firstname, $mail, $hash, $niveau]);
    }

    // Pour l'authentification
    public function getUserByEmail(string $email): ?array
    {
        $sql = "SELECT id_utilisateur, nom_utilisateur, prenom_utilisateur, mail_utilisateur, pass_utilisateur, id_niveau 
                FROM utilisateurs 
                WHERE mail_utilisateur = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        return $user ? $user : null;
    }

    /**
     * Authentifie un utilisateur avec email et mot de passe
     */
    public function authenticateUtilisateur(string $email, string $password): ?array
    {
        $user = $this->getUserByEmail($email);

        if ($user && password_verify($password, $user['pass_utilisateur'])) {
            // Retourne les données utilisateur sans le mot de passe
            unset($user['pass_utilisateur']);
            return $user;
        }

        return null;
    }

    /**
     * Compte le nombre total d'utilisateurs
     */
    public function countTotalUtilisateurs(): int
    {
        $sql = "SELECT COUNT(*) FROM utilisateurs";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    /**
     * Récupère les derniers utilisateurs créés
     */
    public function getRecentUtilisateurs(int $limit = 5): array
    {
        $sql = "SELECT id_utilisateur, nom_utilisateur, prenom_utilisateur, mail_utilisateur, id_niveau 
                FROM utilisateurs 
                ORDER BY id_utilisateur DESC 
                LIMIT ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }

    // Pour vérifier les doublons
    public function emailExists(string $email): bool
    {
        // vérification d'unicité de l'email
        $sql = "SELECT COUNT(id_utilisateur)
        FROM utilisateurs 
        WHERE mail_utilisateur = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }

    // Pour la modification (Update)
    public function updateUtilisateur(int $id, array $data): bool
    {
        return true;
    }

    // Pour la suppression (Delete)  
    public function deleteUtilisateur(int $id): bool
    {
        $sql = "DELETE FROM utilisateurs WHERE id_utilisateur = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Pour récupérer un utilisateur spécifique
    public function getUserById(int $id): ?array
    {
        $sql = "SELECT id_utilisateur, nom_utilisateur, prenom_utilisateur, mail_utilisateur, id_niveau 
                FROM utilisateurs 
                WHERE id_utilisateur = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        return $user ? $user : null;
    }
}
