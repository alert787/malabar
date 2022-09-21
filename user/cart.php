<?php
session_start();
require "../config.php";

$subtotal=0;
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
    .tombol:hover {background-color: rgba(52, 152, 219,1.0); color: white; width: 100%;}
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
          <a class="navbar-brand logo_h" href="index.html">
            <div>
              <img src="img/icon.png" alt="" width="8%">
              <span style="padding-left: 15px; font-weight: bolder;">MALABAR OUTDOOR</span>
            </div>  
          </a>

          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
              <?php
              if (isset($_SESSION['user'])) {

                if ($_SESSION['user']['role'] == 'pemilik toko') {
                  echo '<li class="nav-item"><a class="nav-link" href="../admin/html/owner/index.php">Admin</a></li>';
                }
                elseif ($_SESSION['user']['role'] == 'bagian keuangan') {
                  echo '<li class="nav-item"><a class="nav-link" href="../admin/html/keuangan/index.php">Admin</a></li>';
                }
              }
              else{
                echo '<li class="nav-item"><a class="nav-link" href="../index.php">Beranda</a></li>';
              }
              ?>
              <li class="nav-item"><a class="nav-link" href="product.php">Produk</a></li>
              <li class="nav-item"><a class="nav-link" href="cart.php">Transaksi</a></li>
              <?php
              if (!isset($_SESSION['user'])) {

                echo '<li class="nav-item"><a class="nav-link" href="../login.php">Login</a></li>';
                
              }
              else
              {
                ?>
                <li class="nav-item"><a class="nav-link" href="account.php">Akun</a></li>
                <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>

                <?php
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
    <h2>Keranjang Belanja</h2>  
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
        <div style="text-align: left; padding : 25px; vertical-align: top;">

          <?php

          if(isset($_SESSION['keranjang']['Beli']) and !empty($_SESSION['keranjang']['Beli'])){
           foreach ($_SESSION['keranjang']['Beli'] as $id_produk => $jumlah): ?>
           <?php $ambil = mysqli_query($koneksi,"select * from barang where idBrg='$id_produk'");
           if ($ambil)
           {
            $pecah = mysqli_fetch_assoc($ambil);
            $subharga = $pecah['hargaBrg']*$jumlah;
          }
          ?>
          <div id="produk<?php echo $pecah['idBrg']; ?>">
            <p id="hasil"></p>
            <div style="display: inline-block; border : 1px solid black; width: 20%; vertical-align: top;">
              <img src="../images/product/<?php echo $pecah['Foto']; ?>" style="width: 100%">
            </div>

            <div style="display: inline-block; width: 70%; padding-left: 35px">
              <table width="75%">
                <tr>
                  <td width="30%"></td>
                  <td width="5%"></td>
                  <td width="75%"></td>
                </tr>
                <tr>
                  <td>Kode Barang</td>
                  <td>:</td>
                  <td><?php echo $pecah['idBrg']; ?></td>
                </tr>

                <tr>
                  <td>Nama Barang</td>
                  <td>:</td>
                  <td><a href="detailbrg.php?id=<?php echo $pecah['idBrg']; ?>"><?php echo $pecah['namaBrg']; ?></a></td>
                </tr>

                <tr>
                  <td>Keterangan</td>
                  <td>:</td>
                  <td><?php if ($pecah['hargaBrg'] == 0) {
                    $status = 'Sewa';
                    echo $status;  
                  }elseif ($pecah['hargaSewa']==0) {
                    $status = 'Beli';
                    echo $status;
                  } ?></td>
                </tr>

                <tr>
                  <td>Jumlah</td>
                  <td>:</td>
                  <td><?php echo $jumlah; ?> unit</td>
                </tr>

                <tr>
                  <td>Harga</td>
                  <td>:</td>
                  <td><?php echo "Rp. ",number_format($pecah['hargaBrg']); ?></td>
                </tr>

                <tr>
                  <td>Sub Total</td>
                  <td>:</td>
                  <td><?php echo "Rp. ",number_format($subharga); ?>
                  </td>
                </tr>

              </table>
            </div>
            <div align="right">
              <button onclick="deletedata('<?php echo $pecah['idBrg']; ?>','<?php echo $status; ?>')" class="btn btn-black">Hapus Barang</button>
            </div>
            <br><hr><br>
          </div>
        <?php endforeach;
      }
      if (isset($_SESSION['keranjang']['Sewa']) and !empty($_SESSION['keranjang']['Sewa'])) {
        foreach ($_SESSION['keranjang']['Sewa'] as $id_produk => $jumlah): ?>
        <?php $ambil = mysqli_query($koneksi,"select * from barang where idBrg='$id_produk'");
        if ($ambil)
        {
          $pecah = mysqli_fetch_assoc($ambil);
          $subharga2 = $pecah['hargaSewa']*$jumlah;
        }
        ?>
        <div id="produk<?php echo $pecah['idBrg']; ?>">
          <p id="hasil"></p>
          <div style="display: inline-block; border : 1px solid black; width: 20%; vertical-align: top;">
            <img src="../images/product/<?php echo $pecah['Foto']; ?>" style="width: 100%">
          </div>

          <div style="display: inline-block; width: 70%; padding-left: 35px">
            <table width="75%">
              <tr>
                <td width="30%"></td>
                <td width="5%"></td>
                <td width="75%"></td>
              </tr>
              <tr>
                <td>Kode Barang</td>
                <td>:</td>
                <td><?php echo $pecah['idBrg']; ?></td>
              </tr>

              <tr>
                <td>Nama Barang</td>
                <td>:</td>
                <td><a href="detailbrg.php?id=<?php echo $pecah['idBrg']; ?>"><?php echo $pecah['namaBrg']; ?></a></td>
              </tr>

              <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><?php if ($pecah['hargaBrg'] == 0) {
                  $status = 'Sewa';
                  echo $status;  
                }elseif ($pecah['hargaSewa']==0) {
                  $status = 'Beli';
                  echo $status;
                } ?></td>
              </tr>

              <tr>
                <td>Jumlah</td>
                <td>:</td>
                <td><?php echo $jumlah; ?> unit</td>
              </tr>

              <tr>
                <td>Harga</td>
                <td>:</td>
                <td><?php echo "Rp. ",number_format($pecah['hargaSewa']); ?></td>
              </tr>

              <tr>
                <td>Sub Total</td>
                <td>:</td>
                <td><?php echo "Rp. ",number_format($subharga2); ?>
                </td>
              </tr>
              <tr>
                <td>Lama Sewa</td>
                <td>:</td>
                <td><?php echo $_SESSION["keranjang"]['lama'][$id_produk]; ?> Hari</td>
              </tr>
            </table>
          </div>
          <div align="right">
            <button onclick="deletedata('<?php echo $pecah['idBrg']; ?>','<?php echo $status; ?>')" class="btn btn-black">Hapus Barang</button>
          </div>
          <br><hr><br>
        </div>
      <?php endforeach; 
    }
    ?>
  </div>
  <?php
  if((empty($_SESSION["keranjang"]['Beli']) and empty($_SESSION["keranjang"]["Sewa"])) or (!isset($_SESSION["keranjang"]['Beli']) and
    !isset($_SESSION["keranjang"]['Sewa'])))
  {
    echo "<center>TIDAK ADA BARANG DIDALAM KERANJANG</center>";
  }
  else
  {
    ?>
    <div style="text-align: right;">
      <button id="tombol" class="tombolR">
        Batalkan Semua
      </button>

      <a href="checkout.php" class="tombolB">
        Checkout
      </a>
    </div>
    <?php
  }
  ?>
</div>  
</div>

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
<script>
 function deletedata(str,str2){
  swal({
    title: "Anda Yakin?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      var id = str;
      var id2 = str2;
      $.ajax({
       type: "GET",
       url: "hapuskeranjang.php?id="+id+"&status="+id2
     }).done(function( data ) {
      viewdata();

    });
     $("#produk"+id).fadeOut("slow");
   }
 });
}
</script>

<script type="text/javascript">
  $(document).ready(function() {

   $("#tombol").click(function() {
     swal({
      title: "Anda Yakin?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
     .then((willDelete) => {
      if (willDelete) {
        $.ajax({
         type: "GET",
         url: "hapuskeranjang.php?id=semua"
       }).done(function( data ) {
        alert('Semua barang telah dihapus. Silahkan pilih barang terlebih dahulu');
        location='product.php';
        viewdata();

      });
     }
   });
   })

 });
</script>
</body>
</html>