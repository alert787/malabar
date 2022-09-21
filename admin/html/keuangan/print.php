<?php
session_start();
include "../../../config.php";
ini_set('display_errors', 1);

if (!isset($_SESSION['user']))
{
	echo '<script>window.location = "../../../user/notuser.php?id=1";</script>';
}
if ($_SESSION['user']['role'] == 'pelanggan') {
	echo '<script>window.location = "../../../user/notuser.php?id=3";</script>';
}

$datenow = date('Y-m');
$datenow2 = date('d-m-Y');
$pendapatan = 0;
$query = "SELECT kdTransaksi kd, tglTransaksi tgl,TotalHarga sub FROM `transaksi` where tglTransaksi like '$datenow%' ";
$mysql = mysqli_query($koneksi,$query);


$query2 = "SELECT sum(TotalHarga) th FROM `transaksi` where transaksi.tglTransaksi like '$datenow%' UNION SELECT sum(detailbeli.subTotal) from detailbeli join beli on beli.kdBeli = detailbeli.kdBeli where beli.tglBeli like '$datenow%' ";
$mysql2 = mysqli_query($koneksi,$query2);
while ($array = mysqli_fetch_assoc($mysql2)) {
	if ($pendapatan != 0) {
		$pendapatan = $pendapatan - $array['th'];
	}
	else {
		$pendapatan = $array['th'];
	}
}

$query3 = "SELECT transaksi.kdTransaksi kd, barang.namaBrg br, jual.jmlhBrg jm, jual.subTotal sub from jual join transaksi on transaksi.kdTransaksi = jual.kdTransaksi join barang on jual.idBrg = barang.idBrg where transaksi.tglTransaksi like '$datenow%'";
#where transaksi.tglTransaksi like '2019-09%'
$mysql3 = mysqli_query($koneksi,$query3);

$query4 = "SELECT sewa.kdTransaksi kd, barang.namaBrg br, detailsewa.jmlhBrg jm, detailsewa.subTotal sub from sewa join detailsewa on sewa.kdSewa = detailsewa.kdDetSewa join barang on detailsewa.idBrg = barang.idBrg where detailsewa.tglSewa like '$datenow%'";
#where detailsewa.tglSewa like '2019-09%'
$mysql4 = mysqli_query($koneksi,$query4);

$query5 = "SELECT barang.namaBrg br, detailbeli.jmlhBrg jm, detailbeli.hargaBeli hr, detailbeli.subTotal sub FROM beli join detailbeli on beli.kdBeli = detailbeli.kdBeli join barang on detailbeli.idBrg = barang.idBrg where beli.tglBeli like '$datenow%'";
$mysql5 = mysqli_query($koneksi,$query5);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="../../../user/js/sweetalert.min.js"></script>
</head>
<body>

</body>

<?php

ob_start();
include"../../../libraries/FPDF/fpdf.php";


$header = array(
	array("label"=>"No", "length"=>10, "align"=>"C"),  
	array("label"=>"Kode transaksi", "length"=>32, "align"=>"C"), 
	array("label"=>"Tanggal transaksi", "length"=>50, "align"=>"C"), 
	array("label"=>"subTotal transaksi", "length"=>40, "align"=>"C")
);

$header2 = array(
	array("label"=>"No", "length"=>10, "align"=>"C"),  
	array("label"=>"Kode transaksi", "length"=>32, "align"=>"C"), 
	array("label"=>"Nama Barang", "length"=>95, "align"=>"C"), 
	array("label"=>"Jumlah", "length"=>20, "align"=>"C"),
	array("label"=>"subTotal", "length"=>35, "align"=>"C")
);

$header3 = array(
	array("label"=>"No", "length"=>10, "align"=>"C"),  
	array("label"=>"Nama Barang", "length"=>95, "align"=>"C"), 
	array("label"=>"Jumlah", "length"=>20, "align"=>"C"), 
	array("label"=>"Harga", "length"=>35, "align"=>"C")
);

$pdf = new FPDF;

// Menambahkan halaman baru
$pdf->AddPage(); 

// set margin top
$pdf->SetLeftMargin(10);

// set font
$pdf->SetFont('Arial','B','20'); 

// set background tabel
$pdf->SetFillColor(207,223,233);

// set warna text
$pdf->SetTextColor(000); 

// Set warna garis
$pdf->SetDrawColor(000);

// Tulis judul dokumen
$pdf->Cell(0, 0, 'Laporan Bulanan MALABAR OUTDOOR', 0, '0', "C", false);
$pdf->Ln(); 
$pdf->SetFont('Arial','B','12'); 

