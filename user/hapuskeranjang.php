<?php
session_start();

$id_produk = $_GET['id'];

if ($id_produk == 'semua') {
	unset($_SESSION["keranjang"]);	
}
else{
	$status=$_GET["status"];
	unset($_SESSION["keranjang"]["$status"][$id_produk]);
	unset($_SESSION["keranjang"]['lama'][$id_produk]);
}

?>