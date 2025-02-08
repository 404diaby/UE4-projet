<?php
require_once MODELS . 'm_announcement.php';
require_once MODELS . 'm_category.php';
require_once MODELS . 'm_state.php';
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
        include VIEWS . 'v_announcement.php';
        break;
    case 'announcementAddVerify':
        notConnected();
        $categories = Category::getAll();
        $states = State::getAll();
        $error_message = 'Une erreur est survenue';
        //isset
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
        $target_file = IMAGE_DIR .'announcement'.DIRECTORY_SEPARATOR. $_SESSION['user_id'].DIRECTORY_SEPARATOR;
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



        if ($error == false) {
            $title = htmlspecialchars($_POST['announcementTitle'],ENT_NOQUOTES);
            $description = htmlspecialchars($_POST['announcementDescription'],ENT_NOQUOTES);
            $category = htmlspecialchars($_POST['announcementCategory'],ENT_NOQUOTES);
            $state = htmlspecialchars($_POST['announcementState'],ENT_NOQUOTES);
            $price = htmlspecialchars($_POST['announcementPrice'],ENT_NOQUOTES);
            $image = htmlspecialchars($file_name,ENT_NOQUOTES);
            $announcement = Announcement::set($title, $description, $category, $state, $price, $image, $_SESSION['user_id']);


            $lastId = $announcement['lastId'];

            if (!is_dir($target_file)) {
                mkdir($target_file, 0777, true);
            }
            if (!is_dir($target_file.$lastId.DIRECTORY_SEPARATOR)) {
                mkdir($target_file.$lastId.DIRECTORY_SEPARATOR, 0777, true);
            }

            if (!uploadAnnouncementFile($file_tmp, $target_file.$lastId.DIRECTORY_SEPARATOR. $file_name)) {
                $error = true;
                $error_code = 'upload';
                include VIEWS . 'v_announcement.php';
                break;
            }

            if (!isset($announcement['announcement']) || $announcement['announcement'] == 0) {
                $error = true;
                $error_code = 'fail';
                include VIEWS . 'v_announcement.php';
                break;
            } elseif ($announcement['announcement'] = 1) {
                $success = true;
                include VIEWS . 'v_announcement.php';
                break;
            }

        }

        include VIEWS . 'v_announcement.php';
        break;
    case 'announcementDelete':
        notConnected();
        if (!isset($_GET['announcementId']) || empty(trim($_GET['announcementId']))) {
            redirectTo('index.php');
        }

        $announcement = Announcement::getById($_GET['announcementId']);
        $categories = Category::getAll();
        $states = State::getAll();
        $announcement == null ? include VIEWS . 'v_error.php' : include VIEWS . 'v_announcement.php';
        break;
    case 'announcementDeleteVerify':
        notConnected();
        if (!isset($_GET['announcementId']) || empty(trim($_GET['announcementId']))) {
            redirectTo('index.php');
        }
        $announcement = Announcement::getById($_GET['announcementId']);
        $categories = Category::getAll();
        $states = State::getAll();

        $announcementId = $_GET['announcementId'];
        $deleteResult = Announcement::deleteById($announcementId);
        if (!isset($deleteResult) || $deleteResult == 0) {
            $error = true;
            $error_code = 'fail';
            $error_message = 'Une erreur est survenue';
            include VIEWS . 'v_announcement.php';
            break;
        } elseif ($user = 1) {
            $imagePath = IMAGE_DIR.'announcement'.DIRECTORY_SEPARATOR.$_SESSION['user_id'].DIRECTORY_SEPARATOR . $announcementId.DIRECTORY_SEPARATOR;
            deleteDirectory($imagePath);

        }
        $success = true;
        include VIEWS . 'v_announcement.php';
        break;
    case 'announcementUpdate':
        notConnected();
        if (!isset($_GET['announcementId']) || empty(trim($_GET['announcementId']))) {
            redirectTo('index.php');
        }
        $announcement = Announcement::getById($_GET['announcementId']);
        $categories = Category::getAll();
        $states = State::getAll();
        $announcement == null ? include VIEWS . 'v_error.php' : include VIEWS . 'v_announcement.php';
        break;
        case 'announcementUpdateVerify':

            notConnected();
            $categories = Category::getAll();
            $states = State::getAll();
            $error_message = 'Une erreur est survenue';
            //isset
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
            if(isset($_FILES['announcementImage'])) {
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
                $target_file = IMAGE_DIR .'announcement'.DIRECTORY_SEPARATOR. $_SESSION['user_id'].DIRECTORY_SEPARATOR;
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



            if ($error == false) {
                $title = htmlspecialchars($_POST['announcementTitle'],ENT_NOQUOTES);
                $description = htmlspecialchars($_POST['announcementDescription'],ENT_NOQUOTES);
                $category = htmlspecialchars($_POST['announcementCategory'],ENT_NOQUOTES);
                $state = htmlspecialchars($_POST['announcementState'],ENT_NOQUOTES);
                $price = htmlspecialchars($_POST['announcementPrice'],ENT_NOQUOTES);
                if(isset($_FILES['announcementImage'])) {
                    $image = htmlspecialchars($file_name,ENT_NOQUOTES);
                }else{
                    $image = null;
                }
                $announcement = Announcement::update($title, $description, $category, $state, $price,  $image , $_GET['announcementId']);


                if(isset($_FILES['announcementImage'])) {

                    if (!is_dir($target_file)) {
                        mkdir($target_file, 0777, true);
                    }
                    $lastId = $announcement['lastId'];
                    if (!is_dir($target_file.$lastId.DIRECTORY_SEPARATOR)) {
                        mkdir($target_file.$lastId.DIRECTORY_SEPARATOR, 0777, true);
                    }

                    if (!uploadAnnouncementFile($file_tmp, $target_file.$lastId.DIRECTORY_SEPARATOR. $file_name)) {
                        $error = true;
                        $error_code = 'upload';
                        include VIEWS . 'v_announcement.php';
                        break;
                    }
                }


                if (!isset($announcement['announcement']) || $announcement['announcement'] == 0) {
                    $error = true;
                    $error_code = 'fail';
                    include VIEWS . 'v_announcement.php';
                    break;
                } elseif ($announcement['announcement'] = 1) {
                    $success = true;
                    include VIEWS . 'v_announcement.php';
                    break;
                }

            }

            include VIEWS . 'v_announcement.php';
            break;
    case 'announcementSold' :
        notConnected();
        if (!isset($_GET['announcementId']) || empty(trim($_GET['announcementId']))) {
            redirectTo('index.php?action=account&accountAction=settings');
        }

        Announcement::setSoldAttribute($_GET['announcementId'],$_SESSION['user_id']);
        redirectTo('index.php?action=account&accountAction=dashboard');
        break;
    case 'announcementStatus' :
        notConnected();
        if (!isset($_GET['announcementId']) || empty(trim($_GET['announcementId']))) {
            redirectTo('index.php');
        }
        Announcement::setStatusAttribut($_GET['announcementId'],$_SESSION['user_id']);
        redirectTo('index.php?action=account&accountAction=dashboard');
        break;
    default :
        include VIEWS . 'v_error.php';

}


