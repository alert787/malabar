<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<script type="text/javascript" src="user/js/sweetalert.min.js"></script>

	<?php
	session_start();

	session_destroy();
	echo '<script>swal({
		title: "Anda telah Logout",
		icon: "success",
	}).then((value) => {
		(location.href="index.php");
	});</script>';


	?>
</body>
</html>
