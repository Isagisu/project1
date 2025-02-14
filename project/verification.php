<?php
session_start();
$code = $_SESSION["code"];
echo $code;
$input=$_GET["code"];
if($input==$code)
{
	echo "驗證成功!";
}
else
{
	echo "驗證失敗!";
}
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>小組專題驗證</title>
</head>

<body>
  <form action="" method="get">
    <label for="code">請輸入驗證碼:</label>
    <input type="text" id="code" name="code">
    <input type="submit" value="驗證">
  </form>
</body>

</html>
