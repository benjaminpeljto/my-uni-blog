<?php
require_once '../vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('734158929382-cg699amjmrtc1qkshsvn20347bprn9kh.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/my-uni-blog/rest/google-callback');
$client->addScope('email');
$client->addScope('profile');


$client->setHttpClient(new \GuzzleHttp\Client([
    'verify' => 'C:\wamp64\cacert.pem'
]));
