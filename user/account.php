<?php
session_start();
include "../config.php";
ini_set('display_errors', 1);

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
  <script type="text/javascript" src="js/sweetalert.min.js"></script>

  <link rel="stylesheet" href="css/style.css">

  <style type="text/css">
    .inblock {display: inline-block;}
    .gambar {width: 20%; border-radius: 50%;}
    .tombol {
      padding-top: 10px; 
      padding-bottom: 10px;
      padding-right: 20px;
      padding-left: 20px;
      background-color: #3498db; 
      color: white; 
      text-align: left;
    }
    .tombol:hover {background-color: #f1c40f; color: white;}
    .boxshad {box-shadow: 5px 5px 5px rgb(200,200,200);}
    .boxtr {display: inline-block; padding: 20px; background-color: #ecf0f1}
    table {text-align: justify; border-collapse: collapse; width: 50%;}
    td {padding: 10px;}
  </style>
</head>
<body>
  <?php
  if (!isset($_SESSION['user']))
  {
    echo '<script>window.location = "notuser.php?id=1";</script>';
  }
  ?>
  <!--================ Start Header Menu Area =================-->
  <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand logo_h" href="index.html">
            <div>
              <img src="img/icon.png" alt="" width="8%">
              <span style="padding-left: 15px; font-weight: bolder;">MALABAR OUTDOOR</span>
            </div>  
          </a>
          
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
              <?php
              if ($_SESSION['user']['role'] == 'pemilik toko') {
                echo '<li class="nav-item"><a class="nav-link" href="../admin/html/owner/index.php">Admin</a></li>';
              }
              elseif ($_SESSION['user']['role'] == 'bagian keuangan') {
                echo '<li class="nav-item"><a class="nav-link" href="../admin/html/keuangan/index.php">Admin</a></li>';
              }
              else{
                echo '<li class="nav-item"><a class="nav-link" href="../index.php">Beranda</a></li>';
              }
              ?>
              <li class="nav-item"><a class="nav-link" href="product.php">Produk</a></li>
              <li class="nav-item"><a class="nav-link" href="cart.php">Transaksi</a></li>
              <li class="nav-item"><a class="nav-link" href="account.php">Akun</a></li>
              <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <!--================ End Header Menu Area =================-->
  <?php 
  $idUser = $_SESSION['user']['idUser'];
  $ambil = mysqli_query($koneksi,"select * from user where idUser='$idUser' ");
  $pecah = mysqli_fetch_assoc($ambil);
  ?>
  <br><br>
  <center>
    <img src="<?php if (empty($pecah['Foto'])) {
      echo 'img/img0003.png';
    }
    else{
      echo 'img/user/',$pecah['Foto'];
    }
    ?>" class="gambar"><br><br>
    <table>
      <tr>
        <td colspan="3" style="text-align: center;"><h3>Data Diri</h3></td>
      </tr>

      <tr>
        <td width="25%">Nama Lengkap</td>
        <td width="5%">:</td>
        <td><?php echo $pecah['namaUser'] ?><td>
        </tr>

        <tr>
          <td>Alamat</td>
          <td>:</td>
          <td><?php echo $pecah['Alamat'] ?></td>
        </tr>

        <tr>
          <td>No. Telepon</td>
          <td>:</td>
          <td><?php echo $pecah['Telp'] ?></td>
        </tr>

        <tr>
          <td>E-Mail</td>
          <td>:</td>
          <td><?php echo $pecah['Email'] ?></td>
        </tr>

        <tr>
          <td width="25%">Kata Sandi</td>
          <td width="5%">:</td>
          <td><input type="password" value="abcd" readonly></input></td>
        </tr>
      </table><br><br>
      <a href="ubahdatadiri.php" class="tombol">Ubah Data Diri</a>
      <a href="ubahsandi.php" class="tombol">Ubah Sandi</a>

    </center>
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
   
  </body>
  </html>