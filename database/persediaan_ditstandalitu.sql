-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2025 at 03:48 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `persediaan_ditstandalitu`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`items`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id`, `unit`, `tanggal`, `items`, `created_at`, `updated_at`) VALUES
(1, 'Sertifikasi', '2025-04-28', '[{\"id\":4,\"nama_barang\":\"STABILO BOS\",\"jumlah\":3,\"satuan\":\"LUSIN\",\"keterangan\":null,\"created_at\":\"2025-04-27T13:23:53.000000Z\",\"updated_at\":\"2025-04-27T13:23:53.000000Z\",\"unit\":null,\"tanggal\":null,\"user_id\":4}]', '2025-04-28 02:33:45', '2025-04-28 02:33:45'),
(2, 'TU', '2025-05-04', '[{\"id\":7,\"nama_barang\":\"SPIDOL ARTLINE 70\",\"jumlah\":2,\"satuan\":\"LUSIN\",\"keterangan\":null,\"created_at\":\"2025-05-04T09:27:32.000000Z\",\"updated_at\":\"2025-05-04T09:27:32.000000Z\",\"unit\":null,\"tanggal\":null,\"user_id\":4},{\"id\":8,\"nama_barang\":\"PENSIL 2B\",\"jumlah\":1,\"satuan\":\"LUSIN\",\"keterangan\":null,\"created_at\":\"2025-05-04T09:28:01.000000Z\",\"updated_at\":\"2025-05-04T09:28:01.000000Z\",\"unit\":null,\"tanggal\":null,\"user_id\":4}]', '2025-05-04 02:32:15', '2025-05-04 02:32:15'),
(3, 'Teknisi', '2025-05-05', '[{\"id\":10,\"nama_barang\":\"SPIDOL ARTLINE 70\",\"jumlah\":2,\"satuan\":\"LUSIN\",\"keterangan\":null,\"created_at\":\"2025-05-05T09:24:25.000000Z\",\"updated_at\":\"2025-05-05T09:24:25.000000Z\",\"unit\":null,\"tanggal\":null,\"user_id\":4},{\"id\":11,\"nama_barang\":\"PENSIL 2B\",\"jumlah\":2,\"satuan\":\"LUSIN\",\"keterangan\":null,\"created_at\":\"2025-05-05T09:25:29.000000Z\",\"updated_at\":\"2025-05-05T09:25:29.000000Z\",\"unit\":null,\"tanggal\":null,\"user_id\":4},{\"id\":12,\"nama_barang\":\"STABILO BOS\",\"jumlah\":1,\"satuan\":\"LUSIN\",\"keterangan\":null,\"created_at\":\"2025-05-05T09:25:41.000000Z\",\"updated_at\":\"2025-05-05T09:25:41.000000Z\",\"unit\":null,\"tanggal\":null,\"user_id\":4}]', '2025-05-05 02:26:01', '2025-05-05 02:26:01'),
(5, 'Teknisi', '2025-05-27', '[{\"id\":13,\"nama_barang\":\"PENSIL 2B\",\"jumlah\":1,\"satuan\":\"LUSIN\",\"keterangan\":\"Warna Hitam\",\"created_at\":\"2025-05-27T06:05:49.000000Z\",\"updated_at\":\"2025-05-27T06:08:13.000000Z\",\"unit\":null,\"tanggal\":null,\"user_id\":2},{\"id\":14,\"nama_barang\":\"BALLPOINT BALLINER\",\"jumlah\":2,\"satuan\":\"LUSIN\",\"keterangan\":\"Warna Hitam\",\"created_at\":\"2025-05-27T06:07:23.000000Z\",\"updated_at\":\"2025-05-27T06:09:33.000000Z\",\"unit\":null,\"tanggal\":null,\"user_id\":2}]', '2025-05-26 23:17:03', '2025-05-26 23:17:03'),
(6, 'TU', '2025-05-27', '[{\"id\":15,\"nama_barang\":\"STABILO BOS\",\"jumlah\":1,\"satuan\":\"LUSIN\",\"keterangan\":null,\"created_at\":\"2025-05-27T11:02:46.000000Z\",\"updated_at\":\"2025-05-27T11:02:46.000000Z\",\"unit\":null,\"tanggal\":null,\"user_id\":2}]', '2025-05-27 04:04:04', '2025-05-27 04:04:04');

-- --------------------------------------------------------

--
-- Table structure for table `databarang`
--

CREATE TABLE `databarang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` int(11) NOT NULL,
  `image_barang` varchar(255) NOT NULL DEFAULT '150.png',
  `nama_barang` varchar(100) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `saldo_disistem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `databarang`
