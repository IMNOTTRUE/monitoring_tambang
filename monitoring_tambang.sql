-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2026 at 05:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoring_tambang`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `camera`
--

CREATE TABLE `camera` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `stream_url` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'offline',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cctv`
--

CREATE TABLE `cctv` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cctv`
--

INSERT INTO `cctv` (`id`, `nama`, `lokasi`, `url`, `created_at`, `updated_at`) VALUES
(16, 'pelabuhan', 'gresik', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/rncXQvezcZU?si=6ZLjnfr7aO6Y6nXU\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '2026-04-06 01:44:04', '2026-04-06 01:44:04'),
(18, 'gudang', 'gresik', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/8DJi4PrdFCg?si=trtcifAqr-k9TvNP\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '2026-04-06 02:01:23', '2026-04-06 02:01:23'),
(19, 'pelabuhan', 'belitung', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/KzI2zT-tzXA?si=6nZg57MsF1XHbdpM\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '2026-04-06 02:03:23', '2026-04-06 02:03:23');

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

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"6c9a500f-a0e9-497c-a7c0-db97d25c4f15\",\"displayName\":\"App\\\\Events\\\\NotifEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:21:\\\"App\\\\Events\\\\NotifEvent\\\":1:{s:5:\\\"pesan\\\";s:29:\\\"admin1 menambahkan pengiriman\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1776341882,\"delay\":null}', 0, NULL, 1776341882, 1776341882),
(2, 'default', '{\"uuid\":\"5731aa2d-c845-4caf-b167-b2c3e1eab027\",\"displayName\":\"App\\\\Events\\\\NotifEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:21:\\\"App\\\\Events\\\\NotifEvent\\\":1:{s:5:\\\"pesan\\\";s:29:\\\"admin1 menambahkan pengiriman\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1776342203,\"delay\":null}', 0, NULL, 1776342203, 1776342203),
(3, 'default', '{\"uuid\":\"b8f7ad16-3ba9-4053-b5cb-5fa7c56000bf\",\"displayName\":\"App\\\\Events\\\\NotifEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:21:\\\"App\\\\Events\\\\NotifEvent\\\":1:{s:5:\\\"pesan\\\";s:29:\\\"admin1 menambahkan pengiriman\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1776446113,\"delay\":null}', 0, NULL, 1776446113, 1776446113),
(4, 'default', '{\"uuid\":\"ab0e9a1b-74b9-469a-961a-522110092a6f\",\"displayName\":\"App\\\\Events\\\\NotifEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:21:\\\"App\\\\Events\\\\NotifEvent\\\":1:{s:5:\\\"pesan\\\";s:29:\\\"admin1 menambahkan pengiriman\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1776446591,\"delay\":null}', 0, NULL, 1776446591, 1776446591),
(5, 'default', '{\"uuid\":\"94ed72b7-b44c-4211-af4e-f4c4e519c8ea\",\"displayName\":\"App\\\\Events\\\\NotifEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:21:\\\"App\\\\Events\\\\NotifEvent\\\":1:{s:5:\\\"pesan\\\";s:29:\\\"admin1 menambahkan pengiriman\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1776447837,\"delay\":null}', 0, NULL, 1776447837, 1776447837),
(6, 'default', '{\"uuid\":\"94f2c773-b909-4ead-a9e7-3a385bf41b91\",\"displayName\":\"App\\\\Events\\\\NotifEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:21:\\\"App\\\\Events\\\\NotifEvent\\\":1:{s:5:\\\"pesan\\\";s:29:\\\"admin1 menambahkan pengiriman\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1776447951,\"delay\":null}', 0, NULL, 1776447951, 1776447951),
(7, 'default', '{\"uuid\":\"821ffaa0-5543-4be0-93fd-749bc7063ee0\",\"displayName\":\"App\\\\Events\\\\NotifEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:21:\\\"App\\\\Events\\\\NotifEvent\\\":1:{s:5:\\\"pesan\\\";s:29:\\\"admin1 menambahkan pengiriman\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1776448830,\"delay\":null}', 0, NULL, 1776448830, 1776448830),
(8, 'default', '{\"uuid\":\"c264e8cd-df53-45af-ac98-8bba9e01a069\",\"displayName\":\"App\\\\Events\\\\NotifEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:21:\\\"App\\\\Events\\\\NotifEvent\\\":1:{s:5:\\\"pesan\\\";s:29:\\\"admin1 menambahkan pengiriman\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1776448960,\"delay\":null}', 0, NULL, 1776448960, 1776448960),
(9, 'default', '{\"uuid\":\"67d4ff31-d289-46b3-ae8e-38c34a21dffa\",\"displayName\":\"App\\\\Events\\\\NotifEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:21:\\\"App\\\\Events\\\\NotifEvent\\\":1:{s:5:\\\"pesan\\\";s:29:\\\"admin1 menambahkan pengiriman\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1776452931,\"delay\":null}', 0, NULL, 1776452931, 1776452931);

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
-- Table structure for table `kas_keuangan`
--

CREATE TABLE `kas_keuangan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `jenis` enum('masuk','keluar') NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kas_keuangan`
--

INSERT INTO `kas_keuangan` (`id`, `lokasi`, `jenis`, `nominal`, `keterangan`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 'gresik', 'masuk', 2000.00, 'truk jamping', '2026-04-08', '2026-04-03 09:30:26', '2026-04-03 09:30:26'),
(2, 'jogja', 'keluar', 500000.00, 'Pembayaran serah terima #3', '2026-04-03', '2026-04-03 10:24:25', '2026-04-03 10:24:25'),
(3, 'jogja', 'masuk', 200000000.00, 'invest', '2026-04-10', '2026-04-03 13:11:56', '2026-04-03 13:11:56'),
(4, 'jogja', 'masuk', 200000000.00, 'invest', '2026-04-10', '2026-04-03 13:11:56', '2026-04-03 13:11:56'),
(5, 'gresik', 'masuk', 5000000.00, 'invest', '2026-04-04', '2026-04-03 13:17:57', '2026-04-03 13:17:57'),
(6, 'jogja', 'masuk', 500000000.00, 'invest', '2026-04-08', '2026-04-03 13:18:24', '2026-04-03 13:18:24'),
(7, 'Jogja', 'masuk', 70000000.00, 'invest', '2026-04-18', '2026-04-03 13:18:51', '2026-04-08 23:19:47'),
(8, 'jogja', 'masuk', 5000000.00, 'pembelian produk', '2026-04-15', '2026-04-15 01:05:05', '2026-04-15 01:05:05'),
(9, 'jogja', 'keluar', 1000000000.00, 'pembelian barang baku', '2026-04-15', '2026-04-15 01:05:59', '2026-04-15 01:05:59'),
(10, 'jogja', 'masuk', 1000000000.00, 'invest', '2026-04-15', '2026-04-15 03:32:49', '2026-04-15 03:32:49'),
(11, 'gresik', 'masuk', 1000000000.00, 'invest', '2026-04-15', '2026-04-15 03:33:06', '2026-04-15 03:33:06'),
(12, 'belitung', 'masuk', 1000000000.00, 'invest', '2026-04-15', '2026-04-15 03:33:21', '2026-04-15 03:33:21'),
(13, 'gresik', 'masuk', 5000000000.00, 'invest', '2026-04-15', '2026-04-15 03:34:11', '2026-04-15 03:34:11');

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
(4, '2026_03_20_080145_create_tambangs_table', 2),
(5, '2026_03_20_080145_create_tambangs_table1', 3),
(6, '2026_03_20_081611_create_pengeringan_table', 4),
(7, '2026_03_20_081800_create_serah_terima_table', 5),
(8, '2026_03_20_081800_create_serah_terimas_table', 6),
(9, '2026_03_20_083548_create_serah_terima_table', 7),
(10, '2026_03_20_092636_create_serah_terima_table', 8),
(11, '2026_03_20_093026_create_kas_keuangan_table', 9),
(12, '2026_03_20_093123_create_camera_table', 10),
(13, '2026_03_31_093758_create_serah_terimas_table', 11),
(14, '2026_04_01_153911_add_status_bayar_to_serah_terima', 12),
(15, '2026_04_01_164043_add_role_to_users_table', 12),
(16, '2026_04_03_175103_add_lokasi_to_serah_terima', 13),
(17, '2026_04_04_134444_create_pekerja_table', 14),
(18, '2026_04_04_174632_create_cctv_table', 15),
(19, '2026_04_07_085726_create_pembayaran_operasionals_table', 16),
(20, '2026_04_07_090244_create_pembayaran_gajis_table', 16),
(21, '2026_04_15_110538_create_notifikasis_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasis`
--

