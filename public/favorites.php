<?php
require_once '../config/init.php';
require_once MODELS . 'm_user.php';
require_once MODELS . 'm_statuses.php';
require_once MODELS . 'm_category.php';
require_once MODELS . 'm_announcement.php';

header('Content-Type: application/json; charset=utf-8');

$announcementId = isset($_GET['announcementId']) ? intval($_GET['announcementId']) : null;

if (!$announcementId) {
echo json_encode(["error" => "ID d'annonce invalide"]);
exit;
}

$announcement = Announcement::getById($announcementId);

if (!$announcement) {
echo json_encode(["error" => "Annonce introuvable"]);
} else {
echo json_encode($announcement);
}

exit;