<?php
namespace App\Models;

require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'database.php';
use App\Core\Database;

class Utilisateur
{
    private $conn;
    private $table_name = "utilisateur";

    public function __construct() {
        // Obtient l'instance unique de Database
        $database = Database::getInstance();
        $this->conn = $database->getConnetion();
    }

/*


    public function getAllCategories(): ?array {
        try {
            $query = 'SELECT * FROM ' . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $lesCategories = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $lesCategories ?: null;  // Retourne null si aucun résultat
        } catch (\PDOException $e) {
            error_log('DATABASE : Erreur lors de l\'affichage des catégories - ' . $e->getMessage());
            return null;
        }
    }*/

}

?>