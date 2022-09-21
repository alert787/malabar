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

  <br><br>
  <h2>Ubah Data Diri</h2><br>
  <center>
    <table>
      <form method="post" enctype="multipart/form-data">
        <tr>
          <td width="25%">Nama Lengkap</td>
          <td width="5%">:</td>
          <td>
            <input type="text" name="nama" value="<?php echo $_SESSION['user']['namaUser']; ?>"></input>
          </td>

          <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>
              <input type="text" name="alamat" value="<?php echo $_SESSION['user']['Alamat']; ?>"></input>
            </td>
          </tr>

          <tr>
            <td>No. Telepon</td>
            <td>:</td>
            <td><input type="text" name="telp" value="<?php echo $_SESSION['user']['Telp']; ?>"></input></td>
          </tr>

          <tr>
            <td>E-Mail</td>
            <td>:</td>
            <td><input type="text" name="mail" value="<?php echo $_SESSION['user']['Email']; ?>"></input></td>
          </tr>

          <tr>
            <td>Foto</td>
            <td>:</td>
            <td><input id="uploadFile" placeholder="Pilih File..." disabled="disabled" />
              <div class="fileUpload btn btn-primary">
                <span>Upload</span>
                <input id="uploadBtn" type="file" class="upload" name="bukti" />
              </div></td>
            </tr>
          </tr>
        </table>

        <button class="tombol" name="simpan">Simpan</button>
      </form>
    </center>
    
    <?php
    if (isset($_POST['simpan']))
    {
      $fotolama = $_SESSION['user']['Foto'];
      $bukti = $_FILES['bukti']['name'];

      if((empty($_POST['nama'])) or (empty($_POST['mail'])) or (empty($_POST['alamat'])) or (empty($_POST['telp'])))
      {
        echo '<script>
        swal({
          title: "Oops!",
          text: "Mohon isi data dengan lengkap",
          icon: "error",
        });</script>';
        die;

      }
      $idUser = $_SESSION['user']['idUser'];
      if(!is_numeric($_POST['telp'])) {
        echo '<script>
        swal({
          title: "Oops!",
          text: "Nomor telepon harus angka",
          icon: "error",
        });</script>';
        die;
      }

      if(!filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL))
      {
        echo '<script>
        swal({
          title: "Oops!",
          text: "Email harus menyertakan @ dan nama domain",
          icon: "error",
        });</script>';
        die;
      }
      if (!empty($bukti)) {

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
        $lokasifoto = $_FILES['bukti']['tmp_name'];
        if(!empty($fotolama))
        {
          unlink("img/user/$fotolama");
        }
        move_uploaded_file($lokasifoto, "img/user/$bukti");
        $res=mysqli_query($koneksi,"update user set namaUser='$_POST[nama]',
          Email='$_POST[mail]',Telp='$_POST[telp]',Alamat='$_POST[alamat]',Foto='$bukti'
          where idUser='$idUser'");
        if($res)
        {
          unset($_SESSION["user"]);
          $ambil = mysqli_query($koneksi,"select * from user where idUser='$idUser' ");
          $pecah = mysqli_fetch_assoc($ambil);
          $_SESSION["user"]=$pecah;
          echo '<script>
          swal({
            title: "Berhasil!",
            text: "Data telah diubah",
            icon: "success",
          }).then((value) => {
            window.location = "account.php";
          });</script>';
        }
        else
        {
          echo "<script> Data Gagal Diubah</script>";
        }
        
      }
      else{
        $res=mysqli_query($koneksi,"update user set namaUser='$_POST[nama]',
          Email='$_POST[mail]',Telp='$_POST[telp]',Alamat='$_POST[alamat]'
          where idUser='$idUser'");
        if($res)
        {
          unset($_SESSION["user"]);
          $ambil = mysqli_query($koneksi,"select * from user where idUser='$idUser' ");
          $pecah = mysqli_fetch_assoc($ambil);
          $_SESSION["user"]=$pecah;
          echo '<script>
          swal({
            title: "Berhasil!",
            text: "Data telah diubah",
            icon: "success",
          }).then((value) => {
            window.location = "account.php";
          });</script>';
        }
        else
        {
          echo "<script> Data Gagal Diubah</script>";
        }
      }
      


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
      document.getElementById("uploadBtn").onchange = function () {
        document.getElementById("uploadFile").value = this.value;
      };
    </script>
  </body>
  </html>