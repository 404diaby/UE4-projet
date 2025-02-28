<?php
require_once '../config/init.php';
require_once MODELS . 'm_user.php';
require_once MODELS . 'm_statuses.php';
require_once MODELS . 'm_category.php';
require_once MODELS . 'm_announcement.php';
header("Content-Type: text/html; charset=UTF-8");

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$category = isset($_GET['category']) && $_GET['category'] !== 'all' ? intval($_GET['category']) : null;
$price_min = isset($_GET['price_min']) ? floatval($_GET['price_min']) : null;
$price_max = isset($_GET['price_max']) ? floatval($_GET['price_max']) : null;
$states = [];
if (isset($_GET['state']) && $_GET['category'] !== -1) {
    if (is_array($_GET['state'])) {
        $states = $_GET['state'];
    } else {
        $states = explode(',', $_GET['state']);
    }
}

$sql = "SELECT A.*, C.nom AS categorie_nom, U.nom AS utilisateur_nom, U.prenom AS utilisateur_prenom, 
               E.nom AS etat_nom, S.nom AS statut_nom
        FROM Annonce A
        JOIN Utilisateur U ON A.utilisateur_id = U.id
        JOIN Categorie C ON A.categorie_id = C.id
        JOIN Etat E ON A.etat_id = E.id
        JOIN Statut S ON A.statut_id = S.id
        WHERE A.statut_id = 1";

$params = [];

if (!empty($q)) {
    $sql .= " AND (A.titre LIKE :search OR A.description LIKE :search)";
    $params['search'] = "%$q%";
}

if ($category) {
    $sql .= " AND A.categorie_id = :category";
    $params['category'] = $category;
}

if ($price_min) {
    $sql .= " AND A.prix >= :price_min";
    $params['price_min'] = $price_min;
}

if ($price_max) {
    $sql .= " AND A.prix <= :price_max";
    $params['price_max'] = $price_max;
}

// Ajouter le filtre des états
if (!empty($states) && $states[0] !== '-1') {
    $sql .= " AND A.etat_id IN (";

    foreach ($states as $key => $value) {
        $sql .= " :etat_$key ";
        if($key+1 < count($states)) { $sql .= ", "; }
        $params["etat_$key"] = $value;
    }
    $sql .= ") ";
}
$sql .= " ORDER BY A.date_creation DESC";

$db = Database::getInstance()->getConnection();
$stmt = $db->prepare($sql);
$stmt->execute($params);
$announcements = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$announcements || empty($announcements)) {
    echo "<p class='display-1'>Aucune annonce trouvée</p>";
} else {
    foreach ($announcements as $row) {
        echo "
        <div class='col-md-4'>
            <div class='card h-100'>
                <button id='favorite-{$row['id']}' class='status-badge bg-light rounded-circle border border-0' style='width: 40px; height: 40px;'>
                    <img class='fav-image fa-lg m-2 text-danger' src=''/>
                </button>
                <img src='images/announcement/{$row['utilisateur_id']}/{$row['id']}/{$row['image']}' class='card-img-top annonce-image' alt='{$row['image']}'>
                <div class='card-body'>
                    <a class='text-reset' href='#'><p class='card-text badge text-bg-warning fw-bold'>{$row['categorie_nom']}</p></a>
                    <h5 class='card-title'>{$row['titre']}</h5>
                    <div class='d-flex justify-content-between'>
                        <p class='card-text text-primary fw-bold'>Prix : {$row['prix']} €</p>
                        <p class='card-text text-primary fw-bold'>État : {$row['etat_nom']}</p>
                    </div>
                    <p class='card-text text-muted'>Publié le {$row['date_creation']}</p>
                    <p class='card-text'>Publié par <a href='#'>{$row['utilisateur_nom']} {$row['utilisateur_prenom']}</a></p>
                </div>
                <div class='card-footer bg-white border-top-0'>
                    <div class='btn-group w-100'>
                        <a class='btn btn-outline-primary' href='index.php?action=announcement&announcementAction=announcementItem&announcementId={$row['id']}'>Voir plus</a>
                    </div>
                </div>
            </div>
        </div>";
    }
}
