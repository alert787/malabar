/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.1.29-MariaDB : Database - db_malabaroutdoor
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_malabaroutdoor` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_malabaroutdoor`;

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `idBrg` varchar(9) NOT NULL,
  `namaBrg` varchar(50) NOT NULL,
  `jenisBrg` varchar(25) NOT NULL,
  `hargaBrg` int(11) DEFAULT NULL,
  `hargaSewa` int(11) DEFAULT NULL,
  `Deskrip` text NOT NULL,
  `Foto` varchar(200) NOT NULL,
  `stockBrg` int(11) NOT NULL,
  PRIMARY KEY (`idBrg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

insert  into `barang`(`idBrg`,`namaBrg`,`jenisBrg`,`hargaBrg`,`hargaSewa`,`Deskrip`,`Foto`,`stockBrg`) values 
('BR0000001','Tenda Dome Kapasitas 2 orang ukuran 2M x 1.5M','Tenda',0,25000,'Tenda Untuk Kapasitas 2 orang','tenda.jpg',20),
('BR0000002','Tenda Dome Kapasitas 3-4 orang ukuran 2M x 2M ','Tenda',0,30000,'Tenda untuk kapasitas 3-4 orang','tenda.jpg',20),
('BR0000003','Tenda Dome Kapasitas 4-5 orang ukuran 2.1M x 2.5M ','Tenda',0,50000,'Tenda untuk kapasitas 4-5 orang','tenda.jpg',15),
('BR0000004','Tenda Dome Kapasitas 6-8 orang ukuran 3M x 3M ','Tenda',0,75000,'tenda kapasitas untuk 6-8 orang','tenda.jpg',15),
('BR0000005','Tenda Pleton Kapasitas 50 orang ','Tenda',0,1500000,'Tenda pleton untuk kapasitas 50 orang','tenda2.jpg',8),
('BR0000006','Cooking Set SY/DS 308','Alat Memasak',250000,0,'Cooking Set','Cooking Set SY-DS 308.jpg',15),
('BR0000007','Cooking Set SY/DS 301','Alat Memasak',185000,0,'Cooking Set','Cooking Set SY-DS 301.jpg',15),
('BR0000008','Cooking Set SY/DS 300','Alat Memasak',185000,0,'Cooking Set','Cooking Set SY-DS 300.jpg',15),
('BR0000009','Cooking Set SY/DS 200','Alat Memasak',120000,0,'Cooking Set','Cooking Set SY-DS 200.jpg',15),
('BR0000010','Cooking Set SY/DS 101','Alat Memasak',150000,0,'Cooking Set','Cooking Set SY-DS 101.jpg',14),
('BR0000011','Headlamp','Alat Memasak',0,5000,'Headlamp (baterai tidak termasuk) ','headlamp.jpg',25),
('BR0000012','Nesting TNI','Alat Makan & Minum',185000,0,'Nesting TNI','Nesting TNI.jpg',20),
('BR0000013','Handly Talky','Alat Komunikasi',0,25000,'Handly Talky','Handly Talky.jpg',25),
('BR0000014','Lentera Tarik Matsuyama (3W)','Alat Penerangan',35000,0,'Lentera Tarik Matsuyama dengan besar sebesar 3Watt','Lentera Tarik Matsuyama (3W).jpg',20),
('BR0000015','Kompor gas portable','Alat Memasak',0,15000,'Kompor gas portable','Kompor gas portable.jpg',20),
('BR0000016','Tas avtech kavalu','Tas',145000,0,'Tas avtech kavalu ','Tas avtech kavalu.jpg',15),
('BR0000017','Tenda GO NSM4 2x2 M','Alat Memasak',750000,0,'Tenda GO NSM4 2x2 M (4 orang double layer)','Tenda GO NSM4 2x2 M.jpg',20);

/*Table structure for table `beli` */

DROP TABLE IF EXISTS `beli`;

CREATE TABLE `beli` (
  `kdBeli` int(11) NOT NULL,
  `tglBeli` date NOT NULL,
  PRIMARY KEY (`kdBeli`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `beli` */

insert  into `beli`(`kdBeli`,`tglBeli`) values 
(1,'2020-01-12');

/*Table structure for table `detailbeli` */

DROP TABLE IF EXISTS `detailbeli`;

CREATE TABLE `detailbeli` (
  `kdDetBeli` int(11) NOT NULL AUTO_INCREMENT,
  `jmlhBrg` int(11) NOT NULL,
  `hargaBeli` int(11) NOT NULL,
  `subTotal` int(11) NOT NULL,
  `kdBeli` int(11) NOT NULL,
  `idBrg` varchar(9) NOT NULL,
  PRIMARY KEY (`kdDetBeli`),
  KEY `idBrg` (`idBrg`),
  KEY `detailbeli_ibfk_2` (`kdBeli`),
  CONSTRAINT `detailbeli_ibfk_1` FOREIGN KEY (`idBrg`) REFERENCES `barang` (`idBrg`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detailbeli_ibfk_2` FOREIGN KEY (`kdBeli`) REFERENCES `beli` (`kdBeli`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `detailbeli` */

insert  into `detailbeli`(`kdDetBeli`,`jmlhBrg`,`hargaBeli`,`subTotal`,`kdBeli`,`idBrg`) values 
(20,20,700000,14000000,1,'BR0000017');

/*Table structure for table `detailsewa` */

DROP TABLE IF EXISTS `detailsewa`;

CREATE TABLE `detailsewa` (
  `kdDetSewa` varchar(10) NOT NULL,
  `tglSewa` date NOT NULL,
  `tglKembali` date NOT NULL,
  `lamaSewa` int(11) NOT NULL,
  `jmlhBrg` int(11) NOT NULL,
  `subTotal` int(11) NOT NULL,
  `kdSewa` varchar(200) NOT NULL,
  `idBrg` varchar(200) NOT NULL,
  PRIMARY KEY (`kdDetSewa`),
  KEY `detailsewa_ibfk_1` (`kdSewa`),
  KEY `detailsewa_ibfk_3` (`idBrg`),
  CONSTRAINT `detailsewa_ibfk_1` FOREIGN KEY (`kdSewa`) REFERENCES `sewa` (`kdSewa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detailsewa_ibfk_3` FOREIGN KEY (`idBrg`) REFERENCES `barang` (`idBrg`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detailsewa` */

/*Table structure for table `jual` */

DROP TABLE IF EXISTS `jual`;

CREATE TABLE `jual` (
  `kdJual` varchar(9) NOT NULL,
  `jmlhBrg` int(11) NOT NULL,
  `subTotal` int(11) NOT NULL,
  `kdTransaksi` varchar(11) NOT NULL,
  `idBrg` varchar(9) NOT NULL,
  PRIMARY KEY (`kdJual`),
  KEY `idBrg` (`idBrg`),
  KEY `idTransaksi` (`kdTransaksi`),
  CONSTRAINT `jual_ibfk_1` FOREIGN KEY (`idBrg`) REFERENCES `barang` (`idBrg`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jual_ibfk_2` FOREIGN KEY (`kdTransaksi`) REFERENCES `transaksi` (`kdTransaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jual` */

insert  into `jual`(`kdJual`,`jmlhBrg`,`subTotal`,`kdTransaksi`,`idBrg`) values 
('1',1,150000,'TR120120001','BR0000010');

/*Table structure for table `laporan` */

DROP TABLE IF EXISTS `laporan`;

CREATE TABLE `laporan` (
  `kdLaporan` int(11) NOT NULL,
  `tglLaporan` date NOT NULL,
  `fileLaporan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `laporan` */

insert  into `laporan`(`kdLaporan`,`tglLaporan`,`fileLaporan`) values 
(5,'2019-12-18','18-12-2019.pdf');

/*Table structure for table `sewa` */

DROP TABLE IF EXISTS `sewa`;

CREATE TABLE `sewa` (
  `kdSewa` varchar(8) NOT NULL,
  `statusBayar` varchar(20) NOT NULL,
  `fotoJaminan` varchar(200) DEFAULT NULL,
  `kdTransaksi` varchar(11) NOT NULL,
  PRIMARY KEY (`kdSewa`),
  KEY `kdTransaksi` (`kdTransaksi`),
  CONSTRAINT `sewa_ibfk_1` FOREIGN KEY (`kdTransaksi`) REFERENCES `transaksi` (`kdTransaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sewa` */

insert  into `sewa`(`kdSewa`,`statusBayar`,`fotoJaminan`,`kdTransaksi`) values 
('1','Bayar Lunas','20190916140755sarah_by_mauricesteiner_d9u35ah-pre.jpg','TR160919002'),
('2','Telah Lunas','20190917110019Untitled.png','TR170919001'),
('3','Bayar Lunas','20190918094107dark-wallpaper-high-definition-On-wallpaper-hd.jpg','TR180919002'),
('4','Telah Lunas','20190918101627Untitled.png','TR180919003');

/*Table structure for table `testi` */

DROP TABLE IF EXISTS `testi`;

CREATE TABLE `testi` (
  `idTesti` int(11) NOT NULL AUTO_INCREMENT,
  `komen` text,
  `rating` int(11) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'unFavorite',
  `kdTransaksi` varchar(11) NOT NULL,
  PRIMARY KEY (`idTesti`),
  KEY `kdTransaksi` (`kdTransaksi`),
  CONSTRAINT `testi_ibfk_1` FOREIGN KEY (`kdTransaksi`) REFERENCES `transaksi` (`kdTransaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `testi` */

insert  into `testi`(`idTesti`,`komen`,`rating`,`status`,`kdTransaksi`) values 
(8,'ok',5,'unFavorite','TR160919001'),
(9,'horeee',2,'Favorite','TR170919001');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `kdTransaksi` varchar(11) NOT NULL,
  `tglTransaksi` date NOT NULL,
  `totalBayarJual` int(11) NOT NULL,
  `totalBayarSewa` int(11) NOT NULL,
  `totalHarga` int(11) NOT NULL,
  `keterangan` text,
  `status` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `fotoPembayaran` varchar(200) DEFAULT NULL,
  `idUser` varchar(9) NOT NULL,
  PRIMARY KEY (`kdTransaksi`),
  KEY `idUser` (`idUser`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert  into `transaksi`(`kdTransaksi`,`tglTransaksi`,`totalBayarJual`,`totalBayarSewa`,`totalHarga`,`keterangan`,`status`,`alamat`,`fotoPembayaran`,`idUser`) values 
('TR120120001','2020-01-12',150000,0,150000,'','Transaksi Selesai','jalan cinta nomor 3','20200112144754view 1.jpg',''),
('TR160919001','2019-09-16',70000,0,70000,'','Terkonfirmasi','adawdw','201909161402092470.jpg','1'),
('TR160919002','2019-09-16',0,3000,3000,'','Transaksi Selesai','adawdw','201909161407556449.jpg','1'),
('TR161219001','2019-12-16',50000,0,50000,'','Terkonfirmasi','adawdw','201909161402092470.jpg','1'),
('TR170919001','2019-09-17',0,80000,80000,'','Transaksi Selesai','adawdw','20190917110019triangle_wallpaper_by_tezlex_d7x0zwe.png','1'),
('TR180919001','2019-09-18',75000,0,75000,'','Transaksi Selesai','adawdw','20190918085334dark-wallpaper-high-definition-On-wallpaper-hd.jpg','1'),
('TR180919002','2019-09-18',0,3000,3000,'','Terkonfirmasi','adawdw','201909180941072470.jpg','1'),
('TR180919003','2019-09-18',0,80000,80000,'','Transaksi Selesai','adawdw','20190918101627sarah_by_mauricesteiner_d9u35ah-pre.jpg','1'),
('TR180919004','2019-09-18',50000,0,50000,'','Transaksi Selesai','adawdw','20190918110032crocus_by_deltaruka_d9wudb1.png','1');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `idUser` varchar(7) NOT NULL,
  `namaUser` varchar(30) NOT NULL,
  `Alamat` text NOT NULL,
  `Telp` varchar(13) NOT NULL,
  `Foto` varchar(200) DEFAULT NULL,
  `Email` varchar(25) NOT NULL,
  `Password` varchar(25) NOT NULL,
  `role` enum('pelanggan','pemilik toko','bagian keuangan') NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`idUser`,`namaUser`,`Alamat`,`Telp`,`Foto`,`Email`,`Password`,`role`) values 
('','abe','jalan cinta nomor 3','081652715664',NULL,'child.masum@gmail.com','123467890','pelanggan'),
('1','Marjan','adawdw','123','dark-wallpaper-high-definition-On-wallpaper-hd.jpg','jojo@gmail.com','123456789','pemilik toko'),
('12','Jojo','1','1','','alert@gmail.com','qwertyuiop','bagian keuangan'),
('2','jojooooo','wefwefwef','0102','sarah_by_mauricesteiner_d9u35ah-pre.jpg','alert081@gmail.com','qwertyuiop','pelanggan');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
