<?php
require_once CONFIG .'database.php';

class Announcement {
    public static function getAllPublish() {
        try{
            $db = Database::getInstance()->getConnetion();
            $query = "SELECT A.*, C.nom AS categorie, U.nom AS utilisateur_nom, U.prenom AS utilisateur_prenom, C.nom AS categorie_nom, E.nom AS etat_nom, S.nom AS statut_nom
            FROM Annonce A,Utilisateur U,Categorie C,Etat E,Statut S
            WHERE 1 AND A.categorie_id = C.id AND A.etat_id = E.id AND A.statut_id = S.id AND A.utilisateur_id = U.id AND  A.statut_id = 1
            ORDER BY date_creation DESC;";
            $stmt = $db->query($query);
            return  $stmt->fetchAll();

        }catch (PDOException $exception) {
            //TODO gere les logs + mode debug
            echo "Erreur lors de la récuperation des annonces".$exception->getMessage();
            error_log('DATABASE : Erreur lors de la récuperation des annonces - ' . $exception->getMessage());
            return null;
        }

    }

    public static function getById($announcementId) {
        try{
            $db = Database::getInstance()->getConnetion();
            $query = "SELECT A.*, C.nom AS categorie, U.nom AS utilisateur_nom, U.prenom AS utilisateur_prenom,U.email AS utilisateur_email, C.nom AS categorie_nom,E.nom AS etat_nom, S.nom AS statut_nom
                    FROM Annonce A,Utilisateur U,Categorie C,Etat E, Statut S
                    WHERE 1  AND A.utilisateur_id = U.id AND  A.categorie_id = C.id AND A.etat_id = E.id AND  A.statut_id = S.id  AND A.id = :announcementId;";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":announcementId", $announcementId);
            $stmt->execute();
            return  $stmt->fetch();
        }catch (PDOException $exception) {
            //TODO gere les logs + mode debug
            echo "Erreur lors de la récuperation  d\'une annonce".$exception->getMessage();
            error_log('DATABASE : Erreur lors de la récuperation d\'une annonce - ' . $exception->getMessage());
            return null;
        }

    }

    public static function setAnnouncement($title, $description, $category_id, $state_id, $price, $status_id,$image,$user_id) {
        try{
            $db = Database::getInstance()->getConnetion();
            $query = "INSERT INTO Annonce (titre,description,categorie_id,etat_id,prix,statut_id,image, utilisateur_id ) VALUES 
                            (:title,:description,:category_id,:state_id,:price,:status_id,:image,:user_id);";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":title",$title);
            $stmt->bindParam(":description",$description);
            $stmt->bindParam(":category_id",$category_id);
            $stmt->bindParam(":state_id",$state_id);
            $stmt->bindParam(":price",$price);
            $stmt->bindParam(":status_id",$status_id);
            $stmt->bindParam(":image",$image);
            $stmt->bindParam(":user_id",$user_id);
            $stmt->execute();

            return $stmt->rowCount();
        }catch (PDOException $exception) {
            //TODO gere les logs + mode debug
            error_log('DATABASE : Erreur lors d\'insersion d\'une nouvelle annonce - ' . $exception->getMessage());

            echo "Erreur lors d\'insersion d\'une nouvelle annonce.".$exception->getMessage();
            return null;
        }
    }



}

