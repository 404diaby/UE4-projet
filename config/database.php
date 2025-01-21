<?php

/*
namespace App\Core; // TODO code inutile
*/
//use PDO;
//use PDOException;

class Database
{
    //TODO Secure les id avec un fichier de configuration
    private $host = 'localhost'; //'sql8.freesqldatabase.com';
    private $dbname = 'site'; //'sql8758010';
    private $username = 'root';//'sql8758010';
    private $password ='root' ;// 'Xid375rxka';
    private $port ="8889";

    public $conn;

    private static $instance = null;

    public function __contruct(){}

    public static function getInstance()
    {
        if(self::$instance === null){
                self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnetion()
    {
        if ($this->conn === null) {
            try{
                $this->conn = new PDO("mysql:host=".$this->host.";port=".$this->port.";dbname=".$this->dbname,$this->username,$this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);
                echo "Connexion réussi"; //TODO mode debug
            }catch(PDOException $exception ) {
                //TODO gerer les logs + code inutile
                //echo "Erreur de connexion à la base de données.".$exception->getMessage();//TODO mode debug
                return null;

                /* linux/mac =>  /var/log/php_errors.log
                   apage,nginx => php.ini,
                            apache => /var/log/apache2/error.log   # (Ubuntu/Debian)
                                        /var/log/httpd/error_log     # (CentOS/RedHat)
                            nginx => /var/log/nginx/error.log
                Redirection vers un fichier spécifique => error_log("Erreur de connexion: " . $e->getMessage(), 3, "/var/log/mon_site.log");
                        3 indique un log personnalis

                Résumé :
📌 Par défaut, error_log() enregistre les erreurs dans le fichier défini dans php.ini (error_log setting).
📌 Si non configuré, elles peuvent être dans les logs Apache/Nginx.
📌 Tu peux forcer un fichier spécifique avec error_log("message", 3, "chemin_fichier.log").

🚀 Bonne pratique : Vérifie et configure correctement php.ini pour bien gérer les logs sur ton site e-commerce !


                // Envoyer un email au support technique
@mail("admin@monsite.com", "Problème de connexion BDD", "Erreur: " . $e->getMessage());
                */
                //error_log("Erreur de connexion : ".$exception->getMessage());
               // echo ini_get('error_log');

            }
        }
           return $this->conn;
    }

    public function __destruct()
    {
        $this->conn = null;
    }
        
}

