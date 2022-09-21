<?php
session_start();
require "config.php";

if (isset($_SESSION['user']))
{
	if ($_SESSION['user']['role'] == 'bagian keuangan') {
		echo '<script>window.location = "admin/html/keuangan/index.php";</script>';
	}
	if ($_SESSION['user']['role'] == 'pemilik toko') {
		echo '<script>window.location = "admin/html/admin/index.php";</script>';
	}
	if ($_SESSION['user']['role'] == 'pelanggan') {
		echo '<script>window.location = "index.php";</script>';
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>MALABAR OUTDOOR | LOGIN</title>
	<script type="text/javascript" src="user/js/sweetalert.min.js"></script>
	<link rel="icon" href="images/iconw.png" type="image/png">
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
			<h3>Login</h3>
			<form method="post">
				<input type="text" name="email" placeholder="Email...."><br><br>
				<input type="password" name="password" placeholder="Kata Sandi....">

				<br>
				<div style="width: 80%">
					<button class="masuk" name="login">Login</button><br>
				</div>
			</form>	
			<hr>
			<a href="register.php">
				<div class="regis">Daftar</div>
			</a>
		</div>
	</center>
	<?php
	if (isset($_POST["login"]))
	{
		$email = $_POST["email"];
		if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			echo '<script>
			swal({
				title: "Oops..",
				text: "Email harus menyertakan @ dan nama domain",
				icon: "error",
				})
				</script>';
				die;
			}

			$password = $_POST["password"];
			$ambil=mysqli_query($koneksi,"select * from user where Email='$email' and Password='$password'");

			if($ambil){
				$cocok=mysqli_num_rows($ambil);
				if($cocok)
				{
					$data = mysqli_fetch_array($ambil);
					$_SESSION['email']=$email;
					$_SESSION['user']=$data;

					if ($data['role'] == 'pelanggan') {
						header("location:user/product.php");
					}
					else if(isset($_SESSION["keranjang"]) or !empty($_SESSION["keranjang"]))
					{
						header("location:user/checkout.php");
					}
					elseif ($data['role'] == 'pemilik toko') {
						header("location:admin/html/owner/index.php");
					}
					elseif ($data['role'] == 'bagian keuangan') {
						header("location:admin/html/keuangan/index.php");
					}

				}
				else
				{
					echo '<script>
					swal({
						title: "Oops..",
						text: "Email atau Password Salah",
						icon: "error",
						})
						</script>';

					}
				}
				else
				{
					echo "Tidak ada user";
				}
			}
			?>
		</body>
		</html>

