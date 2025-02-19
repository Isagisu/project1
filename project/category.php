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
  <!-- <link rel="stylesheet" href="./css/main.css"> main       -->
  <link rel="stylesheet" href="./css/category-main.css">
  <!-- component style  -->
  <!-- <link rel="stylesheet" href="./css/article.css"> -->
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
              <div class="category-group">
                <div class="category">
                  <div class="category-img">
                    <img src="./img/category/04.jpg" alt="">
                  </div>
                  <div class="category-content">
                    <h2>生活板</h2>
                    <p>生活瑣事、日常趣事，這裡都能聊！📢 無論是美食分享、旅遊攻略、理財心得，還是居家收納、時間管理，都歡迎來討論交流，讓生活變得更美好！✨</p>
                   <div class="category-btn"><p><i class="fa-solid fa-fire"></i><span>13742</span></p>
                   <i class="fa-regular fa-bookmark"></i></div>
                  </div>
                </div>
                 <div class="category">
                  <div class="category-img">
                   <img src="./img/category/07.jpg" alt="">
                  </div>
                  <div class="category-content">
                    <h2>3c板</h2>
                    <p>最新科技、手機、筆電、智慧家電，這裡通通有！📱💻 無論是新品開箱、選購指南，還是軟硬體問題討論，快來和大家一起交流你的 3C 生活！</p>
                     <div class="category-btn"><p><i class="fa-solid fa-fire"></i><span>13742</span></p>
                   <i class="fa-regular fa-bookmark"></i></div>
                  </div>
                </div>
                <div class="category">
                  <div class="category-img">
                    <img src="./img/category/03.jpg" alt="">
                  </div>
                  <div class="category-content">
                    <h2>遊戲板</h2>
                    <p>不管是主機、PC、手遊，還是懷舊經典，這裡都是玩家的天堂！🎮💥 來分享攻略、戰績、心得，找戰友組隊，或是討論最新遊戲資訊，一起享受遊戲的樂趣！</p>
                     <div class="category-btn"><p><i class="fa-solid fa-fire"></i><span>13742</span></p>
                   <i class="fa-regular fa-bookmark"></i></div>
                  </div>
                </div>
                  <div class="category">
                  <div class="category-img">
                     <img src="./img/category/05.jpg" alt="">
                  </div>
                  <div class="category-content">
                    <h2>動漫板</h2>
                    <p>二次元愛好者集合！📺🎨 這裡可以聊經典神作、推薦冷門佳作、討論劇情發展，也能分享動漫周邊、角色應援，無論新番還是懷舊動畫，都歡迎來交流！</p>
                     <div class="category-btn"><p><i class="fa-solid fa-fire"></i><span>13742</span></p>
                   <i class="fa-regular fa-bookmark"></i></div>
                  </div>
                </div>
                  <div class="category">
                  <div class="category-img">
                    <img src="./img/category/08.jpg" alt="">
                  </div>
                  <div class="category-content">
                    <h2>感情板</h2>
                    <p>戀愛煩惱、曖昧心事、友情困惑，這裡是你的樹洞與軍師！💌💕 無論是甜蜜放閃還是情感疑難雜症，都可以來討論，讓我們一起用心傾聽，陪你走過心動與心痛！</p>
                     <div class="category-btn"><p><i class="fa-solid fa-fire"></i><span>13742</span></p>
                   <i class="fa-regular fa-bookmark"></i></div>
                  </div>
                </div>
                  <div class="category">
                  <div class="category-img">
                   <img src="./img/category/12.jpg" alt="">
                  </div>
                  <div class="category-content">
                    <h2>追星板</h2>
                    <p>歡迎來到追星板！✨ 這裡是粉絲們交流的天地，不管你喜歡韓團、日星、歐美偶像，還是動漫聲優，都可以在這裡分享最新資訊、討論舞台表現、聊聊愛豆的趣事，一起為偶像應援！💖 快來加入我們吧！</p>
                     <div class="category-btn"><p><i class="fa-solid fa-fire"></i><span>13742</span></p>
                   <i class="fa-regular fa-bookmark"></i></div>
                  </div>
                </div>

                  <div class="category">
                  <div class="category-img">
                     <img src="./img/category/02.jpg" alt="">
                  </div>
                  <div class="category-content">
                    <h2>影劇板</h2>
                    <p>電影、影集、綜藝，這裡是觀影迷的交流基地！🎬📺 熱門大片、冷門佳片、追劇心得，還有經典回顧與影評分析，快來一起討論你的必看清單！🍿</p>
                   <div class="category-btn"><p><i class="fa-solid fa-fire"></i><span>13742</span></p>
                   <i class="fa-regular fa-bookmark"></i></div>
                  </div>
                </div>

              </div><!-- .category-group-->

              <div class="category-page">
                <a href="#" class="prev"><i class="fa-solid fa-angle-left"></i></a>
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#" class="next"><i class="fa-solid fa-angle-right"></i></a>
              </div> <!-- .category-page -->

            </div> <!-- .content-left -->
      
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
