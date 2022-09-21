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
	<title>Admin Dashboard</title>
	<!-- Custom CSS -->
	<link href="../../assets/libs/flot/css/float-chart.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="../../dist/css/style.min.css" rel="stylesheet">
	<script src="../../assets/libs/chart/chart.js"></script>

	<style type="text/css">
		.inblock {display: inline-block;}
		body {background-color: #2a2b30;}
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
	if ($_SESSION['user']['role'] != 'pemilik toko') {
		echo '<script>window.location = "../../../user/notuser.php?id=3";</script>';

	}
	$res = "SELECT max(tglBeli) tglLast FROM `beli` join detailbeli on beli.kdBeli = detailbeli.kdBeli join barang on detailbeli.idBrg = barang.idBrg WHERE barang.hargaBrg = 0";
	$mysql = mysqli_query($koneksi,$res);
	$assc = mysqli_fetch_assoc($mysql);
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
							<h4 class="page-title">Dashboard</h4>
						</div>
					</div>
				</div>
				<!-- ============================================================== -->
				<!-- End Bread crumb and right sidebar toggle -->
				<!-- ============================================================== -->
				<!-- ============================================================== -->
				<!-- Container fluid  -->
				<!-- ============================================================== -->
				<div class="container-fluid">
					<center>
						<h2>Statistik Keuangan</h2><br>
						<div align="center" style="width: 80%">
							<canvas id="graphbar"></canvas>
						</div>


						<?php
						$datenow = date('Y-m');
						$date1 = date('Y-m', strtotime("-5 months", strtotime($datenow)));
						$date2 = date('Y-m', strtotime("-4 months", strtotime($datenow)));
						$date3 = date('Y-m', strtotime("-3 months", strtotime($datenow)));
						$date4 = date('Y-m', strtotime("-2 months", strtotime($datenow)));
						$date5 = date('Y-m', strtotime("-1 months", strtotime($datenow)));

						$query = "SELECT tglTransaksi,ifnull(SUM(totalHarga),0) pemasukan FROM `transaksi` WHERE tglTransaksi like '%$date1%'
						UNION ALL
						SELECT tglTransaksi,ifnull(SUM(totalHarga),0) FROM `transaksi` WHERE tglTransaksi like '%$date2%'
						UNION ALL
						SELECT tglTransaksi,ifnull(SUM(totalHarga),0) FROM `transaksi` WHERE tglTransaksi like '%$date3%'
						UNION ALL
						SELECT tglTransaksi,ifnull(SUM(totalHarga),0) FROM `transaksi` WHERE tglTransaksi like '%$date4%'
						UNION ALL
						SELECT tglTransaksi,ifnull(SUM(totalHarga),0) FROM `transaksi` WHERE tglTransaksi like '%$date5%'
						UNION ALL
						SELECT tglTransaksi,ifnull(SUM(totalHarga),0) FROM `transaksi` WHERE tglTransaksi like '%$datenow%'
						";

						$query2 = "SELECT tglBeli,ifnull(SUM(subTotal),0) pengeluaran FROM `beli` join detailbeli on beli.kdBeli = detailbeli.kdBeli WHERE tglBeli like '%$date1%'
						UNION ALL
						SELECT tglBeli,ifnull(SUM(subTotal),0) pengeluaran FROM `beli` join detailbeli on beli.kdBeli = detailbeli.kdBeli WHERE tglBeli like '%$date2%'
						UNION ALL
						SELECT tglBeli,ifnull(SUM(subTotal),0) pengeluaran FROM `beli` join detailbeli on beli.kdBeli = detailbeli.kdBeli WHERE tglBeli like '%$date3%'
						UNION ALL
						SELECT tglBeli,ifnull(SUM(subTotal),0) pengeluaran FROM `beli` join detailbeli on beli.kdBeli = detailbeli.kdBeli WHERE tglBeli like '%$date4%'
						UNION ALL
						SELECT tglBeli,ifnull(SUM(subTotal),0) pengeluaran FROM `beli` join detailbeli on beli.kdBeli = detailbeli.kdBeli WHERE tglBeli like '%$date5%'
						UNION ALL
						SELECT tglBeli,ifnull(SUM(subTotal),0) pengeluaran FROM `beli` join detailbeli on beli.kdBeli = detailbeli.kdBeli WHERE tglBeli like '%$datenow%'
						";

						$mysql = mysqli_query($koneksi,$query);	
						$mysql2 = mysqli_query($koneksi,$query2);					

						?>  

						<script>
							var ctx = document.getElementById("graphbar").getContext('2d');
							var myChart = new Chart(ctx, {
								type: 'line',
								data: {                     
									labels: ["<?php echo date("M Y", strtotime($date1)); ?>",
									"<?php echo date("M Y", strtotime($date2)); ?>",
									"<?php echo date("M Y", strtotime($date3)); ?>",
									"<?php echo date("M Y", strtotime($date4)); ?>",
									"<?php echo date("M Y", strtotime($date5)); ?>",
									"<?php echo date("M Y", strtotime($datenow)); ?>"],
									datasets: [{
										label: 'Pemasukan ',
										data: [<?php while ($ini = mysqli_fetch_assoc($mysql)) {
											echo $ini['pemasukan'],",";
										}?>],
										backgroundColor: [
										'rgba(255, 99, 132, 0)',
										],
										borderColor: [
										'rgba(52, 152, 219,1.0)',
										],
										borderWidth: 2
									},{
										label: 'Pengeluaran ',
										data: [<?php while ($ini2 = mysqli_fetch_assoc($mysql2)) {
											echo $ini2['pengeluaran'],",";
										}?>],
										backgroundColor: [
										'rgba(255, 99, 132, 0)',
										],
										borderColor: [
										'rgba(231, 76, 60,1.0)',
										],
										borderWidth: 2
									}]
								},
								options: {
									legend: {
										labels: {
											fontColor: "rgba(236, 240, 241,1.0)",
										}
									},
									scales: {
										yAxes: [{
											ticks: {
												fontColor: "rgba(236, 240, 241,1.0)",
												beginAtZero:true
											},
											gridLines: {
												color: "rgba(236, 240, 241,0.3)"
											},
										}],
										xAxes: [{
											ticks: {
												fontColor: "rgba(236, 240, 241,1.0)",
											},
											gridLines: {
												color: "rgba(236, 240, 241,0.3)"
											},
										}],
									}
								}
							});
						</script>
						<br><br><hr><br>

						<!-- PEMASUKAN -->
						<h2>Pemasukan</h2>
						<div style="width: 90%">
							<h3>Penjualan</h3><br>
							<canvas id="pemasukan_jual"></canvas>   
						</div>

						<div style="width: 90%">
							<h3>Penyewaan</h3><br>
							<canvas id="pemasukan_sewa"></canvas>
						</div>
						<br><br><br><br>

						<!----------------------- PENGELUARAN ------------------------>
						<h2>Pengeluaran</h2><br>
						<div style="width: 90%">
							<h3>Pembelian</h3><br>
							<canvas id="pengeluaran_beli"></canvas> 
						</div>

					</center>
					<!------------------------ SCRIPT GRAPH PIE------------------------>

					<?php
					$query = "SELECT sum(if(barang.jenisBrg = 'Alat Memasak',jual.jmlhBrg,0)) 'Alat Memasak',
					sum(if(barang.jenisBrg = 'Alat Makan & Minum',jual.jmlhBrg,0)) 'Alat Makan & Minum',
					sum(if(barang.jenisBrg = 'Alat Komunikasi',jual.jmlhBrg,0)) 'Alat Komunikasi',
					sum(if(barang.jenisBrg = 'Tenda',jual.jmlhBrg,0)) 'Tenda',
					sum(if(barang.jenisBrg = 'Alat Penerangan',jual.jmlhBrg,0)) 'Alat Penerangan',
					sum(if(barang.jenisBrg = 'Dompet',jual.jmlhBrg,0)) 'Dompet',
					sum(if(barang.jenisBrg = 'Tas',jual.jmlhBrg,0)) 'Tas',
					sum(if(barang.jenisBrg = 'Sepatu & Sendal',jual.jmlhBrg,0)) 'Sepatu & Sendal',
					sum(if(barang.jenisBrg = 'Jam Tangan',jual.jmlhBrg,0)) 'Jam Tangan',
					sum(if(barang.jenisBrg = 'Hammock & Sleeping Bag',jual.jmlhBrg,0)) 'Hammock & Sleeping Bag',
					sum(if(barang.jenisBrg = 'Perlengkapan Lain',jual.jmlhBrg,0)) 'Perlengkapan Lain'

					from barang
					join jual on jual.idBrg = barang.idBrg
					join transaksi on transaksi.kdTransaksi = jual.kdTransaksi
					WHERE transaksi.tglTransaksi like '$datenow%'";

					$query2 = "SELECT sum(if(barang.jenisBrg = 'Alat Memasak',detailsewa.jmlhBrg,0)) 'Alat Memasak',
					sum(if(barang.jenisBrg = 'Alat Makan & Minum',detailsewa.jmlhBrg,0)) 'Alat Makan & Minum',
					sum(if(barang.jenisBrg = 'Alat Komunikasi',detailsewa.jmlhBrg,0)) 'Alat Komunikasi',
					sum(if(barang.jenisBrg = 'Tenda',detailsewa.jmlhBrg,0)) 'Tenda',
					sum(if(barang.jenisBrg = 'Alat Penerangan',detailsewa.jmlhBrg,0)) 'Alat Penerangan',
					sum(if(barang.jenisBrg = 'Dompet',detailsewa.jmlhBrg,0)) 'Dompet',
					sum(if(barang.jenisBrg = 'Tas',detailsewa.jmlhBrg,0)) 'Tas',
					sum(if(barang.jenisBrg = 'Sepatu & Sendal',detailsewa.jmlhBrg,0)) 'Sepatu & Sendal',
					sum(if(barang.jenisBrg = 'Jam Tangan',detailsewa.jmlhBrg,0)) 'Jam Tangan',
					sum(if(barang.jenisBrg = 'Hammock & Sleeping Bag',detailsewa.jmlhBrg,0)) 'Hammock & Sleeping Bag',
					sum(if(barang.jenisBrg = 'Perlengkapan Lain',detailsewa.jmlhBrg,0)) 'Perlengkapan Lain'

					from barang
					join detailsewa on detailsewa.idBrg = barang.idBrg
					where detailsewa.tglSewa like '$datenow%'";

					$mysql = mysqli_query($koneksi,$query);	
					$ini = mysqli_fetch_assoc($mysql);

					$mysql2 = mysqli_query($koneksi,$query2);	
					$ini2 = mysqli_fetch_assoc($mysql2);
					?>

					<script>
						var ctx = document.getElementById("pemasukan_sewa").getContext('2d');
						var myChart1 = new Chart(ctx, {
							type: 'bar',
							data: {
								labels: ["Alat Memasak", "Alat Makan & Minum", "Alat Komunikasi", "Tenda","Alat Penerangan", "Dompet", "Tas", "Sepatu & Sendal", "Jam Tangan", "Hammock & Sleeping Bag", "Perlengkapan Lain"],
								datasets: [{
									label: 'Penyewaan',
									data: [<?php echo $ini2['Alat Memasak'],",", $ini2['Alat Makan & Minum'],",", $ini2['Alat Komunikasi'],",", $ini2['Tenda'],",", $ini2['Alat Penerangan'],",", $ini2['Dompet'],",", $ini2['Tas'],",", $ini2['Sepatu & Sendal'],",", $ini2['Jam Tangan'],",", $ini2['Hammock & Sleeping Bag'],",", $ini2['Perlengkapan Lain']; ?>],
									backgroundColor: [
									'rgba(52, 152, 219,1.0)',
									'rgba(155, 89, 182,1.0)',
									'rgba(241, 196, 15,1.0)',
									'rgba(231, 76, 60,1.0)',
									'rgba(46, 204, 113,1.0)',
									'rgba(85, 239, 196,1.0)',
									'rgba(116, 185, 255,1.0)',
									'rgba(162, 155, 254,1.0)',
									'rgba(214, 48, 49,1.0)',
									'rgba(1, 163, 164,1.0)',
									'rgba(87, 101, 116,1.0)',
									],
									borderColor: [
									'rgba(52, 152, 219,1.0)',
									'rgba(155, 89, 182,1.0)',
									'rgba(241, 196, 15,1.0)',
									'rgba(231, 76, 60,1.0)',
									'rgba(46, 204, 113,1.0)',
									'rgba(85, 239, 196,1.0)',
									'rgba(116, 185, 255,1.0)',
									'rgba(162, 155, 254,1.0)',
									'rgba(214, 48, 49,1.0)',
									'rgba(1, 163, 164,1.0)',
									'rgba(87, 101, 116,1.0)',
									],
									borderWidth: 2
								}]
							},
							options: {
								legend:{
									position: 'top',
									labels:{
										fontColor: "rgba(236, 240, 241,1.0)"
									}
								},
								scales: {
                                    yAxes: [{
                                        ticks: {
                                            fontColor: "rgba(236, 240, 241,1.0)",
                                            beginAtZero:true
                                        },
                                        gridLines: {
                                            color: "rgba(236, 240, 241,0.3)"
                                        },
                                    }],
                                    xAxes: [{
                                        ticks: {
                                            fontColor: "rgba(236, 240, 241,1.0)",
                                        },
                                        gridLines: {
                                            color: "rgba(236, 240, 241,0.3)"
                                        },
                                    }],
                                }
							}
						});

						var ctx = document.getElementById("pemasukan_jual").getContext('2d');
						var myChart2 = new Chart(ctx, {
							type: 'bar',
							data: {
								labels: ["Alat Memasak", "Alat Makan & Minum", "Alat Komunikasi", "Tenda", "Alat Penerangan", "Dompet", "Tas", "Sepatu & Sendal", "Jam Tangan", "Hammock & Sleeping Bag", "Perlengkapan Lain"],
								datasets: [{
									label: 'Penjualan',
									data: [<?php echo $ini['Alat Memasak'],",", $ini['Alat Makan & Minum'],",", $ini['Alat Komunikasi'],",", $ini['Tenda'],",", $ini['Alat Penerangan'],",", $ini['Dompet'],",", $ini['Tas'],",", $ini['Sepatu & Sendal'],",", $ini['Jam Tangan'],",", $ini['Hammock & Sleeping Bag'],",", $ini['Perlengkapan Lain']; ?>],
									backgroundColor: [
									'rgba(52, 152, 219,1.0)',
									'rgba(155, 89, 182,1.0)',
									'rgba(241, 196, 15,1.0)',
									'rgba(231, 76, 60,1.0)',
									'rgba(46, 204, 113,1.0)',
									'rgba(85, 239, 196,1.0)',
									'rgba(116, 185, 255,1.0)',
									'rgba(162, 155, 254,1.0)',
									'rgba(214, 48, 49,1.0)',
									'rgba(1, 163, 164,1.0)',
									'rgba(87, 101, 116,1.0)',
									],
									borderColor: [
									'rgba(52, 152, 219,1.0)',
									'rgba(155, 89, 182,1.0)',
									'rgba(241, 196, 15,1.0)',
									'rgba(231, 76, 60,1.0)',
									'rgba(46, 204, 113,1.0)',
									'rgba(85, 239, 196,1.0)',
									'rgba(116, 185, 255,1.0)',
									'rgba(162, 155, 254,1.0)',
									'rgba(214, 48, 49,1.0)',
									'rgba(1, 163, 164,1.0)',
									'rgba(87, 101, 116,1.0)',
									],
									borderWidth: 2
								}]
							},
							options: {
								legend:{
									position: 'top',
									labels:{
										fontColor: "rgba(236, 240, 241,1.0)"
									}
								},
								scales: {
                                    yAxes: [{
                                        ticks: {
                                            fontColor: "rgba(236, 240, 241,1.0)",
                                            beginAtZero:true
                                        },
                                        gridLines: {
                                            color: "rgba(236, 240, 241,0.3)"
                                        },
                                    }],
                                    xAxes: [{
                                        ticks: {
                                            fontColor: "rgba(236, 240, 241,1.0)",
                                        },
                                        gridLines: {
                                            color: "rgba(236, 240, 241,0.3)"
                                        },
                                    }],
                                }
							}
						});

						<?php
						$query = "SELECT sum(if(barang.jenisBrg = 'Alat Memasak',detailbeli.jmlhBrg,0)) 'Alat Memasak',
						sum(if(barang.jenisBrg = 'Alat Makan & Minum',detailbeli.jmlhBrg,0)) 'Alat Makan & Minum',
						sum(if(barang.jenisBrg = 'Alat Komunikasi',detailbeli.jmlhBrg,0)) 'Alat Komunikasi',
						sum(if(barang.jenisBrg = 'Tenda',detailbeli.jmlhBrg,0)) 'Tenda',
						sum(if(barang.jenisBrg = 'Alat Penerangan',detailbeli.jmlhBrg,0)) 'Alat Penerangan',
						sum(if(barang.jenisBrg = 'Dompet',detailbeli.jmlhBrg,0)) 'Dompet',
						sum(if(barang.jenisBrg = 'Tas',detailbeli.jmlhBrg,0)) 'Tas',
						sum(if(barang.jenisBrg = 'Sepatu & Sendal',detailbeli.jmlhBrg,0)) 'Sepatu & Sendal',
						sum(if(barang.jenisBrg = 'Jam Tangan',detailbeli.jmlhBrg,0)) 'Jam Tangan',
						sum(if(barang.jenisBrg = 'Hammock & Sleeping Bag',detailbeli.jmlhBrg,0)) 'Hammock & Sleeping Bag',
						sum(if(barang.jenisBrg = 'Perlengkapan Lain',detailbeli.jmlhBrg,0)) 'Perlengkapan Lain'

						from barang
						join detailbeli on detailbeli.idBrg = barang.idBrg
						join beli on beli.kdBeli = detailbeli.kdBeli
						where beli.tglBeli like '$datenow%'";

						$mysql = mysqli_query($koneksi,$query);	
						$ini = mysqli_fetch_assoc($mysql);
						
						?>


						var ctx = document.getElementById("pengeluaran_beli").getContext('2d');
						var myChart3 = new Chart(ctx, {
							type: 'bar',
							data: {
								labels: ["Alat Memasak", "Alat Makan & Minum", "Alat Komunikasi", "Tenda","Alat Penerangan", "Dompet", "Tas", "Sepatu & Sendal", "Jam Tangan", "Hammock & Sleeping Bag", "Perlengkapan Lain"],
								datasets: [{
									label: 'Pembelian',
									data: [<?php echo $ini['Alat Memasak'],",", $ini['Alat Makan & Minum'],",", $ini['Alat Komunikasi'],",", $ini['Tenda'],",", $ini['Alat Penerangan'],",", $ini['Dompet'],",", $ini['Tas'],",", $ini['Sepatu & Sendal'],",", $ini['Jam Tangan'],",", $ini['Hammock & Sleeping Bag'],",", $ini['Perlengkapan Lain']; ?>],
									backgroundColor: [
									'rgba(52, 152, 219,1.0)',
									'rgba(155, 89, 182,1.0)',
									'rgba(241, 196, 15,1.0)',
									'rgba(231, 76, 60,1.0)',
									'rgba(46, 204, 113,1.0)',
									'rgba(85, 239, 196,1.0)',
									'rgba(116, 185, 255,1.0)',
									'rgba(162, 155, 254,1.0)',
									'rgba(214, 48, 49,1.0)',
									'rgba(1, 163, 164,1.0)',
									'rgba(87, 101, 116,1.0)',
									],
									borderColor: [
									'rgba(52, 152, 219,1.0)',
									'rgba(155, 89, 182,1.0)',
									'rgba(241, 196, 15,1.0)',
									'rgba(231, 76, 60,1.0)',
									'rgba(46, 204, 113,1.0)',
									'rgba(85, 239, 196,1.0)',
									'rgba(116, 185, 255,1.0)',
									'rgba(162, 155, 254,1.0)',
									'rgba(214, 48, 49,1.0)',
									'rgba(1, 163, 164,1.0)',
									'rgba(87, 101, 116,1.0)',
									],
									borderWidth: 2
								}]
							},
							options: {
								legend:{
									position: 'top',
									labels:{
										fontColor: "rgba(236, 240, 241,1.0)"
									}
								},
								scales: {
                                    yAxes: [{
                                        ticks: {
                                            fontColor: "rgba(236, 240, 241,1.0)",
                                            beginAtZero:true
                                        },
                                        gridLines: {
                                            color: "rgba(236, 240, 241,0.3)"
                                        },
                                    }],
                                    xAxes: [{
                                        ticks: {
                                            fontColor: "rgba(236, 240, 241,1.0)",
                                        },
                                        gridLines: {
                                            color: "rgba(236, 240, 241,0.3)"
                                        },
                                    }],
                                }
							}
						});
					</script>
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

			<h2 align = "center" style="color: yellow">
				<?php while ($ini = mysqli_fetch_assoc($mysql)) {
					echo "<br> ",$ini['pemasukan'];
				} ?>
			</h2>
		</body>

		</html>