CREATE TABLE `notifikasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `dibaca` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifikasis`
--

INSERT INTO `notifikasis` (`id`, `pesan`, `dibaca`, `created_at`, `updated_at`) VALUES
(1, 'bimo menambahkan data Pengiriman', 1, '2026-04-15 04:30:30', '2026-04-15 09:50:54'),
(2, 'admin2 mengedit data Pengiriman', 1, '2026-04-15 10:10:27', '2026-04-15 10:19:09'),
(3, 'admin2 mengedit data Pengiriman', 1, '2026-04-15 10:19:19', '2026-04-15 10:19:24'),
(4, 'admin1 menambahkan data Pengiriman', 1, '2026-04-16 05:14:02', '2026-04-16 05:33:06'),
(5, 'admin1 menambahkan data Pengiriman', 1, '2026-04-16 05:18:01', '2026-04-17 10:25:14'),
(6, 'admin1 menambahkan data Pengiriman', 0, '2026-04-16 05:23:23', '2026-04-16 05:23:23'),
(7, 'admin1 menambahkan data Pengiriman', 0, '2026-04-17 10:15:12', '2026-04-17 10:15:12'),
(8, 'admin1 menambahkan data Pengiriman', 0, '2026-04-17 10:23:11', '2026-04-17 10:23:11'),
(9, 'admin1 menambahkan data Pengiriman', 0, '2026-04-17 10:43:57', '2026-04-17 10:43:57'),
(10, 'admin1 menambahkan data Pengiriman', 0, '2026-04-17 10:45:51', '2026-04-17 10:45:51'),
(11, 'admin1 menambahkan data Pengiriman', 0, '2026-04-17 11:00:30', '2026-04-17 11:00:30'),
(12, 'admin1 menambahkan data Pengiriman', 0, '2026-04-17 11:02:40', '2026-04-17 11:02:40'),
(13, 'admin1 menambahkan data Pengiriman', 0, '2026-04-17 12:08:51', '2026-04-17 12:08:51'),
(14, 'admin1 menambahkan data Pengiriman', 0, '2026-04-17 12:13:24', '2026-04-17 12:13:24'),
(15, 'admin1 menambahkan data Pengiriman', 0, '2026-04-18 08:35:34', '2026-04-18 08:35:34'),
(16, 'admin1 menambahkan data Pengiriman', 0, '2026-04-18 08:47:28', '2026-04-18 08:47:28'),
(17, 'admin1 menambahkan data Pengiriman', 0, '2026-04-18 08:54:48', '2026-04-18 08:54:48'),
(18, 'admin1 menambahkan data Pengiriman', 0, '2026-04-18 08:57:33', '2026-04-18 08:57:33'),
(19, 'admin1 menambahkan data Pengiriman', 0, '2026-04-18 09:07:44', '2026-04-18 09:07:44'),
(20, 'admin1 menambahkan data Pengiriman', 0, '2026-04-18 09:14:36', '2026-04-18 09:14:36'),
(21, 'admin1 menambahkan data Pengiriman', 1, '2026-04-18 20:01:20', '2026-04-18 22:48:27'),
(22, 'jendral mengedit data penerimaan', 0, '2026-04-18 22:49:06', '2026-04-18 22:49:06'),
(23, 'jendral mengedit data Pengiriman', 0, '2026-04-18 22:49:23', '2026-04-18 22:49:23'),
(24, 'jendral menambahkan pengiriman', 0, '2026-04-18 22:49:51', '2026-04-18 22:49:51'),
(25, 'bimo menambahkan pengiriman', 0, '2026-04-18 23:05:32', '2026-04-18 23:05:32'),
(26, 'bimo menambahkan pengiriman', 0, '2026-04-18 23:06:11', '2026-04-18 23:06:11'),
(27, 'bimo mengedit data Pengiriman', 0, '2026-04-18 23:15:18', '2026-04-18 23:15:18'),
(28, 'bimo menambahkan pengiriman', 0, '2026-04-18 23:15:46', '2026-04-18 23:15:46'),
(29, 'bimo mengedit data Pengiriman', 0, '2026-04-19 00:07:13', '2026-04-19 00:07:13'),
(30, 'bimo menambahkan pengiriman', 1, '2026-04-19 00:07:29', '2026-04-19 00:18:56'),
(31, 'bimo mengedit data Pengiriman', 0, '2026-04-19 00:19:02', '2026-04-19 00:19:02'),
(32, 'bimo menambahkan pengiriman', 1, '2026-04-19 00:19:24', '2026-04-19 00:20:11'),
(33, 'bimo menambahkan penerimaan', 0, '2026-04-19 00:20:27', '2026-04-19 00:20:27'),
(34, 'bimo menambahkan penerimaan', 0, '2026-04-19 00:21:08', '2026-04-19 00:21:08'),
(35, 'bimo menambahkan pengeringan', 0, '2026-04-19 00:22:03', '2026-04-19 00:22:03'),
(36, 'bimo menambahkan serah terima', 0, '2026-04-19 00:22:32', '2026-04-19 00:22:32'),
(37, 'bimo mengedit data Pengiriman', 0, '2026-04-19 00:22:48', '2026-04-19 00:22:48'),
(38, 'bimo mengedit data Pengiriman', 0, '2026-04-19 03:52:47', '2026-04-19 03:52:47'),
(39, 'bimo mengedit data Pengiriman', 0, '2026-04-19 03:56:15', '2026-04-19 03:56:15'),
(40, 'bimo mengedit data penerimaan', 0, '2026-04-19 03:57:00', '2026-04-19 03:57:00'),
(41, 'bimo menambahkan penerimaan', 0, '2026-04-19 03:57:54', '2026-04-19 03:57:54'),
(42, 'bimo mengedit data serah terima', 0, '2026-04-19 03:58:52', '2026-04-19 03:58:52');

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
-- Table structure for table `pekerja`
--

