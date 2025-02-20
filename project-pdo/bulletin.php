<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forum Layout</title>
  <?php
  error_reporting(1);
  require "config/connect.php";
  require "Function.php";
  ?>
  <link rel="shortcut icon" href="../img/Alolan Marowak.png">
  <link rel="stylesheet" href="../css/style.css"> <!-- base       -->
  <link rel="stylesheet" href="../css/topnav.css"> <!-- topnav     -->
  <link rel="stylesheet" href="../css/sidebar.css"> <!-- sidebar    -->
  <link rel="stylesheet" href="../css/main.css"> <!-- main       -->
  <!-- component style  -->
  <link rel="stylesheet" href="../css/slider.css">
  <link rel="stylesheet" href="../css/notifications.css">
  <link rel="stylesheet" href="../css/dropdown.css">
  <!-- Bootstrap v5.3.3 min.css -->
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    body {
      background: url('img/Enchanted-Tree-Pixel.png');
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      font-family: "Microsoft JhengHei", "微軟正黑體", sans-serif;
    }

    .new {
      padding: 10px;
      background: rgba(0, 0, 0, 0.3);
      color: white;
      font-size: 30px;
      border-radius: 10px;
      text-align: center;
      font-weight: bold;
    }

    .content {
      padding: 10px;
      background: rgba(0, 0, 0, 0.3);
      color: white;
      border-radius: 10px;
      text-align: center;
      font-weight: bold;
      font-size: 25px;
    }

    .sidebar {
      height: 100vh;
      margin-top: -25px;
    }
  </style>
</head>

