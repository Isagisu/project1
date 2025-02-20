<?php
echo "<link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css' rel='stylesheet'>";
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js'></script>";
  echo <<<EOT
	&nbsp;
	<script>
		const Toast = Swal.mixin({
		  toast: true,
		  position: "top",
		  showConfirmButton: false,
		  timer: 3000,
		  timerProgressBar: true,
		  didOpen: (toast) => {
			toast.onmouseenter = Swal.stopTimer;
			toast.onmouseleave = Swal.resumeTimer;
		  }
		});
		Toast.fire({
		  icon: "success",
		  title: "發送信件成功"
		});
	</script>
	EOT;
?>