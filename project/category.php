<?php
error_reporting(1);
session_start();
require "connect.php";
require "Function.php";
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Forum Layout</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="shortcut icon" href="./img/Alolan Marowak.png">
  <link rel="stylesheet" href="./css/style.css"> <!-- base       -->
  <link rel="stylesheet" href="./css/topnav.css"> <!-- topnav     -->
  <link rel="stylesheet" href="./css/sidebar.css"> <!-- sidebar    -->
  <link rel="stylesheet" href="./css/main.css"> <!-- main       -->
  <!-- component style  -->
  <link rel="stylesheet" href="./css/article.css">
  <link rel="stylesheet" href="./css/board.css">
  <link rel="stylesheet" href="./css/slider.css">
  <link rel="stylesheet" href="./css/notifications.css">
  <link rel="stylesheet" href="./css/dropdown.css">
  <!-- SweetAlert2  -->
  <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css' rel='stylesheet'>
  <!-- <link rel="stylesheet" href="./css/loading.css"> -->
  <!-- Bootstrap v5.3.3 min.css -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap-grid.css' />
  <!-- Bootstrap v5.3.3 min.css -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap-utilities.css' />
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://kit.fontawesome.com/81c16f2f84.js" crossorigin="anonymous"></script>

</head>

<body>

  <!-- 載入動畫... -->
  <!-- <div class="loading" id="loading">
    <div class="loading-container">
    <div class="loadingdot loading-dot-1"></div>
    <div class="loadingdot loading-dot-2"></div>
    <div class="loadingdot loading-dot-3"></div>
    </div>
  </div>-->

  <div class="f-container">

    <?php require("topnav.php") ?>


    <main class="main">
      <?php require("sidebar.php") ?>
      <div class="main-content">
        <div class="main-wrap">
       

          <div class="content">
            <div class="content-left">
              <?php
              $newarticle = $link->query('SELECT * FROM `posts` ORDER BY `update_time` DESC LIMIT 8');

              if ($newarticle->rowCount() > 0) {
                while ($row = $newarticle->fetch(PDO::FETCH_ASSOC)) {
              ?>
                  <a href="#" class="new-article">
                    <h2><?php echo $row["title"] ?></h2>
                    <p><?php echo $row["content"] ?></p>
                    <div class="icon-group">
                      <div class="icon-group-left">
                        <i class="fa-solid fa-thumbs-up"></i>
                        <i class="fa-solid fa-thumbs-down"></i>
                        <i class="fa-solid fa-message"></i>
                        <i class="fa-solid fa-share"></i>
                      </div>
                      <div class="icon-group-right">
                        <i class="fa-solid fa-paw"></i>
                        <i class="fa-solid fa-bookmark"></i>
                      </div>
                    </div>
                  </a>
              <?php }
              } ?>
            </div> <!-- .content-left -->
            <div class="content-right">
              <div class="board">
                <div class="board-heading">
                  <i class="fa-solid fa-chalkboard"></i>
                  <h3>公告欄</h3>
                </div>
                <div id="announcement" class="text-center">
                  <p><b>正在讀取公告欄消息<span class="loding_dots"></span></b></p>
                </div>
              </div>
              <div class="weather">
                <div class="weather-heading">
                  <h2>天氣</h2>
                  <i class="fa-solid fa-cloud"></i>
                  <i class="fa-solid fa-wind"></i>
                  <img src="./img/maltese1.gif" alt="線條小狗" width="80">
                </div>
                <div id="weather" class="text-center">
                  <p><b>正在讀取天氣資訊<span class="loding_dots"></span></b></p>
                </div>
              </div>
            </div> <!-- .content-right -->
          </div> <!-- .content -->


        </div> <!-- .main-wrap -->
      </div> <!-- .main content -->

    </main> <!-- .main -->

    <!-- footer -->
    <?php require("footer.php") ?>

  </div> <!-- .f-container -->

  <script src="./js/weather.js"></script>
  <script src="./js/announcement.js"></script>
  <script src="./js/new-carousel.js"></script>
  <script src="./js/script.js"></script>
  <script src="./js/lightDark_mood.js"></script>
  <script src="./js/burger-sidebar.js"></script>
  <script src="./js/mobile-search.js"></script>
  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js'></script>
</body>

</html>
