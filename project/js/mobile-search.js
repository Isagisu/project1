document.addEventListener("DOMContentLoaded", function () {
  const searchButton = document.querySelector(".sm-search");
  const searchBox = document.querySelector(".mobile-search");
  const closeButton = document.querySelector(".close-search");

  // 點擊搜尋按鈕時顯示搜尋框
  searchButton.addEventListener("click", function () {
    searchBox.classList.toggle("active");
  });

  // 點擊關閉按鈕時隱藏搜尋框
  closeButton.addEventListener("click", function () {
    searchBox.classList.remove("active");
  });

  // 點擊畫面其他地方時也關閉搜尋框
  document.addEventListener("click", function (e) {
    if (
      !searchBox.contains(e.target) &&
      !searchButton.contains(e.target) &&
      (!prev || !prev.contains(e.target)) && // 檢查 prev 是否存在
      (!next || !next.contains(e.target))    // 檢查 next 是否存在
    ) {
      searchBox.classList.remove("active");
    }
  });
});
