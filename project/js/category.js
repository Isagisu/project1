
//防止點擊書籤時跳轉頁面
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".bookmark-icon").forEach((bookmark) => {
    bookmark.addEventListener("click", function (event) {
      event.stopPropagation(); // 阻止點擊書籤時冒泡到 <a>
      event.preventDefault(); // 防止 <a> 觸發跳轉
      this.classList.toggle("fa-solid"); // 切換實心/空心圖標
      this.classList.toggle("fa-regular");
    });
  });
});


