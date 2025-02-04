<?php
require_once '../config/init.php';
$db = Database::getInstance()->getConnection();


$query = "SELECT * FROM utilisateur WHERE $siteColumn = 1 AND date_inscription > NOW() - INTERVAL 1 DAY";
$result = $db->prepare($query);
$result->execute();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
