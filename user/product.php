<?php
session_start();
include "../config.php";
ini_set('display_errors', 1);
$halaman = 15;
$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
$result = mysqli_query($koneksi,"SELECT * FROM barang");
$total = mysqli_num_rows($result);
$pages = ceil($total/$halaman);   
$pagi = false; 
$sort = false;        
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Malabar Outdoor - Product</title>
	<link rel="icon" href="img/iconw.png" type="image/png">
	<link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
	<link rel="stylesheet" href="vendors/linericon/style.css">
	<link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
	<link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
	<link rel="stylesheet" href="vendors/nice-select/nice-select.css">
	<link rel="stylesheet" href="vendors/nouislider/nouislider.min.css">

	<link rel="stylesheet" href="css/style.css">

	<style type="text/css">
		.senpai {background-color: rgb(0,0,0); color: white; padding : 6px;}
		.senpai:hover {background-color: #3498db; color: white; }
		.kouhai {background-color: rgb(235,235,235); color: black; border-color: rgb(25,25,25); padding: 6px;}
		.kouhai:hover {background-color: #3498db; color: white;}
	</style>
	<style type="text/css">
		.btn.btn-black {
			border-width: 2px;
			border-color: #000;
			background: #000;
			color: #fff;
		}

		.btn {
			text-transform: uppercase;
			font-size: 12px;
			font-weight: 900;
			padding: 6px 20px;
		}

		.btn:hover{
			border-width: 2px;
			border-color: #000;
			background: #fff;
			color: #000;	
		}


	</style>
</head>
<body>
	<!--================ Start Header Menu Area =================-->
	<header class="header_area">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light">
				<div class="container">
					<a class="navbar-brand logo_h" href="../">
						<div>
							<img src="img/icon.png" alt="" width="8%">
							<span style="padding-left: 15px; font-weight: bolder;">MALABAR OUTDOOR</span>
						</div>  
					</a>

					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto mr-auto">
							<?php
							if (isset($_SESSION['user']))
							{
								if ($_SESSION['user']['role'] == 'pemilik toko') {
									echo '<li class="nav-item"><a class="nav-link" href="../admin/html/owner/index.php">Admin</a></li>';
								}
								elseif ($_SESSION['user']['role'] == 'bagian keuangan') {
									echo '<li class="nav-item"><a class="nav-link" href="../admin/html/keuangan/index.php">Admin</a></li>';
								}
								else{
									echo '<li class="nav-item"><a class="nav-link" href="../index.php">Beranda</a></li>';
								}
							}
							else{
								echo '<li class="nav-item"><a class="nav-link" href="../index.php">Beranda</a></li>';
							}
							?>
							<li class="nav-item"><a class="nav-link" href="product.php">Produk</a></li>
							<li class="nav-item"><a class="nav-link" href="cart.php">Transaksi</a></li>
							<?php
							if (isset($_SESSION['user']))
							{
								?>
								<li class="nav-item"><a class="nav-link" href="account.php">Akun</a></li>
								<li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
								<?php
							}
							else{
								echo'<li class="nav-item"><a class="nav-link" href="../login.php">Login</a></li>';
							}
							?>
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</header>
	<!--================ End Header Menu Area =================-->

	<!-- ================ category section start ================= -->		  
	<section class="section-margin--small mb-5">
		<div class="container">
			<div class="row">
				<div class="col-xl-3 col-lg-4 col-md-5">
					<div class="sidebar-categories">
						<div class="head" style="background-color: ">Browse Categories</div>
						<ul class="main-categories">
							<li class="common-filter">
								<form method="POST">
									<ul>
										<?php
										$ambil=mysqli_query($koneksi,"select count(namaBrg) from barang where stockBrg <> 0 ");
										if ($ambil)	{
											$pecah = mysqli_fetch_assoc($ambil);
										} ?>
										<li class="filter-list"><input class="pixel-radio radios" type="radio" id="men" name="brand" 
											value="semua" onchange="this.form.submit();" <?php if ((!isset($_POST['brand'])) or ($_POST['brand'] == "semua")) {
												echo "checked";}?> >Semua Produk<span> <?php echo "(",$pecah['count(namaBrg)'],")";	?>
											</span></li>
											<?php
											$ambil=mysqli_query($koneksi,"select distinct jenisBrg from barang where stockBrg <> 0  ORDER BY `jenisBrg` ASC");

											if ($ambil){
												while ($pecah = mysqli_fetch_assoc($ambil)) { ?>
												<li class="filter-list"><input class="pixel-radio radios" type="radio" id="men" name="brand"value="<?php echo $pecah['jenisBrg']; ?>" onchange="this.form.submit();" <?php if ((isset($_POST['brand'])) and ($_POST['brand'] == $pecah['jenisBrg'])) { echo "checked";}?> >
													<?php echo $pecah['jenisBrg']; ?><span>
													<?php
													$count=mysqli_query($koneksi,"select count(jenisBrg) from barang where jenisBrg = '$pecah[jenisBrg]' and stockBrg <> 0 ");
													if ($count) {
														$ctampil = mysqli_fetch_assoc($count);
													}
													echo "(",$ctampil['count(jenisBrg)'],")";
													?>	

												</span></li>

												<?php }}
												else{
													echo "Tidak ada data";
												}
												?>
											</ul>
										</form>
									</li>
								</ul>
							</div>          
						</div>
						<div class="col-xl-9 col-lg-8 col-md-7">
							<!-- Start Filter Bar -->
							<div class="filter-bar d-flex flex-wrap align-items-center">
								<form method="post" target="" action="">
									<div class="sorting">
										<select name="sort" onchange="this.form.submit();">
											<option value="1" <?php if ((isset($_POST['sort'])) and ($_POST['sort'] == "1")) {echo "selected";}?>>Alphabet</option>
											<option value="2" <?php if ((isset($_POST['sort'])) and ($_POST['sort'] == "2")) {echo "selected";}?> >Tipe : Sewa</option>
											<option value="3" <?php if ((isset($_POST['sort'])) and ($_POST['sort'] == "3")) {echo "selected";}?> >Tipe : Jual</option>
										</select>
									</div>
								</form>
								<div class="sorting mr-auto">
								</div>
								<div>
									<form method="post">
										<div class="input-group filter-bar-search">
											<input type="text" placeholder="Search" name="inputc">
											<div class="input-group-append">
												<button type="submit" name="cari" onchange="this.form.submit();"><i class="ti-search"></i></button>
											</div>
										</div>
									</form>
								</div>
							</div>
							<!-- End Filter Bar -->
							<!-- Start Best Seller -->
							<section class="lattest-product-area pb-40 category-list">
								<div class="row">
									<?php
									$query = "select * from barang where stockBrg <> 0 ";
									if(isset($_POST["brand"]))
									{		
										if ($_POST['brand'] == "semua") {
											$query .= "ORDER BY `namaBrg` ASC LIMIT $mulai, $halaman";
											$pagi = true;
										}
										else{
											$query .= " and jenisBrg = '$_POST[brand]' ORDER BY `namaBrg` ASC";
										}

										$ambil=mysqli_query($koneksi,$query);
										if ($ambil)
										{
											while ($pecah = mysqli_fetch_assoc($ambil)) { 
												?>
												<div class="col-md-6 col-lg-4">
													<div class="card text-center card-product">
														<div class="card-product__img">
															<img class="card-img" src="../images/product/<?php echo $pecah['Foto']; ?>" alt="">
															<ul class="card-product__imgOverlay" style="color: black;">
																<li>
																	<?php 
																	if ($pecah['hargaBrg'] != 0) { ?>
																	<a onclick="cart('<?php echo $pecah['idBrg']; ?>')"><div class="senpai">Rp. <?php echo number_format($pecah['hargaBrg']); ?></div></a>
																	<br>
																	Harga Jual
																	<?php
																} ?>
															</li>
															<li>
																<?php 
																if ($pecah['hargaSewa'] != 0) { ?>
																<a onclick="cart2('<?php echo $pecah['idBrg']; ?>')"><div class="kouhai">Rp. <?php echo number_format($pecah['hargaSewa']); ?></div></a>
																<br>
																Harga Sewa
																<?php
															} ?>
														</li>
													</ul>
												</div>
												<div class="card-body">
													<p><?php echo $pecah['jenisBrg']; ?></p>
													<h4 class="card-product__title"><a href="detailbrg.php?id=<?php echo $pecah['idBrg']; ?>"><?php echo $pecah['namaBrg']; ?></a></h4>
												</div>
											</div>
										</div>
										<?php }}
										else{
											echo "Tidak ada data";
										}
									}
									else if(isset($_POST["cari"]))
									{
										$query .= " and namaBrg like '%".$_POST['inputc']."%' ORDER BY `namaBrg` ASC";
										$ambil=mysqli_query($koneksi,$query);
										if ($ambil)
										{
											while ($pecah = mysqli_fetch_assoc($ambil)) { 
												?>
												<div class="col-md-6 col-lg-4">
													<div class="card text-center card-product">
														<div class="card-product__img">
															<img class="card-img" src="../images/product/<?php echo $pecah['Foto']; ?>" alt="">
															<ul class="card-product__imgOverlay" style="color: black;">
																<li>
																	<?php 
																	if ($pecah['hargaBrg'] != 0) { ?>
																	<a onclick="cart('<?php echo $pecah['idBrg']; ?>')"><div class="senpai">Rp. <?php echo number_format($pecah['hargaBrg']); ?></div></a>
																	<br>
																	Harga Jual
																	<?php
																} ?>
															</li>
															<li>
																<?php 
																if ($pecah['hargaSewa'] != 0) { ?>
																<a onclick="cart2('<?php echo $pecah['idBrg']; ?>')"><div class="kouhai">Rp. <?php echo number_format($pecah['hargaSewa']); ?></div></a>
																<br>
																Harga Sewa
																<?php
															} ?>
														</li>
													</ul>
												</div>
												<div class="card-body">
													<p><?php echo $pecah['jenisBrg']; ?></p>
													<h4 class="card-product__title"><a href="detailbrg.php?id=<?php echo $pecah['idBrg']; ?>"><?php echo $pecah['namaBrg']; ?></a></h4>
												</div>
											</div>
										</div>
										<?php }}
										else{
											echo "Tidak ada data";
										}

										?>
										<?php		
									}
									else{
										$pagi = true;
										if(!isset($_POST['sort'])){

										}
										else if ($_POST['sort'] == '2') {
											$query .= " and hargaSewa <> 0";
											$sort = true;
										}
										else if ($_POST['sort'] == '3') {
											$query .= " and hargaBrg <> 0";
											$sort = true;
										}
										$query .= " ORDER BY `namaBrg` ASC LIMIT $mulai, $halaman";
										$ambil=mysqli_query($koneksi,$query);

										if ($ambil)
										{
											while ($pecah = mysqli_fetch_assoc($ambil)) { ?>
											<div class="col-md-6 col-lg-4">
												<div class="card text-center card-product">
													<div class="card-product__img">
														<img class="card-img" src="../images/product/<?php echo $pecah['Foto']; ?>" alt="">
														<ul class="card-product__imgOverlay" style="color: black;">
															<li>
																<?php 
																if ($pecah['hargaBrg'] != 0) { ?>
																<a onclick="cart('<?php echo $pecah['idBrg']; ?>')"><div class="senpai">Rp. <?php echo number_format($pecah['hargaBrg']); ?></div></a>
																<br>
																Harga Jual
																<?php
															} ?>
														</li>
														<li>
															<?php 
															if ($pecah['hargaSewa'] != 0) { ?>
															<a onclick="cart2('<?php echo $pecah['idBrg']; ?>')"><div class="kouhai">Rp. <?php echo number_format($pecah['hargaSewa']); ?></div></a>
															<br>
															Harga Sewa
															<?php
														} ?>
													</li>
												</ul>
											</div>
											<div class="card-body">
												<p><?php echo $pecah['jenisBrg']; ?></p>
												<h4 class="card-product__title"><a href="detailbrg.php?id=<?php echo $pecah['idBrg']; ?>"><?php echo $pecah['namaBrg']; ?></a></h4>
											</div>
										</div>
									</div>
									<?php }}
									else{
										echo "Tidak ada data";
									}
								}

								?>
							</div>
							<?php
							if ($pagi == true ){ ?>
							<div align="center">
								<?php for ($i=1; $i<=$pages ; $i++){ ?>

								<a href="?halaman=<?php echo $i; ?>" class="btn btn-black"><?php echo $i; ?></a>

								<?php } ?>
							</div>
							<?php
						}
						?>
					</section>
					<!-- End Best Seller -->
				</div>
			</div>
		</div>
	</section>
	<!-- ================ category section end ================= -->		  


	<!--================ End footer Area  =================-->



	<script src="vendors/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
	<script src="vendors/skrollr.min.js"></script>
	<script src="vendors/owl-carousel/owl.carousel.min.js"></script>
	<script src="vendors/nice-select/jquery.nice-select.min.js"></script>
	<script src="vendors/nouislider/nouislider.min.js"></script>
	<script src="vendors/jquery.ajaxchimp.min.js"></script>
	<script src="vendors/mail-script.js"></script>
	<script src="js/main.js"></script>
	<script type="text/javascript" src="js/sweetalert.min.js"></script>
	<script>
		function cart(str){
			var id = str;
			window.location = "beli.php?id="+id+"&status=Beli";

		}
	</script>

	<script>
		function cart2(str){
			var id = str;
			window.location = "beli.php?id="+id+"&status=Sewa";
		}
	</script>
	
</body>
</html>

