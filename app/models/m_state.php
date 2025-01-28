<?php
require_once CONFIG .'database.php';


/**
 * A utility class for managing state information retrieved from the 'Etat' table.
 */
class State  {
    /**
     * Retrieves all records from the 'Etat' table, ordered by the 'nom' column in ascending order.
     *
     * @return array|null Returns an array of all records if the query is successful, or null if an exception occurs.
     */
    public static function getAll() {
        try{
            $db = Database::getInstance()->getConnection();
            $query = "SELECT * FROM Etat ORDER BY nom ASC;";
            $stmt = $db->query($query);
            writeLog('info',__FILE__,"Récuperation des états réussi");
            return  $stmt->fetchAll();

        }catch (PDOException $exception) {
            writeLog('error',__FILE__,"Récuperation des états échoué : ".$exception->getMessage());
            return null;
        }

    }




}

