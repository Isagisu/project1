document.addEventListener("DOMContentLoaded", () => {
  const switchButton = document.getElementById("themeSwitch");
  const root = document.documentElement;
  const savedMode = localStorage.getItem("theme"); //取出儲存資料
  let moon = document.querySelector(".theme i"); //設定按紐圖案的變數

  // 確認初始背景模式
  if (savedMode === "dark") {
    //=== 嚴格相等;需要資料類型和值都相等才算相等
    document.body.classList.add("dark");
    root.style.setProperty("--primary-txt", "#fff"); //深色模式文字顏色
    root.style.setProperty("--primary-bgc", "#222"); //深色模式背景顏色
    root.style.setProperty("--secondary-bgc", "#111"); //深色模式navbar背景顏色
    root.style.setProperty("--card-hover", "#333"); //深色模式滑鼠移置卡片時背景顏色
	//root.style.setProperty("--notification-h1", "#ffbb0080");
    root.style.setProperty("--nottification-bg", "#333");
    root.style.setProperty("--user-bg", "#333");
    root.style.setProperty("--userinfo-txt", "#fff");
    root.style.setProperty("--border-clr", "#454545");
	
	moon.classList.remove("fa-moon");
    moon.classList.add("fa-sun"); //移除月亮標誌，改為太陽
    switchButton.checked = true; //確認有勾選(深色模式)
  } 
  else {
    document.body.classList.add("light");
    root.style.setProperty("--primary-txt", "#555");
    root.style.setProperty("--primary-bgc", "#f0f0f0");
    root.style.setProperty("--secondary-bgc", "#fff");
    root.style.setProperty("--card-hover", "#ffeeee");
	  root.style.setProperty("--notification-h1", "linear-gradient(90deg,rgba(205, 255, 237, 0.9) 0%,rgba(0, 172, 255, 0.9) 100%");
	  root.style.setProperty("--nottification-bg", "rgba(255, 255, 255, 0.8)");
	  root.style.setProperty("--user-bg", "rgba(255, 255, 255, 0.8)");
	  root.style.setProperty("--userinfo-txt", "#4876FF");
	  root.style.setProperty("--border-clr", "#e5e5e5");
	 
    moon.classList.remove("fa-sun");
    moon.classList.add("fa-moon");
    switchButton.checked = false; //確認未勾選(淺色模式)
  }

  // 監聽切換按鈕
  switchButton.addEventListener("change", (e) => {
    if (e.target.checked) {
      document.body.classList.remove("light");
      document.body.classList.add("dark");
      localStorage.setItem("theme", "dark"); // 儲存至localStorage
      root.style.setProperty("--primary-txt", "#fff");
      root.style.setProperty("--primary-bgc", "#222");
      root.style.setProperty("--secondary-bgc", "#111");
      root.style.setProperty("--card-hover", "#333");
	  //root.style.setProperty("--notification-h1", "#ffbb0080");
      root.style.setProperty("--nottification-bg", "#333");
	  root.style.setProperty("--userinfo-txt", "#fff");
	  root.style.setProperty("--border-clr", "#454545");
      moon.classList.remove("fa-moon");
      moon.classList.add("fa-sun");
    }
     else {
      document.body.classList.remove("dark");
      document.body.classList.add("light");
      localStorage.setItem("theme", "light");
      root.style.setProperty("--primary-txt", "#555");
      root.style.setProperty("--primary-bgc", "#f0f0f0");
      root.style.setProperty("--secondary-bgc", "#fff");
      root.style.setProperty("--card-hover", "#ffeeee");
	    root.style.setProperty("--notification-h1", "linear-gradient(90deg,rgba(205, 255, 237, 0.9) 0%,rgba(0, 172, 255, 0.9) 100%");
	    root.style.setProperty("--nottification-bg", "rgba(255, 255, 255, 0.8)");
	    root.style.setProperty("--userinfo-txt", "#4876FF");
	    root.style.setProperty("--border-clr", "#e5e5e5");
      moon.classList.remove("fa-sun");
      moon.classList.add("fa-moon");
    }
  });
});

// //切換按鈕
// const switchButton = document.getElementById("themeSwitch");
// const root = document.documentElement;

// // 取得儲存在 localStorage 的模式
// const savedMode = localStorage.getItem("theme");
// // 如果有儲存模式，則應用到 body
// if (savedMode) {
//   document.body.classList.add(savedMode);
// } else {
//   // 預設為淺色模式
//   document.body.classList.add("light");
// }

// let moon = document.querySelector(".theme i");

// switchButton.addEventListener("change", (e) => {
//   if (e.target.checked && document.body.classList.contains("light")) {
//     document.body.classList.remove("light");
//     document.body.classList.add("dark");
//     localStorage.setItem("theme", "dark"); // 儲存到 localStorage
//     root.style.setProperty("--primary-txt", "#fff"); // 深色模式文字顏色
//     root.style.setProperty("--primary-bgc", "#222"); // 深色模式navbar背景顏色
//     root.style.setProperty("--secondary-bgc", "#111"); //
//     root.style.setProperty("--card-hover", "#333"); //
//     moon.classList.remove("fa-moon");
//     moon.classList.add("fa-sun");
//   } else {
//     document.body.classList.remove("dark");
//     document.body.classList.add("light");
//     localStorage.setItem("theme", "light"); // 儲存到 localStorage
//     root.style.setProperty("--primary-txt", "#555"); // 淺色模式文字顏色
//     root.style.setProperty("--primary-bgc", "#f0f0f0"); // 淺色模式nav背景顏色
//     root.style.setProperty("--secondary-bgc", "#fff"); //
//     root.style.setProperty("--card-hover", "#ffeeee"); //
//     moon.classList.remove("fa-sun");
//     moon.classList.add("fa-moon");
//   }
// });
