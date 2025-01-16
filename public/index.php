<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'database.php';

use App\Core\Database;

$database = Database::getInstance(); 
$name = $database->getConnetion()


?>