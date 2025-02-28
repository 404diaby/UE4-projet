<?php


/**
 * Checks if the given password meets the criteria for a strong password.
 * A strong password is defined as having at least 8 characters,
 * including one uppercase letter, one lowercase letter, one number,
 * and one special character.
 *
 * @param string $password The password to check.
 * @return bool Returns true if the password is strong, otherwise false.
 */
function isStrongPassword($password) {
    $minLength = 8; // Longueur minimale
    $hasUppercase = preg_match('@[A-Z]@', $password); // Au moins une majuscule
    $hasLowercase = preg_match('@[a-z]@', $password); // Au moins une minuscule
    $hasNumber = preg_match('@[0-9]@', $password); // Au moins un chiffre
    $hasSpecialChar = preg_match('@[^\w]@', $password); // Au moins un caractère spécial

    if (strlen($password) < $minLength) {
        // "Le mot de passe doit contenir au moins $minLength caractères.";
        return false;
    }
    if (!$hasUppercase) {
        // "Le mot de passe doit contenir au moins une majuscule.";
        return false;
    }
    if (!$hasLowercase) {
        // "Le mot de passe doit contenir au moins une minuscule.";
        return false;
    }
    if (!$hasNumber) {
        // "Le mot de passe doit contenir au moins un chiffre.";
        return false ;
    }
    if (!$hasSpecialChar) {
        // "Le mot de passe doit contenir au moins un caractère spécial.";
        return false;
    }

    return true;
}



/**
 * Checks if the current session is connected as a user with the role 'utilisateur'.
 *
 * @return bool Returns true if the session indicates a logged-in user with the 'utilisateur' role, false otherwise.
 */
function isConnectedAsUser()
{
    if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true ) {
        return false;
    }

    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'utilisateur') {
        return false;
    }
        return true;
}

/**
 * Checks if the current user is connected and has an admin role.
 *
 * @return bool Returns true if the user is logged in and has the role of 'admin'; otherwise, returns false.
 */
function isConnectedAsAdmin()
{
    if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true ) {
        return false;
    }

    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
        return false;
    }
    return true;
}

/**
 * Sets the session data for the given user.
 *
 * @param array $user An associative array containing user details with keys 'id', 'email', and 'role'.
 * @return void
 */
function setUserSession($user)
{
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_role'] = $user['role'];
    $_SESSION['is_logged_in'] = true;
}

/**
 * Redirects the user to the specified URL. If headers are already sent,
 * it uses JavaScript to perform the redirection.
 *
 * @param string $url The URL to which the user should be redirected.
 * @return void
 */
function redirectTo($url)
{
    if (!headers_sent()) {
        header('Location: ' . $url);
        exit;
    } else {
        echo '<script>';
        echo 'window.location.href="' . $url . '";';
        echo '</script>';

    }

}


/**
 * Redirects the user to the authentication page if they are not connected as a user.
 *
 * @return void
 */
function notConnected()
{
    if (!isConnectedAsUser()) {
        redirectTo('index.php?action=auth');
    }
}


/**
 * Checks if the user is not connected as an administrator and redirects them
 * to the admin sign-in page if they are not.
 *
 * @return void
 */
function notConnectedAsAdmin()
{
    if (!isConnectedAsAdmin()) {
        redirectTo('admin.php?action=signIn');
    }
}


/**
 * Converts a given date string into a formatted date string.
 *
 * @param string $date The date string to be formatted.
 * @return string The formatted date string in the format "d F Y à H:i".
 */
function dateToString($date)
{
    return date("d F Y à H:i", strtotime($date));
}


/**
 * Checks if the database connection is established.
 * Redirects to an error page if the connection is not set.
 *
 * @return void
 */
function isDatabaseConnected()
{
    $db = Database::getInstance()->getConnection();
    if (!isset($db)) {
        header("Location: error-db.php");
    }

}


/**
 * Logs the user out by clearing session data and invalidating related cookies.
 *
 * @return void
 */
function logOut()
{
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");
    if (ini_get("session.use_cookies")) {
          $params = session_get_cookie_params();
          setcookie(session_name(), '', time() - 42000,
              $params["path"], $params["domain"],
              $params["secure"], $params["httponly"]
          );
      }
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_unset();
        session_destroy();
    }

}


/**
 * Uploads an announcement file to the specified target location.
 *
 * @param string $file_tmp The temporary file path of the uploaded file.
 * @param string $target_file The destination path where the file should be moved.
 * @return bool Returns true on success or false on failure.
 */
function uploadAnnouncementFile($file_tmp, $target_file)
{
    return move_uploaded_file($file_tmp, $target_file);
}

/**
 * Checks if the logs directory exists. If it does not exist, creates the directory.
 *
 * @return void
 */
function isLogsDirectoryExist()
{
    if (!is_dir(LOGS)) {
        mkdir(LOGS, 0777, true);
    }
}
function isExportDirectoryExist()
{
    if (!is_dir(EXPORT)) {
        mkdir(EXPORT, 0777, true);
    }
}

function isImportDirectoryExist()
{
    if (!is_dir(IMPORT)) {
        mkdir(IMPORT, 0777, true);
    }
}

function deleteDirectory($dossier) {
    if (!is_dir($dossier)) {
        return false;
    }

    $fichiers = array_diff(scandir($dossier), array('.', '..'));

    foreach ($fichiers as $fichier) {
        $chemin = $dossier . DIRECTORY_SEPARATOR . $fichier;
        if (is_dir($chemin)) {
            supprimerDossier($chemin); // Suppression récursive des sous-dossiers
        } else {
            unlink($chemin); // Suppression des fichiers
        }
    }

    return rmdir($dossier); // Suppression du dossier après avoir vidé son contenu
}

/**
 * Writes a log message to a log file with a specific log level and context.
 *
 * @param string $level The severity level of the log (e.g., 'info', 'error', etc.).
 * @param string $file_name The name of the file where the log is being generated.
 * @param string $message The log message to be written.
 * @return void
 */
function writeLog($level, $file_name, $message)
{

    $logsFile = LOGS . 'logs_' . date('Y-m-d') . '.log';
    $logMessage = sprintf('%s [%s] %s %s', date('Y-m-d H:i:s'), strtoupper($level), $message, $file_name . PHP_EOL);
    file_put_contents($logsFile, $logMessage, FILE_APPEND);
}