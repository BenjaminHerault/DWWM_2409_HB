<?php class Dbconnexion
{
    private static ?PDO $connection = null;
    private const  HOST = 'localhost';
    private const  USER = 'root';
    private const  PASS = '';
    private const  BASE = 'agence_interim';

    private function __construct() {}

    public static function getInstance(): PDO
    {
        if (self::$connection == null) {
            try {
                self::$connection = new PDO(
                    "mysql:host=" . self::HOST . ";port=3306; dbname=" . self::BASE . ";charset=utf8",
                    self::USER,
                    self::PASS,
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_CASE => PDO::CASE_LOWER, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC)
                    /*
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
Définit le mode de gestion des erreurs : si une erreur SQL survient, une exception sera lancée (et non juste un avertissement).

PDO::ATTR_CASE => PDO::CASE_LOWER
Les noms des colonnes retournés par les requêtes seront toujours en minuscules.

PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
Par défaut, les résultats des requêtes seront retournés sous forme de tableaux associatifs (clé = nom de colonne).
                    */
                );
            } catch (Exception $e) {
                die("Database connection failed" . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
