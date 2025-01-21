<?php
require_once CONFIG .'database.php';
class User
{
    public static function getUser($email, $password) {
        try{
            $db = Database::getInstance()->getConnetion();
            $query = "SELECT * FROM Utilisateur WHERE  email = :email;";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":email",$email);
            $stmt->execute();
            $user = $stmt->fetch();
            if ($user && password_verify($password, $user['mot_de_passe'])) {
                return $user;
            }
            return null;
        }catch (PDOException $exception) {
            //TODO gere les logs + mode debug
            error_log('DATABASE : Erreur lors de la récuperation d\'un utilisateur - ' . $exception->getMessage());
            echo "Erreur lors de la récuperation d\'un utilisateur.".$exception->getMessage();
            return null;
        }
    }


    public static function setUser($firstName,$lastName,$address,$email,$zipCode,$city,$password,$site1Ckeck = 0 ,$site2Ckeck = 0 ) {
        try{
            $db = Database::getInstance()->getConnetion();
            $query = "INSERT INTO Utilisateur (nom,prenom,adresse,email,code_postal,ville,mot_de_passe, site_1, site_2) VALUES 
                            (:firstName,:lastName,:address,:email,:zipCode,:city,:password,:site1,:site2);";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":firstName",$firstName);
            $stmt->bindParam(":lastName",$lastName);
            $stmt->bindParam(":address",$address);
            $stmt->bindParam(":email",$email);
            $stmt->bindParam(":zipCode",$zipCode);
            $stmt->bindParam(":city",$city);
            $stmt->bindParam(":password",$password);
            $stmt->bindParam(":site1",$site1Ckeck);
            $stmt->bindParam(":site2",$site2Ckeck);
            $stmt->execute();
            return $stmt->rowCount();
        }catch (PDOException $exception) {
            //TODO gere les logs + mode debug
            error_log('DATABASE : Erreur lors d\'insersion d\'un nouvelle utilisateur - ' . $exception->getMessage());
            echo "Erreur lors d\'insersion d\'un nouvelle utilisateur.".$exception->getMessage();
            return null;
        }
    }

}

