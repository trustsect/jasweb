-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Okt 2021 pada 18.34
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jasweb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ahp_db`
--

CREATE TABLE `ahp_db` (
  `id` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `masa_kerja` varchar(25) NOT NULL,
  `jam_masuk` varchar(25) NOT NULL,
  `adminweb` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ahp_db`
--

INSERT INTO `ahp_db` (`id`, `nama`, `jabatan`, `masa_kerja`, `jam_masuk`, `adminweb`) VALUES
(1, 'Muhammad Hidayat', 'Staff', '3 Jam', '01:09', 'Yatcodex'),
(5, 'Rahman Saleh', 'AdminWEB', '3 Jam', '08:00', 'yatcode'),
(6, 'Ahmad', 'Open this select menu', '3 Jam', '07:00', 'yatcode'),
(7, 'u', 'Manager', 'y', '00:32', 'p'),
(10, 's', 'Staff', 's', '07:00', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saw_db`
--

CREATE TABLE `saw_db` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `masa_kerja` varchar(255) NOT NULL,
  `jam_masuk` varchar(25) NOT NULL,
  `adminweb` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `saw_db`
--

INSERT INTO `saw_db` (`id`, `nama`, `jabatan`, `masa_kerja`, `jam_masuk`, `adminweb`) VALUES
(1, 'Muhammad Hidayats', 'HRD', '3 Jam', '01:09', 'Yatcodex'),
(2, 'daz', 'Manager', 'asda', '12:01', 'Yatcode'),
(4, 'das', 'Manager', 'sdad', '23:23', 'Yatcode'),
(5, 'w', 'Staff', 'efw', '12:21', 'Yatcode'),
(7, 'w', 'Staff', 'efw', '12:21', 'Yatcode'),
(8, 'w', 'Staff', 'efw', '12:21', 'Yatcode'),
(9, 'fw', 'HRD', 'fsd', '23:01', 'Yatcode'),
(10, 'fw', 'HRD', 'fsd', '23:01', 'Yatcode'),
(11, 'fw', 'HRD', 'fsd', '23:01', 'Yatcode'),
(12, 'fw', 'HRD', 'fsd', '23:01', 'Yatcode'),
(13, 'fw', 'HRD', 'fsd', '23:01', 'Yatcode'),
(14, 'fw', 'HRD', 'fsd', '23:01', 'Yatcode'),
(15, 'fw', 'HRD', 'fsd', '23:01', 'Yatcode'),
(16, 'fw', 'HRD', 'fsd', '23:01', 'Yatcode');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `u_username` varchar(255) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `u_name`, `u_username`, `u_password`, `u_level`) VALUES
(1, 'Yatcode', 'yatcode', 'yatcode', 'superuser'),
(8, 'admin', 'admin', 'admin', 'adminweb'),
(10, 'manager', 'manager', 'manager', 'manager'),
(11, 'hrd', 'hrd', 'hrd', 'HRD');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ahp_db`
--
ALTER TABLE `ahp_db`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `saw_db`
--
ALTER TABLE `saw_db`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ahp_db`
--
ALTER TABLE `ahp_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `saw_db`
--
ALTER TABLE `saw_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
