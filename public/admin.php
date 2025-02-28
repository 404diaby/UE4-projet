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
$messageAnnouncements = '';
$successAnnouncements = false;

$errorUser = false;
$messageUser = '';
$successUser = false;

$errorExport = false;
$messageExport = '';
$successExport = false;

$errorImport = false;
$messageImport = '';
$successImport = false;

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
        //export
        if(isset($_GET['export_0'])){

            foreach ($_GET as $key => $value) {
                if( explode('_', $key)[0] == '0'){
                    $errorExport = true;
                    $messageExport = 'export echoue';
                }
            }
            $successExport = true;
            $messageExport = 'export reussi';

        }

        if(isset($_GET['import'])){
            if(!isset($_GET['importExpected']) || $_GET['importExpected'] == 0 ){
                $errorImport = true;
                $messageImport = 'import echoue';
            }else {
                $successImport = true;
                $messageImport = 'import reussi';
            }
        }

        if(isset($_GET['move'])){
            if($_GET['move'] == 'success') {
                $successImport = true;
                $messageImport = 'import reussi';
            }else if($_GET['move'] == 'error') {
                $errorImport = true;
                $messageImport = 'import echoue';
            }
        }

        $selectImportFiles = getExportFileAvailable();
        $exportsFiles = getExporImportFile();

        //announcements
        $announcements = Announcement::getAll();
        $activeAnnouncements = 0;
        $moderateAnnouncements = 0;
        if(!isset($announcements)){
            $errorAnnouncements = true;
            $messageAnnouncements = "Une erreur est survenue";
        }else{
            foreach ($announcements as $announcement) {
                if ($announcement['statut_id'] == 1) {
                    $activeAnnouncements++;
                }
                if ($announcement['statut_id'] == 3) {
                    $moderateAnnouncements++;
                }
            }
        }

        $categories = Category::getAll();
        $statuses = Statuses::getAll();

        //users
        $users = User::getAllUsers();
        if (!isset($users)) {
            $errorUser = true;
            $messageUser = 'Une erreur est survenue';
        }




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

        if(!isset($user)){
            $errorUser = true;
            $messageUser = 'Une erreur est survenue';
        }else{
            $successUser = true;
        }

        $exportsFiles = getExporImportFile();

        //announcements
        $announcements = Announcement::getAll();
        $activeAnnouncements = 0;
        $moderateAnnouncements = 0;
        if(!isset($announcements)){
            $errorAnnouncements = true;
            $messageAnnouncements = "Une erreur est survenue";
        }else{
            foreach ($announcements as $announcement) {
                if ($announcement['statut_id'] == 1) {
                    $activeAnnouncements++;
                }
                if ($announcement['statut_id'] == 3) {
                    $moderateAnnouncements++;
                }
            }
        }

        $categories = Category::getAll();
        $statuses = Statuses::getAll();

        //users
        $users = User::getAllUsers();
        if (!isset($users)) {
            $errorUser = true;
            $messageUser = 'Une erreur est survenue';
        }


        include VIEWS . 'v_dashboardAdmin.php';
        break;
    case 'updateUser':
        notConnectedAsAdmin();

        if( !isset($_GET['userId'])){
            header("Location: admin.php");
        }
        $firstName = htmlentities($_POST['firstName']);
        $lastName = htmlentities($_POST['lastName']);
        $address = htmlentities($_POST['address']);
        $email = htmlentities($_POST['email']);
        $zipCode = htmlentities($_POST['zipCode']);
        $city = htmlentities($_POST['city']);
        $role = htmlentities($_POST['role']);
        $site1Ckeck = isset($_POST['site1Check']) ? htmlentities($_POST['site1Check']) : 0;
        $site2Ckeck = isset($_POST['site2Check']) ? htmlentities($_POST['site2Check']) : 0;

        $user = User::updateUser($firstName,$lastName,$address,$email,$zipCode,$city,null,$site1Ckeck,$site2Ckeck,$_GET['userId'] );
        if(!isset($user)){
            $errorUser = true;
            $messageUser = 'Une erreur est survenue';
        }else{
            $successUser = true;
        }

        $exportsFiles = getExporFile();

        //announcements
        $announcements = Announcement::getAll();
        $activeAnnouncements = 0;
        $moderateAnnouncements = 0;
        if(!isset($announcements)){
            $errorAnnouncements = true;
            $messageAnnouncements = "Une erreur est survenue";
        }else{
            foreach ($announcements as $announcement) {
                if ($announcement['statut_id'] == 1) {
                    $activeAnnouncements++;
                }
                if ($announcement['statut_id'] == 3) {
                    $moderateAnnouncements++;
                }
            }
        }

        $categories = Category::getAll();
        $statuses = Statuses::getAll();

        //users
        $users = User::getAllUsers();
        if (!isset($users)) {
            $errorUser = true;
            $messageUser = 'Une erreur est survenue';
        }


        include VIEWS . 'v_dashboardAdmin.php';
        break;
    case 'deleteUser':
        notConnectedAsAdmin();
        if(!isset($_GET['userId'])){ $error = true; }
        $user = User::deleteUser($_GET['userId']);
        if(!isset($user)){
            $errorUser = true;
            $messageUser = 'Une erreur est survenue';
        }else{
            $successUser = true;
        }

        $exportsFiles = getExporFile();

