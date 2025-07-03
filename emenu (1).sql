-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 03, 2025 at 08:04 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emenu`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cashiers`
--

CREATE TABLE `cashiers` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pointused` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_id`, `category_name`, `category_details`, `status`, `created_at`, `updated_at`) VALUES
(1, 'cat001', 'Breakfast', '8am Onwards', 0, '2025-06-18 18:38:10', '2025-06-18 18:38:10'),
(2, 'cat002', 'Default Category', NULL, 0, '2025-06-18 19:54:44', '2025-06-18 19:54:44'),
(3, 'cat003', 'dasd', 'dad', 0, '2025-06-22 18:39:17', '2025-06-22 18:39:17');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_carts`
--

CREATE TABLE `food_carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kitchens`
--

CREATE TABLE `kitchens` (
  `id` bigint UNSIGNED NOT NULL,
  `food_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kitchen_status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kitchens`
--

INSERT INTO `kitchens` (`id`, `food_id`, `order_no`, `table_no`, `user_id`, `quantity`, `timer`, `kitchen_status`, `created_at`, `updated_at`, `order_type`) VALUES
(34, '1', 'circa028', '1', '3', '2', '1', 5, '2025-07-02 21:54:56', '2025-07-02 21:59:09', '1'),
(35, '2', 'circa028', '1', '3', '1', '1', 5, '2025-07-02 21:54:56', '2025-07-02 21:59:09', '1'),
(36, '4', 'circa025', '1', 'guest013', '2', '2', 5, '2025-07-02 21:55:47', '2025-07-02 21:59:07', '0'),
(37, '7', 'circa025', '1', 'guest013', '2', '2', 5, '2025-07-02 21:55:47', '2025-07-02 21:59:07', '0'),
(38, '1', 'circa029', '1', 'guest014', '1', '1', 3, '2025-07-02 21:59:34', '2025-07-02 22:00:41', '0'),
(39, '2', 'circa029', '1', 'guest014', '1', '1', 3, '2025-07-02 21:59:34', '2025-07-02 22:00:41', '0'),
(40, '4', 'circa037', '4', '3', '1', '2', 3, '2025-07-02 22:30:56', '2025-07-02 22:35:43', '0'),
(41, '7', 'circa037', '4', '3', '1', '2', 3, '2025-07-02 22:30:56', '2025-07-02 22:35:43', '0'),
(42, '2', 'circa036', '2', '3', '1', '2', 3, '2025-07-02 22:31:09', '2025-07-02 22:35:41', '0'),
(43, '4', 'circa036', '2', '3', '3', '2', 3, '2025-07-02 22:31:09', '2025-07-02 22:35:41', '0'),
(44, '7', 'circa036', '2', '3', '2', '2', 3, '2025-07-02 22:31:09', '2025-07-02 22:35:41', '0'),
(45, '1', 'circa035', '1', '3', '1', '5', 3, '2025-07-02 22:31:17', '2025-07-02 22:38:41', '0'),
(46, '2', 'circa035', '1', '3', '1', '5', 3, '2025-07-02 22:31:17', '2025-07-02 22:38:41', '0'),
(47, '2', 'circa034', '1', '3', '1', '6', 3, '2025-07-02 22:31:26', '2025-07-02 22:39:41', '0'),
(48, '4', 'circa034', '1', '3', '1', '6', 3, '2025-07-02 22:31:26', '2025-07-02 22:39:41', '0'),
(49, '1', 'circa034', '1', '3', '1', '6', 3, '2025-07-02 22:31:26', '2025-07-02 22:39:41', '0'),
(50, '1', 'circa033', '5', '3', '1', '5', 3, '2025-07-02 22:31:35', '2025-07-02 22:38:40', '0'),
(51, '2', 'circa033', '5', '3', '1', '5', 3, '2025-07-02 22:31:35', '2025-07-02 22:38:40', '0'),
(52, '4', 'circa032', '1', '3', '2', '5', 3, '2025-07-02 22:31:43', '2025-07-02 22:38:40', '0'),
(53, '7', 'circa032', '1', '3', '4', '5', 3, '2025-07-02 22:31:43', '2025-07-02 22:38:40', '0'),
(54, '7', 'circa031', '1', '3', '1', '4', 3, '2025-07-02 22:31:51', '2025-07-02 22:37:40', NULL),
(55, '2', 'circa031', '1', '3', '1', '4', 3, '2025-07-02 22:31:51', '2025-07-02 22:37:40', NULL),
(56, '4', 'circa030', '1', '3', '1', '3', 3, '2025-07-02 22:32:05', '2025-07-02 22:36:40', '0'),
(57, '7', 'circa030', '1', '3', '1', '3', 3, '2025-07-02 22:32:05', '2025-07-02 22:36:40', '0'),
(58, '2', 'circa027', '1', '3', '1', '2', 3, '2025-07-02 22:32:26', '2025-07-02 22:35:40', '1'),
(59, '4', 'circa027', '1', '3', '1', '2', 3, '2025-07-02 22:32:26', '2025-07-02 22:35:40', '1'),
(60, '2', 'circa026', '1', '3', '1', '1', 3, '2025-07-02 22:33:10', '2025-07-02 22:34:28', '0'),
(61, '4', 'circa026', '1', '3', '1', '1', 3, '2025-07-02 22:33:10', '2025-07-02 22:34:28', '0');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_08_054250_create_categories_table', 1),
(5, '2025_05_09_071344_create_user_preferences_table', 1),
(6, '2025_05_23_125511_create_products_table', 1),
(7, '2025_05_23_125634_create_warehouses_table', 1),
(8, '2025_05_23_125651_create_orders_table', 1),
(9, '2025_06_18_075911_create_cashiers_table', 1),
(10, '2025_06_19_055507_create_kitchens_table', 2),
(11, '2025_06_20_052650_create_customers_table', 2),
(12, '2025_06_22_083628_create_food_carts_table', 2),
(13, '2025_06_23_052423_create_orders_table', 3),
(14, '2025_06_25_022516_create_kitchens_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `food_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flavor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `customer_amount` double DEFAULT NULL,
  `payment_status` int NOT NULL DEFAULT '0',
  `kitchen_status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `table_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pointused` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `food_id`, `user_id`, `quantity`, `flavor`, `size`, `order_no`, `total_price`, `customer_amount`, `payment_status`, `kitchen_status`, `created_at`, `updated_at`, `table_no`, `payment_type`, `order_type`, `pointused`) VALUES
(34, '1', 'guest001', '2', 'Spicy', 'Small', 'circa001', 160, 213, 1, 1, '2025-06-23 21:27:12', '2025-06-23 23:14:18', '1', 'cash', NULL, NULL),
(35, '2', 'guest001', '2', 'Spicy', 'Small', 'circa001', 50, 213, 1, 1, '2025-06-23 21:27:12', '2025-06-23 23:14:18', '1', 'cash', NULL, NULL),
(36, '7', 'guest002', '2', 'Spicy', 'Small', 'circa002', 44, 0, 1, 1, '2025-06-23 21:27:27', '2025-06-23 22:03:39', '3', NULL, NULL, NULL),
(37, '6', 'guest002', '2', 'Spicy', 'Small', 'circa002', 42, 0, 1, 1, '2025-06-23 21:27:27', '2025-06-23 22:03:39', '3', NULL, NULL, NULL),
(38, '5', 'guest002', '2', 'Spicy', 'Small', 'circa002', 46, 0, 1, 1, '2025-06-23 21:27:27', '2025-06-23 22:03:39', '3', NULL, NULL, NULL),
(52, '4', NULL, '1', NULL, NULL, 'circa003', 23, 100, 1, 1, '2025-06-23 23:24:14', '2025-06-23 23:24:14', '1', 'cash', NULL, NULL),
(53, '5', NULL, '1', NULL, NULL, 'circa003', 23, 100, 1, 1, '2025-06-23 23:24:14', '2025-06-23 23:24:14', '1', 'cash', NULL, NULL),
(54, '1', 'guest003', '2', 'Spicy', 'Small', 'circa004', 160, 200, 1, 1, '2025-06-23 23:24:54', '2025-06-23 23:25:38', '6', 'cash', NULL, NULL),
(55, '2', 'guest003', '1', 'Spicy', 'Small', 'circa004', 25, 200, 1, 1, '2025-06-23 23:24:54', '2025-06-23 23:25:38', '6', 'cash', NULL, NULL),
(57, '1', 'guest004', '1', 'Spicy', 'Small', 'circa005', 80, 234, 1, 1, '2025-06-24 18:29:13', '2025-06-24 18:29:29', '1', 'cash', NULL, NULL),
(58, '2', 'guest004', '2', 'Spicy', 'Small', 'circa005', 50, 234, 1, 1, '2025-06-24 18:29:13', '2025-06-24 18:29:29', '1', 'cash', NULL, NULL),
(59, '1', 'guest005', '1', 'Spicy', 'Small', 'circa006', 80, 23231, 1, 1, '2025-06-24 19:51:23', '2025-06-24 19:52:25', '1', 'cash', NULL, NULL),
(60, '2', 'guest005', '1', 'Spicy', 'Small', 'circa006', 25, 23231, 1, 1, '2025-06-24 19:51:23', '2025-06-24 19:52:25', '1', 'cash', NULL, NULL),
(61, '4', 'guest006', '1', 'Spicy', 'Small', 'circa007', 23, 213, 1, 1, '2025-06-24 19:51:31', '2025-06-24 19:52:09', '1', 'cash', NULL, NULL),
(62, '5', 'guest006', '1', 'Spicy', 'Small', 'circa007', 23, 213, 1, 1, '2025-06-24 19:51:31', '2025-06-24 19:52:09', '1', 'cash', NULL, NULL),
(63, '2', 'guest006', '1', 'Spicy', 'Small', 'circa007', 25, 213, 1, 1, '2025-06-24 19:51:31', '2025-06-24 19:52:09', '1', 'cash', NULL, NULL),
(64, '7', 'guest007', '3', 'Spicy', 'Small', 'circa008', 66, 331, 1, 1, '2025-06-24 20:22:15', '2025-06-24 20:22:50', '4', 'cash', NULL, NULL),
(65, '6', 'guest007', '1', NULL, NULL, 'circa008', 21, 331, 1, 1, '2025-06-24 20:22:50', '2025-06-24 20:22:50', '4', 'cash', NULL, NULL),
(66, '7', 'guest008', '3', 'Spicy', 'Small', 'circa009', 66, 173, 1, 1, '2025-06-24 21:10:34', '2025-06-24 21:11:55', '1', 'cash', NULL, NULL),
(67, '4', 'guest008', '2', NULL, NULL, 'circa009', 46, 173, 1, 1, '2025-06-24 21:11:55', '2025-06-24 21:11:55', '1', 'cash', NULL, NULL),
(68, '1', 'guest008', '1', NULL, NULL, 'circa009', 80, 173, 1, 1, '2025-06-24 21:11:55', '2025-06-24 21:11:55', '1', 'cash', NULL, NULL),
(69, '4', NULL, '1', NULL, NULL, 'circa010', 23, 123, 1, 1, '2025-06-24 21:21:56', '2025-06-24 21:21:56', '2', 'cash', NULL, NULL),
(70, '5', NULL, '1', NULL, NULL, 'circa010', 23, 123, 1, 1, '2025-06-24 21:21:56', '2025-06-24 21:21:56', '2', 'cash', NULL, NULL),
(71, '2', NULL, '1', NULL, NULL, 'circa011', 25, 30, 1, 1, '2025-06-24 21:25:49', '2025-06-24 21:25:49', NULL, 'cash', NULL, NULL),
(72, '1', 'guest009', '1', 'Spicy', 'Small', 'circa012', 80, 234, 1, 1, '2025-06-24 21:26:31', '2025-06-24 21:26:46', '4', 'cash', NULL, NULL),
(73, '5', NULL, '1', NULL, NULL, 'circa013', 23, 233, 1, 1, '2025-06-24 21:27:10', '2025-06-24 21:27:10', NULL, 'cash', NULL, NULL),
(74, '1', NULL, '1', NULL, NULL, 'circa014', 80, 3213, 1, 1, '2025-06-24 21:29:11', '2025-06-24 21:29:11', NULL, 'cash', NULL, NULL),
(75, '2', NULL, '1', NULL, NULL, 'circa014', 25, 3213, 1, 1, '2025-06-24 21:29:11', '2025-06-24 21:29:11', NULL, 'cash', NULL, NULL),
(76, '4', NULL, '1', NULL, NULL, 'circa015', 23, 3123, 1, 1, '2025-06-24 21:31:24', '2025-06-24 21:31:24', NULL, 'cash', NULL, NULL),
(77, '2', NULL, '1', NULL, NULL, 'circa016', 25, 133, 1, 1, '2025-06-24 21:33:23', '2025-06-24 21:33:23', '44', 'cash', NULL, NULL),
(78, '1', 'guest010', '2', 'Spicy', 'Small', 'circa017', 160, 123123, 1, 1, '2025-06-24 21:34:27', '2025-06-24 21:34:41', '6', 'cash', NULL, NULL),
(79, '2', '3', '1', 'Spicy', 'Small', 'circa018', 25, 0, 0, 0, '2025-06-25 00:03:47', '2025-06-25 00:03:47', '1', NULL, NULL, NULL),
(80, '2', 'guest011', '1', 'Spicy', 'Small', 'circa019', 25, 234, 1, 1, '2025-06-25 18:12:08', '2025-06-25 18:12:28', '5', 'cash', NULL, NULL),
(81, '7', 'guest011', '2', 'Spicy', 'Small', 'circa019', 44, 234, 1, 1, '2025-06-25 18:12:08', '2025-06-25 18:12:28', '5', 'cash', NULL, NULL),
(82, '2', '3', '1', 'Spicy', 'Small', 'circa020', 25, 0, 0, 0, '2025-06-25 18:30:17', '2025-06-25 18:30:17', '1', NULL, NULL, NULL),
(83, '1', '3', '1', 'Spicy', 'Small', 'circa021', 80, 3213, 1, 1, '2025-06-25 19:29:16', '2025-06-25 20:09:41', '1', 'cash', '1', NULL),
(84, '2', '3', '1', 'Spicy', 'Small', 'circa021', 25, 3213, 1, 1, '2025-06-25 19:29:16', '2025-06-25 20:09:41', '1', 'cash', '1', NULL),
(85, '1', '3', '1', 'Spicy', 'Small', 'circa022', 80, 312, 1, 1, '2025-06-25 19:30:25', '2025-06-25 20:10:44', '2', 'cash', '0', NULL),
(86, '2', 'guest012', '1', 'Spicy', 'Small', 'circa023', 25, 233, 1, 1, '2025-06-25 23:34:47', '2025-06-25 23:35:23', '6', 'cash', '0', NULL),
(87, '5', 'guest012', '1', 'Spicy', 'Small', 'circa023', 23, 233, 1, 1, '2025-06-25 23:34:47', '2025-06-25 23:35:23', '6', 'cash', '0', NULL),
(88, '1', '3', '1', 'Spicy', 'Small', 'circa024', 80, 231, 1, 1, '2025-06-25 23:41:49', '2025-06-25 23:42:09', '5', 'cash', '1', NULL),
(89, '2', '3', '1', 'Spicy', 'Small', 'circa024', 25, 231, 1, 1, '2025-06-25 23:41:49', '2025-06-25 23:42:09', '5', 'cash', '1', NULL),
(90, '4', 'guest013', '2', 'Spicy', 'Small', 'circa025', 46, 1111, 1, 1, '2025-07-02 21:30:46', '2025-07-02 21:55:47', '1', 'cash', '0', NULL),
(91, '7', 'guest013', '2', 'Spicy', 'Small', 'circa025', 44, 1111, 1, 1, '2025-07-02 21:30:46', '2025-07-02 21:55:47', '1', 'cash', '0', NULL),
(92, '2', '3', '1', 'Spicy', 'Small', 'circa026', 25, 2133, 1, 1, '2025-07-02 21:31:28', '2025-07-02 22:33:10', '1', 'cash', '0', NULL),
(93, '4', '3', '1', 'Spicy', 'Small', 'circa026', 23, 2133, 1, 1, '2025-07-02 21:31:28', '2025-07-02 22:33:10', '1', 'cash', '0', NULL),
(94, '2', '3', '1', 'Spicy', 'Small', 'circa027', 25, 133123, 1, 1, '2025-07-02 21:46:15', '2025-07-02 22:32:26', '1', 'cash', '1', NULL),
(95, '4', '3', '1', 'Spicy', 'Small', 'circa027', 23, 133123, 1, 1, '2025-07-02 21:46:15', '2025-07-02 22:32:26', '1', 'cash', '1', NULL),
(96, '1', '3', '2', 'Spicy', 'Small', 'circa028', 160, 200, 1, 1, '2025-07-02 21:54:02', '2025-07-02 21:54:56', '1', 'cash', '1', NULL),
(97, '2', '3', '1', 'Spicy', 'Small', 'circa028', 25, 200, 1, 1, '2025-07-02 21:54:02', '2025-07-02 21:54:56', '1', 'cash', '1', NULL),
(98, '1', 'guest014', '1', 'Spicy', 'Small', 'circa029', 80, 1332, 1, 1, '2025-07-02 21:59:24', '2025-07-02 21:59:34', '1', 'cash', '0', NULL),
(99, '2', 'guest014', '1', 'Spicy', 'Small', 'circa029', 25, 1332, 1, 1, '2025-07-02 21:59:24', '2025-07-02 21:59:34', '1', 'cash', '0', NULL),
(100, '4', '3', '1', 'Spicy', 'Small', 'circa030', 23, 1231, 1, 1, '2025-07-02 22:08:03', '2025-07-02 22:32:05', '1', 'cash', '0', NULL),
(101, '7', '3', '1', 'Spicy', 'Small', 'circa030', 22, 1231, 1, 1, '2025-07-02 22:08:03', '2025-07-02 22:32:05', '1', 'cash', '0', NULL),
(102, '7', '3', '1', 'Spicy', 'Small', 'circa031', 22, 2133, 1, 1, '2025-07-02 22:08:27', '2025-07-02 22:31:51', '1', 'cash', NULL, NULL),
(103, '2', '3', '1', 'Spicy', 'Small', 'circa031', 25, 2133, 1, 1, '2025-07-02 22:08:27', '2025-07-02 22:31:51', '1', 'cash', NULL, NULL),
(104, '4', '3', '2', 'Spicy', 'Small', 'circa032', 45, 213, 1, 1, '2025-07-02 22:18:41', '2025-07-02 22:31:43', '1', 'cash', '0', NULL),
(105, '7', '3', '4', 'Spicy', 'Small', 'circa032', 87, 213, 1, 1, '2025-07-02 22:18:41', '2025-07-02 22:31:43', '1', 'cash', '0', NULL),
(106, '1', '3', '1', 'Spicy', 'Small', 'circa033', 79, 213, 1, 1, '2025-07-02 22:19:12', '2025-07-02 22:31:35', '5', 'cash', '0', NULL),
(107, '2', '3', '1', 'Spicy', 'Small', 'circa033', 24, 213, 1, 1, '2025-07-02 22:19:12', '2025-07-02 22:31:35', '5', 'cash', '0', NULL),
(108, '2', '3', '1', 'Spicy', 'Small', 'circa034', 25, 123, 1, 1, '2025-07-02 22:20:07', '2025-07-02 22:31:26', '1', 'cash', '0', NULL),
(109, '4', '3', '1', 'Spicy', 'Small', 'circa034', 23, 123, 1, 1, '2025-07-02 22:20:07', '2025-07-02 22:31:26', '1', 'cash', '0', NULL),
(110, '1', '3', '1', 'Spicy', 'Small', 'circa034', 80, 123, 1, 1, '2025-07-02 22:20:07', '2025-07-02 22:31:26', '1', 'cash', '0', NULL),
(111, '1', '3', '1', 'Spicy', 'Small', 'circa035', 80, 21331, 1, 1, '2025-07-02 22:20:24', '2025-07-02 22:31:17', '1', 'cash', '0', NULL),
(112, '2', '3', '1', 'Spicy', 'Small', 'circa035', 25, 21331, 1, 1, '2025-07-02 22:20:25', '2025-07-02 22:31:17', '1', 'cash', '0', NULL),
(113, '2', '3', '1', 'Spicy', 'Small', 'circa036', 25, 23133, 1, 1, '2025-07-02 22:26:38', '2025-07-02 22:31:09', '2', 'cash', '0', NULL),
(114, '4', '3', '3', 'Spicy', 'Small', 'circa036', 69, 23133, 1, 1, '2025-07-02 22:26:38', '2025-07-02 22:31:09', '2', 'cash', '0', NULL),
(115, '7', '3', '2', 'Spicy', 'Small', 'circa036', 44, 23133, 1, 1, '2025-07-02 22:26:38', '2025-07-02 22:31:09', '2', 'cash', '0', NULL),
(116, '4', '3', '1', 'Spicy', 'Small', 'circa037', 23, 2133, 1, 1, '2025-07-02 22:27:10', '2025-07-02 22:30:56', '4', 'cash', '0', NULL),
(117, '7', '3', '1', 'Spicy', 'Small', 'circa037', 22, 2133, 1, 1, '2025-07-02 22:27:10', '2025-07-02 22:30:56', '4', 'cash', '0', NULL),
(118, '1', '3', '1', 'Spicy', 'Small', 'circa038', 80, 0, 0, 0, '2025-07-02 22:43:10', '2025-07-02 22:43:10', '2', NULL, '1', '1'),
(119, '2', '3', '1', 'Spicy', 'Small', 'circa038', 25, 0, 0, 0, '2025-07-02 22:43:10', '2025-07-02 22:43:10', '2', NULL, '1', '1'),
(120, '1', '3', '1', 'Spicy', 'Small', 'circa039', 80, 0, 0, 0, '2025-07-02 22:49:38', '2025-07-02 22:49:38', '2', NULL, '0', '0'),
(121, '2', '3', '1', 'Spicy', 'Small', 'circa039', 25, 0, 0, 0, '2025-07-02 22:49:38', '2025-07-02 22:49:38', '2', NULL, '0', '0'),
(122, '4', '3', '1', 'Spicy', 'Small', 'circa039', 23, 0, 0, 0, '2025-07-02 22:49:38', '2025-07-02 22:49:38', '2', NULL, '0', '0'),
(123, '1', '3', '2', 'Spicy', 'Small', 'circa040', 160, 0, 0, 0, '2025-07-02 22:49:56', '2025-07-02 22:49:56', '2', NULL, '0', '2'),
(124, '2', '3', '2', 'Spicy', 'Small', 'circa040', 50, 0, 0, 0, '2025-07-02 22:49:56', '2025-07-02 22:49:56', '2', NULL, '0', '2'),
(125, '1', '3', '3', 'Spicy', 'Small', 'circa041', 240, 0, 0, 0, '2025-07-02 22:50:19', '2025-07-02 22:50:19', '5', NULL, '0', '1'),
(126, '2', '3', '3', 'Spicy', 'Small', 'circa041', 75, 0, 0, 0, '2025-07-02 22:50:19', '2025-07-02 22:50:19', '5', NULL, '0', '1'),
(127, '4', '3', '1', 'Spicy', 'Small', 'circa042', 23, 0, 0, 0, '2025-07-02 22:51:53', '2025-07-02 22:51:53', '2', NULL, '0', '0'),
(128, '7', '3', '1', 'Spicy', 'Small', 'circa042', 22, 0, 0, 0, '2025-07-02 22:51:53', '2025-07-02 22:51:53', '2', NULL, '0', '0'),
(129, '4', '3', '1', 'Spicy', 'Small', 'circa043', 23, 0, 0, 0, '2025-07-02 22:53:04', '2025-07-02 22:53:04', '3', NULL, '0', '0'),
(130, '7', '3', '1', 'Spicy', 'Small', 'circa043', 22, 0, 0, 0, '2025-07-02 22:53:04', '2025-07-02 22:53:04', '3', NULL, '0', '0'),
(131, '4', '3', '1', 'Spicy', 'Small', 'circa044', 23, 0, 0, 0, '2025-07-02 22:54:30', '2025-07-02 22:54:30', '2', NULL, '0', '0'),
(132, '4', '3', '1', 'Spicy', 'Small', 'circa045', 23, 0, 0, 0, '2025-07-02 22:54:39', '2025-07-02 22:54:39', NULL, NULL, NULL, '0.5'),
(133, '4', '3', '1', 'Spicy', 'Small', 'circa046', 23, 0, 0, 0, '2025-07-02 22:54:45', '2025-07-02 22:54:45', '2', NULL, '0', '0.5'),
(134, '1', 'guest015', '1', 'Spicy', 'Small', 'circa047', 80, 0, 0, 0, '2025-07-02 22:58:25', '2025-07-02 22:58:25', '5', NULL, '0', '0'),
(135, '2', 'guest015', '12', 'Spicy', 'Small', 'circa047', 300, 0, 0, 0, '2025-07-02 22:58:25', '2025-07-02 22:58:25', '5', NULL, '0', '0'),
(136, '2', '3', '1', 'Spicy', 'Small', 'circa048', 25, 0, 0, 0, '2025-07-02 23:07:57', '2025-07-02 23:07:57', '3', NULL, '0', '0'),
(137, '2', '3', '1', 'Spicy', 'Small', 'circa049', 25, 0, 0, 0, '2025-07-02 23:08:35', '2025-07-02 23:08:35', '2', NULL, NULL, '0'),
(138, '4', '3', '1', 'Spicy', 'Small', 'circa049', 23, 0, 0, 0, '2025-07-02 23:08:35', '2025-07-02 23:08:35', '2', NULL, NULL, '0'),
(139, '4', '3', '1', 'Spicy', 'Small', 'circa050', 23, 0, 0, 0, '2025-07-02 23:10:56', '2025-07-02 23:10:56', '3', NULL, NULL, '0'),
(140, '7', '3', '1', 'Spicy', 'Small', 'circa050', 22, 0, 0, 0, '2025-07-02 23:10:56', '2025-07-02 23:10:56', '3', NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `price` double DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `end_time`, `price`, `start_time`, `status`, `category`, `image`, `description`, `discount`, `created_at`, `updated_at`) VALUES
(1, 'Ro-m red onion Big', '10:38:00', 80, '08:00:00', 0, 'Breakfast', 'food_image/e47ffc58-16e9-4474-8c5b-e69de4289f20.png', 'There a egg and seasoning combined with super aroma', '5', '2025-06-18 18:41:07', '2025-06-18 18:41:07'),
(2, 'gogogog', '10:56:00', 25, '10:56:00', 0, 'Breakfast', 'food_image/dd8a3044-6a47-4764-9265-28780ee2a228.jpg', 'fr', '3', '2025-06-18 18:54:38', '2025-06-18 19:48:45'),
(4, 'add', NULL, 23, NULL, 0, 'Breakfast', 'food_image/0ac67b87-19ff-43c2-82ac-278f56360df0.jpg', 'dsad', 'undefined', '2025-06-18 19:08:18', '2025-07-02 23:21:04'),
(5, 'add', NULL, 23, NULL, 0, 'Breakfast', 'food_image/418ceeec-c490-416c-931a-2be6886b7d91.png', 'dsad', '2', '2025-06-18 19:08:26', '2025-06-18 19:08:26'),
(6, 'adsada', NULL, 21, NULL, 0, 'Default Category', 'food_image/a6244504-42ff-4a0e-a710-45961aae3c8e.png', 'ddasddsd', '2', '2025-06-18 22:20:23', '2025-06-18 22:20:23'),
(7, 'ice tea', NULL, 22, NULL, 0, 'Breakfast', 'food_image/7a5907ce-322b-407e-9224-4c7eb5d20f1e.png', '31213213adasd', '2', '2025-06-22 23:13:59', '2025-06-22 23:13:59'),
(8, 'Ro-m red onion Big', NULL, 1232, NULL, 0, 'Breakfast', 'food_image/de97b4df-3111-4d90-93ef-40278c849eb7.png', '12312', 'undefined', '2025-07-02 23:18:41', '2025-07-02 23:18:41');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('IepgnOItkci4pMadX2HfwvoduGBCY7stK6aJsAJy', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoicERId1pSdzdlNnZEeUFnYkRYN1g0Y3dOU1dCWGxWNzlVWW42eFV2MSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0L2luZGV4Ijt9czo3OiJpc0xvZ2luIjtpOjE7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1751529897),
('m5o19sAZpgfuHC4zjMTabld7jt42CZqMcLWcStH3', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicGdzN0c2RkdJeVBJVUVEbkNHZnNiUm1SeVVtTUNlRGVpYUdmZUN0diI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXNoaWVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDtzOjc6ImlzTG9naW4iO2k6MTt9', 1751523735),
('qZ6lpQ177vWR8jkohyaE0Q6f7nrCOIhP8q7vBmjx', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiS2dSQkFaWW9ETXRBUXlsSXRidXZGTUVrVWZJOWI2bkpaZG5iS0lhZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXNoaWVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDtzOjc6ImlzTG9naW4iO2k6MTt9', 1751529880);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `f_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `l_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civil_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_birth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int NOT NULL DEFAULT '0',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `points` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `m_name`, `l_name`, `civil_status`, `date_birth`, `location`, `image`, `gender`, `phone_no`, `role`, `username`, `password`, `remember_token`, `created_at`, `updated_at`, `points`) VALUES
(1, 'Admin', 'Admin', 'Admin', NULL, '2002-02-02', 'Manila', NULL, 'Female', '09687235269', 1, 'admin', '$2y$12$dGNulpEaxUF1hLCrTtZfrOyQBO2dUVE2k12dpdJJYzg8TOJ6AqyhG', 'SWwawkmfrURU7j2nsud5AzQ92wkcQNtUfWaOQod5DQrJKNODMW2HkP2dNUhg', '2025-06-18 18:37:34', '2025-06-18 18:37:34', 0),
(3, 'Lyzette', 'B.', 'Cagulada', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'user1', '$2y$12$SDuDG5F.lJvMk/c6VfFgb.Kjbw.LCWCaE4iUCCe7Ej.QhtGV6H3a.', NULL, NULL, '2025-07-02 23:10:56', 2),
(4, 'cashier', 'ww', 'ww', NULL, '0002-02-02', '8.324289,124.668467', 'uploads/1724c0c2-1fb6-4c11-b8da-57ff61a087eb.png', 'male', '09100894041', 2, 'cashier', '$2y$12$N7fJun9kyYxJs8UZEJq0h.qohLKu2RUWNjOzWHtzLqbWylEH4CiXG', NULL, '2025-06-22 23:17:42', '2025-06-22 23:17:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_preferences`
--

CREATE TABLE `user_preferences` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#ffffff',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_preferences`
--

INSERT INTO `user_preferences` (`id`, `user_id`, `logo`, `system_color`, `created_at`, `updated_at`) VALUES
(1, 1, 'logos/84d51262-1df6-4f97-93c7-c45e2a30bacb.jpg', '#8b0e0e', '2025-06-18 19:03:39', '2025-06-22 18:41:21');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint UNSIGNED NOT NULL,
  `warehouse_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `cashiers`
--
ALTER TABLE `cashiers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `food_carts`
--
ALTER TABLE `food_carts`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `kitchens`
--
ALTER TABLE `kitchens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `user_preferences`
--
ALTER TABLE `user_preferences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_preferences_user_id_unique` (`user_id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cashiers`
--
ALTER TABLE `cashiers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_carts`
--
ALTER TABLE `food_carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kitchens`
--
ALTER TABLE `kitchens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_preferences`
--
ALTER TABLE `user_preferences`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_preferences`
--
ALTER TABLE `user_preferences`
  ADD CONSTRAINT `user_preferences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
