<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<script type="text/javascript" src="js/sweetalert.min.js"></script>

	<?php
	if ($_GET['id'] == 1) {
		echo '<script>
		swal({
			title: "Oops!",
			text: "Anda harus login terlebih dahulu",
			icon: "error",
		}).then((value) => {
			window.location = "../login.php";
		});</script>';
	}
	elseif ($_GET['id'] == 2) {
		echo '<script>
		swal({
			title: "Oops!",
			text: "Anda tidak boleh mengakses halaman ini",
			icon: "error",
		}).then((value) => {
			window.location = "product.php";
		});</script>';
	}
	elseif ($_GET['id'] == 3) {
		echo '<script>
		swal({
			title: "Oops!",
			text: "Anda tidak boleh mengakses halaman ini",
			icon: "error",
		}).then((value) => {
			window.location = "product.php";
		});</script>';
	}
	elseif ($_GET['id'] == 4) {
		echo '<script>swal({
			title: "Silahkan pilih barang terlebih dahulu",
			icon: "warning",
		}).then((value) => {
			window.location = "product.php";
		});</script>';
	}

	elseif ($_GET['id'] == 5) {
		echo '<script>swal({
			title: "Oops!",
			text: "Silahkan pilih tipe Pembayaran Penyewaan dahulu",
			icon: "warning",
		}).then((value) => {
			window.location = "checkout.php";
		});</script>';
	}
	
	?>

</body>
</html>