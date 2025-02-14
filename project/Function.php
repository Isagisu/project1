<?php
function LoginTipModal()
{
  require_once "modal.php";
  if (!stripos($_SERVER['REQUEST_URI'], "/index")) {
    echo "<script>$(window).on(\'load\', function() {\n";
    echo "        $(\'#LoginTipModal\').modal(\'show\');\n";
    echo "    });\n</script>";
    //echo "<meta http-equiv='refresh' content='0;url=../index.php'/>";
  }
}
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
function swalertAuto($icon, $title, $msg, $postion)
{
  if (empty($url)) {
    $url = "index.php";
  }
  echo <<<EOT
	&nbsp;
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
	&nbsp;
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
  require("connect.php");
  // 查詢使用者帳號
  $account_run = $link->query("SELECT * FROM account WHERE userid='" . $user . "' OR email='" . $user . "'");
  $account_check = $account_run->rowCount();

  // 如果有結果，返回資料列；否則返回 null
  if ($account_check > 0) {
    $result = $account_run->fetch();
    return $result;
  } else {
    return null;
  }
}
