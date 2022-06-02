-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 13, 2022 at 10:50 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `presensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `id_pesan` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pesan` text NOT NULL,
  `longitude` varchar(125) NOT NULL,
  `latitude` varchar(125) NOT NULL,
  `gambar` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`id_pesan`, `id_pegawai`, `tanggal`, `pesan`, `longitude`, `latitude`, `gambar`) VALUES
(8, 1, '2022-04-14 13:46:30', 'masih ada rapat', '123.1500891', '0.5312215', '625825b6b06a5.png'),
(9, 1, '2022-04-14 13:47:22', 'lokasi skarang', '123.1469263', '0.5344648', '625825ea4d0c6.png'),
(10, 2, '2022-04-15 02:24:19', 'test', '123.1461003', '0.5327005', '6258d7507b88f.png'),
(11, 2, '2022-04-15 02:25:02', 'laporan sekarang di lapangan', '123.1461003', '0.5327005', '6258d77e000fc.png'),
(12, 2, '2022-04-25 15:12:54', 'Im Here', '112.7520883', '-7.2574719', '6266ba76d51ee.png'),
(13, 1, '2022-05-07 13:44:53', 'aku di sini beb', '123.1462234', '0.5314929', '627677d5d872f.png'),
(14, 1, '2022-05-07 13:45:13', 'woyyy disni qt', '123.1483234', '0.5317271', '627677e963d53.png'),
(15, 1, '2022-05-08 10:23:04', 'Jancokkkkkkk', '123.1462234', '0.5327329', '62779a0870e4e.png'),
(16, 1, '2022-05-08 10:23:52', 'cekkk in', '123.1462234', '0.5327329', '62779a381f1c6.png'),
(17, 1, '2022-05-08 10:24:43', 'Baguss cek sini', '123.1462234', '0.5327329', '62779a6bc4437.png'),
(18, 4, '2022-05-12 04:17:03', 'lagi dikampus', '123.13278144768488', '0.5558317760969297', '627c8a3f76763.png');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `ket_jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `ket_jabatan`) VALUES
(3, 'Kepala Dinas'),
(4, 'Pegawai Tetap'),
(5, 'Pegawai Kontrak'),
(6, 'Seksi Kebidanan');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(75) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `profile` varchar(255) NOT NULL DEFAULT 'profile.png',
  `jabatan` int(11) NOT NULL DEFAULT '2',
  `id_jabatan` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nik`, `username`, `password`, `email`, `status`, `jenis_kelamin`, `profile`, `jabatan`, `id_jabatan`) VALUES
(1, 'T31190250', 'Mohamad Rizky Isa', '202cb962ac59075b964b07152d234b70', 'kikiisa89@gmail.com', '1', 'L', 'profile.png', 2, '4'),
(4, '12345678', 'alika fatha naya saini', '202cb962ac59075b964b07152d234b70', 'alikanaya0@gmail.com', '1', 'P', 'profile.png', 2, '4'),
(5, 'T3119020', 'Tiwi Hippy', '202cb962ac59075b964b07152d234b70', 'tiwi@yahoo.com', '1', 'P', 'profile.png', 2, '4'),
(6, 't320909', 'Nadira Marali', '202cb962ac59075b964b07152d234b70', 'nadira@yahoo.com', '1', 'P', 'profile.png', 2, '3');

-- --------------------------------------------------------

--
-- Table structure for table `ketentuan`
--

CREATE TABLE `ketentuan` (
  `id` int(11) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time NOT NULL,
  `ketentuan_alpa` time NOT NULL,
  `ketentuan_terlambat` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ketentuan`
--

INSERT INTO `ketentuan` (`id`, `jam_masuk`, `jam_keluar`, `ketentuan_alpa`, `ketentuan_terlambat`) VALUES
(1, '08:00:00', '17:00:00', '12:30:00', '10:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `id` int(11) NOT NULL,
  `username` varchar(75) NOT NULL,
  `password` varchar(125) NOT NULL,
  `email` varchar(75) NOT NULL,
  `role` enum('1','2') NOT NULL,
  `profile` varchar(255) NOT NULL DEFAULT 'profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`id`, `username`, `password`, `email`, `role`, `profile`) VALUES
(3, 'Mohamad Rizky Isa', '202cb962ac59075b964b07152d234b70', 'kikiisa89@gmail.com', '1', 'profile.png'),
(4, 'Kasmawaty Wartabone', '202cb962ac59075b964b07152d234b70', 'kasmawaty@gmail.com', '1', 'profile.png'),
(5, 'Erling Harlaan', '202cb962ac59075b964b07152d234b70', 'eling@yahoo.com', '1', 'profile.png'),
(8, 'Mohamad Rizky Isa', '202cb962ac59075b964b07152d234b70', 'lia@yahoo.com', '1', 'profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id_presensi` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time NOT NULL,
  `tgl_presensi` date NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  `longitude` varchar(126) NOT NULL,
  `latidude` varchar(125) NOT NULL,
  `gambar_in` varchar(125) NOT NULL,
  `gambar_out` varchar(125) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`id_presensi`, `id_pegawai`, `jam_masuk`, `jam_keluar`, `tgl_presensi`, `keterangan`, `longitude`, `latidude`, `gambar_in`, `gambar_out`) VALUES
(21, 2, '09:11:48', '00:00:00', '2022-05-12', 'hadir', '123.1463818', '0.5325143', '627c5ed48c345.png', 'default.png'),
(22, 4, '12:11:01', '00:00:00', '2022-05-12', 'terlambat', '123.13278123656482', '0.5558306466386053', '627c88d4d4c8a.png', 'default.png'),
(23, 5, '00:00:00', '00:00:00', '2022-05-13', 'sakit', '-', '-', '-', 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `ketentuan`
--
ALTER TABLE `ketentuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id_presensi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ketentuan`
--
ALTER TABLE `ketentuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
