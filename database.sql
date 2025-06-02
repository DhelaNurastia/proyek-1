-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Bulan Mei 2025 pada 17.00
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tes`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `unit_mobil_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `marketing_id` int(11) DEFAULT NULL,
  `kota` varchar(100) NOT NULL,
  `total_biaya` int(10) UNSIGNED NOT NULL,
  `jaminan` enum('motor','uang') NOT NULL,
  `tgl_booking` datetime NOT NULL,
  `durasi` int(10) UNSIGNED NOT NULL,
  `tgl_kembali` datetime NOT NULL,
  `status` enum('pending','disetujui','ditolak') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `nama`) VALUES
(1, 'Lepas Kunci'),
(2, 'Dengan Supir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_mobil`
--

CREATE TABLE `jenis_mobil` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga_sewa` int(10) UNSIGNED NOT NULL COMMENT 'Harga sewa per 12 jam',
  `jumlah_kursi` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_mobil`
--

INSERT INTO `jenis_mobil` (`id`, `nama`, `harga_sewa`, `jumlah_kursi`) VALUES
(1, 'ALL NEW AVANZA (AT)', 350000, 5),
(2, 'Calya G 2023 (MT)', 250000, 5),
(3, 'ALL NEW TERIOS (MT)', 350000, 4),
(4, 'ALL NEW BRIO (AT)', 250000, 4),
(6, 'UNIT MOBIL BARU', 1000, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `status` enum('pending','berhasil','gagal') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit_mobil`
--

CREATE TABLE `unit_mobil` (
  `id` int(11) NOT NULL,
  `jenis_mobil_id` int(11) NOT NULL,
  `plat_nomor` varchar(10) NOT NULL,
  `warna` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `tahun_beli` year(4) NOT NULL,
  `status` enum('tersedia','disewa','perbaikan') NOT NULL DEFAULT 'tersedia',
  `fasilitas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `unit_mobil`
--

INSERT INTO `unit_mobil` (`id`, `jenis_mobil_id`, `plat_nomor`, `warna`, `foto`, `tahun_beli`, `status`, `fasilitas_id`) VALUES
(2, 2, 'T 1060 OP', 'Biru', '', '2025', 'disewa', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','marketing','checker','customer') NOT NULL DEFAULT 'customer',
  `blacklist` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `telepon`, `email`, `password`, `role`, `blacklist`) VALUES
(1, 'Admin', '0831', 'admin@gmail.com', '$2y$10$S6XRzXb/Gpo4Qd5to6s7DeV6jljI6ESSKOS33JV3Xo7m5GUPPsG0G', 'admin', 0),
(2, 'Marketing 1', '0831', 'marketing_1@gmail.com', '', 'marketing', 0),
(3, 'Marketing 2', '0831', 'marketing_2@gmail.com', '', 'marketing', 0),
(4, 'Checker', '0831', 'checker@gmail.com', '', 'checker', 0),
(5, 'Customer 1', '0831', 'customer_1@gmail.com', '', 'customer', 1),
(6, 'Customer 2', '0831', 'customer_2@gmail.com', '', 'customer', 0),
(8, 'daffodil', '', 'flwrdffdl15@gmail.com', '$2y$10$6yn3UTIgHjPQHm4NhBeGe.I8UGRcyGcaS8fqXqbQunc5VqZvs6Oya', 'customer', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mobil_id` (`unit_mobil_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `marketing_id` (`marketing_id`);

--
-- Indeks untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_mobil`
--
ALTER TABLE `jenis_mobil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `unit_mobil`
--
ALTER TABLE `unit_mobil`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plat_nomor` (`plat_nomor`),
  ADD KEY `fasilitas_id` (`fasilitas_id`),
  ADD KEY `jenis_mobil_id` (`jenis_mobil_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jenis_mobil`
--
ALTER TABLE `jenis_mobil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `unit_mobil`
--
ALTER TABLE `unit_mobil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`unit_mobil_id`) REFERENCES `unit_mobil` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`marketing_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `unit_mobil`
--
ALTER TABLE `unit_mobil`
  ADD CONSTRAINT `unit_mobil_ibfk_2` FOREIGN KEY (`fasilitas_id`) REFERENCES `fasilitas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `unit_mobil_ibfk_3` FOREIGN KEY (`jenis_mobil_id`) REFERENCES `jenis_mobil` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
