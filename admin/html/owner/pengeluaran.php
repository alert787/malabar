<?php
session_start();
include "../../../config.php";
ini_set('display_errors', 1);

$halaman = 15;
$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
$result = mysqli_query($koneksi,"SELECT barang.idBrg, namaBrg, tglBeli, jmlhBrg, hargaBeli, subTotal FROM detailbeli JOIN beli ON beli.kdBeli = detailbeli.kdBeli JOIN barang ON barang.idBrg = detailbeli.idBrg WHERE detailbeli.kdDetBeli");
$total = mysqli_num_rows($result);
$pages = ceil($total/$halaman);   
$pagi = false;
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
    <title>Admin | Pengeluaran</title>
    <!-- Custom CSS -->
    <link href="../../assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../dist/css/style.min.css" rel="stylesheet">
    <script src="../../assets/libs/chart/chart.js"></script>

    <style type="text/css">
        body {background-color: #2a2b30;}
        .inblock {display: inline-block;}
        hr {border : 1px dashed rgba(236, 240, 241,0.5);}
        table {border-collapse: collapse; width: 90%; text-align: center; font-size: 14px; color: white; margin-top: 5%;}
        th {background-color: rgba(41, 128, 185,1.0);}
        th, td {border : 1px solid #ecf0f1; padding-top: 4px; padding-bottom: 4px;}
        tr:nth-child(even) {background-color: rgba(236, 240, 241,0.15)}
        tr:hover {background-color: rgba(52, 152, 219,0.25)}

        input[type=text] {
            padding-top: 5px; padding-bottom: 5px;
            padding-right: 15px; padding-left: 15px;
            border : 2px solid #ecf0f1;
            background-color: rgba(0,0,0,0);
            width: 40%;
            color: white;
        }

        .cari {
            margin-left: -5px;
            padding-top: 5px; padding-bottom: 5px;
            padding-right: 20px; padding-left: 20px;
            border : 2px solid #3498db;
            background-color: #3498db;
            color: white;       
        }

        .cari:hover {
            background-color: #f1c40f;
            border : 2px solid #f1c40f;
            color: white;
        }

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
                                <li class="sidebar-item"><a href="tunggukonfirmasi.php" class="sidebar-link"><i class="mdi mdi-book"></i><span class="hide-menu"> Menunggu Konfirmasi </span></a></li>
                                <li class="sidebar-item"><a href="tunggulunas.php" class="sidebar-link"><i class="mdi mdi-timer"></i><span class="hide-menu"> Menunggu Pelunasan </span></a></li>
                                <li class="sidebar-item"><a href="terkonfirmasi.php" class="sidebar-link"><i class="mdi mdi-checkbox-marked-outline"></i><span class="hide-menu"> Terkonfirmasi </span></a></li>
                                <li class="sidebar-item"><a href="tungguselesai.php" class="sidebar-link"><i class="mdi mdi-timer-sand-empty"></i><span class="hide-menu"> Menunggu Selesai </span></a></li>
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
                        <h4 class="page-title">Detail Pengeluaran</h4>
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
                    <br><br>
                    <form method="POST">
                        <div style="width: 90%; text-align: left;">
                            <input type="text" name="cari" class="inblock" placeholder="Cari Nama Barang">
                            <button class="cari" name="submit">Cari</button>
                        </div>
                    </form>
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Tanggal Pembelian</th>
                            <th>Jumlah Barang</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                        </tr>

                        <?php
                        $no=1;
                        $total = 0;
                        if (isset($_POST['submit'])) {

                            $namaBrg = $_POST['cari'];
                            $ambil = mysqli_query($koneksi,"SELECT barang.idBrg, namaBrg, tglBeli, jmlhBrg, hargaBeli, subTotal FROM detailbeli JOIN beli ON beli.kdBeli = detailbeli.kdBeli JOIN barang ON barang.idBrg = detailbeli.idBrg WHERE barang.namaBrg LIKE '%".$namaBrg."%' ORDER BY `beli`.`tglBeli` DESC");
                            if ($ambil)
                            {
                                while($pecah = mysqli_fetch_assoc($ambil)){ 
                                    $idBrg = $pecah['idBrg'];
                                    $namaBrg = $pecah['namaBrg'];
                                    $jmlhBrg  = $pecah['jmlhBrg'];
                                    $hargaBeli = $pecah['hargaBeli'];
                                    ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?php echo $idBrg ?></td>
                                        <td><?php echo $namaBrg ?></td>
                                        <td><?php echo date("d-M-Y", strtotime($pecah['tglBeli']))?></td>
                                        <td><?php echo $jmlhBrg ?></td>
                                        <td><?php echo "Rp. ",number_format($hargaBeli) ?></td>
                                        <td><?php echo "Rp. ",number_format($pecah['subTotal'])?></td>
                                    </tr>
                                    <?php
                                    $total = $total+$pecah['subTotal'];
                                    $no++;
                                }
                            }
                            ?>

                            <tr>
                                <td colspan="6">Total</td>
                                <td><?php echo "Rp. ",number_format($total) ?></td>
                            </tr>
                            <?php
                        }
                        else
                        {
                            $pagi = true;
                            $ambil = mysqli_query($koneksi,"SELECT barang.idBrg, namaBrg, tglBeli, jmlhBrg, hargaBeli, subTotal FROM detailbeli JOIN beli ON beli.kdBeli = detailbeli.kdBeli JOIN barang ON barang.idBrg = detailbeli.idBrg WHERE detailbeli.kdDetBeli ORDER BY `beli`.`tglBeli` DESC LIMIT $mulai, $halaman");
                            if ($ambil)
                            {
                                while($pecah = mysqli_fetch_assoc($ambil)){ 
                                    $idBrg = $pecah['idBrg'];
                                    $namaBrg = $pecah['namaBrg'];
                                    $jmlhBrg  = $pecah['jmlhBrg'];
                                    $hargaBeli = $pecah['hargaBeli'];
                                    ?>

                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?php echo $idBrg ?></td>
                                        <td><?php echo $namaBrg ?></td>
                                        <td><?php echo date("d-M-Y", strtotime($pecah['tglBeli']))?></td>
                                        <td><?php echo $jmlhBrg ?></td>
                                        <td><?php echo "Rp. ",number_format($hargaBeli) ?></td>
                                        <td><?php echo "Rp. ",number_format($pecah['subTotal'])?></td>
                                    </tr>
                                    <?php
                                    $total = $total+$pecah['subTotal'];
                                    $no++;
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="6">Total</td>
                                <td><?php echo "Rp. ",number_format($total) ?></td>
                            </tr> 
                            <?php
                        }        
                        ?>               

                    </table>
                    
                    <br><br>
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
                </center>
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

    </body>

    </html>