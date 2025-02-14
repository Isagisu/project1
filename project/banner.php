<?php
error_reporting(0);
require "connect.php";
//禁止使用者直接使用連結進入。

// 假設你已經建立資料庫連接 $conn

// 從資料庫獲取圖片資料
$query = "SELECT url,title FROM articles";
$result = $link->query($query);

$sliderData = [];

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
  $sliderData[] = $row;
}

// 把資料轉換為 JSON 格式並返回
echo json_encode($sliderData);
