-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2018 at 08:19 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `barcode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `profit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`barcode`, `nama_barang`, `kategori`, `harga_beli`, `stock`, `harga_jual`, `profit`) VALUES
('12345678910', 'BLACKPINK MINI ALBUM', '1', 100000, 74, 125000, 25000),
('800067600002B', 'Xiaomi Redmi 5 Plus 64GB', '3', 2500000, 44, 2800000, 300000),
('8991906109992', 'Djarum Super MLD Black Series', '2', 17500, 91, 18000, 500),
('97476231761', 'iKON RETURN ALBUM', '1', 125000, 85, 150000, 25000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_datapenjualan`
--

CREATE TABLE `tb_datapenjualan` (
  `kode_penjualan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembali` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `potongan` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_kasir` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pembayaran` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_datapenjualan`
--

INSERT INTO `tb_datapenjualan` (`kode_penjualan`, `bayar`, `kembali`, `diskon`, `potongan`, `subtotal`, `tanggal`, `id_kasir`, `pembayaran`) VALUES
('RM-5174559797', 300000, 50000, 0, 0, 250000, '2018-06-05', '1', '2'),
('RM-9142231925', 300000, 25000, 0, 0, 275000, '2018-06-05', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategoribarang`
--

CREATE TABLE `tb_kategoribarang` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `deskripsi_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategoribarang`
--

INSERT INTO `tb_kategoribarang` (`id_kategori`, `nama_kategori`, `deskripsi_kategori`) VALUES
(1, 'ALBUM', 'Kategori untuk segala jenis album.'),
(2, 'ROKOK', 'Kategori untuk segala jenis rokok.'),
(3, 'SMARTPHONE', 'Kategori untuk segala jenis smartphone'),
(4, 'MINUMAN', 'Kategori untuk segala jenis minuman.');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `kode_pelanggan` int(11) NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surel` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`kode_pelanggan`, `nama`, `alamat`, `telp`, `surel`) VALUES
(1, 'RMarket Customer', 'Serpong', '021234567890', 'rmarket@rmarket.com'),
(2, 'Rafi', 'Pamulang', '012897411823', 'root@rafipriatna.web.id'),
(3, 'Safina', 'Maruga', '012345678912', 'safina@runsradio.com');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `nama_pembayaran` varchar(50) NOT NULL,
  `deskripsi_pembayaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `nama_pembayaran`, `deskripsi_pembayaran`) VALUES
(1, 'Cash', 'Pembayaran dengan Cash.'),
(2, 'R-Point', 'Pembayaran dengan penukaran point RMarket.');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengaturan`
--

CREATE TABLE `tb_pengaturan` (
  `namasitus` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_toko` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomer_telp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_pengaturan`
--

INSERT INTO `tb_pengaturan` (`namasitus`, `alamat_toko`, `nomer_telp`) VALUES
('RMarket', 'Serpong <br>\r\nTangerang Selatan, Banten', '(021) 234-567-890');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surel` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('Admin','Kasir') COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id`, `nama`, `username`, `password`, `surel`, `level`, `foto`) VALUES
(1, 'Administrator', 'admin', '$2y$10$btC4dgqBhE30tir9bJrHhe.Kon9VGLON.4DGMh.TljHO00R7hRZOi', 'root@rafipriatna.web.id', 'Admin', 'jennie.jpg'),
(2, 'Kasir', 'kasir', '$2y$10$yZ.h.DMsODvRjhNcUTNPsu50yDkIXAtYjvIFvanA/WBVxdH9VGDDy', 'kasir@rmarket.com', 'Kasir', 'kimjen.jpg'),
(3, 'Kasir 2', 'kasir2', '$2y$10$NtG3dpNUC5tMMHbq7NEHdepomMNnzQBN4LM9ZndpPRfp6/zf4iPoG', 'kasir2@rmarket.com', 'Kasir', 'jenniekim.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `id` int(11) NOT NULL,
  `kode_penjualan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `waktu_penjualan` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`id`, `kode_penjualan`, `barcode`, `jumlah`, `total`, `tgl_penjualan`, `id_pelanggan`, `waktu_penjualan`) VALUES
(1, 'RM-5174559797', '12345678910', 2, 250000, '2018-06-05', 1, '19:01:35'),
(2, 'RM-9142231925', '12345678910', 1, 125000, '2018-06-05', 2, '19:02:29'),
(3, 'RM-9142231925', '97476231761', 1, 150000, '2018-06-05', 2, '19:02:33');

--
-- Triggers `tb_penjualan`
--
DELIMITER $$
CREATE TRIGGER `jual` AFTER INSERT ON `tb_penjualan` FOR EACH ROW BEGIN
UPDATE tb_barang
SET stock = stock - NEW.jumlah
WHERE
barcode = NEW.barcode;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`barcode`);

--
-- Indexes for table `tb_kategoribarang`
--
ALTER TABLE `tb_kategoribarang`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`kode_pelanggan`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kategoribarang`
--
ALTER TABLE `tb_kategoribarang`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `kode_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
