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
        $notify_query = $link->query("SELECT * FROM `notifications` where uuid='$uuid' and status='unread' ORDER BY created_at DESC");
        $notyfyCount = $notify_query->rowCount();
        $sessionid = session_id();
        $userIP = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
		$timeout = 300; // 5 分鐘
		$link->query("DELETE FROM session WHERE created_at < NOW() - INTERVAL $timeout SECOND");
        $as = $link->query("SELECT * FROM session WHERE uuid = '$uuid'");
        if ($as->rowCount() > 0) {
          $link->query("UPDATE session SET created_at=now() WHERE uuid='$uuid'");
        } else {
          $link->query("INSERT INTO session VALUES('$uuid', '$sessionid','$userIP','$time')");
        }
        // 取得結果
       // if ($rowt = $as->fetch()) {       
        //  $last_activity = $rowt['created_at']; // 資料庫中最後活動時間
          // time() -- PHP時間戳 --
          // strtotime($last_activity)) -- 轉換時間戳 --

          // 判斷使用者使否在線
        //  if ($last_activity && (time() - strtotime($last_activity)) < $timeout)
        //    echo "使用者在線";
        //  else
        //    echo "使用者離線";
        //} else
        //  echo "使用者離線"; // 沒有找到該 UUID，視為離線	    
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
            while ($rows = $notify_query->fetch()) {
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
                <label><input type="checkbox" id="agree" onclick="agreeAccept()" disabled>我同意遵守<a href="#"
                    onclick="agreeAccept()">ボボ論壇使用協議</a></label>
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
	
    <!-- 發送郵件成功提示 -->
    <?php if (!empty($_SESSION['toast_tip'])): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: '<?= htmlspecialchars($_SESSION['toast_tip'], ENT_QUOTES) ?>',
                    position: 'top',
					width: 450,
                    showConfirmButton: false,
                    timer: 3000,
					timerProgressBar: true,
				  didOpen: (toast) => {
					toast.onmouseenter = Swal.stopTimer;
					toast.onmouseleave = Swal.resumeTimer;
				  }
                });
            });
        </script>
        <?php unset($_SESSION['toast_tip']); ?>
    <?php endif; ?>
	
  </nav> <!-- .nav-right -->

</header> <!-- .topnav -->
