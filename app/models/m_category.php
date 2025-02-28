<?php
require_once CONFIG .'database.php';


/**
 * Class Category
 *
 * Provides methods to manage and retrieve category data from the database.
 */
class Category  {

    /**
     * Retrieves all categories from the database, ordered by their names in ascending order.
     *
     * @return array|null Returns an array of categories if the query is successful, or null in case of a database error.
     */
    public static function getAll() {
        try{
            $db = Database::getInstance()->getConnection();
            $query = "SELECT * FROM Categorie ORDER BY nom ASC;";
            $stmt = $db->query($query);
            writeLog('info',__FILE__,"Récuperation des catégories  réussi");
            return  $stmt->fetchAll();
        }catch (PDOException $exception) {
            writeLog('error',__FILE__,"Récuperation des catégories échoué : ".$exception->getMessage());
            return null;
        }

    }




}

