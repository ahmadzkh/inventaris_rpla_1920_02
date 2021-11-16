-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2021 at 07:12 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invent_ukom`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_barangout` (`id` CHAR(8), `jumlah` INT, `supplier` CHAR(6))  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION, SQLWARNING ROLLBACK;
    START TRANSACTION;

    INSERT INTO barang_keluar VALUES(id, CURRENT_DATE(), jumlah, supplier);
    
    UPDATE stok SET stok.jml_keluar = stok.jml_keluar + jumlah, stok.total_barang = stok.jml_masuk - stok.jml_keluar WHERE id_barang = id;

    COMMIT;
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_newbarangin` (IN `id` CHAR(8), IN `nama` VARCHAR(225), IN `spesifikasi` TEXT, IN `lokasi` CHAR(4), IN `kondisi` VARCHAR(20), IN `jumlah` INT, IN `sumber` CHAR(4), IN `gambar` VARCHAR(225), IN `supplier` CHAR(6))  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION, SQLWARNING ROLLBACK;
    START TRANSACTION;

    INSERT INTO barang VALUES(id, nama, spesifikasi, lokasi, kondisi, jumlah, sumber, gambar);

    INSERT INTO barang_masuk VALUES(id, CURRENT_DATE(), jumlah, supplier);

    COMMIT;
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_stokin` (IN `id` CHAR(8), IN `jml` INT)  BEGIN

DECLARE masuk int DEFAULT 0;
DECLARE total int DEFAULT 0;

SELECT jml_masuk INTO masuk FROM stok WHERE id_barang = id;

UPDATE stok SET stok.jml_masuk = masuk + jml, stok.total_barang = stok.jml_masuk - stok.jml_keluar WHERE id_barang = id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_stokout` (IN `id` CHAR(8), IN `jml` INT)  BEGIN

DECLARE keluar int DEFAULT 0;
DECLARE total int DEFAULT 0;

SELECT jml_keluar INTO keluar FROM stok WHERE id_barang = id;

UPDATE stok SET stok.jml_keluar = keluar + jml, stok.total_barang = stok.jml_masuk - stok.jml_keluar WHERE id_barang = id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rollback_stokin` (IN `id` CHAR(8), IN `jml` INT)  BEGIN

DECLARE masuk int DEFAULT 0;
DECLARE total int DEFAULT 0;

SELECT jml_masuk INTO masuk FROM stok WHERE id_barang = id;

UPDATE stok SET stok.jml_masuk = masuk - jml, stok.total_barang = stok.jml_masuk - stok.jml_keluar WHERE id_barang = id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rollback_stokout` (IN `id` CHAR(8), IN `jml` INT)  BEGIN

DECLARE keluar int DEFAULT 0;
DECLARE total int DEFAULT 0;

SELECT jml_keluar INTO keluar FROM stok WHERE id_barang = id;

UPDATE stok SET stok.jml_keluar = keluar- jml, stok.total_barang = stok.jml_masuk - stok.jml_keluar WHERE id_barang = id;

END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `newidsupplier` () RETURNS CHAR(8) CHARSET utf8mb4 BEGIN

DECLARE old_id CHAR(6) DEFAULT 'SPR001';
DECLARE angka CHAR(3) DEFAULT '000';
DECLARE new_id CHAR(6) DEFAULT 'SPR000';

SELECT MAX(id_supplier) INTO old_id FROM supplier;
SET angka = SUBSTRING(old_id, 4, 3);
SET angka = LPAD(angka + 1, 3, 0);
SET new_id = CONCAT('SPR', angka);
RETURN new_id;

END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `newkodebarang` () RETURNS CHAR(8) CHARSET utf8mb4 BEGIN
	DECLARE kode_lama CHAR(8) DEFAULT "BRG10001";
    DECLARE ambil_angka CHAR(5) DEFAULT "00000";
    DECLARE kode_baru CHAR(8) DEFAULT "BRG00000";
    
    SELECT MAX(id_barang) INTO kode_lama FROM barang;
    
    SET ambil_angka =  SUBSTR(kode_lama, 4, 5);
    SET ambil_angka = ambil_angka + 1;
    SET kode_baru = CONCAT("BRG", ambil_angka);
    
    RETURN kode_baru;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` char(8) NOT NULL,
  `nama_barang` varchar(225) DEFAULT NULL,
  `spesifikasi` text DEFAULT NULL,
  `lokasi` char(4) DEFAULT NULL,
  `kondisi` varchar(20) DEFAULT NULL,
  `jumlah_barang` int(11) DEFAULT NULL,
  `sumber_dana` char(4) DEFAULT NULL,
  `gambar` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `spesifikasi`, `lokasi`, `kondisi`, `jumlah_barang`, `sumber_dana`, `gambar`) VALUES
