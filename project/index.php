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
          <?php
          $stmt = $link->query('SELECT * FROM `articles` ORDER BY `id` DESC LIMIT 5');
          $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
          if ($stmt->rowCount() > 0) {
          ?>
            <div class="slider">
              <div class="slider-list">
                <?php
                // echo "<div class='slider-item'><img src='$row[url][0]' alt=''></div>";
                // foreach ($rows as $row) {
                // echo "<div class='slider-item'><img src='$row[url][1]' alt=''></div>";
                // }
                ?>
                <img src="./img/Killua-Zoldyck-by-Patrika-1.png" alt="Slider Image">
                <!-- <div class="slider-item"><img src="./img/Northshire-Abbey-by-ONE_RAMM.png" alt=""></div>
                <div class="slider-item"><img src="./img/Killua-Zoldyck-by-Patrika-1.png" alt=""></div>
                <div class="slider-item"><img src="./img/Killua-Zoldyck-by-Patrika-2.png" alt=""></div>
                <div class="slider-item"><img src="./img/Satoru Gojo Jujutsu Kaisen by patrika.png" alt=""></div>
                <div class="slider-item"><img src="./img/Shoto-Todoroki-Izuku-Midoriya-Katsuki-Bakugou-by-SHIN.png" alt=""></div>
                <div class="slider-item"><img src="./img/Levi-Ackerman-by-Yuki-Neh.png" alt=""></div> -->
              </div>
              <div class="slider-btns">
                <button id="prev"><i class="fa-solid fa-chevron-left"></i></button>
                <button id="next"><i class="fa-solid fa-chevron-right"></i></button>
              </div>
              <ul class="dots">
                <li class="active"></li>
                <?php
                foreach ($rows as $index => $row) {
                  if ($index == 0) {
                    continue;
                  }
                  echo '<li></li>';
                }
                ?>
              </ul>
            </div>
          <?php } ?>
          <!-- .slider -->

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

          <div class="popular-article-group">
            <a href="#" class="popular-article">
              <h2>熱門文章</h2>
              <p>講話掌握認識來電做什麼碩士，複雜山西笑。</p>
            </a>
            <a href="#" class="popular-article">
              <h2>熱門文章</h2>
              <p>廣泛類型數碼相機為了，殺手不僅，放棄日。</p>
            </a>
            <a href="#" class="popular-article">
              <h2>熱門文章</h2>
              <p>女朋友你的參觀相信提示訊息平均，回應組。</p>
            </a>
            <a href="#" class="popular-article">
              <h2>熱門文章</h2>
              <p>此次一本市委鄉民們想像很熱一下子用品至。</p>
            </a>
            <a href="#" class="popular-article">
              <h2>熱門文章</h2>
              <p>也沒網上影片尷尬其實老闆創意處理今年保。</p>
            </a>
            <a href="#" class="popular-article">
              <h2>熱門文章</h2>
              <p>權利周圍提醒體力我的筆者崗位基層，個性。</p>
            </a>
            <a href="#" class="popular-article">
              <h2>熱門文章</h2>
              <p>它們資訊食物消費尤其優秀西方裝置不好意。</p>
            </a>

          </div> <!-- .popular-article-group -->

          <div class="other-article-group">

            <div class="see-all">查看全部</div>
            <a href="#" class="other-article">
              <h2>其他文章</h2>
              <small>2025.01.01 07:00</small>
              <p>學歷圍繞之前，出售一條將會工作至今方面水果，作品裝備世紀一批老婆無論這時家裡適應成果實踐，二十暫時，服務減少，不但機關。</p>
            </a>
            <a href="#" class="other-article">
              <h2>其他文章</h2>
              <small>2024.12.25 14:25</small>
              <p>我去說明，思想士兵擴大動物近日在這具體，值得主動會員利益共同硬體也會唯一不禁是誰執法面前無關，工資女性形象肌。</p>
            </a>
            <a href="#" class="other-article">
              <h2>其他文章</h2>
              <small>2024.11.08 10:23</small>
              <p>硬盤答應上班和諧至今一些說什麼，網域名稱美容，重點予以臉色臉上，按照平台照片主板我有留下通過歐洲眼裡，女士幾年評分，治理來到一隻，資金她是，從。</p>
            </a>
            <a href="#" class="other-article">
              <h2>其他文章</h2>
              <small>2024.10.17 09:49</small>
              <p>打擊曝光付出來的一旦需要攻擊方面，我的心轉貼，你在房產關鍵字，又有更大司機不要，印象渠道知名估計，主機貫徹從來沒老人答案雲林明確吸。</p>
            </a>
            <a href="#" class="other-article">
              <h2>其他文章</h2>
              <small>2024.10.13 21:15</small>
              <p>接口不停總統工商只好，資產態度告知有限公司人生實業世紀湖口推出安排的人一年歲月，是我導航工業婦女一款兩年時候最好民族感覺可以用，遺憾聯繫方式則是精神也有快車而。</p>
            </a>
            <a href="#" class="other-article">
              <h2>其他文章</h2>
              <small>2024.09.23 16:37</small>
              <p>劇情損失組成一套唯一新浪體現隱藏版，報紙作品不需要聯想，年輕人證據能否運動將來，說出責任編輯也想，結婚就是一定超級首次，概念有時，應當。</p>
            </a>

          </div> <!-- .other-article-group -->

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
