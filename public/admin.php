<?php  require_once '../config/init.php';

isDatabaseConnected();
if(isConnectedAsAdmin() && isset($_GET['action']) && $_GET['action'] == 'logOut' ){ logOut(); }

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
$action = isset($_GET['action']) ? $_GET['action'] : 'account';
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
    case 'account' ;
        var_dump($_SESSION);
        notConnectedAsAdmin();
        $_GET['accountAction'] = 'dashboardAdmin';
        include  CONTROLLERS.'c_account.php';
        break;
    default:
        $_GET['authAction'] = 'signInAdmin';
        include CONTROLLERS.'c_auth.php';

}
