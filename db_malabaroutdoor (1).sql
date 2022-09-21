-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2019 at 02:34 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_malabaroutdoor`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `idBrg` varchar(9) NOT NULL,
  `namaBrg` varchar(50) NOT NULL,
  `jenisBrg` varchar(25) NOT NULL,
  `hargaBrg` int(11) DEFAULT NULL,
  `hargaSewa` int(11) DEFAULT NULL,
  `Deskrip` text NOT NULL,
  `Foto` varchar(200) NOT NULL,
  `stockBrg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`idBrg`, `namaBrg`, `jenisBrg`, `hargaBrg`, `hargaSewa`, `Deskrip`, `Foto`, `stockBrg`) VALUES
('BR0000001', 'Adaptor segitiga biru', 'Perlengkapan Lain', 0, 80000, '-', 'Adaptor segitiga.jpg', 4),
('BR0000002', 'aku ini', 'Perlengkapan Lain', 20000, 0, '-', 'Adaptor segitiga.jpg', 0),
('BR0000003', 'Adaptor Kompor Selang', 'Alat Memasak', 50000, 0, '-', 'Adaptor Kompor Selang.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `beli`
--

CREATE TABLE `beli` (
  `kdBeli` int(11) NOT NULL,
  `tglBeli` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beli`
--

INSERT INTO `beli` (`kdBeli`, `tglBeli`) VALUES
(1, '2019-09-18');

-- --------------------------------------------------------

--
-- Table structure for table `detailbeli`
--

CREATE TABLE `detailbeli` (
  `kdDetBeli` int(11) NOT NULL,
  `jmlhBrg` int(11) NOT NULL,
  `hargaBeli` int(11) NOT NULL,
  `subTotal` int(11) NOT NULL,
  `kdBeli` int(11) NOT NULL,
  `idBrg` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailbeli`
--

INSERT INTO `detailbeli` (`kdDetBeli`, `jmlhBrg`, `hargaBeli`, `subTotal`, `kdBeli`, `idBrg`) VALUES
(4, 1, 20000, 20000, 1, 'BR0000001');

-- --------------------------------------------------------

--
-- Table structure for table `detailsewa`
--

CREATE TABLE `detailsewa` (
  `kdDetSewa` varchar(10) NOT NULL,
  `tglSewa` date NOT NULL,
  `tglKembali` date NOT NULL,
  `lamaSewa` int(11) NOT NULL,
  `jmlhBrg` int(11) NOT NULL,
  `subTotal` int(11) NOT NULL,
  `kdSewa` varchar(200) NOT NULL,
  `idBrg` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailsewa`
--

INSERT INTO `detailsewa` (`kdDetSewa`, `tglSewa`, `tglKembali`, `lamaSewa`, `jmlhBrg`, `subTotal`, `kdSewa`, `idBrg`) VALUES
('2', '2019-09-17', '2019-09-18', 1, 1, 80000, '2', 'BR0000001'),
('4', '2019-09-18', '2019-09-19', 1, 1, 80000, '4', 'BR0000001');

-- --------------------------------------------------------

--
-- Table structure for table `jual`
--

CREATE TABLE `jual` (
  `kdJual` varchar(9) NOT NULL,
  `jmlhBrg` int(11) NOT NULL,
  `subTotal` int(11) NOT NULL,
  `kdTransaksi` varchar(11) NOT NULL,
  `idBrg` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jual`
--

INSERT INTO `jual` (`kdJual`, `jmlhBrg`, `subTotal`, `kdTransaksi`, `idBrg`) VALUES
('1', 1, 50000, 'TR160919001', 'BR0000003'),
('2', 4, 50000, 'TR161219001', 'BR0000002'),
('4', 1, 50000, 'TR160919001', 'BR0000002');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `kdLaporan` int(11) NOT NULL,
  `tglLaporan` date NOT NULL,
  `fileLaporan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`kdLaporan`, `tglLaporan`, `fileLaporan`) VALUES
(5, '2019-12-18', '18-12-2019.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `sewa`
--

CREATE TABLE `sewa` (
  `kdSewa` varchar(8) NOT NULL,
  `statusBayar` varchar(20) NOT NULL,
  `fotoJaminan` varchar(200) DEFAULT NULL,
  `kdTransaksi` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sewa`
--

INSERT INTO `sewa` (`kdSewa`, `statusBayar`, `fotoJaminan`, `kdTransaksi`) VALUES
('1', 'Bayar Lunas', '20190916140755sarah_by_mauricesteiner_d9u35ah-pre.jpg', 'TR160919002'),
('2', 'Telah Lunas', '20190917110019Untitled.png', 'TR170919001'),
('3', 'Bayar Lunas', '20190918094107dark-wallpaper-high-definition-On-wallpaper-hd.jpg', 'TR180919002'),
('4', 'Telah Lunas', '20190918101627Untitled.png', 'TR180919003');

-- --------------------------------------------------------

--
-- Table structure for table `testi`
--

CREATE TABLE `testi` (
  `idTesti` int(11) NOT NULL,
  `komen` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'unFavorite',
  `kdTransaksi` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testi`
--

INSERT INTO `testi` (`idTesti`, `komen`, `rating`, `status`, `kdTransaksi`) VALUES
(8, 'ok', 5, 'unFavorite', 'TR160919001'),
(9, 'horeee', 2, 'Favorite', 'TR170919001');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `kdTransaksi` varchar(11) NOT NULL,
  `tglTransaksi` date NOT NULL,
  `totalBayarJual` int(11) NOT NULL,
  `totalBayarSewa` int(11) NOT NULL,
  `totalHarga` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `status` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `fotoPembayaran` varchar(200) DEFAULT NULL,
  `idUser` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`kdTransaksi`, `tglTransaksi`, `totalBayarJual`, `totalBayarSewa`, `totalHarga`, `keterangan`, `status`, `alamat`, `fotoPembayaran`, `idUser`) VALUES
('TR160919001', '2019-09-16', 70000, 0, 70000, '', 'Terkonfirmasi', 'adawdw', '201909161402092470.jpg', '1'),
('TR160919002', '2019-09-16', 0, 3000, 3000, '', 'Transaksi Selesai', 'adawdw', '201909161407556449.jpg', '1'),
('TR161219001', '2019-12-16', 50000, 0, 50000, '', 'Terkonfirmasi', 'adawdw', '201909161402092470.jpg', '1'),
('TR170919001', '2019-09-17', 0, 80000, 80000, '', 'Transaksi Selesai', 'adawdw', '20190917110019triangle_wallpaper_by_tezlex_d7x0zwe.png', '1'),
('TR180919001', '2019-09-18', 75000, 0, 75000, '', 'Transaksi Selesai', 'adawdw', '20190918085334dark-wallpaper-high-definition-On-wallpaper-hd.jpg', '1'),
('TR180919002', '2019-09-18', 0, 3000, 3000, '', 'Terkonfirmasi', 'adawdw', '201909180941072470.jpg', '1'),
('TR180919003', '2019-09-18', 0, 80000, 80000, '', 'Transaksi Selesai', 'adawdw', '20190918101627sarah_by_mauricesteiner_d9u35ah-pre.jpg', '1'),
('TR180919004', '2019-09-18', 50000, 0, 50000, '', 'Transaksi Selesai', 'adawdw', '20190918110032crocus_by_deltaruka_d9wudb1.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idUser` varchar(7) NOT NULL,
  `namaUser` varchar(30) NOT NULL,
  `Alamat` text NOT NULL,
  `Telp` varchar(13) NOT NULL,
  `Foto` varchar(200) DEFAULT NULL,
  `Email` varchar(25) NOT NULL,
  `Password` varchar(25) NOT NULL,
  `role` enum('pelanggan','pemilik toko','bagian keuangan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `namaUser`, `Alamat`, `Telp`, `Foto`, `Email`, `Password`, `role`) VALUES
('', 'abe', 'jalan cinta nomor 3', '081652715664', NULL, 'child.masum@gmail.com', '123467890', 'pelanggan'),
('1', 'Marjan', 'adawdw', '123', 'dark-wallpaper-high-definition-On-wallpaper-hd.jpg', 'jojo@gmail.com', '123456789', 'pemilik toko'),
('12', 'Jojo', '1', '1', '', 'alert@gmail.com', 'qwertyuiop', 'bagian keuangan'),
('2', 'jojooooo', 'wefwefwef', '0102', 'sarah_by_mauricesteiner_d9u35ah-pre.jpg', 'alert081@gmail.com', 'qwertyuiop', 'pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`idBrg`);

--
-- Indexes for table `beli`
--
ALTER TABLE `beli`
  ADD PRIMARY KEY (`kdBeli`);

--
-- Indexes for table `detailbeli`
--
ALTER TABLE `detailbeli`
  ADD PRIMARY KEY (`kdDetBeli`),
  ADD KEY `idBrg` (`idBrg`),
  ADD KEY `detailbeli_ibfk_2` (`kdBeli`);

--
-- Indexes for table `detailsewa`
--
ALTER TABLE `detailsewa`
  ADD PRIMARY KEY (`kdDetSewa`),
  ADD KEY `detailsewa_ibfk_1` (`kdSewa`),
  ADD KEY `detailsewa_ibfk_3` (`idBrg`);

--
-- Indexes for table `jual`
--
ALTER TABLE `jual`
  ADD PRIMARY KEY (`kdJual`),
  ADD KEY `idBrg` (`idBrg`),
  ADD KEY `idTransaksi` (`kdTransaksi`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`kdLaporan`),
  ADD UNIQUE KEY `tglLaporan` (`tglLaporan`),
  ADD UNIQUE KEY `fileLaporan` (`fileLaporan`);

--
-- Indexes for table `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`kdSewa`),
  ADD KEY `kdTransaksi` (`kdTransaksi`);

--
-- Indexes for table `testi`
--
ALTER TABLE `testi`
  ADD PRIMARY KEY (`idTesti`),
  ADD KEY `kdTransaksi` (`kdTransaksi`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kdTransaksi`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailbeli`
--
ALTER TABLE `detailbeli`
  MODIFY `kdDetBeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `kdLaporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `testi`
--
ALTER TABLE `testi`
  MODIFY `idTesti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailbeli`
--
ALTER TABLE `detailbeli`
  ADD CONSTRAINT `detailbeli_ibfk_1` FOREIGN KEY (`idBrg`) REFERENCES `barang` (`idBrg`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detailbeli_ibfk_2` FOREIGN KEY (`kdBeli`) REFERENCES `beli` (`kdBeli`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detailsewa`
--
ALTER TABLE `detailsewa`
  ADD CONSTRAINT `detailsewa_ibfk_1` FOREIGN KEY (`kdSewa`) REFERENCES `sewa` (`kdSewa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detailsewa_ibfk_3` FOREIGN KEY (`idBrg`) REFERENCES `barang` (`idBrg`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jual`
--
ALTER TABLE `jual`
  ADD CONSTRAINT `jual_ibfk_1` FOREIGN KEY (`idBrg`) REFERENCES `barang` (`idBrg`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jual_ibfk_2` FOREIGN KEY (`kdTransaksi`) REFERENCES `transaksi` (`kdTransaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sewa`
--
ALTER TABLE `sewa`
  ADD CONSTRAINT `sewa_ibfk_1` FOREIGN KEY (`kdTransaksi`) REFERENCES `transaksi` (`kdTransaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testi`
--
ALTER TABLE `testi`
  ADD CONSTRAINT `testi_ibfk_1` FOREIGN KEY (`kdTransaksi`) REFERENCES `transaksi` (`kdTransaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
