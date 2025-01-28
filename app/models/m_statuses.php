<?php
require_once CONFIG .'database.php';

/**
 * Provides methods for interacting with status data.
 *
 * This class contains static methods for retrieving and handling statuses
 * stored in the database.
 */
class Statuses  {
    /**
     * Retrieves all records from the Statut table.
     *
     * @return array|null An array of all statut records or null if an exception occurs.
     */
    public static function getAll() {
        try{
            $db = Database::getInstance()->getConnection();
            $query = "SELECT * FROM Statut";
            $stmt = $db->query($query);
            writeLog('info',__FILE__,"Récuperation des status réussi");
            return  $stmt->fetchAll();

        }catch (PDOException $exception) {
            writeLog('error',__FILE__,"Récuperation des status échoué : ".$exception->getMessage());
            return null;
        }

    }




}

