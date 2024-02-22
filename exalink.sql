-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Feb 2024 pada 07.11
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exalink`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailpeminjamanruang`
--

CREATE TABLE `detailpeminjamanruang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namakeg` varchar(255) NOT NULL,
  `mulai` datetime NOT NULL,
  `selesai` datetime NOT NULL,
  `approvedby` text DEFAULT NULL,
  `alasan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detailpeminjamanruang`
--

INSERT INTO `detailpeminjamanruang` (`id`, `namakeg`, `mulai`, `selesai`, `approvedby`, `alasan`, `created_at`, `updated_at`) VALUES
(2, 'rapat', '2023-08-11 00:28:00', '2023-08-11 02:28:00', 'Djupri', 'sss', '2023-08-10 10:29:03', '2023-08-10 10:29:03'),
(14, 'Ex aute dolor omnis', '1992-07-17 18:38:00', '1992-07-18 12:38:00', 'Djupri', '-', '2023-08-18 04:48:52', '2023-08-18 04:48:52'),
(16, 'sussss', '2023-08-20 10:27:00', '2023-08-20 12:27:00', 'Afdhal', 'dag', '2023-08-18 06:26:17', '2023-08-20 04:53:22'),
(17, 'Rapat3', '2023-08-21 10:32:00', '2023-08-21 12:32:00', 'Djupri', NULL, '2023-08-20 19:32:58', '2023-08-20 19:32:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lantai`
--

CREATE TABLE `lantai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lantai`
--

INSERT INTO `lantai` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, '1', '2023-06-09 20:45:53', '2023-06-09 20:45:53'),
(2, '2', '2023-06-09 20:45:57', '2023-06-09 20:45:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_11_16_101334_create_tb_lantai_table', 2),
(6, '2022_11_16_102026_create_tb_ruang_table', 2),
(7, '2022_11_16_103033_create_tb_req_table', 3),
(8, '2022_11_17_130617_add_status_to_tb_req', 4),
(9, '2022_11_17_135612_drop_table', 5),
(11, '2022_11_18_034157_drop_tabel', 7),
(12, '2022_11_18_035938_drop_tabel', 8),
(13, '2022_11_18_041224_drop_tabel', 9),
(14, '2022_11_18_041344_create_table', 10),
(15, '2022_11_18_041832_create_req', 11),
(16, '2022_11_20_235930_rename_nama_ruang_column', 12),
(17, '2022_11_21_000519_rename_ruang_column', 13),
(18, '2022_11_21_000646_drop_table_req', 14),
(19, '2022_11_21_012901_create_table_peminjaman_ruangan', 15),
(20, '2022_11_23_013305_drop_table_ruang_peminjaman', 16),
(21, '2022_11_23_014003_drop_column_user', 17),
(22, '2022_11_23_014550_add_column_user', 18),
(23, '2022_11_23_073159_drop_user', 19),
(24, '2022_11_23_075916_create_peminjaman_ruang', 20),
(25, '2022_11_30_025344_drop_tb_user', 21),
(26, '2022_11_30_034440_create_table', 22),
(27, '2022_12_09_023045_drop_table', 23),
(28, '2022_12_09_023347_create_peminjamaruang', 24),
(29, '2023_06_09_031358_create_table_lantai', 25),
(30, '2023_06_09_031555_create_status', 26),
(31, '2023_06_09_065600_create_penanggungjawab', 27),
(32, '2023_06_09_065904_create_table_two', 28),
(33, '2023_08_10_163447_create_two_table', 29);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawais`
--

CREATE TABLE `pegawais` (
  `nip_baru` varchar(18) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `gelar` varchar(25) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pegawais`
--