--

INSERT INTO `databarang` (`id`, `kode_barang`, `image_barang`, `nama_barang`, `satuan`, `saldo_disistem`) VALUES
(1, 101001, '1745743535_1.01.03.01.001.000034 STABILO BOSS - 1.jpg', 'STABILO BOS', 'LUSIN', 15),
(3, 101002, '1746348385_1.01.03.01.001.000002 SPIDOL 500.jpg', 'SPIDOL ARTLINE 500', 'LUSIN', 15),
(4, 101003, '1746348630_1.01.03.01.001.000003 SPIDOL 70 - 1.jpg', 'SPIDOL ARTLINE 70', 'LUSIN', 20),
(5, 101004, '1746348881_1.01.03.01.001.000004 PENSIL 2B.jpg', 'PENSIL 2B', 'LUSIN', 21),
(6, 101005, '1746349060_1.01.03.01.001.000019 BALLPOINT BALLINER -1.jpg', 'BALLPOINT BALLINER', 'LUSIN', 10),
(7, 101006, '1748703217_1.01.03.01.001.000020 BALL POINT FASTER -1.jpg', 'BALLPOINT FASTER', 'BUAH', 20),
(8, 101007, '1748703353_1.01.03.01.001.000025 PITA MESIN TIK BROTHER GX 8250.jpg', 'PITA MESIN TIK BROTHER GX', 'BUAH', 10),
(9, 101008, '1748851577_1.01.03.01.001.000032 BALLPOIN GEL BIRU.jpg', 'BALLPOINT GEL BIRU', 'LUSIN', 25),
(10, 101009, '1749966714_1.01.03.01.002.000001 TINTA STEMPEL UK. 50 CC.jpg', 'TINTA STEMPEL UK. 50 CC', 'BOTOL', 20),
(11, 1010010, '1749966833_1.01.03.01.002.000002 BAK STEMPEL NO. 1 -2.jpg', 'BAK STEMPEL NO. 1', 'BUAH', 15);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_07_032037_create_databarangs_table', 2),
(5, '2024_11_14_040338_create_forms_table', 3),
(12, '2024_11_18_074624_update_form_table', 4),
(13, '2024_11_15_040129_create_checkouts_table', 5),
(14, '2024_11_18_155823_create_forms_table', 5),
(15, '2024_11_18_170835_add_id_to_databarang_table', 6),
(16, '2024_11_19_025329_add_unit_and_tanggal_to_form_table', 7),
(17, '2024_11_19_063419_create_checkouts_table', 8),
(18, '2024_12_05_061709_create_users_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('itgx8SjlCGywyeb3zeWU2yOKJ5GUSoKfemylGYM3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN2JvcWNIbkhGNUZ3ZlFCMno2QlRrekN0R09FYlBteWNXWmJrT3dIUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1749972825),
('r6itLhQ7tE7QfRuDdWdXO4ycPSts8cRKtHRcAjnv', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT01KUFpLaWdKSTRLQ2E3emR3SE50Ykd1SHhyTW9LczZtd3pCOVFiQyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3QvcGVyc2VkaWFhbi1kaXRzdGFuZGFsaXR1L3BlcnNlZGlhYW5fZGl0c3RhbmRhbGl0dS9wdWJsaWMvbG9naW4iO319', 1749975088);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `email_verified_at`, `password`, `profile_image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Aji Prastia', 'ajiprastia@gmail.com', NULL, '$2y$12$lgUxumr7JS.wnTU2KsaCeOeNT3PkHvyRQdQ3EICqiuqvAuhCEBBLa', NULL, NULL, '2025-05-12 23:55:49', '2025-05-12 23:55:49'),
(2, 'user', 'Al Farell', 'alfarellgh@gmail.com', NULL, '$2y$12$WfzpmthVe9vZ2ZaVHdI1PeKpW9tyZS80NMxlPQT5EcpIMJFYeQXWG', NULL, NULL, '2025-05-12 23:58:22', '2025-05-12 23:58:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `databarang`
--
ALTER TABLE `databarang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `databarang_kode_barang_unique` (`kode_barang`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `databarang`
--
ALTER TABLE `databarang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `form`
--
ALTER TABLE `form`
  ADD CONSTRAINT `form_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
