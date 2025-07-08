-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jul 2025 pada 10.03
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
-- Database: `proyek-1`
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
  `metode_pembayaran` enum('transfer','cash') NOT NULL,
  `total_biaya` int(10) UNSIGNED NOT NULL,
  `jaminan` enum('motor','uang') NOT NULL,
  `tgl_booking` datetime NOT NULL,
  `durasi` int(10) UNSIGNED NOT NULL,
  `tgl_kembali` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `fasilitas` enum('dengan supir','lepas kunci') NOT NULL DEFAULT 'lepas kunci',
  `jam_booking` time NOT NULL,
  `jam_kembali` time NOT NULL,
  `status` enum('pending','confirmed','cancelled','rejected','on_rent','completed','expired','waiting_payment','paid') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`id`, `unit_mobil_id`, `customer_id`, `marketing_id`, `metode_pembayaran`, `total_biaya`, `jaminan`, `tgl_booking`, `durasi`, `tgl_kembali`, `created_at`, `fasilitas`, `jam_booking`, `jam_kembali`, `status`) VALUES
(83, 21, 21, NULL, 'transfer', 1350000, 'motor', '2025-06-20 00:00:00', 25, '2025-06-21 00:00:00', '2025-06-20 07:04:07', 'lepas kunci', '02:02:00', '02:03:00', 'confirmed'),
(84, 1, 21, NULL, 'transfer', 350000, 'uang', '2025-07-04 00:00:00', 12, '2025-07-05 00:00:00', '2025-07-03 08:12:51', 'lepas kunci', '15:11:00', '03:11:00', 'pending'),
(85, 1, 21, NULL, 'transfer', 350000, 'uang', '2025-07-04 00:00:00', 12, '2025-07-05 00:00:00', '2025-07-03 08:12:53', 'lepas kunci', '15:11:00', '03:11:00', 'pending'),
(86, 1, 21, NULL, 'transfer', 350000, 'uang', '2025-07-04 00:00:00', 12, '2025-07-05 00:00:00', '2025-07-03 08:12:54', 'lepas kunci', '15:11:00', '03:11:00', 'pending'),
(87, 1, 21, NULL, 'transfer', 350000, 'uang', '2025-07-04 00:00:00', 12, '2025-07-05 00:00:00', '2025-07-03 08:12:54', 'lepas kunci', '15:11:00', '03:11:00', 'pending'),
(88, 1, 21, NULL, 'transfer', 350000, 'uang', '2025-07-04 00:00:00', 12, '2025-07-05 00:00:00', '2025-07-03 08:12:57', 'lepas kunci', '15:11:00', '03:11:00', 'pending'),
(89, 1, 21, NULL, 'transfer', 350000, 'uang', '2025-07-04 00:00:00', 12, '2025-07-05 00:00:00', '2025-07-03 08:12:57', 'lepas kunci', '15:11:00', '03:11:00', 'pending'),
(90, 1, 21, NULL, 'transfer', 1050000, 'motor', '2025-07-05 00:00:00', 25, '2025-07-06 00:00:00', '2025-07-03 18:19:54', 'lepas kunci', '13:18:00', '13:19:00', 'pending'),
(91, 20, 21, NULL, 'transfer', 800000, 'uang', '2025-07-06 00:00:00', 22, '2025-07-07 00:00:00', '2025-07-04 05:45:42', 'lepas kunci', '14:44:00', '12:44:00', 'pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen_user`
--

CREATE TABLE `dokumen_user` (
  `id_dokumen` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `file_ktp` varchar(255) NOT NULL,
  `file_sim` varchar(255) NOT NULL,
  `file_kk` varchar(255) NOT NULL,
  `tanggal_upload` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokumen_user`
--

INSERT INTO `dokumen_user` (`id_dokumen`, `id_user`, `file_ktp`, `file_sim`, `file_kk`, `tanggal_upload`) VALUES
(9, 21, 'ktp_1749363570_68452b7257acd.jpeg', 'sim_1749363570_68452b7257e21.jpeg', 'kk_1749363570_68452b7258137.jpeg', '2025-06-08 13:19:30'),
(10, 22, 'ktp_1750001194_684ee62ab74c1.jpg', 'sim_1750001194_684ee62ab799c.jpg', 'kk_1750001194_684ee62ab7cd0.jpg', '2025-06-15 22:26:34'),
(14, 26, 'ktp_1750567420_685789fcb61a9.jpg', 'sim_1750567420_685789fcb6886.jpeg', 'kk_1750567420_685789fcb7055.jpeg', '2025-06-22 11:43:40'),
(15, 27, 'ktp_1750573111_6857a037c2d02.jpeg', 'sim_1750573111_6857a037c3516.jpeg', 'kk_1750573111_6857a037c3ad8.jpeg', '2025-06-22 13:18:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inspeksi`
--

CREATE TABLE `inspeksi` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `tanggal_pre` datetime DEFAULT NULL,
  `foto_pre` varchar(255) DEFAULT NULL,
  `kondisi_pre` enum('normal','rusak') DEFAULT NULL,
  `tanggal_post` datetime DEFAULT NULL,
  `foto_post` varchar(255) DEFAULT NULL,
  `kondisi_post` enum('normal','rusak') DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `denda` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `inspeksi`
--

INSERT INTO `inspeksi` (`id`, `booking_id`, `tanggal_pre`, `foto_pre`, `kondisi_pre`, `tanggal_post`, `foto_post`, `kondisi_post`, `catatan`, `denda`) VALUES
(4, 83, '2025-06-20 14:13:50', 'foto_pre_1750403630.jpeg', 'normal', '2025-06-20 14:57:21', 'foto_post_1750406241.jpeg', 'rusak', 'body baret', 1);

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
(1, 'All New Avanza', 350000, 7),
(2, 'Calya G 2023', 250000, 7),
(3, 'All New Terios', 350000, 7),
(4, 'All New Brio', 300000, 5),
(5, 'Brio Satya', 250000, 5),
(6, 'Brio Satya', 300000, 5),
(7, 'Raize CVT 2023', 350000, 5),
(8, 'All New BRV 2023', 400000, 7),
(9, 'Stargazer Prime IVT', 450000, 7),
(10, 'All New Veloz 2023', 400000, 7),
(11, 'Xpander Ultimate', 400000, 7),
(12, 'Rush GR 2022', 400000, 7),
(13, 'Innova G Solar ', 650000, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_tujuan` enum('admin','customer') NOT NULL,
  `pesan` text NOT NULL,
  `dibaca` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `user_id`, `role_tujuan`, `pesan`, `dibaca`, `created_at`) VALUES
(1, 27, 'admin', 'Customer dhela meminta verifikasi akun.', 0, '2025-06-22 13:18:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `status` enum('pending','berhasil','gagal') NOT NULL DEFAULT 'pending',
  `order_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `booking_id`, `jumlah`, `status`, `order_id`) VALUES
(83, 83, 1350000, 'berhasil', 'booking-1734574057'),
(84, 84, 350000, 'berhasil', 'booking-1261878638'),
(85, 85, 350000, 'berhasil', 'booking-1004790020'),
(86, 86, 350000, 'berhasil', 'booking-1607084918'),
(87, 87, 350000, 'berhasil', 'booking-949952198'),
(88, 88, 350000, 'berhasil', 'booking-1098785034'),
(89, 89, 350000, 'berhasil', 'booking-209750397'),
(90, 90, 1050000, 'berhasil', 'booking-102138312'),
(91, 91, 800000, 'berhasil', 'booking-2048779190');

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
  `transmisi` enum('Matic','Manual') DEFAULT 'Manual',
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `unit_mobil`
--

INSERT INTO `unit_mobil` (`id`, `jenis_mobil_id`, `plat_nomor`, `warna`, `foto`, `tahun_beli`, `status`, `transmisi`, `is_active`) VALUES
(1, 1, 'T 1691 UQ', 'WHITE', 'WhatsApp Image 2025-06-16 at 12.01.45_fd374c7a.jpg', '2023', 'tersedia', 'Matic', 1),
(3, 1, 'N 2222 UL', 'BLACK', 'toyota_toyota_full05.webp', '2023', 'tersedia', 'Manual', 1),
(4, 1, 'D 1757 SBA', 'SILVER', 'WhatsApp Image 2025-06-16 at 12.17.47_c0e8e506.jpg', '2023', 'tersedia', 'Manual', 1),
(5, 4, 'T 1450 US', 'RED', 'WhatsApp Image 2025-06-16 at 12.17.48_ebd2de46.jpg', '2023', 'tersedia', 'Matic', 1),
(6, 4, 'D 1880 UAP', 'RS', 'WhatsApp Image 2025-06-18 at 01.50.15_b4c8ef07.jpg', '2023', 'tersedia', 'Matic', 1),
(7, 5, 'N 1111 UL', 'YELLOW', 'WhatsApp Image 2025-06-16 at 12.17.47_50dbc8d4.jpg', '2023', 'tersedia', 'Matic', 1),
(8, 5, 'T 1180 UQ', 'YELLOW', 'WhatsApp Image 2025-06-16 at 12.17.47_50dbc8d4.jpg', '2023', 'tersedia', 'Matic', 1),
(9, 5, 'T 1449 UV', 'CITRUS', 'WhatsApp Image 2025-06-16 at 12.17.48_157f6320.jpg', '2023', 'tersedia', 'Matic', 1),
(10, 5, 'T 1268 UP', 'WHITE', 'WhatsApp Image 2025-06-16 at 12.24.14_d2fd974f.jpg', '2023', 'tersedia', 'Matic', 1),
(11, 8, 'T 1327 US', 'GREY', 'IMG-20250603-WA0025.jpg', '2023', 'tersedia', 'Matic', 1),
(12, 2, 'T 1359 UT', 'GREY', 'IMG-20250603-WA0026.jpg', '2023', 'tersedia', 'Manual', 1),
(13, 12, 'T 1541 UP', 'WHITE', 'IMG-20250603-WA0028.jpg', '2023', 'tersedia', 'Manual', 1),
(14, 13, 'B 1787 CZF', 'SILVER', 'toyota-kijang-innova-color-176061.avif', '2023', 'tersedia', 'Manual', 1),
(15, 7, 'T 1833 US', 'SILVER', 'IMG-20250603-WA0029.jpg', '2023', 'tersedia', 'Matic', 1),
(16, 7, 'T 1488 UU', 'WHITE', 'IMG-20250603-WA0030.jpg', '2023', 'tersedia', 'Matic', 1),
(17, 3, 'T 1096 UO', 'WHITE', 'IMG-20250603-WA0034.jpg', '2023', 'tersedia', 'Manual', 1),
(18, 10, 'T 1170 UU', 'WHITE', 'IMG-20250603-WA0031.jpg', '2023', 'tersedia', 'Manual', 1),
(19, 11, 'T 1097 XHE', 'WHITE', 'WhatsApp Image 2025-06-16 at 12.01.45_d4207e7c.jpg', '2023', 'tersedia', 'Manual', 1),
(20, 11, 'T 1568 UW', 'WHITE', 'WhatsApp Image 2025-06-16 at 12.01.45_d4207e7c.jpg', '2023', 'tersedia', 'Manual', 1),
(21, 9, 'B 2824 FOB', 'RED', 'WhatsApp Image 2025-06-16 at 12.01.46_89a38777.jpg', '2023', '', 'Matic', 1),
(28, 1, 'T 1587 UT', 'BLACK', 'toyota_toyota_full05.webp', '2023', 'tersedia', 'Matic', 1);

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
  `blacklist` tinyint(1) NOT NULL DEFAULT 0,
  `status_verifikasi` enum('belum diverifikasi','terverifikasi','ditolak') DEFAULT 'belum diverifikasi',
  `alamat` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `foto_profile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `telepon`, `email`, `password`, `role`, `blacklist`, `status_verifikasi`, `alamat`, `nama_lengkap`, `foto_profile`) VALUES
(1, 'Admin', '0831', 'admin@gmail.com', '$2y$10$S6XRzXb/Gpo4Qd5to6s7DeV6jljI6ESSKOS33JV3Xo7m5GUPPsG0G', 'admin', 0, 'belum diverifikasi', NULL, '', NULL),
(4, 'Checker 1', '0831', 'checker_1@gmail.com', '$2y$10$oUAlZN9zzzoMZYEZixL5FeKTTl2UAtjPJc6ByyhWJRBssTHKi2gMa', 'checker', 0, 'belum diverifikasi', NULL, '', NULL),
(21, 'pagesoobin', '0838', 'soobin@gmail.com', '$2y$10$ttrDg1.6DW6t5Uh45tFiV.u5nd6Gn/BDPeoabPzwTjZQmtRDKQjpi', 'customer', 0, 'terverifikasi', 'Subang', 'Choi Soobin', NULL),
(22, 'Dyziee', '083100002222', 'dyziee@gmail.com', '$2y$10$6FThKpfeqVxj.hILIUPhBOB8SPHLXP4BR1uhW8jITK34UX4HbUUG2', 'customer', 0, 'terverifikasi', '', 'Adi Firmansyah', NULL),
(26, 'Laaaa', '083893630029', 'daffodilwriter12@gmail.com', '$2y$10$6bGho7Qo0C.5epQjKqaXT.1DxQpAvX4iVQiYvi5c1ff8473brOz1K', 'customer', 0, 'ditolak', 'Kalijati-Subang', 'Dhela', NULL),
(27, 'daffodil', '083893630029', 'dhelanurasita@gmail.com', '$2y$10$tESxpFrzCFx4hc13FGJEDuur1q7KHoafPZvq1KeiYdaxiJ7v6wK9e', 'customer', 0, 'belum diverifikasi', 'Kalijati-Subang', 'dhela', NULL);

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
-- Indeks untuk tabel `dokumen_user`
--
ALTER TABLE `dokumen_user`
  ADD PRIMARY KEY (`id_dokumen`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `inspeksi`
--
ALTER TABLE `inspeksi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_id` (`booking_id`);

--
-- Indeks untuk tabel `jenis_mobil`
--
ALTER TABLE `jenis_mobil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indeks untuk tabel `unit_mobil`
--
ALTER TABLE `unit_mobil`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plat_nomor` (`plat_nomor`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT untuk tabel `dokumen_user`
--
ALTER TABLE `dokumen_user`
  MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `inspeksi`
--
ALTER TABLE `inspeksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jenis_mobil`
--
ALTER TABLE `jenis_mobil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT untuk tabel `unit_mobil`
--
ALTER TABLE `unit_mobil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
-- Ketidakleluasaan untuk tabel `dokumen_user`
--
ALTER TABLE `dokumen_user`
  ADD CONSTRAINT `dokumen_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `unit_mobil`
--
ALTER TABLE `unit_mobil`
  ADD CONSTRAINT `unit_mobil_ibfk_3` FOREIGN KEY (`jenis_mobil_id`) REFERENCES `jenis_mobil` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
