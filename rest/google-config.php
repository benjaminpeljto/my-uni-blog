<?php
require_once '../vendor/autoload.php';
require_once __DIR__ . '/Config.class.php';

$client = new Google_Client();
$client->setClientId(Config::GOOGLE_CLIENT_ID());
$client->setClientSecret(Config::GOOGLE_CLIENT_SECRET());
$client->setRedirectUri(Config::GOOGLE_REDIRECT_URI());
$client->addScope('email');
$client->addScope('profile');


$client->setHttpClient(new \GuzzleHttp\Client([
    'verify' => __DIR__ . '/../cacert.pem'
]));
