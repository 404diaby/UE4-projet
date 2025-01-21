<?php
require_once CONFIG .'database.php';

class State  {
    public static function getAll() {
        try{
            $db = Database::getInstance()->getConnetion();
            $query = "SELECT * FROM Etat ORDER BY nom ASC;";
            $stmt = $db->query($query);
            return  $stmt->fetchAll();

        }catch (PDOException $exception) {
            //TODO gere les logs + mode debug
            echo "Erreur lors de la récuperation des état".$exception->getMessage();
            error_log('DATABASE : Erreur lors de la récuperation des états - ' . $exception->getMessage());
            return null;
        }

    }




}

