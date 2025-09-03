<?php class Dbconnexion
{
    private static ?PDO $connection = null;
    private static $host;
    private static  $user;
    private static  $pass;
    private static  $base;
    private static  $port;

    private function __construct() {}


    /**
     * Set the database configuration from a config file
     * on utilser self car ce pour le static 
     */
    public static function setConfig()
    {
        $config = require __DIR__ . '/../config/config.php';
        self::$host = $config['host'];
        self::$user = $config['user'];
        self::$pass = $config['password'];
        self::$base = $config['base'];
        self::$port = $config['port'] ?? 3306; 

    }
    public static function getInstance(): PDO
    {
        self::setConfig();
        // Vérification de la connexion
        if (self::$connection == null) {
            try {
                self::$connection = new PDO(
                    "mysql:host=" . self::$host . ";port=" . self::$port . "; dbname=" . self::$base . ";charset=utf8",
                    self::$user,
                    self::$pass,
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_CASE => PDO::CASE_LOWER, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC)
                );
            } catch (Exception $e) {
                die("Database connection failed" . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
