-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2022 at 11:37 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atur_cuan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_administrator` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_anggaran`
--

CREATE TABLE `tb_anggaran` (
  `id` int(255) NOT NULL,
  `id_anggaran` varchar(50) NOT NULL,
  `id_pengguna` varchar(255) NOT NULL,
  `nama_anggaran` varchar(255) NOT NULL,
  `jenis_anggaran` varchar(255) NOT NULL,
  `jumlah_anggaran` int(255) NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_laporan_keuangan`
--

CREATE TABLE `tb_laporan_keuangan` (
  `id` int(255) NOT NULL,
  `id_laporan` varchar(255) NOT NULL,
  `id_pengguna` varchar(255) NOT NULL,
  `bulan_laporan` varchar(25) NOT NULL,
  `id_pengeluaran` varchar(50) DEFAULT 'NULL',
  `id_pendapatan` varchar(50) DEFAULT 'NULL',
  `id_anggaran` varchar(50) DEFAULT 'NULL',
  `id_tabungan` varchar(50) DEFAULT 'NULL',
  `total_pendapatan` int(255) DEFAULT 0,
  `total_pengeluaran` int(255) DEFAULT 0,
  `total_anggaran` int(255) DEFAULT 0,
  `total_tabungan` int(255) DEFAULT 0,
  `status_keuangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pendapatan`
--

CREATE TABLE `tb_pendapatan` (
  `id` int(255) NOT NULL,
  `id_pendapatan` varchar(50) NOT NULL,
  `id_pengguna` varchar(255) NOT NULL,
  `tanggal_pendapatan` date NOT NULL,
  `rincian_pendapatan` varchar(255) NOT NULL,
  `jenis_pendapatan` varchar(255) NOT NULL,
  `total_pendapatan` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengeluaran`
--

CREATE TABLE `tb_pengeluaran` (
  `id` int(255) NOT NULL,
  `id_pengeluaran` varchar(50) NOT NULL,
  `id_pengguna` varchar(255) NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `rincian_pengeluaran` varchar(255) NOT NULL,
  `jenis_pengeluaran` varchar(255) NOT NULL,
  `total_pengeluaran` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id` int(255) NOT NULL,
  `id_pengguna` varchar(255) NOT NULL,
  `nama_pengguna` varchar(255) NOT NULL,
  `gender` varchar(9) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status_pengguna` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id`, `id_pengguna`, `nama_pengguna`, `gender`, `email`, `no_telp`, `password`, `status_pengguna`) VALUES
(1, 'U202211191817534522', 'Syafiq Abdullah Fikri van der Sanden', '', 'syafiqvandersanden@gmail.com', '081216655267', '$2y$10$A6bSqBcoEuUehoLnfauO6eC9cd8mueyxrQIeP4i3UXry0KaG2P26a', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_tabungan`
--

CREATE TABLE `tb_tabungan` (
  `id` int(255) NOT NULL,
  `id_tabungan` varchar(50) NOT NULL,
  `id_pengguna` varchar(255) NOT NULL,
  `tanggal_tabungan` date NOT NULL,
  `rincian_tabungan` varchar(255) NOT NULL,
  `jenis_tabungan` varchar(255) NOT NULL,
  `total_tabungan` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_token`
--

CREATE TABLE `tb_token` (
  `id_token` int(11) NOT NULL,
  `id_pengguna` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expired_at` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_token`
--

INSERT INTO `tb_token` (`id_token`, `id_pengguna`, `token`, `expired_at`, `status`) VALUES
(1, 'U202211191817534522', '35d267fd0a4c7fc20305d83740f4ad42', '2022-11-19 18:40:59', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_anggaran`
--
ALTER TABLE `tb_anggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_laporan_keuangan`
--
ALTER TABLE `tb_laporan_keuangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pendapatan`
--
ALTER TABLE `tb_pendapatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tabungan`
--
ALTER TABLE `tb_tabungan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_token`
--
ALTER TABLE `tb_token`
  ADD PRIMARY KEY (`id_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_anggaran`
--
ALTER TABLE `tb_anggaran`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_laporan_keuangan`
--
ALTER TABLE `tb_laporan_keuangan`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pendapatan`
--
ALTER TABLE `tb_pendapatan`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_tabungan`
--
ALTER TABLE `tb_tabungan`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_token`
--
ALTER TABLE `tb_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
