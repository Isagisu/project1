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

    <?php require("./templates/topnav.php") ?>


    <main class="main">
      <?php require("./templates/sidebar.php") ?>

      <div class="main-content">
        <div class="main-wrap">
          <div class="content">
            <div class="content-left">
              <div class="category-group">
                <?php
                if (!isset($_GET['page']) || empty($_GET['page']))
                  $page = 1;
                else
                  $page = $_GET['page'];
                $pageSize = 4; //一頁顯示幾筆資料
                $offset = ($page - 1) * $pageSize;
                $category = $link->query("SELECT * FROM `category` limit $offset,$pageSize");
                $totalsql = $link->query("SELECT * FROM category");
                $total = $totalsql->rowCount();
                $totalpage = ceil($total / $pageSize);
                $prev = $page - 1;
                $next = $page + 1;
                $user = $_SESSION["profile"];
				$dataDB = GetUser($user);
				$uuid = $dataDB["uuid"];
                while ($data = $category->fetch(PDO::FETCH_ASSOC)) {
                  $postscount = $link->query("select count(posts.category_id) from posts INNER JOIN category where posts.category_id=category.category_id and posts.category_id=$data[category_id]");
                  $favorite = $link->query("select * from favoriteboards INNER JOIN category where favoriteboards.board_id=category.category_id and uuid='$uuid'");
                  while ($dataP = $postscount->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <a href="./postList" class="category">
                      <div class="category-img">
                        <img src="./img/category/<?php echo $data["img"] ?>" alt="">
                      </div>
                      <div class="category-content">
                        <h2><?php echo $data["category_name"] ?></h2>
                        <p><?php echo $data["description"] ?></p>
                        <div class="category-btn">
                          <!-- <p><i class="fa-solid fa-fire"></i><span>13742</span>
                          <i class="fa-solid fa-file"></i><span>19</span>
                        </p> -->
                          <p><i class="fa-solid fa-fire"></i><span>人氣值 13742</span> &nbsp;📝 <span>文章數 <?php echo $dataP["count(posts.category_id)"] ?></span></p>
                        <?php
							$isFavorite = false;
							while ($dataF = $favorite->fetch(PDO::FETCH_ASSOC)) {
								if ($dataF["board_id"] === $data["category_id"]) {
									$isFavorite = true;
									break;
								}
							}
							$status = $isFavorite ? "fa-solid" : "fa-regular";
							if (isset($_SESSION["login_session"]) && $_SESSION["login_session"] == true) {
						?>
						  
						<i class="fa-bookmark bookmark-icon <?php echo $status; ?>" 
						   data-category-id="<?php echo $data['category_id']; ?>">
						</i>
						<?php } ?>
                        </div>
                      </div>
                    </a>
                <?php }
                } ?>

              </div><!-- .category-group-->

              <div class="category-page">
                <?php
                // 上一頁
                if ($page != 1) { // 判斷不在第一頁時才顯示下一頁箭頭
                  echo " <a class='prev' href='category?page=$prev' style='text-decoration:none'>
						  <font size='3'><i class='fa-solid fa-angle-left'></i></font>
						</a>";
                }

                // 頁面內容不存在跳轉到上一頁
                if ($page > $totalpage)
                  echo "<script>history.go(-1);</script>";

                // 頁數按鈕
                for ($i = 1; $i <= $totalpage; $i++) {
                  if ($i == $page) {
                    echo "<strong>$i</strong> ";  // 目前所在頁面
                  } else {
                    echo "<a href='category?page=$i' style='text-decoration:none;cursor:pointer'>$i</a> ";
                  }
                }

                // 下一頁
                if ($page < $totalpage) { // 只有當前頁小於總頁數時才顯示下一頁箭頭
                  echo "<a class='next' href='category?page=$next' style='text-decoration:none'>
						  <font size='3'><i class='fa-solid fa-angle-right'></i></font>
						</a>";
                }
                ?>
              </div> <!-- .category-page -->

            </div> <!-- .content-left -->

          </div> <!-- .content -->


        </div> <!-- .main-wrap -->
      </div> <!-- .main content -->

    </main> <!-- .main -->

    <!-- footer -->
    <?php require("./templates/footer.php") ?>

  </div> <!-- .f-container -->

  <script src="./js/script.js"></script>
  <script src="./js/lightDark_mood.js"></script>
  <script src="./js/burger-sidebar.js"></script>
  <script src="./js/mobile-search.js"></script>
  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js'></script>
  <script src="./js/category.js"></script>
</body>

</html>
