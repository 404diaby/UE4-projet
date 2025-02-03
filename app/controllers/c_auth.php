<?php
require_once MODELS . 'm_user.php';
/**
 * Represents the action to be performed.
 *
 * The $action variable is intended to hold the name of the action
 * or operation to be executed in a given context, typically as a
 * string. The value of this variable may dictate program flow or
 * determine the functionality to be executed.
 *
 * It is commonly used in applications to handle dynamic behaviors
 * based on user input, system events, or conditional logic.
 */
$action = isset($_GET['authAction']) ? $_GET['authAction'] : 'signIn';
/**
 * Represents an error message or error information.
 *
 * This variable is commonly used to store details about an error
 * that has occurred during the execution of a program. The content
 * or format of the error message may vary depending on the context
 * in which it is used.
 *
 * It can be used for logging, debugging, or displaying error information
 * to the user or developer.
 */
$error = false;
/**
 * Represents the error message generated during the execution of a process or function.
 *
 * This variable is used to store detailed information about an error that has occurred.
 * It is typically a string that describes the nature of the error, which can then be used
 * for debugging, logging, or displaying user-friendly messages.
 */
$error_message = '';
/**
 * A boolean variable that indicates the success or failure of an operation.
 *
 * When set to true, it signifies the operation was successful.
 * When set to false, it indicates the operation failed.
 */
$success = false;

switch ($action) {
    case 'signIn':
        include VIEWS . 'v_signIn.php';
        break;
    case 'signInVerify':
        if(!isset($_POST['email']) && !isset($_POST['password']))
        {
            /**
             * Represents an error message or error details encountered during the execution of a program.
             *
             * This variable typically contains a description of an error, which can be used
             * for debugging or displaying user-friendly error messages. The content of this
             * variable may vary based on the context, such as a string message, an error code,
             * or an array/object with more detailed error information.
             *
             * It is recommended to handle this variable properly to ensure a robust error
             * management system in the application.
             */
            $error = true;
            include VIEWS . 'v_signIn.php';
            break;
        }
        if( empty($_POST['email'].trim(' ')) && empty($_POST['password'].trim(' ')))
        {
            $error = true;
            include VIEWS . 'v_signIn.php';
            break;
        }
        if($error == false){
            $email = htmlentities($_POST['email']);
            $password = htmlentities($_POST['password']);
            $user = User::getUser($email, $password);
            if(!isset($user)) {
                $error = true;
                include VIEWS.'v_signIn.php';
                break;
            }else {
                $success = true;
                setUserSession($user);
                include VIEWS.'v_signIn.php';
                break;
            }
        }
        include VIEWS. 'v_signIn.php';
        break;
    case 'signUp':
        include VIEWS . 'v_signUp.php';
        break;
    case 'signUpVerify':
        var_dump('_1');
        if(!isset($_POST['firstName']) && !isset($_POST['lastName']) && !isset($_POST['address']) && !isset($_POST['email']) && !isset($_POST['zipCode']) && !isset($_POST['city'])  && !isset($_POST['password']) && !isset($_POST['confirmPassword']))
        {
            $error = true;
            $error_code = 'empy';
            include VIEWS.'v_signUp.php';
            break;
        }
        if( empty($_POST['email'].trim(" ")) || empty($_POST['lastName'].trim(" ")) || empty($_POST['address'].trim(" "))  || empty($_POST['email'].trim(" ")) || empty($_POST['zipCode'].trim(" ")) || empty($_POST['city'].trim(" ")) || empty($_POST['password'].trim(" ")) || empty($_POST['confirmPassword'].trim(" ")))
        {
            $error = true;
            $error_code = 'empty';
            include VIEWS.'v_signUp.php';
            break;
        }
        if(!isStrongPassword($_POST['password']))
        {
            $error = true;
            $error_code = 'password';
            include VIEWS.'v_signUp.php';
            break;
        }
        /*if(!testMatch($_POST['email'],null,"email"))
        {
            var_dump('3');
            $error = true;
            $error_code = 'email';
            include VIEWS.'v_signUp.php';
            break;
        }*/
        if( $_POST['password'] != $_POST['confirmPassword'])
        {
            $error = true;
            $error_code = 'confirmPassword';
            include VIEWS.'v_signUp.php';
            break;
        }
        if($error == false){
            $firstName = htmlentities($_POST['firstName']);
            $lastName = htmlentities($_POST['lastName']);
            $address = htmlentities($_POST['address']);
            $email = htmlentities($_POST['email']);
            $zipCode = htmlentities($_POST['zipCode']);
            $city = htmlentities($_POST['city']);
            $password = password_hash(htmlentities($_POST['password']),PASSWORD_DEFAULT,['cost'=>12]);
            $site1Ckeck = isset($_POST['site1Check']) ? htmlentities($_POST['site1Check']) : 0;
            $site2Ckeck = isset($_POST['site2Check']) ? htmlentities($_POST['site2Check']) : 0;
            $user = User::setUser($firstName,$lastName,$address,$email,$zipCode,$city,$password,$site1Ckeck,$site2Ckeck );
            if(!isset($user) || $user == 0 ){
                $error = true;
                $error_code = 'fail';
                include VIEWS.'v_signUp.php';
                break;
            }elseif( $user = 1 ){
                $success = true;
                include VIEWS.'v_signUp.php';
                break;
            }
        }

        include VIEWS .'v_signUp.php';
        break;
    case 'signInAdmin' :
        include VIEWS . 'v_signInAdmin.php';
        break;
    case 'signInAdminVerify' :
        if( !isset($_POST['email']) || !isset($_POST['password'])){
            $error = true;
            $error_message = ' Identifiant invalide';
            include VIEWS.'v_signInAdmin.php';
            break;
        }
        if($error == false){
            $email = htmlentities($_POST['email']);
            $password = htmlentities($_POST['password']);
            $user = User::getAdmin($email, $password);
            if(!isset($user)) {
                $error_message = ' Email ou mot de passe incorrect';

                $error = true;
            }else {
                $success = true;
                setUserSession($user);
            }
            include VIEWS.'v_signInAdmin.php';
        }
        include VIEWS. 'v_signInAdmin.php';
        break;
    default :
        include VIEWS . 'v_signIn.php';
}


