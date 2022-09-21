<?php
session_start();
require "../config.php";

if (!isset($_SESSION['user']))
{
  header('location:../login.php');
}
if((empty($_SESSION["keranjang"]['Beli']) and empty($_SESSION["keranjang"]["Sewa"])) or (!isset($_SESSION["keranjang"]['Beli']) and
  !isset($_SESSION["keranjang"]['Sewa'])))
{
  echo '<script>window.location = "notuser.php?id=4";</script>';
}
$totalbelanja1=0;
$totalbelanja2=0;
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
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery-3.4.1.js"></script>
  <script type="text/javascript" src="js/sweetalert.min.js"></script>

  <style type="text/css">
    .inblock {display: inline-block;}
    .tombol {padding: 10px; color: black; width: 100%; text-align: left; padding-right: 50px}
    .tombol:hover {background-color: rgba(52, 152, 219,1.0); color: white; width: 100%; font-weight: bold;}
    .tombolR {padding-left: 25px; padding-right: 25px; padding-top: 5px; padding-bottom: 5px; color: white; background-color: red;  border-radius: 10px; border: solid 1px rgba(0,0,0,0)}
    .tombolR:hover {
      background-color: #f1c40f;
      color: #ecf0f1;
    }
    .tombolB {padding-left: 25px; padding-right: 25px; padding-top: 5px; padding-bottom: 5px; color: white; background-color: #3498db;  border-radius: 10px; border: solid 1px rgba(0,0,0,0)}
    .tombolB:hover {background-color: #f1c40f;
      color: #ecf0f1;}
    .boxshad {box-shadow: 5px 5px 5px rgb(200,200,200);}
    .boxtr {display: inline-block; padding: 20px; background-color: #ecf0f1}

    .senpai {background-color: rgb(0,0,0); color: white; padding : 6px;}
    .senpai:hover {background-color: #3498db; color: white; }
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

    table {
      border-collapse: collapse;
      width: 100%;
      text-align: center;
    }

    td, th {
      padding : 5px;
      border: 1px solid black;
    }

    table {
      border-collapse: collapse;
      width: 80%;
      text-align: center;
    }

    td.identity, th.identity {
      padding : 15px;
      border: 1px solid rgba(0,0,0,0);
      text-align: left;
    }

    textarea {
      width: 100%;
      border: 1px solid #34495e;
    }
  </style>
</head>
<body>
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

  <br><br>
  <center>
    <h2>Checkout</h2>  
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
      <div style="width: 80%; display : inline-block; border-left: 1px solid gray; padding-left: 5%;">
        <div style="text-align: left; padding : 25px; vertical-align: top;">
          <?php
          
          if (isset($_SESSION['keranjang']['Beli']) and !empty($_SESSION['keranjang']['Beli'])){
            ?>
            <h3>Pembelian</h3>
            <table>
              <tr>
                <th width="5%">No</th>
                <td>Produk</td>
                <td width="15%">Harga</td>
                <td width="10%">Jumlah</td>
                <td width="25%">Subharga</td>
              </tr>
              <?php foreach ($_SESSION['keranjang']['Beli'] as $id_produk => $jumlah): ?>
                <?php $ambil = mysqli_query($koneksi,"select * from barang where idBrg='$id_produk'");
                if ($ambil)
                {
                  $pecah = mysqli_fetch_assoc($ambil);
                  $subharga = $pecah['hargaBrg']*$jumlah;
                  $no=1;
                }
                ?>
                <tr>
                  <td><?php echo $no; ?>
                    <td><?php echo $pecah['namaBrg']; ?></td>
                    <td>Rp. <?php echo number_format($pecah['hargaBrg']); ?></td>
                    <td><?php echo $jumlah ?></td>
                    <td>Rp. <?php echo number_format($subharga) ?></td>
                  </tr>
                  <?php 
                  $no++; 
                  $totalbelanja1+=$subharga; 
                  ?>
                  
                <?php endforeach ?>
                <tr>
                  <td colspan="4" align="center">Subtotal</td>
                  <td><?php echo "Rp. ", number_format($totalbelanja1); ?></td>
                </tr>
              </table>
              <?php
            }
            if (isset($_SESSION['keranjang']['Sewa']) and !empty($_SESSION['keranjang']['Sewa'])) {
              ?>
              <br><br>
              <h3>Penyewaan</h3>
              <table>
                <tr>
                  <th width="5%">No</th>
                  <td>Produk</td>
                  <td width="15%">Harga</td>
                  <td width="10%">Jumlah</td>
                  <td width="10%">Lama Sewa</td>
                  <td width="25%">Subharga</td>
                </tr>
                <?php foreach ($_SESSION['keranjang']['Sewa'] as $id_produk => $jumlah): ?>
                  <?php $ambil = mysqli_query($koneksi,"select * from barang where idBrg='$id_produk'");
                  if ($ambil)
                  {
                    $pecah = mysqli_fetch_assoc($ambil);
                    $subharga = $pecah['hargaSewa']*$jumlah*$_SESSION['keranjang']['lama'][$id_produk];
                    $no=1;
                  }
                  ?>
                  <tr>
                    <td><?php echo $no; ?>
                      <td><?php echo $pecah['namaBrg']; ?></td>
                      <td>Rp. <?php echo number_format($pecah['hargaSewa']); ?></td>
                      <td><?php echo $jumlah ?></td>
                      <td><?php echo $_SESSION['keranjang']['lama'][$id_produk] ?> Hari</td>
                      <td>Rp. <?php echo number_format($subharga) ?></td>
                    </tr>
                    <?php 
                    $no++; 
                    $totalbelanja2+=$subharga; 
                    ?>
                    
                  <?php endforeach ?>
                  <tr>
                    <td colspan="5" align="center">Subtotal</td>
                    <td><?php echo "Rp. ", number_format($totalbelanja2); ?></td>
                  </tr>
                </table>
                
                <br><br>
                <form method="post">
                  Pilihan Pembayaran Penyewaan<br>
                  <select name="bayar" id="bayar" onchange="this.form.submit();">
                    <option value="Bayar Lunas" <?php if (isset($_POST['bayar']) and ($_POST['bayar'] == 'Bayar Lunas')) { echo "selected"; } ?>>Bayar Lunas</option>
                    <option value="DP" <?php if (isset($_POST['bayar']) and ($_POST['bayar'] == 'DP')) { echo "selected"; } ?> >DP (30%)</option>
                  </select>
                  <?php
                }
                if (isset($_POST['bayar'])) {
                  if ($_POST['bayar'] == "DP") {

                    $totalbelanja2 = $totalbelanja2*0.30;
                  }
                  
                }
                echo "<form method='post'>";
                $totalh = $totalbelanja1+$totalbelanja2;
                ?>
                <br><br><br>
                <div>
                  <table class="identity">
                    <tr>
                      <td class="identity" width="20%">Nama Pemesan </td>
                      <td class="identity">: <?php echo $_SESSION['user']['namaUser']; ?></td>
                    </tr>

                    <tr>
                      <td class="identity">No. Telepon </td>
                      <td class="identity">: <?php echo $_SESSION['user']['Telp']; ?></td>
                    </tr>

                    <tr>
                      <td class="identity" colspan="2">
                        Alamat Pengiriman : <br> 
                        <textarea name="alamat" rows="2" cols="40"><?php echo $_SESSION['user']['Alamat']; ?></textarea>
                      </td>
                    </tr>

                    <tr>
                      <td class="identity" colspan="2">
                        Keterangan (Optional) : <br> 
                        <textarea name="ket" rows="2" cols="40"></textarea>
                      </td>
                    </tr>
                  </table>
                  <br>
                  <br>
                  <br>
                  
                </div>

                <div align="right"><strong><h2>Total Harga : Rp. <?php echo number_format($totalh); ?></h2></strong></div>
              </div>
              <div style="text-align: right;">
                <a href="cart.php" class="tombolR">
                  Kembali
                </a>
                <button name="checkout" class="tombolB">Checkout</button>
              </div>
            </form>
          </div>  
        </div>
      </div>
      <br><br>  
    </center>

    <?php
    if(isset($_POST["checkout"]))
    {
      $today  = date('dmy');
      $query = "SELECT max(kdTransaksi) as maxKode FROM transaksi where kdTransaksi LIKE '%".$today."%'";
      $hasil = mysqli_query($koneksi,$query);
      $data = mysqli_fetch_array($hasil);
      $kodetransaksi = $data['maxKode'];
      $noUrut = (int) substr($kodetransaksi, 8, 11);
      $noUrut++;
      $char = 'TR';

      $kodetrf = $char.$today.str_pad($noUrut, 3, "0", STR_PAD_LEFT);
      if (is_null($data)) {
        $kodetrf = 'TR'.$today.'001';
      }

      $query = "SELECT max(kdJual) as maxKode FROM jual";
      $hasil = mysqli_query($koneksi,$query);
      $data = mysqli_fetch_array($hasil);
      $kdjual = $data['maxKode'];
      if (is_null($kdjual)) {
        $kdjual = '0';
      }

      $query = "SELECT max(kdSewa) as maxKode FROM sewa";
      $hasil = mysqli_query($koneksi,$query);
      $data = mysqli_fetch_array($hasil);
      $kdsewa = $data['maxKode'];
      if (is_null($kdsewa)) {
        $kdsewa = '0';
      }

      $query = "SELECT max(kdDetSewa) as maxKode FROM detailsewa";
      $hasil = mysqli_query($koneksi,$query);
      $data = mysqli_fetch_array($hasil);
      $kdDetSewa = $data['maxKode'];
      if (is_null($kdDetSewa)) {
        $kdDetSewa = '0';
      }

      
      $Keterangan = $_POST['ket'];
      $status = "Menunggu Pembayaran";

      $tgl_beli = date("y-m-d");
      $iduser = $_SESSION['user']['idUser'];
      $alamat = $_POST['alamat'];

      $ambil = mysqli_query($koneksi,"insert into transaksi 
        values('$kodetrf','$tgl_beli','$totalbelanja1','$totalbelanja2','$totalh','$Keterangan','$status','$alamat','','$iduser')");

      if(isset($_SESSION['keranjang']['Beli']) and !empty($_SESSION['keranjang']['Beli'])){
        foreach ($_SESSION['keranjang']['Beli'] as $id_produk => $jumlah) :
          $kdjual++;
        $ambil = mysqli_query($koneksi,"select * from barang where idBrg='$id_produk'");
        if ($ambil)
        {
          $pecah = mysqli_fetch_assoc($ambil);
          $nama = $pecah['namaBrg'];
          $harga = $pecah['hargaBrg'];

          $subharga = $pecah['hargaBrg']*$jumlah;
        }
        $ambil = mysqli_query($koneksi,"insert into jual
          values ('$kdjual','$jumlah','$subharga','$kodetrf','$id_produk')");

        $ambil=mysqli_query($koneksi,"update barang set stockBrg=stockBrg-$jumlah where idBrg='$id_produk'");
        endforeach;

        unset($_SESSION['keranjang']['Beli']);

      }
      if(isset($_SESSION['keranjang']['Sewa']) and !empty($_SESSION['keranjang']['Sewa'])){

        $tipe = $_POST['bayar'];
        $kdsewa++;
        
        $ambil = mysqli_query($koneksi,"insert into sewa
          values ('$kdsewa','$tipe','','$kodetrf')");

        foreach ($_SESSION['keranjang']['Sewa'] as $id_produk => $jumlah):
          $kdDetSewa++;
        $lama = $_SESSION['keranjang']['lama'][$id_produk];
        $tgl_balik = date('Y-m-d', strtotime('+'.$lama.' days', strtotime($tgl_beli)));

        $ambil = mysqli_query($koneksi,"select * from barang where idBrg='$id_produk'");
        if ($ambil)
        {
          $pecah = mysqli_fetch_assoc($ambil);
          $nama = $pecah['namaBrg'];
          $harga = $pecah['hargaBrg'];

          $subharga = $pecah['hargaSewa']*$jumlah;
        }

        $ambil = mysqli_query($koneksi,"insert into detailsewa
          values ('$kdDetSewa','$tgl_beli','$tgl_balik','$lama','$jumlah','$subharga','$kdsewa','$id_produk')");

        $ambil=mysqli_query($koneksi,"update barang set stockBrg=stockBrg-$jumlah where idBrg='$id_produk'");
        endforeach;

        unset($_SESSION['keranjang']['Sewa']);
        unset($_SESSION['keranjang']['lama']);


      }

      echo '<script>
      swal({
        title: "Berhasil!",
        text: "Pembelian Sukses!",
        icon: "success",
      }).then((value) => {
        window.location = "menungguUp.php";
      });</script>';
    }


    ?>

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