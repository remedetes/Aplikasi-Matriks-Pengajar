-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08 Agu 2019 pada 10.08
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jadwalanri`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_pengajar`
--

CREATE TABLE `jadwal_pengajar` (
  `id_jadwal_pengajar` int(10) NOT NULL,
  `nama_pengajar` varchar(30) NOT NULL,
  `nama_diklat` varchar(50) NOT NULL,
  `materi_diklat` varchar(50) NOT NULL,
  `jam_mengajar` varchar(20) NOT NULL,
  `tanggal` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal_pengajar`
--

INSERT INTO `jadwal_pengajar` (`id_jadwal_pengajar`, `nama_pengajar`, `nama_diklat`, `materi_diklat`, `jam_mengajar`, `tanggal`) VALUES
(1, 'Muhammad Fadlillah', 'Diklat Fungsional Pengangkatan Arsiparis', 'Pengantar Kearsipan', '16:00', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajar`
--

CREATE TABLE `pengajar` (
  `id_pengajar` int(11) NOT NULL,
  `nama_pengajar` varchar(50) NOT NULL,
  `nip_pengajar` varchar(20) NOT NULL,
  `email_pengajar` varchar(30) NOT NULL,
  `no_telp_pengajar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengajar`
--

INSERT INTO `pengajar` (`id_pengajar`, `nama_pengajar`, `nip_pengajar`, `email_pengajar`, `no_telp_pengajar`) VALUES
(2, 'Muhammad Fadlillah', '065116163', 'fadlikns@gmail.com', '081218356***');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `no_telp_user` varchar(15) NOT NULL,
  `email_user` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level_user` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `no_telp_user`, `email_user`, `username`, `password`, `level_user`) VALUES
(1, 'admin', '021-123-456', 'admin@email.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'Bimo M Ramdhan', '0896 4053 9***', 'bimomuhamadr@gmail.com', 'bimo', '0192023a7bbd73250516f069df18b500', 'admin'),
(4, 'Muhammad Fadlillah', '081218356***', 'fadlikns@gmail.com', 'fadli', 'ae3796ed36a1ded0f957c8ed8f0e2c2f', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal_pengajar`
--
ALTER TABLE `jadwal_pengajar`
  ADD PRIMARY KEY (`id_jadwal_pengajar`);

--
-- Indexes for table `pengajar`
--
ALTER TABLE `pengajar`
  ADD PRIMARY KEY (`id_pengajar`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal_pengajar`
--
ALTER TABLE `jadwal_pengajar`
  MODIFY `id_jadwal_pengajar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pengajar`
--
ALTER TABLE `pengajar`
  MODIFY `id_pengajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
