<?php
require_once '../config/init.php';

isDatabaseConnected();
if(isConnectedAsUser() && isset($_GET['action']) && $_GET['action'] == 'logOut' ){ logOut(); }
//TODO mettre des logs dans les controllers
// TODO faire des annotion dans le projet
//TODO favicon de la page error 4O4 fonctionne mais pas de v_header
//TODO Fichier htacss et htpasswd
// TODO test entier lors que j'attend des ID => $_POST
//TODO gerer les favoris de plusieur compte sur le meeme browser
// TODO mieu gerer  les updalo d'image nom d'image unique dans le repertoire de l'utilisateur
// TODO finir l'infor bulle sur le mot de passe fort attendu
//statut annonce => active, inative


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




