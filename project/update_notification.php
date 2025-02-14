<?php

if (isset($_POST['update'])) {
	if (session_status() === PHP_SESSION_NONE) 
	{
		session_start();
	}
	include "config.php";
    // 資料庫連線
    $conn = mysqli_connect(host,dbuser,dbpassword,dbname,port);

    // 檢查連線
    if (!$conn) {
        die("連線失敗：" . mysqli_connect_error());
    }
	$user = $_SESSION["profile"];
	$account = mysqli_query($conn, "SELECT * FROM account WHERE userid='" . $user . "' OR email='" . $user . "'");
	$account_data = mysqli_fetch_array($account);
	$uuid=$account_data["uuid"];
    // 更新通知為已讀
    $sqlUpdate = "UPDATE `notifications` AS m
    JOIN (
        SELECT id
        FROM `notifications`
        WHERE user = '$uuid' 
          AND status = 'unread'
        ORDER BY created_at DESC
        LIMIT 6
    ) AS sub
    ON m.id = sub.id
    SET m.status = 'read'";

    mysqli_query($conn, $sqlUpdate);

    // 重新查詢未讀通知數量
    $sqlCount = "SELECT COUNT(*) AS unreadCount FROM notifications WHERE user='$uuid' and status = 'unread' ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sqlCount);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $unreadCount = $row['unreadCount'];
    } else {
        $unreadCount = 0;  // 如果查詢失敗，預設未讀數量為0
    }

    // 回傳JSON格式
    echo json_encode(['unreadCount' => $unreadCount]);

    // 關閉資料庫連線
    mysqli_close($conn);
}
?>
