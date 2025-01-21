<?php
require_once '../config/init.php';
isDatabaseConnected();
if(isConnected() && isset($_GET['action']) && $_GET['action'] == 'logOut' ){ logOut(); }

// TODO faire des annotion dans le projet
//TODO favicon de la page error 4O4 fonctionne mais pas de v_header
//TODO Fichier htacss et htpasswd
// TODO test entier lors que j'attend des ID => $_POST



if (empty($_SESSION)) { // TODO mode debug
    echo "Session détruite avec succès.";
} else {
    echo "Session encore active.";
}



$action = isset($_GET['action']) ? $_GET['action'] : 'announcement';

require_once VIEWS . 'v_header.php';

switch ($action) {
    case 'auth':
        include CONTROLLERS.'c_auth.php';
        break;
    case 'announcement':
        include CONTROLLERS . 'c_announcement.php';
        break;
    case 'account' ;
        include  CONTROLLERS.'c_account.php';
        break;
    case 'logOut':
        include VIEWS . 'v_logOut.php';
        break;
    default:
        include VIEWS . 'v_error.php';

}

require_once VIEWS . 'v_footer.php';