CREATE TABLE `pekerja` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `lokasi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gaji` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pekerja`
--

INSERT INTO `pekerja` (`id`, `nama`, `jabatan`, `no_hp`, `alamat`, `lokasi`, `created_at`, `updated_at`, `gaji`) VALUES
(1, 'bimo sakti', 'direktur', '089534324', 'jogja', 'Jogja', '2026-04-04 08:56:00', '2026-04-04 08:56:09', 90000000),
(3, 'jendral', 'admin', '213124124', 'Menjing metan Ambarketawang gamping Sleman', 'Gresik', '2026-04-07 21:25:47', '2026-04-07 21:25:47', 10000000);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `serah_terima_id` bigint(20) UNSIGNED NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nominal` decimal(15,2) DEFAULT NULL,
  `status` enum('pending','lunas') DEFAULT 'pending',
  `tanggal_bayar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `serah_terima_id`, `bukti_pembayaran`, `created_at`, `updated_at`, `user_id`, `nominal`, `status`, `tanggal_bayar`) VALUES
(1, 1, 'pembayaran/SlfYBccJzPlPQ3bpnyPP1YR57A4PZxEcGmpd9bGL.png', '2026-04-01 02:35:26', '2026-04-01 02:35:26', 1, 200000.00, 'lunas', '2026-04-01'),
(2, 2, 'pembayaran/UcCgoKc5TyuqdAzYpCluNIhJ2CYuCJe7GiFnfKPY.png', '2026-04-01 09:08:19', '2026-04-01 09:08:19', 1, 200000.00, 'lunas', '2026-04-01'),
(3, 3, 'pembayaran/MOL09fiVXw3g5X9RjUfNiaIyEXbYuJIU95W2fFIA.png', '2026-04-03 10:08:04', '2026-04-03 10:08:04', 1, 500000.00, 'lunas', '2026-04-03'),
(4, 3, 'pembayaran/28nvgjioLSaSTkgk7oPPGVzDmU46LtCqIU0b6qwz.png', '2026-04-03 10:24:25', '2026-04-03 10:24:25', 1, 500000.00, 'lunas', '2026-04-03');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_gajis`
--

