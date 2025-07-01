<?php

require_once __DIR__ . '/Dbconnect.php';

class UserRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Dbconnexion::getInstance();
    }
    public function getAllUtilisateurs(): array
    {
        $sql = "SELECT id_utilisateur, nom_utilisateur, prenom_utilisateur, mail_utilisateur, id_niveau FROM utilisateurs";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
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
        return [];
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
        return true;
    }

    // Pour récupérer un utilisateur spécifique
    public function getUserById(int $id): ?array
    {
        return [];
    }
}
