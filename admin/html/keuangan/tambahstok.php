<?php
session_start();
include "../../../config.php";
ini_set('display_errors', 1);

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
	<title>Admin | Tambah Stok</title>
	<!-- Custom CSS -->
	<link href="../../assets/libs/flot/css/float-chart.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="../../dist/css/style.min.css" rel="stylesheet">
	<script src="../../assets/libs/chart/chart.js"></script>
	<script type="text/javascript" src="../../../user/js/sweetalert.min.js"></script>

	<style type="text/css">
		body {height: 100%; background-color: #2a2b30;}
		.inblock {display: inline-block;}
		.tombol {
			padding-top: 10px; 
			padding-bottom: 10px; 
			padding-right: 20px; 
			padding-left: 20px; 
			font-size: 10; 
			background-color: rgba(241, 196, 15,1.0); 
			color: white; 
			border-radius: 3px;
		}
		.tombol:hover {background-color: #3498db; color: white;}

		input[type=text], textarea, select {
			padding : 10px; 
			background-color: rgba(0,0,0,0);
			color: white;
			border : 1px solid #ecf0f1;
			width: 100%;
		}

		option {
			color: black;
			padding : 10px;
			border : 1px solid #ecf0f1;
			width: 100%;
		}

		button {
			background-color: #3498db;
			color: white;
			padding: 6px;
			font-size: 12;
			border : none;
		}
		button:hover {
			background-color: #f1c40f;
		}
		table {
			border-collapse: collapse; 
			width: 70%; 
			text-align: justify; 
			color: white; 
			font-size: 14px; 
			line-height: 1.8;
		}

		td {padding-top: 10px; padding-bottom: 10px; vertical-align: top;}
		hr {border : 1px dashed rgba(236, 240, 241,0.5);}
	</style>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<style type="text/css">
		.inblock {display: inline-block;}
	</style>
	<![endif]-->
</head>

<body>
	<?php
	if (!isset($_SESSION['user']))
	{
		echo '<script>window.location = "../../../user/notuser.php?id=1";</script>';
	}
	if ($_SESSION['user']['role'] != 'bagian keuangan') {
		echo '<script>window.location = "../../../user/notuser.php?id=3";</script>';

	}
	?>
	<!-- ============================================================== -->
	<!-- Preloader - style you can find in spinners.css -->
	<!-- ============================================================== -->
	<div class="preloader">
		<div class="lds-ripple">
			<div class="lds-pos"></div>
			<div class="lds-pos"></div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- Main wrapper - style you can find in pages.scss -->
	<!-- ============================================================== -->
	<div id="main-wrapper">
		<!-- ============================================================== -->
		<!-- Topbar header - style you can find in pages.scss -->
		<!-- ============================================================== -->
		<header class="topbar" data-navbarbg="skin5">
			<nav class="navbar top-navbar navbar-expand-md navbar-dark">
				<div class="navbar-header" data-logobg="skin5">
					<!-- This is for the sidebar toggle which is visible on mobile only -->
					<a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
					<!-- ============================================================== -->
					<!-- Logo -->
					<!-- ============================================================== -->
					<a class="navbar-brand" href="index.php">
						<!-- Logo icon -->
						<b class="logo-icon p-l-10">
							<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
							<!-- Dark Logo icon -->
							<img src="../../assets/images/logo-icon.png" alt="homepage" class="light-logo" />

						</b>
						<!--End Logo icon -->
						<!-- Logo text -->
						<span class="logo-text">
							<!-- dark Logo text -->
							<img src="../../assets/images/logo-text.png" alt="homepage" class="light-logo" />

						</span>
						<!-- Logo icon -->
						<!-- <b class="logo-icon"> -->
						<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
						<!-- Dark Logo icon -->
						<!-- <img src="../../assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

						<!-- </b> -->
						<!--End Logo icon -->
					</a>
					<!-- ============================================================== -->
					<!-- End Logo -->
					<!-- ============================================================== -->
					<!-- ============================================================== -->
					<!-- Toggle which is visible on mobile only -->
					<!-- ============================================================== -->
					<a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
				</div>
				<!-- ============================================================== -->
				<!-- End Logo -->
				<!-- ============================================================== -->
				<div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
					<!-- ============================================================== -->
					<!-- toggle and nav items -->
					<!-- ============================================================== -->
					<ul class="navbar-nav float-left mr-auto">
						<li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
						<!-- ============================================================== -->
						<!-- Search -->
						<!-- ============================================================== -->
					</ul>
					<!-- ============================================================== -->
					<!-- Right side toggle and nav items -->
					<!-- ============================================================== -->
					<ul class="navbar-nav float-right">
						<!-- ============================================================== -->
						<!-- User profile and search -->
						<!-- ============================================================== -->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
							<div class="dropdown-menu dropdown-menu-right user-dd animated">
								<a class="dropdown-item" href="profil.php"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
								<a class="dropdown-item" href="akun.php"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                            <a class="dropdown-item" href="../../../logout.php"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
							</div>
						</li>
						<!-- ============================================================== -->
						<!-- User profile and search -->
						<!-- ============================================================== -->
					</ul>
				</div>
			</nav>
		</header>
		<!-- ============================================================== -->
		<!-- End Topbar header -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Left Sidebar - style you can find in sidebar.scss  -->
		<!-- ============================================================== -->
		<aside class="left-sidebar" data-sidebarbg="skin5">
			<!-- Sidebar scroll-->
			<div class="scroll-sidebar">
				<!-- Sidebar navigation-->
				<nav class="sidebar-nav">
					<ul id="sidebarnav" class="p-t-30">
						<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>

						<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-monitor"></i><span class="hide-menu">Keuangan </span></a>
							<ul aria-expanded="false" class="collapse  second-level">
								<li class="sidebar-item"><a  class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-arrow-bottom-left"></i><span class="hide-menu"> Pemasukan </span></a>
									<ul aria-expanded="false" class="collapse  first-level">
										<li class="sidebar-item"><a href="pemasukanjual.php" class="sidebar-link"><i class="mdi mdi-arrow-left-bold"></i><span class="hide-menu"> Penjualan </span></a></li>
										<li class="sidebar-item"><a href="pemasukansewa.php" class="sidebar-link"><i class="mdi mdi-arrow-left-bold"></i><span class="hide-menu"> Penyewaan </span></a></li>
									</ul>
								</li>
								<li class="sidebar-item"><a  class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-arrow-top-right"></i><span class="hide-menu"> Pengeluaran </span></a>
									<ul aria-expanded="false" class="collapse  first-level">
										<li class="sidebar-item"><a href="pengeluaran.php" class="sidebar-link"><i class="mdi mdi-arrow-right-bold"></i><span class="hide-menu"> Pembelian </span></a></li>
									</ul>
								</li>
							</ul>
						</li>

						<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Transaksi </span></a>
							<ul aria-expanded="false" class="collapse  first-level">
								<li class="sidebar-item"><a href="riwayat.php" class="sidebar-link"><i class="mdi mdi-bookmark-check"></i><span class="hide-menu"> Riwayat Transaksi </span></a></li>
							</ul>
						</li>

						<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-view-agenda"></i><span class="hide-menu">Inventory </span></a>
							<ul aria-expanded="false" class="collapse  first-level">
								<li class="sidebar-item"><a href="databarangjual.php" class="sidebar-link"><i class="mdi mdi-buffer"></i><span class="hide-menu"> Data Barang Dijual </span></a></li>
								<li class="sidebar-item"><a href="databarangsewa.php" class="sidebar-link"><i class="mdi mdi-buffer"></i><span class="hide-menu"> Data Barang Disewa </span></a></li>
							</ul>
						</li>

						<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">Testimoni </span></a>
							<ul aria-expanded="false" class="collapse  first-level">
								<li class="sidebar-item"><a href="listtestimoni.php" class="sidebar-link"><i class="mdi mdi-library-books"></i><span class="hide-menu"> Data Testimoni </span></a></li>
							</ul>
						</li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">Laporan </span></a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item"><a href="laporan.php" class="sidebar-link"><i class="mdi mdi-library-books"></i><span class="hide-menu"> Data Laporan </span></a></li>
                                </ul>
                            </li>
					</ul>
				</nav>
				<!-- End Sidebar navigation -->
			</div>
			<!-- End Sidebar scroll-->
		</aside>
		<!-- ============================================================== -->
		<!-- End Left Sidebar - style you can find in sidebar.scss  -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Page wrapper  -->
		<!-- ============================================================== -->
		<div class="page-wrapper" style="background-color: #2a2b30; color: rgba(236, 240, 241,1.0)">
			<!-- ============================================================== -->
			<!-- Bread crumb and right sidebar toggle -->
			<!-- ============================================================== -->
			<div class="page-breadcrumb">
				<div class="row">
					<div class="col-12 d-flex no-block align-items-center">
						<h4 class="page-title">Tambah Stok</h4>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- End Bread crumb and right sidebar toggle -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- Container fluid  -->
			<!-- ============================================================== -->
			<?php
			$brg = mysqli_query($koneksi,"SELECT namaBrg,hargaBrg FROM barang where idBrg = '$_GET[id]'");
			$barang = mysqli_fetch_assoc($brg);
			?>
			<div class="container-fluid">
				<br><br>
				<center>
					<form method="post" enctype="multipart/form-data">
						<table>
							<tr>
								<td>Nama Barang</td>
								<td>:</td>
								<td>
									<input type="text" name="namabrg" value="<?php echo $barang['namaBrg']; ?>" readonly>
								</td>
							</tr>

							<tr>
								<td>Harga Beli</td>
								<td>:</td>
								<td>
									<input type="text" name="hargabeli" placeholder="Harga Beli...">
								</td>
							</tr>

							<tr>
								<td>Jumlah</td>
								<td>:</td>
								<td>
									<input type="number" name="jumlah" min="1" placeholder="jumlah...">
								</td>
							</tr>

						</table>
						<br>
						<input type="text" name="harga" value="<?php echo $barang['hargaBrg']; ?>" hidden>
						<hr><br>

						<button class="tombol" name="tambah">Tambah Stok</button></form>
					</center>
					<br>
				</div>
				<?php
				if (isset($_POST['tambah'])) {


					$hargabeli = $_POST['hargabeli'];
					$jumlah = $_POST['jumlah'];
					$id = $_GET['id'];
					$harga = $_POST['harga'];

					if((empty($hargabeli)) or (empty($jumlah)))
					{
						echo '<script>
						swal({
							title: "Oops!",
							text: "Mohon isi data dengan lengkap",
							icon: "error",
						});</script>';
					}
					else if(!is_numeric($hargabeli)) {
						echo '<script>
						swal({
							title: "Oops!",
							text: "Harga Beli harus angka",
							icon: "error",
						});</script>';
					}
					else
					{
						$tgl = date('Y-m-d');
						$res = mysqli_query($koneksi,"UPDATE `barang` SET stockBrg = stockBrg+$jumlah
							WHERE `barang`.`idBrg` = '$_GET[id]'");
						$total = $hargabeli*$jumlah;
						$query = "SELECT max(kdBeli) as maxKode,MAX(tglBeli) as maxTgl FROM beli";
						$hasil = mysqli_query($koneksi,$query);
						$data = mysqli_fetch_array($hasil);
						$kodetransaksi = ((int)$data['maxKode']);
						$mtgl = $data['maxTgl'];
						
						if (is_null($kodetransaksi)) {
							
							$kodetransaksi = 1;
							$res = mysqli_query($koneksi,"insert into beli values ('$kodetransaksi','$tgl')");
						}
						elseif($tgl != $mtgl){
							$kodetransaksi++;
							$res = mysqli_query($koneksi,"insert into beli values ('$kodetransaksi','$tgl')");
						}

						$res = mysqli_query($koneksi,"insert into detailbeli values ('','$jumlah','$hargabeli','$total','$kodetransaksi','$id')");
						if ($harga!=0) {
							echo '<script>
							swal({
								title: "Berhasil!",
								text: "Data telah diubah",
								icon: "success",
							}).then((value) => {
								window.location = "databarangjual.php";
							});</script>';
						}
						else if($harga==0){
							echo '<script>
							swal({
								title: "Berhasil!",
								text: "Data telah diubah",
								icon: "success",
							}).then((value) => {
								window.location = "databarangsewa.php";
							});</script>';
						}
					}

				}
				?>
				<!-- ============================================================== -->
				<!-- End Container fluid  -->
				<!-- ============================================================== -->
				<!-- ============================================================== -->
				<!-- End footer -->
				<!-- ============================================================== -->
			</div>
			<!-- ============================================================== -->
			<!-- End Page wrapper  -->
			<!-- ============================================================== -->
		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->
		<script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap tether Core JavaScript -->
		<script src="../../assets/libs/popper.js/dist/umd/popper.min.js"></script>
		<script src="../../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="../../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
		<script src="../../assets/extra-libs/sparkline/sparkline.js"></script>
		<!--Wave Effects -->
		<script src="../../dist/js/waves.js"></script>
		<!--Menu sidebar -->
		<script src="../../dist/js/sidebarmenu.js"></script>
		<!--Custom JavaScript -->
		<script src="../../dist/js/custom.min.js"></script>
		<!--This page JavaScript -->
		<!-- <script src="../../dist/js/pages/dashboards/dashboard1.js"></script> -->
		<!-- Charts js Files -->

	</body>

	</html>