<?php

/**
 * Class Database
 *
 * Provides a singleton pattern implementation for database connection.
 * This class allows establishing a connection to a MySQL database using PDO.
 * The database configuration details such as host, database name, username,
 * password, and port are set as private properties.
 *
 * It ensures that there is a single shared instance of the database connection
 * across the application and prevents instantiation, cloning, or unserializing
 * of multiple database objects.
 */
class Database
{
    //TODO Secure les id avec un fichier de configuration
    private $host = 'localhost'; //'sql8.freesqldatabase.com';
    private $dbname = 'site'; //'sql8758010';
    private $username = 'root';//'sql8758010';
    private $password = 'root';// 'Xid375rxka';
    private $port = "8889";

    public $conn;

    private static $instance = null;

    public function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        if ($this->conn === null) {
            try {
                $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->dbname, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                $this->conn->setAttribute(PDO::ATTR_PERSISTENT, true);
                writeLog('info', __FILE__, 'Connexion à la base de donnée réussi');
            } catch (PDOException $exception) {
                writeLog('error', __FILE__, 'Connexion à la base de donnée échoué [' . $exception->getCode() . '] ' . $exception->getMessage());
                return null;
            }
        }
        return $this->conn;
    }

    public function __destruct()
    {
        if ($this->conn !== null) {
            $this->conn = null;
        }
    }


    private function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton");
    }

}