CREATE TABLE `pembayaran_gajis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pekerja_id` bigint(20) UNSIGNED NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `lokasi` varchar(255) NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran_gajis`
--

INSERT INTO `pembayaran_gajis` (`id`, `pekerja_id`, `bulan`, `tahun`, `status`, `lokasi`, `nominal`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 2026, 1, 'Jogja', 1000000, '2026-04-08', '2026-04-07 21:53:51', '2026-04-07 21:53:51'),
(2, 3, 4, 2026, 1, 'Gresik', 1000000, '2026-04-08', '2026-04-07 21:53:56', '2026-04-07 21:53:56'),
(7, 1, 5, 2026, 1, 'Jogja', 0, '2026-05-08', '2026-05-08 03:00:09', '2026-05-08 03:00:09'),
(8, 3, 5, 2026, 1, 'Gresik', 0, '2026-05-08', '2026-05-08 03:00:12', '2026-05-08 03:00:12'),
(9, 1, 6, 2026, 1, 'Jogja', 1000000, '2026-06-08', '2026-06-08 03:24:40', '2026-06-08 03:24:40'),
(10, 3, 6, 2026, 1, 'Gresik', 1000000, '2026-06-08', '2026-06-08 03:24:46', '2026-06-08 03:24:46'),
(15, 1, 7, 2026, 1, 'Jogja', 90000000, '2026-07-08', '2026-07-08 03:29:46', '2026-07-08 03:29:46'),
(16, 3, 7, 2026, 1, 'Gresik', 10000000, '2026-07-08', '2026-07-08 03:29:52', '2026-07-08 03:29:52');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_operasionals`
--