//announcements
        $announcements = Announcement::getAll();
        $activeAnnouncements = 0;
        $moderateAnnouncements = 0;
        if(!isset($announcements)){
            $errorAnnouncements = true;
            $messageAnnouncements = "Une erreur est survenue";
        }else{
            foreach ($announcements as $announcement) {
                if ($announcement['statut_id'] == 1) {
                    $activeAnnouncements++;
                }
                if ($announcement['statut_id'] == 3) {
                    $moderateAnnouncements++;
                }
            }
        }

        $categories = Category::getAll();
        $statuses = Statuses::getAll();

        $users = User::getAllUsers();
        if (!isset($users)) {
            $errorUser = true;
            $messageUser = 'Une erreur est survenue';
        }
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
            $isDeleteDirectory  = deleteDirectory($imagePath);

            if(!isset($deleteResult) || !$isDeleteDirectory){
                $errorAnnouncements = true;
                $messageAnnouncements = 'Une erreur est survenue';
            }else{
                $successAnnouncements = true;
            }
        $exportsFiles = getExporFile();

        //announcements
        $announcements = Announcement::getAll();
        $activeAnnouncements = 0;
        $moderateAnnouncements = 0;
        if(!isset($announcements)){
            $errorAnnouncements = true;
            $messageAnnouncements = "Une erreur est survenue";
        }else{
            foreach ($announcements as $announcement) {
                if ($announcement['statut_id'] == 1) {
                    $activeAnnouncements++;
                }
                if ($announcement['statut_id'] == 3) {
                    $moderateAnnouncements++;
                }
            }
        }

        $categories = Category::getAll();
        $statuses = Statuses::getAll();

        $users = User::getAllUsers();
        if (!isset($users)) {
            $errorUser = true;
            $messageUser = 'Une erreur est survenue';
        }
        include VIEWS . 'v_dashboardAdmin.php';
            break;
    case 'updateAnnouncement':
        if (!isset($_GET['announcementId']) || empty(trim($_GET['announcementId']))) {
            redirectTo('admin.php');
        }
        $announcementId = $_GET['announcementId'];

        $announcement = Announcement::setStatusAttributAsAdmin($announcementId,$_SESSION['user_id']);
        if(!isset($announcement)){
            $errorAnnouncements = true;
            $messageAnnouncements = 'Une erreur est survenue';
        }else{
            $successAnnouncements = true;
        }
        $exportsFiles = getExporFile();

        //announcements
        $announcements = Announcement::getAll();
        $activeAnnouncements = 0;
        $moderateAnnouncements = 0;
        if(!isset($announcements)){
            $errorAnnouncements = true;
            $messageAnnouncements = "Une erreur est survenue";
        }else{
            foreach ($announcements as $announcement) {
                if ($announcement['statut_id'] == 1) {
                    $activeAnnouncements++;
                }
                if ($announcement['statut_id'] == 3) {
                    $moderateAnnouncements++;
                }
            }
        }

        $categories = Category::getAll();
        $statuses = Statuses::getAll();

        $users = User::getAllUsers();
        if (!isset($users)) {
            $errorUser = true;
            $messageUser = 'Une erreur est survenue';
        }
        include VIEWS . 'v_dashboardAdmin.php';
        break;
    case 'export' :

        if(!isset($_POST['type_donnee'])){
            redirectTo('admin.php');
            break;
        }

        $type_donnee = $_POST['type_donnee'];
        $critere = "";
        isExportDirectoryExist();
        switch ($type_donnee) {
            case 'Utilisateur':
                $criteres = ["site_1","site_2"];
                $metamodele = getMetaModele($type_donnee);
                $exports =  [];
                foreach ($criteres as $key => $critere) {
                    $data = getDatas($type_donnee,$critere);
                    $filename = exportDatas($type_donnee,$critere,$metamodele,$data);

                    if(isset($filename)){
                        $filenameWithoutExt = explode('.json', basename($filename))[0];
                        $exports[$key] = [
                            'export_'.$key => $filenameWithoutExt,
                            'exportExpected_'.$key => 1
                        ];

                    }else{
                        $exports[$key] = [
                            'export_'.$key => "",
                            'exportExpected_'.$key => 0
                        ];
                    }
                }
                break;
            default:
                redirectTo('admin.php');
                break;
        }

        $paramUrl = "";
        foreach ($exports as $export) {
            foreach ($export as $key => $value) {
                $paramUrl .= $key.'='.$value.'&';
            }


        }
        header("Location: admin.php?".$paramUrl);
        break;
    case 'import' :

        if (!isset($_POST['type_donnee']) || !isset($_POST['import_file'])) {
            redirectTo('admin.php');
            break;
        }
        isImportDirectoryExist();
        $type_donnee = $_POST['type_donnee'];

        $file = $_POST['import_file'];
        $filePath = EXPORT.$file;
       /* if ($file['error'] !== UPLOAD_ERR_OK) {
            redirectTo('admin.php?error=upload_failed');
            break;
        }
*/
        $fileContent = file_get_contents($filePath);
        $data = json_decode($fileContent, true);
       /* if (json_last_error() !== JSON_ERROR_NONE) {
            redirectTo('admin.php?error=json_invalid');
            break;
        }*/
        $metamodele = getMetaModele($type_donnee);
        $importStatus = importDatas($type_donnee,$metamodele, $data);

        $paramUrl = "";
        if ($importStatus) {
            //redirectTo('admin.php?success=import_done');
            $paramUrl .= 'import='.$file.'&importExpected=1';
            $new_filename = str_replace("export", "import", $file);

            if(rename($filePath,IMPORT.$new_filename)){
                //var_dump('success-move');
                $paramUrl .= '&move=succes';

            }else{
                //var_dump('error-move');
                $paramUrl .= '&move=error';
            }
        } else {
            //error
            $paramUrl .= 'import='.$file.'&importExpected=0';
        }
        header("Location: admin.php?".$paramUrl);
        break;
    default:
        $_GET['authAction'] = 'signInAdmin';
        include CONTROLLERS.'c_auth.php';

}

