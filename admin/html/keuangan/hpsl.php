<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="../../../user/js/sweetalert.min.js"></script>

	<title></title>
</head>
<body>
<?php
session_start();
include "../../../config.php";
ini_set('display_errors', 1);


$id = $_GET['id'];

$res = mysqli_query($koneksi, "DELETE FROM `laporan` WHERE `laporan`.`fileLaporan` ='".$id."'");
unlink("../../file/".$id);
echo '<script>
	swal({
		title: "Berhasil!",
		icon: "success",
	}).then((value) => {
		window.location = "laporan.php";
	});</script>';
?>
</body>
</html>