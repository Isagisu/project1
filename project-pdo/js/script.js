// document.getElementById("loginForm").addEventListener("submit", function (e) {
//   e.preventDefault();
//   const username = e.target.username.value;
//   const password = e.target.password.value;
//   const rememberMe = e.target.rememberMe.checked;

//   if (rememberMe) {
//     localStorage.setItem("username", username);
//   } else {
//     localStorage.removeItem("username");
//   }

//   // 發送登入請求到後端
//   login(username, password);
// });
// // 預填帳號資訊
// document.addEventListener("DOMContentLoaded", () => {
//   const savedUsername = localStorage.getItem("username");
//   if (savedUsername) {
//     document.querySelector('input[name="username"]').value = savedUsername;
//     document.querySelector('input[name="rememberMe"]').checked = true;
//   }
// });

// 測試
// let sidebarItem = document.querySelectorAll('.sidebar-wrap a');

// sidebarItem.forEach(items => {
//   items.addEventListener('mouseover', function() {
//     items.style.fontWeight = 'bold';
//     link.style.transition = 'color 0.3s ease';
//   });
// });

// sidebarItem.forEach(items => {
//   items.addEventListener('mouseleave', function() {
//     items.style.fontWeight = '';
//     link.style.transition = '';
//   });
// });

// 當用戶從網頁頂部向下滾動 20px 時，則會顯示按鈕
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  //定義往上按鈕
  var mybutton = document.getElementById("GoTop");
  var topnav=document.getElementsByClassName("topnav")[0];
  
  //回到最上面按鈕
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20)
  {
    mybutton.style.display = "block";
	mybutton.classList.add("gotopSideL");
	mybutton.classList.remove("gotopSideR");
  }
  else
  {
    mybutton.classList.remove("gotopSideL");
    mybutton.classList.add("gotopSideR");
	
	// 監聽動畫結束事件
    mybutton.addEventListener('animationend', function handleAnimationEnd(event) {
      if (event.animationName === 'topbtnright') {
        mybutton.style.display = "none";             // 動畫結束後隱藏按鈕
        mybutton.removeEventListener('animationend', handleAnimationEnd);  // 移除事件監聽
      }
    });
  }
  
   if (window.innerWidth <= 768) 
   {
		//捲動時隱藏導覽列
		if (document.body.scrollTop > 320 || document.documentElement.scrollTop > 320) 
		{
		    topnav.classList.add("topnavhide");
			topnav.classList.remove("topnavshow");
		}
		else 
		{
		    topnav.classList.remove("topnavhide");
		    topnav.classList.add("topnavshow");
		}
   }
   else
   {
	  topnav.classList.remove("topnavhide");   
	  topnav.classList.remove("topnavshow");   
   }
}

// 當用戶點擊按鈕時，滾動到網頁頂部
function topFunction() {
  window.scrollTo({
	  top: 0,
	  behavior: 'smooth'
	});
}

// document.getElementById("loginForm").addEventListener("submit", function (e) {
//   e.preventDefault();
//   const username = e.target.username.value;
//   const password = e.target.password.value;
//   const rememberMe = e.target.rememberMe.checked;

//   if (rememberMe) {
//     localStorage.setItem("username", username);
//   } else {
//     localStorage.removeItem("username");
//   }

//   // 發送登入請求到後端
//   login(username, password);
// });
// // 預填帳號資訊
// document.addEventListener("DOMContentLoaded", () => {
//   const savedUsername = localStorage.getItem("username");
//   if (savedUsername) {
//     document.querySelector('input[name="username"]').value = savedUsername;
//     document.querySelector('input[name="rememberMe"]').checked = true;
//   }
// });

// 測試
// let sidebarItem = document.querySelectorAll('.sidebar-wrap a');

// sidebarItem.forEach(items => {
//   items.addEventListener('mouseover', function() {
//     items.style.fontWeight = 'bold';
//     link.style.transition = 'color 0.3s ease';
//   });
// });

// sidebarItem.forEach(items => {
//   items.addEventListener('mouseleave', function() {
//     items.style.fontWeight = '';
//     link.style.transition = '';
//   });
// });

//載入動畫
// window.addEventListener('load', function() {
    // var loader = document.getElementById('loading');

    // loader.style.transition = 'opacity 1s';
    // loader.style.opacity = '0';

    // setTimeout(function() {
        // loader.style.display = 'none';  
    // }, 1000); // 與 transition 時間一致
// });

function agreeAccept() 
{
	 var checkBox = document.getElementById("agree");	
	 if (checkBox.checked == true){
		(async () => {
		  const { value: accept } = await Swal.fire({
			title: "論壇規則與條款",
			input: "checkbox",
			inputValue: 0,
			inputPlaceholder: `
			  我已詳細閱讀並同意論壇的規則與條款
			`,
			confirmButtonText: `
			  同意&nbsp;<i class="fa fa-arrow-right"></i>
			`,
			inputValidator: (result) => {
			  return !result && "請閱讀並同意論壇的規則與條款";
			}
		  });
		  // if (accept) {
			      // Swal.fire({
				  // title: "感謝您同意論壇規則！😊",
				  // icon: "success",
				  // confirmButtonText: "繼續"
				// });
		  // }
		})()
	 }
}
function agreelist() 
{
	Swal.fire({
	  html:
		"<div style='text-align: center; font-family: Arial, sans-serif; padding: 20px;'>" +
		"<div style='font-size: 48px; color: #6a5acd; margin-bottom: 10px;'>📜</div>" +
		"<h2>請遵守以下規則</h2>" +
		"<ol style='text-align: left; max-width: 400px; margin: 0 auto; font-size: 16px; line-height: 1.8;'>" +
		"    <li>尊重其他會員，不得發表冒犯或侮辱性言論。</li>" +
		"    <li>禁止發布任何形式的垃圾廣告或違法內容。</li>" +
		"    <li>請確保您的文章與論壇主題相關。</li>" +
		"    <li>禁止未經授權的版權內容分享。</li>" +
		"    <li>管理員保留刪除違規內容的權利。</li>" +
		"</ol>" +
		"</div>",
	  cancelButtonText: "關閉",
	  willOpen: () => {
		document.body.style.overflow = 'hidden'; // 禁用滾動
		document.body.style.paddingRight = '0px'; // 防止捲動條寬度影響
	  },
	  showConfirmButton: false,
	   showCancelButton: true,
	   backdrop: `
    rgba(0,0,0,0.4)
    left top
    no-repeat
  `
	});
}