CREATE TABLE `pembayaran_operasionals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran_operasionals`
--

INSERT INTO `pembayaran_operasionals` (`id`, `lokasi`, `nominal`, `keterangan`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 'Jogja', 200000, 'pembayaran truk muatan', '2026-04-08', '2026-04-08 02:56:49', '2026-04-08 04:19:30');

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan`
--

CREATE TABLE `penerimaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `dokumentasi` varchar(255) DEFAULT NULL,
  `berita_acara` text DEFAULT NULL,
  `nominal_pembayaran` decimal(15,2) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penerimaan`
--

INSERT INTO `penerimaan` (`id`, `tanggal`, `keterangan`, `dokumentasi`, `berita_acara`, `nominal_pembayaran`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2026-03-19', 'menerima 1000 ton pasir silika', 'penerimaan/EW9dYyLlrKBdFyaJaWyx0AwExQ2ZwVBOLiJE2jUg.jpg', 'sampai dengan lancar', 2000000.00, 1, '2026-03-30 21:51:14', '2026-04-05 23:39:25'),
(2, '2026-04-02', 'menerimakan 1000 ton2', 'penerimaan/4W0Kk6khs5jThme0hE3IKlkXDog1JJ3jlmnxZWQx.jpg', 'sampai dengan lancar di pelabuan jipe', 20000000.00, 1, '2026-04-05 23:46:41', '2026-04-18 22:49:06'),
(5, '2026-04-19', 'd', 'penerimaan/yjRAlkibWUWRKJTcpUsKg9d6mtpWeo1ptn0g3hHr.png', 'sesuai', 200000000.00, 1, '2026-04-19 03:57:54', '2026-04-19 03:57:54');

-- --------------------------------------------------------

--
-- Table structure for table `pengeringan`
--

CREATE TABLE `pengeringan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `dokumentasi` varchar(255) DEFAULT NULL,
  `berita_acara` text DEFAULT NULL,
  `nominal_pembayaran` decimal(15,2) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengeringan`
--

INSERT INTO `pengeringan` (`id`, `tanggal`, `keterangan`, `dokumentasi`, `berita_acara`, `nominal_pembayaran`, `user_id`, `created_at`, `updated_at`, `quantity`) VALUES
(1, '2026-03-26', 'baik', 'pengeringan/qJwMc8jxtnyw2dKGJkgDMkGEg2gKix29BOQ2dpvQ.jpg', 'proses pengeringan pasir silika 2000 ton', 200000000.00, 1, '2026-03-31 02:28:30', '2026-04-06 00:35:33', 2000),
(2, '2026-04-06', 'lancar', 'pengeringan/cvDCnDATzdkcnk4ums7q8bJ2pFSJX4i28QStRs2g.jpg', 'Pengeringan', 400000.00, 1, '2026-04-06 00:33:39', '2026-04-06 00:33:39', 2000),
(3, '2026-04-06', 'pembayaran transport', 'pengeringan/aCINrHH1tjDv0cy0zAm3vgaHJfAKthrootH8clDq.jpg', 'Pengeringan', 6000000.00, 1, '2026-04-06 00:34:44', '2026-04-06 00:34:44', 4000),
(4, '2026-04-19', 'sada', 'pengeringan/KvpiwPGThby4kWf6Xj3jaLX3EpIcl8S0Htes8RfS.png', 'oke gasasdsad', 2213.00, 1, '2026-04-19 00:22:03', '2026-04-19 00:22:03', 60);

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `dokumentasi` varchar(255) DEFAULT NULL,
  `berita_acara` text DEFAULT NULL,
  `nominal_pembayaran` decimal(15,2) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id`, `tanggal`, `keterangan`, `dokumentasi`, `berita_acara`, `nominal_pembayaran`, `user_id`, `created_at`, `updated_at`) VALUES
