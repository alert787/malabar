<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<script type="text/javascript" src="js/sweetalert.min.js"></script>
<body>
	<?php
	session_start();
	require "../config.php";
	$id_produk = $_GET['id'];
	$status = $_GET['status'];
	$brg = mysqli_query($koneksi,"SELECT stockBrg from barang where idBrg = '$_GET[id]'");
	$barang = mysqli_fetch_assoc($brg);

	if ($status == 'Beli') {
		if(isset($_SESSION['keranjang']['Beli'][$id_produk]))
		{
			if ($_SESSION["keranjang"]['Beli'][$id_produk] >= $barang['stockBrg']) {
				echo '<script>
				swal({
					title: "Oops!",
					text: "Barang yang dipesan melebihi stok yang ada",
					icon: "error",
				}).then((value) => {
					window.location = "product.php";
				});</script>';
			}
			else
			{
				$_SESSION['keranjang']['Beli'][$id_produk]+=1;
				echo '<script>
				swal({
					title: "Berhasil!",
					text: "Barang yang dipesan telah dimasukkan ke keranjang",
					icon: "success",
				}).then((value) => {
					window.location = "product.php";
				});</script>';
			}
		}

		else
		{
			$_SESSION['keranjang']['Beli'][$id_produk] =1;
			echo '<script>
			swal({
				title: "Berhasil!",
				text: "Barang yang dipesan telah dimasukkan ke keranjang",
				icon: "success",
			}).then((value) => {
				window.location = "product.php";
			});</script>';
		}
	}
	else{
		if(isset($_SESSION['keranjang']['Sewa'][$id_produk]))
		{
			if ($_SESSION["keranjang"]['Sewa'][$id_produk] >= $barang['stockBrg']) {
				echo '<script>
				swal({
					title: "Oops!",
					text: "Barang yang dipesan melebihi stok yang ada",
					icon: "error",
				}).then((value) => {
					window.location = "product.php";
				});</script>';
			}
			else{
				$_SESSION['keranjang']['Sewa'][$id_produk]+=1;
				echo '<script>
				swal({
					title: "Berhasil!",
					text: "Barang yang dipesan telah dimasukkan ke keranjang",
					icon: "success",
				}).then((value) => {
					window.location = "product.php";
				});</script>';
			}
		}

		else
		{
			$_SESSION['keranjang']['Sewa'][$id_produk] =1;
			$_SESSION['keranjang']['lama'][$id_produk] =1;
			echo '<script>
			swal({
				title: "Berhasil!",
				text: "Barang yang dipesan telah dimasukkan ke keranjang",
				icon: "success",
			}).then((value) => {
				window.location = "product.php";
			});</script>';
		}
	}

	?>
</body>
</html>

