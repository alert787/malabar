<?php
session_start();
require "../config.php";
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
    .div100 {width: 100%}
    .div33a {
      width: 33%; 
      padding: 5%;
      display: 
      inline-block;
      vertical-align: top;
      text-align: center;
    }

    .div33b {
      width: 33%; 
      height: 100%;
      padding: 5%;
      border-left: 1px solid #7f8c8d;
      border-right: 1px solid #7f8c8d;
      display: inline-block;
      vertical-align: top;
      text-align: center;
    }
    .tombol {padding: 10px; color: black; width: 100%; text-align: left; padding-right: 50px}
    .tombol:hover {background-color: rgba(52, 152, 219,1.0); color: white; width: 100%; font-weight: bold;}
    .tombolR {padding-left: 25px; padding-right: 25px; padding-top: 5px; padding-bottom: 5px; color: white; background-color: red; border : 1px solid rgba(0,0,0,0); border-radius: 10px;}
    .tombolR:hover {background-color: #c0392b; font-weight: bold;}
    .tombolB {padding-left: 25px; padding-right: 25px; padding-top: 5px; padding-bottom: 5px; color: white; background-color: #3498db; border : 1px solid rgba(0,0,0,0); border-radius: 10px;}
    .tombolB:hover {background-color: #6c5ce7; font-weight: bold;}
    .boxshad {box-shadow: 5px 5px 5px rgb(200,200,200);}
    .boxtr {display: inline-block; padding: 20px; background-color: #ecf0f1}
    .kolom1 {vertical-align: top; padding-right: 10px;}
    .kolom2 {vertical-align: top; padding-left: 4px; padding-right: 4px;}
    .kolom3 {padding-left: 4px; text-align: justify;}
    div.fileUpload {
      position: relative;
      overflow: hidden;
      margin: 10px;
    }
    div.fileUpload input.upload {
      position: absolute;
      top: 0;
      right: 0;
      margin: 0;
      padding: 0;
      font-size: 20px;
      cursor: pointer;
      opacity: 0;
      filter: alpha(opacity=0);
    }

    table {
      border-collapse: collapse;
      width: 100%
    }

    td,th {
      padding: 10px;
      text-align: left;
    }
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
  $sewa = false;
  $beli = false;
  $kdTransaksi = $_GET['id'];
  $transaksi = mysqli_query($koneksi,"select * from transaksi where kdTransaksi='$kdTransaksi'");
  if ($transaksi)
  {
   $trf = mysqli_fetch_assoc($transaksi);
   if ($trf['idUser'] !== $_SESSION['user']['idUser']) {
    echo '<script>window.location = "notuser.php?id=2";</script>';
  }
}
?>
<br><br>
<center>
  <div style="width: 90%">
    <div style="display: inline-block; width: 49.5%; font-size: 24px; font-weight: bolder; text-align: left;">
      ID TRANSAKSI : <?php echo $trf['kdTransaksi']; ?>
    </div>
    <div style="display: inline-block; width: 49.5%; font-size: 24px; font-weight: bolder; text-align: right;">
      Status : <font color="red"><?php echo $trf['status']; ?></font>
    </div>

    <strong><h2 align="right">Sub Total : Rp. <?php echo number_format($trf['totalHarga']); ?></h2></strong>
    <hr>
  </center>

  <?php
  if ($trf['totalBayarJual'] != 0) {
    ?>
    <h3 style="margin-left: 70px">Pembelian</h3>
    <br>
    <div style="margin-left: 70px">
      <?php 
      $idUser = $_SESSION['user']['idUser'];
      $ambil = mysqli_query($koneksi,"SELECT * FROM jual WHERE jual.kdTransaksi = '$kdTransaksi'"); 
      $no = 0;
      $beli = true;
      if ($ambil)
      {
        while ($pecah = mysqli_fetch_assoc($ambil)){
         ?>
         <div style="display: inline-block; width: 48%; text-align: left;">
          <div style="display: inline-block; vertical-align: top; width: 20%;">
            <?php $ambil2 = mysqli_query($koneksi,"SELECT Foto,namaBrg,hargaBrg from barang where idBrg = '$pecah[idBrg]'");
            if ($ambil2) {
              $pecah2 = mysqli_fetch_assoc($ambil2);
            }
            ?>

            <img src="../images/product/<?php echo $pecah2['Foto']; ?>" style="width: 100%"><br>
            <div style="text-align: center; vertical-align: middle;">
            </div>
          </div>
          <div style="display: inline-block; width: 79%; padding-left: 10px;">

            <table>
              <tr>
                <td colspan="3"><?php echo $pecah2['namaBrg']; ?></td>
              </tr>
              <tr>
                <td class="kolom1">QTY</td>
                <td class="kolom2">:</td>
                <td class="kolom3"><?php echo $pecah['jmlhBrg']; ?></td>
              </tr>

              <tr>
                <td class="kolom1">Harga</td>
                <td class="kolom2">:</td>
                <td class="kolom3"><?php echo "Rp. ",number_format($pecah2['hargaBrg']); ?></td>
              </tr>

              <tr>
                <td class="kolom1">Total</td>
                <td class="kolom2">:</td>
                <td class="kolom3">Rp. <?php echo number_format($pecah2['hargaBrg']*$pecah['jmlhBrg']); ?></td>
              </tr>
            </table>
          </div>
        </div>
        <?php 
        if ($no % 2) { ?>
        <br><br><br>
        <?php }
        else{
          ?>
          <div style="display: inline-block; width: 3%;"></div>
          <?php }
          $no++;
        }
      }
      ?>
      <hr>
    </div>
    <?php
  }
  if ($trf['totalBayarSewa'] != 0) {
    ?>
    <h3 style="margin-left: 70px">Penyewaan</h3>
    <br>
    <div style="margin-left: 70px">
      <?php 
      $idUser = $_SESSION['user']['idUser'];
      $ambil = mysqli_query($koneksi,"SELECT * FROM sewa join detailsewa on sewa.kdSewa = detailsewa.kdSewa WHERE sewa.kdTransaksi = '$kdTransaksi'"); 
      $no = 0;
      $sewa = true;
      if ($ambil)
      {
        while ($pecah = mysqli_fetch_assoc($ambil)){
         ?>
         <div style="display: inline-block; width: 48%; text-align: left;">
          <div style="display: inline-block; vertical-align: top; width: 20%;">
            <?php $ambil2 = mysqli_query($koneksi,"SELECT Foto,namaBrg,hargaSewa from barang where idBrg = '$pecah[idBrg]'");
            if ($ambil2) {
              $pecah2 = mysqli_fetch_assoc($ambil2);
            }
            ?>

            <img src="../images/product/<?php echo $pecah2['Foto']; ?>" style="width: 100%"><br>
            <div style="text-align: center; vertical-align: middle;">
            </div>
          </div>
          <div style="display: inline-block; width: 79%; padding-left: 10px;">
            <?php echo $pecah2['namaBrg']; ?>
            <table>
              <tr>
                <td class="kolom1">QTY</td>
                <td class="kolom2">:</td>
                <td class="kolom3"><?php echo $pecah['jmlhBrg']; ?></td>
              </tr>

              <tr>
                <td class="kolom1">Harga</td>
                <td class="kolom2">:</td>
                <td class="kolom3"><?php echo "Rp. ",number_format($pecah2['hargaSewa']); ?></td>
              </tr>

              <tr>
                <td class="kolom1">Total</td>
                <td class="kolom2">:</td>
                <td class="kolom3"><?php echo "Rp. ",number_format($pecah2['hargaSewa']*$pecah['jmlhBrg']); ?></td>
              </tr>

              <tr>
                <td class="kolom1">Tanggal Sewa</td>
                <td class="kolom2">:</td>
                <td class="kolom3"><?php echo date("d-M-Y", strtotime($pecah['tglSewa']))," - ",date("d-M-Y", strtotime($pecah['tglKembali'])); ?></td>
              </tr>

              <tr>
                <td class="kolom1">Tipe Pembayaran</td>
                <td class="kolom2">:</td>
                <td class="kolom3"><?php echo $pecah['statusBayar']; ?></td>
              </tr>              
            </table>
          </div>
        </div>
        <?php 
        if ($no % 2) { ?>
        <br><br><br>
        <?php }
        else{
          ?>
          <div style="display: inline-block; width: 3%;"></div>
          <?php }
          $no++;
        }
      }
      ?>
      <hr>
    </div>
    <?php
  }
  ?>

</div>
<div style="margin-left: 70px">
  <div class="div100">
    <div class="div33a">
      <h3>Pelanggan</h3>
      <br>
      <table>
        <tr>
          <td>Nama User</td>
          <td>
            : <strong><?php echo $_SESSION['user']['namaUser']; ?></strong><br>
          </td>
        </tr>

        <tr>
          <td>No Telp</td>
          <td>
           : <?php echo $_SESSION['user']['Telp']; ?>
         </td>
       </tr>

       <tr>
        <td>Alamat</td>
        <td>: <?php echo $_SESSION['user']['Email']; ?></td>
      </tr>
    </table>
  </div>

  <div class="div33b">
    <?php 
    if ($beli == true) { ?>
    <h3>Pengiriman</h3><br>
    <table>
      <tr>
        <td>Alamat</td>
        <td>: <?php echo $_SESSION['user']['Alamat']; ?></td>
      </tr>
      <tr>
        <td>Keterangan</td>
        <td>: <?php echo $trf['keterangan']; ?></td>
      </tr>
    </table>
    <?php }  ?>
  </div>

  <?php 
  if ($trf['status'] == 'Transaksi Selesai') {
    $ulasan = mysqli_query($koneksi,"select komen,rating from testi where kdTransaksi = '$kdTransaksi'");
    $komen = mysqli_fetch_assoc($ulasan);
    ?>
    <div class="div33a">
      <h3>Testimoni</h3>
      <br>
      <table>
        <tr>
          <td width="10%">Ulasan</td>
          <td width="5%">:</td>
          <td><?php echo $komen['komen']; ?></td>
        </tr>

        <tr>
          <td>Rating</td>
          <td>:</td>
          <td>
            <?php 
            if ($komen['rating'] != 0 ) {
              echo $komen['rating'];
            } ?>        
          </td>
        </tr>
      </table>
      <?php
    }?> 
  </div>

  <form method="post" enctype="multipart/form-data">
    <?php
    if ($trf['status'] == 'Menunggu Pembayaran') {
      if ($sewa == true) {
        ?>
        <div align="right" style="margin-right: 70px">
          <label>Foto Jaminan (Kartu Identitas)</label>
          <input id="uploadFile" placeholder="Pilih File..." disabled="disabled" />
          <div class="fileUpload btn btn-primary">
            <span>Upload</span>
            <input id="uploadBtn" type="file" class="upload" name="identitas" />
          </div>
        </div>
        <?php    
      }
      ?>
      <div align="right" style="margin-right: 70px">
        <label>Foto Bukti</label>
        <input id="uploadFile2" placeholder="Pilih File..." disabled="disabled" />
        <div class="fileUpload btn btn-primary">
          <span>Upload</span>
          <input id="uploadBtn2" type="file" class="upload" name="bukti" />
        </div>
      </div><br>
      <div align="right" style="margin-right: 80px">
        <label>File tidak boleh lebih dari 1MB</label>
        <button name="kirim" class="btn btn-success">Kirim</button>
      </div>
      <?php
    }
    else if(($trf['status'] == 'Terkonfirmasi') or ($trf['status'] == 'Terkonfirmasi Pengembalian')){
      ?>

      <div align="left">
        <label>Ulasan (Opsional)</label><br>
        <textarea name="ulasan" rows="2" cols="40"></textarea><br><br>
        <select name="rating"><br><br>
          <option>Rating</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
        <br><br>
        <label>Klik tombol dibawah apabila transaksi telah selesai.</label><br>
        <button name="terima" class="btn btn-success">Transaksi Selesai</button>
      </div>
      <?php  
    }
    ?>
  </form>
  
  
</div> <?php

if (in_array($trf['status'], array('Menunggu Konfirmasi Seller','Transaksi Selesai','Terkonfirmasi','Menunggu Pelunasan','Menunggu Pengembalian','Terkonfirmasi Pengembalian'))) {
  ?>
  <hr><br>
  <center>
    <h3>Bukti Pembayaran</h3><br><br>
    <div>
      <img src="../images/bukti/<?php echo $trf['fotoPembayaran']; ?>" width="40%" height="60%">
      <?php
      if ($sewa == true) { 
        $foto = mysqli_query($koneksi, "SELECT fotoJaminan FROM sewa where sewa.kdTransaksi = '$kdTransaksi'");
        $pic = mysqli_fetch_assoc($foto);
        ?>

        <img src="../images/identitas/<?php echo $pic['fotoJaminan']; ?>" width="40%" height="60%">
      </div>

    </center>
    <?php
  }
}
?>
</div>
</div>

<?php
if (isset($_POST['kirim'])) {
  if ($sewa == true) {
    $identitas = $_FILES["identitas"]["name"];
    $ukuran = $_FILES['identitas']['size'];
    $format = pathinfo($identitas, PATHINFO_EXTENSION);
    if($ukuran >= 1024000)
    {
      echo '<script>
      swal({
        title: "Oops!",
        text: "File tidak boleh lebih besar dari 1MB",
        icon: "error",
      });</script>';
      die;
    }

    else if(($format != "jpg") and ($format != "png"))
    {
      echo '<script>
      swal({
        title: "Oops!",
        text: "File harus berformat jpg atau png",
        icon: "error",
      });</script>';
      die;
    }

    $lok = $_FILES['identitas']['tmp_name'];
    $beda = date("YmdHis").$identitas;
    move_uploaded_file($lok, "../images/identitas/$beda");

    $ambil=mysqli_query($koneksi,"update sewa set `fotoJaminan`= '$beda' where kdTransaksi='$kdTransaksi'");
  }

  $bukti = $_FILES["bukti"]["name"];
  $size = $_FILES['bukti']['size'];
  $format = pathinfo($bukti, PATHINFO_EXTENSION);
  if($size >= 1024000)
  {
    echo '<script>
    swal({
      title: "Oops!",
      text: "File tidak boleh lebih besar dari 1MB",
      icon: "error",
    });</script>';
    die;
  }

  else if(($format != "jpg") and ($format != "png"))
  {
    echo '<script>
    swal({
      title: "Oops!",
      text: "File harus berformat jpg atau png",
      icon: "error",
    });</script>';
    die;
  }

  $lokasi = $_FILES['bukti']['tmp_name'];
  $namabeda = date("YmdHis").$bukti;
  move_uploaded_file($lokasi, "../images/bukti/$namabeda");

  $ambil=mysqli_query($koneksi,"update transaksi set `status`='Menunggu Konfirmasi Seller',`fotoPembayaran`= '$namabeda' where kdTransaksi='$kdTransaksi'");
  echo '<script>
  swal({
    title: "Berhasil!",
    text: " Silahkan tunggu konfirmasi dari admin!",
    icon: "success",
  }).then((value) => {
    window.location = "menungguKon.php";
  });</script>';
}

if (isset($_POST['terima'])) {

  $ulasan = $_POST['ulasan'];
  $rating = $_POST['rating'];
  $ambil=mysqli_query($koneksi,"INSERT INTO `testi` VALUES (NULL, '$ulasan', '$rating','UnFavorite', '$kdTransaksi')");
  $ambil=mysqli_query($koneksi,"update transaksi set `status`='Transaksi Selesai' where kdTransaksi='$kdTransaksi'");
  echo '<script>
  swal({
    title: "Berhasil!",
    text: " Transaksi telah selesai, terima kasih telah berbelanja.",
    icon: "success",
  }).then((value) => {
    window.location = "terkonfirmasi.php";
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
<script type="text/javascript">
  document.getElementById("uploadBtn2").onchange = function () {
    document.getElementById("uploadFile2").value = this.value;
  };

  document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.value;
  };

</script>

</body>
</html>