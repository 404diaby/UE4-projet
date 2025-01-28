<?php
require_once '../config/init.php';
/*$db = Database::getInstance()->getConnetion();
$query = "SELECT * FROM utilisateur WHERE site_1 = 1";
$result = $db->prepare($query);
$result->execute();
$rows = $result->fetchAll();

$json_users = json_encode($rows,JSON_PRETTY_PRINT);
header('Content-Type: application/json');
header('Content-Disposition: attachment; filename="users_export.json"');
echo $json_users;
exit();
*/


$db = Database::getInstance()->getConnection();
$query = "SELECT * FROM utilisateur WHERE site_1 = 1";
$result = $db->prepare($query);
$result->execute();
$rows = $result->fetchAll();

// Schéma de référence JSON
$schema = [
    "type" => "array",
    "items" => [
        "type" => "object",
        "properties" => [
            "id" => ["type" => "integer"],
            "nom" => ["type" => "string"],
            "prenom" => ["type" => "string"],
            "email" => ["type" => "string", "format" => "email"],
            "date_inscription" => ["type" => "string", "format" => "date-time"]
        ],
        "required" => ["id", "nom", "prenom", "email", "date_inscription"]
    ]
];

// Exportation au format JSON
$output = [
    "schema" => $schema,
    "data" => $rows
];
header('Content-Type: application/json');
echo json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

// Encode validated data
//$json_users = json_encode($rows, JSON_PRETTY_PRINT);

//header('Content-Disposition: attachment; filename="users_export.json"');
//echo $json_users;
exit();
//file_put_contents('users_export.json', $json_users);



