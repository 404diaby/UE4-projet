<?php
require_once CONFIG .'database.php';

/**
 * Class Announcement provides methods to interact with the announcement data in the database.
 * It handles CRUD operations and additional functionalities like toggling status or the sold attribute.
 */
class Announcement {
    /**
     * Retrieves all published advertisements from the database with their associated details.
     *
     * @return array|null Returns an array of all advertisements and their associated details if successful, or null in case of a database error.
     */
    public static function getAll() {
        try{
            $db = Database::getInstance()->getConnection();
            $query = "SELECT A.*, C.nom AS categorie_nom, E.nom AS etat_nom, S.nom AS status_nom, U.nom AS nom, U.prenom AS prenom
                FROM Annonce A,Utilisateur U,Categorie C,Etat E,Statut S
                WHERE 1 AND A.categorie_id = C.id AND A.etat_id = E.id AND A.statut_id = S.id AND A.utilisateur_id = U.id
                ORDER BY date_creation DESC;";
            $stmt = $db->query($query);
            writeLog('info',__FILE__,"Récuperation de toutes les annonces publiées a réussi");
            return  $stmt->fetchAll();
        }catch (PDOException $exception) {
            writeLog('error',__FILE__,"Récuperation de toutes les annonces publiées a echoue");
            return null;
        }

    }

    /**
     * Retrieves all published advertisements from the database with their associated details.
     *
     * @return array|null Returns an array of all published advertisements and their associated details if successful, or null in case of a database error.
     */
    public static function getAllPublish() {
        try{
            $db = Database::getInstance()->getConnection();
            $query = "SELECT A.*, C.nom AS categorie, U.nom AS utilisateur_nom, U.prenom AS utilisateur_prenom, C.nom AS categorie_nom, E.nom AS etat_nom, S.nom AS statut_nom
            FROM Annonce A,Utilisateur U,Categorie C,Etat E,Statut S
            WHERE 1 AND A.categorie_id = C.id AND A.etat_id = E.id AND A.statut_id = S.id AND A.utilisateur_id = U.id AND  A.statut_id = 1
            ORDER BY date_creation DESC;";
            $stmt = $db->query($query);
            writeLog('info',__FILE__,"Récuperation de toutes les annonces publiées a réussi");
            return  $stmt->fetchAll();
        }catch (PDOException $exception) {
            writeLog('error',__FILE__,"Récuperation de toutes les annonces publiées a echoue");
            return null;
        }

    }

    /**
     * Retrieves all published advertisements for a specific user based on their user ID, along with associated details.
     *
     * @param int $user_id The ID of the user whose advertisements are to be retrieved.
     * @return array|null Returns an array of all advertisements and their associated details for the given user if successful, or null in case of a database error.
     */
    public static  function getAllByUserId($user_id){
        try{
            $db = Database::getInstance()->getConnection();
            $query = "SELECT A.*, C.nom AS categorie, C.nom AS categorie_nom, E.nom AS etat_nom, S.nom AS statut_nom
            FROM Annonce A,Utilisateur U,Categorie C,Etat E,Statut S
            WHERE 1 AND A.categorie_id = C.id AND A.etat_id = E.id AND A.statut_id = S.id AND A.utilisateur_id = U.id AND  A.utilisateur_id = :user_id
            ORDER BY statut_nom, date_creation DESC;";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->execute();
            writeLog('info',__FILE__,"Récuperation de toutes les annonces publiées utilisateu ID ($user_id) a réussi");
            return  $stmt->fetchAll();

        }catch (PDOException $exception) {
            writeLog('error',__FILE__,"Récuperation de toutes les annonces publiées utilisateu ID ($user_id) a échoué : ".$exception->getMessage());
            return null;
        }

    }

    /**
     * Retrieves a specific advertisement by its ID, along with its associated details.
     *
     * @param int $announcement_id The ID of the advertisement to retrieve.
     * @return array|null Returns an associative array containing the advertisement details if successful, or null in case of a database error.
     */
    public static function getById($announcement_id) {
        try{
            $db = Database::getInstance()->getConnection();
            $query = "SELECT A.*, C.nom AS categorie, U.nom AS utilisateur_nom, U.prenom AS utilisateur_prenom,U.email AS utilisateur_email, C.nom AS categorie_nom,E.nom AS etat_nom, S.nom AS statut_nom
                    FROM Annonce A,Utilisateur U,Categorie C,Etat E, Statut S
                    WHERE 1  AND A.utilisateur_id = U.id AND  A.categorie_id = C.id AND A.etat_id = E.id AND  A.statut_id = S.id  AND A.id = :announcementId;";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":announcementId", $announcement_id);
            $stmt->execute();
            writeLog('info',__FILE__,"Récuperation de l'annonce  ID : ($announcement_id) a  réussi");
            return  $stmt->fetch();
        }catch (PDOException $exception) {
            writeLog('error',__FILE__,"Récuperation d\'une annonce par ID : ($announcement_id) a échoué : ".$exception->getMessage());
            return null;
        }

    }

