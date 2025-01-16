<?php
namespace App\Core;

class Database
{
    //TODO Secure les id avec un fichier de configuration
    private $host = 'sql8.freesqldatabase.com';
    private $dbname = 'sql8758010';
    private $username = 'sql8758010';
    private $password = 'Xid375rxka';
    private $port ="3306";

    public $conn;

    private static $instance = null;

    public function __contruct(){}

    public static function getInstance(): Database 
    {
        if(self::$instance === null){
                self::$instance = new Database();
        }
        return self::$instance;
    }


    public function getConnetion(): ?\PDO 
    {
        if ($this->conn === null) {
            try{
                $this->conn = new \PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->username,$this->password);
                $this->conn->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);


            }catch(\PDOException $exception ) {
                error_log("Erreur de connexion : ".$exception->getMessage());
                echo "Erreur de connexion à la base de données.".$exception->getMessage();
            }
        }
           return $this->conn;

    }

    public function __destruct()
    {
        $this->conn = null;
    }
        
}

?>