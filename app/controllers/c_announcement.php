<?php
require_once MODELS . 'm_announcement.php';
require_once MODELS . 'm_category.php';
require_once MODELS . 'm_state.php';
require_once MODELS . 'm_statuses.php';
$action = isset($_GET['announcementAction']) ? $_GET['announcementAction'] : 'announcementList';
$error = false;
$error_code = '';
$success = false;
switch ($action) {
    case 'announcementList':
        $announcements = Announcement::getAllPublish();
        include VIEWS . 'v_announcements.php';
        break;
    case 'announcementItem':
        if (!isset($_GET['announcementId']) || empty(trim($_GET['announcementId']))) {
            redirectTo('index.php');
        }
        $announcement = Announcement::getById($_GET['announcementId']);
        $announcement == NULL ? include VIEWS . 'v_error.php' : include VIEWS . 'v_announcement.php';
        break;
    case 'announcementAdd':
        notConnected();
        $categories = Category::getAll();
        $states = State::getAll();
        $statuses = Statuses::getAll();
        include VIEWS . 'v_announcement.php';
        break;
    case 'announcementAddVerify':
        notConnected();
        $categories = Category::getAll();
        $states = State::getAll();
        $statuses = Statuses::getAll();
        // var_dump($_POST);
        //isset
        if (!isset($_POST['announcementStatus'])) {
            $error = true;
            $error_code = 'status';
            include VIEWS . 'v_announcement.php';
            break;
        }
        if (!isset($_POST['announcementCategory'])) {
            $error = true;
            $error_code = 'category';
            include VIEWS . 'v_announcement.php';
            break;
        }
        if (!isset($_POST['announcementState'])) {
            $error = true;
            $error_code = 'state';
            include VIEWS . 'v_announcement.php';
            break;
        }
        if (!isset($_FILES['announcementImage'])) {
            $error = true;
            $error_code = 'image';
            include VIEWS . 'v_announcement.php';
            break;
        }

        if (!is_int((int)$_POST['announcementCategory'])) {
            $error = true;
            include VIEWS . 'v_announcement.php';
            break;
        }
        if (!is_int((int)$_POST['announcementState'])) {
            $error = true;
            include VIEWS . 'v_announcement.php';
            break;
        }
        //$target_dir = "uploads/"; // Dossier de stockage des images
        $file = $_FILES['announcementImage'];
        //var_dump($file);
        // Récupérer les infos du fichier
        $file_name = basename($file['name']); // Nom d'origine
        $file_tmp = $file['tmp_name']; // Chemin temporaire
        $file_size = $file['size']; // Taille du fichier
        $file_error = $file['error']; // Erreurs éventuelles
        // Vérifier l'extension du fichier
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $target_file = IMAGE_DIR.$file_name;
        //
        //$target_dir = "uploads/";
        //$target_file = $target_dir.$file_name;
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($file_ext, $allowed_ext)) {
            $error = true;
            $error_code = 'extension';
            include VIEWS . 'v_announcement.php';
            break;
        }


        //empty

        if (empty(trim($_POST['announcementTitle']))) {
            $error = true;
            $error_code = 'title';
            include VIEWS . 'v_announcement.php';
            break;
        }
        if (empty(trim($_POST['announcementDescription']))) {
            $error = true;
            $error_code = 'description';
            include VIEWS . 'v_announcement.php';
            break;
        }
        if (empty(trim($_POST['announcementCategory']))) {
            $error = true;
            $error_code = 'category';
            include VIEWS . 'v_announcement.php';
            break;
        }
        if (empty(trim($_POST['announcementState']))) {
            $error = true;
            $error_code = 'state';
            include VIEWS . 'v_announcement.php';
            break;
        }
        if (empty(trim($_POST['announcementPrice'])) || $_POST['announcementPrice'] < 0.01) {
            $error = true;
            $error_code = 'price';
            include VIEWS . 'v_announcement.php';
            break;
        }

        if(!uploadAnnouncementFile($file_tmp,$target_file)) {
            $error = true;
            $error_code = 'upload';
            include VIEWS . 'v_announcement.php';
            break;
        }

        if ($error == false) {
            $title = htmlspecialchars($_POST['announcementTitle']);
            $description = htmlspecialchars($_POST['announcementDescription']);
            $category = htmlspecialchars($_POST['announcementCategory']);
            $state = htmlspecialchars($_POST['announcementState']);
            $price = htmlspecialchars($_POST['announcementPrice']);
            $status = htmlspecialchars($_POST['announcementStatus']);
            $image = htmlspecialchars($file_name);
            $announcement = Announcement::setAnnouncement($title, $description, $category, $state, $price, $status,$image, $_SESSION['user_id']);
            if (!isset($announcement) || $announcement == 0) {
                $error = true;
                $error_code = 'fail';
                include VIEWS . 'v_announcement.php';
                break;
            } elseif ($user = 1) {
                $success = true;
                include VIEWS . 'v_announcement.php';
                break;
            }

        }

        include VIEWS . 'v_announcement.php';
        break;
    default :
        include VIEWS . 'v_error.php';

}


