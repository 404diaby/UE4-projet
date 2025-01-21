<?php
require_once MODELS . 'm_user.php';
$action = isset($_GET['authAction']) ? $_GET['authAction'] : 'signIn';
$error = false;
$error_message = '';
$success = false;

switch ($action) {
    case 'signIn':
        include ROOT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'v_signIn.php';
        break;
    case 'signInVerify':
        if(!isset($_POST['email']) && !isset($_POST['password']))
        {
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
        if(/*!testMatch($_POST['password'],null,"password")*/1==2 )  // TODO retablir test mot de passe fort
        {
            $error = true;
            $error_code = 'password';
            include VIEWS.'v_signUp.php';
            break;
        }
        if(!testMatch($_POST['email'],null,"email"))
        {
            $error = true;
            $error_code = 'email';
            include VIEWS.'v_signUp.php';
            break;
        }
        if(/*!testMatch($_POST['password'],$_POST['confirmPassword'],'confirmPassword')*/ $_POST['password'] != $_POST['confirmPassword'])
        //TODO retablir le test par fonction
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
    default :
        include VIEWS . 'v_signIn.php';
}