INSERT INTO `pegawais` (`nip_baru`, `nip`, `nama`, `gelar`, `tgl_lahir`) VALUES
('196705282007011003', '090022939', 'Djupri', '|', '1967-05-28'),
('198002212010011010', '198002212010011010', 'Ali Khomaini', '|ST', '1980-02-21'),
('199207172018011001', '199207172018011001', 'Afdhal', '|S.Hut', '1992-07-17'),
('199304062018012002', '199304062018012002', 'Alvita Rassya Tritikaningtyas', '|S.T.P.', '1993-04-06'),
('199503022018011001', '199503022018011001', 'Abror Insany Alatqo', '|S.T.P.', '1995-03-02'),
('199901272021012001', '199901272021012001', 'Adinda Puteri Fitriana', '|A.Md.Ak.', '1999-01-27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjamanruang`
--

CREATE TABLE `peminjamanruang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dtpr_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ruang_id` bigint(20) UNSIGNED NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `penanggungjawab_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `peminjamanruang`
--

INSERT INTO `peminjamanruang` (`id`, `dtpr_id`, `user_id`, `ruang_id`, `status_id`, `penanggungjawab_id`, `created_at`, `updated_at`) VALUES
(12, 14, 14, 1, 3, 1, '2023-08-18 04:48:52', '2023-08-18 05:48:17'),
(14, 16, 14, 3, 4, 1, '2023-08-18 06:26:17', '2023-08-20 04:53:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penanggungjawab`
--

CREATE TABLE `penanggungjawab` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_nip` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penanggungjawab`
--

INSERT INTO `penanggungjawab` (`id`, `pegawai_nip`, `created_at`, `updated_at`) VALUES
(1, '196705282007011003', '2023-06-09 20:46:43', '2023-06-09 20:46:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruang`
--

CREATE TABLE `ruang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `lantai_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ruang`
--

INSERT INTO `ruang` (`id`, `nama`, `lantai_id`, `created_at`, `updated_at`) VALUES
(1, 'susu', 2, '2023-06-09 20:46:30', '2023-06-10 00:02:32'),
(3, 'po', 2, '2023-08-19 23:31:01', '2023-08-19 23:31:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(2, 'proses', '2023-06-09 21:17:58', '2023-06-09 21:17:58'),
(3, 'setuju', '2023-06-09 21:18:13', '2023-06-09 21:18:13'),
(4, 'tolak', '2023-06-09 21:18:20', '2023-06-09 21:18:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_nip` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `imgprofil` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `pegawai_nip`, `username`, `password`, `role`, `imgprofil`, `created_at`, `updated_at`) VALUES
(4, '199503022018011001', 'user2', '$2y$10$V4cjHNPwbEY/PDhnMOkC0uO9jidKmJoa1INiCRGRwAbN8Qz12dg0G', 'admin', '', '2022-12-07 00:11:49', '2022-12-07 00:11:49'),
(5, '199901272021012001', 'user3', '$2y$10$OFnb5oL89/BlK6J/5Narp.1Q60QK2n8bvkhXqhobXEHvmbZx.5h7O', 'admin', '', '2022-12-09 00:28:19', '2022-12-09 00:28:19'),
(11, '199304062018012002', 'admin0', '$2y$10$Vo0lPaXGh9dqvQv5PkWu7erC1URxCtStdu7MTI6kay2EhoEVZsLyW', 'admin', 'BWCxpPB6S2FGRdmxwxgBQF9J3CiOZiZeM0vjoK4n.jpg', '2022-12-19 19:10:41', '2022-12-26 23:08:14'),
(12, '199207172018011001', 'admin1', '$2y$10$dQVJzyXUOE.GYlUqUf9TmOKpHSi..GNC/dy8ncsjlRJnBSekYob.q', 'admin', 'VkjEexIeTM2RuHpRmLSzTZeYS6hQM14fsW6g4Mvy.png', '2022-12-21 20:28:50', '2022-12-22 00:25:37'),
(13, '198002212010011010', 'admin00', '$2y$10$5oegX8kKmkxv9DGs6B7obO/9.DT6X5Qx/yfUg/T4Jboo24u9GQ2iW', 'admin', NULL, '2022-12-26 23:07:41', '2022-12-26 23:07:41'),
(14, '196705282007011003', 'super', '$2y$10$.j9KUtkHr/tVjmBHOHwRxeLtq2BHtrFRwWXridjMCyV6UE6TmhpE.', 'superadmin', 'il4Fary5T73zSdTom6eQLtQqnpegekYsNfwgc4YC.jpg', '2023-06-09 20:41:11', '2023-08-15 00:19:22');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detailpeminjamanruang`
--
ALTER TABLE `detailpeminjamanruang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `lantai`
--
ALTER TABLE `lantai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`nip_baru`),
  ADD UNIQUE KEY `pegawais_nip_unique` (`nip`);

--
-- Indeks untuk tabel `peminjamanruang`
--
ALTER TABLE `peminjamanruang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjamanruang_dtpr_id_foreign` (`dtpr_id`),
  ADD KEY `peminjamanruang_user_id_foreign` (`user_id`),
  ADD KEY `peminjamanruang_ruang_id_foreign` (`ruang_id`),
  ADD KEY `peminjamanruang_status_id_foreign` (`status_id`),
  ADD KEY `peminjamanruang_penanggungjawab_id_foreign` (`penanggungjawab_id`);

--
-- Indeks untuk tabel `penanggungjawab`
--
ALTER TABLE `penanggungjawab`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penanggungjawab_pegawai_nip_foreign` (`pegawai_nip`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ruang_lantai_id_foreign` (`lantai_id`);

--
-- Indeks untuk tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_username_unique` (`username`),
  ADD KEY `user_pegawai_nip_foreign` (`pegawai_nip`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detailpeminjamanruang`
--
ALTER TABLE `detailpeminjamanruang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `lantai`
--
ALTER TABLE `lantai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `peminjamanruang`
--
ALTER TABLE `peminjamanruang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `penanggungjawab`
--
ALTER TABLE `penanggungjawab`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `status`
--
ALTER TABLE `status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjamanruang`
--
ALTER TABLE `peminjamanruang`
  ADD CONSTRAINT `peminjamanruang_dtpr_id_foreign` FOREIGN KEY (`dtpr_id`) REFERENCES `detailpeminjamanruang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjamanruang_penanggungjawab_id_foreign` FOREIGN KEY (`penanggungjawab_id`) REFERENCES `penanggungjawab` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjamanruang_ruang_id_foreign` FOREIGN KEY (`ruang_id`) REFERENCES `ruang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjamanruang_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjamanruang_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penanggungjawab`
--
ALTER TABLE `penanggungjawab`
  ADD CONSTRAINT `penanggungjawab_pegawai_nip_foreign` FOREIGN KEY (`pegawai_nip`) REFERENCES `pegawais` (`nip_baru`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ruang`
--
ALTER TABLE `ruang`
  ADD CONSTRAINT `ruang_lantai_id_foreign` FOREIGN KEY (`lantai_id`) REFERENCES `lantai` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_pegawai_nip_foreign` FOREIGN KEY (`pegawai_nip`) REFERENCES `pegawais` (`nip_baru`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
