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
  header("Location: index.php");
  exit;
}
//如果帳號變數存在跑以下內容
if (isset($_POST["Username"])) {
  //用$user變數去接表單帳號，並移除空白
  $user = trim($_POST["Username"]);
}
//如果密碼變數存在跑以下內容
if (isset($_POST["Password"])) {
  //用$pw變數去接表單密碼，並移除空白
  $pw = trim($_POST["Password"]);
}
$today = date('Y-m-d H:i:s');
$_SESSION["profile"] = $user;
if ($user != "" && $pw != "") {
  //呼叫外部彈跳視窗CSS、JS
  echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
  echo "<link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css' rel='stylesheet'>";
  echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js'></script>";

  //查詢使用者帳號存在
  $account_run = $link->query("SELECT * FROM account WHERE userid='" . $user . "' or email='" . $user . "'");
  $account_check = $account_run->rowCount();
  $row = $account_run->fetch();

  //查詢使用者帳號密碼登入
  $login_result = $link->query("SELECT * FROM account WHERE password='" . $pw . "' AND email='" . $user . "' or userid='" . $user . "'");
  $account_records = $login_result->rowCount();

  //查詢使用者是否被禁止登入
  $blocked_records = $link->query("SELECT blocked FROM account WHERE userid='" . $user . "' and blocked='Y'");
  $blocked = $blocked_records->rowCount();

  //判斷使用者是否存在
  if ($account_check <= 0) {
    swalertAuto("question", "找不到此帳號!", "", "center");
    echo "<script>
        setTimeout(function(){
        window.location='index.php';
        },1500);
        </script>";
  }
  //判斷使用者是否被禁止登入
  elseif ($blocked > 0) {
    //自己寫的Function
    swalert("warning", "您的帳號已被系統停權!", "", "index.html");
    //登入狀態Session
    $_SESSION["login_session"] = false;
  }
  //判斷使用者如果被鎖住
  elseif ($row['lock_time'] != null) {
    $d1 = strtotime($today);
    $d2 = strtotime($row['lock_time']);
    $min = round(($d2 - $d1) / 60);
    if ($min <= 0) {
      swalert("info", "<b><font color='green'>帳號已解鎖請重新再試!</font></b>", "", "");
      $loginstatus_run = "UPDATE account set lock_time=null where userid='" . $user . "' or email='" . $user . "'";
      $link->query($loginstatus_run);
      $login_limited = "UPDATE account set login_limited=5 where userid='" . $user . "' or email='" . $user . "'";
      $link->query($login_limited);
    } else {
      swalertAuto("warning", "<b><font color='red'>帳號解鎖還有 $min 分鐘</font></b>", "", "center");
      echo "<script>
			setTimeout(function(){
			window.location='index.php';
			},1300);
			</script>";
    }
  }
  //判斷使用者登入次數小於2
  elseif ($row['login_limited'] < 2) {
    swalertAuto("warning", "帳號已暫時被系統封鎖!", "請稍後再試", "center");
    //更新使用者登入次數為-1
    $link->query("UPDATE account set login_limited=-1 where userid='" . $user . "' or email='" . $user . "'");
    //更新解鎖時間為10分鐘
    $link->query("UPDATE account set lock_time=DATE_ADD('$today', INTERVAL 10 MINUTE) where userid='" . $user . "' or email='" . $user . "'");
    //登入狀態為 『 未登入 』
    $_SESSION["login_session"] = false;
    echo "<script>
        setTimeout(function(){
        window.location='index.php';
        },1300);
        </script>";
  }
  //以上條件都不符合驗證使用者密碼
  elseif (password_verify($pw, $row["password"])) {
    setcookie("is_logged_in", "true", time() + 3600, "/");  // Cookie 有效期為 1 小時
    // 登入成功時，設置一個自定義的登入狀態 cookie
    // if (isset($_SESSION["login_session"]) && $_SESSION["login_session"] == true) {
    // setcookie("is_logged_in", "true", time() + 3600, "/");  // Cookie 有效期為 1 小時
    // } else {
    // setcookie("is_logged_in", "false", time() - 3600, "/");  // 清除 Cookie
    // }
    //如果登入成功將登入次數重置
    $link->query("UPDATE account set login_limited=5 where userid='" . $user . "'");
    //登入後將登入時間紀錄到資料庫
    $link->query("UPDATE account set last_login='$today' where userid='" . $user . "'");
    $_SESSION["login_session"] = true;
    //自己寫的Function
    swalertAuto("success", "登入成功!", "", "center");
    //這個函數沒有寫跳轉，所以手動跳轉
    echo "<script>
        setTimeout(function(){
        window.location='index.php';
        },1300);
        </script>";
  }
  // 登入失敗
  else {
    //登入次數每次減1
    $link->query("UPDATE account set login_limited=login_limited-1 where userid='" . $user . "' or email='" . $user . "'");
    //剩餘登入次數
    $limited = $row['login_limited'];
    swalert("error", "使用者密碼錯誤", "你還剩下 $limited 次登入次數", "index.php");
  }
}
