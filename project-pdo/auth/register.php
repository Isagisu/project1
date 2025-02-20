<?php
//不報錯顯示
error_reporting(0);
//呼叫連結資料庫檔案
require "../config/connect.php";
//呼叫自定義函數
require "../Function.php";
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
	$_SESSION["reg_user"]=$user;
	$row = GetUser($user);
	$sql_user=$row['userid'];	
}
//抓取表單註冊密碼
if (isset($_POST["Password"])) {
	//用$pw變數去接表單密碼，並移除空白
    $pw = trim($_POST["Password"]);
	$_SESSION["reg_pw"]=$pw;
}
//抓取表單註冊信箱
if (isset($_POST["Email"])) {
	//用$pw變數去接表單密碼，並移除空白
    $email = trim($_POST["Email"]);
	$_SESSION["reg_email"]=$email;
	$row = GetUser($email);
	$sql_email=$row['email'];
}
//抓取表單註冊確認密碼
if (isset($_POST["Re_Password"])) {
	//用$pw變數去接表單密碼，並移除空白
    $repw = trim($_POST["Re_Password"]);
}
//密碼不重複
if($pw!=$repw)
{
	swalertAuto("warning","密碼與確認密碼不相符!","","center");
	echo "<script>
		setTimeout(function(){
		window.location='/';
		},1300);
		</script>";
}
//判斷電子信箱已使用
elseif($email==$sql_email)
{
	swalertAuto("warning","此電子信箱已經被使用過了!","","center");
	echo "<script>
		setTimeout(function(){
		window.location='/';
		},1500);
		</script>";
}
//判斷帳號已使用
elseif($user==$sql_user)
{
	swalertAuto("warning","該使用者帳號已存在!","","center");
	echo "<script>
		setTimeout(function(){
		window.location='/';
		},1500);
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
	$code=getverificationcode(30);
	$_SESSION["code"]=$code;
	$_SESSION["login_session"] = false;
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$currentUrl = $protocol . $_SERVER['HTTP_HOST'] . "/auth/verification.php";
	$content = <<<EOT
	    <html lang="zh-Hant">
	    <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
			body {
				font-family: Arial, sans-serif;
				margin: 0;
				padding: 0;
				display: flex;
				justify-content: center;
				align-items: center;
				height: 100vh;
			}
			.container {
				background-color: #ffffff;
				padding: 30px;
				border-radius: 12px;
				box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
				text-align: center;     
				width: 100%;
			}
			.verification-link {
				display: inline-block;
				width:500px;
				margin:5px;
				padding:10px;
				font-size: 18px;
				font-weight:bold;				
				text-decoration: none;
				border:1px soild #333;
				border-radius:8px;
				background:#2383E2;
				color: #fff;
			}
			.verification-link:hover {
				color: #fff;
			}
			footer {
				margin-top: 20px;
				font-size: 12px;
				color: #666;
			}
		</style>
		</head>
		<body>
			<div class="container">
				<h1>親愛的用戶，感謝您註冊本平台會員。</h1>
				<a href="$currentUrl?code=$code" class="verification-link" id="verificationLink">點擊此處完成驗證</a>
				<footer>
					<p>©2025小組專題</p>
				</footer>
			</div>
		</body>
	EOT;
	//發送郵件(自己寫的函式)
	SendMail($email, $content);
	header("location:/");
}
