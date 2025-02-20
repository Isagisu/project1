<?php
if (isset($_POST['update'])) {
	if (session_status() === PHP_SESSION_NONE) 
	{
		session_start();
	}
    // 資料庫連線
	require "../config/config.php";
	require "../config/connect.php";
	
	$user = $_SESSION["profile"];
	$account = $link->query("SELECT * FROM account WHERE userid='" . $user . "' OR email='" . $user . "'");
	$account_data = $account->fetch(PDO::FETCH_ASSOC);
	$uuid=$account_data["uuid"];
    // 更新通知為已讀
    $sqlUpdate = "UPDATE `notifications` AS m
    JOIN (
        SELECT id
        FROM `notifications`
        WHERE uuid = '$uuid' 
          AND status = 'unread'
        ORDER BY created_at DESC
        LIMIT 6
    ) AS sub
    ON m.id = sub.id
    SET m.status = 'read'";

    $link->query($sqlUpdate);

    // 重新查詢未讀通知數量
    $sqlCount = "SELECT COUNT(*) AS unreadCount FROM notifications WHERE uuid='$uuid' and status = 'unread' ORDER BY created_at DESC";
    $result = $link->query($sqlCount);

    if ($result) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $unreadCount = $row['unreadCount'];
    } else {
        $unreadCount = 0;  // 如果查詢失敗，預設未讀數量為0
    }

    // 回傳JSON格式
    echo json_encode(['unreadCount' => $unreadCount]);

    // 關閉資料庫連線
    $link = null;
}
?>
