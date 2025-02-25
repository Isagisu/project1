document.addEventListener("DOMContentLoaded", () => {
  const switchButton = document.getElementById("themeSwitch");
  const root = document.documentElement;
  const savedMode = localStorage.getItem("theme"); //取出儲存資料
  let moon = document.querySelector(".theme i"); //設定按紐圖案的變數

  // 主題顏色 //

  // 藍色科技風（Blue Tech Theme) 🤖
  function setBlueTechTheme() {
    root.style.setProperty("--primary-txt", "#d0e2ff");
    root.style.setProperty("--primary-bgc", "#0a0f24");
    root.style.setProperty("--secondary-bgc", "#131a36");
    root.style.setProperty("--card-hover", "#1e2b50");
    root.style.setProperty("--nottification-bg", "#1a233a");
    root.style.setProperty("--border-clr", "#2d3b5e");
    root.style.setProperty(
      "--notification-h1",
      "linear-gradient(90deg, #0099ff, #00eaff)"
    );
  }

  // 霓虹紫幻風（Neon Purple）🔮🌌
  function setNeonPurpleTheme() {
    root.style.setProperty("--primary-txt", "#ffccff");
    root.style.setProperty("--primary-bgc", "#25002e");
    root.style.setProperty("--secondary-bgc", "#330040");
    root.style.setProperty("--card-hover", "#550066");
    root.style.setProperty("--nottification-bg", "#440055");
    root.style.setProperty("--border-clr", "#660099");
    root.style.setProperty(
      "--notification-h1",
      "linear-gradient(90deg, #ff00ff, #cc00ff)"
    );
  }

  // 黑金奢華風（Black & Gold）🖤✨
  function setBlackGoldTheme() {
    root.style.setProperty("--primary-txt", "#ffcc66");
    root.style.setProperty("--primary-bgc", "#121212");
    root.style.setProperty("--secondary-bgc", "#1a1a1a");
    root.style.setProperty("--card-hover", "#333333");
    root.style.setProperty("--nottification-bg", "#222222");
    root.style.setProperty("--border-clr", "#444444");
    root.style.setProperty(
      "--notification-h1",
      "linear-gradient(90deg, #ffcc00, #ff9900)"
    );
  }

  // 森林自然風（Forest Green） 🌿🌲
  function setForestGreenTheme() {
    root.style.setProperty("--primary-txt", "#cce6cc");
    root.style.setProperty("--primary-bgc", "#0a2910");
    root.style.setProperty("--secondary-bgc", "#133a20");
    root.style.setProperty("--card-hover", "#1e4d30");
    root.style.setProperty("--nottification-bg", "#1a3f28");
    root.style.setProperty("--border-clr", "#2d5a40");
    root.style.setProperty(
      "--notification-h1",
      "linear-gradient(90deg, #66cc66, #33aa33)"
    );
  }

  // 夕陽暖橘風（Sunset Orange） 🌇🌞
  function setSunsetOrangeTheme() {
    root.style.setProperty("--primary-txt", "#ffebcc");
    root.style.setProperty("--primary-bgc", "#331400");
    root.style.setProperty("--secondary-bgc", "#552200");
    root.style.setProperty("--card-hover", "#773300");
    root.style.setProperty("--nottification-bg", "#662a00");
    root.style.setProperty("--border-clr", "#994d00");
    root.style.setProperty(
      "--notification-h1",
      "linear-gradient(90deg, #ff6600, #ffcc00)"
    );
  }

  // 極簡白（Minimal White） 🤍🕊
  function setMinimalWhiteTheme() {
    root.style.setProperty("--primary-txt", "#333");
    root.style.setProperty("--primary-bgc", "#ffffff");
    root.style.setProperty("--secondary-bgc", "#f7f7f7");
    root.style.setProperty("--card-hover", "#e6e6e6");
    root.style.setProperty("--nottification-bg", "#eeeeee");
    root.style.setProperty("--border-clr", "#dddddd");
    root.style.setProperty(
      "--notification-h1",
      "linear-gradient(90deg, #cccccc, #aaaaaa)"
    );
  }

  // 天空藍（Sky Blue） ☁️💙
  function setSkyBlueTheme() {
    root.style.setProperty("--primary-txt", "#004488");
    root.style.setProperty("--primary-bgc", "#e0f7ff");
    root.style.setProperty("--secondary-bgc", "#cceeff");
    root.style.setProperty("--card-hover", "#99ddff");
    root.style.setProperty("--nottification-bg", "#b3e0ff");
    root.style.setProperty("--border-clr", "#88ccff");
    root.style.setProperty(
      "--notification-h1",
      "linear-gradient(90deg, #66bbff, #0099ff)"
    );
  }

  // 溫暖奶茶（Warm Beige） 🧋☕
  function setWarmBeigeTheme() {
    root.style.setProperty("--primary-txt", "#5a4636");
    root.style.setProperty("--primary-bgc", "#f5e6d7");
    root.style.setProperty("--secondary-bgc", "#e8d3b8");
    root.style.setProperty("--card-hover", "#d4b899");
    root.style.setProperty("--nottification-bg", "#c7a883");
    root.style.setProperty("--border-clr", "#b28e6d");
    root.style.setProperty(
      "--notification-h1",
      "linear-gradient(90deg, #e6c29f, #c99c71)"
    );
  }

  // 春日粉嫩（Pastel Pink） 🌸💖
  function setPastelPinkTheme() {
    root.style.setProperty("--primary-txt", "#aa3366");
    root.style.setProperty("--primary-bgc", "#ffe6f0");
    root.style.setProperty("--secondary-bgc", "#ffccdd");
    root.style.setProperty("--card-hover", "#ff99bb");
    root.style.setProperty("--nottification-bg", "#ffb3cc");
    root.style.setProperty("--border-clr", "#ff80aa");
    root.style.setProperty(
      "--notification-h1",
      "linear-gradient(90deg, #ff6699, #ff3366)"
    );
  }

  // 晨曦橙光（Sunrise Peach） 🌅🍑
  function setSunrisePeachTheme() {
    root.style.setProperty("--primary-txt", "#995522");
    root.style.setProperty("--primary-bgc", "#fff5e6");
    root.style.setProperty("--secondary-bgc", "#ffe0b3");
    root.style.setProperty("--card-hover", "#ffcc80");
    root.style.setProperty("--nottification-bg", "#ffb366");
    root.style.setProperty("--border-clr", "#e6994d");
    root.style.setProperty(
      "--notification-h1",
      "linear-gradient(90deg, #ff9966, #ff6600)"
    );
  }
  //
  function setIsagiTheme() {
    root.style.setProperty("--primary-txt", "#555");
    root.style.setProperty("--primary-bgc", "#dae0dd");
    root.style.setProperty("--secondary-bgc", "#fffdf5");
    root.style.setProperty("--card-hover", "#c5d4dd");
    root.style.setProperty("--nottification-bg", "#afc0d4");
    root.style.setProperty("--border-clr", "#bbd0dc");
    root.style.setProperty(
      "--notification-h1",
      "linear-gradient(90deg,rgb(102, 181, 218),rgb(78, 127, 231))"
    );
  }
  //預設淺色模式
  function setLightTheme() {
    root.style.setProperty("--primary-txt", "#555");
    root.style.setProperty("--primary-bgc", "#f0f0f0");
    root.style.setProperty("--secondary-bgc", "#fff");
    root.style.setProperty("--card-hover", "#ffeeee");
    root.style.setProperty(
      "--notification-h1",
      "linear-gradient(90deg,rgba(205, 255, 237, 0.9) 0%,rgba(0, 172, 255, 0.9) 100%"
    );
    root.style.setProperty("--nottification-bg", "rgba(255, 255, 255, 0.8)");
    root.style.setProperty("--user-bg", "rgba(255, 255, 255, 0.8)");
    root.style.setProperty("--userinfo-txt", "#4876FF");
    root.style.setProperty("--border-clr", "#e5e5e5");
  }

  //預設深色模式
  function setDarkTheme() {
    root.style.setProperty("--primary-txt", "#fff"); //深色模式文字顏色
    root.style.setProperty("--primary-bgc", "#222"); //深色模式背景顏色
    root.style.setProperty("--secondary-bgc", "#111"); //深色模式navbar背景顏色
    root.style.setProperty("--card-hover", "#333"); //深色模式滑鼠移置卡片時背景顏色
    //root.style.setProperty("--notification-h1", "#ffbb0080");
    root.style.setProperty("--nottification-bg", "#333");
    root.style.setProperty("--user-bg", "#333");
    root.style.setProperty("--userinfo-txt", "#fff");
    root.style.setProperty("--border-clr", "#454545");
  }

  // 確認初始背景模式
  if (savedMode === "dark") {
    //=== 嚴格相等;需要資料類型和值都相等才算相等
    document.body.classList.add("dark");
    setDarkTheme(); // 使用主題顏色
    moon.classList.remove("fa-moon");
    moon.classList.add("fa-sun"); //移除月亮標誌，改為太陽
    switchButton.checked = true; //確認有勾選(深色模式)
  } else {
    document.body.classList.add("light");
    setIsagiTheme(); // 使用主題顏色
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
      setDarkTheme(); // 使用主題顏色
      moon.classList.remove("fa-moon");
      moon.classList.add("fa-sun");
    } else {
      document.body.classList.remove("dark");
      document.body.classList.add("light");
      localStorage.setItem("theme", "light");
      setIsagiTheme(); // 使用主題顏色
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
