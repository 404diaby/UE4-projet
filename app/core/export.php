<?php
require_once '../config/init.php';

try {
    $db = Database::getInstance()->getConnection();

    // Fonction pour récupérer et exporter les utilisateurs par site
    function exportUsers($db, $siteColumn, $siteName) {
        $query = "SELECT * FROM utilisateur WHERE $siteColumn = 1 AND date_inscription > NOW() - INTERVAL 1 DAY";
        $result = $db->prepare($query);
        $result->execute();
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);

        if (empty($rows)) {
            return null; // Aucun utilisateur pour ce site
        }

        // Mapping des champs
        $mappedUsers = array_map(function ($user){
            return [
                "id" => $user["id"],
                "nom" => $user["nom"],
                "prenom" => $user["prenom"],
                "email" => $user["email"],
                'adresse' => $user["adresse"],
                "code_postal" => $user["code_postal"],
                "ville" => $user["ville"],
                "mot_de_passe" => $user["mot_de_passe"],

            ];
        }, $rows);

        // Générer le fichier JSON
        $filename = EXPORT."users_export_{$siteName}_" . date('Y-m-d') . ".json";
        file_put_contents($filename, json_encode(["users" => $mappedUsers], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return $filename; // Retourne le nom du fichier
    }

    // Exportation pour les deux sites
    $file1 = exportUsers($db, "site_1", "site1");
    $file2 = exportUsers($db, "site_2", "site2");

    // Préparer le téléchargement des fichiers
    if ($file1 && $file2) {
        echo json_encode([
            "message" => "Exportation réussie",
            "files" => [$file1, $file2]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } elseif ($file1) {
        echo json_encode([
            "message" => "Exportation réussie pour site_1",
            "files" => [$file1]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } elseif ($file2) {
        echo json_encode([
            "message" => "Exportation réussie pour site_2",
            "files" => [$file2]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(["error" => "Aucun utilisateur trouvé pour les deux sites"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

} catch (PDOException $e) {
    echo json_encode(["error" => "Erreur de base de données : " . $e->getMessage()], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
