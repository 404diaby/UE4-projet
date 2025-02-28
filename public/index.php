<?php
require_once '../config/init.php';

isDatabaseConnected();
if(isConnectedAsUser() && isset($_GET['action']) && $_GET['action'] == 'logOut' ){ logOut(); }

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




