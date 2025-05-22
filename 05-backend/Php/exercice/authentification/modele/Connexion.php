<?php class Connexion
{
    private static ?PDO $connection = null;
    private static string $host = 'localhost';
    private static string $user = 'root';
    private static string $pass = '';
    private static string $base = 'festival';
}
private function __construct(){}

public static function getInstance(): PDO
{
    
}