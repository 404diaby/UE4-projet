<?php
require_once CONFIG .'database.php';

/**
 * The User class provides methods to handle user-related operations such as retrieval, creation, and listing users.
 * It interacts with the database to perform these operations and includes error handling with log writing.
 */
class User
{


    /**
     * Retrieves a user from the database by email if the provided password is correct.
     * Updates the user's last connection timestamp upon successful authentication.
     *
     * @param string $email The email address of the user to retrieve.
     * @param string $password The password of the user to verify.
     * @return array|null Returns an associative array containing the user's data if authentication is successful, or null otherwise.
     */
    public static function getUser($email, $password) {
        try{
            $db = Database::getInstance()->getConnection();
            $query = "SELECT * FROM Utilisateur WHERE  1 AND role = 'utilisateur' AND email = :email;";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":email",$email);
            $stmt->execute();
            $user = $stmt->fetch();
            writeLog('info',__FILE__,"Récuperation d\'un utilisateur par email réussi");
            if ($user && password_verify($password, $user['mot_de_passe'])) {
                $stmt = $db->prepare("CALL update_user_last_connection(:user_id)");
                $stmt->bindParam(":user_id", $user['id']);
                $stmt->execute();
                writeLog('info',__FILE__,"Mise à jour de la dernière connexion de l'utilisateur ID (".$user['id'].") a réussi");
                return $user;
            }
            return null;
        }catch (PDOException $exception) {
            writeLog('error',__FILE__,"Récuperation d\'un utilisateur par email échoué : " . $exception->getMessage());
            return null;
        }
    }


    /**
     * Retrieves an admin user from the database based on the provided email and password.
     *
     * @param string $email The email of the admin user.
     * @param string $password The password of the admin user.
     * @return array|null An associative array containing the admin user information if found and the password matches, or null if not.
     */
    public static function getAdmin($email, $password) {
        try{
            $db = Database::getInstance()->getConnection();
            $query = "SELECT * FROM Utilisateur WHERE  1 AND role = 'admin' AND email = :email;";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":email",$email);
            $stmt->execute();
            $user = $stmt->fetch();
            writeLog('info',__FILE__,"Récuperation des informations de l'admin a réussi");
            if ($user && password_verify($password, $user['mot_de_passe'])) {
                return $user;
            }
            return null;
        }catch (PDOException $exception) {
            writeLog('error',__FILE__,"Récuperation des informations de l'admin a échoué : " . $exception->getMessage());
            return null;
        }
    }


    /**
     * Inserts a new user into the database with the provided details.
     *
     * @param string $firstName The first name of the user.
     * @param string $lastName The last name of the user.
     * @param string $address The address of the user.
     * @param string $email The email address of the user.
     * @param string $zipCode The postal code of the user.
     * @param string $city The city of the user.
     * @param string $password The password of the user.
     * @param bool $site1Ckeck The first site preference for the user.
     * @param bool $site2Ckeck The second site preference for the user.
     * @return int|null The number of rows affected by the insert query if successful, or null on failure.
     */
    public static function setUser($firstName, $lastName, $address, $email, $zipCode, $city, $password, $site1Ckeck, $site2Ckeck) {
        try{
            $db = Database::getInstance()->getConnection();
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
            writeLog('info',__FILE__,"Insertion d\'un utilisateur réussi");
            return $stmt->rowCount();
        }catch (PDOException $exception) {
            echo $exception->getMessage();
            writeLog('error',__FILE__,"Insertion d\'un utilisateur échoué : " . $exception->getMessage());
            return null;
        }
    }


    public static function updateUser($firstName, $lastName, $address, $email, $zipCode, $city, $password, $site1Ckeck, $site2Ckeck, $userId) {
        try{
            $db = Database::getInstance()->getConnection();
            $query = "UPDATE Utilisateur SET nom = :firstName ,prenom = :lastName,adresse = :address,email = :email ,code_postal = :zipCode,ville = :city , site_1 = :site1, site_2 = :site2";
            if(isset($password)) {
                $query .= ", mot_de_passe = :password";
            }else{
                $query .= ", mot_de_passe = mot_de_passe ";

            }
            $query .= " WHERE id = :userId;";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":firstName",$firstName);
            $stmt->bindParam(":lastName",$lastName);
            $stmt->bindParam(":address",$address);
            $stmt->bindParam(":email",$email);
            $stmt->bindParam(":zipCode",$zipCode);
            $stmt->bindParam(":city",$city);
            if(isset($password)){
                $stmt->bindParam(":password",$password);
            }
            $stmt->bindParam(":site1",$site1Ckeck);
            $stmt->bindParam(":site2",$site2Ckeck);
            $stmt->bindParam(":userId",$userId);
            $stmt->execute();
            writeLog('info',__FILE__,"Modication de l'utilisateur ID ($userId) réussi");
            return $stmt->rowCount();
        }catch (PDOException $exception) {
            echo $exception->getMessage();
            writeLog('error',__FILE__,"Modication de l'utilisateur ID ($userId) échoué : " . $exception->getMessage());
            return null;
        }
    }

    /**
     * Retrieves a user from the database by their ID, including the count of active ads and the total number of sold ads.
     *
     * @param int $id The ID of the user to retrieve.
     * @return array|null An associative array containing the user information, the count of active ads, and the total sold ads if found, or null if not.
     */
    public static function getBy($id) {
        try{
            $db = Database::getInstance()->getConnection();
            $query = "SELECT U.*,COUNT(CASE WHEN A.statut_id = 1 THEN A.id END)  AS annonces_actives, SUM(A.vendu) as annonces_vendus
                        FROM Utilisateur U
                         LEFT JOIN Annonce A ON U.id = A.utilisateur_id 
                        WHERE  U.id = :id
                        GROUP BY U.id;";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            writeLog('info',__FILE__,"Récuperation de l' utilisateur ID : ($id) a réussi");
            return $stmt->fetch();
        }catch (PDOException $exception) {
            writeLog('error',__FILE__,"Récuperation de l' utilisateur ID : ($id) a échoué : " . $exception->getMessage());
            return null;
        }
    }

    /**
     * Retrieves all users with the role of 'utilisateur' from the database.
     *
     * @return array|null An array of associative arrays containing user information if successful, or null if an error occurs.
     */
    public static function getAllUsers() {
        try{
            $db = Database::getInstance()->getConnection();
            $query = "SELECT id,nom,prenom,adresse,ville,code_postal,email,role,statut,date_inscription,date_connexion, site_1,site_2 FROM Utilisateur WHERE  1 AND role = 'utilisateur' ;";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $user = $stmt->fetchALl();
            writeLog('info',__FILE__,"Récuperation des utilisateurs a réussi");
            return $user;
        }catch (PDOException $exception) {
            writeLog('error',__FILE__,"Récuperation des utilisateurs a échoué : " . $exception->getMessage());
            return null;
        }
    }



    public static function deleteUser($id) {
        try {
            $db = Database::getInstance()->getConnection();
            $query = "DELETE FROM Utilisateur WHERE  id = :id;";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            return $stmt->rowCount();
        }catch (PDOException $exception) {
            writeLog('error',__FIILE__,"Suppression de l' utilisateur ID ($id) a échoué  " . $exception->getMessage());
            return null;
        }
    }




    public static function setUserAsAdmin($firstName, $lastName, $address, $email, $zipCode, $city,$role, $password, $site1Ckeck, $site2Ckeck) {
        try{
            $db = Database::getInstance()->getConnection();
            $query = "INSERT INTO Utilisateur (nom,prenom,adresse,email,code_postal,ville,mot_de_passe,role, site_1, site_2) VALUES 
                            (:firstName,:lastName,:address,:email,:zipCode,:city,:password,:role,:site1,:site2);";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":firstName",$firstName);
            $stmt->bindParam(":lastName",$lastName);
            $stmt->bindParam(":address",$address);
            $stmt->bindParam(":email",$email);
            $stmt->bindParam(":zipCode",$zipCode);
            $stmt->bindParam(":city",$city);
            $stmt->bindParam(":password",$password);
            $stmt->bindParam(":role",$role);
            $stmt->bindParam(":site1",$site1Ckeck);
            $stmt->bindParam(":site2",$site2Ckeck);
            writeLog('error',$stmt);
            $stmt->execute();
            writeLog('info',__FILE__,"Insertion d\'un utilisateur comme admin réussi");
            return $stmt->rowCount();
        }catch (PDOException $exception) {
            echo $exception->getMessage();
            writeLog('error',__FILE__,"Insertion d\'un utilisateur comme admin échoué : " . $exception->getMessage());
            return null;
        }
    }



}

