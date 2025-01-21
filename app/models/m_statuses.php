<?php
require_once CONFIG .'database.php';

class Statuses  {
    public static function getAll() {
        try{
            $db = Database::getInstance()->getConnetion();
            $query = "SELECT * FROM Statut";
            $stmt = $db->query($query);
            return  $stmt->fetchAll();

        }catch (PDOException $exception) {
            //TODO gere les logs + mode debug
            echo "Erreur lors de la récuperation des statuts".$exception->getMessage();
            error_log('DATABASE : Erreur lors de la récuperation des statuts - ' . $exception->getMessage());
            return null;
        }

    }




}

