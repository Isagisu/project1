let userinfoIcon = document.getElementById("member");
let userinfo = document.getElementById("userinfo");
// 點擊圖示顯示或隱藏通知列表，並觸發AJAX更新
userinfoIcon.addEventListener("click", () => {
  userinfo.classList.toggle("active");

});

// 點擊其他地方時關閉通知列表
document.addEventListener("click", (event) => {
  if (!userinfoIcon.contains(event.target) && !userinfo.contains(event.target) && (typeof prev === "undefined"  || !prev.contains(event.target)) && (typeof next === "undefined" || !next.contains(event.target))) 
  {
    userinfo.classList.remove("active");
  }
});
