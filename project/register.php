<?php
//不報錯顯示
error_reporting(0);
session_start();
//呼叫連結資料庫檔案
require "connect.php";
//呼叫自定義函數
require "Function.php";
//禁止使用者直接使用連結進入。
if ($_SERVER['HTTP_REFERER'] == "") {
    header("Location: index.php");exit;
}
$today = date('Y-m-d H:i:s'); 
$login_limited=5;
//呼叫外部彈跳視窗CSS、JS
echo "<link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css' rel='stylesheet'>";
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js'></script>";

//抓取表單註冊帳號
if (isset($_POST["Username"])) {
	//用$user變數去接表單帳號，並移除空白
    $user = trim($_POST["Username"]);
}
//抓取表單註冊密碼
if (isset($_POST["Password"])) {
	//用$pw變數去接表單密碼，並移除空白
    $pw = trim($_POST["Password"]);
}
//抓取表單註冊信箱
if (isset($_POST["Email"])) {
	//用$pw變數去接表單密碼，並移除空白
    $email = trim($_POST["Email"]);
}
//抓取表單註冊確認密碼
if (isset($_POST["Re_Password"])) {
	//用$pw變數去接表單密碼，並移除空白
    $repw = trim($_POST["Re_Password"]);
}
if($pw!=$repw)
{
	swalertAuto("warning","密碼與確認密碼不相符!","","center");
	echo "<script>
		setTimeout(function(){
		window.location='index.php';
		},1300);
		</script>";
}
else
{
	/// 不用發信直接註冊
	// $passwordHash = password_hash($pw, PASSWORD_DEFAULT);
	// mysqli_query($link,"insert into account values(uuid(),'$user','$user','$passwordHash','$email',Null,'$today','$today',Null,Null,Null,'$login_limited')");
	// swalertAuto("success","帳號註冊成功","","center");	
	// $_SESSION["profile"] = $user;
	// $_SESSION["login_session"] = true;
	// echo "<script>
	// setTimeout(function(){
	// window.location='index.php';
	// },1300);
	// </script>";
	
	//產生驗證碼並跳轉到驗證頁面
	$code=mt_rand(10000,99999);
	$_SESSION["code"]=$code;
	swalertAuto("success","寄信成功請至您的信箱收取信件","","center");	
	echo "<script>
	setTimeout(function(){
	window.location='verification.php';
	},1300);
	</script>";
}
