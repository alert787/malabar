<?php
session_start();
include "../../../config.php";
ini_set('display_errors', 1);

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
    <title>Admin | Detail Transaksi</title>
    <!-- Custom CSS -->
    <link href="../../assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../dist/css/style.min.css" rel="stylesheet">
    <script src="../../assets/libs/chart/chart.js"></script>

    <style type="text/css">        
        body {height: 100%; background-color: #2a2b30;}
        .inblock {display: inline-block;}
        .tombol {padding-top: 3px; padding-bottom: 3px; padding-right: 5px; padding-left: 5px; font-size: 10; background-color: rgba(241, 196, 15,1.0); color: white; border-radius: 3px;}
        .tombol:hover {background-color: rgba(230, 126, 34,1.0);}
        .harga {font-weight: bold; color: rgba(241, 196, 15,1.0);}
        .bayar {font-weight: bold; color: #3498db}
        table.tab {border-collapse: collapse; width: 90%; text-align: center; font-size: 14px; color: white;}
        th.tab {background-color: rgba(41, 128, 185,1.0); padding-top: 4px; padding-bottom: 4px;}
        th.tab, td.tab {border : 1px solid #ecf0f1;}
        td.tab {padding-top: 8px; padding-bottom: 8px;}
        tr.tab:nth-child(even) {background-color: rgba(236, 240, 241,0.15)}
        tr.tab:hover {background-color: rgba(52, 152, 219,0.25)}
        hr {border : 1px dashed rgba(236, 240, 241,0.4);}
        .warning {font-weight: bold; color: rgba(230, 126, 34,1.0);}
        .warning2 {font-weight: bold; color: red;}
        .tombol-confirm {
            padding-top: 8px;
            padding-bottom: 8px;
            padding-left: 20px;
            padding-right: 20px;
            border : none;
            color: white;
            background-color: rgba(52, 152, 219,1.0);
        }
        .tombol-confirm:hover {
            background-color: #f1c40f;
            color: white;
        }
        hr {border : 1px dashed rgba(236, 240, 241,0.5);}
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
    if ($_SESSION['user']['role'] != 'bagian keuangan') {
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
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">Laporan </span></a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item"><a href="laporan.php" class="sidebar-link"><i class="mdi mdi-library-books"></i><span class="hide-menu"> Data Laporan </span></a></li>
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
                    <h4 class="page-title">Detail Transaksi</h4>
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
            <br>
            <center>
                <div style="width: 90%; text-align: left;">
                    <table style="width: 45%; line-height: 1.8">
                        <?php
                        $trf = mysqli_query($koneksi,"SELECT * FROM `transaksi` join user on transaksi.idUser = user.idUser where kdTransaksi = '$_GET[id]'");
                        if ($trf)
                        {
                            $transaksi = mysqli_fetch_assoc($trf);
                            $foto = $transaksi['fotoPembayaran'];
                            $status = $transaksi['status'];

                        }
                        ?>
                        <tr>
                            <td width="40%">ID Transaksi</td>
                            <td>:</td>
                            <td><?php echo $transaksi['kdTransaksi'] ?></td>
                        </tr>

                        <tr>
                            <td>Tanggal Transaksi</td>
                            <td>:</td>
                            <td><?php echo date("d-M-Y", strtotime($transaksi['tglTransaksi'])) ?></td>
                        </tr>

                        <tr>
                            <td>Nama Konsumen</td>
                            <td>:</td>
                            <td><?php echo $transaksi['namaUser'] ?></td>
                        </tr>           

                        <tr>
                            <td>Alamat Pengiriman</td>
                            <td>:</td>
                            <td><?php echo $transaksi['Alamat'] ?></td>
                        </tr>

                        <tr>
                            <td>Total Pembayaran</td>
                            <td>:</td>
                            <td class="harga"><?php echo "Rp. ",number_format($transaksi['totalHarga']) ?></td>
                        </tr>  
                        <?php
                        if ($transaksi['totalBayarSewa'] != 0) {
                            $sewa = mysqli_query($koneksi,"SELECT statusBayar,fotoJaminan,kdSewa from sewa where kdTransaksi = '$_GET[id]'");
                            $sw = mysqli_fetch_assoc($sewa);
                            $jaminan = $sw['fotoJaminan'];
                            $sbayar = $sw['statusBayar'];
                            ?>
                            <tr>
                                <td>Pembayaran</td>
                                <td>:</td>
                                <td class="bayar"><?php echo $sbayar; ?></td>
                            </tr>
                            <?php
                            if ($sbayar == 'DP') {
                                $sewafull = ($transaksi['totalBayarSewa'] / 3)*10;
                                $sisa = $sewafull - $transaksi['totalBayarSewa'];
                                $totalHarga = $transaksi['totalBayarJual'] + $sewafull;
                                ?> 
                                <tr>
                                    <td>Sisa Pembayaran</td>
                                    <td>:</td>
                                    <td class="harga"><?php echo "Rp. ",number_format($sisa) ?></td>
                                </tr> 
                                <?php

                            }
                            $tgl = mysqli_query($koneksi,"SELECT datediff(CURRENT_DATE,tglKembali) AS selisih from detailsewa where kdSewa = '$sw[kdSewa]'");
                            $tgl2 = mysqli_query($koneksi,"SELECT subTotal,tglKembali from detailsewa where kdSewa = '$sw[kdSewa]'");
                            $tots = 0;
                            $tanggal = mysqli_fetch_assoc($tgl);
                            while ($tanggal2 = mysqli_fetch_assoc($tgl2)) {
                                    $tots = $tots + $tanggal2['subTotal'];
                                }
                            
                            $satu = new datetime(date("Y-m-d"));
                            $dua = new datetime(date("Y-m-d",strtotime($tanggal2['tglKembali'])));
                            if (($satu > $dua) and $status == 'Menunggu Pengembalian') {
                                ?>
                                <tr>
                                    <td>Status Transaksi</td>
                                    <td>:</td>
                                    <td class="warning">MELEBIHI JATUH TEMPO (<?php echo $tanggal['selisih']; ?> HARI)</td>
                                </tr>
                                <tr>
                                <td>Total Denda</td>
                                    <td>:</td>
                                    <td class="warning2">Rp. <?php $tots = $tots*$tanggal['selisih']; echo number_format($tots); ?></td>
                                </tr>
                                <?php
                            }
                        }
                        
                        ?>

                    </table>
                </div>

                <br><br>
                <?php
                if ($transaksi['totalBayarJual'] != 0) {
                    ?>
                    <h3>Pembelian</h3>
                    <table class="tab">
                        <tr class="tab">
                            <th class="tab">No</th>
                            <th class="tab">Kode Barang</th>
                            <th class="tab">Nama Barang</th>
                            <th class="tab">Harga Satuan</th>
                            <th class="tab">Jumlah Dibeli</th>
                            <th class="tab">Total</th>
                        </tr>           


                        <?php
                        $no = 1;
                        $ambil = mysqli_query($koneksi,"SELECT * FROM jual where kdTransaksi = '$_GET[id]'");
                        if ($ambil)
                        {
                            while($pecah = mysqli_fetch_assoc($ambil)){ 
                                $idBrg = $pecah['idBrg'];
                                $brg = mysqli_query($koneksi,"SELECT namaBrg,hargaBrg FROM barang where idBrg = '$idBrg'");
                                $barang = mysqli_fetch_assoc($brg);
                                ?>
                                <tr class="tab">
                                    <td class="tab"><?php echo $no ?></td>
                                    <td class="tab"><?php echo $idBrg ?></td>
                                    <td class="tab"><?php echo $barang['namaBrg'] ?></td>
                                    <td class="tab"><?php echo "Rp. ",number_format($barang['hargaBrg']) ?></td>
                                    <td class="tab"><?php echo $pecah['jmlhBrg'] ?></td>
                                    <td class="tab"><?php echo "Rp. ",number_format($pecah['subTotal']) ?></td>
                                </tr>   
                                <?php
                                $no++;
                            }
                        }
                        ?>
                    </table><br><br>

                    <?php
                }
                if($transaksi['totalBayarSewa'] != 0)
                {
                    ?>

                    <h3>Penyewaan</h3>
                    <table class="tab">
                        <tr class="tab">
                            <th class="tab">No</th>
                            <th class="tab">Kode Barang</th>
                            <th class="tab">Nama Barang</th>
                            <th class="tab">Harga Satuan</th>
                            <th class="tab">Jumlah Disewa</th>
                            <th class="tab">Tanggal Sewa</th>
                            <th class="tab">Total</th>
                        </tr>           

                        <?php
                        $no = 1;
                        $sewa = mysqli_query($koneksi,"SELECT * from sewa join detailsewa on sewa.kdSewa = detailsewa.kdSewa where kdTransaksi = '$_GET[id]'");

                        while($sw = mysqli_fetch_assoc($sewa)){ 
                            $idBrg = $sw['idBrg'];
                            $brg = mysqli_query($koneksi,"SELECT namaBrg,hargaSewa FROM barang where idBrg = '$idBrg'");
                            $barang = mysqli_fetch_assoc($brg);
                            ?>
                            <tr class="tab">
                                <td class="tab"><?php echo $no ?></td>
                                <td class="tab"><?php echo $idBrg ?></td>
                                <td class="tab"><?php echo $barang['namaBrg'] ?></td>
                                <td class="tab"><?php echo "Rp. ",number_format($barang['hargaSewa']) ?></td>
                                <td class="tab"><?php echo $sw['jmlhBrg'] ?></td>
                                <td class="tab"><?php echo date("d/m/Y", strtotime($sw['tglSewa'])),"<br>s.d<br>",date("d/m/Y", strtotime($sw['tglKembali'])) ?></td>
                                <td class="tab"><?php echo "Rp. ",number_format($sw['subTotal']) ?></td>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>

                    </table>
                    <br><br>
                    <?php
                    
                }
                ?>
                <hr>

                <br><br>

                <h3>Bukti Pembayaran</h3>
                <div style="text-align: center; width: 60%;">
                    <img src="../../../images/bukti/<?php echo $foto; ?>" style="width: 100%; cursor:zoom-in" onclick="document.getElementById('modal01').style.display='block'">
                    <?php
                    if ($transaksi['totalBayarSewa'] != 0) { 
                        ?>
                        <img src="../../../images/identitas/<?php echo $jaminan; ?>" style="width: 100%; cursor:zoom-in" onclick="document.getElementById('modal01').style.display='block'">
                        <?php
                    }
                    ?>
                </div>
                <br>

                <div style="width: 90%">
                    <form method="post">
                        <?php if ($status == 'Menunggu Konfirmasi Seller') { ?>

                        <button class="tombol-confirm" name="konfir">Konfirmasi</button>

                        <?php } elseif ($status == 'Menunggu Pelunasan') { ?>

                        <button class="tombol-confirm" name="konfir">Konfirmasi Pelunasan</button>

                        <?php } elseif ($status == 'Menunggu Pengambilan Barang') { ?>

                        <button class="tombol-confirm" name="konfir">Konfirmasi Pengambilan Barang</button>

                        <?php } elseif ($status == 'Menunggu Pengembalian') { ?>

                        <button class="tombol-confirm" name="konfir">Konfirmasi Pengembalian</button>

                        <?php } elseif (($status == 'Terkonfirmasi') or ($status == 'Terkonfirmasi Pengembalian'))  { ?>

                        <button class="tombol-confirm" name="konfir">Selesaikan Transaksi</button>

                        <?php } ?>
                    </form>
                </div>
            </center>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div><br><br>
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
<script type="text/javascript" src="../../../user/js/sweetalert.min.js"></script>
<!--This page JavaScript -->
<!-- <script src="../../dist/js/pages/dashboards/dashboard1.js"></script> -->
<!-- Charts js Files -->
<?php

if (isset($_POST['konfir'])) {
    if (($status == 'Menunggu Konfirmasi Seller') and ($sbayar == 'DP')) {
        $res=mysqli_query($koneksi,"update transaksi set status='Menunggu Pelunasan' where kdTransaksi = '$_GET[id]'");
        echo '<script>
        swal({
            title: "Berhasil!",
            text: "Transaksi telah dikonfirmasi",
            icon: "success",
        }).then((value) => {
            window.location = "tunggukonfirmasi.php";
        });</script>';
    }
    elseif (($status == 'Menunggu Konfirmasi Seller') and ($transaksi['totalBayarSewa'] != 0) and ($sbayar == 'Bayar Lunas')) {
        $res=mysqli_query($koneksi,"update transaksi set status='Menunggu Pengambilan Barang' where kdTransaksi = '$_GET[id]'");
        echo '<script>
        swal({
            title: "Berhasil!",
            text: "Transaksi telah dikonfirmasi",
            icon: "success",
        }).then((value) => {
            window.location = "tunggukonfirmasi.php";
        });</script>';
    }
    elseif ($status == 'Menunggu Pengambilan Barang') {
        $res=mysqli_query($koneksi,"update transaksi set status='Menunggu Pengembalian' where kdTransaksi = '$_GET[id]'");
        echo '<script>
        swal({
            title: "Berhasil!",
            text: "Transaksi telah dikonfirmasi",
            icon: "success",
        }).then((value) => {
            window.location = "terkonfirmasi.php";
        });</script>';
    }
    else if($status == 'Menunggu Pelunasan'){
        $res=mysqli_query($koneksi,"update transaksi set status='Menunggu Pengembalian',totalBayarSewa='$sewafull',totalHarga='$totalHarga' where kdTransaksi = '$_GET[id]'");
        $res=mysqli_query($koneksi,"update sewa set statusBayar='Telah Lunas' where kdTransaksi = '$_GET[id]'");
        echo '<script>
        swal({
            title: "Berhasil!",
            text: "Transaksi dikonfirmasi telah Lunas",
            icon: "success",
        }).then((value) => {
            window.location = "tunggulunas.php";
        });</script>';
    }
    else if($status == 'Menunggu Pengembalian'){
        $res=mysqli_query($koneksi,"update transaksi set status='Terkonfirmasi Pengembalian' where kdTransaksi = '$_GET[id]'");
        $msewa = mysqli_query($koneksi,"SELECT kdSewa FROM `sewa` WHERE `kdTransaksi` = '$_GET[id]'");
        $ambil = mysqli_fetch_assoc($msewa);

        $sewa = mysqli_query($koneksi,"SELECT idBrg,jmlhBrg FROM `detailsewa` WHERE `kdSewa` = '$ambil[kdSewa]'");
        while ($pecah = mysqli_fetch_assoc($sewa)){
            $jumlah = $pecah['jmlhBrg'];
            $ambil=mysqli_query($koneksi,"update barang set stockBrg=stockBrg+$jumlah where idBrg='$pecah[idBrg]'");
        }
        echo '<script>
        swal({
            title: "Berhasil!",
            text: "Barang dikonfirmasi telah dikembalikan",
            icon: "success",
        }).then((value) => {
            window.location = "tungguselesai.php";
        });</script>';
    }
    else if(($status == 'Terkonfirmasi') or ($status == 'Terkonfirmasi Pengembalian')){
        $res=mysqli_query($koneksi,"update transaksi set status='Transaksi Selesai' where kdTransaksi = '$_GET[id]'");
        echo '<script>
        swal({
            title: "Berhasil!",
            text: "Transaksi telah Selesai",
            icon: "success",
        }).then((value) => {
            window.location = "terkonfirmasi.php";
        });</script>';
    }
    else{
        $res=mysqli_query($koneksi,"update transaksi set status='Terkonfirmasi' where kdTransaksi = '$_GET[id]'");
        echo '<script>
        swal({
            title: "Berhasil!",
            text: "Transaksi telah dikonfirmasi",
            icon: "success",
        }).then((value) => {
            window.location = "terkonfirmasi.php";
        });</script>';
    }
}
?>

</body>

</html>