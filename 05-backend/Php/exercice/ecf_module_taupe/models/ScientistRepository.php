<?php

require_once __DIR__ . "/Dbconnect.php";


class ScientistRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Dbconnexion::getInstance();
    }

    public function searcheAll(): array
    {
        $stmt = $this->db->query("SELECT id_scientist, lastname_scientist, firstname_scientist, mail_scientist, pass_scientist, level_scientist FROM SCIENTISTS");
        return $stmt->fetchAll();
    }


    public function signIn(string $mail_scientist, string $pass_scientist): array|bool
    {
        $sql = "SELECT id_scientist, lastname_scientist, firstname_scientist, mail_scientist, pass_scientist, level_scientist
                FROM SCIENTISTS 
                WHERE mail_scientist = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$mail_scientist]);
        $result = $stmt->fetch();
        if ($result && password_verify($pass_scientist, $result['pass_scientist'])) {
            return [
                'id_scientist' => $result['id_scientist'],
                'lastname_scientist' => $result['lastname_scientist'],
                'firstname_scientist' => $result['firstname_scientist'],
                'mail_scientist' => $result['mail_scientist'],
                'level_scientist' => $result['level_scientist']
            ];
        }
        return false;
    }
}
