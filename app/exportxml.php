<?php
require_once '../config/init.php';
$db = Database::getInstance()->getConnection();
$query = "SELECT * FROM utilisateur WHERE site_1 = 1";
$result = $db->prepare($query);
$result->execute();
$rows = $result->fetchAll();
/*
header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="utilisateurs.xml"');
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo "<utilisateurs>";
foreach ($rows as $row) {
    echo "<utilisateur>";
    echo "<nom>" . htmlspecialchars($row['nom']) . "</nom>";
    echo "<prenom>" . htmlspecialchars($row['prenom']) . "</prenom>";
    echo "<email>" . htmlspecialchars($row['email']) . "</email>";
    echo "<adresse>" . htmlspecialchars($row['adresse']) . "</adresse>";
    echo "<ville>" . htmlspecialchars($row['ville']) . "</ville>";
    echo "<codePostal>" . htmlspecialchars($row['code_postal']) . "</codePostal>";
    echo "<motDePasse>" . htmlspecialchars($row['mot_de_passe']) . "</motDePasse>";
    echo "</utilisateur>";
}
echo "</utilisateurs>";
*/


$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><utilisateurs/>');

foreach ($rows as $row) {
    $utilisateur = $xml->addChild('utilisateur');
    $utilisateur->addChild('nom', htmlspecialchars($row['nom']));
    $utilisateur->addChild('prenom', htmlspecialchars($row['prenom']));
    $utilisateur->addChild('email', htmlspecialchars($row['email']));
    $utilisateur->addChild('adresse', htmlspecialchars($row['adresse']));
    $utilisateur->addChild('ville', htmlspecialchars($row['ville']));
    $utilisateur->addChild('codePostal', htmlspecialchars($row['code_postal']));
    $utilisateur->addChild('motDePasse', htmlspecialchars($row['mot_de_passe']));
}

header('Content-Type: application/xml');
header('Content-Disposition: attachment; filename="utilisateurs.xml"');
echo $xml->asXML();
exit;