('BRG10001', 'Kursi Siswa', 'Chitose', 'R001', 'Baik', 36, 'S002', 'BRG10001.jpg'),
('BRG10002', 'Kursi Siswa', 'Kursi Lipat', 'R002', 'Rusak', 36, 'S002', 'BRG10002.jpg'),
('BRG10003', 'Kursi Siswa', 'Chitose', 'R003', 'Baik', 36, 'S002', 'BRG10003.jpg'),
('BRG10004', 'Kursi Siswa', 'Chitose', 'R004', 'Baik', 36, 'S002', 'BRG10004.jpg'),
('BRG20001', 'PC Rakitan', 'Intel celeron 2MB', 'R001', 'Baik', 24, 'S001', 'default.png'),
('BRG20002', 'PC Build in', 'Intel quad core 2MB', 'R001', 'Rusak', 6, 'S002', 'default.png'),
('BRG20003', 'Laptop', 'Lenovo E550 core i7', 'R002', 'Baik', 23, 'S003', 'BRG20003.jpg'),
('BRG20004', 'Laptop', 'Acer Intel Core i3', 'R002', 'Baik', 30, 'S002', 'default.png'),
('BRG20005', 'PC Build in', 'Dell Optiplex core i7', 'R003', 'Baik', 36, 'S003', 'default.png'),
('BRG20006', 'PC Rakitan', 'Intel core i5', 'R004', 'Baik', 36, 'S002', 'BRG20006.jpg'),
('BRG20007', 'PC Build in', 'HP Core i7 gen10', 'R005', 'Baik', 10, 'S005', 'default.png'),
('BRG20008', 'Tab', 'Samsung SM-T295', 'R001', 'Baik', 36, 'S005', 'BRG20008.jpg'),
('BRG20009', 'Tab', 'Samsung SM-T295', 'R002', 'Baik', 36, 'S005', 'BRG20009.jpg'),
('BRG20010', 'Tab', 'Samsung SM-T295', 'R003', 'Baik', 36, 'S005', 'BRG20010.jpg'),
('BRG20011', 'Tab', 'Samsung SM-T295', 'R004', 'Baik', 36, 'S005', 'default.png'),
('BRG20012', 'Tab', 'Samsung SM-T-295', 'R005', 'Baik', 36, 'S005', 'BRG20012.jpg'),
('BRG20013', 'USB Lan Converter', 'TPL-Link UE300', 'R001', 'Baik', 36, 'S004', 'BRG20013.jpg'),
('BRG20014', 'Mikrotik', 'RB750', 'R003', 'Baik', 36, 'S004', 'BRG20014.jpg'),
('BRG20015', 'Camera DSLR', 'Canon D60', 'R005', 'Baik', 16, 'S003', 'BRG20015.jpg'),
('BRG20016', 'Lighting Set', 'Troning Lighting Set', 'R005', 'Baik', 2, 'S004', 'default.png'),
('BRG20017', 'Tripod', 'Takara', 'R005', 'Baik', 10, 'S004', 'BRG20017.jpg'),
('BRG20018', 'MacBook Ultra 11', 'RATA KANAN LEMOT', 'R001', 'ad', 12, 'S001', 'BRG20018.jpg');

--
-- Triggers `barang`
--
DELIMITER $$
CREATE TRIGGER `delete_stok` AFTER DELETE ON `barang` FOR EACH ROW BEGIN 

