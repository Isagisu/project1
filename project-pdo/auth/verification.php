<?php
require "../config/connect.php"; 
require "../Function.php"; 
echo "<link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css' rel='stylesheet'>";
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js'></script>";	
// 檢查驗證碼 session 是否存在
if (!isset($_SESSION["code"])) {
    swalertAuto("error", "驗證碼不存在或已失效", "", "center");	 
    exit;
}
$code = $_SESSION["code"];
$input=$_GET["code"];
$user=$_SESSION["reg_user"];
$pw=$_SESSION["reg_pw"];
$email=$_SESSION["reg_email"];
$today = date('Y-m-d H:i:s');
if($input==$code)// 驗證成功後註冊
{
	unset($_SESSION["code"]);//刪除驗證碼伺服器暫存	
	$passwordHash = password_hash($pw, PASSWORD_DEFAULT);
	$link->query("insert into account values(uuid(),'$user','$user','$passwordHash','$email',Null,'$today','$today',Null,Null,Null,'5')");
	//刪除帳號暫存
	unset($_SESSION["reg_user"]);
	unset($_SESSION["reg_pw"]);
	unset($_SESSION["reg_email"]);
	$_SESSION['register_success'] = '帳號註冊成功';
	//swalertAuto("success","帳號註冊成功","","center");	
	//註冊成功後直接登入網站
	$_SESSION["profile"] = $user;
	$_SESSION["login_session"] = true;
    header("location:/");
}
else
{
	header("Location:/");
	exit;
}
?>