$pdf->Cell(0, 30, 'Tanggal Laporan : '.$datenow2, 0, '0', "R", false);
$pdf->Ln(); 
$pdf->Cell(0, -10, 'Pendapatan Bulanan : Rp. '.number_format($pendapatan), 0, '0', "R", false);
$pdf->Ln(); 
$pdf->Cell(0, 10, 'Transaksi', 0, '0', "L", false);

// turun kebawah
$pdf->Ln(); 

#TABEL TRANSAKSI
########################################################################################
#
#buat header tabel 
foreach ($header as $kolom) { 
	$pdf->Cell($kolom['length'], 8, $kolom['label'], 1, '0', $kolom['align'], true); 
} 


$pdf->Ln();

#tampilkan data tabelnya 
$pdf->SetFillColor(224,235,255);
$pdf->SetFont('Arial','','11'); 

$fill 	= false; 
$no		= 1;
$total  = 0;

# MENGAMBIL DATA DARI DATABASE MYSQL
while($data = mysqli_fetch_assoc($mysql)){
	$i = 0; 
	$pdf->Cell($header[$i]['length'], 8, $no.'.', 1, '0','C', $fill); 
	$i++; 
	$pdf->Cell($header[$i]['length'], 8, $data['kd'], 1, '0','C', $fill); 
	$i++;
	$tgl = date_create($data['tgl']);
	$pdf->Cell($header[$i]['length'], 8, date_format($tgl,"d-m-Y"), 1, '0','L', $fill); 
	$i++; 
	$pdf->Cell($header[$i]['length'], 8, number_format($data['sub']), 1, '0','R', $fill); 
	$i++; 
	$total = $total + $data['sub'];
	
	$no++;
	
	$fill = !$fill; 
	$pdf->Ln();
}
$pdf->SetFillColor(253, 203, 110);
$pdf->Cell(92, 8, 'Total Transaksi', 1, '0','C', true);
$pdf->Cell(40, 8, 'Rp. '.number_format($total), 1, '0','R', true);


#TABEL PENJUALAN
##########################################################################################
#

$pdf->SetFont('Arial','B','12'); 
// turun kebawah
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0, 10, 'Penjualan', 0, '0', "L", false);
$pdf->Ln();

// set background tabel
$pdf->SetFillColor(207,223,233);

#buat header tabel 
foreach ($header2 as $kolom) { 
	$pdf->Cell($kolom['length'], 8, $kolom['label'], 1, '0', $kolom['align'], true); 
} 


$pdf->Ln();
#tampilkan data tabelnya 
$pdf->SetFillColor(224,235,255);
$pdf->SetFont('Arial','','11'); 

$fill 	= false; 
$no		= 1;
$total  = 0;
$tempkd = 0;
# MENGAMBIL DATA DARI DATABASE MYSQL
while($data = mysqli_fetch_assoc($mysql3)){

	if (($tempkd != $data['kd']) or ($tempkd != 0)){
		$pdf->SetFillColor(253, 203, 110);
		$pdf->Cell(157, 8, 'Total Transaksi', 1, '0','C', $fill);
		$pdf->Cell(35, 8, 'Rp. '.number_format($total), 1, '0','R', $fill);
		$total = 0;	
		$pdf->Ln();
		$pdf->SetFillColor(224,235,255);
	}

	$i = 0; 
	$pdf->Cell($header2[$i]['length'], 8, $no.'.', 1, '0','C', $fill); 
	$i++; 
	$pdf->Cell($header2[$i]['length'], 8, $data['kd'], 1, '0','C', $fill); 
	$i++; 
	$pdf->Cell($header2[$i]['length'], 8, $data['br'], 1, '0','L', $fill); 
	$i++; 
	$pdf->Cell($header2[$i]['length'], 8, $data['jm'], 1, '0','C', $fill); 
	$i++; 
	$pdf->Cell($header2[$i]['length'], 8, number_format($data['sub']), 1, '0','R', $fill); 
	$i++;
	$total = $total + $data['sub'];
	
	
	$no++;
	
	$tempkd = $data['kd'];
	$fill = !$fill; 
	$pdf->Ln();
}
$pdf->SetFillColor(253, 203, 110);
$pdf->Cell(157, 8, 'Total Transaksi', 1, '0','C', true);
$pdf->Cell(35, 8, 'Rp. '.number_format($total), 1, '0','R', true);


#TABEL PENYEWAAN
##########################################################################################
#

