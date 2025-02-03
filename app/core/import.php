<?php

require_once '../config/init.php';

try {
    $db = Database::getInstance()->getConnection();

    // Fonction pour importer les utilisateurs depuis un fichier JSON
    function importUsers($db, $siteName)
    {
        $filename = IMPORT."users_export_{$siteName}_" . date('Y-m-d') . ".json";

        // Vérifier si le fichier existe
        if (!file_exists($filename)) {
            return ["error" => "Aucun fichier trouvé pour $siteName aujourd'hui."];
        }

        // Lire le fichier JSON
        $jsonData = file_get_contents($filename);
        $data = json_decode($jsonData, true);

        if (!$data || !isset($data["users"])) {
            return ["error" => "Format invalide dans $filename."];
        }

        $importedUsers = [];
        $errors = [];

        foreach ($data["users"] as $user) {
            try {
                // Vérifier si l'utilisateur existe déjà via l'email
                $checkQuery = "SELECT id FROM utilisateur WHERE email = :email";
                $checkStmt = $db->prepare($checkQuery);
                $checkStmt->execute(["email" => $user["email"]]);
                $existingUser = $checkStmt->fetch();

                if ($existingUser) {
                    $errors[] = "Utilisateur avec email {$user["email"]} déjà existant.";
                    continue;
                }

                // Insérer l'utilisateur
                $insertQuery = "INSERT INTO utilisateur (nom, prenom, email, ville, adresse, code_postal,mot_de_passe) 
                                VALUES (:nom, :prenom, :email, :ville, :adresse, :code_postal, :mot_de_passe)";
                $stmt = $db->prepare($insertQuery);

                $stmt->execute([
                    "nom" => $user["nom"],
                    "prenom" => $user["prenom"],
                    "email" => $user["email"],
                    'adresse' => $user["adresse"],
                    "code_postal" => $user["code_postal"],
                    "ville" => $user["ville"],
                    "mot_de_passe" => $user["mot_de_passe"],
                ]);

                $importedUsers[] = $user["email"];
            } catch (PDOException $e) {
                $errors[] = "Erreur pour {$user["email"]} : " . $e->getMessage();
            }
        }

        return [
            "imported" => $importedUsers,
            "errors" => $errors
        ];
    }

    // Vérifier et importer les fichiers pour site_3
    $site1Import = importUsers($db, "site1");

    // Afficher le rapport d'importation
    echo json_encode([
        "site1" => $site1Import,
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    echo json_encode(["error" => "Erreur de base de données : " . $e->getMessage()], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
