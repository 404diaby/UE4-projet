<?php
// 1️⃣ Activer l'affichage des erreurs en mode développement (désactiver en production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
/* PROD
error_reporting(0); // Désactive l'affichage des erreurs
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/logs/php_errors.log'); // Chemin du fichier log
*/
// Sécurité des cookies de session
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);

// Activer HTTPS uniquement si disponible
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}

// 2️⃣ Démarrer la session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 3️⃣ Définir des constantes (chemins, URL, etc.)
define('ROOT',  dirname(__DIR__) );   // Racine du projet
define('BASE_URL', 'http://localhost:8888'.DIRECTORY_SEPARATOR.'UE4-projet'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR);
// Route Fichier
define('CONTROLLERS',ROOT.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR);
define('CORE',ROOT.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR);
define('MODELS',ROOT.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR);
define('VIEWS',ROOT.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);
define('CONFIG',ROOT.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR);
define('CSS',BASE_URL.'css'.DIRECTORY_SEPARATOR);
define('JS',BASE_URL.'js'.DIRECTORY_SEPARATOR);
define('IMAGES',BASE_URL.'images'.DIRECTORY_SEPARATOR);
define('IMAGE_DIR',ROOT.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR);
define('PUBLIC',BASE_URL.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR);


/**
 * TODO
 */


// 4️⃣ Connexion à la base de données avec PDO
require_once CONFIG . 'database.php';

// 5️⃣ Inclusion des fonctions et classes essentielles
require_once CORE . 'functions.php';

// 6️⃣ Configuration des paramètres globaux (exemple : fuseau horaire)
//date_default_timezone_set('Europe/Paris');

// 7️⃣ Sécurisation basique (désactiver les magic quotes si activées)
/*
if (get_magic_quotes_gpc()) {
    function stripslashes_deep($value) {
        return is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
    }
    $_POST = array_map('stripslashes_deep', $_POST);
    $_GET = array_map('stripslashes_deep', $_GET);
    $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
    $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}*/


