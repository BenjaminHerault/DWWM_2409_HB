<?php

require_once __DIR__ . "/Dbconnect.php";
//require_once __DIR__ = Ça permet d’inclure facilement d’autres fichiers du même dossier, sans se tromper de chemin, même si tu lances ton script depuis un autre endroit.

class CandidateRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Dbconnexion::getInstance();
    }

    public function searchAll(): array
    {
        $stmt = $this->db->query("SELECT id_user, lastname_user, firstname_user, mail_user, pass_user, departement_user, age_user FROM candidats");
        return $stmt->fetchAll();
    }

    public function createCandidate(
        string $lastname,
        string $firstname,
        string $mail,
        string $password,
        int $departement,
        int $age
    ): bool {
        $hash = password_hash($password, PASSWORD_ARGON2ID);
        $sql = "INSERT INTO candidats (lastname_user, firstname_user, mail_user, pass_user, departement_user, age_user) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$lastname, $firstname, $mail, $hash, $departement, $age]);
    }
    public function searchByAge(int $_age): array
    {
        $sql = "SELECT id_user, lastname_user, firstname_user, mail_user, pass_user, departement_user, age_user FROM candidats Where age_user = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$_age]);
        return $stmt->fetchAll();
    }
    public function signIn(string $mail_user, string $pass_user): bool
    {
        $sql = "SELECT pass_user FROM candidats WHERE mail_user = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$mail_user]);
        $result = $stmt->fetch();

        if ($result && password_verify($pass_user, $result['pass_user'])) {
            return true;
        }
        return false;
    }
}
