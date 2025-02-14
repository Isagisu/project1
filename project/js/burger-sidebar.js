document.addEventListener("DOMContentLoaded", () => {
  const burgerBtn = document.getElementById("toggleSidebar");
  const sidebar = document.getElementById("sidebar");
  const items= document.querySelectorAll(".sidebar-wrap a");
  const body = document.body;
let scrollPosition = 0;

  burgerBtn.addEventListener("click", () => { // 切換側邊欄的顯示與隱藏
  if (!body.classList.contains("sidebar-open")) 
  {
   // **記錄滾動位置**
      scrollPosition = window.scrollY;
      body.style.top = `-${scrollPosition}px`;
	  body.classList.toggle("sidebar-open"); // 防止滾動
  }
  else
  {
	  // **恢復滾動位置**
      body.classList.remove("sidebar-open");
      body.style.removeProperty("top");
      window.scrollTo(0, scrollPosition);
  }
  sidebar.classList.toggle("active");
    
  
  items.forEach((item, index) => {
    item.style.animation = "none"; // 先清除動畫
    setTimeout(() => {
      item.style.animation = `sidebar_slidein 0.3s ease-out forwards`;
      item.style.animationDelay = `${0.1 * index}s`;
    }, 10);
  });
  });

  //點擊側邊欄外部關閉側邊欄;
  document.addEventListener("click", (e) => {
    if 
	(
        !sidebar.contains(e.target) &&
        !burgerBtn.contains(e.target) &&
        !e.target.classList.contains("slider") &&
        (!prev || !prev.contains(e.target)) && // 檢查 prev 是否存在
        (!next || !next.contains(e.target))    // 檢查 next 是否存在
    ) 
	{
        sidebar.classList.remove("active");
        body.classList.remove("sidebar-open");
    }
  });
});