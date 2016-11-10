<?php

require_once __DIR__ . '/../lib/facebook-php-sdk-v4-master/src/Facebook/autoload.php';

session_start();

$fb = new Facebook\Facebook([
    'app_id' => '694067674068772', // Replace {app-id} with your app id
    'app_secret' => 'de780cc5c7cb3f835f01463ab83e6e84',
    'default_graph_version' => 'v2.4',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://mmp1.localhost:3000/prototype/fb_callback_test.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';