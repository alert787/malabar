<?php
session_start();
require "config.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>MALABAR OUTDOOR | LOGIN</title>
  <link rel="icon" href="images/iconw.png" type="image/png">

	<script type="text/javascript" src="user/js/sweetalert.min.js"></script>
	<style type="text/css">
		body {
			background-image: url("images/img0004.jpg"); 
			background-size: cover;
			background-attachment: fixed;
			font-family: "Segoe UI", Sans-serif;
		}

		a {text-decoration: none;}

		.container {
			margin-top: 5%;
			width: 40%;
			padding-top: 35px;
			padding-bottom: 35px;
			background-color: rgba(255,255,255,0.7);
			border : 2px solid white;
		}
		input[type=text],input[type=password] {
			width: 80%;
			border : 2px solid #2c3e50;
			background-color: rgba(0,0,0,0);
			font-size: 18px;
			padding: 10px;
		}

		hr {
			width: 80%;
			border : 1px solid #7f8c8d;
		}

		.masuk {
			width: 100%;
			background-color: #3498db;
			color: white;
			font-size: 18px;
			padding: 10px;
			border : none;
		}

		.regis {
			width: 80%;
			background-color: #34495e;
			color: white;
			font-size: 18px;
			border : none;
			padding: 10px;
		}

		.masuk:hover, .regis:hover {
			background-color: #f1c40f;
		}
	</style>
</head>
<body>
	<center>
		<div class="container">
			<img src="images/icon.png" width="25%"><br><br>
			<h3>Register</h3>
			<form method="post">
				<input type="text" name="email" placeholder="Email...."><br><br>
				<input type="password" name="password" placeholder="Password...."><br><br>
				<input type="password" name="pass_komfrim" placeholder="Konfirmasi Password...."><br><br>
				<input type="text" name="nama" placeholder="Nama...."><br><br>
				<input type="text" name="telp" placeholder="Nomor HP...."><br><br>
				<input type="text" name="alamat" placeholder="Alamat...."><br><br>

				<br>
				<button name="daftar" class="regis">Daftar</button>
			</form>	
		</div>
	</center>
	<?php

	if(isset($_POST["daftar"]))
	{
		$nama = $_POST["nama"];
		$email = $_POST["email"];
		$pass = $_POST["password"];
		$pass_komfrim = $_POST["pass_komfrim"];
		$telp = $_POST["telp"];
		$alamat = $_POST["alamat"];
		$ambil = mysqli_query($koneksi,"select * from user where Email='$email'");

		if((empty($_POST['nama'])) or (empty($_POST['email'])) or (empty($_POST['password'])) or (empty($_POST['telp'])) or (empty($_POST['alamat'])))
		{
			echo '<script>
			swal({
				title: "Oops..",
				text: "Isi data dengan lengkap",
				icon: "error",
			});</script>';


		}
		else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			echo '<script>
			swal({
				title: "Oops..",
				text: "Email harus menyertakan @ dan nama domain",
				icon: "error",
			});</script>';

		}
		else if(strlen($pass) < 8){
			echo '<script>
			swal({
				title: "Oops..",
				text: "Password tidak boleh kurang dari 8 karakter",
				icon: "error",
			});</script>';
		}	
		else if($pass != $pass_komfrim){
			echo '<script>
			swal({
				title: "Oops..",
				text: "Konfirmasi Password tidak sama",
				icon: "error",
			});</script>';
		}
		else if(!is_numeric($telp)) {
			echo '<script>
			swal({
				title: "Oops..",
				text: "Nomor telepon harus berupa angka",
				icon: "error",
			});</script>';

		}
		else if($ambil)
		{
			$pecah = mysqli_num_rows($ambil);
			if($pecah==1)
			{
				echo '<script>
				swal({
					title: "Oops..",
					text: "Email sudah dipakai",
					icon: "error",
				});</script>';
			}


			else
			{
				$ambil=mysqli_query($koneksi,"insert into user (namaUser,Email,Password,Alamat,Telp,role)
					values ('$nama','$email','$pass','$alamat','$telp','pelanggan')");
				echo '<script>
				swal({
					title: "Berhasil!",
					text: "Akun Telah berhasil dibuat, silahkan login",
					icon: "success",
				}).then((value) => {
					window.location = "login.php";
				});</script>';
			}
		}

	}
	?>
</body>
</html>