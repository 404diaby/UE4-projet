<?php


require_once MODELS . 'm_user.php';
require_once MODELS . 'm_statuses.php';
require_once MODELS . 'm_category.php';
require_once MODELS . 'm_announcement.php';
$action = isset($_GET['accountAction']) ? $_GET['accountAction'] : 'dashboard';
$error = false;

switch ($action) {
    case 'dashboard':
        notConnected();

        $user = User::getBy($_SESSION['user_id']);
        $statuses = Statuses::getAll();
        $announcements = Announcement::getAllByUserId($_SESSION['user_id']);
        if ($announcements == null && $user == null || $statuses == null) {
            $error = true;
            $error_message = 'Une erreur est survenue';
        }
        include VIEWS . 'v_dashboard.php';
        break;
    case 'settings':
        notConnected();
        $user = User::getBy($_SESSION['user_id']);
        include VIEWS . 'v_settings.php';
        break;
    case 'favorites':
        include VIEWS . 'v_favorites.php';
        break;
    default:
        include VIEWS . 'v_error.php';
}