DELETE FROM stok WHERE id_barang = OLD.id_barang;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_newstock` AFTER INSERT ON `barang` FOR EACH ROW BEGIN 

INSERT INTO stok VALUES(NEW.id_barang, NEW.jumlah_barang, 0, NEW.jumlah_barang);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stokin` AFTER UPDATE ON `barang` FOR EACH ROW BEGIN 

UPDATE stok SET stok.jml_masuk = NEW.jumlah_barang, stok.total_barang = NEW.jumlah_barang - stok.jml_keluar WHERE id_barang = OLD.id_barang;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang` char(8) NOT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `jml_keluar` int(11) DEFAULT NULL,
  `supplier` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang`, `tgl_keluar`, `jml_keluar`, `supplier`) VALUES
('BRG10001', '2019-07-16', 16, 'SPR001'),
('BRG10002', '2019-07-16', 10, 'SPR002'),
('BRG10003', '2019-07-16', 5, 'SPR001'),
('BRG10004', '2019-07-16', 10, 'SPR001'),
('BRG20001', '2017-07-16', 19, 'SPR004'),
('BRG20002', '2018-07-16', 6, 'SPR003'),
('BRG10001', '2021-11-16', 12, 'SPR001'),
('BRG20014', '2021-11-16', 13, 'SPR001');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang` char(8) NOT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `jml_masuk` int(11) DEFAULT NULL,
  `supplier` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang`, `tgl_masuk`, `jml_masuk`, `supplier`) VALUES
('BRG10001', '2013-09-03', 36, 'SPR001'),
('BRG10002', '2013-10-21', 36, 'SPR002'),
('BRG10003', '2013-09-05', 36, 'SPR001'),
('BRG10004', '2013-09-05', 36, 'SPR001'),
('BRG20001', '2011-05-07', 24, 'SPR004'),
('BRG20002', '2013-10-21', 6, 'SPR003'),
('BRG20003', '2014-08-06', 23, 'SPR003'),
('BRG20004', '2013-10-25', 30, 'SPR003'),
('BRG20005', '2014-08-06', 36, 'SPR003'),
('BRG20006', '2013-12-04', 36, 'SPR004'),
('BRG20007', '2020-01-10', 10, 'SPR003'),
('BRG20008', '2020-01-10', 36, 'SPR003'),
('BRG20009', '2020-01-10', 36, 'SPR003'),
('BRG20010', '2020-01-10', 36, 'SPR003'),
('BRG20011', '2020-01-10', 36, 'SPR003'),
('BRG20012', '2020-01-10', 36, 'SPR003'),
('BRG20013', '2018-07-21', 36, 'SPR004'),
('BRG20014', '2018-07-21', 36, 'SPR004'),
('BRG20015', '2014-08-06', 16, 'SPR005'),
('BRG20016', '2018-07-21', 2, 'SPR005'),
('BRG20017', '2018-07-21', 10, 'SPR005'),
('BRG20018', '2021-11-16', 12, 'SPR001');

-- --------------------------------------------------------

--
-- Table structure for table `level_user`
--

