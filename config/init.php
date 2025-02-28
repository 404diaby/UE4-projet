<?php
//Activer l'affichage des erreurs en mode développement (désactiver en production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Mode production
/*
error_reporting(0);
ini_set('display_errors', 0);
*/
// Sécurité des cookies de session
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);

// Activer HTTPS uniquement si disponible
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}

//Démarrer la session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Définir des constantes
/**
 * Defines the constant ROOT which represents the directory path of the parent directory
 * of the current script's directory. This is often used as a base path for file
 * inclusions or configurations in PHP applications.
 */
define('ROOT',  dirname(__DIR__) );   // Racine du projet
/**
 * Defines a constant `BASE_URL` that represents the base URL of the application.
 *
 * The constant is constructed using `http://localhost:8888` as the base address
 * and appends a uniformly formatted path to the `UE4-projet/public/` directory,
 * ensuring directory separators are consistent across different operating systems.
 *
 * This constant can be used throughout the application to reference the root path
 * where public resources or endpoints are hosted.
 */
define('BASE_URL', 'http://'.$_SERVER['SERVER_NAME'].DIRECTORY_SEPARATOR);
// Route Fichier
/**
 * Defines the 'CONTROLLERS' constant.
 *
 * This constant represents the full directory path to the 'controllers'
 * directory within the 'app' directory. It is constructed dynamically
 * using the value of the ROOT constant and the DIRECTORY_SEPARATOR constant.
 *
 * ROOT: Specifies the root directory of the application.
 * DIRECTORY_SEPARATOR: A predefined constant in PHP that provides the correct directory
 *                      separator for the underlying operating system (e.g., '/' for Unix-based
 *                      systems and '\' for Windows).
 *
 * Usage: The 'CONTROLLERS' constant is commonly used throughout the application to
 *        reference or include files from the 'controllers' directory.
 */
define('CONTROLLERS',ROOT.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR);
/**
 * Defines a constant named "CORE".
 *
 * The "CORE" constant is constructed by concatenating the "ROOT" constant
 * with the path to the "core" directory located within the "app" folder.
 * The directory separator is added dynamically based on the operating system
 * using the PHP DIRECTORY_SEPARATOR constant.
 *
 * This constant is used to represent the absolute path to the "core" directory,
 * ensuring proper file path resolution across different environments.
 */
define('CORE',ROOT.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR);
/**
 * Defines a constant named 'MODELS'.
 *
 * The 'MODELS' constant is used to define the path to the 'models' directory
 * within the application. It dynamically constructs the path by concatenating
 * the root directory ('ROOT') with 'app/models/' using the DIRECTORY_SEPARATOR
 * constant for compatibility across different operating systems.
 *
 * Components:
 * - ROOT: Represents the root directory of the application.
 * - DIRECTORY_SEPARATOR: System-specific directory separator for creating paths.
 * - 'app/models/': Represents the relative path to the models directory inside the application.
 */
define('MODELS',ROOT.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR);
/**
 * Constant VIEWS
 *
 * This constant defines the path to the views directory within the application.
 * It concatenates the ROOT directory, the 'app' directory, and the 'views' folder
 * separated by the directory separator to construct the absolute path to the views.
 *
 * Usage of this constant ensures consistent and centralized definition of the
 * views directory path throughout the application.
 */
define('VIEWS',ROOT.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);
/**
 * Defines a constant `CONFIG` that represents the path to the 'config' directory.
 * The path is constructed by concatenating the `ROOT` directory constant,
 * the directory separator, and the string 'config' followed by another directory separator.
 */
define('CONFIG',ROOT.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR);
/**
 * Define a constant named CSS that contains the base URL path for the 'css' directory
 * with the system's directory separator appended.
 *
 * This constant can be used to reference the directory path for CSS files
 * dynamically, based on an already defined BASE_URL constant.
 *
 * Example usage of the constant should be limited to referencing the path
 * to CSS files in web applications.
 */
define('CSS',BASE_URL.'css'.DIRECTORY_SEPARATOR);
/**
 * Defines the constant `JS` for constructing the URL path to the JavaScript directory.
 *
 * `JS` is composed using the `BASE_URL` constant, appended with `'js'`
 * and the system-specific directory separator.
 *
 * BASE_URL should represent the application's base URL for this constant
 * to work correctly in constructing paths to JavaScript resources.
 */
define('JS',BASE_URL.'js'.DIRECTORY_SEPARATOR);
/**
 * Defines a constant `IMAGES` which holds the path to the `images` directory.
 *
 * This constant is created by concatenating the `BASE_URL` with the 'images'
 * directory name and a trailing directory separator. It is used to construct
 * paths or URLs for images within the application.
 *
 * @constant string IMAGES The full path to the images directory.
 */
define('IMAGES',BASE_URL.'images'.DIRECTORY_SEPARATOR);
/**
 * Defines a constant `IMAGE_DIR` that specifies the path to the image directory.
 *
 * The constant is constructed dynamically by concatenating:
 * - The `ROOT` directory constant.
 * - The directory separator appropriate for the operating system.
 * - The relative path to the `images` directory within the `public` folder.
 *
 * This constant can be used throughout the application to reference the
 * absolute path of the images directory, ensuring consistency and avoiding
 * hardcoded paths.
 */
define('IMAGE_DIR',ROOT.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR);
/**
 * Defines the PUBLIC constant.
 *
 * This constant represents the path to the public directory of the application.
 * It is constructed using the BASE_URL, a DIRECTORY_SEPARATOR, the 'public' directory
 * name, and another DIRECTORY_SEPARATOR to ensure proper directory structure.
 *
 * BASE_URL: The base URL or root directory of the project.
 * DIRECTORY_SEPARATOR: The PHP predefined constant used to ensure platform-independent directory separation.
 */
define('PUBLIC',BASE_URL.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR);
/**
 * This constant defines the directory path for storing log files.
 * It concatenates a predefined configuration path (CONFIG) with
 * the system-specific directory separator and the 'logs' folder name.
 *
 * Ensure that the CONFIG constant is defined and points to a valid
 * directory before using this constant.
 *
 * LOGS: Absolute path to the logs directory.
 */
define('LOGS',CONFIG.DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR);
define('EXPORT',ROOT.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'export'.DIRECTORY_SEPARATOR);
define('IMPORT',ROOT.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'import'.DIRECTORY_SEPARATOR);



// Connexion à la base de données avec PDO
require_once CONFIG . 'database.php';

// Inclusion des fonctions et classes essentielles
require_once CORE . 'functions.php';


isLogsDirectoryExist();
writeLog('info',__FILE__,'Fichier init chargée');


