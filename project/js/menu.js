const menu = document.getElementById("popular-article");

let isDragging = false,
  startX = 0,
  scrollStart = 0;

// 共用函式：設定游標樣式
const setCursor = (style) => {
  menu.style.cursor = style;
};

// 滑鼠按下事件
menu.addEventListener("mousedown", (e) => {
  isDragging = true;
  startX = e.pageX - menu.offsetLeft; // 記錄起始位置
  scrollStart = menu.scrollLeft; // 記錄當前滾動位置
  setCursor("grabbing"); // 設定游標為抓取中
});

// 滑鼠移動事件
menu.addEventListener("mousemove", (e) => {
  if (!isDragging) return;

  const x = e.pageX - menu.offsetLeft; // 計算當前滑鼠位置
  const walk = (x - startX) * 2; // 計算滾動距離
  menu.scrollLeft = scrollStart - walk; // 更新滾動位置
});

// 滑鼠釋放與滑出事件
const stopDragging = () => {
  isDragging = false;
  setCursor("grab"); // 恢復游標樣式
};

menu.addEventListener("mouseup", stopDragging);
menu.addEventListener("mouseleave", stopDragging);
