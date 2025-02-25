//防止點擊書籤時跳轉頁面
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".bookmark-icon").forEach((bookmark) => {
    bookmark.addEventListener("click", function (event) {
      event.stopPropagation(); // 阻止點擊書籤時冒泡到 <a>
      event.preventDefault(); // 防止 <a> 觸發跳轉
	  const categoryId = this.getAttribute('data-category-id'); // 使用 this 正確取得 category_id
      this.classList.toggle("fa-solid"); // 切換實心/空心圖標
      this.classList.toggle("fa-regular");
        fetch('toggle_favorite.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ category_id: categoryId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                icon.classList.toggle('fa-solid');
                icon.classList.toggle('fa-regular');
            } else {
                alert('操作失敗！');
            }
        })
        .catch(error => console.error('錯誤:', error));
    });
  });
});

