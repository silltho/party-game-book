<?php
/**
 * Created by PhpStorm.
 * User: Thomas Siller
 * Zweck: MMP1
 * Studiengang: MultiMediaTechnology
 * 2016, Fachhochschule Salzburg
 */
header('Content-Type: text/html; charset=UTF-8');


if ($_SERVER['HTTP_HOST'] == 'users.multimediatechnology.at') {
    $DB_NAME = "";
    $DB_USER = "";
    $DB_PASS = "";  // fill in password here!!
    $DSN     = "pgsql:dbname=$DB_NAME;host=db.multimediatechnology.at";
    $APP_PATH = '/~fhs38532/mmp1';
} else {
    $DB_NAME = "mmp1";
    $DB_USER = "postgres"; // fill in your local db-username here!!
    $DB_PASS = "postgres"; // fill in password here!!
    $DSN     = "pgsql:dbname=$DB_NAME;host=localhost";
    $APP_PATH = '';
}

if(isset($_SERVER['HTTPS'] ) ) $SERVER_PROTOCOL = 'https';
else $SERVER_PROTOCOL = 'http';
$APP_HOST = $_SERVER['SERVER_NAME'];
$APP_URL = $SERVER_PROTOCOL.'://'.$APP_HOST.$APP_PATH;

$FB_ID = 'appid'; // fill in your fb app id
$FB_SECRET = 'fbSecret'; // fill in your fb secret
$FB_REDIRECT_URL = $APP_URL.'/common/fb_login_callback.php';

?>