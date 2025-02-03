<?php  require_once '../config/init.php';

require_once MODELS . 'm_user.php';
require_once MODELS . 'm_statuses.php';
require_once MODELS . 'm_category.php';
require_once MODELS . 'm_announcement.php';

isDatabaseConnected();
if(isConnectedAsAdmin() && isset($_GET['action']) && $_GET['action'] == 'logOut' ){ logOut(); }
if(isConnectedAsAdmin() && !isset($_GET['action']) )  { $_GET['action'] = 'dashboardAdmin'; }

/**
 * Represents an action or task to be performed.
 *
 * This variable is typically used to define the name, type,
 * or nature of the operation that is to be executed in a
 * given context or workflow.
 *
 * Example actions could include operations like 'create',
 * 'update', 'delete', or custom-defined actions within an
 * application or system.
 *
 * @var string $action The action to be performed.
 */
$action = isset($_GET['action']) ? $_GET['action'] : 'signIn';



$errorAnnouncements = false;
$error_messageAnnouncements = '';
$successAnnouncements = false;
$errorUser = false;
$error_messageUser = '';
$successUser = false;
$error = false;
$error_message = '';
$success = false;


/**
 * Represents the action to be performed.
 *
 * This variable stores the specific operation or process that is intended
 * to be executed. It may be used to determine functionality or behavior
 * within a given context, such as deciding on tasks or handling events.
 *
 * @var string $action The name or identifier of the action to execute.
 */
switch ($action) {
    case 'signIn':
       $_GET['authAction'] =  !isset($_POST['email']) && !isset($_POST['password']) ? 'signInAdmin' : 'signInAdminVerify';
        include CONTROLLERS.'c_auth.php';
        break;
    case 'dashboardAdmin':
        notConnectedAsAdmin();
        $announcements = Announcement::getAll();
        $users = User::getAllUsers();
        if ($announcements == null || $users == null) {
            $error = true;
            $error_message = 'Une erreur est survenue';
        }
        $activeAnnouncements = 0;
        $moderateAnnouncements = 0;
        foreach ($announcements as $announcement) {
            if ($announcement['statut_id'] == 1) {
                $activeAnnouncements++;
            }
            if ($announcement['statut_id'] == 3) {
                $moderateAnnouncements++;
            }
        }
        $categories = Category::getAll();
        $statuses = Statuses::getAll();
        include VIEWS . 'v_dashboardAdmin.php';
        break;
    case 'addUser':
        notConnectedAsAdmin();
  $firstName = htmlentities($_POST['firstName']);
            $lastName = htmlentities($_POST['lastName']);
            $address = htmlentities($_POST['address']);
            $email = htmlentities($_POST['email']);
            $zipCode = htmlentities($_POST['zipCode']);
            $city = htmlentities($_POST['city']);
            $role = htmlentities($_POST['role']);
            $password = password_hash(htmlentities($_POST['password']),PASSWORD_DEFAULT,['cost'=>12]);
            $site1Ckeck = isset($_POST['site1Check']) ? htmlentities($_POST['site1Check']) : 0;
            $site2Ckeck = isset($_POST['site2Check']) ? htmlentities($_POST['site2Check']) : 0;
            $user = User::setUser($firstName,$lastName,$address,$email,$zipCode,$city,$password,$site1Ckeck,$site2Ckeck );

        $error_message = 'Une erreur est survenue';


        //======
        $announcements = Announcement::getAll();
        $users = User::getAllUsers();
        if ($announcements == null || $users == null) {
            $errorAnnouncements = true;
            $error_messageAnnouncements = 'Une erreur est survenue';
        }
        $activeAnnouncements = 0;
        $moderateAnnouncements = 0;
        foreach ($announcements as $announcement) {
            if ($announcement['statut_id'] == 1) {
                $activeAnnouncements++;
            }
            if ($announcement['statut_id'] == 3) {
                $moderateAnnouncements++;
            }
        }
        $categories = Category::getAll();
        $statuses = Statuses::getAll();
        include VIEWS . 'v_dashboardAdmin.php';
        break;
    case 'deleteUser':
        notConnectedAsAdmin();
        if(!isset($_GET['userId'])){ $error = true; var_dump('erreur'); die();; }
        User::deleteUser($_GET['userId']);


        $announcements = Announcement::getAll();
        $users = User::getAllUsers();
        if ($announcements == null || $users == null) {
            $errorUser = true;
            $error_messageUser = 'Une erreur est survenue';
        }
        $activeAnnouncements = 0;
        $moderateAnnouncements = 0;
        foreach ($announcements as $announcement) {
            if ($announcement['statut_id'] == 1) {
                $activeAnnouncements++;
            }
            if ($announcement['statut_id'] == 3) {
                $moderateAnnouncements++;
            }
        }
        $categories = Category::getAll();
        $statuses = Statuses::getAll();
        include VIEWS . 'v_dashboardAdmin.php';
        break;
        case 'deleteAnnouncement':
            if (!isset($_GET['announcementId']) || empty(trim($_GET['announcementId']))) {
                redirectTo('admin.php');
            }
            $announcementId = $_GET['announcementId'];
            $announcement = Announcement::getById($announcementId);

            $deleteResult = Announcement::deleteById($announcementId);
            $imagePath = IMAGE_DIR.'announcement'.DIRECTORY_SEPARATOR.$announcement['utilisateur_id'].DIRECTORY_SEPARATOR . $announcementId.DIRECTORY_SEPARATOR;
            deleteDirectory($imagePath);

            $announcements = Announcement::getAll();
            $users = User::getAllUsers();
            if ($announcements == null || $users == null) {
                $errorUser = true;
                $error_messageUser = 'Une erreur est survenue';
            }
            $activeAnnouncements = 0;
            $moderateAnnouncements = 0;
            foreach ($announcements as $announcement) {
                if ($announcement['statut_id'] == 1) {
                    $activeAnnouncements++;
                }
                if ($announcement['statut_id'] == 3) {
                    $moderateAnnouncements++;
                }
            }
            $categories = Category::getAll();
            $statuses = Statuses::getAll();
            include VIEWS . 'v_dashboardAdmin.php';
            break;
    case 'export' :
        include CORE . 'export.php';
        break;
        case 'import' :
            include CORE . 'import.php';
            break;
    default:
        $_GET['authAction'] = 'signInAdmin';
        include CONTROLLERS.'c_auth.php';

}
