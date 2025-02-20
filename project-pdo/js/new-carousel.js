const slider = document.querySelector(".slider"), // 處理 slider 區塊的游標事件觸發時，定時器的狀態
	    dots = document.querySelectorAll(".slider .dots li"), // 處理圓點時用到
	    img  = document.querySelector(".slider-list img"), // 切換圖片的屬性時用到
	    prev = document.getElementById("prev"), // 取得 id="prev" 目標 (按鈕)
	    next = document.getElementById("next"); // 取得 id="next" 目標 (按鈕)
// url 用來切換 img 標籤內 src 的屬性，
// title 則是 alt 屬性。
fetch('../functions/banner.php')
  .then(response => response.json())  // 解析 JSON 格式的資料
  .then(data => {
// 將接收到的資料賦值給 sliderData
const sliderData = data; 

// 初始化圖片輪播
let i = 0;

const next = document.getElementById("next");
const prev = document.getElementById("prev");
const img = document.querySelector(".slider-list img");

//當有找到按鈕時執行以下程式
if (next && prev)
{
	// 切換圖片的函式
	function toggle() {
	  img.src = sliderData[i].url;
	  img.alt = sliderData[i].title;
	}

	// next 按鈕點擊事件
	next.addEventListener("click", function () {
	  // 計數 + 1
	  i++;
	  // 若成立 -> i >= sliderData 陣列長度，i = 0 ( 切回第一張圖片 )；
	  // 若不成立 -> i = i ( 切到下一張圖，i++ 已經先 + 過 1 )。
	  i = i >= sliderData.length ? 0 : i;
	  toggle();
	});

	// prev 按鈕點擊事件
	prev.addEventListener("click", function () {
	  // 減少計數
	  i--;

	  // 若 i 小於 0，將其重置為最後一張圖片的索引
	  if (i < 0) {
		i = sliderData.length - 1; // 陣列最後一張的索引
	  }

	  // 切換圖片邏輯
	  toggle();
	});

	// // 定時器　｜　setInterval(function, milliseconds)：
	//      　｜　每 6000 milliseconds(毫秒) 執行一次 next.click() 點擊事件。
	let refreshSlider = setInterval( () => { next.click() }, 6000 );

	// 切換圖片的函式，需要切換到圖片時，都會被呼喚。
	function toggle() {
	  // 切換 .slider-list img 內 src、alt 屬性。
	  img.src = sliderData[i].url;
	  img.alt = sliderData[i].title;
	  // 確保每次切換都能重新觸發動畫
	  img.classList.remove("slider_ani"); // 先移除動畫類名（如果有的話）
	  void img.offsetWidth; // 觸發重繪（強制刷新 DOM，讓動畫重新觸發）
	  img.classList.add("slider_ani"); // 再次添加動畫類名
	  // 定義 lastActiveDot 變數取得 <li class="active">。
	  let lastActiveDot = document.querySelector(".slider .dots li.active");

	  lastActiveDot.classList.remove("active"); // 將 lastActiveDot 變數的 active 移除。
	  dots[i].classList.add("active"); // 將下方圓點切換成 active 的樣式。

	  clearInterval(refreshSlider); // clearInterval() 清除 refreshSlider 定時器
	  refreshSlider = setInterval(() => {
		next.click();
	  }, 6000); // 再重新定義一次定時器。
	  // 目的是讓定時器歸零，避免點擊按鈕時還會一直自動滑動。
	}
	 // 初始化圖片，顯示第一張
	  toggle();
	// 將所有圓點 (li) 都加入能監聽 click 的點擊事件，將點擊到的目標的 key (index 索引) 傳給 i 去計數。
	dots.forEach((li, key) => {
	  li.addEventListener("click", function () {
		i = key;
		toggle();
	  });
	});

	// 只要游標 (mouse) 進入 (enter) slider 區塊，停止定時器。
	slider.addEventListener("mouseenter", function () {
	  clearInterval(refreshSlider);
	});

	// 只要游標 (mouse) 離開 (leave) slider 區塊，再次定義定時器。
	slider.addEventListener("mouseenter", function () {
	  refreshSlider = setInterval(() => {
		next.click();
	  }, 6000);
	});
}
});

