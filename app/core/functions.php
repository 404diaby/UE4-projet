<?php
//TODO annotation
/**
 * @param $word
 * @param $word2
 * @param $pattern
 * @return bool
 */
function  testMatch($word, $word2, $pattern) {
         //TODO info sur le regex de password
         /*
         ^ → Début du mot de passe
         (?=.*[a-z]) → Au moins une minuscule
         (?=.*[A-Z]) → Au moins une majuscule
         (?=.*\d) → Au moins un chiffre
         (?=.*[@$!%*?&]) → Au moins un caractère spécial (@, $, !, %, *, ?, &)
         [A-Za-z\d@$!%*?&]{6,} → Au moins 6 caractères, composés de lettres, chiffres et symboles
         $ → Fin du mot de passe
         */
        $regexPattern = '';
        switch ($pattern) {
            case 'password':
                $regexPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/";
                break;

            case 'email':
                // Expression régulière pour une validation d'email basique
                $regexPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
                break;
            case 'confirmPassword':
                $regexPattern = $word2;

            default:
                return false; // Si le pattern n'est pas reconnu, retourne false directement
        }

        return preg_match($regexPattern, $word) == 1 ;
    }
    function isConnected(){
        if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
            return false;
        }else{
        return true;
        }
    }
    function setUserSession($user)
    {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['is_logged_in'] = true;
    }
    function redirectTo($url){
        if (!headers_sent())
        {
            header('Location: '.$url);
            exit;
        }
        else
        {
            echo '<script>';
            echo 'window.location.href="'.$url.'";';
            echo '</script>';

        }

    }

    function notConnected(){
        if(!isConnected()){
            redirectTo('index.php?action=auth');
        }
    }
    function dateToString($date){
         return date("d F Y à H:i",strtotime($date));
    }
    function isDatabaseConnected(){
        $db = Database::getInstance()->getConnetion();
        if( !isset($db)) { header("Location: error-db.php");}

    }


function logOut()
{

  //  header("Cache-Control: no-cache, must-revalidate");
   // header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");

// Supprimer le cookie de session
  /*  if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }*/

// Vérifier si une session est active avant de la supprimer
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_unset();
        session_destroy();
    }

}
function uploadAnnouncementFile($file_tmp,$target_file)
{
    return move_uploaded_file($file_tmp, $target_file);
}