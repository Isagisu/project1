<?php
error_reporting(0);
require "../config/connect.php";
require "../Function.php";
//禁止使用者直接使用連結進入。
if ($_SERVER['HTTP_REFERER'] == "") {
  header("Location: /");
  exit;
}
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$row = GetUser($user);
$uuid = "73b5be9c-baae-42ea-954e-8e7fd0e95368";
$sql = "SELECT * FROM `notifications` where uuid='$uuid' and status='unread' ORDER BY created_at DESC LIMIT 6 OFFSET 0";
$result = $link->query($sql);;
while ($rows = $result->fetch(PDO::FETCH_ASSOC)) 
{
  $date = date("Y/m/d", strtotime($rows['created_at']));
  $today = date('Y-m-d H:i:s'); 
  $d1=strtotime($today);
	   $d2=strtotime($rows['created_at']);
	   $Days=round(($d1-$d2)/3600/24);
  echo <<<EOT
          <div class="notifications-card">
           <div class="notification-content">
            <h3>$rows[message]</h3>
            <span>$Days</span>
           </div>
          </div>
        EOT;
}
?>
