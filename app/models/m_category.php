<?php
require_once CONFIG .'database.php';

class Category  {
    public static function getAll() {
        try{
            $db = Database::getInstance()->getConnetion();
            $query = "SELECT * FROM Categorie ORDER BY nom ASC;";
            $stmt = $db->query($query);
            return  $stmt->fetchAll();

        }catch (PDOException $exception) {
            //TODO gere les logs + mode debug
            echo "Erreur lors de la récuperation des categories".$exception->getMessage();
            error_log('DATABASE : Erreur lors de la récuperation des categories - ' . $exception->getMessage());
            return null;
        }

    }




}

