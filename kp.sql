/*
SQLyog Enterprise v13.1.1 (64 bit)
MySQL - 10.4.14-MariaDB : Database - kp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`kp` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `kp`;

/*Table structure for table `dosen` */

DROP TABLE IF EXISTS `dosen`;

CREATE TABLE `dosen` (
  `id_dosen` varchar(20) NOT NULL,
  `nama_dosen` varchar(30) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `notelp` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_dosen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dosen` */

insert  into `dosen`(`id_dosen`,`nama_dosen`,`email`,`notelp`) values 
('d000','user','user@g.com','08888888'),
('d1','achmad budi','budi@g.com','0989898'),
('d1099','joko','joko@g.com','009898979798'),
('d11','hans purnomo','hans@g.com','098798733'),
('d2','bambang','bambang@g.com','0987656565'),
('d3','firmansyah','firman@g.com','08888878'),
('d4','ravi rifai','ravi@g.com','08867878'),
('d5','fikky firmansyah','fiki@g.com','08809878'),
('d6','ali prasetya','ali@g.com','078654212'),
('d7','bilal tribudi','bilal@g.com','987876877'),
('d8','rizki kurnianty','kiki@g.com','06775876'),
('d9','fathur rosi','rosi@g.com','098987822');

/*Table structure for table `kelas` */

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id_kelas` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(100) NOT NULL,
  `id_dosen` varchar(20) NOT NULL,
  `tahun_ajaran` year(4) DEFAULT NULL,
  `semester` enum('genap','ganjil') DEFAULT NULL,
  PRIMARY KEY (`id_kelas`),
  KEY `id_dosen` (`id_dosen`),
  CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COMMENT='kelas = matakuliah ';

/*Data for the table `kelas` */

insert  into `kelas`(`id_kelas`,`nama_kelas`,`id_dosen`,`tahun_ajaran`,`semester`) values 
(2,'BASIS DATA 1 - A','d8',2020,'genap'),
(3,'BASIS DATA 1 - B','d1',2020,'genap'),
(4,'PEMOGRAMAN-WEB - A','d2',2020,'genap'),
(7,'PEMROGRAMAN-WEB - B','d9',2020,'genap'),
(8,'Desain sistem A','d3',2020,'genap'),
(9,'Desain Sistem B','d8',2020,'genap'),
(10,'rekayasa perangkat lunak A','d4',2020,'genap'),
(11,'rekayasa perangkat lunak B','d6',2020,'genap'),
(12,'IT GOEVERNMENT A','d5',2020,'genap'),
(13,'IT GOEVERNMENT B','d5',2020,'genap'),
(14,'audit a','d5',2020,'genap'),
(15,'audit a','d7',2020,'genap'),
(17,'Data Science','d6',2020,'ganjil'),
(18,'e government','d1099',2021,'genap');

/*Table structure for table `kelas_mahasiswa` */

DROP TABLE IF EXISTS `kelas_mahasiswa`;

CREATE TABLE `kelas_mahasiswa` (
  `id_kelas_mahasiswa` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_kelas` bigint(20) NOT NULL,
  `id_mhs` varchar(30) NOT NULL,
  PRIMARY KEY (`id_kelas_mahasiswa`),
  KEY `id_kelas` (`id_kelas`),
  KEY `id_mhs` (`id_mhs`),
  CONSTRAINT `kelas_mahasiswa_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  CONSTRAINT `kelas_mahasiswa_ibfk_3` FOREIGN KEY (`id_mhs`) REFERENCES `mhs` (`id_mhs`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Data for the table `kelas_mahasiswa` */

insert  into `kelas_mahasiswa`(`id_kelas_mahasiswa`,`id_kelas`,`id_mhs`) values 
(1,2,'17000'),
(2,2,'17001'),
(3,2,'17002'),
(4,2,'17003'),
(5,2,'17005'),
(6,2,'17006'),
(7,2,'17007'),
(8,2,'17008'),
(9,3,'17045'),
(10,3,'17132'),
(11,3,'17011'),
(12,3,'17012'),
(13,3,'17013'),
(14,3,'17015'),
(15,3,'17016'),
(16,4,'17000'),
(17,4,'17005'),
(18,11,'17003'),
(19,11,'17002'),
(20,11,'17016'),
(21,11,'17132'),
(22,11,'17006'),
(30,17,'17132'),
(31,18,'17099'),
(32,18,'17045'),
(33,18,'17003');

/*Table structure for table `kumpulkan` */

DROP TABLE IF EXISTS `kumpulkan`;

CREATE TABLE `kumpulkan` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `idtugas` bigint(30) DEFAULT NULL,
  `idmhs` varchar(30) DEFAULT NULL,
  `uraian_jawaban` text DEFAULT NULL,
  `file1` text DEFAULT NULL,
  `tgl_upload` datetime DEFAULT NULL,
  `nilai` decimal(10,0) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idmhs` (`idmhs`),
  KEY `idtugas` (`idtugas`),
  CONSTRAINT `kumpulkan_ibfk_2` FOREIGN KEY (`idmhs`) REFERENCES `mhs` (`id_mhs`),
  CONSTRAINT `kumpulkan_ibfk_3` FOREIGN KEY (`idtugas`) REFERENCES `tugas` (`idtugas`)
) ENGINE=InnoDB AUTO_INCREMENT=350 DEFAULT CHARSET=latin1;

/*Data for the table `kumpulkan` */

insert  into `kumpulkan`(`id`,`idtugas`,`idmhs`,`uraian_jawaban`,`file1`,`tgl_upload`,`nilai`,`ket`) values 
(2,2,'17000',NULL,NULL,'2020-01-10 22:36:32',89,NULL),
(3,1,'17000',NULL,NULL,'2020-01-03 22:37:18',80,NULL),
(4,1,'17001',NULL,NULL,'2020-01-02 22:37:45',70,NULL),
(5,1,'17002',NULL,NULL,'2020-01-02 22:38:09',80,NULL),
(6,2,'17132',NULL,NULL,'2020-01-09 22:38:49',80,NULL),
(7,2,'17005',NULL,NULL,'2020-01-09 22:39:12',100,NULL),
(8,1,'17006',NULL,NULL,'2020-01-02 22:39:35',50,NULL),
(9,1,'17007',NULL,NULL,'2020-01-02 22:39:46',80,NULL),
(10,1,'17009',NULL,NULL,'2020-01-02 22:39:35',100,NULL),
(17,2,'17001',' uraian','FILE ','2020-01-09 22:38:49',80,''),
(18,2,'17002',' uraian','FILE ','2020-01-09 22:38:49',70,' '),
(20,2,'17003',' uraian','FILE ','2020-01-09 22:38:49',60,' '),
(21,2,'17005',' uraian','FILE','2020-01-09 22:38:49',80,' '),
(22,2,'17006',' uraian','FILE','2020-01-09 22:38:49',77,' '),
(23,2,'17007',' uraian','FILE','2020-01-09 22:38:49',80,' '),
(24,2,'17008',' uraian','FILE','2020-01-09 22:38:49',89,' '),
(26,4,'17000',' uraian','FILE','2020-01-16 07:00:36',88,' '),
(27,4,'17001',' uraian','FILE','2020-01-16 07:00:36',89,' '),
(28,4,'17002',' uraian','FILE','2020-01-16 07:00:36',90,' '),
(29,4,'17003',' uraian','FILE','2020-01-15 07:00:36',85,' '),
(30,4,'17005',' uraian','FILE','2020-01-15 07:00:36',87,' '),
(31,4,'17006',' uraian','FILE','2020-01-15 07:00:36',70,' '),
(32,4,'17007',' uraian','FILE','2020-01-16 07:00:36',100,' '),
(33,4,'17008',' uraian','FILE','2020-01-16 07:00:36',99,' '),
(34,5,'17000',' jawaban','FILE','2020-01-22 07:37:25',87,' '),
(35,5,'17001',' jawaban','FILE','2020-01-22 07:37:25',99,' '),
(36,5,'17002',' jawaban','FILE','2020-01-22 07:37:25',99,' '),
(37,5,'17003',' jawaban','FILE','2020-01-22 07:37:25',67,' '),
(38,5,'17005',' jawaban','FILE','2020-01-22 07:37:25',88,' '),
(39,5,'17006',' jawaban','FILE','2020-01-22 07:37:25',89,' '),
(40,5,'17007',' jawaban','FILE','2020-01-22 07:37:25',98,' '),
(41,5,'17008',' jawaban','FILE','2020-01-22 07:37:25',87,' '),
(42,6,'17008',' jawaban','FILE','2020-01-29 14:05:16',89,' '),
(43,6,'17007',' jawaban','FILE','2020-01-29 14:05:16',85,' '),
(44,6,'17006',' jawaban','FILE','2020-01-29 14:05:16',80,' '),
(45,6,'17005',' jawaban','FILE','2020-01-29 14:05:16',60,' '),
(46,6,'17003',' jawaban','FILE','2020-01-29 14:05:16',88,' '),
(47,6,'17002',' jawaban','FILE','2020-01-29 14:05:16',85,' '),
(48,6,'17001',' jawaban','FILE','2020-01-29 14:05:16',60,' '),
(49,6,'17000',' jawaban','FILE','2020-01-29 14:05:16',80,' '),
(53,13,'17000',' jawaban','FILE','2020-02-06 18:24:58',85,' '),
(54,13,'17001',' jawaban','FILE','2020-02-06 18:24:58',80,' '),
(55,13,'17002',' jawaban','FILE','2020-02-06 18:24:58',85,' '),
(56,13,'17003',' jawaban','FILE','2020-02-06 18:24:58',80,' '),
(57,13,'17005',' jawaban','FILE','2020-02-06 18:24:58',88,' '),
(58,13,'17006',' jawaban','FILE','2020-02-06 18:24:58',80,' '),
(59,13,'17007',' jawaban','FILE','2020-02-06 18:24:58',88,' '),
(60,13,'17008',' jawaban','FILE','2020-02-06 18:24:58',80,' '),
(61,13,'17009',' jawaban','FILE','2020-02-06 18:24:58',80,' '),
(63,14,'17001',' jawaban','FILE','2020-02-13 18:24:58',80,' '),
(65,14,'17000',' jawaban','FILE','2020-02-13 18:24:58',80,' '),
(66,14,'17002',' jawaban','FILE','2020-02-13 18:24:58',85,' '),
(67,14,'17003',' jawaban','FILE','2020-02-13 18:24:58',88,' '),
(68,14,'17005',' jawaban','FILE','2020-02-13 18:24:58',60,' '),
(69,14,'17006',' jawaban','FILE','2020-02-13 18:24:58',88,' '),
(70,14,'17007',' jawaban','FILE','2020-02-13 18:24:58',85,' '),
(71,14,'17008',' jawaban','FILE','2020-02-13 18:24:58',85,' '),
(72,14,'17009',' jawaban','FILE','2020-02-13 18:24:58',85,' '),
(73,16,'17000',' jawaban','FILE','2020-02-20 19:37:10',99,' '),
(74,16,'17001',' jawaban','FILE','2020-02-20 19:37:10',70,' '),
(75,16,'17002',' jawaban','FILE','2020-02-20 19:37:10',85,' '),
(76,16,'17003',' jawaban','FILE','2020-02-20 19:37:10',70,' '),
(77,16,'17005',' jawaban','FILE','2020-02-20 19:37:10',88,' '),
(78,16,'17006',' jawaban','FILE','2020-02-20 19:37:10',85,' '),
(79,16,'17007',' jawaban','FILE','2020-02-20 19:37:10',99,' '),
(80,16,'17008',' jawaban','FILE','2020-02-20 19:37:10',99,' '),
(81,16,'17009',' jawaban','FILE','2020-02-20 19:37:10',88,' '),
(82,18,'17000',' jawaban','FILE','2020-02-27 19:37:29',85,' '),
(83,18,'17001',' jawaban','FILE','2020-02-27 19:37:29',99,' '),
(84,18,'17002',' jawaban','FILE','2020-02-27 19:37:29',85,' '),
(85,18,'17003',' jawaban','FILE','2020-02-27 19:37:29',85,' '),
(86,18,'17005',' jawaban','FILE','2020-02-27 19:37:29',70,' '),
(87,18,'17006',' jawaban','FILE','2020-02-27 19:37:29',60,' '),
(88,18,'17007',' jawaban','FILE','2020-02-27 19:37:29',85,' '),
(89,18,'17008',' jawaban','FILE','2020-02-27 19:37:29',99,' '),
(90,18,'17009',' jawaban','FILE','2020-02-27 19:37:29',70,' '),
(91,19,'17000',' jawaban','FILE','2020-03-05 19:37:29',60,' '),
(92,19,'17001',' jawaban','FILE','2020-03-05 19:44:33',85,' '),
(93,19,'17002',' jawaban','FILE','2020-03-05 19:44:33',99,' '),
(94,19,'17003',' jawaban','FILE','2020-03-05 19:44:33',70,' '),
(95,19,'17005',' jawaban','FILE','2020-03-05 19:44:33',80,' '),
(96,19,'17006',' jawaban','FILE','2020-03-05 19:44:33',85,' '),
(97,19,'17007',' jawaban','FILE','2020-03-05 19:44:33',80,' '),
(98,19,'17008',' jawaban','FILE','2020-03-05 19:44:33',80,' '),
(99,19,'17009',' jawaban','FILE','2020-03-05 19:44:33',80,' '),
(100,21,'17000',' jawaban','FILE','2020-03-12 19:45:10',85,' '),
(101,21,'17001',' jawaban','FILE','2020-03-12 19:45:10',80,' '),
(102,21,'17002',' jawaban','FILE','2020-03-12 19:45:10',80,' '),
(103,21,'17003',' jawaban','FILE','2020-03-12 19:45:10',85,' '),
(104,21,'17005',' jawaban','FILE','2020-03-12 19:45:10',80,' '),
(105,21,'17006',' jawaban','FILE','2020-03-12 19:45:10',85,' '),
(106,21,'17007',' jawaban','FILE','2020-03-12 19:45:10',70,' '),
(107,21,'17008',' jawaban','FILE','2020-03-12 19:45:10',60,' '),
(108,21,'17009',' jawaban','FILE','2020-03-12 19:45:10',99,' '),
(109,24,'17000',' jawaban','FILE','2020-03-19 19:45:59',99,' '),
(110,24,'17001',' jawaban','FILE','2020-03-19 19:45:59',85,' '),
(111,24,'17002',' jawaban','FILE','2020-03-19 19:45:59',60,' '),
(112,24,'17003',' jawaban','FILE','2020-03-19 19:45:59',70,' '),
(113,24,'17005',' jawaban','FILE','2020-03-19 19:45:59',60,' '),
(114,24,'17006',' jawaban','FILE','2020-03-19 19:45:59',85,' '),
(115,24,'17007',' jawaban','FILE','2020-03-19 19:45:59',70,' '),
(116,24,'17008',' jawaban','FILE','2020-03-19 19:45:59',60,' '),
(117,24,'17009',' jawaban','FILE','2020-03-19 19:45:59',70,' '),
(118,25,'17000',' jawaban','FILE','2020-03-26 19:45:59',60,' '),
(119,25,'17001',' jawaban','FILE','2020-03-26 19:46:45',85,' '),
(120,25,'17002',' jawaban','FILE','2020-03-26 19:46:45',70,' '),
(121,25,'17003',' jawaban','FILE','2020-03-26 19:46:45',99,' '),
(122,25,'17005',' jawaban','FILE','2020-03-26 19:46:45',70,' '),
(123,25,'17006',' jawaban','FILE','2020-03-26 19:46:45',60,' '),
(124,25,'17007',' jawaban','FILE','2020-03-26 19:46:45',85,' '),
(125,25,'17008',' jawaban','FILE','2020-03-26 19:46:45',60,' '),
(126,25,'17009',' jawaban','FILE','2020-03-26 19:46:45',70,' '),
(127,27,'17000',' jawaban','FILE','2020-04-02 19:46:45',99,' '),
(128,27,'17001',' jawaban','FILE','2020-04-02 19:46:45',99,' '),
(129,27,'17002',' jawaban','FILE','2020-04-02 19:46:45',70,' '),
(130,27,'17003',' jawaban','FILE','2020-04-02 19:46:45',99,' '),
(131,27,'17005',' jawaban','FILE','2020-04-02 19:46:45',70,' '),
(132,27,'17006',' jawaban','FILE','2020-04-02 19:46:45',80,' '),
(133,27,'17007',' jawaban','FILE','2020-04-02 19:46:45',80,' '),
(134,27,'17008',' jawaban','FILE','2020-04-02 19:46:45',80,' '),
(135,28,'17009',' jawaban','FILE','2020-04-10 19:46:46',80,' '),
(136,28,'17000',' jawaban','FILE','2020-04-10 19:46:46',70,' '),
(137,28,'17001',' jawaban','FILE','2020-04-10 19:46:46',80,' '),
(138,28,'17002',' jawaban','FILE','2020-04-10 19:46:46',70,' '),
(139,28,'17003',' jawaban','FILE','2020-04-10 19:46:46',99,' '),
(140,28,'17005',' jawaban','FILE','2020-04-10 19:46:46',80,' '),
(141,28,'17006',' jawaban','FILE','2020-04-10 19:46:46',80,' '),
(142,28,'17007',' jawaban','FILE','2020-04-10 19:46:46',70,' '),
(143,28,'17008',' jawaban','FILE','2020-04-10 19:46:46',70,' '),
(144,29,'17009',' jawaban','FILE','2020-04-16 19:47:20',85,' '),
(145,29,'17000',' jawaban','FILE','2020-04-16 19:47:20',70,' '),
(146,29,'17001',' jawaban','FILE','2020-04-16 19:47:20',99,' '),
(147,29,'17002',' jawaban','FILE','2020-04-16 19:47:20',85,' '),
(148,29,'17003',' jawaban','FILE','2020-04-16 19:47:20',70,' '),
(149,29,'17005',' jawaban','FILE','2020-04-16 19:47:20',70,' '),
(150,29,'17006',' jawaban','FILE','2020-04-16 19:47:20',80,' '),
(151,29,'17007',' jawaban','FILE','2020-04-16 19:47:20',80,' '),
(152,29,'17008',' jawaban','FILE','2020-04-16 19:47:20',85,' '),
(153,30,'17000',' jawaban','FILE','2020-04-23 19:48:02',70,' '),
(154,30,'17001',' jawaban','FILE','2020-04-23 19:48:02',70,' '),
(155,30,'17002',' jawaban','FILE','2020-04-23 19:48:02',99,' '),
(156,30,'17003',' jawaban','FILE','2020-04-23 19:48:02',70,' '),
(157,30,'17005',' jawaban','FILE','2020-04-23 19:48:02',70,' '),
(158,30,'17006',' jawaban','FILE','2020-04-23 19:48:02',70,' '),
(159,30,'17007',' jawaban','FILE','2020-04-23 19:48:02',80,' '),
(160,30,'17008',' jawaban','FILE','2020-04-23 19:48:02',80,' '),
(161,30,'17009',' jawaban','FILE','2020-04-23 19:48:02',80,' '),
(162,31,'17000',' jawaban','FILE','2020-05-07 19:48:02',70,' '),
(163,33,'17001',' jawaban','FILE','2020-05-14 19:49:07',85,' '),
(164,31,'17002',' jawaban','FILE','2020-05-07 19:48:02',85,' '),
(165,31,'17003',' jawaban','FILE','2020-05-07 19:48:02',70,' '),
(166,31,'17005',' jawaban','FILE','2020-05-07 19:48:02',99,' '),
(167,31,'17006',' jawaban','FILE','2020-05-07 19:48:02',85,' '),
(168,31,'17007',' jawaban','FILE','2020-05-07 19:48:02',70,' '),
(169,31,'17008',' jawaban','FILE','2020-05-07 19:48:02',80,' '),
(171,33,'17000',' jawaban','FILE','2020-05-14 19:49:07',85,' '),
(172,33,'17002',' jawaban','FILE','2020-05-14 19:49:07',85,' '),
(173,33,'17003',' jawaban','FILE','2020-05-14 19:49:07',85,' '),
(174,33,'17005',' jawaban','FILE','2020-05-14 19:49:07',70,' '),
(175,33,'17006',' jawaban','FILE','2020-05-14 19:49:07',85,' '),
(176,33,'17007',' jawaban','FILE','2020-05-14 19:49:07',80,' '),
(177,33,'17008',' jawaban','FILE','2020-05-14 19:49:07',80,' '),
(178,33,'17009',' jawaban','FILE','2020-05-14 19:49:07',70,' '),
(179,34,'17000',' jawaban','FILE','2020-05-21 19:51:28',85,' '),
(180,34,'17001',' jawaban','FILE','2020-05-21 19:51:28',99,' '),
(181,34,'17002',' jawaban','FILE','2020-05-21 19:51:28',70,' '),
(182,34,'17003',' jawaban','FILE','2020-05-21 19:51:28',70,' '),
(183,34,'17005',' jawaban','FILE','2020-05-21 19:51:28',70,' '),
(184,34,'17006',' jawaban','FILE','2020-05-21 19:51:28',99,' '),
(185,34,'17007',' jawaban','FILE','2020-05-21 19:51:28',85,' '),
(186,34,'17008',' jawaban','FILE','2020-05-21 19:51:28',85,' '),
(187,34,'17009',' jawaban','FILE','2020-05-21 19:51:28',80,' '),
(188,36,'17000',' jawaban','FILE','2020-05-29 19:51:46',85,' '),
(189,36,'17001',' jawaban','FILE','2020-05-29 19:51:46',80,' '),
(190,36,'17002',' jawaban','FILE','2020-05-29 19:51:46',80,' '),
(191,36,'17003',' jawaban','FILE','2020-05-29 19:51:46',80,' '),
(192,36,'17005',' jawaban','FILE','2020-05-29 19:51:46',70,' '),
(193,36,'17006',' jawaban','FILE','2020-05-29 19:51:46',85,' '),
(194,36,'17007',' jawaban','FILE','2020-05-29 19:51:46',80,' '),
(195,36,'17008',' jawaban','FILE','2020-05-29 19:51:46',80,' '),
(196,36,'17009',' jawaban','FILE','2020-05-29 19:51:46',99,' '),
(197,37,'17045',' jawaban','FILE','2020-06-01 19:52:01',80,' '),
(198,37,'17132',' jawaban','FILE','2020-06-01 19:52:01',80,' '),
(199,37,'17012',' jawaban','FILE','2020-06-01 19:52:01',70,' '),
(200,37,'17012',' jawaban','FILE','2020-06-01 19:52:01',80,' '),
(201,37,'17013',' jawaban','FILE','2020-06-01 19:52:01',80,' '),
(202,37,'17015',' jawaban','FILE','2020-06-01 19:52:01',85,' '),
(203,37,'17016',' jawaban','FILE','2020-06-01 19:52:01',87,' '),
(206,38,'17045',' jawaban','FILE','2020-06-09 19:52:01',80,' '),
(207,38,'17132',' jawaban','FILE','2020-06-01 19:52:01',99,' '),
(208,38,'17011',' jawaban','FILE','2020-06-01 19:52:01',89,' '),
(209,38,'17012',' jawaban','FILE','2020-06-01 19:52:01',70,' '),
(210,38,'17013',' jawaban','FILE','2020-06-01 19:52:01',80,' '),
(211,38,'17015',' jawaban','FILE','2020-06-01 19:52:01',80,' '),
(212,38,'17016',' jawaban','FILE','2020-06-01 19:52:01',80,' '),
(213,39,'17045',' jawaban','FILE','2020-06-01 19:52:01',87,' '),
(214,39,'17132',' jawaban','FILE','2020-06-01 19:52:01',80,' '),
(215,39,'17011',' jawaban','FILE','2020-06-08 21:19:20',85,' '),
(216,39,'17012',' jawaban','FILE','2020-06-08 21:19:20',87,' '),
(217,39,'17013',' jawaban','FILE','2020-06-08 21:19:20',70,' '),
(218,39,'17015',' jawaban','FILE','2020-06-08 21:19:20',87,' '),
(219,39,'17016',' jawaban','FILE','2020-06-08 21:19:20',99,' '),
(220,40,'17045',' jawaban','FILE','2020-06-08 21:20:40',87,' '),
(221,40,'17132',' jawaban','FILE','2020-06-08 21:20:40',87,' '),
(222,40,'17011',' jawaban','FILE','2020-06-08 21:20:40',80,' '),
(223,40,'17012',' jawaban','FILE','2020-06-08 21:20:40',80,' '),
(224,40,'17013',' jawaban','FILE','2020-06-08 21:20:40',88,' '),
(225,40,'17015',' jawaban','FILE','2020-06-08 21:20:40',70,' '),
(226,40,'17016',' jawaban','FILE','2020-06-08 21:20:40',85,' '),
(227,41,'17045',' jawaban','FILE','2020-06-08 21:27:29',85,' '),
(228,41,'17132',' jawaban','FILE','2020-06-08 21:27:29',87,' '),
(229,41,'17011',' jawaban','FILE','2020-06-08 21:27:29',70,' '),
(230,41,'17012',' jawaban','FILE','2020-06-08 21:27:29',87,' '),
(231,41,'17013',' jawaban','FILE','2020-06-08 21:27:29',99,' '),
(232,41,'17015',' jawaban','FILE','2020-06-08 21:27:29',87,' '),
(233,41,'17016',' jawaban','FILE','2020-06-08 21:27:29',70,' '),
(234,42,'17045',' jawaban','FILE','2020-06-08 21:28:50',85,' '),
(235,42,'17132',' jawaban','FILE','2020-06-08 21:28:50',87,' '),
(236,42,'17011',' jawaban','FILE','2020-06-08 21:28:50',70,' '),
(237,42,'17012',' jawaban','FILE','2020-06-08 21:28:50',87,' '),
(238,42,'17013',' jawaban','FILE','2020-06-08 21:28:50',80,' '),
(239,42,'17015',' jawaban','FILE','2020-06-08 21:28:50',87,' '),
(240,42,'17016',' jawaban','FILE','2020-06-08 21:28:50',85,' '),
(241,43,'17045',' jawaban','FILE','2020-06-08 21:29:02',70,' '),
(242,43,'17132',' jawaban','FILE','2020-06-08 21:29:02',79,' '),
(243,43,'17011',' jawaban','FILE','2020-06-08 21:29:02',99,' '),
(244,43,'17012',' jawaban','FILE','2020-06-08 21:29:02',78,' '),
(245,43,'17013',' jawaban','FILE','2020-06-08 21:29:02',80,' '),
(246,43,'17015',' jawaban','FILE','2020-06-08 21:29:02',80,' '),
(247,43,'17016',' jawaban','FILE','2020-06-08 21:29:02',80,' '),
(248,44,'17045',' jawaban','FILE','2020-06-08 21:29:18',81,' '),
(249,44,'17132',' jawaban','FILE','2020-06-08 21:29:18',85,' '),
(250,44,'17011',' jawaban','FILE','2020-06-08 21:29:18',85,' '),
(251,44,'17012',' jawaban','FILE','2020-06-08 21:29:18',85,' '),
(252,44,'17013',' jawaban','FILE','2020-06-08 21:29:18',70,' '),
(253,44,'17015',' jawaban','FILE','2020-06-08 21:29:18',84,' '),
(254,44,'17016',' jawaban','FILE','2020-06-08 21:29:18',99,' '),
(255,45,'17045',' jawaban','FILE','2020-06-08 21:31:31',83,' '),
(256,45,'17132',' jawaban','FILE','2020-06-08 21:31:31',70,' '),
(257,45,'17011',' jawaban','FILE','2020-06-08 21:31:31',85,' '),
(258,45,'17012',' jawaban','FILE','2020-06-08 21:31:32',83,' '),
(259,45,'17013',' jawaban','FILE','2020-06-08 21:31:32',85,' '),
(260,45,'17015',' jawaban','FILE','2020-06-08 21:31:32',86,' '),
(261,45,'17016',' jawaban','FILE','2020-06-08 21:31:32',87,' '),
(262,46,'17045',' jawaban','FILE','2020-06-08 21:31:44',100,' '),
(263,46,'17132',' jawaban','FILE','2020-06-08 21:31:44',88,' '),
(264,46,'17011',' jawaban','FILE','2020-06-08 21:31:44',85,' '),
(265,46,'17012',' jawaban','FILE','2020-06-08 21:31:44',87,' '),
(266,46,'17013',' jawaban','FILE','2020-06-08 21:31:44',87,' '),
(267,46,'17015',' jawaban','FILE','2020-06-08 21:31:44',70,' '),
(268,46,'17016',' jawaban','FILE','2020-06-08 21:31:44',87,' '),
(269,47,'17045',' jawaban','FILE','2020-06-08 21:32:04',85,' '),
(270,47,'17132',' jawaban','FILE','2020-06-08 21:32:04',85,' '),
(271,47,'17011',' jawaban','FILE','2020-06-08 21:32:04',85,' '),
(272,47,'17012',' jawaban','FILE','2020-06-08 21:32:04',85,' '),
(273,47,'17013',' jawaban','FILE','2020-06-08 21:32:05',80,' '),
(274,47,'17015',' jawaban','FILE','2020-06-08 21:32:05',80,' '),
(275,47,'17016',' jawaban','FILE','2020-06-08 21:32:05',80,' '),
(276,48,'17045',' jawaban','FILE','2020-06-08 21:33:24',80,' '),
(277,48,'17132',' jawaban','FILE','2020-06-08 21:33:24',85,' '),
(278,48,'17011',' jawaban','FILE','2020-06-08 21:33:24',80,' '),
(279,48,'17012',' jawaban','FILE','2020-06-08 21:33:25',80,' '),
(280,48,'17013',' jawaban','FILE','2020-06-08 21:33:25',85,' '),
(281,48,'17015',' jawaban','FILE','2020-06-08 21:33:25',80,' '),
(282,48,'17016',' jawaban','FILE','2020-06-08 21:33:25',80,' '),
(283,49,'17045',' jawaban','FILE','2020-06-08 21:33:34',85,' '),
(284,49,'17132',' jawaban','FILE','2020-06-08 21:33:34',80,' '),
(285,49,'17011',' jawaban','FILE','2020-06-08 21:33:34',85,' '),
(286,49,'17012',' jawaban','FILE','2020-06-08 21:33:34',85,' '),
(287,49,'17013',' jawaban','FILE','2020-06-08 21:33:34',80,' '),
(288,49,'17015',' jawaban','FILE','2020-06-08 21:33:34',70,' '),
(289,49,'17016',' jawaban','FILE','2020-06-08 21:33:34',85,' '),
(290,50,'17045',' jawaban','FILE','2020-06-08 21:34:09',80,' '),
(291,50,'17132',' jawaban','FILE','2020-06-08 21:34:09',85,' '),
(292,50,'17011',' jawaban','FILE','2020-06-08 21:34:09',80,' '),
(293,50,'17012',' jawaban','FILE','2020-06-08 21:34:09',85,' '),
(294,50,'17013',' jawaban','FILE','2020-06-08 21:34:09',80,' '),
(295,50,'17015',' jawaban','FILE','2020-06-08 21:34:09',80,' '),
(296,50,'17016',' jawaban','FILE','2020-06-08 21:34:09',85,' '),
(297,51,'17045',' jawaban','FILE','2020-06-08 21:38:02',70,' '),
(298,51,'17132',' jawaban','FILE','2020-06-08 21:38:02',80,' '),
(299,51,'17011',' jawaban','FILE','2020-06-08 21:38:02',85,' '),
(300,51,'17012',' jawaban','FILE','2020-06-08 21:38:02',80,' '),
(301,51,'17013',' jawaban','FILE','2020-06-08 21:38:02',80,' '),
(302,51,'17015',' jawaban','FILE','2020-06-08 21:38:02',85,' '),
(303,51,'17016',' jawaban','FILE','2020-06-08 21:38:02',80,' '),
(304,52,'17045',' jawaban','FILE','2020-06-08 21:38:12',80,' '),
(305,52,'17132',' jawaban','FILE','2020-06-08 21:38:13',80,' '),
(306,52,'17011',' jawaban','FILE','2020-06-08 21:38:13',70,' '),
(307,52,'17012',' jawaban','FILE','2020-06-08 21:38:13',80,' '),
(308,52,'17013',' jawaban','FILE','2020-06-08 21:38:13',80,' '),
(309,52,'17015',' jawaban','FILE','2020-06-08 21:38:13',85,' '),
(310,52,'17016',' jawaban','FILE','2020-06-08 21:38:13',80,' '),
(311,53,'17045',' jawaban','FILE','2020-06-08 21:38:27',80,' '),
(312,53,'17132',' jawaban','FILE','2020-06-08 21:38:27',80,' '),
(313,53,'17011',' jawaban','FILE','2020-06-08 21:38:27',80,' '),
(314,53,'17012',' jawaban','FILE','2020-06-08 21:38:27',70,' '),
(315,53,'17013',' jawaban','FILE','2020-06-08 21:38:27',85,' '),
(316,53,'17015',' jawaban','FILE','2020-06-08 21:38:28',80,' '),
(317,53,'17016',' jawaban','FILE','2020-06-08 21:38:28',80,' '),
(318,54,'17045',' jawaban','FILE','2020-06-08 21:38:44',80,' '),
(319,54,'17132',' jawaban','FILE','2020-06-08 21:38:44',80,' '),
(320,54,'17011',' jawaban','FILE','2020-06-08 21:38:44',70,' '),
(321,54,'17012',' jawaban','FILE','2020-06-08 21:38:44',80,' '),
(322,54,'17013',' jawaban','FILE','2020-06-08 21:38:44',70,' '),
(323,54,'17015',' jawaban','FILE','2020-06-08 21:38:44',80,' '),
(324,54,'17016',' jawaban','FILE','2020-06-08 21:38:44',80,' '),
(325,55,'17045',' jawaban','FILE','2020-06-08 21:39:17',80,' '),
(326,55,'17132',' jawaban','FILE','2020-06-08 21:39:17',80,' '),
(327,55,'17011',' jawaban','FILE','2020-06-08 21:39:17',80,' '),
(328,55,'17012',' jawaban','FILE','2020-06-08 21:39:17',80,' '),
(329,55,'17013',' jawaban','FILE','2020-06-08 21:39:17',80,' '),
(330,55,'17015',' jawaban','FILE','2020-06-08 21:39:17',85,' '),
(331,55,'17016',' jawaban','FILE','2020-06-08 21:39:17',80,' '),
(332,56,'17045',' jawaban','FILE','2020-06-08 21:39:29',80,' '),
(333,56,'17132',' jawaban','FILE','2020-06-08 21:39:30',85,' '),
(334,56,'17011',' jawaban','FILE','2020-06-08 21:39:30',80,' '),
(335,56,'17012',' jawaban','FILE','2020-06-08 21:39:30',80,' '),
(336,56,'17013',' jawaban','FILE','2020-06-08 21:39:30',80,' '),
(337,56,'17015',' jawaban','FILE','2020-06-08 21:39:30',70,' '),
(338,56,'17016',' jawaban','FILE','2020-06-08 21:39:30',80,' '),
(339,56,'17016',' jawaban','FILE','2020-06-11 12:39:57',0,' '),
(340,57,'17001',' jawaban','FILE','2020-06-18 23:08:26',0,' '),
(341,57,'17001',' jawaban','FILE','2020-06-18 23:13:26',0,' '),
(343,67,'17003',NULL,'NIM_NAMA.docx','2020-12-14 18:32:12',NULL,NULL),
(349,78,'17045',NULL,'1847076335_QUIZ KE-3 EPSI 180441100074_Fikky Alvian Firmansyah.doc','2021-01-03 20:32:40',100,NULL);

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `user_name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `id_dosen` varchar(20) DEFAULT NULL,
  `id_mahasiswa` varchar(30) DEFAULT NULL,
  `level` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`user_name`),
  KEY `id_dosen` (`id_dosen`),
  KEY `id_mahasiswa` (`id_mahasiswa`),
  CONSTRAINT `login_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`),
  CONSTRAINT `login_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mhs` (`id_mhs`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `login` */

insert  into `login`(`user_name`,`password`,`id_dosen`,`id_mahasiswa`,`level`) values 
('aji','aji',NULL,'17003','mahasiswa'),
('ali','ali','d6',NULL,'dosen'),
('bambang','bambang','d2',NULL,'dosen'),
('bilal','bilal','d7',NULL,'dosen'),
('budi','budi','d1',NULL,'dosen'),
('datin','datin',NULL,'17001','mahasiswa'),
('deday','deday',NULL,'17099','mahasiswa'),
('desi','desi',NULL,'17132','mahasiswa'),
('fatha','fatha',NULL,'17002','mahasiswa'),
('fikky','fikky','d5',NULL,'dosen'),
('firmansyah','firmansyah','d3',NULL,'dosen'),
('hans','hans','d11',NULL,'dosen'),
('joko','joko','d1099',NULL,'dosen'),
('ravi ','ravi','d4',NULL,'dosen'),
('ririn','ririn',NULL,'17000','mahasiswa'),
('rizki','rizki','d8',NULL,'dosen'),
('rosi','rosi','d9',NULL,'dosen'),
('user','user','d000',NULL,'dosen'),
('via','via',NULL,'17045','mahasiswa');

/*Table structure for table `materi` */

DROP TABLE IF EXISTS `materi`;

CREATE TABLE `materi` (
  `idmateri` bigint(30) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) DEFAULT NULL,
  `isi` tinytext DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `id_kelas` bigint(20) DEFAULT NULL,
  `tgl_diupload` date DEFAULT NULL,
  PRIMARY KEY (`idmateri`),
  KEY `id_kelas` (`id_kelas`),
  CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

/*Data for the table `materi` */

insert  into `materi`(`idmateri`,`judul`,`isi`,`file`,`id_kelas`,`tgl_diupload`) values 
(1,'pengantar stored procedure','materi stored procedure',NULL,2,'2020-01-01'),
(2,'trigger','materi trigger','09_Basis_Data_Lanjut_-_Trigger',2,'2020-01-08'),
(3,'pengantar stored procedure',NULL,NULL,3,'2020-01-15'),
(4,'trigger',NULL,NULL,3,'2020-01-22'),
(5,'cara review database',NULL,NULL,2,'2020-01-29'),
(6,'cara review database',NULL,NULL,3,'2020-02-05'),
(7,'apa itu html,css dan php',NULL,NULL,4,'2020-02-12'),
(8,'view',NULL,NULL,2,'2020-02-19'),
(9,'view',NULL,NULL,3,'2020-02-26'),
(10,'function',NULL,NULL,2,'2020-03-04'),
(11,'function',NULL,NULL,3,'2020-03-11'),
(12,'MATERI UAS','MATERI',' file',2,'2020-06-18'),
(13,'materi audit pengantar',NULL,NULL,14,'2020-06-25'),
(14,'framework cobit 5 dan cobit 20',NULL,NULL,14,'2020-06-25'),
(17,'apa itu analisa desain SI',NULL,NULL,8,'2020-06-25'),
(18,'UAS DATA SCIENCE','Minggu depan UAS data science ',NULL,17,'2020-12-10'),
(19,'UAS RPL B','Pelajari tentang analisis dan desain sistem informasi',NULL,11,'2020-12-10'),
(41,'Cara Membuat Fitur CRUD yang Benar!','Silahkan pelajari materi berikut','1583744427_The Reversal of Technology.pptx',11,'2020-12-12'),
(42,'pengumuman perkuliahan offline','sehubungan blablabla',NULL,2,'2020-12-16'),
(47,'hari pertama','perkuliahan akan dimulai pada tanggal 14 januari 2021',NULL,18,'2021-01-01');

/*Table structure for table `mhs` */

DROP TABLE IF EXISTS `mhs`;

CREATE TABLE `mhs` (
  `id_mhs` varchar(30) NOT NULL,
  `nm_mhs` varchar(30) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `notelp` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_mhs`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mhs` */

insert  into `mhs`(`id_mhs`,`nm_mhs`,`email`,`notelp`) values 
('17000','ririn dwi','ririn@g.com','0923421'),
('17001','datin suroso','datin@g.com','0923321'),
('17002','fatha adilla','fatha@g.com','0926321'),
('17003','gusti adjhi','gusti@g.com','09263222'),
('17005','yuadita','yua@g.com','0989852'),
('17006','ach amsori','ams@g.com','0982352'),
('17007','yusuf efendi','yusuf@g.com','0989879'),
('17008','sri tatik ','sri@g.com','0911879'),
('17009','ach tahar asy ','aang@g.com','0914479'),
('17011','ach zainal','sinal@g.com','0911479'),
('17012','diana safira','ira@g.com','0918769'),
('17013','dian ardenia','dian@g.com','0919999'),
('17014','dian ardenia','dian@g.com','0919999'),
('17015','balqis arafah','alqis@g.com','0922399'),
('17016','rijal arwadi','ijall@g.com','0923219'),
('17045','via vebiola','via@g.com','086764527382'),
('17099','deday putri rahajeng','','0987763746324'),
('17132','desi damayanti','desi@g.com','09898987');

/*Table structure for table `tugas` */

DROP TABLE IF EXISTS `tugas`;

CREATE TABLE `tugas` (
  `idtugas` bigint(30) NOT NULL AUTO_INCREMENT,
  `id_kelas` bigint(20) NOT NULL,
  `uraian_tugas` varchar(30) DEFAULT NULL,
  `file_tugas` tinytext DEFAULT NULL,
  `waktu_upload` date DEFAULT NULL,
  `batas_akhir` date DEFAULT NULL,
  PRIMARY KEY (`idtugas`),
  KEY `id_kelas` (`id_kelas`),
  CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1 COMMENT='dosen memberikan tugas';

/*Data for the table `tugas` */

insert  into `tugas`(`idtugas`,`id_kelas`,`uraian_tugas`,`file_tugas`,`waktu_upload`,`batas_akhir`) values 
(1,2,'membuat database',NULL,'2020-01-01','2020-01-03'),
(2,2,'buatlah query join dan where',NULL,'2020-01-03','2020-01-10'),
(4,2,'dengan menggunakan dtaabse yan','file','2020-01-10','2020-01-17'),
(5,2,'apa itu asd dsc ',NULL,'2020-01-17','2020-01-24'),
(6,2,'ss query menambhkan data , dan',NULL,'2020-01-24','2020-01-31'),
(13,2,'cara membuat database yang ben',NULL,'2020-01-31','2020-02-07'),
(14,2,'cara membuat database yang ben',NULL,'2020-02-07','2020-02-14'),
(16,2,'review dan analisa database 1 ',NULL,'2020-02-14','2020-02-21'),
(18,2,'review dan analisa database 2',NULL,'2020-02-21','2020-02-28'),
(19,2,'membiuat desain database sendi',NULL,'2020-02-28','2020-03-06'),
(21,2,'membiuat desain database sendi',NULL,'2020-03-06','2020-03-13'),
(24,2,'stored procedure 1',NULL,'2020-03-13','2020-03-20'),
(25,2,'stored procedure 2',NULL,'2020-03-20','2020-03-27'),
(27,2,'quis',NULL,'2020-04-03','2020-04-03'),
(28,2,'uts',NULL,'2020-04-10','2020-04-10'),
(29,2,'view',NULL,'2020-04-10','2020-04-17'),
(30,2,'function 1',NULL,'2020-04-17','2020-04-24'),
(31,2,'function 2',NULL,'2020-04-24','2020-05-08'),
(33,2,'trigger 1',NULL,'2020-05-08','2020-05-15'),
(34,2,'trigger 2',NULL,'2020-05-15','2020-05-22'),
(36,2,'project Uas',NULL,'2020-05-22','2020-05-29'),
(37,3,'tugas 1',' file','2020-01-03','2020-01-03'),
(38,3,'membuat database',NULL,'2020-01-03','2020-01-10'),
(39,3,'buatlah query join dan where',NULL,'2020-01-10','2020-01-17'),
(40,3,'dengan menggunakan dtaabse yan',NULL,NULL,'2020-01-24'),
(41,3,'apa itu asd dsc ',NULL,NULL,'2020-01-31'),
(42,3,'ss query menambhkan data , dan',NULL,NULL,'2020-02-07'),
(43,3,'cara membuat database yang ben',NULL,NULL,'2020-02-14'),
(44,3,'cara membuat database yang ben',NULL,NULL,'2020-02-21'),
(45,3,'review dan analisa database 1 ',NULL,NULL,'2020-02-28'),
(46,3,'review dan analisa database 2',NULL,NULL,'2020-03-06'),
(47,3,'membiuat desain database sendi',NULL,NULL,'2020-03-13'),
(48,3,'membiuat desain database sendi',NULL,NULL,'2020-03-20'),
(49,3,'stored procedure 1',NULL,NULL,'2020-03-27'),
(50,3,'stored procedure 2',NULL,NULL,'2020-04-03'),
(51,3,'quis',NULL,NULL,'2020-04-10'),
(52,3,'uts',NULL,NULL,'2020-04-17'),
(53,3,'view',NULL,NULL,'2020-04-24'),
(54,3,'function 1',NULL,NULL,'2020-05-08'),
(55,3,'function 2',NULL,NULL,'2020-05-15'),
(56,3,'project Uas',NULL,NULL,'2020-05-22'),
(57,2,'UAS',' file','2020-06-18','2020-06-22'),
(58,14,'pengantar audit',NULL,'2020-06-11','2020-06-12'),
(59,14,' framework untuk audit',NULL,'2020-06-25','2020-06-19'),
(60,8,'membuat usecase dari study kas',NULL,'2020-06-25','2020-06-05'),
(61,2,'teks','file','2020-11-12','2020-11-14'),
(62,2,'TESSSSSSSSSSSSSSSSSSSSSS','file','2020-11-12','2020-11-14'),
(63,2,'TESSSSSSSSSSSSSSSSSSSSSS',NULL,'2020-11-12','2020-11-14'),
(64,2,'HA','PILE','2020-11-12','2020-11-14'),
(67,11,'Membuat database sederhana','template lapres modul.docx','2020-12-07','2020-12-10'),
(69,17,'Membuat analisis data ','','2020-12-10','2020-12-17'),
(72,11,'Membuat crud menggunakan php','','2020-12-11','2020-12-12'),
(77,17,'Tes telat','','2020-12-30','2020-12-31'),
(78,18,'download, dan kerjakan soal ya','implementasi neural network.pdf','2021-01-01','2021-02-06'),
(79,18,'silahkan ikuti yang ada di fil','1761184940_Rule Project SPK.docx','2021-01-01','2021-01-04');

/* Trigger structure for table `kumpulkan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `upload` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `upload` BEFORE INSERT ON `kumpulkan` FOR EACH ROW BEGIN
set new.tgl_upload = now();
    END */$$


DELIMITER ;

/* Trigger structure for table `materi` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `uploadmateri` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `uploadmateri` BEFORE INSERT ON `materi` FOR EACH ROW BEGIN
SET new.tgl_diupload = NOW();
    END */$$


DELIMITER ;

/* Trigger structure for table `tugas` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `uploadtugas` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `uploadtugas` BEFORE INSERT ON `tugas` FOR EACH ROW BEGIN
SET new.waktu_upload = NOW();
    END */$$


DELIMITER ;

/* Procedure structure for procedure `p_cekkumpulkan` */

/*!50003 DROP PROCEDURE IF EXISTS  `p_cekkumpulkan` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `p_cekkumpulkan`(
	IN p_idtugas INT(30),
	IN p_idmhs INT(30),
	IN p_uraian_jawaban VARCHAR(30),
	IN p_file TEXT(50),
	IN p_tgl_upload DATE,
	IN p_nilai DECIMAL(10),
	IN p_ket VARCHAR (50))
BEGIN
DECLARE idmahasiswa varchar(10);
SELECT idmhs INTO idmahasiswa FROM kumpulkan WHERE idmhs = p_idmhs;
IF idmahasiswa IS NOT NULL THEN
 SELECT 'tugas anda telah terkirim' AS notif;
ELSE
 INSERT INTO kumpulkan VALUES(NULL,p_idtugas, p_idmhs, p_uraian_jawaban, p_file, p_tgl_upload, p_nilai, p_ket);
END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `rata` */

/*!50003 DROP PROCEDURE IF EXISTS  `rata` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `rata`(
in p_idmhs varchar(30),
out rata_rata decimal(20))
begin
SELECT AVG(nilai)into rata_rata FROM kumpulkan 
where idmhs = p_idmhs;
end */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
