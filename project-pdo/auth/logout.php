<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    
   <!-- <script>
	 Swal.fire({
					icon: "info",
	                title: "已登出系統",
	                text: "歡迎下次再來",
	            }).then(function(result) {
	               if (result.value) {
					window.location.href = 'index.php';
	               }	               
	            });  
    </script>-->
</body>

</html>
<?php
  error_reporting(0);
  session_start();
  //清除 cookie 內容
  require "../config/connect.php";
  require "../Function.php";
  
  if($_SESSION["login_session"] == false)
  {
    swalertAuto("info","你還沒登入!","","center");
  }
  else
  {
	$_SESSION["login_session"] = false;
	setcookie("is_logged_in", "false", time() - 3600, "/");
	// 清除 Google 存取權杖
	unset($_SESSION['access_token']);
	// 清除 PHP Session
	session_destroy();
	session_abort();
	swalertAuto("info","已登出系統!","歡迎下次再來","center");	 
  }
  echo "<script>
		setTimeout(function(){
		window.location='/';
		},1300);
		</script>";
   exit;
?>