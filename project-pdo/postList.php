<?php
    error_reporting(1);
    session_start();
    require "./config/connect.php";
    require "./Function.php";
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
  <!-- <link rel="stylesheet" href="./css/sidebar.css"> sidebar    -->
  <!-- <link rel="stylesheet" href="./css/main.css"> main       -->
  <link rel="stylesheet" href="./css/postList.css">
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
   <script src="https://unpkg.com/@popperjs/core@2"></script>
   <!-- Tippy.js -->
  <script src="https://unpkg.com/tippy.js@6"></script>
  <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css">
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

    <?php require "./templates/topnav.php"?>


    <main class="main">


      <div class="main-content">
        <div class="main-wrap">
          <div class="content">

            <div class="content-top">
              <h1>生活板</h1>
              <button data-tippy-content="收藏看板">收藏</button>
            </div><!-- /.content-top -->

            <div class="postList-group">

                <a href="#" class="postList">
                  <div class="postList-content">
                    <div class="top">
                      <img src="./img/category/04.jpg" alt="">
                      <p>生活版<span>5小時前</span></p>
                    </div><!--.top-->
                    <h2>標題</h2>
                    <p>望着不住保障報導定義工業清楚會員價下載春天一部分發展可以他在，隨便探索發生剛剛一家重新，國家居住不好意思讀書大戰也會。</p>
                    <div class="postList-btn"><p><i class="fa-solid fa-thumbs-up"></i><span>666</span><i class="fa-solid fa-comment"></i><span>25</span></p>
                    </div><!--.postList-btn-->
                  </div><!--.postList-content-->
                  <div class="postList-img">
                    <img src="./img/postList/01.jpg" alt="">
                  </div><!--.postList-img-->
                </a><!--.postList-->

                <a href="#" class="postList">
                  <div class="postList-content">
                    <div class="top">
                      <img src="./img/category/04.jpg" alt="">
                      <p>生活版<span>5小時前</span></p>
                    </div><!--.top-->
                    <h2>標題</h2>
                    <p>望着不住保障報導定義工業清楚會員價下載春天一部分發展可以他在，隨便探索發生剛剛一家重新，國家居住不好意思讀書大戰也會。</p>
                    <div class="postList-btn"><p><i class="fa-solid fa-thumbs-up"></i><span>666</span><i class="fa-solid fa-comment"></i><span>25</span></p>
                    </div><!--.postList-btn-->
                  </div><!--.postList-content-->
                  <div class="postList-img">
                    <img src="./img/postList/02.jpg" alt="">
                  </div><!--.postList-img-->
                </a><!--.postList-->
                
                <a href="#" class="postList">
                  <div class="postList-content">
                    <div class="top">
                      <img src="./img/category/04.jpg" alt="">
                      <p>生活版<span>5小時前</span></p>
                    </div><!--.top-->
                    <h2>標題</h2>
                    <p>望着不住保障報導定義工業清楚會員價下載春天一部分發展可以他在，隨便探索發生剛剛一家重新，國家居住不好意思讀書大戰也會。</p>
                    <div class="postList-btn"><p><i class="fa-solid fa-thumbs-up"></i><span>666</span><i class="fa-solid fa-comment"></i><span>25</span></p>
                    </div><!--.postList-btn-->
                  </div><!--.postList-content-->
                  <div class="postList-img">
                    <img src="./img/postList/03.jpg" alt="">
                  </div><!--.postList-img-->
                </a><!--.postList-->
                
                <a href="#" class="postList">
                  <div class="postList-content">
                    <div class="top">
                      <img src="./img/category/04.jpg" alt="">
                      <p>生活版<span>5小時前</span></p>
                    </div><!--.top-->
                    <h2>標題</h2>
                    <p>望着不住保障報導定義工業清楚會員價下載春天一部分發展可以他在，隨便探索發生剛剛一家重新，國家居住不好意思讀書大戰也會。</p>
                    <div class="postList-btn"><p><i class="fa-solid fa-thumbs-up"></i><span>666</span><i class="fa-solid fa-comment"></i><span>25</span></p>
                    </div><!--.postList-btn-->
                  </div><!--.postList-content-->
                  <div class="postList-img">
                    <img src="./img/postList/04.jpg" alt="">
                  </div><!--.postList-img-->
                </a><!--.postList-->

              <a href="#" class="postList">
                  <div class="postList-content">
                    <div class="top">
                      <img src="./img/category/04.jpg" alt="">
                      <p>生活版<span>5小時前</span></p>
                    </div><!--.top-->
                    <h2>標題</h2>
                    <p>望着不住保障報導定義工業清楚會員價下載春天一部分發展可以他在，隨便探索發生剛剛一家重新，國家居住不好意思讀書大戰也會。</p>
                    <div class="postList-btn"><p><i class="fa-solid fa-thumbs-up"></i><span>666</span><i class="fa-solid fa-comment"></i><span>25</span></p>
                    </div><!--.postList-btn-->
                  </div><!--.postList-content-->
                  <div class="postList-img">
                    <img src="./img/postList/05.jpg" alt="">
                  </div><!--.postList-img-->
                </a><!--.postList-->

                <a href="#" class="postList">
                  <div class="postList-content">
                    <div class="top">
                      <img src="./img/category/04.jpg" alt="">
                      <p>生活版<span>5小時前</span></p>
                    </div><!--.top-->
                    <h2>標題</h2>
                    <p>望着不住保障報導定義工業清楚會員價下載春天一部分發展可以他在，隨便探索發生剛剛一家重新，國家居住不好意思讀書大戰也會。</p>
                    <div class="postList-btn"><p><i class="fa-solid fa-thumbs-up"></i><span>666</span><i class="fa-solid fa-comment"></i><span>25</span></p>
                    </div><!--.postList-btn-->
                  </div><!--.postList-content-->
                  <div class="postList-img">
                    <img src="./img/postList/06.jpg" alt="">
                  </div><!--.postList-img-->
                </a><!--.postList-->
                

              </div><!-- .postList-group-->

              <div class="postList-page">
                <?php
                                      // 上一頁
                    if ($page != 1) { // 判斷不在第一頁時才顯示下一頁箭頭
                        echo " <a class='prev' href='postList?page=$prev' style='text-decoration:none'>
						  <font size='3'><i class='fa-solid fa-angle-left'></i></font>
						</a>";
                    }

                    // 頁面內容不存在跳轉到上一頁
                    if ($page > $totalpage) {
                        echo "<script>history.go(-1);</script>";
                    }

                    // 頁數按鈕
                    for ($i = 1; $i <= $totalpage; $i++) {
                        if ($i == $page) {
                            echo "<strong>$i</strong> "; // 目前所在頁面
                        } else {
                            echo "<a href='category?page=$i' style='text-decoration:none;cursor:pointer'>$i</a> ";
                        }
                    }

                                              // 下一頁
                    if ($page < $totalpage) { // 只有當前頁小於總頁數時才顯示下一頁箭頭
                        echo "<a class='next' href='postList?page=$next' style='text-decoration:none'>
						  <font size='3'><i class='fa-solid fa-angle-right'></i></font>
						</a>";
                    }
                ?>
              </div> <!-- .postList-page -->


          </div> <!-- .content -->


        </div> <!-- .main-wrap -->
      </div> <!-- .main content -->

    </main> <!-- .main -->

    <!-- footer -->
    <?php require "./templates/footer.php"?>

  </div> <!-- .f-container -->

  <script src="./js/script.js"></script>
  <script src="./js/lightDark_mood.js"></script>
  <script src="./js/mobile-search.js"></script>
  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js'></script>
  <script src="./js/category.js"></script>
  <script>
        // 啟用 Tippy.js
   tippy('[data-tippy-content]', {
    animation: 'scale',  // 動畫效果（fade, scale, shift-away, shift-toward）
    delay: [100, 200],   // 顯示/隱藏的延遲（毫秒）
    placement: 'bottom',    // 位置（top, bottom, left, right）
    theme:'translucent',
});
  </script>
</body>

</html>