(5, '2026-03-19', 'pengiriman pasir silika 10000 ton', 'dokumentasi/ij6lQGyISUYPU3T9rffN7owKSvFYysayhqMdcNtz.jpg', 'pengiriman lancar', 100000000.00, 1, '2026-03-27 03:10:52', '2026-04-05 23:30:00'),
(7, '2026-03-12', 'pengiriman pasir silika 2000', 'dokumentasi/75IfZ9aBDrhGR90ZNhaI8Cpoba7lyesSrEcllTeb.jpg', 'sesuai', 123123124124.00, 1, '2026-03-30 20:52:01', '2026-04-06 05:16:01'),
(8, '2026-03-25', 'pengiriman 2000 ton pasir silika', 'dokumentasi/8dP0goFmGqgfAiog4PYwNWvrBDRajr1JhcTksmul.png', 'sesuai', 123123.00, 1, '2026-03-30 20:58:28', '2026-04-06 05:05:42'),
(9, '2026-04-05', 'pengiriman pasir silika 10000 ton', 'dokumentasi/ZmVQFY8E8iVGdRh0GesGTQ0eGcxgxIQLgL7WXESB.png', 'pengiriman lancar', 20000.00, 1, '2026-04-05 06:16:07', '2026-04-15 02:31:47'),
(10, '2026-04-15', 'mengirimkan 200ton silika', 'dokumentasi/jbiyb0VcOMAHtrc9rwrHTkoKdQu14Y10alMGb8gh.png', 'sesuai', 50000.00, 1, '2026-04-15 04:30:30', '2026-04-15 10:19:19'),
(11, '2026-04-16', 'bagus', 'dokumentasi/dy39BJl7xgg9BZoD2ocakZZfhknPoSzzI6pvnCOx.png', 'sesuai', 20000000.00, 4, '2026-04-16 05:14:02', '2026-04-16 05:14:02'),
(13, '2026-04-15', 'bagus', 'dokumentasi/7prNyuJDKo76K26Hyc5XuzdM6a0APxHRGR6PeM7B.png', 'sesuai', 20000000000.00, 4, '2026-04-16 05:23:23', '2026-04-16 05:23:23'),
(14, '2026-04-17', 'pengiriman dari belitung', 'dokumentasi/O1zkTBNoHdHoRCf39GGlMHpvUgssnPZiNG461HBp.png', 'sesuai', 5000000.00, 4, '2026-04-17 10:15:12', '2026-04-17 10:15:12'),
(15, '2026-04-17', 'pengiriman dari belitung', 'dokumentasi/tqrLMEZupMZ5SZHXw2UdzbouYwfrtbzTFkGDig5C.png', 'sesuai2', 5000000.00, 4, '2026-04-17 10:23:11', '2026-04-17 10:23:11'),
(16, '2026-04-17', 'belitung', 'dokumentasi/wnL6B6HoRgR3T7tchOligqB3myJQdYfGvPEVDcJp.png', 'sesuai', 7000000.00, 4, '2026-04-17 10:43:56', '2026-04-17 10:43:56'),
(22, '2026-04-18', 'bagus', 'dokumentasi/5oGTqOXe6GgUJTlKtRd8jvmek9yGdqjNqqvgTNwr.png', 'sesuai', 300000.00, 4, '2026-04-18 08:35:34', '2026-04-18 08:35:34'),
(23, '2026-04-18', 'banget', 'dokumentasi/rZTfKB4Kk1vfkBj3jpdBdHdyFzTLSryepWeDwift.png', 'sesuai', 20000.00, 4, '2026-04-18 08:47:28', '2026-04-18 08:47:28'),
(24, '2026-04-18', 'fffff', 'dokumentasi/SxI43TTDllVilNbVQ4T421DVFOPcN9nkfHPMfE7T.png', 'oke banget', 20000.00, 4, '2026-04-18 08:54:48', '2026-04-18 08:54:48'),
(25, '2026-04-18', 'f', 'dokumentasi/P8tozxwkoIspWLLOoD11igCer50NenWwhpaBlTI6.png', 'sesuai', 2000000.00, 4, '2026-04-18 08:57:33', '2026-04-18 08:57:33'),
(26, '2026-04-18', '200000000', 'dokumentasi/EC6tH5MOnPvc8KuCR0Z9lSwqYuVWAhmINtyf2w07.png', 'ses8a9', 20000000.00, 4, '2026-04-18 09:07:44', '2026-04-18 09:07:44'),
(27, '2026-04-18', 'tidak', 'dokumentasi/2lC9XBU6FTG2VECVfFOfryi1VA4Z4mwfmx9KPHcs.png', 'sesuai', 20000.00, 4, '2026-04-18 09:14:36', '2026-04-18 09:14:36'),
(28, '2026-04-19', 'pp', 'dokumentasi/t183NjggAvwPcR0oKpQTJDwS91R2RVXbuqxEBccN.png', 'sesuai', 2000.00, 4, '2026-04-18 20:01:20', '2026-04-18 22:49:23'),
(29, '2026-04-19', 'baik', 'dokumentasi/HAfvYhuiPSwGhpChyrFl6Q0ohmLhE9joU3nioJRG.png', 'sesuai', 200000000.00, 2, '2026-04-18 22:49:51', '2026-04-18 22:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `serah_terima`
--

CREATE TABLE `serah_terima` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `dokumentasi` varchar(255) NOT NULL,
  `berita_acara` varchar(255) NOT NULL,
  `clear` tinyint(1) NOT NULL DEFAULT 0,
  `ada_kurang` tinyint(1) NOT NULL DEFAULT 0,
  `nominal_pembayaran` decimal(15,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lunas` tinyint(1) NOT NULL DEFAULT 0,
  `lokasi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `serah_terima`
--

INSERT INTO `serah_terima` (`id`, `tanggal`, `keterangan`, `dokumentasi`, `berita_acara`, `clear`, `ada_kurang`, `nominal_pembayaran`, `user_id`, `created_at`, `updated_at`, `lunas`, `lokasi`) VALUES
(1, '2026-03-20', 'bagus', 'serah-terima/GRKJOGHoovQVZ6EyRfGU2aeIP7H81ucVyjMEZBj6.jpg', 'serah terima pasir silika ke xinyi', 1, 0, 40000000.00, 1, '2026-03-31 03:31:53', '2026-04-06 01:13:47', 0, NULL),
(2, '2026-04-01', 'kondisi bagus', 'serah-terima/DM74zPisoK3a9TpA6zwGAGbpc30mGoD0yh4pPpIZ.jpg', 'serah terima pasir silika ke xinyi', 1, 0, 200000000.00, 1, '2026-03-31 20:21:51', '2026-04-06 01:04:13', 0, NULL),
(3, '2026-04-15', 'pasir kondisi baik', 'serah-terima/E5DyW54SiFKIeoozM4RaH5pILt1kdt3MXu3NN04e.jpg', 'serah terima pasir silika ke xinyi', 1, 0, 200000.00, 1, '2026-04-01 01:34:25', '2026-04-06 01:03:05', 0, NULL),
(4, '2026-04-16', 'pembayaran kurang RP.300000SS', 'serah-terima/ULJBr3h07cwe5dGTEi4K7ZDs3AA1EIg2ZWndWdrC.png', 'serah terima pasir silika ke xinyi', 0, 1, 2000000.00, 1, '2026-04-01 02:46:36', '2026-04-06 01:17:26', 0, NULL),
(5, '2026-04-19', 'test', 'serah-terima/IfJNxH7jGRBaZO9mGBQESugDUYPBSD98m0vO00nj.png', 'sesuai', 1, 0, 20000000.00, 1, '2026-04-19 00:22:32', '2026-04-19 03:58:52', 0, NULL);

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
('tUt7AFsConIDiojjIZl2sKi2Rc2yRl5mJX3GSQy8', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI0dVpRYkhBRDRDaEZtNzk4Zm5hUnJlWFdyZWYxTjdhVGFNMVI1c2VYIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL3BlbmdpcmltYW4ifSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==', 1776598069);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'bimo', 'bimosakti151@gmail.com', NULL, '$2y$12$c0ecTju3bkSmi7GtKknkbuXWqXCwsXJiBUnZa7QbxxsZhz8aSO3hi', NULL, '2026-03-20 06:04:50', '2026-03-20 06:04:50', 'admin'),
(2, 'jendral', 'bimo.master151@gmail.com', NULL, '$2y$12$70HajzuC1nTcxnxGVDo8YuG8d9hWAajwaxfF1DLBWe42n2aQ18zci', NULL, '2026-04-01 11:58:52', '2026-04-01 11:58:52', 'user'),
(3, 'admin1', 'admin@123', NULL, '$2y$12$tHDok9s/R9idnqsBeYwJDOkChOvzS.qmwyWQ12.VtkFMlCqH3UhYm', NULL, '2026-04-15 01:59:51', '2026-04-15 01:59:51', 'user'),
(4, 'admin1', 'admin@1', NULL, '$2y$12$UGCZDcDnGQ0En6erFZ7BeOUbiMTuQK4dmJIB9a0e8xlL20Xsglcsi', NULL, '2026-04-15 02:31:07', '2026-04-15 02:31:07', 'admin'),
(5, 'admin2', 'admin@2', NULL, '$2y$12$XN9g6sP0hH4VugA6hugrcOars/GuoBl8OsDpVLgNkvRT1JBWgt0B2', NULL, '2026-04-15 02:32:25', '2026-04-15 02:32:25', 'admin'),
(6, 'admin3', 'admin@3', NULL, '$2y$12$9hIDW258HVphasmxox235.6icrMraHFyc5P0o/wnBxGbarQxRC8gS', NULL, '2026-04-15 02:32:55', '2026-04-15 02:32:55', 'admin'),
(7, 'admin4', 'admin@4', NULL, '$2y$12$rkUKs3ojfNQSmbLORb9uX.jRboxKRVlBtE7YDyL/024n55xbUuY/6', NULL, '2026-04-15 02:33:29', '2026-04-15 02:33:29', 'admin'),
(8, 'admin5', 'admin@5', NULL, '$2y$12$fjEiRd16EoeX/Ys.sdmN/OLd49j/UESvmG6M7sYCHXu5gafaV5oqO', NULL, '2026-04-15 02:33:55', '2026-04-15 02:33:55', 'admin'),
(9, 'user1', 'user@1', NULL, '$2y$12$1Lerdpv.BusIYVuoKJcZA.Xw34YpBXTARFG0MSHK8PJtJmODcLhdq', NULL, '2026-04-15 02:55:57', '2026-04-15 02:55:57', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `camera`
--
ALTER TABLE `camera`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cctv`
--
ALTER TABLE `cctv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `kas_keuangan`
--
ALTER TABLE `kas_keuangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasis`
--
ALTER TABLE `notifikasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pekerja`
--
ALTER TABLE `pekerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `pembayaran_gajis`
--
ALTER TABLE `pembayaran_gajis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pekerja_gaji` (`pekerja_id`);

--
-- Indexes for table `pembayaran_operasionals`
--
ALTER TABLE `pembayaran_operasionals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penerimaan_user_id_foreign` (`user_id`);

--
-- Indexes for table `pengeringan`
--
ALTER TABLE `pengeringan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengeringan_user_id_foreign` (`user_id`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengiriman_user_id_foreign` (`user_id`);

--
-- Indexes for table `serah_terima`
--
ALTER TABLE `serah_terima`
  ADD PRIMARY KEY (`id`),
  ADD KEY `serah_terima_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `camera`
--
ALTER TABLE `camera`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cctv`
--
ALTER TABLE `cctv`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kas_keuangan`
--
ALTER TABLE `kas_keuangan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `notifikasis`
--
ALTER TABLE `notifikasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `pekerja`
--
ALTER TABLE `pekerja`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran_gajis`
--
ALTER TABLE `pembayaran_gajis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pembayaran_operasionals`
--
ALTER TABLE `pembayaran_operasionals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penerimaan`
--
ALTER TABLE `penerimaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengeringan`
--
ALTER TABLE `pengeringan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `serah_terima`
--
ALTER TABLE `serah_terima`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran_gajis`
--
ALTER TABLE `pembayaran_gajis`
  ADD CONSTRAINT `fk_pekerja_gaji` FOREIGN KEY (`pekerja_id`) REFERENCES `pekerja` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD CONSTRAINT `penerimaan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengeringan`
--
ALTER TABLE `pengeringan`
  ADD CONSTRAINT `pengeringan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `pengiriman_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `serah_terima`
--
ALTER TABLE `serah_terima`
  ADD CONSTRAINT `serah_terima_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
