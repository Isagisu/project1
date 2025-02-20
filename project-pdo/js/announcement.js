window.addEventListener("load", (event) =>  {
 announcement();
});

function announcement() {
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
	//判斷有撈到資料和成功發送請求
    if (this.readyState==4 && this.status==200) {
      document.getElementById("announcement").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("POST","../templates/News.php");
  xmlhttp.send();
}

//下一頁
function increment() {
    // 記住當前捲動位置
    var scrollPosition = window.scrollY || document.documentElement.scrollTop;

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../functions/increment.php?type=increment", true);
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {			  
		    //location.reload();  // 刷新頁面
			
            // 第一個請求成功後，繼續執行第二個請求
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", "../templates/News.php", true);
            
            // 設置 POST 請求的必要頭信息
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    // 將返回的數據填充到頁面指定區域
                    document.getElementById("announcement").innerHTML = xmlhttp.responseText;

                    // 恢復捲動位置
                    window.scrollTo(0, scrollPosition);
                }
            };
            xmlhttp.send("update=true");
        }
    };
    xhr.send();
}

//上一頁
function minus() {
    // 記住當前捲動位置
    var scrollPosition = window.scrollY || document.documentElement.scrollTop;	
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../functions/increment.php?type=minus", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
	  	    //location.reload();  // 刷新頁面
			
            // 第一個請求成功後，繼續執行第二個請求
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", "../templates/News.php", true);
            
            // 設置 POST 請求的必要頭信息
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    // 將返回的數據填充到頁面指定區域
                    document.getElementById("announcement").innerHTML = xmlhttp.responseText;
					 // 恢復捲動位置
					window.scrollTo(0, scrollPosition);
                }
            };
            // 發送 POST 請求時，如果需要傳遞數據，可以在 send() 內填寫
            xmlhttp.send("update=true");
			
           
        }
    };
    xhr.send();
}

//頁數跳轉
function alink(page) {
	  // 記住當前捲動位置
    var scrollPosition = window.scrollY || document.documentElement.scrollTop;	
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../functions/increment.php?type=alink&Page="+page, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
			//location.reload();  // 刷新頁面
			
            // 第一個請求成功後，繼續執行第二個請求
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", "../templates/News.php", true);
            
            // 設置 POST 請求的必要頭信息
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    // 將返回的數據填充到頁面指定區域
                    document.getElementById("announcement").innerHTML = xmlhttp.responseText;
					// 恢復捲動位置
					window.scrollTo(0, scrollPosition);
                }
            };
            // 發送 POST 請求時，如果需要傳遞數據，可以在 send() 內填寫
            xmlhttp.send("update=true");
			
    
        }
    };
    xhr.send();
}