    /**
     * Inserts a new advertisement into the database with the specified details.
     *
     * @param string $title The title of the advertisement.
     * @param string $description The description of the advertisement.
     * @param int $category_id The ID of the category associated with the advertisement.
     * @param int $state_id The ID of the state associated with the advertisement.
     * @param float $price The price of the advertisement.
     * @param string $image The image path or URL associated with the advertisement.
     * @param int $user_id The ID of the user creating the advertisement.
     * @return int|null Returns the number of rows affected if the insertion is successful, or null in case of a database error.
     */
    public static function set($title, $description, $category_id, $state_id, $price, $image, $user_id) {
        try{
            $db = Database::getInstance()->getConnection();
            $query = "INSERT INTO Annonce (titre,description,categorie_id,etat_id,prix,image, utilisateur_id ) VALUES 
                            (:title,:description,:category_id,:state_id,:price,:image,:user_id);";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":title",$title);
            $stmt->bindParam(":description",$description);
            $stmt->bindParam(":category_id",$category_id);
            $stmt->bindParam(":state_id",$state_id);
            $stmt->bindParam(":price",$price);
            $stmt->bindParam(":image",$image);
            $stmt->bindParam(":user_id",$user_id);
            $stmt->execute();
            writeLog('info',__FILE__,"Insertion d\'une annonce de l'utilisateur ID : ($user_id) a réussi");
            return $stmt->rowCount();
        }catch (PDOException $exception) {
            writeLog('error',__FILE__,"Insertion d\'une annonce de l'utilisateur ID : ($user_id) a  échoué : ".$exception->getMessage());
            return null;
        }
    }

    /**
     * Deletes an advertisement from the database by its ID.
     *
     * @param int $announcement_id The ID of the advertisement to be deleted.
     * @return int|null Returns the number of rows affected if the deletion is successful, or null if an error occurs.
     */
    public static function deleteById($announcement_id) {
        try {
            $db = Database::getInstance()->getConnection();
            $query = "DELETE FROM Annonce WHERE id = :announcement_id;";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":announcement_id", $announcement_id);
            $stmt->execute();
            writeLog('info',__FILE__,"Suppression de l'annonce ID : ($announcement_id) a réussi");
            return $stmt->rowCount();

        }catch (PDOException $exception) {
            writeLog('error',__FILE__,"Suppression de l'annonce ID : ($announcement_id) a échoué : ".$exception->getMessage());
            return null;
        }
    }

    /**
     * Toggles the "sold" attribute of an announcement for a specific user in the database.
     *
     * @param int $announcement_id The ID of the announcement to update.
     * @param int $user_id The ID of the user performing the update.
     * @return int|null Returns the number of rows affected if the operation is successful, or null in case of a database error.
     */
    public static function setSoldAttribute($announcement_id, $user_id) {
        try{
            $db = Database::getInstance()->getConnetion();
            $query = "UPDATE Annonce SET vendu = (vendu+1)%2 WHERE id = :announcement_id AND utilisateur_id = :user_id;";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":announcement_id", $announcement_id);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->execute();
            writeLog('info',__FILE__,"Mise à jour l'attribut vendu de l'annonce ID : ($announcement_id) par l'utilisateur ID ($user_id) a réussi");
            return $stmt->rowCount();
        }catch (PDOException $exception) {
            writeLog('error',__FILE__,"Mise à jour l'attribut vendu de l'annonce ID : ($announcement_id) par l'utilisateur ID ($user_id)  a échoué : ".$exception->getMessage());
            return null;
        }


    }

    /**
     * Updates the status attribute of a specific announcement for a given user.
     *
     * @param int $announcement_id The ID of the announcement to update.
     * @param int $user_id The ID of the user performing the update.
     * @return int|null Returns the number of rows affected if successful, or null in case of a database error.
     */
    public static function setStatusAttribut($announcement_id, $user_id) {
        try{
            $db = Database::getInstance()->getConnection();
            $query = "UPDATE Annonce SET statut_id = 1 + (statut_id % 2)  WHERE id = :announcement_id AND utilisateur_id = :user_id;";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":announcement_id", $announcement_id);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->execute();
            writeLog('info',__FILE__,"Mise à jour l'attribut statut de l'annonce ID : ($announcement_id) par l'utilisateur ID ($user_id) a réussi");
            return $stmt->rowCount();
        }catch (PDOException $exception) {
            writeLog('error',__FILE__,"Mise à jour l'attribut statut de l'annonce ID : ($announcement_id) par l'utilisateur ID ($user_id)  a échoué : ".$exception->getMessage());
            return null;
        }


    }



}

