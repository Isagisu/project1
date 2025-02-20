<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once __DIR__ . '/config.php';

// 設定 DSN 串接 MySQL 資料庫
$dsn = dbms . ":host=" . host . ";dbname=" . dbname;
$options = [
    PDO::ATTR_TIMEOUT => 3,  // 設定連線超時時間為 3 秒
];
try {
  // 使用 PDO 連接資料庫
  $link = new PDO($dsn, dbuser, dbpassword, $options);
  $link->exec("SET CHARACTER SET utf8");
} catch (PDOException $e) {
	echo "<link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css' rel='stylesheet'>";
	echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js'></script>";	
	function swalert($icon, $title, $msg, $url)
	{
	  echo <<<EOT
		 &nbsp;
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
  // 錯誤處理，使用 swalert 顯示錯誤訊息
  swalert("error", "資料庫連線錯誤", $e->getMessage(), "");
  exit();  // 停止執行後續程式碼
}
