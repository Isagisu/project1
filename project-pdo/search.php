<?php
error_reporting(0);
session_start();
require "./config/connect.php";
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
  .main{
    background:#fff;
  }
  /* 結果卡片樣式 */
.search-results {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 98%;
  padding: 2rem 0;
  margin-top:12px;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
}

.result-card {
  background-color: #ecf0f1;
  padding: 20px;
  border-radius: 8px;
  margin-bottom: 20px;
  width: 100%;
  max-width: 50vw; 
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease-in-out;
}
.result-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
} 
.search-results h2 {
    margin-bottom: 10px;
} 
.result-card h3 {
  margin: 0 0 10px;
  font-size:20px;
  font-weight:bold;
}
.result-card p {
  color: #7f8c8d;
  margin-top: 20px;
}

.result-card small {
  font-size: 13px;
  
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
    <?php include('./templates/topnav.php') ?>
    <main class="main">
      <?php include('./templates/sidebar.php'); ?>
            <div class="search-results">
                <h2>搜尋結果: <span style="color: #3498db;">MOD</span></h2>
                <p>一共 89 筆資料</p>
                <div class="result-card">
                    <h3>沒事轉變的第一步</h3>
                    <p>這是第一個搜尋結果的描述。</p>
                    <small>2024.11.08 10:23</small>
                </div>
                <div class="result-card">
                    <h3>沒事轉變的第一步</h3>
                    <p>這是第一個搜尋結果的描述。</p>
                    <small>2024.11.08 10:23</small>
                </div>			
                <div class="result-card">
                    <h3>沒事轉變的第一步</h3>
                    <p>這是第一個搜尋結果的描述。</p>
                    <small>2024.11.08 10:23</small>
                </div>	
                <div class="result-card">
                    <h3>沒事轉變的第一步</h3>
                    <p>這是第一個搜尋結果的描述。</p>
                    <small>2024.11.08 10:23</small>
                </div>	
                <div class="result-card">
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
