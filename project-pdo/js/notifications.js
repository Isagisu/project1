let notifyIcon = document.getElementById("notificationIcon");
let notifications = document.getElementById("notifications");
let content = document.getElementById("notification");
// 點擊圖示顯示或隱藏通知列表，並觸發AJAX更新
notifyIcon.addEventListener("click", () => {
  notifications.classList.toggle("active");
});

// 點擊其他地方時關閉通知列表
document.addEventListener("click", (event) => {
  if (!notifyIcon.contains(event.target) && !notifications.contains(event.target) && (!prev || !prev.contains(event.target)) && (!next || !next.contains(event.target))) 
  {
    notifications.classList.remove("active");
  }
});

window.addEventListener("load", (event) =>  {
 notification();
 if(content)
 {
	document.getElementById("notification").innerHTML = "<p><b>正在讀取通知<span class='loding_dots'></span></b></p>";
 }

});
notifyIcon.addEventListener("click", () => {
  setTimeout(() => {
    updateCount();
  }, 300);  // 同步執行延遲
  setTimeout(() => {
    notification();
  }, 300);  // 輕微延遲 300 毫秒


});

//獲取通知資料
function notification() { 
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
	//判斷有撈到資料和成功發送請求
    if (this.readyState==4 && this.status==200) {
	  // 判斷 responseText 是否有資料（去除空白）
      if (this.responseText.trim() !== "") {
        document.getElementById("notification").innerHTML = this.responseText;
      }
    }
  }
  xmlhttp.open("POST","../notifications/notification_list.php");
  xmlhttp.send();
}

//更新通知狀態
function updateCount()
{
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../notifications/update_notification.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("update=true"); // 傳送更新請求

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let response = JSON.parse(xhr.responseText);
      // 更新通知數量
      const notificationCount = document.getElementById("notificationCount");
      if (notificationCount) {
        notificationCount.textContent = response.unreadCount;
        if (response.unreadCount <= 0) {
		  document.getElementById("notifications").innerHTML="<h1>通知</h1> 	<div class='notifications-card d-block fw-bold'> <div class='notification-content'> <p class='text-center'>目前沒有新的通知</p> </div> </div> <a href='#' class='view-all-btn mx-2'>查看所有通知<i class='bi bi-chat-text'></i></a>";	  
          notificationCount.classList.add("fade-out");
          setTimeout(function () {
            notificationCount.style.display = "none";
          }, 500);
        }
      }
    }
  };
}

function getCount()
{
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../notifications/update_notification.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("update=true"); // 傳送更新請求

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let response = JSON.parse(xhr.responseText);
       return response.unreadCount;
    }
  };
  
}