<body>
  <!-- 導覽列 -->
  <header class="topnav">
    <nav class="nav-left">
      <!--burger-menu-->
      <button id="toggleSidebar" class="burger-switch">☰</button>

      <div class="logo">
        <a href="/" title="Forum Layout">
          <img src="../img/rabbit.gif" alt="">
          <img src="../img/rabbit.gif" alt="" style="transform: rotateY(180deg);">
        </a>
      </div> <!-- .logo -->
    </nav> <!-- .nav-left -->

    <nav class="nav-center">
      <div class="search">
        <form action="">
          <label>
            <input type="text" name="search" id="search">
            <button class="" onclick=""><i class="fa-solid fa-magnifying-glass"></i></button>
          </label>
        </form>
      </div> <!-- .search -->
    </nav> <!-- .nav-center -->

    <nav class="nav-right">
      <div class="nav-group">
        <?php
        if (isset($_SESSION["login_session"]) && $_SESSION["login_session"] == true) {
          $user = $_SESSION["profile"];
          $row = GetUser($user);
          $userimg = $row['profile'];
          $uuid = $row["uuid"];
          $notify_prepare = $link->prepare("SELECT * FROM `notifications` where uuid=:user and status='unread' ORDER BY created_at DESC");
          $notify_prepare->execute(['user' => $uuid]);
          $notyfyCount = $notify_prepare->rowCount();
        ?>
          <button class="notification" id="notificationIcon">
            <div>
              <i class="fa-solid fa-bell"></i>
              <?php if ($notyfyCount > 0) { ?>
                <span class='badge bg-danger Count' id="notificationCount">
                  <?php echo $notyfyCount; ?>
                </span>
              <?php } ?>
            </div>
          </button>

          <div class="notifications" id="notifications">
            <h1>通知</h1>
            <?php
            if ($notyfyCount <= 0) {
              echo <<<EOT
               <div class="notifications-card d-block fw-bold">
                 <div class="notification-content">
                   <p class="text-center">目前沒有新的通知</p>
                 </div>
               </div>
             EOT;
            } else {
              while ($rows = $notify_prepare->fetch()) {
                echo "<div id='notification' class='text-center'></div>";
              }
            }
            ?>
          </div>
          <button class="nav-link dropdown-toggle" id="member">
            <?php
			if ($userimg === null) 
			{
				// 如果沒有設定大頭貼，使用預設圖片
				echo "<img src='" . DEFAULT_AVATAR . "' class='rounded-circle p-2 mt-1' width='50px' height='50px'>";
				$userimgsrc=DEFAULT_AVATAR;			 	
			}
			else
			{
				// 判斷是否為 URL（即社群帳號登入的圖片）
				if (filter_var($userimg, FILTER_VALIDATE_URL)) 
				{
				// 如果是 URL，直接顯示，不加預設路徑
				echo "<img src='" . $userimg . "' class='rounded-circle' width='40px' height='40px'>";
				$userimgsrc=$userimg;
				} 
				else 
				{
					// 如果是本地圖片，加上預設路徑
					echo "<img src='" . DEFAULT_DIR . "$userimg' class='rounded-circle' width='40px' height='40px'>";
					$userimgsrc=DEFAULT_DIR . $userimg;
				}
			}
            ?>
          </button>
          <div class="userinfo" id="userinfo">
            <ul id="memberArea" class="userinfo-card">
              <li>
                <?php
                echo "<img src='$userimgsrc' class='rounded-circle img-thumbnail' width='65px' height='65px'>";        
                echo <<<EOT
                 <font size=4px>
                 <p class="text-center">{$row['nickname']}</p>
                 <p class="text-center">{$row['email']}</p>
                 </font>
               EOT;
                ?>
              </li>
              <hr>
              <li><a href="auth/logout.php"><i class="fa fa-outdent" style="font-size:15px"></i>&nbsp;&nbsp;登出</a></li>
            </ul>
          </div>
          <script src="../js/dropdown.js"></script>
          <script src="../js/notifications.js"></script>
        <?php
        } else {
          include_once '../login/social_login.php';
        ?>
          <button class="user btnLogin-popup" onclick="" title="登入/註冊" data-bs-placement="bottom">
            <i class="fa-solid fa-user"></i>
          </button>

		<!-- /登入/註冊區塊 -->
        <link rel="stylesheet" href="./css/login.css">
        <div class="wrapper">
          <span class="icon-close"><i class="fa-solid fa-xmark"></i></span>
          <div class="form-box login">
            <h2 class="my-5">登入</h2>
            <form action="auth/login.php" method="post">
              <div class="input-box">
                <span class="icon"><i class='bx bxs-envelope'></i></span>
                <input type="text" name="Username" id="Username" placeholder="" required>
                <label>電子郵件或使用者名稱</label>
              </div>
              <div class="input-box">
                <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                <input type="password" name="Password" id="Password" placeholder="" required>
                <label>密碼</label>
              </div>
              <!--  checkbox 勾選格 -->
              <!-- <input type="checkbox"> 記住我</label> -->
              <div class="remember-forgot justify-content-end p-2">
                <a href="#">忘記密碼?</a>
              </div>
              <button type="submit" class="btn-login" id="btn-login">登入</button>
              <div class="login-social">
                <div class="login-text-container">使用社群帳號登入</div>
                <a id="authUrl" href="login/social_login.php?platform=google"><img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google"></a>
                <a href="login/social_login.php?platform=facebook"> <img src="https://upload.wikimedia.org/wikipedia/en/0/04/Facebook_f_logo_%282021%29.svg" alt="Facebook"></a>
                <!--<a href=""> <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/LINE_logo.svg" alt="LINE"></a>
                <a href=""> <img src="https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg" alt="Microsoft"></a> -->
              </div>
              <div class="login-register">
                <p>尚未註冊? <a href="#" class="register-link">立即註冊</a></p>
              </div>
            </form>

          </div>
          <div class="form-box register">
            <h2>註冊</h2>
            <form action="auth/register.php" method="post">
              <div class="input-box">
                <span class="icon"><i class="fa-solid fa-user"></i></span>
                <input type="text" maxlength="10" name="Username" placeholder="" required>
                <label>使用者名稱</label>
              </div>
              <div class="input-box">
                <span class="icon"><i class='bx bxs-envelope'></i></span>
                <input type="email" name="Email" placeholder="" required>
                <label>Email</label>

              </div>
              <div class="input-box">
                <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                <input type="password" minlength="8" maxlength="10" name="Password" placeholder="" required>
                <label>密碼</label>
              </div>
              <div class="input-box">
                <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                <input type="password" minlength="8" maxlength="10" name="Re_Password" placeholder="" required>
                <label>確認密碼</label>
              </div>
              <div class="remember-forgot">
                <label><input type="checkbox" id="agree" onclick="agreeAccept()" required>我同意遵守<a href="#"
                    onclick="agreelist()">ボボ論壇使用協議</a></label>
              </div>
              <button type="submit" class="btn-register" id="btn-register">註冊</button>

              <div class="login-register">
                <p>已有帳號? <a href="#" class="login-link">立即登入</a></p>
              </div>
            </form>
          </div>
        </div>
        <?php
          echo '<script src="../js/login.js"></script>';
        }
        ?>
        <label for="themeSwitch" class="theme">
          <input type="checkbox" id="themeSwitch">
          <i class="fa-solid fa-moon"></i>
        </label>
        <!-- 590px以下時顯示的搜尋鈕 -->
        <button class="sm-search" onclick=""><i class="fa-solid fa-magnifying-glass"></i></button>
        <!-- 點擊搜尋鈕後顯示的搜尋框 -->
        <div class="mobile-search">
          <input type="text" placeholder="搜尋..." id="mobileSearchInput">
          <button class="close-search">✖</button>
        </div>

      </div> <!-- .nav-group -->

    </nav> <!-- .nav-right -->

  </header> <!-- .topnav -->
  <?php
  if (isset($_GET['bid'])) {
    $bid = $_GET['bid'];
  } else {
    echo "<script>window.location='bulletin.php?bid='</script>;";
  }
  $bulletin = "SELECT * FROM announcement where announceid=:bid";
  $news = $link->prepare($bulletin);
  $news->execute(['bid' => $bid]);
  $row = $news->fetch();

  ?>
  <br>

  <div class="container mb-4">
    <div class="rounded-3">
      <div class="mb-3 rounded-4 ">
        <p class="rounded-4">
          <?php
          if ($news->rowCount() > 0) {
            echo "<div class='new'>";

            if ($row["type"] == "活動") {
              echo "			   <div class=\"btn btn-warning\"><b>活動</b></div>\n";
            }
            if ($row["type"] == "系統") {
              echo "			   <div class=\"btn btn-danger\"><b>系統</b></div>\n";
            }
            if ($row["type"] == "更新") {
              echo "			   <div class=\"btn btn-info\"><b>更新</b></div>\n";
            }
            if ($row["type"] == "通知") {
              echo "			   <div class=\"btn btn-secondary\">通知</div>\n";
            }
            echo "<font size='4px' style='margin-top:5px'>【<u><b>$row[title]</b></u>】</font>";
            echo "<font size='2px' style='margin-top:5px'><b><font size='3px' style='margin-top:5px'>|</font>&nbsp;<i class='fa-sharp-duotone fa-solid fa-clock'></i> $row[announcedate]&nbsp;&nbsp;&nbsp;</b></font>";
            echo "</div>";
          } else {
            echo "<hr class='my-4 hr-top'><center><h5>公告</h5><hr>";
          }
          ?>
        </p>
        <div class="content">
          <?php
          if (!$news->rowCount()) {
            echo "<center>查無此公告</center>";
          } else {
            echo "<div style='display: flex;justify-content: center;align-items: center;height: 30vh;'>";
            echo "<font>$row[content]</font>";
            echo "</div>";
          }
          $link = null //關閉連線
          ?>

        </div>
      </div>

    </div>


  </div>

</html>


<!-- 頁尾 -->





<script src="../js/new-carousel.js"></script>
<script src="../js/script.js"></script>
<script src="../js/lightDark_mood.js"></script>
<script src="../js/burger-sidebar.js"></script>
<script src="../js/mobile-search.js"></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js'></script>

</body>

</html>
