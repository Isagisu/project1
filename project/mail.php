<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$code=mt_rand(10000,99999);
$content = "
	  <hr>
	  <br>
	  <center>
	  <h3>親愛的用戶，感謝您註冊本平台會員。</h3>
	  <h4>以下是您的註冊驗證碼:</h4>
	  <br>
	  <div style=' display:inline-block;
		background-color:#eee;
		width:300px;
		height:65px;
		margin-right:20px;
		box-shadow:0px 0px 3px gray;
		border-radius:8px;
		'>
		  <p><font size='6' color=87ceeb><b>$code</b></font></p>
	   <br>
	  </div>
	  <br>
	  <br>
	  <div>
		<hr>
		<p><font color=000000><b>©2025小組專題</b></font></p>
	  </div>	
	  <br>
	<div></div>
	";
$mail = new PHPMailer(true);
$email="rastyed06@gmail.com";
try 
{
    // SMTP 配置
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // SMTP 伺服器
    $mail->SMTPAuth = true;
    $mail->Username = 'rastyed07@gmail.com'; // SMTP 帳號
    $mail->Password = 'kmpv ctnb iwup vvry';         // SMTP 密碼
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // 加密方式
    $mail->Port = 587;
	// $mail->SMTPAuth = true;
	// $mail->SMTPSecure = false;

	// 信件內容的編碼方式       
	$mail->CharSet = "utf-8";

	// 信件處理的編碼方式
	$mail->Encoding = "base64";
		
    // 收件人
    $mail->setFrom('rastyed06@gmail.com', '123'); //寄件人信箱
    $mail->addAddress($email, '[註冊驗證碼]|論壇專題網站'); //發信人和標題

    // 郵件內容
	$mail->From = "rastyed07@gmail.com"; //需要與上述的使用者資訊相同mail
	$mail->FromName = "論壇專題網站"; //此顯示寄件者名稱
    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body    = $content;
    $mail->AltBody = 'Hello, this is a test email!';

    $mail->send();
    echo "郵件寄送成功!";
}
catch (Exception $e)
{
    echo "Failed to send email. Error: {$mail->ErrorInfo}";
}
?>