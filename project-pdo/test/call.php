<link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css' rel='stylesheet'>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js'></script>
<?php
function showToast($title, $icon = 'success', $redirect = '') {
    return <<<SCRIPT
	<script>
			const Toast = Swal.mixin({
				toast: true,
				position: 'top',
				iconColor: 'green',
				background: 'white',
				customClass: {
					popup: 'colored-toast'
				},
				showConfirmButton: false,
				timerProgressBar: true,
				timer: 2000
			});

			(async () => {
				await Toast.fire({
					title: '$title',
					icon: '$icon'
				}).then(() => {
					if ('$redirect' !== '') {
						window.location.href = '$redirect';
					}
				});
			})();
			</script>
		SCRIPT;
}

// 使用範例：
echo showToast('登出成功！', 'success', '/');
?>