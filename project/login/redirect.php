<?php
require_once 'vendor/autoload.php';
require "../connect.php";
//呼叫自定義函數
require "../Function.php";
$today = date('Y-m-d H:i:s');
require("Oauth2.php");
//呼叫外部彈跳視窗CSS、JS
echo "<link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css' rel='stylesheet'>";
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js'></script>";
//禁止使用者直接使用連結進入。
if ($_SERVER['HTTP_REFERER'] == "") {
  header("Location: ../index.php");
  exit;
}
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  if (!isset($token['error'])) {
    $_SESSION['access_token'] = $token;
    $client->setAccessToken($token);

    // 使用者資訊請求
    $oauth2 = new Google_Service_Oauth2($client);
    $google_account_info = $oauth2->userinfo->get();

    $userinfo = [
      'email' => $google_account_info['email'],
      'first_name' => $google_account_info['givenName'],
      'last_name' => $google_account_info['familyName'],
      'full_name' => $google_account_info['name'],
      'picture' => $google_account_info['picture'],
      'verifiedEmail' => $google_account_info['verifiedEmail'],
      'token' => $google_account_info['id'],
    ];
    $_SESSION["profile"] = $userinfo['full_name'];
	$_SESSION["login_session"] = true;
    // foreach ($userinfo as $key => $value) {
    //   echo $key . " " . $value . "<br>";
    // }
    //header('Location: myweb.php');
    $result = mysqli_query($link, "SELECT * FROM account where email='{$userinfo['email']}'");
    if (mysqli_num_rows($result) > 0) 
	{
      $userinfo = mysqli_fetch_assoc($result);
    } 
	else 
	{
      mysqli_query($link, "insert into account values(uuid(),'{$userinfo['full_name']}','{$userinfo['full_name']}','{$userinfo['token']}','{$userinfo['email']}',Null,'$today','$today','{$userinfo['picture']}',Null,Null,5)");
    }
   	//自己寫的Function
	swalertAuto("success", "已成功連結Google帳號!", "", "center");
	//這個函數沒有寫跳轉，所以手動跳轉
	echo "<script>
		  setTimeout(function(){
		  window.location='../index.php';
		  },1300);
		  </script>";
  } else {
    echo "無法獲取訪問權杖！";
  }
}
