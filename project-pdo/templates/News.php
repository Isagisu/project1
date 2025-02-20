<?php
error_reporting(0);
require "../config/connect.php";
//禁止使用者直接使用連結進入。
if ($_SERVER['HTTP_REFERER'] == "") {
  header("Location: /");
  exit;
}
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['count'])) {
  $_SESSION['count'] = 1;
}
$page = $_SESSION['count'];
$pageSize = 5;
$offset = ($page - 1) * $pageSize;
$pagesql = "SELECT * FROM announcement order by announcedate DESC limit $offset,$pageSize";
$result = $link->query($pagesql);
$totalsql = $link->query("SELECT * FROM announcement");
$total = $totalsql->rowCount();
$totalpage = ceil($total / $pageSize);
$link = null;
?>
<div class="board-content">
  <ul>
    <?php
    while ($row = $result->fetch()) {
      if ($row['type'] == "系統")
        $type = "system";
      if ($row['type'] == "活動")
        $type = "selected";

      $date = date("Y/m/d", strtotime($row['announcedate']));
      echo <<<EOT
        <div class="board-item p-3 animation">
            <div class="date"><span class="note $type">$row[type]公告</span>$date</div>
            <div class="text-start p-2" onclick="window.location='bulletin.php?bid=$row[announceid]';"><a href="#">$row[title]</a></div>
        </div>
    EOT;
    }

    ?>
    <div class="pagination">
      <?php
      // 上一頁
      if ($page != 1) { // 判斷不在第一頁時才顯示下一頁箭頭
        echo " <a class='page-link' onclick='minus();event.preventDefault();' style='text-decoration:none'>
			  <font size='3'><i class='fa-solid fa-angle-left'></i></font>
			</a>";
      }

      // 頁數按鈕
      for ($i = 1; $i <= $totalpage; $i++) {
        if ($i == $page) {
          echo "<strong>$i</strong> ";  // 目前所在頁面
        } else {
          echo "<a onclick='alink($i)' style='text-decoration:none;cursor:pointer'>$i</a> ";
        }
      }

      // 下一頁
      if ($page < $totalpage) { // 只有當前頁小於總頁數時才顯示下一頁箭頭
        echo "<a class='page-link' onclick='increment();event.preventDefault();' style='text-decoration:none'>
			  <font size='3'><i class='fa-solid fa-angle-right'></i></font>
			</a>";
      }
      ?>
    </div>
</div>