//fonction pour obtenir le metamodele d'un type de donnée -> une table de la base de donnée
function getMetaModele($type_donnee)
{
    try{
        $db = Database::getInstance()->getConnection();
        $query_metamodele = "SELECT * FROM metamodele WHERE 1 AND export = 1 AND table_parent = '$type_donnee';";
        $stmt = $db->prepare($query_metamodele);
        $stmt->execute();
        header(
            'Content-Type: application/json; charset=utf-8'
        );
        writeLog('info',__FILE__,"Récuperation du métamodèle a  réussi");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        writeLog('error',__FILE__,"Récuperation du métamodèle a échoué : ".$e->getMessage());
        return null;

    }


}

function getDatas($type_donnee, $critere = null){
    $db = Database::getInstance()->getConnection();
    $query = "SELECT * FROM $type_donnee ";

    if(isset($critere)) {
        $query .= "WHERE 1";
        switch ($type_donnee) {

            case 'Utilisateur':
                $query .= " AND $critere = 1 ";
                break;
            default:
                break;
        }
    }
    $query .= ";";
    $stmt = $db->prepare($query);
    $stmt->execute();
    header('Content-Type: application/json; charset=utf-8');

    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function exportDatas($type_donnee, $critere,$metamodele,$datas){

    try {
        $data_unified = [];

        foreach ($datas as $data) {
            $entry = [];
            foreach ($metamodele as $metarow) {
                $entry[$metarow['nom_champs']] = $data[$metarow['nom_champs_local']];

            }
            $data_unified[$type_donnee][] = $entry;
        }

        $filename = EXPORT.strtolower($type_donnee).'_export';
        if(isset($critere)) {
            $filename .= "_".$critere;
        }
        $filename .= '_'.date('Y-m-d') . ".json";
        file_put_contents($filename, json_encode($data_unified, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return $filename;
    }catch (Exception $e) {
        return null;
    }
}

function getExporImportFile(){
    $directory = array(IMPORT,EXPORT);
    $files = array();
    foreach ($directory as $dir) {
        $files =  array_merge($files, scandir($dir));
    }

    $exports = array();
    foreach ($files as $file) {
        if ($file !== "." && $file !== ".." && $file[0] !== ".") {

            if(file_exists(IMPORT . $file )) {
                $filePath = IMPORT . $file;
            }
            else if(file_exists(EXPORT . $file )) {
                $filePath = EXPORT . $file;
            }

            if (is_dir($filePath)) {
               continue;
            } else {


                // Obtenir la date de création (Windows et certains systèmes Unix)
               $creationTime = filectime($filePath);
               // $stat = stat($file);
                //$creationTime = $stat['ctime'];

                //Type
                $type = ucfirst(explode("_", $file)[0]);

                //Action
                $action = ucfirst(explode("_", $file)[1]);

                //Statut
                $parentDirectory = dirname($filePath);
                $parentDirectoryTab= explode(DIRECTORY_SEPARATOR,$parentDirectory);
                switch (   $parentDirectoryTab[count($parentDirectoryTab)-1]) {
                    case 'export':
                        $statut = 'local';
                        break;
                    case 'import':
                        $statut = 'local';
                        break;
                    case 'archived' :
                        $statut = 'success';
                        break;
                    case 'cancelled' :
                        $statut = 'error';
                            break;
                    default:
                        $statut = 'unknown';
                }
                /*
                 * Si le fichier est dans le dossier export il est local
                 * Sinon si il est dans le dossier cancel il est echoe
                 * Sinon si il est dans le dossier archived il est reussi
                 *
                 * pour etre echoue ou reussi ça dependre du cript de la tache  plainier
                 */

            }
            // Ajouter le fichier avec ces infos
            $exports[] = [
                'name' => $file,
                'created_at' => date("Y-m-d H:i:s", $creationTime), // Format lisible
                'type' => $type,
                'action' => $action,
                'status' => $statut
            ];
        }
    }
    return $exports;


}


function getExportFileAvailable(){
    $directory = EXPORT;
    $files = scandir($directory);
    $imports = array();
    foreach ($files as $file) {
        if ($file !== "." && $file !== ".." ) {
            $filePath = $directory . DIRECTORY_SEPARATOR . $file;
            if (is_dir($filePath)) {
                continue;

            } else {
                array_push($imports,$file);
            }

        }

    }
    return $imports;
}


function importDatas($type_donnee, $metamodele, $datas)
{
    $db = Database::getInstance()->getConnection();
    $query = "INSERT INTO $type_donnee ";
    switch ($type_donnee) {
        case 'Utilisateur':
           //requete
            $query .= "(";
            foreach ($metamodele as $key =>  $metarow) {
                $query .= $metarow['nom_champs_local'];
                if( $key < count($metamodele)-1){
                    $query .= " , ";
                }
            }

            $query .= ") VALUE \n";
            $finalQuery = $query;

            foreach ($datas[$type_donnee] as $keyEntity => $entity) {
                $finalQuery .= "(";
                foreach($entity as $entityAttributeKey => $entityAttributeValue) {
                    $index = 0;
                    foreach ($metamodele as $metarow) {
                        if($entityAttributeKey == $metarow['nom_champs']) {
                           // var_dump($entityAttributeKey.' : '.$entityAttributeValue.' / '.$entityAttributeValue);
                            $finalQuery .= "\"$entityAttributeValue\"";
                            if($index < count($metamodele)-1){
                                $finalQuery .= " , ";
                            }
                        }
                        $index++;
                    }

                }
                $finalQuery .= ")";
                if( $keyEntity < count($datas[$type_donnee])-1){
                    $finalQuery .= ",\n";
                }else{
                    $finalQuery .= ";";
                }
            }

            break;
            default:
                break;
    }

    try{
        $stmt = $db->prepare($finalQuery);
        $stmt->execute();
        writeLog('info',__FILE__,"L'importation a réussi : ");

        return $stmt->rowCount();
    }catch (Exception $e) {
        writeLog('error',__FILE__,"L'importation a échoué : " . $e->getMessage());

        return null;

    }
}