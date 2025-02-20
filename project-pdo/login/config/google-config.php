<?php
$client = new Google_Client();
$client->setClientId('992625166156-sq9kbiujqc2he7ncdbsqiv2l5cga8rrl.apps.googleusercontent.com');
$client->setClientSecret('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');
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$currentUrl = $protocol . $_SERVER['HTTP_HOST'] . "/login/google-callback.php";
$client->setRedirectUri($currentUrl);
?>