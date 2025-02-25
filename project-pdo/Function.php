<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mail/PHPMailer/src/Exception.php';
require 'mail/PHPMailer/src/PHPMailer.php';
require 'mail/PHPMailer/src/SMTP.php';

function uuid()
{
  $chars = md5(uniqid(mt_rand(), true));
  $uuid = substr($chars, 0, 8) . '-'
    . substr($chars, 8, 4) . '-'
    . substr($chars, 12, 4) . '-'
    . substr($chars, 16, 4) . '-'
    . substr($chars, 20, 12);
  return $uuid;
}
function getverificationcode($length)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $index = random_int(0, strlen($characters) - 1);
    $randomString .= $characters[$index];
  }
  return $randomString;
}
function swalert($icon, $title, $msg, $url)
{
  echo <<<EOT
	<script>
		Swal.fire({
			icon: "$icon",
			title: "$title",
			text: "$msg",
			confirmButtonText: '確認',
		}).then(function(result) {
			if (result.value) {
				window.location.href = '$url';
			} else {
				Swal.fire("您選擇了Cancel");
			}
		});
	</script>
	EOT;
}
function swalertAuto($icon, $title, $msg, $postion)
{
  if (empty($url)) {
    $url = "index.php";
  }
  echo <<<EOT
	<script>
		Swal.fire({
			position: "$postion",
			icon: "$icon",
			title: "$title",
			text: "$msg",
			showConfirmButton: false,
			confirmButtonText: '確認',
			timer: 1500
		});
	</script>
	EOT;
}
function swalertimg($icon, $title, $msg, $url, $img, $heightimg)
{
  if (empty($url)) {
    $url = "index.php";
  }
  echo <<<EOT
	<script>
		Swal.fire({
			icon: "$icon",
			title: "$title",
			text: "$msg",
			imageUrl: "$img",
			imageHeight: "$heightimg",
			confirmButtonText: '確認',
		}).then(function(result) {
			if (result.value) {
				window.location.href = '$url';
			} else {
				Swal.fire("您選擇了Cancel");
			}
		});
	</script>
	EOT;
}
function GetUser($user)
{
  require("config/connect.php");
  // 查詢使用者帳號
  $account_run = $link->query("SELECT * FROM account WHERE BINARY userid='" . $user . "' OR email='" . $user . "'");
  $account_check = $account_run->rowCount();

  // 如果有結果，返回資料列；否則返回 null
  if ($account_check > 0) {
    $result = $account_run->fetch();
    return $result;
  } else {
    return null;
  }
}
function SendMail($email, $content)
{
  $mail = new PHPMailer(true);

  try {
    // SMTP 配置
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPKeepAlive = true;
    $mail->Username = 'rastyed07@gmail.com'; // SMTP 帳號
    $mail->Password = 'kmpv ctnb iwup vvry'; // SMTP 密碼 (App Password)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // 信件內容編碼方式
    $mail->CharSet = 'utf-8';
    $mail->Encoding = 'base64';

    // 收件人
    $mail->setFrom('rastyed07@gmail.com', '論壇專題網站'); //寄件人
    $mail->addAddress($email);

    // 郵件內容
    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body    = $content;
    $mail->AltBody = strip_tags($content);

    $mail->send();
    $_SESSION['toast_tip'] = '寄信成功請至您的信箱收取信件';
    // echo "郵件寄送成功!";
    // swalertAuto("success","寄信成功請至您的信箱收取信件","","center");
  } catch (Exception $e) {
    swalert("error", "郵件寄送失敗.", "錯誤訊息: {$mail->ErrorInfo}", "");
  }
}
