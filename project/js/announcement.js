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
  xmlhttp.open("POST","News.php");
  xmlhttp.send();
}