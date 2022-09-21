<?php
session_start();
include "../config.php";
ini_set('display_errors', 1);

$id_produk = $_GET['id'];
$trf = mysqli_query($koneksi,"SELECT totalBayarJual,totalBayarSewa FROM `transaksi` WHERE `kdTransaksi` = '$id_produk'");
$transaksi = mysqli_fetch_assoc($trf);

if ($transaksi['totalBayarJual'] != 0) {

	$jual = mysqli_query($koneksi,"SELECT idBrg,jmlhBrg FROM `jual` WHERE `kdTransaksi` = '$id_produk'");
	while ($pecah = mysqli_fetch_assoc($jual)){
		$jumlah = $pecah['jmlhBrg'];
		$ambil=mysqli_query($koneksi,"update barang set stockBrg=stockBrg+$jumlah where idBrg='$pecah[idBrg]'");
	}
}

if ($transaksi['totalBayarSewa'] != 0) {

	$msewa = mysqli_query($koneksi,"SELECT kdSewa FROM `sewa` WHERE `kdTransaksi` = '$id_produk'");
	$ambil = mysqli_fetch_assoc($msewa);

	$sewa = mysqli_query($koneksi,"SELECT idBrg,jmlhBrg FROM `detailsewa` WHERE `kdSewa` = '$ambil[kdSewa]'");
	while ($pecah = mysqli_fetch_assoc($sewa)){
		$jumlah = $pecah['jmlhBrg'];
		$ambil=mysqli_query($koneksi,"update barang set stockBrg=stockBrg+$jumlah where idBrg='$pecah[idBrg]'");
	}
}

$transaksi = mysqli_query($koneksi,"DELETE FROM `transaksi` WHERE `transaksi`.`kdTransaksi` = '$id_produk'");
echo '<script type="text/javascript">window.location = "menungguUp.php"</script>';
?>

<!--


-->