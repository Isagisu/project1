<?php
require_once 'vendor/autoload.php';

require("Oauth2.php");
$client->addScope('email');
$client->addScope('profile');

$authUrl = $client->createAuthUrl();
?>