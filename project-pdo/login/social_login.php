<?php
require_once 'vendor/autoload.php'; // 引入 Facebook SDK 和 Google SDK
$loginType = isset($_GET['platform']) ? $_GET['platform']:'';

if($_GET['platform']!="")
{
	switch ($loginType) {
		case 'google':
			require_once 'config/google-config.php'; // Google 設定檔
			$client->setScopes([
				'email',
				'profile',
				'https://www.googleapis.com/auth/user.birthday.read' // 讀取完整生日
			]);
			$client->setPrompt('consent'); // 強制每次請求都要求授權
			$authUrl = $client->createAuthUrl();
			break;
		case 'facebook':
			require_once './config/fb-config.php'; // Facebook 設定檔    
			$authUrl = $helper->getLoginUrl('http://localhost/login/fb-callback.php', $permissions);
			break;

		default:
			echo "未知的登入方式";
			exit;
	}
}
header("Location: $authUrl");

?>