$pdf->SetFont('Arial','B','11'); 
// turun kebawah
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0, 10, 'Penyewaan', 0, '0', "L", false);
$pdf->Ln();

// set background tabel
$pdf->SetFillColor(207,223,233);

#buat header tabel 
foreach ($header2 as $kolom) { 
	$pdf->Cell($kolom['length'], 8, $kolom['label'], 1, '0', $kolom['align'], true); 
} 


$pdf->Ln();
#tampilkan data tabelnya 
$pdf->SetFillColor(224,235,255);
$pdf->SetFont('Arial','','12'); 

$fill 	= false; 
$no		= 1;
$total  = 0;
$tempkd = 0;
# MENGAMBIL DATA DARI DATABASE MYSQL
while($data = mysqli_fetch_assoc($mysql4)){

	if (($tempkd != $data['kd']) or ($tempkd != 0)){
		$pdf->SetFillColor(253, 203, 110);
		$pdf->Cell(157, 8, 'Total Transaksi', 1, '0','C', $fill);
		$pdf->Cell(35, 8, 'Rp. '.number_format($total), 1, '0','R', $fill);
		$total = 0;	
		$pdf->Ln();
		$pdf->SetFillColor(224,235,255);
	}

	$i = 0; 
	$pdf->Cell($header2[$i]['length'], 8, $no.'.', 1, '0','C', $fill); 
	$i++; 
	$pdf->Cell($header2[$i]['length'], 8, $data['kd'], 1, '0','C', $fill); 
	$i++; 
	$pdf->Cell($header2[$i]['length'], 8, $data['br'], 1, '0','L', $fill); 
	$i++; 
	$pdf->Cell($header2[$i]['length'], 8, $data['jm'], 1, '0','C', $fill); 
	$i++; 
	$pdf->Cell($header2[$i]['length'], 8, number_format($data['sub']), 1, '0','R', $fill); 
	$i++;
	$total = $total + $data['sub'];
	
	
	$no++;
	
	$tempkd = $data['kd'];
	$fill = !$fill; 
	$pdf->Ln();
}
$pdf->SetFillColor(253, 203, 110);
$pdf->Cell(157, 8, 'Total Transaksi', 1, '0','C', true);
$pdf->Cell(35, 8, 'Rp. '.number_format($total), 1, '0','R', true);

#TABEL PENGELUARAN
########################################################################################
#
$pdf->SetFont('Arial','B','12'); 
// turun kebawah
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0, 10, 'Pengeluaran', 0, '0', "L", false);
$pdf->Ln();

// set background tabel
$pdf->SetFillColor(207,223,233);
#buat header tabel 
foreach ($header3 as $kolom) { 
	$pdf->Cell($kolom['length'], 8, $kolom['label'], 1, '0', $kolom['align'], true); 
} 


$pdf->Ln();

#tampilkan data tabelnya 
$pdf->SetFillColor(224,235,255);
$pdf->SetFont('Arial','','12'); 

$fill 	= false; 
$no		= 1;
$total  = 0;

# MENGAMBIL DATA DARI DATABASE MYSQL
while($data = mysqli_fetch_assoc($mysql5)){
	$i = 0; 
	$pdf->Cell($header3[$i]['length'], 8, $no.'.', 1, '0','C', $fill); 
	$i++; 
	$pdf->Cell($header3[$i]['length'], 8, $data['br'], 1, '0','L', $fill); 
	$i++; 
	$pdf->Cell($header3[$i]['length'], 8, $data['jm'], 1, '0','C', $fill); 
	$i++; 
	$pdf->Cell($header3[$i]['length'], 8, number_format($data['hr']), 1, '0','R', $fill); 
	$i++; 
	$total = $total + $data['sub'];
	
	$no++;
	
	$fill = !$fill; 
	$pdf->Ln();
}
$pdf->SetFillColor(253, 203, 110);
$pdf->Cell(125, 8, 'Total Transaksi', 1, '0','C', true);
$pdf->Cell(35, 8, 'Rp. '.number_format($total), 1, '0','R', true);


#$pdf->Output('daftar-siswa.pdf','i'); // menampilkan di browser
$filename="../../file/".$datenow2.".pdf";
$pdf->Output($filename,'F'); // save pdf
ob_end_flush(); 

$tgl  = date('Y-m-d');
$file = $datenow2.".pdf";
$res = mysqli_query($koneksi,"insert into laporan values ('','$tgl','$file')");

?>

<script>
	swal({
		title: "Berhasil!",
		icon: "success",
	}).then((value) => {
		window.location = "laporan.php";
	});</script>
	</html>