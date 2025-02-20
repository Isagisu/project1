<?php
require_once __DIR__ . '../../vendor/facebook/graph-sdk/src/Facebook/autoload.php';

$fb = new \Facebook\Facebook([
  'app_id' => '9323910881028298',
  'app_secret' => '040e10c9c3623c46d1ebd6537991898c',
  'default_graph_version' => 'v2.10',  // 確保使用最新版本
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // 取得使用者電子郵件
$loginUrl = $helper->getLoginUrl('http://localhost/login/fb-callback.php', $permissions);
?>