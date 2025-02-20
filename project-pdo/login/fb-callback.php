<?php
require_once './vendor/autoload.php';
require "../config/connect.php"; // 確保資料庫連線正確
require "../Function.php"; // 引入函數
require_once './config/fb-config.php'; // Facebook SDK 設定
echo "<link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css' rel='stylesheet'>";
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js'></script>";
try {
	$today = date('Y-m-d H:i:s');
    $helper = $fb->getRedirectLoginHelper();
    $accessToken = $helper->getAccessToken();

    if (!isset($accessToken)) {
        throw new Exception("Facebook 登入失敗，無法獲取 access token。");
    }

    $fb->setDefaultAccessToken($accessToken);

    // 取得使用者資訊
    $response = $fb->get('/me?fields=id,name,email,first_name,last_name,picture,birthday,gender,location');
    $user = $response->getGraphUser();

    $userinfo = [
        'id' => $user['id'],
        'email' => $user['email'] ?? NULL,
        'name' => $user['name'],
        'first_name' => $user['first_name'],
        'last_name' => $user['last_name'],
        'picture' => $user['picture']['url'] ?? NULL,
        'birthday' => $user['birthday'] ?? NULL,
        'gender' => $user['gender'] ?? NULL,
        'location' => $user['location']['name'] ?? NULL
    ];

    // 檢查 email 是否已存在
    $stmt = $link->prepare("SELECT COUNT(*) FROM account WHERE email = :email");
    $stmt->bindParam(":email", $userinfo['email'], PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count == 0) { // 只有當 email 不存在時才執行 INSERT
        $stmt = $link->prepare("INSERT INTO account 
            (`uuid`, `userid`, `nickname`, `password`, `email`, `birthday`, `regdate`, `last_login`, `profile`, `blocked`, `lock_time`, `login_limited`) 
            VALUES (UUID(), :name, :username, :token, :email, :birthday, :created_at, :updated_at, :avatar, NULL, NULL, 5)");

        if (!$stmt->execute([
            ':name' => $userinfo['name'],
            ':username' => $userinfo['name'],
            ':token' => $accessToken,
            ':email' => $userinfo['email'],
            ':birthday' => $userinfo['birthday'],
            ':created_at' => $today,
            ':updated_at' => $today,
            ':avatar' => $userinfo['picture']
        ])) {
            die("資料插入失敗：" . print_r($stmt->errorInfo(), true));
        }
    }

    // 設定登入狀態
    $_SESSION["profile"] = $userinfo['name'];
    $_SESSION["login_session"] = true;

    // 測試 swalertAuto 是否有執行
    swalertAuto("success", "已成功連結Facebook帳號!", "", "center");

    // 測試 setTimeout 是否正常執行
    echo "<script>
          setTimeout(function(){
          window.location='../index.php';
          }, 1300);
          </script>";
} catch (\Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Facebook API 錯誤: ' . $e->getMessage();
    exit;
} catch (\Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK 錯誤: ' . $e->getMessage();
    exit;
} catch (Exception $e) {
    echo '錯誤: ' . $e->getMessage();
    exit;
}
?>
