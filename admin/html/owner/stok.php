<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<script type="text/javascript" src="../../../user/js/sweetalert.min.js"></script>

	<?php
	if (!is_numeric($_GET['id'])) {
		echo '<script>
		swal({
			title: "Oops!",
			text: "Jumlah stok harus angka",
			icon: "error",
		}).then((value) => {
			window.location = "databarangjual.php";
		});</script>';
	}
	else
	{
		echo '<script>
		swal({
			title: "Oops!",
			text: "Anda harus login terlebih dahulu",
			icon: "error",
		}).then((value) => {
			window.location = "";
		});</script>';
	}
	?>

</body>
</html>