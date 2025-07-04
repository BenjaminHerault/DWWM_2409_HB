<?php

require_once __DIR__ . "/Dbconnect.php";

class CandidateRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Dbconnexion::getInstance();
    }

    public function searchAll(): array
    {
        $stmt = $this->db->query("SELECT id_user, lastname_user, firstname_user, mail_user, pass_user, departement_user, age_user, is_admin FROM candidats");
        return $stmt->fetchAll();
    }

    public function createCandidate(
        string $lastname,
        string $firstname,
        string $mail,
        string $password,
        int $departement,
        int $age,
        int $admin = 0
    ): bool {
        $hash = password_hash($password, PASSWORD_ARGON2ID);
        $sql = "INSERT INTO candidats (lastname_user, firstname_user, mail_user, pass_user, departement_user, age_user, is_admin) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$lastname, $firstname, $mail, $hash, $departement, $age, $admin]);
    }

    public function searchByAge(int $_age): array
    {
        $sql = "SELECT id_user, lastname_user, firstname_user, mail_user, pass_user, departement_user, age_user FROM candidats Where age_user = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$_age]);
        return $stmt->fetchAll();
    }

    public function signIn(string $mail_user, string $pass_user)
    {
        $sql = "SELECT id_user, lastname_user, firstname_user, mail_user, pass_user, departement_user, age_user, is_admin FROM candidats WHERE mail_user = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$mail_user]);
        $result = $stmt->fetch();
        if ($result && password_verify($pass_user, $result['pass_user'])) {
            // On retourne toutes les infos utiles, y compris l'id_user
            return [
                'id_user' => $result['id_user'],
                'nom' => $result['lastname_user'],
                'prenom' => $result['firstname_user'],
                'email' => $result['mail_user'],
                'departement' => $result['departement_user'],
                'age' => $result['age_user'],
                'is_admin' => $result['is_admin']
            ];
        }
        return false;
    }

    public function updateCandidate(
        string $lastname,
        string $firstname,
        string $mail,
        ?string $password,
        int $departement,
        int $age,
        int $id_user
    ): bool {
        if ($password) {
            $hash = password_hash($password, PASSWORD_ARGON2ID);
            $sql = "UPDATE candidats SET lastname_user=?, firstname_user=?, mail_user=?, pass_user=?, departement_user=?, age_user=? WHERE id_user=?";
            $params = [$lastname, $firstname, $mail, $hash, $departement, $age, $id_user];
        } else {
            $sql = "UPDATE candidats SET lastname_user=?, firstname_user=?, mail_user=?, departement_user=?, age_user=? WHERE id_user=?";
            $params = [$lastname, $firstname, $mail, $departement, $age, $id_user];
        }
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }
    public function deleteCandidate(int $id_user): bool
    {
        $sql = "DELETE FROM candidats WHERE id_user = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_user]);
    }
}
