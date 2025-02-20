const menu = document.getElementById("popular-article-group");

let isDragging = false, // 是否正在拖動
  startX = 0, // 記錄起始 X 位置
  scrollStart = 0, // 記錄滾動開始時的位置
  dragDistance = 0; // 記錄拖動距離

// 共用函式：設定游標樣式
const setCursor = (style) => {
  menu.style.cursor = style;
};

// 滑鼠按下事件（開始拖動）
menu.addEventListener("mousedown", (e) => {
  isDragging = true; // 開始拖動
  startX = e.pageX; // 記錄起始位置
  scrollStart = menu.scrollLeft; // 記錄當前滾動位置
  dragDistance = 0; // 重置拖動距離
  setCursor("grabbing"); // 設定游標為抓取中
});

// 滑鼠移動事件（拖動過程）
menu.addEventListener("mousemove", (e) => {
  if (!isDragging) return; // 只有在拖動狀態下才處理

  const x = e.pageX;
  dragDistance = Math.abs(x - startX); // 計算拖動距離
  const walk = (x - startX) * 2; // 放大滾動距離
  menu.scrollLeft = scrollStart - walk; // 滾動內容
});

// 滑鼠釋放事件（結束拖動）
menu.addEventListener("mouseup", (e) => {
  if (dragDistance > 5) {
    e.preventDefault(); // 阻止 click 事件，避免误触
  }
  isDragging = false; // 停止拖動
  setCursor("grab"); // 恢復游標樣式
});

// 滑鼠滑出區域（防止拖動卡住）
menu.addEventListener("mouseleave", () => {
  isDragging = false;
  setCursor("grab");
});

// 點擊事件（如果剛剛拖動過，則阻止點擊）
menu.addEventListener("click", (e) => {
  if (dragDistance > 5) {
    e.preventDefault(); // 如果拖動距離過大，阻止點擊
    e.stopPropagation();
  }
});
