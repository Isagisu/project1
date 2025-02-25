<?php
error_reporting(0);
require "./config/connect.php";
require "./Function.php";
$data = json_decode(file_get_contents("php://input"), true);
$category_id = $data['category_id'];
$user = $_SESSION["profile"];
$dataDB = GetUser($user);
$uuid = $dataDB["uuid"];

// 檢查是否已收藏
$stmt = $link->prepare("SELECT * FROM favoriteboards WHERE board_id = :category_id AND uuid = :uuid");
$stmt->execute(['category_id' => $category_id, 'uuid' => $uuid]);
$exists = $stmt->fetch(PDO::FETCH_ASSOC);

if ($exists) {
    // 若已收藏則刪除
    $stmt = $link->prepare("DELETE FROM favoriteboards WHERE board_id = :category_id AND uuid = :uuid");
    $stmt->execute(['category_id' => $category_id, 'uuid' => $uuid]);
    echo json_encode(['success' => true, 'action' => 'unfavorite']);
} else {
    // 未收藏則新增
    $stmt = $link->prepare("INSERT INTO favoriteboards (uuid, board_id) VALUES (:uuid, :category_id)");
    $stmt->execute(['uuid' => $uuid, 'category_id' => $category_id]);
    echo json_encode(['success' => true, 'action' => 'favorite']);
}
?>
