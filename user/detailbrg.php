<?php
session_start();
include "../config.php";
ini_set('display_errors', 1);


$id_produk = $_GET['id'];

$ambil = mysqli_query($koneksi,"select * from barang where idBrg='$id_produk'");
if ($ambil)
{
  $pecah = mysqli_fetch_assoc($ambil);
}
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
  <script type="text/javascript" src="js/sweetalert.min.js"></script>

  <style type="text/css">
    .inblock {display: inline-block;}
    .konten {padding-left: 25px; padding-right: 25px; vertical-align: middle;}
    .tombolb {
      color: white; 
      background-color: black;
      text-align: center; 
      border : 2px solid black;
      padding-top: 5px;
      padding-bottom: 5px;
      padding-right: 35px;
      padding-left: 35px;
    }

    .tombolb:hover {background-color: #f1c40f; color: white;}

    .tombolw {
      color: black; 
      background-color: white;
      text-align: center; 
      border : 2px solid #34495e;
      padding-top: 5px;
      padding-bottom: 5px;
      padding-right: 35px;
      padding-left: 35px;
    }

    .tombolw:hover {background-color: #3498db; color: white;}

    .tombolr {
      color: white; 
      background-color: #ED4C67;
      text-align: center; 
      padding-top: 10px;
      padding-bottom: 10px;
      padding-right: 20px;
      padding-left: 20px;
    }

    .tombolb:hover {background-color: #3498db;}

    .boxshad {box-shadow: 5px 5px 5px rgb(200,200,200);}
    .boxtr {display: inline-block; padding: 20px; background-color: #ecf0f1}
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

              $query = "select sum(jmlhBrg) jb from jual where idBrg = '$id_produk'";
              $mysql = mysqli_query($koneksi, $query);
              $array = mysqli_fetch_assoc($mysql);
              $jb = $array['jb'];

              $query2 = "select sum(jmlhBrg) jb from detailsewa where idBrg = '$id_produk'";
              $mysql2 = mysqli_query($koneksi, $query2);
              $array2 = mysqli_fetch_assoc($mysql2);
              $sb = $array2['jb'];

              if (is_null($jb)) {
                $jb = 0;  
              }
              if (is_null($sb)) {
                $sb = 0;  
              }

              ?>
              <li class="nav-item"><a class="nav-link" href="product.php">Produk</a></li>
              <li class="nav-item"><a class="nav-link" href="cart.php">Transaksi</a></li>
              <li class="nav-item"><a class="nav-link" href="account.php">Akun</a></li>
              <?php
              if (isset($_SESSION['user']))
              {
                echo '<li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>';
              }
              ?>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <!--================ End Header Menu Area =================-->

  <br><br>
  <center>
    <div style="width: 90%; align-self: center;" class="inblock">
      <div class="inblock" style="height: 100%; vertical-align: top; width: 20%">  
        <div>
          <img src="../images/product/<?php echo $pecah['Foto'] ?>" style="width: 100%"> 
        </div>
      </div>
      <div class="inblock" style="width: 5%"></div>
      <div style="width: 74%; display : inline-block; text-align: left;">
        <p style="font-size: 32px; font-weight: bold; color: black;"><?php echo $pecah['namaBrg'] ?></p>
        <div style="margin-top: -20px; vertical-align: middle;">

          <div class="inblock konten">
            <?php echo $jb; ?> Terjual
          </div> |

          <div class="inblock konten">
            <?php echo $sb; ?> Tersewakan
          </div>
        </div>

        <div style="margin-top: 30px">
          <?php if ($pecah['hargaSewa'] == '0') { ?>
          <div class="inblock" style="padding-right: 150px;">
            <p style="font-size: 24px; font-weight: bold; color: #e74c3c;">Harga jual</p>
            <p style="font-size: 28px; font-weight: bolder; margin-top: -20px">Rp. <?php echo number_format($pecah['hargaBrg']) ?></p>
            <p style="margin-top: -20px">Tersisa  <?php echo $pecah['stockBrg'] ?> Unit</p>
          </div>

          
          <?php
        } if ($pecah['hargaBrg'] == '0') { ?>
        <div class="inblock">
          <p style="font-size: 24px; font-weight: bold; color: #3498db;">Harga sewa</p>
          <p style="font-size: 28px; font-weight: bolder; margin-top: -20px">Rp. <?php echo number_format($pecah['hargaSewa']) ?></p>
          <p style="margin-top: -20px">Tersisa <?php echo $pecah['stockBrg'] ?> Unit</p>
        </div>
        <?php } ?>
      </div>
      <br>
      <form method="post">
        <input type="number" min="1" name="jumlah" max="<?php echo $pecah['stockBrg'] ?>" style="margin-top: -50px" 
        <?php
        if (isset($_SESSION['keranjang']['Beli'][$id_produk])) {
          echo "value='",$_SESSION['keranjang']['Beli'][$id_produk],"'";
        }else if (isset($_SESSION['keranjang']['Sewa'][$id_produk])){
          echo "value='",$_SESSION['keranjang']['Sewa'][$id_produk],"'";
        }else{
          echo "placeholder = 'Jumlah'";
        }
        ?>
        >
        <?php if ($pecah['hargaSewa'] != 0) {
         ?>
         <br><br>
         <input type="number" min="1" name="lama" max="30" style="margin-top: -50px" 
         <?php if (isset($_SESSION['keranjang']['lama'][$id_produk])){
          echo "value='",$_SESSION['keranjang']['lama'][$id_produk],"'";
        }else{
          echo "placeholder = 'Lama sewa (hari)'";
        }
        ?>
        >

        <?php
      }
      ?>

      <br><p><b>Deskripsi</b></p>
      <p style="text-align: justify;"><?php echo $pecah['Deskrip'] ?></p>

      <div style="width: 100%; text-align: right;">

        <table style="width: 100%; text-align: right;">
          <tr>

            <?php if ($pecah['hargaSewa'] == '0') { ?>

            <td width="70%"></td>
            <td width="18%">
              <button class="tombolb" name="beli">Beli</button>
            </td>

            <?php } if ($pecah['hargaBrg'] == '0') { ?>

            <td width="2%"></td>
            <td width="18%">
              <button class="tombolw" name="sewa">Sewa</button>
            </td>

            <?php } ?>

          </tr>
        </table>
      </form>
    </div>
  </div> 


</div>

<br><br>  
</center>


<!--================ End footer Area  =================-->

<?php
if (isset($_POST["beli"])) {

  if(isset($_POST["jumlah"]))
  {
    $jumlah = $_POST["jumlah"];
    if ($jumlah > $pecah['stockBrg']) {
      echo '<script>
      swal({
        title: "Oops!",
        text: "Barang yang dipesan melebihi stok yang ada",
        icon: "error",
      });</script>';
      die;
    }
    else if (empty($_POST['jumlah'])) {
      echo '<script>
      swal({
        title: "Oops!",
        text: "Silahkan isi jumlah barang yang akan dipesan",
        icon: "error",
      });</script>';
      die;
    }

  }

  if(isset($_SESSION['keranjang']['Beli'][$id_produk]))
  {
    if ($jumlah > $pecah['stockBrg']) {
      echo '<script>
      swal({
        title: "Oops!",
        text: "Barang yang dipesan melebihi stok yang ada",
        icon: "error",
      });</script>';
      die;
    }
    else
    {
      $_SESSION['keranjang']['Beli'][$id_produk]=$jumlah;
      echo '<script>
      swal({
        title: "Berhasil!",
        text: "Barang yang dipesan telah dimasukkan ke keranjang",
        icon: "success",
      });</script>';
    }
  }
  else
  {
    $_SESSION['keranjang']['Beli'][$id_produk]=$jumlah;
    echo '<script>
    swal({
      title: "Berhasil!",
      text: "Barang yang dipesan telah dimasukkan ke keranjang",
      icon: "success",
    });</script>';
  }
}

if (isset($_POST["sewa"])) {

  if(isset($_POST["jumlah"]))
  {
    $jumlah = $_POST["jumlah"];
    if (empty($_POST['jumlah'])) {
      echo '<script>
      swal({
        title: "Oops!",
        text: "Silahkan isi jumlah barang yang akan dipesan",
        icon: "error",
      });</script>';
      die;
    }
    if (empty($_POST['lama'])) {
      echo '<script>
      swal({
        title: "Oops!",
        text: "Silahkan isi lama sewa dari barang yang akan dipesan",
        icon: "error",
      });</script>';
      die;
    }

  }

  if(isset($_SESSION['keranjang']['Sewa'][$id_produk]))
  {
    if ($jumlah > $pecah['stockBrg']) {
      echo '<script>
      swal({
        title: "Oops!",
        text: "Barang yang dipesan melebihi stok yang ada",
        icon: "error",
      });</script>';
      die;
    }
    else{
      $_SESSION['keranjang']['Sewa'][$id_produk]=$jumlah;
      $_SESSION['keranjang']['lama'][$id_produk]=$_POST['lama'];
      echo '<script>
      swal({
        title: "Berhasil!",
        text: "Barang yang dipesan telah dimasukkan ke keranjang",
        icon: "success",
      });</script>';
    }
  }

  else
  {
    $_SESSION['keranjang']['Sewa'][$id_produk]=$jumlah;
    $_SESSION['keranjang']['lama'][$id_produk]=$_POST['lama'];
    echo '<script>
    swal({
      title: "Berhasil!",
      text: "Barang yang dipesan telah dimasukkan ke keranjang",
      icon: "success",
    });</script>';
  }
}




?>

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