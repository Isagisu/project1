<?php
error_reporting(0);
session_start();
require "connect.php";
require "Function.php";

if (isset($_SESSION["login_session"]) && $_SESSION["login_session"] == true) {
    $user = $_SESSION["profile"];
    $row = GetUser($user);
    $userimg = $row['profile'];
    $uuid = $row["uuid"];
    $userid = $row["userid"];
    $nickname = $row["nickname"];
} else {
    if ($_SERVER['HTTP_REFERER'] == "") {
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>個人頁面</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="shortcut icon" href="./img/Alolan Marowak.png">
    
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/topnav.css">
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="stylesheet" href="./css/slider.css">
    <link rel="stylesheet" href="./css/notifications.css">
    <link rel="stylesheet" href="./css/dropdown.css">

    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- FontAwesome Kit -->
    <script src="https://kit.fontawesome.com/81c16f2f84.js" crossorigin="anonymous"></script>

    <!-- React -->
    <script crossorigin src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
    <script crossorigin src="https://unpkg.com/babel-standalone@6.26.0/babel.min.js"></script>
</head>

<style>
    /* 基本佈局 */
    .f-container {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .main {
        flex: 1;
        background: #fff;
        padding-bottom: 2rem;
    }

    /* 搜尋結果區塊 */
    .search-content {
        background: var(--primary-bgc);
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        max-width: 1200px;
        width: 90%;
        padding: 2rem;
        margin: 20px auto;
		color: var(--primary-txt);
    }

    .search-header {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        flex-wrap: wrap;
        text-align: center;
		color: var(--primary-txt);
    }
    /* 結果卡片樣式 */
    .result {
        border: 1px solid #ddd;
        padding: 1.5rem;
        margin-bottom: 1rem;
        background-color: var(--secondary-bgc);
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease-in-out;
    }

    .result:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
    }

    .result h3 {
        margin-bottom: 5px;
        font-size: 22px;
        color: var(--primary-txt);
        font-weight: bold;
    }

    .result p {
        margin-top: 15px;
        font-size: 16px;
        color: var(--primary-txt);
        line-height: 1.6;
		
    }
	
    .result small {
        color: var(--primary-txt);      
    }	

    /* 響應式 */
    @media (max-width: 768px) {
        .search-header {
            flex-direction: column;
        }
    }
</style>

<body>
    <div class="f-container">
        <?php include('topnav.php') ?>
        <main class="main">
            <?php include('sidebar.php'); ?>
            <div class="search-content">
                <!-- 搜尋結果標題 -->
                <div class="search-header">
                    <h1>搜尋結果:</h1>
                    <h2 class="text-primary">MOD</h2>
                </div>
                <p class="text-center">一共 89 筆資料</p>
                <hr>
                <!-- 搜尋結果 -->
                <div class="result">
                    <h3>沒事轉變的第一步</h3>
                    <p>這是第一個搜尋結果的描述。</p>
					<small>2024.11.08 10:23</small>
                </div>
            </div>
        </main>
	<!-- Footer -->
    <?php require("footer.php") ?>	
    </div>

    <!-- Scripts -->
    <script src="./js/new-carousel.js"></script>
    <script src="./js/script.js"></script>
    <script src="./js/lightDark_mood.js"></script>
    <script src="./js/burger-sidebar.js"></script>
    <script src="./js/mobile-search.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
</body>

</html>
