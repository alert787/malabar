<?php 
session_start();
include "config.php";
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>MALABAR OUTDOOR</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
  <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
  <link rel="icon" href="images/iconw.png" type="image/png">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

    <div class="top-bar py-3 bg-light" id="home-section">
      <div class="container">
        <div class="row align-items-center">

          <div class="col-6 text-left">
            <ul class="social-media">
              <li><a href="#" class=""><span class="icon-facebook"></span></a></li>
              <li><a href="#" class=""><span class="icon-twitter"></span></a></li>
              <li><a href="#" class=""><span class="icon-instagram"></span></a></li>
              <li><a href="#" class=""><span class="icon-linkedin"></span></a></li>
            </ul>
          </div>
          <div class="col-6">
            <p class="mb-0 float-right">
              <span class="mr-3"><a href="tel://#"> <span class="icon-phone mr-2" style="position: relative; top: 2px;"></span><span class="d-none d-lg-inline-block text-black">(+1) 234 5678 9101</span></a></span>
              <span><a href="#"><span class="icon-envelope mr-2" style="position: relative; top: 2px;"></span><span class="d-none d-lg-inline-block text-black">shop@yourdomain.com</span></a></span>
            </p>
            
          </div>
        </div>
      </div> 
    </div>

    <header class="site-navbar py-4 bg-white js-sticky-header site-navbar-target" role="banner">

      <div class="container">
        <div class="row align-items-center">

          <div class="col-6 col-xl-2">
            <h1 class="mb-0 site-logo"><a href="index.html" class="text-black mb-0">Malabar<span class="text-primary">.</span> </a></h1>
          </div>
          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="#home-section" class="nav-link">Home</a></li>
                <li><a href="#products-section" class="nav-link">Produk</a></li>
                <li><a href="#about-section" class="nav-link">About Us</a></li>
                <li><a href="#testimonials-section" class="nav-link">Testimoni</a></li>
                <li><a href="#home-section" class="nav-link">Kontak</a></li>
                <li><a href="user/cart.php" class="nav-link">Keranjang</a></li>
                <li>
                  <?php
                  if (isset($_SESSION['user']))
                  {
                    if ($_SESSION['user']['role'] == 'pemilik toko') {
                      echo '<a href="admin/html/owner/index.php" class="nav-link">Admin</a>';
                      echo'<a href="logout.php" class="nav-link">Logout</a>';
                    }
                    elseif ($_SESSION['user']['role'] == 'bagian keuangan') {
                      echo '<a href="admin/html/keuangan/index.php" class="nav-link">Admin</a>';
                      echo'<a href="logout.php" class="nav-link">Logout</a>';

                    }
                    else{
                      echo '<a href="user/account.php" class="nav-link">Akun</a>';
                      echo'<a href="logout.php" class="nav-link">Logout</a>';
                    }
                  }
                  else{
                    echo'<a href="login.php" class="nav-link">Akun</a>';
                  }
                  ?>
                </li>
              </ul>
            </nav>
          </div>


          <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a></div>

        </div>
      </div>

    </header>



    <div class="site-blocks-cover overlay" style="background-image: url(images/img0001.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center">

          <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">

            <div class="row mb-4">
              <div class="col-md-7">
                <h1>Shop With Us</h1>
                <p class="mb-5 lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam assumenda ea quo cupiditate facere deleniti fuga officia.</p>
                <div>
                  <a href="user/product.php" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 mb-lg-0 mb-2 d-block d-sm-inline-block">Shop Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  

    <!---------------------------------------------------------------------------->
    <!-------------------------------- PRODUK ------------------------------------>
    <!---------------------------------------------------------------------------->

    <div class="site-section" id="products-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-6 text-center">
            <h3 class="section-sub-title">PRODUK PILIHAN</h3>
            <h2 class="section-title mb-3">Our Products</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae nostrum natus excepturi fuga ullam accusantium vel ut eveniet aut consequatur laboriosam ipsam.</p>
          </div>
        </div>

        <div class="row">
          <?php
          $query = "select * from barang where hargaSewa = '0' order by rand() limit 6";
          $ambil=mysqli_query($koneksi,$query);

          if ($ambil)
          {
            while ($pecah = mysqli_fetch_assoc($ambil)) { ?>
            <div class="col-lg-4 col-md-6 mb-5">
              <div class="product-item">
                <figure>
                  <img src="images/product/<?php echo $pecah['Foto']; ?>" alt="Image" class="img-fluid">
                </figure>
                <div class="px-4">
                  <h3><a href="#"><?php echo $pecah['namaBrg']; ?></a></h3>
                  <p class="mb-4"><?php echo $pecah['jenisBrg']; ?></p>
                  <div>
                    <a onclick="cart('<?php echo $pecah['idBrg']; ?>')" class="btn btn-black mr-1 rounded-0">Cart</a>
                    <a href="user/detailbrg.php?id=<?php echo $pecah['idBrg']; ?>" class="btn btn-black btn-outline-black ml-1 rounded-0">View</a>
                  </div>
                </div>
              </div>
            </div>

            <?php
          }
        }
        ?>


      </div>

      <div align="center">
        <a href="user/product.php" class="btn btn-black mr-1 rounded-0">Produk Selengkapnya</a>
      </div> <br>
    </div>

    <!--------------------------------------------------------->
    <!--------------------- ABOUT US -------------------------->
    <!--------------------------------------------------------->

    <div class="site-blocks-cover overlay get-notification" id="about-section" style="background-image: url(images/img0004.jpg); background-attachment: fixed; background-position: top;" data-aos="fade">
      <div class="container">
        <div class="row align-items-center justify-content-center">

          <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">
                        
            <div class="row mb-4">
              <div class="col-md-7">
                <h2>Tentang Kami</h2>
                  <p style="font-size: 18px; text-align: justify; text-indent: 40px; line-height: 1.5;">
                    Selamat datang di situs resmi Malabar Outdoor. Malabar Outdoor merupakan salah satu situs toko online yang menyediakan penyewaan alat - alat camping dan juga menjual peralatan untuk kegiatan outdoor seperti kompas, hammock, matras, dsb.
                  </p>
                  <p style="font-size: 18px; text-align: justify; text-indent: 40px; line-height: 1.5;">
                    Malabar Outdoor didirikan pada tahun 2014, meskipun tergolong cukup muda tapi kami akan berusaha untuk memberikan yang terbaik dalam hal kualitas barang kepada para pelanggan. Untuk pertanyaan lebih lanjut silahkan hubungi kontak kami.
                  </p>
                  <p style="font-size: 18px; text-align: justify; text-indent: 40px; line-height: 1.5;">
                    Mengapa kami memilih nama Malabar Outdoor? Karena sesuai dengan barang dan jasa yang kami tawarkan yaitu alat - alat camping dan alat - alat outdoor. Kata "Malabar" mengacu pada nama salah satu gunung di Bandung yang sering dikunjungi untuk kegiatan hiking maupun camping sehingga tercetus untuk menyediakan jasa penyewaan alat camping, sedangkan kata "Outdoor" itu untuk barang yang dijual kebanyakan merupakan alat yang biasa digunakan untuk kegiatan diluar rumah.
                  </p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>


    <div class="site-section bg-light" id="services-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h3 class="section-sub-title">Our Services</h3>
            <h2 class="section-title mb-3">We Offer Services</h2>
          </div>
        </div>
        <div class="row align-items-stretch">
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary icon-pie_chart"></span></div>
              <div>
                <h3>Business Consulting</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary icon-backspace"></span></div>
              <div>
                <h3>Market Analysis</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary icon-av_timer"></span></div>
              <div>
                <h3>User Monitoring</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>


          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary icon-beenhere"></span></div>
              <div>
                <h3>Seller Consulting</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="400">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary icon-business_center"></span></div>
              <div>
                <h3>Financial Investment</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="500">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary icon-cloud_done"></span></div>
              <div>
                <h3>Financial Management</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!------------------------------------------------------------------------------>
    <!------------------------------- TESTIMONI ------------------------------------>
    <!------------------------------------------------------------------------------>

    <div class="site-section testimonial-wrap" id="testimonials-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h3 class="section-sub-title">People Says</h3>
            <h2 class="section-title mb-3">Testimonials</h2>
          </div>
        </div>
      </div>
      <div class="slide-one-item home-slider owl-carousel">
        <?php 
        $query = "SELECT user.idUser,user.namaUser,testi.komen,transaksi.kdTransaksi,testi.status,user.Foto FROM `testi` join transaksi on testi.kdTransaksi = transaksi.kdTransaksi join user on transaksi.idUser = user.idUser WHERE testi.status = 'Favorite' LIMIT 3";
        $ambil=mysqli_query($koneksi,$query);
        if ($ambil)
        {
          while ($pecah = mysqli_fetch_assoc($ambil)) { ?>
          <div>
            <div class="testimonial">
              <figure class="mb-4 d-block align-items-center justify-content-center">
                <div><img src="user/img/user/<?php echo $pecah['Foto']; ?>" alt="Image" class="w-100 img-fluid mb-3"></div>
              </figure>
              <blockquote class="mb-3">
              <p>&ldquo;<?php echo $pecah['komen']; ?>&rdquo;</p>
              </blockquote>
              <p class="text-black"><strong><?php echo $pecah['namaUser']; ?></strong></p>

            </div>
          </div>
          <?php
            }}
          ?>

        </div>
      </div>
    </div> <!-- .site-wrap -->

    <!------------------------------------------------------------------------------>
  <!--------------------------------- FOOTER ------------------------------------->
  <!------------------------------------------------------------------------------>
  <div style="width: 100%; background-color: rgb(50,50,50); color: white;">
    <div style="text-indent: 25px; padding-top: 10px; padding-bottom: 10px;">
      Malabar Outdoor 2019
    </div>
  </div>


  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>

  <script type="text/javascript" src="user/js/sweetalert.min.js"></script>
  <script src="js/main.js"></script>
  <script>
    function cart(str){

      swal({
        title: "Berhasil",
        text: "Barang telah ditambahkan ke keranjang",
        icon: "success",
      }).then((value) => {
        var id = str;

        $.ajax({
          type: "GET",
          url: "user/beli.php?id="+id+"&status=Beli"
        }).done(function( data ) {
          viewdata();
        });
      });

    }
  </script>

</body>
</html>