<aside class="sidebar" id="sidebar">
  <div class="sidebar-wrap">
    <a href="/">
      <i class="fa-solid fa-house"></i>
      <span>首頁</span>
    </a>
    <a href="#">
      <i class="fa-solid fa-newspaper"></i>
      <span>最新消息</span>
    </a>
    <a href="#">
      <i class="fa-solid fa-calendar-days"></i>
      <span>活動資訊</span>
    </a>
    <a href="#">
      <i class="fa-solid fa-star"></i>
      <span>精選文章</span>
    </a>
    <a href="./category.php">
      <i class="fa-solid fa-folder"></i>
      <span>看板分類</span>
    </a>	  
	<?php if (isset($_SESSION["login_session"]) && $_SESSION["login_session"] == true) {?>
    <a href="./profile.php">
      <i class="fa-solid fa-users"></i>
      <span>會員中心</span>
    </a>	 
	<?php } ?>
  </div> <!-- /sidebar-wrap -->
</aside> <!-- .sidebar -->
