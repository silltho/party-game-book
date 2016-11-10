<?php
/**
 * Created by PhpStorm.
 * User: Thomas Siller
 * Zweck: MMP1
 * Studiengang: MultiMediaTechnology
 * 2016, Fachhochschule Salzburg
 */
require_once __DIR__ . '/config.php';
require_once  __DIR__. '/database_connection.php';
require_once __DIR__ . '/../lib/facebook-php-sdk-v4-master/src/Facebook/autoload.php';

session_start();
$FB_LOGIN_URL = false;
if(isset($_SESSION['fb_access_token'])){
    //User already logged in
    $fb = new Facebook\Facebook([
        'app_id' => $FB_ID,
        'app_secret' => $FB_SECRET,
        'default_graph_version' => 'v2.4',
        'default_access_token' => $_SESSION['fb_access_token']
    ]);

    $_SESSION['currentUser'] = validateUser($_SESSION['fb_access_token'],$dbh, $fb);
    
} else {
    //User is not logged in -> create LOGIN_URL
    $fb = new Facebook\Facebook([
        'app_id' => $FB_ID,
        'app_secret' => $FB_SECRET,
        'default_graph_version' => 'v2.4',
    ]);

    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['']; //userdata z.b. email
    $FB_LOGIN_URL = $helper->getLoginUrl($FB_REDIRECT_URL, $permissions);
}

//validate User and look in DB
function validateUser($accessToken, $dbh, $fb) {
    global $APP_URL;
    $oAuth2Client = $fb->getOAuth2Client();
    $metadata = $oAuth2Client->debugToken($accessToken);
    $user_id = $metadata->getField('user_id');
    try {
        $sth = $dbh->prepare('SELECT * FROM users WHERE oauth_uid = ?');
        $sth->execute(array($user_id));
        $user = $sth->fetch();
    } catch (Exception $e){
        error_log($e->getMessage());
        header('Location: '.$APP_URL.'/error/500.php');
        exit;
    }

    if(!$user || $user == ''){
        return createNewUser($accessToken, $dbh, $fb);
    } else {
        return $user;
    }
}


//create new User in DB
function createNewUser($accessToken ,$dbh ,$fb) {
    global $APP_URL;
    //Get Userdata from FB
    try {
        $response = $fb->get('/me?fields=id,name',$accessToken) ;
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        error_log($e->getMessage());
        header('Location: '.$APP_URL.'/error/500.php');
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        error_log($e->getMessage());
        header('Location: '.$APP_URL.'/error/500.php');
        exit;
    }
    $user = $response->getGraphUser();
    //create User in DB
    try {
        $sth = $dbh->prepare("INSERT INTO users VALUES(nextval('user_id_seq'),'fb' ,? ,?) RETURNING *");
        $sth->execute(array($user->getField('id'), $user->getField('name')));
        $user = $sth->fetch();
    } catch (Exception $e){
        error_log($e->getMessage());
        header('Location: '.$APP_URL.'/error/500.php');
        exit;
    }
    return $user;
}