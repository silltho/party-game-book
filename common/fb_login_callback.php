<?php
/**
 * Created by PhpStorm.
 * User: Thomas Siller
 * Zweck: MMP1
 * Studiengang: MultiMediaTechnology
 * 2016, Fachhochschule Salzburg
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../lib/facebook-php-sdk-v4-master/src/Facebook/autoload.php';

if(!session_id()) {
    session_start();
}

$fb = new Facebook\Facebook([
    'app_id' => $FB_ID,
    'app_secret' => $FB_SECRET,
    'default_graph_version' => 'v2.4'
]);

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    error_log($e->getMessage());
    header('Location: '.$APP_URL.'/error/500.php');
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    error_log($e->getMessage());
    header('Location: '.$APP_URL.'/error/500.php');
    exit;
}

if (isset($accessToken)) {
    $oAuth2Client = $fb->getOAuth2Client();
    $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
    $_SESSION['fb_access_token'] = (string) $longLivedAccessToken;
    header('Location: '.$APP_URL.'/index.php');
} elseif ($helper->getError()) {
    header('Location: '.$APP_URL.'/error/401.php');
    exit;
}