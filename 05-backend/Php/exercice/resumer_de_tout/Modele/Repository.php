<?php

require_once __DIR__ . '/Dbconnect.php';

/* 
require_once :
Cette instruction permet d’inclure un fichier PHP une seule fois.
Si le fichier a déjà été inclus, il ne le sera pas à nouveau (évite les doublons et les erreurs de redéclaration).

__DIR__ :
C’est une constante magique PHP qui contient le chemin absolu du dossier où se trouve le fichier courant.
Cela rend l’inclusion du fichier indépendante du dossier courant d’exécution.
*/

/**
 * Classe Repository pour gérer les opérations CRUD sur la table resum
 */
class Repository
{
    private PDO $db;

    /**
     * Constructeur : utilise la connexion partagée via Dbconnexion (singleton)
     */
    public function __construct()
    {
        // On récupère l'instance PDO unique de la classe Dbconnexion
        $this->db = Dbconnexion::getInstance();
    }

    /**
     * Récupère tous les utilisateurs de la table resum
     * @return array Tableau associatif de tous les utilisateurs
     */
    public function searchAll(): array
    {
        $sql = "SELECT id, name_, mail_user, pass_user FROM resum";
        $stmt = $this->db->query($sql);
        /*
        query($sql) : exécute une requête SQL directement (ici un SELECT) et retourne un objet de type PDOStatement.
        query() s’utilise pour les requêtes sans paramètres (ex : SELECT * FROM table).
Pour des requêtes avec des variables (ex : WHERE id = ?), il faut utiliser prepare() + execute() pour éviter les injections SQL.
        */
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        /*
        FETCH_ASSOC : signifie "fetch associative", c’est-à-dire que les résultats seront retournés sous forme de tableaux associatifs (avec les noms des colonnes comme clés).
        */
    }

    /**
     * Crée un nouvel utilisateur dans la table resum
     * @param string $name Nom de l'utilisateur
     * @param string $mail Email de l'utilisateur
     * @param string $password Mot de passe en clair (sera hashé)
     * @return bool Succès ou échec de l'insertion
     */
    public function createCandidate(string $name, string $mail, string $password): bool
    {
        $hash = password_hash($password, PASSWORD_ARGON2ID);
        $sql = "INSERT INTO resum (name_, mail_user, pass_user) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $mail, $hash]);
    }

    /**
     * Vérifie la connexion d'un utilisateur (login)
     * @param string $mail Email saisi
     * @param string $password Mot de passe saisi
     * @return array|false Retourne l'utilisateur si OK, sinon false
     */
    public function signIn(string $mail, string $password)
    {
        $sql = "SELECT id, name_, mail_user, pass_user FROM resum WHERE mail_user = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$mail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['pass_user'])) {
            return $user;
        }
        return false;
    }

    /**
     * Met à jour un utilisateur existant
     * @param int $id ID de l'utilisateur à modifier
     * @param string $name Nouveau nom
     * @param string $mail Nouvel email
     * @param string|null $password Nouveau mot de passe (optionnel)
     * @return bool Succès ou échec de la modification
     */
    public function updateCandidate(int $id, string $name, string $mail, ?string $password = null): bool
    {
        if ($password) {
            $hash = password_hash($password, PASSWORD_ARGON2ID);
            $sql = "UPDATE resum SET name_=?, mail_user=?, pass_user=? WHERE id=?";
            $params = [$name, $mail, $hash, $id];
        } else {
            $sql = "UPDATE resum SET name_=?, mail_user=? WHERE id=?";
            $params = [$name, $mail, $id];
        }
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Supprime un utilisateur de la table resum
     * @param int $id ID de l'utilisateur à supprimer
     * @return bool Succès ou échec de la suppression
     */
    public function deleteCandidate(int $id): bool
    {
        $sql = "DELETE FROM resum WHERE id=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}