CREATE TABLE `level_user` (
  `id_level` char(3) NOT NULL,
  `nama` varchar(225) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level_user`
--

INSERT INTO `level_user` (`id_level`, `nama`, `keterangan`) VALUES
('U01', 'Administrator', NULL),
('U02', 'Manajemen', NULL),
('U03', 'Peminjam', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `log_aplikasi`
--

CREATE TABLE `log_aplikasi` (
  `ip_address` char(11) NOT NULL,
  `pengguna` char(8) NOT NULL,
  `event` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` char(4) NOT NULL,
  `nama_lokasi` varchar(225) DEFAULT NULL,
  `penanggung_jawab` varchar(225) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id_lokasi`, `nama_lokasi`, `penanggung_jawab`, `keterangan`) VALUES
('R001', 'Lab RPL 1', 'Satria Ade Putra', 'Lantai 3 Gedung D'),
('R002', 'Lab RPL 2', 'Satria Ade Putra', 'Lantai 3 Gedung D'),
('R003', 'Lab TKJ 1', 'Supriyadi', 'Lantai 2 Gedung D'),
('R004', 'Lab TKJ 2', 'Supriyadi', 'Lantai 2 Gedung D'),
('R005', 'Lab Multimedia', 'Bayu Setiawan', 'Gedung Multimedia');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam_barang`
--

CREATE TABLE `pinjam_barang` (
  `id_pinjam` char(11) NOT NULL,
  `peminjam` char(8) DEFAULT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `barang_pinjam` char(8) DEFAULT NULL,
  `jml_pinjam` int(11) DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `kondisi` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pinjam_barang`
--

INSERT INTO `pinjam_barang` (`id_pinjam`, `peminjam`, `tgl_pinjam`, `barang_pinjam`, `jml_pinjam`, `tgl_kembali`, `kondisi`) VALUES
('1', 'USR00004', '2021-10-15', 'BRG20013', 2, NULL, NULL),
('2', 'USR20001', '2018-05-15', 'BRG20008', 1, '2018-06-15', 'Baik'),
('3', 'USR20002', '2018-05-15', 'BRG20003', 1, '2018-06-15', 'Baik'),
('4', 'USR00002', '2019-07-15', 'BRG20013', 1, NULL, NULL),
('5', 'USR00001', '2019-08-24', 'BRG20004', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_barang` char(8) NOT NULL,
  `jml_masuk` int(11) DEFAULT NULL,
  `jml_keluar` int(11) DEFAULT NULL,
  `total_barang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id_barang`, `jml_masuk`, `jml_keluar`, `total_barang`) VALUES
('BRG10001', 36, 28, 8),
('BRG10002', 36, 10, 16),
('BRG10003', 36, 5, 31),
('BRG10004', 36, 10, 16),
('BRG20001', 24, 19, 5),
('BRG20002', 6, 6, 0),
('BRG20003', 23, 0, 23),
('BRG20004', 30, 1, 29),
('BRG20005', 36, 0, 36),
('BRG20006', 36, 0, 36),
('BRG20007', 10, 0, 10),
('BRG20008', 36, 0, 36),
('BRG20009', 36, 0, 36),
('BRG20010', 36, 0, 36),
('BRG20011', 36, 0, 36),
('BRG20012', 36, 0, 36),
('BRG20013', 36, 3, 33),
('BRG20014', 36, 13, 23),
('BRG20015', 16, 0, 16),
('BRG20016', 2, 0, 2),
('BRG20017', 10, 0, 10),
('BRG20018', 12, 0, 12);

-- --------------------------------------------------------

--
-- Stand-in structure for view `stok_barang`
-- (See below for the actual view)
--
CREATE TABLE `stok_barang` (
`id_barang` char(8)
,`nama_barang` varchar(225)
,`total_barang` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `sumber_dana`
--

CREATE TABLE `sumber_dana` (
  `id_sumber` char(4) NOT NULL,
  `nama_sumber` varchar(225) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sumber_dana`
--

INSERT INTO `sumber_dana` (`id_sumber`, `nama_sumber`, `keterangan`) VALUES
('S001', 'Komite 07/09', 'Bantuan Komite 2007/2009'),
('S002', 'Komite 13', 'Bantuan Komite 2013'),
('S003', 'Sed T-vet', 'Bantuan Kerja sama Indonesia Jerman'),
('S004', 'BOSDA 2018', 'Bantuan Operasional Sekolah Daerah Jawa Barat 2018'),
('S005', 'BOPD 2020', 'Bantuan Provinsi Jawa Barat 2020');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` char(8) NOT NULL,
  `nama_sumpplier` varchar(225) DEFAULT NULL,
  `alamat_supplier` text DEFAULT NULL,
  `telp_supplier` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_sumpplier`, `alamat_supplier`, `telp_supplier`) VALUES
('SPR001', 'INFORMA', 'Mal Metropolitan, Jl. KH. Noer Ali No.1,', '0812-9604-6051'),
('SPR002', 'Mitrakantor.com', 'Jl. I Gusti Ngurah Rai No.20,', '(021) 22862086'),
('SPR003', 'bhinneka.com', 'Jl. Gn. Sahari No.73C, RT.9/RW.7,', '(021) 29292828'),
('SPR004', 'World Computer', 'Harco Mangga Dua Plaza B3/1', '(021) 6125266'),
('SPR005', 'Anekafoto Metro Atom', 'Metro Atom Plaza Jalan Samanhudi Blok AKS No.19', '(021) 3455544');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` char(8) NOT NULL,
  `nama` varchar(225) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `level` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
('USR00001', 'Nana Sukamana', 'admin', '$2y$10$V6ECYZP8Di6NTt/fcmWRCuJYmhPmYxk6ncLrdaQIzZre8UmgZqJEy', 'U01'),
('USR00002', 'Deden Deendi', 'toolman=RPL', '$2y$10$t28q5sqqcEypL9fp/jIdYOQm9tzfRa9u0qX34lyzD9SFzzI8OvaFS', 'U02'),
('USR00003', 'Ilham Kamil', 'toolman=MM', '$2y$10$lpZ.UR.CZhn.M0cfMpBxcepBZny4Q8G0gpJ4RjwksydwCR9d/ScEm', 'U02'),
('USR00004', 'Abdul Rahman', 'toolman=TKJ', '$2y$10$G2Qj/xUzhLNOdQVjPXFKMu0SGO5pnyT9R3So97DLsTh.PDMd5FvnK', 'U02'),
('USR20001', 'Dhika', 'Dhka', '$2y$10$AsUF3wS4sQM5LUK3EoMOjOsepP296AjjjajgEiALMF0BFFsxRa42G', 'U03'),
('USR20002', 'Qadafi', 'Qadafi', '$2y$10$Yo4ddv7I7wcVr611nmYC/.K.CKBIajhDklwBrOQ5PzUQif2GwXAyu', 'U03'),
('USR20003', 'Pandu', 'Pandu', '$2y$10$SJBlktcq2yhBfXUT2/2cGOfCTowRbrXWIIGf8qjoFn7dSNEZ214ES', 'U03'),
('USR20004', 'Yudha', 'Yudha', '$2y$10$V.dQaLI5fd.zv0.w4OxoLuZzPezQw/PGGA.4O7oM5/bPdKD9l0TIu', 'U03');

-- --------------------------------------------------------

--
-- Structure for view `stok_barang`
--
DROP TABLE IF EXISTS `stok_barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `stok_barang`  AS SELECT `barang`.`id_barang` AS `id_barang`, `barang`.`nama_barang` AS `nama_barang`, `stok`.`total_barang` AS `total_barang` FROM (`barang` join `stok` on(`barang`.`id_barang` = `stok`.`id_barang`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `lokasi` (`lokasi`),
  ADD KEY `sumber_dana` (`sumber_dana`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD KEY `supplier` (`supplier`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD KEY `supplier` (`supplier`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `level_user`
--
ALTER TABLE `level_user`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `log_aplikasi`
--
ALTER TABLE `log_aplikasi`
  ADD KEY `pengguna` (`pengguna`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `pinjam_barang`
--
ALTER TABLE `pinjam_barang`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `barang_pinjam` (`barang_pinjam`),
  ADD KEY `peminjam` (`peminjam`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `sumber_dana`
--
ALTER TABLE `sumber_dana`
  ADD PRIMARY KEY (`id_sumber`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `level` (`level`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`lokasi`) REFERENCES `lokasi` (`id_lokasi`),
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`sumber_dana`) REFERENCES `sumber_dana` (`id_sumber`);

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`supplier`) REFERENCES `supplier` (`id_supplier`),
  ADD CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`supplier`) REFERENCES `supplier` (`id_supplier`),
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `log_aplikasi`
--
ALTER TABLE `log_aplikasi`
  ADD CONSTRAINT `log_aplikasi_ibfk_1` FOREIGN KEY (`pengguna`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `pinjam_barang`
--
ALTER TABLE `pinjam_barang`
  ADD CONSTRAINT `pinjam_barang_ibfk_1` FOREIGN KEY (`barang_pinjam`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `pinjam_barang_ibfk_2` FOREIGN KEY (`peminjam`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`level`) REFERENCES `level_user` (`id_level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
