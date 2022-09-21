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

  <link rel="stylesheet" href="css/style.css">

  <style type="text/css">
    .inblock {display: inline-block;}
    .tombol {padding: 10px; color: black; width: 100%; text-align: left; padding-right: 50px}
    .tombol:hover {background-color: rgba(52, 152, 219,1.0); color: white; width: 100%; font-weight: bold;}
    
    .tombolB {padding-left: 25px; padding-right: 25px; padding-top: 5px; padding-bottom: 5px; color: white; background-color: #3498db; border : 1px solid rgba(0,0,0,0); border-radius: 10px;}
    .tombolB:hover {background-color: blue; font-weight: bold; color: white;}
    .boxshad {box-shadow: 5px 5px 5px rgb(200,200,200);}
    .boxtr {display: inline-block; padding: 20px; background-color: #ecf0f1}
  </style>
</head>
<body>
  <!--================ Start Header Menu Area =================-->
  <?php
  if (!isset($_SESSION['user']))
  {
    echo '<script>window.location = "notuser.php?id=1";</script>';
  }
  ?>
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

  <br><br>
  <center>
    <h2>Menunggu Konfirmasi</h2>  
    <br><br>
    <div style="width: 90%; align-self: center;" class="inblock">
      <div class="inblock" style="height: 100%; vertical-align: top;">  
        <div>
          <a href="cart.php" class="tombol">
            Keranjang
          </a><br>

          <a href="menungguUp.php" class="tombol">
            Menunggu Pembayaran
          </a><br>

          <a href="menungguKon.php" class="tombol">
            Menunggu Konfirmasi
          </a><br>  

          <a href="terkonfirmasi.php" class="tombol">
            Terkonfirmasi
          </a>    
        </div>
      </div>
      <div style="width: 80%; display : inline-block; border-left: 1px solid gray;">

        <?php 
        $idUser = $_SESSION['user']['idUser'];
        $ambil = mysqli_query($koneksi,"select * from transaksi where idUser='$idUser' and status IN ('Menunggu Pengembalian','Menunggu Konfirmasi Seller') ORDER BY `transaksi`.`tglTransaksi` DESC");   
        $no = 0;
        if ($ambil)
        {
          $count = mysqli_query($koneksi,"select count(kdTransaksi) from transaksi where idUser='$idUser' and status IN ('Menunggu Pengembalian','Menunggu Konfirmasi Seller')");
          $hitung = mysqli_fetch_assoc($count);
          if ($hitung['count(kdTransaksi)'] == 0) {
            echo "TIDAK ADA RIWAYAT PEMBELIAN";
          }
          else{
            while ($pecah = mysqli_fetch_assoc($ambil)) { 
              if ($no % 2) {
                echo "<div style='width: 50px; display: inline-block;''></div>";
              }
              ?>

              <div class="boxshad boxtr">
                <table width="350">
                  <tr>
                    <td>ID Transaksi</td>
                    <td>:</td>
                    <td><?php echo $pecah['kdTransaksi']; ?></td>
                  </tr>
                  <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><?php $tgl = $pecah["tglTransaksi"]; echo date("d-M-Y", strtotime($tgl)); ?></td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td><?php echo $pecah['status']; ?></td>
                  </tr>
                </table>
                <br>
                <a href="detailtran.php?id=<?php echo $pecah['kdTransaksi']; ?>" class="tombolB">
                  Detail
                </a>
              </div>

              <?php
              if ($no % 2) { ?>
              <br><br><br>
              <?php
            }
            $no++;
          }
        }
      }
      ?>

      <br><br>  
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