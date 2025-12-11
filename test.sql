-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Des 2025 pada 20.37
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'programs', 'User visited programs', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"programs.index\",\"method\":\"GET\",\"path\":\"programs\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/programs\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/login\"}', NULL, '2025-12-11 18:58:50', '2025-12-11 18:58:50'),
(2, 'programs', 'User visited programs', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"programs.index\",\"method\":\"GET\",\"path\":\"programs\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/programs?_=1765479531028&columns%5B0%5D%5Bdata%5D=&columns%5B0%5D%5Bname%5D=&columns%5B0%5D%5Bsearchable%5D=true&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=thumbnail_preview&columns%5B1%5D%5Bname%5D=thumbnail&columns%5B1%5D%5Bsearchable%5D=false&columns%5B1%5D%5Borderable%5D=false&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=title&columns%5B2%5D%5Bname%5D=title&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=platform_badge&columns%5B3%5D%5Bname%5D=platform&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=false&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=status_badge&columns%5B4%5D%5Bname%5D=status&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=false&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=characters_list&columns%5B5%5D%5Bname%5D=characters&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=false&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=action&columns%5B6%5D%5Bname%5D=action&columns%5B6%5D%5Bsearchable%5D=false&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=10&order%5B0%5D%5Bcolumn%5D=2&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/programs\"}', NULL, '2025-12-11 18:58:51', '2025-12-11 18:58:51'),
(3, 'programs', 'User visited programs/3', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"programs.show\",\"method\":\"GET\",\"path\":\"programs\\/3\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/programs\\/3\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/programs\"}', NULL, '2025-12-11 18:59:12', '2025-12-11 18:59:12'),
(4, 'programs', 'User visited programs', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"programs.index\",\"method\":\"GET\",\"path\":\"programs\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/programs?_=1765479556058&columns%5B0%5D%5Bdata%5D=&columns%5B0%5D%5Bname%5D=&columns%5B0%5D%5Bsearchable%5D=true&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=thumbnail_preview&columns%5B1%5D%5Bname%5D=thumbnail&columns%5B1%5D%5Bsearchable%5D=false&columns%5B1%5D%5Borderable%5D=false&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=title&columns%5B2%5D%5Bname%5D=title&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=platform_badge&columns%5B3%5D%5Bname%5D=platform&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=false&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=status_badge&columns%5B4%5D%5Bname%5D=status&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=false&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=characters_list&columns%5B5%5D%5Bname%5D=characters&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=false&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=action&columns%5B6%5D%5Bname%5D=action&columns%5B6%5D%5Bsearchable%5D=false&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=10&order%5B0%5D%5Bcolumn%5D=2&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/programs\"}', NULL, '2025-12-11 18:59:16', '2025-12-11 18:59:16'),
(5, 'programs', 'User visited programs', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"programs.index\",\"method\":\"GET\",\"path\":\"programs\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/programs\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/login\"}', NULL, '2025-12-11 18:59:34', '2025-12-11 18:59:34'),
(6, 'programs', 'User visited programs', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"programs.index\",\"method\":\"GET\",\"path\":\"programs\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/programs?_=1765479574948&columns%5B0%5D%5Bdata%5D=&columns%5B0%5D%5Bname%5D=&columns%5B0%5D%5Bsearchable%5D=true&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=thumbnail_preview&columns%5B1%5D%5Bname%5D=thumbnail&columns%5B1%5D%5Bsearchable%5D=false&columns%5B1%5D%5Borderable%5D=false&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=title&columns%5B2%5D%5Bname%5D=title&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=platform_badge&columns%5B3%5D%5Bname%5D=platform&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=false&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=status_badge&columns%5B4%5D%5Bname%5D=status&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=false&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=characters_list&columns%5B5%5D%5Bname%5D=characters&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=false&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=action&columns%5B6%5D%5Bname%5D=action&columns%5B6%5D%5Bsearchable%5D=false&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=10&order%5B0%5D%5Bcolumn%5D=2&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/programs\"}', NULL, '2025-12-11 18:59:35', '2025-12-11 18:59:35'),
(7, 'programs', 'User visited programs', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"programs.index\",\"method\":\"GET\",\"path\":\"programs\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/programs\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/login\"}', NULL, '2025-12-11 18:59:38', '2025-12-11 18:59:38'),
(8, 'programs', 'User visited programs', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"programs.index\",\"method\":\"GET\",\"path\":\"programs\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/programs?_=1765479579095&columns%5B0%5D%5Bdata%5D=&columns%5B0%5D%5Bname%5D=&columns%5B0%5D%5Bsearchable%5D=true&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=thumbnail_preview&columns%5B1%5D%5Bname%5D=thumbnail&columns%5B1%5D%5Bsearchable%5D=false&columns%5B1%5D%5Borderable%5D=false&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=title&columns%5B2%5D%5Bname%5D=title&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=platform_badge&columns%5B3%5D%5Bname%5D=platform&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=false&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=status_badge&columns%5B4%5D%5Bname%5D=status&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=false&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=characters_list&columns%5B5%5D%5Bname%5D=characters&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=false&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=action&columns%5B6%5D%5Bname%5D=action&columns%5B6%5D%5Bsearchable%5D=false&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=10&order%5B0%5D%5Bcolumn%5D=2&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/programs\"}', NULL, '2025-12-11 18:59:39', '2025-12-11 18:59:39'),
(9, 'programs', 'User visited programs', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"programs.index\",\"method\":\"GET\",\"path\":\"programs\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/programs\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/login\"}', NULL, '2025-12-11 19:01:12', '2025-12-11 19:01:12'),
(10, 'programs', 'User visited programs', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"programs.index\",\"method\":\"GET\",\"path\":\"programs\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/programs?_=1765479672886&columns%5B0%5D%5Bdata%5D=&columns%5B0%5D%5Bname%5D=&columns%5B0%5D%5Bsearchable%5D=true&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=thumbnail_preview&columns%5B1%5D%5Bname%5D=thumbnail&columns%5B1%5D%5Bsearchable%5D=false&columns%5B1%5D%5Borderable%5D=false&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=title&columns%5B2%5D%5Bname%5D=title&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=platform_badge&columns%5B3%5D%5Bname%5D=platform&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=false&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=status_badge&columns%5B4%5D%5Bname%5D=status&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=false&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=characters_list&columns%5B5%5D%5Bname%5D=characters&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=false&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=action&columns%5B6%5D%5Bname%5D=action&columns%5B6%5D%5Bsearchable%5D=false&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=10&order%5B0%5D%5Bcolumn%5D=2&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/programs\"}', NULL, '2025-12-11 19:01:13', '2025-12-11 19:01:13'),
(11, 'programs', 'User visited programs', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"programs.index\",\"method\":\"GET\",\"path\":\"programs\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/programs\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/login\"}', NULL, '2025-12-11 19:01:41', '2025-12-11 19:01:41'),
(12, 'programs', 'User visited programs', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"programs.index\",\"method\":\"GET\",\"path\":\"programs\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/programs?_=1765479701301&columns%5B0%5D%5Bdata%5D=&columns%5B0%5D%5Bname%5D=&columns%5B0%5D%5Bsearchable%5D=true&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=thumbnail_preview&columns%5B1%5D%5Bname%5D=thumbnail&columns%5B1%5D%5Bsearchable%5D=false&columns%5B1%5D%5Borderable%5D=false&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=title&columns%5B2%5D%5Bname%5D=title&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=platform_badge&columns%5B3%5D%5Bname%5D=platform&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=false&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=status_badge&columns%5B4%5D%5Bname%5D=status&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=false&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=characters_list&columns%5B5%5D%5Bname%5D=characters&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=false&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=action&columns%5B6%5D%5Bname%5D=action&columns%5B6%5D%5Bsearchable%5D=false&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=10&order%5B0%5D%5Bcolumn%5D=2&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/programs\"}', NULL, '2025-12-11 19:01:41', '2025-12-11 19:01:41'),
(13, 'programs', 'User visited programs/1', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"programs.show\",\"method\":\"GET\",\"path\":\"programs\\/1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/programs\\/1\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/programs\"}', NULL, '2025-12-11 19:01:58', '2025-12-11 19:01:58'),
(14, 'programs', 'User visited programs/1', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"programs.show\",\"method\":\"GET\",\"path\":\"programs\\/1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/programs\\/1\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/programs\\/1\"}', NULL, '2025-12-11 19:02:28', '2025-12-11 19:02:28'),
(15, 'programs', 'User visited programs/1', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"programs.show\",\"method\":\"GET\",\"path\":\"programs\\/1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/programs\\/1\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/programs\\/1\"}', NULL, '2025-12-11 19:02:37', '2025-12-11 19:02:37'),
(16, 'programs', 'User visited programs/1', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"programs.show\",\"method\":\"GET\",\"path\":\"programs\\/1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/programs\\/1\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/programs\\/1\"}', NULL, '2025-12-11 19:02:40', '2025-12-11 19:02:40'),
(17, 'programs', 'User visited programs/1', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"programs.show\",\"method\":\"GET\",\"path\":\"programs\\/1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/programs\\/1\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/programs\\/1\"}', NULL, '2025-12-11 19:02:43', '2025-12-11 19:02:43'),
(18, 'programs', 'User visited programs', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"programs.index\",\"method\":\"GET\",\"path\":\"programs\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/programs\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/programs\\/1\"}', NULL, '2025-12-11 19:03:23', '2025-12-11 19:03:23'),
(19, 'programs', 'User visited programs', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"programs.index\",\"method\":\"GET\",\"path\":\"programs\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/programs?_=1765479803573&columns%5B0%5D%5Bdata%5D=&columns%5B0%5D%5Bname%5D=&columns%5B0%5D%5Bsearchable%5D=true&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=thumbnail_preview&columns%5B1%5D%5Bname%5D=thumbnail&columns%5B1%5D%5Bsearchable%5D=false&columns%5B1%5D%5Borderable%5D=false&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=title&columns%5B2%5D%5Bname%5D=title&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=platform_badge&columns%5B3%5D%5Bname%5D=platform&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=false&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=status_badge&columns%5B4%5D%5Bname%5D=status&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=false&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=characters_list&columns%5B5%5D%5Bname%5D=characters&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=false&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=action&columns%5B6%5D%5Bname%5D=action&columns%5B6%5D%5Bsearchable%5D=false&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=10&order%5B0%5D%5Bcolumn%5D=2&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/programs\"}', NULL, '2025-12-11 19:03:24', '2025-12-11 19:03:24'),
(20, 'users', 'User visited users', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"users.index\",\"method\":\"GET\",\"path\":\"users\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/users\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/programs\"}', NULL, '2025-12-11 19:03:25', '2025-12-11 19:03:25'),
(21, 'users', 'User visited users', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"users.index\",\"method\":\"GET\",\"path\":\"users\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/users?_=1765479805929&columns%5B0%5D%5Bdata%5D=&columns%5B0%5D%5Bname%5D=&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=&columns%5B1%5D%5Bname%5D=&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=false&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=photo_preview&columns%5B2%5D%5Bname%5D=photo&columns%5B2%5D%5Bsearchable%5D=false&columns%5B2%5D%5Borderable%5D=false&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=name&columns%5B3%5D%5Bname%5D=name&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=email&columns%5B4%5D%5Bname%5D=email&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=status_badge&columns%5B5%5D%5Bname%5D=status&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=false&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=email_verified&columns%5B6%5D%5Bname%5D=email_verified_at&columns%5B6%5D%5Bsearchable%5D=true&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B7%5D%5Bdata%5D=activity_count&columns%5B7%5D%5Bname%5D=activity_count&columns%5B7%5D%5Bsearchable%5D=false&columns%5B7%5D%5Borderable%5D=false&columns%5B7%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B7%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B8%5D%5Bdata%5D=action&columns%5B8%5D%5Bname%5D=action&columns%5B8%5D%5Bsearchable%5D=false&columns%5B8%5D%5Borderable%5D=false&columns%5B8%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B8%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=10&order%5B0%5D%5Bcolumn%5D=3&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/users\"}', NULL, '2025-12-11 19:03:26', '2025-12-11 19:03:26'),
(22, 'default', 'User visited dashboard', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"dashboard\",\"method\":\"GET\",\"path\":\"dashboard\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/dashboard\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/activity-logs\"}', NULL, '2025-12-11 19:03:40', '2025-12-11 19:03:40'),
(23, 'default', 'User visited logout', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"logout\",\"method\":\"POST\",\"path\":\"logout\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/logout\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/dashboard\"}', NULL, '2025-12-11 19:03:46', '2025-12-11 19:03:46'),
(24, 'default', 'User visited dashboard', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"route\":\"dashboard\",\"method\":\"GET\",\"path\":\"dashboard\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/dashboard\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/login\"}', NULL, '2025-12-11 19:07:42', '2025-12-11 19:07:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `characters`
--

CREATE TABLE `characters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `philosophy` text DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `artifact` varchar(255) DEFAULT NULL,
  `power` varchar(255) DEFAULT NULL,
  `island` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `dna` varchar(255) DEFAULT NULL,
  `attitude` text DEFAULT NULL,
  `character` text DEFAULT NULL,
  `colors` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`colors`)),
  `color_names` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`color_names`)),
  `image` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `characters`
--

INSERT INTO `characters` (`id`, `name`, `slug`, `full_name`, `region`, `philosophy`, `height`, `weight`, `artifact`, `power`, `island`, `origin`, `dna`, `attitude`, `character`, `colors`, `color_names`, `image`, `thumbnail`, `video`, `description`, `status`, `order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'KUNNA', 'kunna', 'Kunna', 'Jawa Tengah', 'Kunanti yang di Tata', '178 cm', '77 kg', 'Topeng', 'Cahaya', 'Jawa', 'Bantul', 'Raja Jawa', 'Mewakili karakter Jawa', 'Ramah, Santun, Sabar, Ulet, Pintar, Mengutamakan Persatuan dan Adab', '[\"#FF6B35\",\"#8B4513\",\"#FFD700\"]', '[\"Jingga\",\"Coklat Tua\",\"Kuning\"]', 'characters/chara-01.png', 'characters/thumbnails/thumb-chara-01.png', 'characters/videos/patrion-kuna.mp4', 'KUNNA adalah karakter yang mewakili Jawa Tengah dengan filosofi \"Kunanti yang di Tata\". Dengan tinggi 178 cm dan berat 77 kg, KUNNA membawa artefak Topeng dan menguasai kekuatan Cahaya. Berasal dari Bantul, Jawa, KUNNA memiliki DNA Raja Jawa dan mewakili karakter Jawa yang ramah, santun, sabar, ulet, pintar, serta mengutamakan persatuan dan adab.', 'draft', 1, '2025-12-11 18:58:21', '2025-12-11 18:58:21', NULL),
(2, 'WABU', 'wabu', 'Wabu', 'Jakarta', 'Warisan Budaya', '177 cm', '78 kg', 'Kode Biner', 'Digital', 'Jawa', 'Jakarta', 'Multi Culture (China)', 'Mewakili Karakter Betawi', 'Ramah, Santun, Sabar, Ulet, Pintar, Mengutamakan Persatuan dan Adab', '[\"#FFFFFF\",\"#000000\",\"#FF0000\"]', '[\"Putih\",\"Hitam\",\"Merah\"]', 'characters/chara-02.png', 'characters/thumbnails/thumb-chara-02.png', 'characters/videos/patrion-wabu.mp4', 'WABU adalah karakter yang mewakili Jakarta dengan filosofi \"Warisan Budaya\". Dengan tinggi 177 cm dan berat 78 kg, WABU membawa artefak Kode Biner dan menguasai kekuatan Digital. Berasal dari Jakarta, Jawa, WABU memiliki DNA Multi Culture (China) dan mewakili karakter Betawi yang ramah, santun, sabar, ulet, pintar, serta mengutamakan persatuan dan adab.', 'draft', 2, '2025-12-11 18:58:21', '2025-12-11 18:58:21', NULL),
(3, 'ASTA', 'asta', 'Asta', 'Bali', 'Anak Semesta', '175 cm', '80 kg', 'Ikat kepala', 'Magnet', 'Bali', 'Bali', 'Raja Bali', 'Mewakili karakter Bali', 'Ramah, Santun, Sabar, Ulet, Pintar, Mengutamakan Persatuan dan Adab', '[\"#FF6B35\",\"#8B4513\",\"#FFD700\"]', '[\"Jingga\",\"Coklat Tua\",\"Kuning\"]', 'characters/chara-03.png', 'characters/thumbnails/thumb-chara-03.png', 'characters/videos/patrion-asta.mp4', 'ASTA adalah karakter yang mewakili Bali dengan filosofi \"Anak Semesta\". Dengan tinggi 175 cm dan berat 80 kg, ASTA membawa artefak Ikat kepala dan menguasai kekuatan Magnet. Berasal dari Bali, ASTA memiliki DNA Raja Bali dan mewakili karakter Bali yang ramah, santun, sabar, ulet, pintar, serta mengutamakan persatuan dan adab.', 'draft', 3, '2025-12-11 18:58:21', '2025-12-11 18:58:21', NULL),
(4, 'TARAN', 'taran', 'Taran', 'Sumatera', 'Warisan Budaya', '177 cm', '78 kg', 'Kode Biner', 'Digital', 'Sumatera', 'Bukit Tinggi', 'Multi Culture (China)', 'Mewakili karakter Sumatera', 'Ramah, Santun, Sabar, Ulet, Pintar, Mengutamakan Persatuan dan Adab', '[\"#FFFFFF\",\"#000000\",\"#FF0000\"]', '[\"Putih\",\"Hitam\",\"Merah\"]', 'characters/chara-04.png', 'characters/thumbnails/thumb-chara-04.png', 'characters/videos/patrion-taran.mp4', 'TARAN adalah karakter yang mewakili Sumatera dengan filosofi \"Warisan Budaya\". Dengan tinggi 177 cm dan berat 78 kg, TARAN membawa artefak Kode Biner dan menguasai kekuatan Digital. Berasal dari Bukit Tinggi, Sumatera, TARAN memiliki DNA Multi Culture (China) dan mewakili karakter Sumatera yang ramah, santun, sabar, ulet, pintar, serta mengutamakan persatuan dan adab.', 'draft', 4, '2025-12-11 18:58:21', '2025-12-11 18:58:21', NULL),
(5, 'SANU', 'sanu', 'Sanu', 'Sulawesi', 'Warisan Budaya', '177 cm', '78 kg', 'Kode Biner', 'Digital', 'Sulawesi', 'Sulawesi', 'Multi Culture (China)', 'Mewakili karakter Sulawesi', 'Ramah, Santun, Sabar, Ulet, Pintar, Mengutamakan Persatuan dan Adab', '[\"#FFFFFF\",\"#000000\",\"#FF0000\"]', '[\"Putih\",\"Hitam\",\"Merah\"]', 'characters/chara-05.png', 'characters/thumbnails/thumb-chara-05.png', 'characters/videos/patrion-sanu.mp4', 'SANU adalah karakter yang mewakili Sulawesi dengan filosofi \"Warisan Budaya\". Dengan tinggi 177 cm dan berat 78 kg, SANU membawa artefak Kode Biner dan menguasai kekuatan Digital. Berasal dari Sulawesi, SANU memiliki DNA Multi Culture (China) dan mewakili karakter Sulawesi yang ramah, santun, sabar, ulet, pintar, serta mengutamakan persatuan dan adab.', 'draft', 5, '2025-12-11 18:58:21', '2025-12-11 18:58:21', NULL),
(6, 'KABI', 'kabi', 'Kabi', 'Papua', 'Warisan Budaya', '177 cm', '78 kg', 'Kode Biner', 'Digital', 'Papua', 'Jayapura', 'Astronesia', 'Mewakili karakter Papua', 'Ramah, Santun, Sabar, Ulet, Pintar, Mengutamakan Persatuan dan Adab', '[\"#FFFFFF\",\"#000000\",\"#FF0000\"]', '[\"Putih\",\"Hitam\",\"Merah\"]', 'characters/chara-06.png', 'characters/thumbnails/thumb-chara-06.png', 'characters/videos/patrion-kabi.mp4', 'KABI adalah karakter yang mewakili Papua dengan filosofi \"Warisan Budaya\". Dengan tinggi 177 cm dan berat 78 kg, KABI membawa artefak Kode Biner dan menguasai kekuatan Digital. Berasal dari Jayapura, Papua, KABI memiliki DNA Astronesia dan mewakili karakter Papua yang ramah, santun, sabar, ulet, pintar, serta mengutamakan persatuan dan adab.', 'draft', 6, '2025-12-11 18:58:21', '2025-12-11 18:58:21', NULL),
(7, 'ARUN', 'arun', 'Arun', 'Kalimantan', 'Warisan Budaya', '177 cm', '78 kg', 'Kode Biner', 'Digital', 'Kalimantan', 'Kalimantan', 'Multi Culture (China)', 'Mewakili Karakter Betawi', 'Ramah, Santun, Sabar, Ulet, Pintar, Mengutamakan Persatuan dan Adab', '[\"#FFFFFF\",\"#000000\",\"#FF0000\"]', '[\"Putih\",\"Hitam\",\"Merah\"]', 'characters/chara-07.png', 'characters/thumbnails/thumb-chara-07.png', 'characters/videos/patrion-arun.mp4', 'ARUN adalah karakter yang mewakili Kalimantan dengan filosofi \"Warisan Budaya\". Dengan tinggi 177 cm dan berat 78 kg, ARUN membawa artefak Kode Biner dan menguasai kekuatan Digital. Berasal dari Kalimantan, ARUN memiliki DNA Multi Culture (China) dan mewakili karakter Betawi yang ramah, santun, sabar, ulet, pintar, serta mengutamakan persatuan dan adab.', 'draft', 7, '2025-12-11 18:58:21', '2025-12-11 18:58:21', NULL),
(8, 'ANTIS', 'antis', 'Antis', 'Atlantis', 'Warisan Budaya', '177 cm', '78 kg', 'Kode Biner', 'Digital', 'Atlantis', 'Atlantis', 'Multi Culture (China)', 'Mewakili karakter Sumatera', 'Ramah, Santun, Sabar, Ulet, Pintar, Mengutamakan Persatuan dan Adab', '[\"#FFFFFF\",\"#000000\",\"#FF0000\"]', '[\"Putih\",\"Hitam\",\"Merah\"]', 'characters/chara-08.png', 'characters/thumbnails/thumb-chara-08.png', 'characters/videos/patrion-antis.mp4', 'ANTIS adalah karakter yang mewakili Atlantis dengan filosofi \"Warisan Budaya\". Dengan tinggi 177 cm dan berat 78 kg, ANTIS membawa artefak Kode Biner dan menguasai kekuatan Digital. Berasal dari Atlantis, ANTIS memiliki DNA Multi Culture (China) dan mewakili karakter Sumatera yang ramah, santun, sabar, ulet, pintar, serta mengutamakan persatuan dan adab.', 'draft', 8, '2025-12-11 18:58:21', '2025-12-11 18:58:21', NULL);

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
-- Struktur dari tabel `jobs`
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
-- Struktur dari tabel `job_batches`
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_11_161755_create_activity_log_table', 1),
(5, '2025_12_11_161756_add_event_column_to_activity_log_table', 1),
(6, '2025_12_11_161757_add_batch_uuid_column_to_activity_log_table', 1),
(7, '2025_12_11_161856_create_characters_table', 1),
(8, '2025_12_11_161909_create_programs_table', 1),
(9, '2025_12_11_164035_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `synopsis` text DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `trailer` varchar(255) DEFAULT NULL,
  `platform` enum('cinema','tv','streaming','youtube','game','ott','digital','podcast') NOT NULL DEFAULT 'streaming',
  `status` enum('draft','upcoming','ongoing','completed','production','released') NOT NULL DEFAULT 'draft',
  `release_date` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `director` varchar(255) DEFAULT NULL,
  `budget` varchar(255) DEFAULT NULL,
  `episodes` int(11) NOT NULL DEFAULT 1,
  `views` int(11) NOT NULL DEFAULT 0,
  `characters` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`characters`)),
  `platforms` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`platforms`)),
  `production` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`production`)),
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery`)),
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `programs`
--

INSERT INTO `programs` (`id`, `title`, `slug`, `description`, `synopsis`, `thumbnail`, `image`, `trailer`, `platform`, `status`, `release_date`, `duration`, `rating`, `director`, `budget`, `episodes`, `views`, `characters`, `platforms`, `production`, `gallery`, `order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Film Cinema - Drama Live Action', 'film-cinema-drama-live-action', 'Menceritakan background masing-masing patrion dari daerah mereka. Bagaimana mereka bisa menjadi patrion dengan masalah yang dihadapi mereka.', 'Film ini menceritakan asal-usul dan perjalanan masing-masing Patrion dari daerah mereka. Bagaimana mereka menghadapi berbagai masalah dan tantangan sebelum akhirnya menjadi Patrion sejati yang siap melindungi Nusantara.', 'programs/thumbnails/Thumbnail-Patrion-Movie.png', 'programs/Thumbnail-Patrion-Movie.png', 'programs/trailers/01_Live_action.mp4', 'cinema', 'upcoming', 'Q4 2024', '120 menit', 'PG-13', 'Abdurrahman GM', '$15M', 1, 0, '[\"kunna\",\"wabu\",\"asta\",\"taran\",\"sanu\",\"kabi\"]', '[{\"name\":\"CGV Cinemas\",\"type\":\"cinema\",\"icon\":\"fas fa-film\"},{\"name\":\"Cinema 21\",\"type\":\"cinema\",\"icon\":\"fas fa-film\"},{\"name\":\"Netflix\",\"type\":\"ott\",\"icon\":\"fas fa-tv\"}]', '{\"studio\":\"Nusantara Cinema Productions\",\"timeline\":\"24 months\",\"locations\":[\"Yogyakarta\",\"Bali\",\"Jakarta\",\"Bandung\"],\"vfx\":\"Industrial Light & Magic\",\"language\":\"Bahasa Indonesia\",\"format\":\"4K Digital\"}', '[{\"src\":\"programs\\/gallery\\/cinema-1.jpg\",\"type\":\"stills\",\"caption\":\"Kunna in traditional costume\"},{\"src\":\"programs\\/gallery\\/cinema-2.jpg\",\"type\":\"behind\",\"caption\":\"Behind the scenes - action sequence\"},{\"src\":\"programs\\/gallery\\/cinema-3.jpg\",\"type\":\"concept\",\"caption\":\"Concept art - Patrion gathering\"}]', 1, '2025-12-11 18:58:21', '2025-12-11 18:58:21', NULL),
(2, 'Film Cinema - Animation', 'film-cinema-animation', 'Patrion dengan aksinya dan masalah yang mereka hadapi. Menghadapi musuh dan bagaimana patrion menyelesaikan masalah, menyelamatkan bumi dari penjahat yang mau menghancurkan mereka.', 'Patrion dengan semua aksi dan masalah yang mereka hadapi. Mereka harus menghadapi musuh-musuh kuat yang berusaha menghancurkan Bumi. Teaser menampilkan awal kemunculan Patrion sampai mereka bersatu dan bersama menghadapi masalah utama menyelamatkan Bumi dari kehancuran total.', 'programs/thumbnails/Thumbnail-Animasi-2D.png', 'programs/Thumbnail-Animasi-2D.png', 'programs/trailers/02-animasi-2d.mp4', 'cinema', 'upcoming', 'Q4 2024', '120 menit', 'PG-13', 'Abdurrahman GM', '$15M', 1, 0, '[\"kunna\",\"wabu\",\"asta\",\"taran\",\"arun\",\"antis\"]', '[{\"name\":\"CGV Cinemas\",\"type\":\"cinema\",\"icon\":\"fas fa-film\"},{\"name\":\"Cinema 21\",\"type\":\"cinema\",\"icon\":\"fas fa-film\"},{\"name\":\"Disney+\",\"type\":\"ott\",\"icon\":\"fas fa-tv\"}]', '{\"studio\":\"Nusantara Animation Studio\",\"timeline\":\"30 months\",\"locations\":[\"Jakarta\",\"Bandung\"],\"vfx\":\"Local Animation Team\",\"animation_style\":\"2D Traditional\",\"frame_rate\":\"24 fps\"}', '[{\"src\":\"programs\\/gallery\\/animation-1.jpg\",\"type\":\"stills\",\"caption\":\"Character design - Kunna\"},{\"src\":\"programs\\/gallery\\/animation-2.jpg\",\"type\":\"stills\",\"caption\":\"Battle scene\"},{\"src\":\"programs\\/gallery\\/animation-3.jpg\",\"type\":\"concept\",\"caption\":\"Storyboard\"}]', 2, '2025-12-11 18:58:21', '2025-12-11 18:58:21', NULL),
(3, 'Animasi 3D', 'animasi-3d', 'Tayangan animasi anak yang menceritakan tentang para patrion dari wilayah masing-masing. Bagaimana mereka berpetualang untuk menyelesaikan persoalan yang terjadi di Nusantara.', 'Serial animasi 3D untuk anak-anak yang menceritakan petualangan para Patrion dari berbagai wilayah Nusantara. Setiap episode, mereka menghadapi dan menyelesaikan masalah yang terjadi di daerah masing-masing, sambil mengajarkan nilai-nilai budaya dan kearifan lokal.', 'programs/thumbnails/Thumbnail-Animasi-3D.png', 'programs/Thumbnail-Animasi-3D.png', 'programs/trailers/03-animasi-3d.mp4', 'ott', 'released', 'Q3 2024', '22 menit/episode', 'PG', 'Siti Nurhaliza', '$8M', 24, 2500000, '[\"kunna\",\"wabu\",\"asta\",\"taran\",\"sanu\",\"kabi\",\"arun\"]', '[{\"name\":\"Netflix\",\"type\":\"ott\",\"icon\":\"fas fa-tv\"},{\"name\":\"Vidio\",\"type\":\"ott\",\"icon\":\"fas fa-play-circle\"},{\"name\":\"YouTube Kids\",\"type\":\"digital\",\"icon\":\"fab fa-youtube\"}]', '{\"studio\":\"3D Nusantara Studio\",\"timeline\":\"18 months\",\"locations\":[\"Jakarta\",\"Surabaya\"],\"vfx\":\"Blender Studio\",\"animation_style\":\"3D CGI\",\"render_engine\":\"Cycles\"}', '[{\"src\":\"programs\\/gallery\\/3d-1.jpg\",\"type\":\"stills\",\"caption\":\"3D Character model\"},{\"src\":\"programs\\/gallery\\/3d-2.jpg\",\"type\":\"stills\",\"caption\":\"Environment design\"},{\"src\":\"programs\\/gallery\\/3d-3.jpg\",\"type\":\"behind\",\"caption\":\"Voice recording session\"}]', 3, '2025-12-11 18:58:21', '2025-12-11 18:58:21', NULL),
(4, 'Kunna Bercerita', 'kunna-bercerita', 'Event Patrion Goes to school Kunna Bercerita.', 'Program khusus di mana Kunna mengunjungi sekolah-sekolah untuk bercerita tentang budaya Jawa Tengah, nilai-nilai kehidupan, dan pentingnya melestarikan warisan budaya Nusantara. Program interaktif dengan partisipasi aktif dari siswa.', 'programs/thumbnails/Thumbnail-Kunna-Bercerita.png', 'programs/Thumbnail-Kunna-Bercerita.png', 'programs/trailers/04-kunna-bercerita.mp4', 'digital', 'released', 'Q2 2024', '10-15 menit', 'G', 'Budi Santoso', '$500K', 36, 1236000, '[\"kunna\"]', '[{\"name\":\"YouTube\",\"type\":\"digital\",\"icon\":\"fab fa-youtube\"},{\"name\":\"Instagram\",\"type\":\"digital\",\"icon\":\"fab fa-instagram\"},{\"name\":\"TikTok\",\"type\":\"digital\",\"icon\":\"fab fa-tiktok\"}]', '{\"studio\":\"Patrion Edu Studio\",\"timeline\":\"6 months\",\"locations\":[\"Jawa Tengah Schools\"],\"format\":\"Live Action + Animation\",\"target_audience\":\"Children 5-12 years\"}', '[{\"src\":\"programs\\/gallery\\/kunna-1.jpg\",\"type\":\"stills\",\"caption\":\"Kunna at school\"},{\"src\":\"programs\\/gallery\\/kunna-2.jpg\",\"type\":\"stills\",\"caption\":\"Interactive session with kids\"},{\"src\":\"programs\\/gallery\\/kunna-3.jpg\",\"type\":\"behind\",\"caption\":\"Preparation\"}]', 4, '2025-12-11 18:58:21', '2025-12-11 18:58:21', NULL),
(5, 'Travel Show', 'travel-show', 'Program yang fokus pada destinasi wisata, budaya, kuliner dan memberikan panduan serta tips perjalanan. Ada host bersama dengan salah satu Patrion yang memandu perjalanan.', 'Program travel show yang mengeksplorasi berbagai destinasi wisata di Nusantara. Setiap episode menampilkan satu Patrion sebagai pemandu yang memperkenalkan budaya, kuliner, dan keunikan daerah asalnya, memberikan tips perjalanan yang berguna bagi penonton.', 'programs/thumbnails/Thumbnail-Travel-Show.png', 'programs/Thumbnail-Travel-Show.png', 'programs/trailers/05-travel-show.mp4', 'tv', 'production', 'Q1 2025', '45 menit', 'PG', 'Ahmad Rizki', '$3M', 12, 0, '[\"kunna\",\"wabu\",\"asta\",\"taran\",\"sanu\",\"kabi\",\"arun\"]', '[{\"name\":\"Trans TV\",\"type\":\"tv\",\"icon\":\"fas fa-tv\"},{\"name\":\"NET TV\",\"type\":\"tv\",\"icon\":\"fas fa-tv\"},{\"name\":\"Vidio\",\"type\":\"ott\",\"icon\":\"fas fa-play-circle\"}]', '{\"studio\":\"Travel Nusantara Productions\",\"timeline\":\"12 months\",\"locations\":[\"Bali\",\"Yogyakarta\",\"Sumatera\",\"Sulawesi\",\"Papua\"],\"format\":\"4K HDR\",\"crew_size\":\"15 people\"}', '[{\"src\":\"programs\\/gallery\\/travel-1.jpg\",\"type\":\"stills\",\"caption\":\"Shooting in Bali\"},{\"src\":\"programs\\/gallery\\/travel-2.jpg\",\"type\":\"stills\",\"caption\":\"Local cuisine tasting\"},{\"src\":\"programs\\/gallery\\/travel-3.jpg\",\"type\":\"behind\",\"caption\":\"Camera setup\"}]', 5, '2025-12-11 18:58:21', '2025-12-11 18:58:21', NULL),
(6, 'Filler Value', 'filler-value', 'Membuat cerita tentang seseorang yang punya jiwa nusantara dan cara hidupnya memiliki jiwa nasionalisme. Humanis.', 'Serial pendek yang menampilkan cerita-cerita humanis tentang orang-orang biasa yang memiliki jiwa Nusantara dan nasionalisme dalam kehidupan sehari-hari mereka. Setiap episode mengangkat nilai-nilai kehidupan yang positif dan menginspirasi.', 'programs/thumbnails/Thumbnail-Filler.png', 'programs/Thumbnail-Filler.png', 'programs/trailers/06-filler-value.mp4', 'ott', 'released', 'Q3 2024', '5-8 menit', 'PG', 'Dewi Lestari', '$1.2M', 48, 680000, '[\"kunna\",\"wabu\"]', '[{\"name\":\"YouTube\",\"type\":\"digital\",\"icon\":\"fab fa-youtube\"},{\"name\":\"Instagram Reels\",\"type\":\"digital\",\"icon\":\"fab fa-instagram\"},{\"name\":\"Vidio\",\"type\":\"ott\",\"icon\":\"fas fa-play-circle\"}]', '{\"studio\":\"Human Story Studio\",\"timeline\":\"8 months\",\"locations\":[\"Various locations in Indonesia\"],\"format\":\"Vertical Video\",\"target_platform\":\"Social Media\"}', '[{\"src\":\"programs\\/gallery\\/filler-1.jpg\",\"type\":\"stills\",\"caption\":\"Human interest story\"},{\"src\":\"programs\\/gallery\\/filler-2.jpg\",\"type\":\"stills\",\"caption\":\"Daily life moment\"},{\"src\":\"programs\\/gallery\\/filler-3.jpg\",\"type\":\"behind\",\"caption\":\"Interview session\"}]', 6, '2025-12-11 18:58:21', '2025-12-11 18:58:21', NULL),
(7, 'Motiongraphic 2D', 'motiongraphic-2d', 'Penjelasan/edukasi tentang nusantara. Video graphic real yang menceritakan tentang info nusantara dengan narasi. Dan disampaikan dengan gaya edukasi versi patrion. Yang cepat dan mudah dimengerti.', 'Seri video edukasi menggunakan motion graphic 2D yang menjelaskan berbagai aspek Nusantara - dari sejarah, budaya, geografi, hingga ilmu pengetahuan. Disampaikan dengan gaya yang menarik dan mudah dipahami, cocok untuk semua usia.', 'programs/thumbnails/Thumbnail-Motion-Graphics-2d.png', 'programs/Thumbnail-Motion-Graphics-2d.png', 'programs/trailers/07-motiongraphic-2d.mp4', 'digital', 'released', 'Q2 2024', '3-5 menit', 'G', 'Citra Kirana', '$300K', 24, 575000, '[\"kunna\",\"wabu\",\"asta\"]', '[{\"name\":\"YouTube\",\"type\":\"digital\",\"icon\":\"fab fa-youtube\"},{\"name\":\"Instagram\",\"type\":\"digital\",\"icon\":\"fab fa-instagram\"},{\"name\":\"TikTok\",\"type\":\"digital\",\"icon\":\"fab fa-tiktok\"}]', '{\"studio\":\"EduMotion Studio\",\"timeline\":\"4 months\",\"locations\":[\"Jakarta Studio\"],\"software\":\"Adobe After Effects\",\"animation_style\":\"2D Motion Graphics\"}', '[{\"src\":\"programs\\/gallery\\/motion-1.jpg\",\"type\":\"stills\",\"caption\":\"Animation frame\"},{\"src\":\"programs\\/gallery\\/motion-2.jpg\",\"type\":\"stills\",\"caption\":\"Infographic design\"},{\"src\":\"programs\\/gallery\\/motion-3.jpg\",\"type\":\"behind\",\"caption\":\"Design process\"}]', 7, '2025-12-11 18:58:21', '2025-12-11 18:58:21', NULL),
(8, 'Podcast Patronia', 'podcast-patronia', 'Penjelasan/edukasi tentang nusantara. Video graphic real yang menceritakan tentang info nusantara dengan narasi. Dan disampaikan dengan gaya edukasi versi patrion. Yang cepat dan mudah dimengerti.', 'Podcast yang membahas berbagai topik tentang Nusantara dengan mendalam. Menghadirkan narasumber dari berbagai bidang, dibawakan dengan gaya santai namun informatif. Tersedia dalam format audio dan video.', 'programs/thumbnails/Thumbnail-Podcast-Patrionia.png', 'programs/Thumbnail-Podcast-Patrionia.png', 'programs/trailers/08-patrionia-podcast.mp4', 'digital', 'released', 'Q1 2024', '60-90 menit', 'PG-13', 'Rizky Febian', '$200K', 52, 315000, '[\"kunna\",\"wabu\"]', '[{\"name\":\"Spotify\",\"type\":\"podcast\",\"icon\":\"fab fa-spotify\"},{\"name\":\"Apple Podcasts\",\"type\":\"podcast\",\"icon\":\"fas fa-podcast\"},{\"name\":\"YouTube\",\"type\":\"digital\",\"icon\":\"fab fa-youtube\"}]', '{\"studio\":\"Podcast Nusantara Studio\",\"timeline\":\"Ongoing\",\"locations\":[\"Jakarta Studio\"],\"equipment\":\"Professional audio setup\",\"recording_schedule\":\"Weekly\"}', '[{\"src\":\"programs\\/gallery\\/podcast-1.jpg\",\"type\":\"stills\",\"caption\":\"Recording session\"},{\"src\":\"programs\\/gallery\\/podcast-2.jpg\",\"type\":\"stills\",\"caption\":\"Guest interview\"},{\"src\":\"programs\\/gallery\\/podcast-3.jpg\",\"type\":\"behind\",\"caption\":\"Audio editing\"}]', 8, '2025-12-11 18:58:21', '2025-12-11 18:58:21', NULL),
(9, 'Motion Comic', 'motion-comic', 'Komik Patrion yang menjelaskan perjalanan Patrion dengan superheronya. Format Concept komk yang dibuat versi video untuk market anak-anak dan dewasa. Level-level patrion ada di sini seiring petualangan tokoh Patrion.', 'Adaptasi komik Patrion ke dalam format motion comic. Menceritakan perjalanan Patrion dengan kekuatan super mereka. Setiap episode menampilkan level dan perkembangan karakter yang berbeda, cocok untuk pasar anak-anak dan dewasa.', 'programs/thumbnails/Thumbnail-Motion-Comics.png', 'programs/Thumbnail-Motion-Comics.png', 'programs/trailers/09-motion-comic.mp4', 'digital', 'production', 'Q4 2024', '15-20 menit', 'PG', 'Eko Sutrisno', '$750K', 18, 0, '[\"kunna\",\"wabu\",\"asta\",\"taran\",\"sanu\",\"kabi\",\"arun\",\"antis\"]', '[{\"name\":\"YouTube\",\"type\":\"digital\",\"icon\":\"fab fa-youtube\"},{\"name\":\"Vidio\",\"type\":\"ott\",\"icon\":\"fas fa-play-circle\"},{\"name\":\"LINE Webtoon\",\"type\":\"comic\",\"icon\":\"fas fa-book\"}]', '{\"studio\":\"Comic Motion Studio\",\"timeline\":\"10 months\",\"locations\":[\"Bandung Studio\"],\"technique\":\"Pan & Scan Animation\",\"source_material\":\"Original Patrion Comics\"}', '[{\"src\":\"programs\\/gallery\\/comic-1.jpg\",\"type\":\"stills\",\"caption\":\"Comic panel\"},{\"src\":\"programs\\/gallery\\/comic-2.jpg\",\"type\":\"stills\",\"caption\":\"Motion effect\"},{\"src\":\"programs\\/gallery\\/comic-3.jpg\",\"type\":\"behind\",\"caption\":\"Voice acting\"}]', 9, '2025-12-11 18:58:21', '2025-12-11 18:58:21', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
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
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('nizZucNXCeXjOhECCexBMSpxJHqyztoORhYKbjWg', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYmNmNTlSRzhkdEVFNVpkWG9LeVFvVEhzM3dFdXUzREo4ZDQ5TGFWbyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1765480062);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `photo`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin Patrion', 'admin@example.com', '+6281234567890', 'users/admin.webp', 'active', '2025-12-11 18:58:21', '$2y$12$QjrWuULDaLpGEEz9ATCTTOw66Ecithj01caHPzOp8oHwXChvXG.4S', NULL, '2025-12-11 18:58:21', '2025-12-11 18:58:21', NULL),
(2, 'Editor Patrion', 'editor@example.com', '+6289876543210', NULL, 'active', '2025-12-11 18:58:21', '$2y$12$IsZTTEAx4eduduU0HUgppO/KmwFKcIWwzL9QSrBTYGSo6c6woE31W', NULL, '2025-12-11 18:58:21', '2025-12-11 18:58:21', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `characters_name_unique` (`name`),
  ADD UNIQUE KEY `characters_slug_unique` (`slug`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indeks untuk tabel `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `programs_slug_unique` (`slug`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `characters`
--
ALTER TABLE `characters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
