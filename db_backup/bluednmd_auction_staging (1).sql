-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 02, 2023 at 05:23 AM
-- Server version: 5.7.23-23
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bluednmd_auction_staging`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,'0',
  `bid_processing_fee` float NOT NULL DEFAULT '0',
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `contact_number`, `address`, `shop_name`, `shop_logo`, `user_type`, `status`, `wallet_amount`, `admin_commission`, `vat_tax`, `exchnage_service_fee`, `about_shop`, `shipping_fee`, `exchange_shipping_fee`, `bid_processing_fee`, `created_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '1234567', '59107626', 'Room 310 Sun Kee Industrial building, Kwai Ting Road,Kwai Chung,N.T,Hong Kong', '', 'assets/uploads/user.png', 1, 0, 0, 10, 3, '30', '', 30, 30, 30, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `image`, `link`, `created_at`, `updated_at`) VALUES
(4, 'assets/uploads/7820113631668783010.jpg', 'https://bluediamondresearch.com/WEB01/auction/staging/shop?search=FIFA', '2022-06-25 00:00:00', '2022-06-25 08:35:50'),
(6, 'assets/uploads/1854683611668782808.jpg', 'https://bluediamondresearch.com/WEB01/auction/staging/shop?search=God+of+war', '2022-07-04 00:00:00', '2022-07-04 17:35:14'),
-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `title`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Sony', '/assets/uploads/sony.png', '2022-06-25 10:53:57', '2022-06-25 10:53:57'),
(2, 'Samsungs', '/assets/uploads/samsung.png', '2022-06-25 10:53:57', '2022-06-25 10:53:57'),
(6, 'EA sports', 'assets/uploads/12447833881667292743.png', '2022-11-01 00:00:00', '0000-00-00 00:00:00'),
(7, 'Activision', 'assets/uploads/6172735601667292714.png', '2022-11-01 00:00:00', '0000-00-00 00:00:00'),
(8, ' Naughty Dog ', 'assets/uploads/12874864951667293356.jfif', '2022-11-01 00:00:00', '0000-00-00 00:00:00'),
(9, '2K sports', 'assets/uploads/15504503741667303270.jpg', '2022-11-01 00:00:00', '0000-00-00 00:00:00'),
(10, 'GameMill', 'assets/uploads/16836958511667303476.jpg', '2022-11-01 00:00:00', '0000-00-00 00:00:00'),
(11, 'Bandai Namco Entertainment', 'assets/uploads/15001144991667304378.png', '2022-11-01 00:00:00', '0000-00-00 00:00:00'),
(12, 'Mojang Studios', 'assets/uploads/1924100391667304813.png', '2022-11-01 00:00:00', '0000-00-00 00:00:00'),
(13, 'Square Enix', 'assets/uploads/20849784381667305648.png', '2022-11-01 00:00:00', '0000-00-00 00:00:00'),
(14, 'astragon Entertainment', 'assets/uploads/8349431971667306505.jpg', '2022-11-01 00:00:00', '0000-00-00 00:00:00'),
(15, 'Capcom', 'assets/uploads/14906153581667307042.png', '2022-11-01 00:00:00', '0000-00-00 00:00:00'),
(16, 'Deep Silver', 'assets/uploads/10658878811667492429.png', '2022-11-04 00:00:00', '0000-00-00 00:00:00'),
(17, 'Sega', 'assets/uploads/20662735031667549073.png', '2022-11-04 00:00:00', '0000-00-00 00:00:00'),
(18, 'IllFonic', 'assets/uploads/16947048541668503994.jpeg', '2022-11-15 00:00:00', '0000-00-00 00:00:00'),
(19, 'Disney Interactive Studios', 'assets/uploads/21115571341668508248.jpeg', '2022-11-15 00:00:00', '0000-00-00 00:00:00'),
(20, 'Hazeligh Studios', 'assets/uploads/12940595221668694398.png', '2022-11-17 00:00:00', '0000-00-00 00:00:00'),
(21, 'Nintendo The Pokémon Company', 'assets/uploads/1114115841668860526.jpeg', '2022-11-19 00:00:00', '0000-00-00 00:00:00'),
(22, 'Nintendo', 'assets/uploads/6351844931668860971.png', '2022-11-19 00:00:00', '0000-00-00 00:00:00'),
(23, 'Naughty Dog', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `sorting` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `parent`, `sorting`, `created_at`) VALUES
(20, 'ROLE STRATEGY', 1, 0, '2022-06-22 06:29:07'),
(21, 'RPG', 1, 0, '2022-06-22 06:29:16'),
(22, 'ACTION', 2, 0, '2022-06-22 06:29:35'),
(23, 'ACTION', 3, 0, '2022-06-22 06:39:42'),
(24, 'SIMULATION', 3, 0, '2022-06-22 06:39:52'),
(25, 'SPORTS', 3, 0, '2022-06-22 06:47:18'),
(26, 'ADVENTURE', 3, 0, '2022-06-22 06:47:32'),
(27, 'SHOTS', 3, 0, '2022-06-22 06:48:55'),
(28, 'FIGHT', 3, 0, '2022-06-22 06:50:01'),
(29, 'FAMILY', 3, 0, '2022-06-22 06:55:36'),
(30, 'TERROR', 3, 0, '2022-06-22 06:58:29'),
(31, 'CAREERS', 3, 0, '2022-06-22 06:58:51'),
(32, 'ROLE STRATEGY', 3, 0, '2022-06-22 06:59:01'),
(33, 'RPG', 3, 0, '2022-06-22 06:59:17'),
(34, 'PS4', 0, 4, '2022-06-27 00:00:00'),
(35, 'SHOOTER', 34, 0, '2022-06-28 01:14:06'),
(36, 'PC', 0, 5, '2022-06-28 00:00:00'),
(37, 'Sports', 8, 0, '2022-07-10 04:09:19'),
(38, 'GAMEBOY', 0, 7, '2022-09-14 00:00:00'),
(39, 'Fighting', 38, 0, '2022-09-14 18:18:37'),
(40, 'PS3', 0, 6, '2022-09-14 00:00:00'),
(41, 'SPORTS', 40, 0, '2022-09-15 21:20:41'),
(44, 'SPORTS', 34, 0, '2022-11-01 13:10:48'),
(45, 'ACTION', 34, 0, '2022-11-01 17:12:31'),
(46, 'ADVENTURE', 34, 0, '2022-11-01 17:15:14'),
(47, 'RACING', 34, 0, '2022-11-01 17:15:31'),
(48, 'ROLE STRATEGY', 34, 0, '2022-11-01 17:16:02'),
(49, 'FAMILY', 34, 0, '2022-11-01 17:16:15'),
(50, 'FIGHT', 34, 0, '2022-11-01 17:16:30'),
(51, 'RPG', 34, 0, '2022-11-01 17:16:44'),
(52, 'SIMULATION', 34, 0, '2022-11-01 17:16:58'),
(53, 'TERROR', 34, 0, '2022-11-01 17:17:10'),
(54, 'ACTION', 40, 0, '2022-11-04 16:09:11'),
(55, 'ADVENTURE', 40, 0, '2022-11-04 16:10:00'),
(56, 'RACING', 40, 0, '2022-11-04 16:10:11'),
(57, 'FAMILY', 40, 0, '2022-11-04 16:10:24'),
(58, 'FIGHTING', 40, 0, '2022-11-04 16:10:35'),
(59, 'ROLE', 40, 0, '2022-11-04 16:10:44'),
(60, 'SHOOTER', 40, 0, '2022-11-04 16:10:56'),
(61, 'TERROR', 40, 0, '2022-11-04 16:11:10'),
(62, 'STRATEGY', 40, 0, '2022-11-04 16:11:21'),
(63, 'PLATFORM', 40, 0, '2022-11-04 16:13:59'),
(64, 'PUZZLE', 40, 0, '2022-11-04 16:14:12'),
(65, 'SIMULATION', 40, 0, '2022-11-04 16:14:24'),
(66, 'ROLE', 1, 0, '2022-11-04 16:32:52'),
(67, 'PLATFORM', 34, 0, '2022-11-15 18:30:04'),
(68, 'PLATFORM', 8, 0, '2022-11-19 20:07:56'),
(69, 'TERROR', 8, 0, '2022-11-19 20:08:15'),
(70, 'RPG', 8, 0, '2022-11-19 20:08:28'),
(71, 'FIGHT', 8, 0, '2022-11-19 20:08:46'),
(72, 'FAMILY', 8, 0, '2022-11-19 20:13:16'),
(73, 'ROLE STRATEGY', 8, 0, '2022-11-19 20:13:35'),
(74, 'RACING', 8, 0, '2022-11-19 20:13:46'),
(75, 'ADVENTURE', 8, 0, '2022-11-19 20:14:08'),
(76, 'ACTION', 8, 0, '2022-11-19 20:14:20'),
(77, 'SHOOTER', 8, 0, '2022-11-19 20:14:40'),
(78, 'SIMULATION', 8, 0, '2022-11-19 20:15:27'),
(96, 'PS5', 0, 0, '0000-00-00 00:00:00'),
(97, 'ACTION', 96, 0, '2023-01-28 18:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `checkout_quee`
--

CREATE TABLE `checkout_quee` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `added_time` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `checkout_quee`
--

INSERT INTO `checkout_quee` (`id`, `user_id`, `product_id`, `added_time`, `created_at`, `updated_at`) VALUES
(17, 1, 49, '2023-02-07 20:29:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `class_type`
--

CREATE TABLE `class_type` (
  `id` int(11) NOT NULL,
  `class_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bg_color` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `text_color` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `points` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `class_type`
--

INSERT INTO `class_type` (`id`, `class_name`, `class_color`, `bg_color`, `text_color`, `points`, `created_at`, `updated_at`) VALUES
(1, 'A', 'badge-warning', '#a67736', '#ffffff', 6, '0000-00-00 00:00:00', '2022-11-18 00:00:00'),
(2, 'B', 'badge-danger', '#dbc114', '#ffffff', 5, '0000-00-00 00:00:00', '2022-11-08 00:00:00'),
(3, 'C', 'badge-success', '#31c91d', '#fafafa', 4, '0000-00-00 00:00:00', '2022-11-18 00:00:00'),
(5, 'E', 'badge-info', '#4ab09f', '#ffffff', 2, '0000-00-00 00:00:00', '2022-11-18 00:00:00'),
(9, 'D', 'badge-info', '#cc2e2e', '#f7f7f7', 3, '0000-00-00 00:00:00', '2022-10-31 00:00:00'),
(10, 'F', NULL, '#4e64a6', '#f7f7f7', 1, '2022-10-04 14:18:36', '2022-11-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(15) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `_sign` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `title`, `_sign`, `created_at`) VALUES
(2, 'USD', '$', '2022-04-06 07:59:16'),
(28, 'HKD', '', '2022-09-01 00:00:00'),
(29, 'CNY', '¥', '2023-01-02 12:44:21');

-- --------------------------------------------------------

--
-- Table structure for table `currency_conversion_rate`
--

CREATE TABLE `currency_conversion_rate` (
  `id` int(11) NOT NULL,
  `currency_from` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `currency_to` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rate` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `currency_conversion_rate`
--

INSERT INTO `currency_conversion_rate` (`id`, `currency_from`, `currency_to`, `rate`, `updated_at`) VALUES
(1, 'USD', 'HKD', '7.84858', '2022-09-12 15:15:58'),
(2, 'HKD', 'USD', '0.12741154', '2022-09-12 15:15:58'),
(3, 'CNY', 'HKD', '1.13', '2023-01-02 18:25:11'),
(4, 'HKD', 'CNY', '0.88', '2023-01-02 18:25:24');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_list`
--

CREATE TABLE `exchange_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `exchange_list`
--

INSERT INTO `exchange_list` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(12, 1, 13, '2022-10-17 00:00:00', '0000-00-00 00:00:00'),
(13, 1, 41, '2022-10-17 00:00:00', '0000-00-00 00:00:00'),
(19, 1, 39, '2022-10-18 00:00:00', '0000-00-00 00:00:00'),
(40, 1, 28, '2022-10-27 00:00:00', '0000-00-00 00:00:00'),
(104, 1, 16, '2022-10-27 00:00:00', '0000-00-00 00:00:00'),
(113, 3, 16, '2022-11-04 00:00:00', '0000-00-00 00:00:00'),
(120, 2, 15, '2022-11-11 00:00:00', '0000-00-00 00:00:00'),
(148, 3, 66, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 3, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 3, 52, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 3, 74, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 1, 17, '2023-01-02 00:00:00', '0000-00-00 00:00:00'),
(164, 3, 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(175, 1, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 1, 74, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 3, 50, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 2, 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 3, 36, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 3, 12, '2023-01-26 00:00:00', '0000-00-00 00:00:00'),
(186, 3, 76, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(187, 2, 46, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 3, 36, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 3, 45, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 1, 37, '2023-02-02 00:00:00', '0000-00-00 00:00:00'),
(191, 1, 47, '2023-02-02 00:00:00', '0000-00-00 00:00:00'),
(192, 5, 49, '2023-02-03 00:00:00', '0000-00-00 00:00:00'),
(193, 3, 2, '2023-02-20 00:00:00', '0000-00-00 00:00:00'),
(194, 3, 49, '2023-02-23 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_order`
--

CREATE TABLE `exchange_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `exchnage_product_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `service_fee` double NOT NULL,
  `shipping_fee` double NOT NULL DEFAULT '0',
  `grand_total` double NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=pending | 1=approved | 2=rejected | 3 = completed',
  `reject_reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'admin will enter',
  `f_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `l_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `payment_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_uniqueid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `approval_date` datetime DEFAULT NULL,
  `completed_date` datetime DEFAULT NULL,
  `reject_date` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `exchange_order`
--

INSERT INTO `exchange_order` (`id`, `user_id`, `product_id`, `exchnage_product_id`, `price`, `service_fee`, `shipping_fee`, `grand_total`, `status`, `reject_reason`, `f_name`, `l_name`, `country`, `city`, `state`, `zipcode`, `address`, `address2`, `payment_id`, `order_uniqueid`, `payment_method`, `created_at`, `approval_date`, `completed_date`, `reject_date`, `updated_at`) VALUES
(1, 1, '74', '2', 0, 30, 40, 70, 3, '', 'Hakim', 'saifee', 'Ukraine', 'rtrt', 'rtt', 'rtrty', 'rtrtygry', 'scdsf', '6R941188PP738031C', 'YeRGwwfOWE6nF', 'paypal', '2023-01-16 16:06:08', '2023-01-16 16:07:50', '2023-01-16 16:09:57', NULL, '2023-01-16 16:06:08'),
(2, 3, '21', '55', 0, 30, 40, 70, 2, 'not valid', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '3EK711736M040711X', 'hMeukl23MoUYl', 'paypal', '2023-01-16 17:28:04', '2023-01-16 17:28:24', NULL, '2023-01-16 18:28:33', '2023-01-16 17:28:04'),
(3, 3, '49', '45', 0, 30, 40, 70, 2, 'stock have problem\r\n', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '7Y7123403V779444P', 'HuCvdpKbwGiiz', 'paypal', '2023-01-16 21:10:14', '2023-01-16 21:11:40', NULL, '2023-01-16 21:12:50', '2023-01-16 21:10:14'),
(4, 3, '21', '45', 0, 30, 40, 70, 3, '', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '5HY557691E0471339', 'JonjRZYi9OcfF', 'paypal', '2023-01-16 21:14:55', '2023-01-16 21:16:02', '2023-01-16 21:16:38', NULL, '2023-01-16 21:14:55'),
(5, 3, '46', '3', 0, 30, 40, 70, 2, 'dddddddddddddddd', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '43D39811UX022552U', 'VScHy8IBlGXgC', 'paypal', '2023-01-16 21:26:04', '2023-01-16 21:27:00', NULL, '2023-01-16 21:27:24', '2023-01-16 21:26:04'),
(6, 3, '46', '60', 0, 30, 40, 70, 2, 'ffd', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', NULL, 'fVjWTZ2wHwN5e', 'paypal', '2023-01-16 22:20:33', '2023-01-16 22:20:48', NULL, '2023-01-18 00:54:57', '2023-01-16 22:20:33'),
(7, 3, '50', '61', 0, 30, 40, 70, 3, '', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '36U22310C13413629', 'aDX7SjvFd3jn4', 'paypal', '2023-01-17 17:32:56', '2023-01-17 18:16:03', '2023-01-18 00:51:28', NULL, '2023-01-17 17:32:56'),
(8, 3, '25', '60', 220, 30, 40, 290, 2, 'vcv', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '1PB14922B15703105', '8ggEWb70a3E8u', 'paypal', '2023-01-18 15:52:37', '2023-01-18 15:57:01', NULL, '2023-01-18 15:59:52', '2023-01-18 15:52:37'),
(9, 3, '21', '60', 300, 30, 40, 370, 2, '11', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '8M925279VW4094715', 'cGUad1nt8DPYM', 'paypal', '2023-01-18 16:06:26', NULL, NULL, '2023-01-18 16:06:54', '2023-01-18 16:06:26'),
(10, 3, '21', '55', 150, 30, 40, 220, 2, 'secondreject\r\n', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '1BK19377HC975961W', 'nM7pdoYSBopqH', 'paypal', '2023-01-18 16:08:06', '2023-01-18 16:08:43', NULL, '2023-01-18 16:14:40', '2023-01-18 16:08:06'),
(11, 3, '45', '60', 0, 30, 40, 70, 3, '', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '5WH476316F4854119', 'PyjQm1sB5W8rl', 'paypal', '2023-01-18 16:16:10', '2023-01-18 16:22:07', '2023-01-18 16:23:39', NULL, '2023-01-18 16:16:10'),
(12, 2, '47', '50', 0, 30, 40, 70, 3, '', 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', '0K065321XG7151732', 'tkFEE47STud7G', 'paypal', '2023-01-18 16:27:39', '2023-01-18 16:28:46', '2023-01-18 16:29:16', NULL, '2023-01-18 16:27:39'),
(13, 3, '3', '62', 80, 30, 40, 150, 2, 'testing\r\n', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '7PM99005S7860315J', 'gqZUxjwwLZKRD', 'paypal', '2023-01-18 17:16:23', '2023-01-18 17:17:02', NULL, '2023-01-18 17:18:48', '2023-01-18 17:16:23'),
(14, 1, '50', '17', 0, 30, 40, 70, 2, 'not valid', 'Hakim', 'saifee', 'Ukraine', 'rtrt', 'rtt', 'rtrty', 'rtrtygry', 'scdsf', '2MN65425TS1197639', 'KDh6X4hXFrNrh', 'paypal', '2023-01-19 14:40:57', NULL, NULL, '2023-01-27 17:36:05', '2023-01-19 14:40:57'),
(15, 3, '21', '62', 300, 30, 40, 370, 3, '', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '7563022934132080D', 'dDM4swwpGk4yB', 'paypal', '2023-01-19 15:09:22', '2023-01-22 00:51:44', '2023-01-22 00:52:00', NULL, '2023-01-19 15:09:22'),
(16, 3, '17', '55', 0, 30, 40, 70, 2, 'o', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '71P36927AX242060B', 'N14bG9B2JQIKj', 'paypal', '2023-01-19 15:11:07', '2023-01-21 22:37:06', NULL, '2023-01-21 22:37:48', '2023-01-19 15:11:07'),
(17, 3, '3', '67', 0, 30, 40, 70, 2, 'fdf', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '6M673852VY216502D', 'dW9kFB06xAtbd', 'paypal', '2023-01-20 00:58:02', '2023-01-20 00:59:12', NULL, '2023-01-20 00:59:52', '2023-01-20 00:58:02'),
(18, 3, '36', '49', 220, 30, 40, 290, 3, '', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '12U24728SL1481153', 'c1UHSznsIU4IM', 'paypal', '2023-01-20 01:08:50', '2023-01-20 01:09:19', '2023-01-20 01:09:57', NULL, '2023-01-20 01:08:50'),
(19, 3, '53', '67', 0, 30, 40, 70, 2, 'gg', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '4VP05888DP832520D', 'fTMEa9qbvDX4t', 'paypal', '2023-01-20 16:29:09', '2023-01-20 16:30:20', NULL, '2023-01-20 16:31:06', '2023-01-20 16:29:09'),
(20, 1, '63', '12', 0, 30, 40, 70, 2, 'This item is not valid', 'Hakim', 'saifee', 'Ukraine', 'rtrt', 'rtt', 'rtrty', 'rtrtygry', 'scdsf', '0JR62815F00330906', 'OGA7OQVWLY7Nf', 'paypal', '2023-01-23 13:48:01', '2023-01-23 13:48:31', NULL, '2023-01-23 13:59:50', '2023-01-23 13:48:01'),
(21, 3, '74', '55', 120, 30, 40, 190, 2, 'fdfd', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '9X365286G7680925K', 'SBsTn9dgJQDaF', 'paypal', '2023-01-25 02:57:02', '2023-01-25 02:57:18', NULL, '2023-01-25 02:57:32', '2023-01-25 02:57:02'),
(22, 3, '20', '3', 220, 30, 40, 290, 2, 'ddddd', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '9LR886652H6500537', 'IIUXq66xqHs1Y', 'paypal', '2023-01-25 03:04:00', '2023-01-25 03:04:17', NULL, '2023-01-25 03:06:26', '2023-01-25 03:04:00'),
(23, 3, '20', '3', 220, 30, 40, 290, 3, '', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '7LC83697UN123681B', '6TgNg3G6cRMW6', 'paypal', '2023-01-26 00:37:55', '2023-01-26 00:38:45', '2023-01-26 00:40:08', NULL, '2023-01-26 00:37:55'),
(24, 3, '49', '46', 0, 30, 40, 70, 2, 'gg', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '4HT77483T5918601J', 'pMR2gMOkmp1IR', 'paypal', '2023-01-26 01:50:26', '2023-01-26 02:05:09', NULL, '2023-01-26 02:09:29', '2023-01-26 01:50:26'),
(25, 3, '52', '45', 0, 30, 40, 70, 2, 'ff', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '6DJ44735WH328113H', '07Jqw44S3PIxP', 'paypal', '2023-01-26 16:07:21', '2023-01-26 16:09:36', NULL, '2023-01-26 16:10:41', '2023-01-26 16:07:21'),
(26, 3, '49', '55', 0, 30, 40, 70, 2, 'nonononononon\r\n', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '3P093559GD0826749', 'nu34KQR6gfNDh', 'paypal', '2023-01-26 17:56:34', '2023-01-26 17:57:03', NULL, '2023-01-26 17:58:20', '2023-01-26 17:56:34'),
(27, 3, '12', '45', 300, 30, 40, 370, 3, '', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', NULL, 'E4EwIJRGfx7jD', 'paypal', '2023-01-26 18:00:35', '2023-01-26 18:01:05', '2023-01-26 18:01:32', NULL, '2023-01-26 18:00:35'),
(28, 3, '21', '12', 0, 30, 40, 70, 2, 'ff', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '6T183522RS6762014', 'cvW9UwZ5G6fPa', 'paypal', '2023-01-26 18:03:35', '2023-01-27 01:37:28', NULL, '2023-01-27 01:37:43', '2023-01-26 18:03:35'),
(29, 3, '17', '47,50,52', 0, 30, 40, 70, 2, 'ffffffffffffffffffffffffffffffff', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '8PK81806Y0271803T', 'sYvAVFm3GF3YL', 'paypal', '2023-01-27 01:33:14', '2023-01-27 01:34:42', NULL, '2023-01-27 01:35:50', '2023-01-27 01:33:14'),
(30, 3, '36', '66,67', 0, 30, 40, 70, 2, 'out of stock', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '01704413C83718543', 'RcI79BpCRa33L', 'paypal', '2023-01-27 16:00:40', '2023-01-27 16:02:22', NULL, '2023-01-27 16:03:24', '2023-01-27 16:00:40'),
(31, 3, '76', '55', 150, 30, 40, 220, 3, '', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '6LC675587E4062218', 'lEWqWevFDqEBW', 'paypal', '2023-01-27 16:06:06', '2023-01-27 16:07:17', '2023-01-27 16:08:38', NULL, '2023-01-27 16:06:06'),
(32, 3, '15', '46', 0, 30, 40, 70, 2, 'testing\r\n', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '9TG827661F143382J', 'jSjWIgyIk3ycL', 'paypal', '2023-01-27 16:09:45', '2023-01-27 16:12:56', NULL, '2023-01-27 16:13:55', '2023-01-27 16:09:45'),
(33, 1, '45', '12', 0, 30, 40, 70, 1, '', 'Hakim', 'saifee', 'Ukraine', 'rtrt', 'rtt', 'rtrty', 'rtrtygry', 'scdsf', '8KK184488T259791P', 'EqykVUnz5Bc49', 'paypal', '2023-01-27 17:33:38', '2023-01-27 17:34:50', NULL, NULL, '2023-01-27 17:33:38'),
(34, 2, '46', '20', 0, 30, 40, 70, 2, 'jj', 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', '01L40177UK174291C', '5yNNk5GG2Vgef', 'paypal', '2023-01-27 18:34:18', '2023-01-27 18:35:38', NULL, '2023-01-27 18:36:08', '2023-01-27 18:34:18'),
(35, 2, '46', '20', 0, 30, 40, 70, 3, '', 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', '1WS6631312188823P', 'PBrKEJpPZdUL9', 'paypal', '2023-01-27 18:37:43', '2023-01-27 18:38:34', '2023-01-27 18:39:28', NULL, '2023-01-27 18:37:43'),
(36, 3, '34', '67', 150, 30, 40, 220, 2, 'test2\r\n', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '7NG063871C530703S', 'lJ03URxuHukyJ', 'paypal', '2023-01-27 23:25:40', '2023-01-27 23:28:49', NULL, '2023-01-27 23:29:10', '2023-01-27 23:25:40'),
(37, 3, '36', '46', 0, 30, 40, 70, 3, '', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '15D938124W618003N', 'wCZHsHH4gtkp1', 'paypal', '2023-01-27 23:28:01', '2023-01-27 23:28:35', '2023-01-27 23:28:59', NULL, '2023-01-27 23:28:01'),
(38, 3, '37', '66', 120, 30, 40, 190, 2, 'gfg', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '0V292044C17234946', 'tZnUInZzHf5ar', 'paypal', '2023-01-27 23:32:16', NULL, NULL, '2023-01-28 00:01:06', '2023-01-27 23:32:16'),
(39, 3, '34', '67', 150, 30, 40, 220, 2, 'cdfdf', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '4FW07069BF0322948', 'BRUyVcDTCQX56', 'paypal', '2023-01-27 23:47:17', '2023-01-27 23:47:37', NULL, '2023-01-28 00:19:03', '2023-01-27 23:47:17'),
(40, 3, '37', '66', 120, 30, 40, 190, 2, 'fdf', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '21019284VT3725908', '0O3cx3eCZ60SM', 'paypal', '2023-01-28 00:03:46', NULL, NULL, '2023-01-30 18:12:14', '2023-01-28 00:03:46'),
(41, 3, '45', '67', 0, 30, 40, 70, 3, '', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '76Y0309746881510M', 'Dnw9BIdpzuKJ8', 'paypal', '2023-01-28 01:41:11', '2023-01-28 01:42:17', '2023-01-28 01:43:58', NULL, '2023-01-28 01:41:11'),
(42, 3, '49', '45', 0, 30, 40, 70, 2, 'df', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '8MH27390WH508861T', 'Q349uQEeQWcSp', 'paypal', '2023-01-28 01:44:30', NULL, NULL, '2023-01-28 01:45:26', '2023-01-28 01:44:30'),
(43, 3, '46', '45', 300, 30, 40, 370, 1, '', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '9UG38909CG2433312', 'Dk6VHwGDledLk', 'paypal', '2023-01-28 01:46:06', '2023-01-28 01:46:25', NULL, NULL, '2023-01-28 01:46:06'),
(44, 3, '21', '25', 80, 30, 40, 150, 1, '', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '18J2046021567362C', 'keuhm8rwvbAP5', 'paypal', '2023-01-28 18:38:40', '2023-01-28 18:40:17', NULL, NULL, '2023-01-28 18:38:40'),
(45, 3, '45', '52', 0, 30, 40, 70, 2, 'fg', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '1UE81503G7711882H', '7qBOFe4haxgmD', 'paypal', '2023-01-28 19:05:15', NULL, NULL, '2023-01-28 19:06:04', '2023-01-28 19:05:15'),
(46, 1, '46', '47', 300, 30, 40, 370, 0, '', 'Hakim', 'saifee', 'Ukraine', 'rtrt', 'rtt', 'rtrty', 'rtrtygry', 'scdsf', '5T6052043X363825B', 'IPwWBNA3Bhn8k', 'paypal', '2023-02-02 14:38:45', NULL, NULL, NULL, '2023-02-02 14:38:45'),
(47, 2, '45', '47', 0, 30, 40, 70, 0, '', 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', '49232480TA443640B', '4fwTilW7WFT9g', 'paypal', '2023-02-02 16:02:22', NULL, NULL, NULL, '2023-02-02 16:02:22'),
(48, 2, '46', '15', 120, 30, 40, 190, 2, 'ff', 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', '3SN17505Y19706153', 'RWdTJGjiurzOl', 'paypal', '2023-02-02 16:16:28', NULL, NULL, '2023-02-02 16:18:07', '2023-02-02 16:16:28'),
(49, 2, '46', '15', 120, 30, 40, 190, 0, '', 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', '4EL715340K3385616', 'OvLt1bW9A6z12', 'paypal', '2023-02-02 16:23:54', NULL, NULL, NULL, '2023-02-02 16:23:54'),
(50, 3, '45', '66', 0, 30, 40, 70, 0, '', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '4BS618387S748235V', 'klR6SfYOV729P', 'paypal', '2023-02-03 00:55:26', NULL, NULL, NULL, '2023-02-03 00:55:26'),
(51, 3, '37', '12', 0, 30, 40, 70, 2, 'ff', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '05N99318TP928341V', 'iOrwldxqkg0IM', 'paypal', '2023-02-03 02:23:02', NULL, NULL, '2023-02-03 02:25:11', '2023-02-03 02:23:02'),
(52, 3, '37', '36', 80, 30, 40, 150, 2, 'out of stock\r\n', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '91W49928LU0208248', 'ThW1MLBLj9sZ9', 'paypal', '2023-02-03 02:28:19', NULL, NULL, '2023-02-03 02:29:21', '2023-02-03 02:28:19'),
(53, 3, '37', '12', 0, 30, 40, 70, 2, 'no stocks\r\n', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '7EB3141869421473K', 'FUnnjg8qEz4N6', 'paypal', '2023-02-03 02:31:26', NULL, NULL, '2023-02-03 02:32:05', '2023-02-03 02:31:26'),
(54, 2, '37', '46', 0, 30, 40, 70, 0, '', 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', '3YD10963UM1592745', 'FntrKYHSDBeYO', 'paypal', '2023-02-03 02:35:28', NULL, NULL, NULL, '2023-02-03 02:35:28'),
(55, 3, '37', '50', 300, 30, 40, 370, 2, 'ff', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '7GK94473P6570962H', 'bgEY73yAPbjXA', 'paypal', '2023-02-03 02:36:18', NULL, NULL, '2023-02-03 13:32:49', '2023-02-03 02:36:18'),
(56, 1, '37', '74', 80, 30, 40, 150, 2, 'fer', 'Hakim', 'saifee', 'Ukraine', 'rtrt', 'rtt', 'rtrty', 'rtrtygry', 'scdsf', '5FN70058PN7869028', 'zDthwNKUKjksv', 'paypal', '2023-02-03 13:44:37', NULL, NULL, '2023-02-03 20:58:23', '2023-02-03 13:44:37'),
(57, 3, '37', '50', 300, 30, 40, 370, 2, 'out of stock 22\r\n', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '6YM228296C126322G', 'irWrfliWke7lL', 'paypal', '2023-02-03 13:45:44', NULL, NULL, '2023-02-03 13:46:40', '2023-02-03 13:45:44'),
(58, 3, '37', '52,74', 0, 30, 40, 70, 1, '', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '59T75437TD1646004', 'TMwhgpYyzsEBx', 'paypal', '2023-02-03 19:31:39', '2023-02-03 19:32:14', NULL, NULL, '2023-02-03 19:31:39'),
(59, 1, '37', '74', 80, 30, 40, 150, 2, 'out', 'Hakim', 'saifee', 'Ukraine', 'rtrt', 'rtt', 'rtrty', 'rtrtygry', 'scdsf', '7DU8251053278050C', 'yry1DY2WoXsvL', 'paypal', '2023-02-03 21:03:33', NULL, NULL, '2023-02-11 02:13:46', '2023-02-03 21:03:33'),
(60, 3, '37', '36,50', 0, 30, 40, 70, 2, 'dd', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '7S183310M7281790V', 'seVeu5UJ85PJn', 'paypal', '2023-02-03 21:03:47', NULL, NULL, '2023-02-03 21:29:56', '2023-02-03 21:03:47'),
(61, 5, '37', '49', 300, 30, 40, 370, 2, 'hgh', 'yu hin', 'lee', 'hk', 'hk', 'kwai chung', '000', 'kwai ting road', '', '8GU53641KY207720H', 'tmXqaEnFhMbS4', 'paypal', '2023-02-03 21:35:11', NULL, NULL, '2023-02-03 21:46:04', '2023-02-03 21:35:11'),
(62, 3, '37', '12', 0, 30, 40, 70, 2, 'hgh', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '37A94148MD027394F', 'dtoOdRc70X8hy', 'paypal', '2023-02-03 21:35:47', NULL, NULL, '2023-02-03 21:45:57', '2023-02-03 21:35:47'),
(63, 3, '20', '50', 300, 30, 40, 370, 0, '', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '03E82181L13790454', 'b76k8V0eooosM', 'paypal', '2023-02-06 20:20:44', NULL, NULL, NULL, '2023-02-06 20:20:44'),
(64, 3, '17', '36', 0, 30, 40, 70, 0, '', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '50U00806WG381150T', 'WYD3LeNDXdnQA', 'paypal', '2023-02-06 21:03:09', NULL, NULL, NULL, '2023-02-06 21:03:09'),
(65, 5, '37', '49', 300, 30, 40, 370, 2, 'ccd', 'yu hin', 'lee', 'hk', 'hk', 'kwai chung', '000', 'kwai ting road', '', '17299812V2836001E', 'MLfJpzZRYjyEW', 'paypal', '2023-02-11 00:06:21', NULL, NULL, '2023-02-11 00:08:14', '2023-02-11 00:06:21'),
(66, 3, '37', '47', 300, 30, 40, 370, 2, 'fdf', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '6FC45696N3949474U', 'bR7otWuOGybvC', 'paypal', '2023-02-11 00:21:57', NULL, NULL, '2023-02-11 00:23:14', '2023-02-11 00:21:57'),
(67, 5, '37', '49', 300, 30, 40, 370, 2, 'out of stock\r\n', 'yu hin', 'lee', 'hk', 'hk', 'kwai chung', '000', 'kwai ting road', '', '5JU61635S8785560G', '7HoREzM6WXxKh', 'paypal', '2023-02-11 00:33:09', NULL, NULL, '2023-02-11 00:35:35', '2023-02-11 00:33:09'),
(68, 3, '74', '47', 220, 30, 30, 280, 0, '', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '6EU11163FH549315G', 'y9GUUxF6BKkNV', 'paypal', '2023-02-15 22:24:03', NULL, NULL, NULL, '2023-02-15 22:24:03'),
(69, 3, '47', '12', 0, 30, 30, 60, 1, '', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '6NU739132R8451303', 'qqXOIuoqlAXcv', 'paypal', '2023-02-23 01:15:06', '2023-02-23 01:16:24', NULL, NULL, '2023-02-23 01:15:06'),
(70, 3, '46', '49', 300, 30, 30, 360, 0, '', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '19112979DN955293X', 'AP6zDjTx1qzh8', 'paypal', '2023-02-23 01:22:30', NULL, NULL, NULL, '2023-02-23 01:22:30'),
(71, 3, '44', '76', 0, 30, 30, 60, 0, '', 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', '2BN09023HC992033G', 'cWvId2RigZSqy', 'paypal', '2023-03-01 01:55:48', NULL, NULL, NULL, '2023-03-01 01:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `ques` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ans` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `ques`, `ans`, `created_at`, `updated_at`) VALUES
(1, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', '2022-06-27 15:12:35', '2022-06-27 08:09:45'),
(3, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual ', '<div class=\"I6TXqe\">\r\n<div id=\"_Y4e5YpnJAsSPseMP_LaBmA834\" class=\"osrp-blk\">\r\n<div>\r\n<div class=\"Kot7x\">\r\n<div id=\"kp-wp-tab-cont-overview\" data-hveid=\"CEkQAw\" data-ved=\"2ahUKEwjZhtyQt834AhXER2wGHXxbAPMQydoBKAB6BAhJEAM\">\r\n<div class=\"aoPfOc\">\r\n<div id=\"kp-wp-tab-overview\" data-hveid=\"CEsQAA\" data-ved=\"2ahUKEwjZhtyQt834AhXER2wGHXxbAPMQkt4BKAB6BAhLEAA\">\r\n<div class=\"TzHB6b cLjAic LMRCfc\" data-hveid=\"CFcQAA\" data-ved=\"2ahUKEwjZhtyQt834AhXER2wGHXxbAPMQ04gCKAB6BAhXEAA\">\r\n<div>\r\n<div class=\"sATSHe\">\r\n<div>\r\n<div class=\"LuVEUc B03h3d P6OZi V14nKc i8qq8b ptcLIOszQJu__wholepage-card wp-ms\" data-hveid=\"CFQQAA\">\r\n<div class=\"UDZeY OTFaAf\">\r\n<div class=\"wDYxhc\" lang=\"en-IN\" data-md=\"50\" data-hveid=\"CE0QAA\" data-ved=\"2ahUKEwjZhtyQt834AhXER2wGHXxbAPMQkCl6BAhNEAA\">\r\n<div class=\"PZPZlf hb8SAc\" data-attrid=\"description\" data-hveid=\"CE0QAQ\" data-ved=\"2ahUKEwjZhtyQt834AhXER2wGHXxbAPMQziAoAHoECE0QAQ\">\r\n<div>\r\n<div class=\"kno-rdesc\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. <a class=\"ruhjFe NJLBac fl\" href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\" data-ved=\"2ahUKEwjZhtyQt834AhXER2wGHXxbAPMQmhN6BAhNEAI\">Wikipedia</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"l3cUSd\"> </div>\r\n</div>\r\n</div>\r\n<div class=\"rpBMYb kno-ftr\"> </div>', '2022-06-27 05:33:14', '2022-06-27 08:09:24'),
(5, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary</p>', '2022-06-27 08:14:29', '2022-06-27 08:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `footer_banner`
--

CREATE TABLE `footer_banner` (
  `id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banner_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '1=large | 2 = small',
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `footer_banner`
--

INSERT INTO `footer_banner` (`id`, `image`, `banner_type`, `link`, `created_at`, `updated_at`) VALUES
(1, 'assets/uploads/15853647691668876972.webp', '1', 'https://bluediamondresearch.com/WEB01/auction/shop', '2022-06-27 16:45:14', '2022-06-27 16:45:14'),
(2, 'assets/uploads/3924906311668876892.webp', '2', 'https://bluediamondresearch.com/WEB01/auction/shop', '2022-06-27 16:45:14', '2022-06-27 16:45:14');

-- --------------------------------------------------------

--
-- Table structure for table `grade_rates`
--

CREATE TABLE `grade_rates` (
  `id` int(11) NOT NULL,
  `grade_from` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grade_to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `grade_rates`
--

INSERT INTO `grade_rates` (`id`, `grade_from`, `grade_to`, `rate`, `created_at`, `updated_at`) VALUES
(10, '1', '2', '0', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(11, '2', '1', '50', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(12, '1', '3', '0', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(13, '3', '1', '100', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(14, '1', '4', '0', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(15, '4', '1', '150', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(16, '1', '5', '0', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(17, '5', '1', '200', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(18, '1', '6', '0', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(19, '6', '1', '250', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(20, '2', '3', '0', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(21, '3', '2', '50', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(22, '2', '4', '0', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(23, '4', '2', '100', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(24, '2', '5', '0', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(25, '5', '2', '150', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(26, '2', '6', '0', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(27, '6', '2', '200', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(28, '3', '4', '0', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(29, '4', '3', '50', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(30, '3', '5', '0', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(31, '5', '3', '100', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(32, '3', '6', '0', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(33, '6', '3', '150', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(34, '4', '5', '0', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(35, '5', '4', '50', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(36, '4', '6', '0', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(37, '6', '4', '100', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(38, '5', '6', '0', '2022-10-01 00:00:00', '0000-00-00 00:00:00'),
(39, '6', '5', '50', '2022-10-01 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`, `created_at`, `updated_at`) VALUES
(3, 'admin@admin.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'stanten7600@gmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'admin1@gmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'sstli@utlook.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'richy1022@outlook.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `f_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `l_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sell_product_id` int(11) NOT NULL,
  `grand_total` float NOT NULL,
  `admin_fee` float NOT NULL,
  `payment_fee` float NOT NULL DEFAULT '0',
  `trans_fee` float NOT NULL DEFAULT '0',
  `shipping_fee` double NOT NULL DEFAULT '0',
  `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_uniqueid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=progress , 1=complete, 2=canceled , 3=active, 4=expire',
  `expire_date` date NOT NULL,
  `expire_day` int(11) NOT NULL DEFAULT '0',
  `is_new` int(11) NOT NULL DEFAULT '0',
  `in_original_box` int(11) NOT NULL DEFAULT '0',
  `verified_authentic` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `seller_id`, `f_name`, `l_name`, `country`, `city`, `state`, `zipcode`, `address`, `address2`, `sell_product_id`, `grand_total`, `admin_fee`, `payment_fee`, `trans_fee`, `shipping_fee`, `payment_method`, `payment_id`, `order_uniqueid`, `status`, `expire_date`, `expire_day`, `is_new`, `in_original_box`, `verified_authentic`, `created_at`, `updated_at`) VALUES
(1, 1, 37, 4, 'Hakim', 'saifee', 'Ukraine', 'rtrt', 'rtt', 'rtrty', 'rtrtygry', 'scdsf', 1, 5102, 663.26, 0, 0, 0, 'paypal', '9XP0478737501634D', 'jK7LzeWG0YSjI', 1, '2022-09-26', 7, 1, 1, 1, '2022-09-19 16:31:52', '2022-09-19 16:31:52'),
(2, 3, 37, 1, 'dsd', 'dsd', 'ds', 'dsd', '555555', '555', 'dsd', 'dsd', 2, 1570, 204, 0, 0, 0, 'paypal', '7BU48213LB101720W', 'c6OBtcxo7k5nh', 1, '2022-09-20', 1, 1, 1, 1, '2022-09-19 17:37:24', '2022-09-19 17:37:24'),
(3, 2, 37, 3, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 3, 480, 62, 0, 0, 0, 'paypal', '0YL06736G03442804', 'QObk019SQa4hb', 1, '2022-09-20', 1, 1, 1, 1, '2022-09-19 22:12:32', '2022-09-19 22:12:32'),
(4, 2, 37, 3, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 4, 1000, 130, 0, 0, 0, 'paypal', '29W276584T063481A', 'U1LX6vN8K6QPF', 1, '2022-09-20', 1, 1, 1, 1, '2022-09-19 22:15:04', '2022-09-19 22:15:04'),
(5, 2, 37, 0, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 0, 180, 23, 0, 0, 0, 'paypal', '5BJ46711LD080404F', 'BJHHrKHauP47p', 4, '2022-09-20', 1, 1, 1, 1, '2022-09-19 22:18:42', '2022-09-19 22:18:42'),
(6, 3, 37, 2, 'dsd', 'dsd', 'ds', 'dsd', '555555', '555', 'dsd', 'dsd', 5, 463, 63, 0, 0, 0, 'paypal', '2R822728E0060882G', '1d2bRszYerK0G', 1, '2022-09-21', 1, 1, 1, 1, '2022-09-20 13:41:29', '2022-09-20 13:41:29'),
(9, 2, 33, 3, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 7, 416, 62.4, 0, 0, 0, 'paypal', '9GT67604G14558307', 'Q4QDS1jqGgEtw', 1, '2022-09-21', 1, 1, 1, 1, '2022-09-20 13:57:26', '2022-09-20 13:57:26'),
(10, 2, 33, 3, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 8, 424, 63.6, 0, 0, 0, 'paypal', '3FU626466E3810716', 'cllyO4QsPIUOQ', 1, '2022-09-21', 1, 1, 1, 1, '2022-09-20 14:01:55', '2022-09-20 14:01:55'),
(11, 3, 20, 2, 'dsd', 'dsd', 'ds', 'dsd', '555555', '555', 'dsd', 'dsd', 9, 330, -285, 0, 0, 0, 'paypal', '2D371673GP0103001', 'JY6yOZ4oCiuJQ', 1, '2022-09-21', 1, 1, 1, 1, '2022-09-20 14:03:57', '2022-09-20 14:03:57'),
(12, 4, 37, 1, 'Hakimuddin', 'Saifee', 'India', 'Indore', 'MP', '453331', '112, Baker stree Indore', 'scdsf', 10, 102, 15, 0, 0, 0, 'paypal', '5KK281527T903034H', 'CFlIAmFCefoql', 1, '2022-09-21', 1, 1, 1, 1, '2022-09-20 15:38:37', '2022-09-20 15:38:37'),
(13, 2, 37, 3, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 11, 200, 30, 0, 0, 0, 'paypal', '83F31008X32111609', 'c6zNkMCAIqEDD', 1, '2022-09-22', 1, 1, 1, 1, '2022-09-21 14:43:59', '2022-09-21 14:43:59'),
(14, 2, 37, 3, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 12, 518, 77.7, 0, 0, 0, 'paypal', '5BB64010A4953015Y', 'D3lpg3R7mRbgd', 1, '2022-09-22', 1, 1, 1, 1, '2022-09-21 14:54:35', '2022-09-21 14:54:35'),
(15, 3, 33, 2, 'dsd', 'dsd', 'ds', 'dsd', '555555', '555', 'dsd', 'dsd', 14, 589, 88, 0, 0, 0, 'paypal', '7U904220X2644035U', '62qzlDsxhBML9', 1, '2022-09-22', 1, 1, 1, 1, '2022-09-21 20:54:42', '2022-09-21 20:54:42'),
(16, 2, 37, 3, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 15, 392, 58.8, 0, 0, 0, 'paypal', '02N472789U592921M', 'TqpHaAjpxAh14', 1, '2022-09-22', 1, 1, 1, 1, '2022-09-21 20:58:31', '2022-09-21 20:58:31'),
(17, 2, 25, 3, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 16, 534, 80.1, 0, 0, 0, 'paypal', '2V275707LD288112E', 'lfa9HZ8V7ElBe', 1, '2022-09-22', 1, 1, 1, 1, '2022-09-21 21:41:25', '2022-09-21 21:41:25'),
(18, 2, 35, 0, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 0, 520, 77, 0, 0, 0, 'paypal', '8RT026741L8005425', 'cbJUyTPPpCs3T', 4, '2022-09-23', 1, 1, 0, 1, '2022-09-22 14:57:29', '2022-09-22 14:57:29'),
(19, 2, 12, 0, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 0, 488, 72, 0, 0, 0, 'paypal', '4YT20063A6947412V', 'qrPMwW942Vs33', 4, '2022-09-29', 7, 1, 1, 1, '2022-09-22 15:42:11', '2022-09-22 15:42:11'),
(22, 3, 45, 2, 'SST', 'LEE', 'HK', 'HK', 'kwai chung', '001', 'kwai ting road', 'HK', 18, 480, 72, 0, 0, 0, 'paypal', '4VM3501185314115B', 'Py7keIyaS2c7F', 1, '2022-11-02', 1, 1, 1, 1, '2022-11-01 13:52:14', '2022-11-01 13:52:14'),
(25, 3, 51, 0, 'SST', 'LEE', 'HK', 'HK', 'kwai chung', '001', 'kwai ting road', 'kwai ting road', 0, 180, 26, 0, 0, 0, 'paypal', '8E290408N8285891W', 'FjKahWhee8NPZ', 4, '2022-11-05', 1, 1, 1, 1, '2022-11-04 20:14:06', '2022-11-04 20:14:06'),
(26, 3, 2, 0, 'SST', 'LEE', 'HK', 'HK', 'kwai chung', '001', 'kwai ting road', 'kwai ting road', 0, 25, 3, 0, 0, 0, 'paypal', '25W46214P41292301', 'ebKNnKjnNZxLC', 4, '2022-11-05', 1, 1, 1, 1, '2022-11-04 21:41:59', '2022-11-04 21:41:59'),
(27, 3, 12, 0, 'SST', 'LEE', 'HK', 'HK', 'kwai chung', '001', 'kwai ting road', 'kwai ting road', 0, 20, 2, 0, 0, 0, 'paypal', '5KX058192H8132949', '3Q7Tnfcl5O9hm', 4, '2022-11-05', 1, 1, 1, 1, '2022-11-04 21:47:44', '2022-11-04 21:47:44'),
(28, 3, 55, 2, 'SST', 'LEE', 'HK', 'HK', 'kwai chung', '001', 'kwai ting road', '', 22, 250, 37, 0, 0, 0, 'paypal', '29L72772WP475114N', 'ftA7Tae8SWBwR', 1, '2022-11-11', 1, 1, 1, 1, '2022-11-10 17:32:55', '2022-11-10 17:32:55'),
(29, 3, 47, 0, 'SST', 'LEE', 'HK', 'HK', 'kwai chung', '001', 'kwai ting road', '', 0, 350, 52, 0, 0, 0, 'paypal', '96Y80621CD9107024', 'EFxCT8EeCMEKp', 4, '2022-11-12', 1, 1, 1, 1, '2022-11-11 18:36:33', '2022-11-11 18:36:33'),
(30, 3, 37, 2, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 23, 200, 30, 0, 0, 0, 'paypal', '2LU15555KR987851Y', '2wNjzR8vgHL1S', 1, '2022-11-11', 1, 1, 1, 1, '2022-11-10 18:32:18', '2022-11-10 18:32:18'),
(31, 1, 50, 0, 'Hakim', 'saifee', 'Ukraine', 'rtrt', 'rtt', 'rtrty', 'rtrtygry', 'scdsf', 0, 200, 30, 0, 0, 0, 'paypal', '5D197359456139211', 'QoUibzIGVHmlh', 4, '2022-11-15', 1, 1, 1, 1, '2022-11-14 15:46:15', '2022-11-14 15:46:15'),
(32, 3, 46, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 200, 60, 0, 0, 30, 'paypal', '8L976837K28787203', 'x3PG74OnFRwBT', 4, '2022-11-23', 7, 0, 1, 0, '2022-11-16 16:13:53', '2022-11-16 16:13:53'),
(33, 2, 20, 0, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 0, 200, 60, 0, 0, 30, 'paypal', '19M92160DC851020W', 'RvW6qUkVMg3uK', 4, '2022-11-17', 1, 1, 1, 1, '2022-11-16 16:46:48', '2022-11-16 16:46:48'),
(34, 3, 59, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 220, 62, 0, 0, 30, 'paypal', '30Y28899B4490533H', 'Qd6KAUd4eQKx5', 4, '2022-11-17', 1, 0, 0, 1, '2022-11-16 17:24:52', '2022-11-16 17:24:52'),
(35, 3, 55, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 305, 75, 0, 0, 30, 'paypal', '4TP52581PY288240X', '4fl0KHGDvbXKe', 4, '2022-12-18', 30, 1, 0, 0, '2022-11-18 23:08:32', '2022-11-18 23:08:32'),
(36, 2, 55, 0, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 0, 388, 87, 0, 0, 30, 'paypal', '3HY71322UW952563H', 'ZVesSX51J4IQJ', 4, '2022-11-19', 1, 0, 0, 0, '2022-11-18 23:13:17', '2022-11-18 23:13:17'),
(37, 1, 68, 0, 'Hakim', 'saifee', 'Ukraine', 'rtrt', 'rtt', 'rtrty', 'rtrtygry', 'scdsf', 0, 100, 45, 0, 0, 30, 'paypal', '7GN1081556506582L', 'y3OMD1KdKGysE', 4, '2023-01-04', 1, 1, 1, 1, '2023-01-03 19:18:43', '2023-01-03 19:18:43'),
(38, 3, 74, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 130, 49, 0, 0, 30, 'paypal', '8X660431C7110030M', 'ch7ah9Uw7r6Pk', 4, '2023-01-05', 1, 1, 1, 1, '2023-01-04 15:00:09', '2023-01-04 15:00:09'),
(42, 3, 36, 2, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 37, 120, 47, 0, 0, 30, 'paypal', '9TJ89556426076509', 'yley1RrCGthre', 1, '2023-01-06', 1, 1, 1, 1, '2023-01-05 18:54:43', '2023-01-05 19:00:27'),
(43, 3, 36, 2, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 38, 280, 72, 0, 0, 30, 'paypal', '95C9597869196233Y', 'zVubZmyaigWio', 1, '2023-01-06', 1, 1, 1, 1, '2023-01-05 19:08:44', '2023-01-05 19:08:44'),
(44, 3, 2, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 30, 34, 0, 0, 30, 'paypal', '5MF287937A953370G', 'VMEF1LaYZsdNy', 4, '2023-01-07', 1, 1, 1, 1, '2023-01-06 15:01:20', '2023-01-06 15:01:20'),
(45, 3, 20, 2, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 42, 180, 57, 0, 0, 30, 'paypal', '8PY72748H8881232R', 'PmsPf7aPlUCcy', 1, '2023-01-11', 1, 1, 1, 1, '2023-01-10 22:29:21', '2023-01-10 22:29:21'),
(46, 3, 12, 2, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 48, 222, 63.3, 0, 0, 30, 'paypal', '4NU84801R5507832Y', 'TqMOfPfw749ff', 1, '2023-01-12', 1, 1, 1, 1, '2023-01-11 15:56:18', '2023-01-11 15:56:18'),
(47, 2, 46, 3, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 50, 225, 63.75, 0, 0, 30, 'paypal', '46D27975K07066427', 'RrenROCTQzYhN', 1, '2023-01-12', 1, 1, 1, 1, '2023-01-11 16:56:47', '2023-01-11 16:56:47'),
(50, 3, 76, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 320, 77, 0, 0, 30, 'paypal', '9F72243737262440F', '8SRU2KgX5FCeR', 4, '2023-01-12', 1, 1, 1, 1, '2023-01-11 23:27:04', '2023-01-11 23:27:04'),
(54, 2, 46, 0, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 0, 300, 75, 0, 0, 30, 'paypal', '78X9710250896490H', 'SUlLzhBAiq1DM', 4, '2023-01-15', 1, 1, 1, 1, '2023-01-14 00:49:58', '2023-01-14 00:49:58'),
(55, 3, 74, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 520, 107, 0, 0, 30, 'paypal', '8UN582536T223171D', 'K76kDpUI9XMoB', 4, '2023-01-15', 1, 0, 0, 1, '2023-01-14 02:09:06', '2023-01-14 02:09:06'),
(58, 3, 21, 2, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 64, 99, 43, 0, 0, 30, 'paypal', '8FX71318RX495114R', '5g4jX8xO4Vscg', 1, '2023-01-17', 1, 1, 1, 1, '2023-01-16 21:31:03', '2023-01-16 21:39:10'),
(60, 1, 37, 0, 'Hakim', 'saifee', 'Ukraine', 'rtrt', 'rtt', 'rtrty', 'rtrtygry', 'scdsf', 0, 108, 45, 0, 0, 30, 'paypal', '64T11251X1789301B', 'BSAr6P09NQXsq', 4, '2023-01-17', 1, 1, 1, 1, '2023-01-16 22:17:32', '2023-01-16 22:17:32'),
(61, 3, 37, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 113, 46, 0, 0, 30, 'paypal', '2V128998YC5261708', 'JGLegYZM9UM4L', 4, '2023-01-18', 1, 1, 1, 1, '2023-01-17 16:06:41', '2023-01-17 16:06:41'),
(64, 3, 49, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 88, 42, 0, 0, 30, 'paypal', '7XR15353L9437272T', 'b1PD1o3cx1Pm8', 4, '2023-01-18', 1, 0, 1, 1, '2023-01-17 16:46:21', '2023-01-17 16:46:21'),
(67, 1, 12, 0, 'Hakim', 'saifee', 'Ukraine', 'rtrt', 'rtt', 'rtrty', 'rtrtygry', 'scdsf', 0, 100, 45, 0, 0, 30, 'paypal', '69F66134P2428430Y', 'Fr77rhTIay6we', 4, '2023-01-18', 1, 1, 1, 1, '2023-01-17 19:58:58', '2023-01-17 19:58:58'),
(68, 1, 46, 0, 'Hakim', 'saifee', 'Ukraine', 'rtrt', 'rtt', 'rtrty', 'rtrtygry', 'scdsf', 0, 100, 45, 0, 0, 30, 'paypal', '8N364397RB8600147', '0muHyiII7lCJU', 4, '2023-01-18', 1, 1, 1, 1, '2023-01-17 20:01:14', '2023-01-17 20:01:14'),
(70, 2, 73, 0, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 0, 188, 57, 0, 0, 30, 'paypal', '17730161PM8288357', 's3jRcMVsSpd9k', 4, '2023-01-19', 1, 0, 1, 0, '2023-01-18 15:45:21', '2023-01-18 15:45:21'),
(73, 1, 63, 0, 'Hakim', 'saifee', 'Ukraine', 'rtrt', 'rtt', 'rtrty', 'rtrtygry', 'scdsf', 0, 150, 52, 0, 0, 30, 'paypal', '3NS915118Y480004L', 'HrZfd6ozyXih3', 4, '2023-01-19', 1, 0, 0, 0, '2023-01-18 18:17:35', '2023-01-18 18:17:35'),
(74, 3, 63, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 166, 45, 0, 0, 30, 'paypal', '17272502L87450625', 'zh7DsC2PkvMfL', 4, '2023-01-19', 1, 1, 1, 1, '2023-01-18 19:30:25', '2023-01-18 19:30:25'),
(75, 5, 63, 0, 'yu hin', 'lee', 'hk', 'hk', 'kwai chung', '000', 'kwai ting road', '', 0, 218, 61, 0, 0, 30, 'paypal', '0J495531TC190852F', 'iIlwv0VhxHHAT', 4, '2023-01-19', 1, 1, 1, 1, '2023-01-18 19:49:38', '2023-01-18 19:49:38'),
(76, 3, 49, 1, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 79, 268, 69, 0, 0, 30, 'paypal', '70M61123AU829750S', 'tnTSpjuTU421G', 1, '2023-01-21', 1, 1, 1, 1, '2023-01-20 00:54:45', '2023-01-21 23:20:18'),
(77, 3, 15, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 77, 41, 0, 0, 30, 'paypal', '9EX909020J634622C', 'U4Nmp32rtKbXd', 4, '2023-01-21', 1, 0, 0, 0, '2023-01-20 00:57:16', '2023-01-20 00:57:16'),
(78, 2, 49, 0, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 0, 198, 58, 0, 0, 30, 'paypal', '0VR55129EG168863R', 'qrkFAu4ZPVmuq', 4, '2023-01-22', 1, 1, 1, 1, '2023-01-21 23:21:38', '2023-01-21 23:21:38'),
(79, 1, 12, 0, 'Hakim', 'saifee', 'Ukraine', 'rtrt', 'rtt', 'rtrty', 'rtrtygry', 'scdsf', 0, 169, 54, 0, 0, 30, 'paypal', '92E28351JX897101B', '3SL1mEQ3J6XwE', 4, '2023-01-22', 1, 1, 1, 1, '2023-01-21 23:33:02', '2023-01-21 23:33:02'),
(80, 3, 12, 2, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 80, 288, 73.2, 0, 0, 30, 'paypal', '996172161R451380T', 'V9JPjJk0eAJnl', 1, '2023-01-23', 1, 1, 0, 1, '2023-01-22 01:33:22', '2023-01-22 01:33:22'),
(81, 3, 12, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 123, 47, 0, 0, 30, 'paypal', '22C84418RM633862X', 'otW3EFDG5yQJH', 4, '2023-01-23', 1, 1, 1, 1, '2023-01-22 01:36:25', '2023-01-22 01:36:25'),
(82, 3, 47, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 55, 38, 0, 0, 30, 'paypal', '6CP63647T97956637', 'MBftpPL33FKJm', 4, '2023-01-23', 1, 1, 1, 1, '2023-01-22 02:05:14', '2023-01-22 02:05:14'),
(83, 4, 46, 0, 'Hakimuddin', 'Saifee', 'India', 'Indore', 'MP', '453331', '112, Baker stree Indore', 'scdsf', 0, 965, 165, 0, 0, 30, 'paypal', '4KW78839RE740981P', 'vl8IQoMDQbFZe', 4, '2023-01-24', 1, 1, 1, 1, '2023-01-23 13:38:21', '2023-01-23 13:38:21'),
(84, 1, 46, 0, 'Hakim', 'saifee', 'Ukraine', 'rtrt', 'rtt', 'rtrty', 'rtrtygry', 'scdsf', 0, 1000, 180, 0, 0, 30, 'paypal', '6TC97201LK812582J', 'jPJ54SiYH2eV0', 4, '2023-01-24', 1, 1, 0, 1, '2023-01-23 13:40:24', '2023-01-23 13:40:24'),
(85, 3, 15, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 88, 42, 0, 0, 30, 'paypal', '0', 'YeP9aEjiMha9K', 4, '2023-01-26', 1, 1, 1, 1, '2023-01-25 02:43:01', '2023-01-25 02:43:01'),
(87, 1, 45, 0, 'Hakim', 'saifee', 'Ukraine', 'rtrt', 'rtt', 'rtrty', 'rtrtygry', 'scdsf', 0, 98, 43, 0, 0, 30, 'paypal', '6LP68143MN0916638', 'qkxVtwg8DGsuh', 4, '2023-01-26', 1, 1, 1, 1, '2023-01-25 02:49:23', '2023-01-25 02:49:23'),
(88, 3, 45, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 168, 54, 0, 0, 30, 'paypal', '7DR33192C85174632', 'QGxVEWvR0QpCI', 4, '2023-01-26', 1, 1, 1, 1, '2023-01-25 02:55:09', '2023-01-25 02:55:09'),
(89, 1, 37, 0, 'Hakim', 'saifee', 'Ukraine', 'rtrt', 'rtt', 'rtrty', 'rtrtygry', 'scdsf', 0, 218, 61, 0, 0, 30, 'paypal', '4T1240539A828124D', 'Nw8uckjc30VRP', 4, '2023-01-27', 1, 1, 1, 1, '2023-01-26 01:02:07', '2023-01-26 01:02:07'),
(91, 3, 52, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 189, 57, 0, 0, 30, 'paypal', '8H955834CB247334H', 'aGV8Of3vKvInh', 4, '2023-01-28', 1, 1, 1, 1, '2023-01-27 16:28:08', '2023-01-27 16:28:08'),
(93, 2, 52, 0, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 0, 208, 60, 0, 0, 30, 'paypal', '5F698756M96948117', 'jzKnvhwuIzgUu', 4, '2023-01-27', 1, 1, 1, 1, '2023-01-26 17:53:44', '2023-01-26 17:53:44'),
(95, 2, 74, 0, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 0, 120, 47, 0, 0, 30, 'paypal', '01N72625N4794634G', '5JRnRSdhEGByM', 4, '2023-02-03', 7, 1, 1, 1, '2023-01-27 18:32:14', '2023-01-27 18:32:14'),
(97, 3, 50, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 88, 42, 0, 0, 30, 'paypal', '76213911A6009193J', 'KYQOBSlwoq2xD', 4, '2023-01-29', 1, 0, 0, 0, '2023-01-28 00:08:40', '2023-01-28 00:08:40'),
(98, 2, 49, 0, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 0, 168, 54, 0, 0, 30, 'paypal', '96J70325M0094841C', '4sOuKEOvIOrY3', 4, '2023-01-29', 1, 1, 1, 1, '2023-01-28 16:55:37', '2023-01-28 16:55:37'),
(100, 3, 49, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 178, 56, 0, 0, 30, 'paypal', '6YK25428L7945110J', 'TtoZV8dnn3IJn', 4, '2023-01-29', 1, 1, 1, 1, '2023-01-28 17:03:59', '2023-01-28 17:03:59'),
(101, 3, 49, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 88, 42, 0, 0, 30, 'paypal', '632695852R2121014', 's6jOM4leJH2Li', 4, '2023-02-04', 1, 1, 1, 1, '2023-02-03 19:28:42', '2023-02-03 19:28:42'),
(102, 2, 46, 0, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 0, 88, 42, 0, 0, 30, 'paypal', '77E906636X121201H', '4ox55IVvAaJRq', 4, '2023-02-07', 1, 0, 1, 1, '2023-02-06 19:41:35', '2023-02-06 19:41:35'),
(103, 3, 20, 2, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 127, 138, 50, 0, 0, 30, 'paypal', '9VY17284G6112083G', 'AUJGw9NViZRBt', 1, '2023-03-13', 30, 1, 1, 1, '2023-02-11 01:23:20', '2023-02-24 00:41:26'),
(104, 3, 21, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 888, 144, 0, 0, 30, 'paypal', '6CW70002X8267345G', 'ATnjgwTy72Df7', 3, '2023-03-20', 30, 1, 1, 1, '2023-02-18 03:41:21', '2023-02-18 03:41:21'),
(105, 3, 12, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 108, 43, 0, 0, 30, 'paypal', '5V634059FF591930D', 'lW07oc5Sf03ZG', 4, '2023-02-16', 1, 1, 1, 1, '2023-02-15 23:27:24', '2023-02-15 23:27:24'),
(106, 1, 46, 0, 'Hakim', 'saifee', 'Ukraine', 'rtrt', 'rtt', 'rtrty', 'rtrtygry', 'scdsf', 0, 104, 43, 3.12, 10.4, 30, 'paypal', '1C85299837495315H', 'WlNLXg1vLz4We', 4, '2023-02-21', 1, 1, 1, 1, '2023-02-20 13:56:36', '2023-02-20 13:56:36'),
(107, 3, 36, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 88, 40, 2.64, 8.8, 30, 'paypal', '7RG09632VX566920D', 'bkwAshIdRemx6', 4, '2023-02-21', 1, 1, 1, 1, '2023-02-20 14:53:55', '2023-02-20 14:53:55'),
(108, 3, 52, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 78, 39, 2.34, 7.8, 30, 'paypal', '5SA464049V8549121', 'SU9nkLYqew1CA', 4, '2023-02-21', 1, 1, 1, 1, '2023-02-20 15:13:00', '2023-02-20 15:13:00'),
(109, 3, 52, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 99, 39, 2.97, 9.9, 30, 'paypal', '9T69318431860652H', 'eiGBd1Ml9zjYv', 4, '2023-02-22', 1, 1, 1, 1, '2023-02-21 14:54:51', '2023-02-21 14:54:51'),
(110, 3, 81, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 38, 33, 1.14, 3.8, 30, 'paypal', '8GD40215K9687750H', 'M9mU5up9geTkU', 4, '2023-02-22', 1, 1, 1, 1, '2023-02-21 15:08:55', '2023-02-21 15:08:55'),
(111, 3, 49, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 133, 43, 3.99, 13.3, 30, 'paypal', '25A27630UT8721122', 'R5ga9Td7IwpFU', 4, '2023-02-22', 1, 1, 1, 1, '2023-02-21 22:29:43', '2023-02-21 22:29:43'),
(112, 3, 49, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 138, 50, 4.14, 20, 30, 'paypal', '4RM40841VF849842Y', 'Elh1j0EbvEFrF', 4, '2023-02-23', 1, 1, 1, 1, '2023-02-22 22:19:06', '2023-02-22 22:19:06'),
(113, 3, 15, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 56, 60, 1.68, 30, 30, 'paypal', '1E397418Y64913048', 'KNnTH9m7sI6F7', 4, '2023-02-24', 1, 1, 1, 1, '2023-02-23 01:08:58', '2023-02-23 01:08:58'),
(114, 1, 37, 0, 'Hakim', 'saifee', 'Ukraine', 'rtrt', 'rtt', 'rtrty', 'rtrtygry', 'scdsf', 0, 420, 60, 12.6, 30, 30, 'paypal', '6K4838970N069083D', 'ksOlagkZFC5RP', 4, '2023-02-24', 1, 1, 1, 1, '2023-02-23 20:53:25', '2023-02-23 20:53:25'),
(115, 3, 47, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 68, 60, 2.04, 30, 30, 'paypal', '7D624038EP570663D', 'xdEnqTqh3M3e5', 4, '2023-02-25', 1, 1, 1, 1, '2023-02-24 00:23:42', '2023-02-24 00:23:42'),
(116, 3, 86, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 56, 60, 1.68, 30, 30, 'paypal', '36R15444VW800332B', 'WmHGJzWZMNsQN', 4, '2023-02-25', 1, 1, 1, 1, '2023-02-24 00:36:52', '2023-02-24 00:36:52'),
(117, 2, 15, 0, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 0, 55, 60, 1.65, 30, 30, 'paypal', '672786027N020105M', 'TvG5ARkd2vmuQ', 4, '2023-02-25', 1, 1, 1, 1, '2023-02-24 00:39:09', '2023-02-24 00:39:09'),
(118, 2, 59, 0, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 0, 77, 60, 2.31, 30, 30, 'paypal', '61X312493H4848914', 'hbNbbXtoweBXD', 4, '2023-02-25', 1, 1, 1, 1, '2023-02-24 00:42:13', '2023-02-24 00:42:13'),
(119, 2, 74, 0, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 0, 45, 60, 1.35, 30, 30, 'paypal', '87W30860FU871374L', 'O5S9tzzKm96Qk', 4, '2023-02-25', 1, 1, 1, 1, '2023-02-24 01:04:25', '2023-02-24 01:04:25'),
(120, 2, 36, 0, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 0, 88, 60, 2.64, 30, 30, 'paypal', '56Y66981K9326535F', 'qdalXO2SgBJj5', 4, '2023-02-25', 1, 1, 1, 1, '2023-02-24 01:08:10', '2023-02-24 01:08:10'),
(121, 2, 46, 0, 'ss', 'li', '印度', 'hk', 'Other (Non US)', '000', 'G/F 6', 'Tai', 0, 88, 60, 2.64, 30, 30, 'paypal', '9D584557T1735093M', 'VNMVRjvYojOW1', 4, '2023-02-25', 1, 1, 1, 1, '2023-02-24 01:13:28', '2023-02-24 01:13:28'),
(122, 3, 20, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 122, 60, 3.66, 30, 30, 'paypal', '64W9143348508901J', 'nX4WF5Zb9d0Fz', 4, '2023-02-25', 1, 1, 1, 1, '2023-02-24 01:23:15', '2023-02-24 01:23:15'),
(123, 3, 59, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 38, 60, 1.14, 30, 30, 'paypal', '3H003499YV8896505', 'chyIrz87synU0', 4, '2023-02-26', 1, 1, 1, 1, '2023-02-25 00:23:52', '2023-02-25 00:23:52'),
(124, 3, 81, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 78, 60, 2.34, 30, 30, 'paypal', '9SV27512M1725945K', 'AuFBFNL01AeST', 4, '2023-03-01', 1, 1, 1, 1, '2023-02-28 15:44:54', '2023-02-28 15:44:54'),
(125, 3, 45, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 78, 60, 2.34, 30, 30, 'paypal', '33B68640WF355323V', 'WJ5FWqE7TExMv', 4, '2023-03-01', 1, 1, 1, 1, '2023-02-28 20:23:49', '2023-02-28 20:23:49'),
(126, 3, 34, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 88, 60, 2.64, 30, 30, 'paypal', '8FT07368WW237360P', 'fhVToFTu5Aio7', 4, '2023-03-02', 1, 1, 1, 1, '2023-03-01 01:54:44', '2023-03-01 01:54:44'),
(127, 3, 46, 0, 'SST', 'LEE', 'HK', 'HK', 'TUEN MUN', '001', 'TUEN MUN', '', 0, 128, 60, 3.84, 30, 30, 'paypal', '9AP726810F949712A', '2NVcG75tpxKhQ', 4, '2023-03-02', 1, 1, 1, 1, '2023-03-01 22:33:53', '2023-03-01 22:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `subcategory` int(11) NOT NULL,
  `format` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ram` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `base_price` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mkt_price` float NOT NULL DEFAULT '0',
  `is_featured` int(11) DEFAULT NULL COMMENT '0=NO|1=Yes',
  `brand` int(11) DEFAULT NULL,
  `class_type` int(11) DEFAULT NULL,
  `product_group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_video` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `release_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_of_sales` int(11) NOT NULL DEFAULT '0',
  `no_of_exchange` int(11) NOT NULL DEFAULT '0',
  `last_sale_price` float NOT NULL DEFAULT '0',
  `lowest_ask` float NOT NULL DEFAULT '0',
  `stock` int(11) NOT NULL DEFAULT '0',
  `video_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '1=custom,2=youtube',
  `youtube_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `conditions` int(11) DEFAULT '0',
  `game_score` float NOT NULL DEFAULT '0',
  `meta_score` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `factor_x` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `factor_y` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `factor_z` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `created_by`, `title`, `description`, `category`, `subcategory`, `format`, `ram`, `base_price`, `mkt_price`, `is_featured`, `brand`, `class_type`, `product_group`, `product_video`, `status`, `release_date`, `no_of_sales`, `no_of_exchange`, `last_sale_price`, `lowest_ask`, `stock`, `video_type`, `youtube_url`, `conditions`, `game_score`, `meta_score`, `factor_x`, `factor_y`, `factor_z`, `created_at`, `updated_at`) VALUES
(3, 0, 'Battle ground', 'dsfsfds11', 3, 33, 'CD', '0', '10', 0, 0, 17, 5, '5', '', 1, '1970-01-01', 0, 0, 0, 0, 7, '0', '', 0, 6.8, '8.2', '', '', '', '2022-06-20 08:49:38', '2023-01-16 17:19:05'),
(12, 0, 'BGMI', 'dggfgbvcgbgh', 3, 28, 'CD', '1.5', '10', 0, NULL, 1, 1, '4', 'assets/product_video/11192785861657722010.mp4', 1, '1970-01-01', 2, 1, 288, 0, 6, '', '', 0, 9.9, '8.1', NULL, NULL, NULL, '2022-06-29 05:36:25', '2022-07-13 09:20:10'),
(15, 0, 'diamond roll', 'God of war', 34, 35, 'CD', '0', '10', 0, NULL, 19, 3, '5', 'assets/product_video/11148729011657796955.mp4', 1, '1970-01-01', 0, 0, 0, 0, 6, '0', '', 0, 5.8, '8', '', '', '', '2022-07-07 01:22:29', '2023-01-16 20:59:41'),
(17, 0, 'price of persia', 'Resident Evil', 34, 35, 'CD', '4', '10', 0, NULL, 22, 9, '4', 'assets/product_video/20553542191657722114.mp4', 1, '1970-01-01', 0, 0, 0, 0, 3, '', '', 0, 6.8, '7.9', NULL, NULL, NULL, '2022-07-07 01:30:31', '2022-10-27 15:53:26'),
(20, 0, 'anthiest', 'Descargas el juego desde nuestra cuenta no es un código. Juegas desde el perfil entregado,?puedes? actualizar el juego y usar todas las funciones del juego excepto funciones online ya que se juega en modo avión.? Para abrir el juego se requiere internet. Se envían instrucciones paso a paso, el tipo de cuenta es cuanta secundaria Nota: Una vez enviada la cuenta no se aceptan cambios ni devoluciones, ya que es un producto digital, puedes aclarar todas tus dudas o si necesitas ayuda en la instalación enviándonos un mensaje a nuestro wsp.', 8, 37, 'CD', '0', '10', 0, NULL, 22, 1, '4', 'assets/product_video/20487305611657820330.mp4', 1, '1970-01-01', 3, 1, 138, 0, 0, '2', 'https://www.youtube.com/watch?v=vuMnHPNaqh0', 0, 5.4, '7.8', NULL, NULL, NULL, '2022-07-14 12:31:33', '2022-12-28 22:08:03'),
(21, 0, 'gold athena', 'Lo descargas desde nuestra cuenta y lo juegas con tu cuenta personal. Puedes acumular trofeos y guardar avances jugar online, y no requiere internet para abrir el juego.', 96, 97, 'CD', '0', '10', 0, NULL, 2, 1, '3', 'assets/product_video/11819357151657821011.mp4', 1, '2023-01-01', 1, 2, 99, 0, 0, '2', 'https://www.youtube.com/watch?v=AOuw9knWuJs', 0, 7.5, '7.7', '', '', '', '2022-07-14 12:50:11', '2023-01-28 18:36:07'),
(25, 0, 'Super Smash Bros', 'IMPORTANT THIS GAME CANNOT BE PLAYED ONLINE', 8, 37, 'CD', '0', '10', 0, NULL, 1, 2, '6', 'assets/product_video/12798581721658747571.mp4', 1, '1970-01-01', 1, 0, 534, 0, 5, '0', '', 0, 7.8, '7.6', '', '', '', '2022-07-25 19:12:51', '2023-01-17 18:14:14'),
(33, 0, 'temple run', 'division2', 96, 97, 'CD', '0', '10', 0, NULL, 2, 5, '', 'assets/product_video/16194440451663137317.mp4', 1, '2022-06-07', 3, 0, 589, 0, 6, '0', '', 0, 7.3, '7.5', '', '', '', '2022-09-14 14:35:17', '2023-01-28 18:35:11'),
(34, 0, 'new mario', 'fff', 38, 39, 'CD', '0', '10', 0, NULL, 22, 1, '', '', 1, '1970-01-01', 0, 0, 0, 0, 5, '0', '', 0, 6.8, '7.4', '', '', '', '2022-09-14 18:20:25', '2023-02-03 20:24:04'),
(35, 0, 'jumper', 'cc', 40, 41, 'CD', '555', '10', 0, NULL, 1, 3, '', '', 1, '1970-01-01', 0, 0, 0, 123, 5, '', '', 63, 6.2, '7.3', NULL, NULL, NULL, '2022-09-15 21:26:31', '2022-10-31 17:21:35'),
(36, 0, 'thrones', 'fff', 40, 41, 'CD', '256', '10', 0, NULL, 1, 2, '8', '', 1, '1970-01-01', 2, 2, 280, 0, 2, '', '', 0, 5.9, '7.2', NULL, NULL, NULL, '2022-09-16 15:57:25', '2022-09-16 16:00:58'),
(37, 0, 'last of us', 'The Last of Us??Part I Sony Interactive Entertainment  PS5   Released 02/09/2022        Vibration function required     Trigger effect required     Offline play enabled     1 player     Remote Play supported     Game Help supported', 34, 67, 'CD', '0', '10', 0, NULL, 1, 1, '5', '', 1, '2023-07-02', 10, 0, 200, 133, 2, '0', '', 50, 5.5, '7.1', '', '', '', '2022-09-19 16:06:28', '2023-02-10 23:43:26'),
(44, 0, 'GTA V', '0', 34, 45, 'CD', '0', '10', 0, NULL, 1, 10, '', '', 1, '1970-01-01', 0, 0, 0, 0, 4, '', '', 0, 7.3, '7', NULL, NULL, NULL, '2022-10-20 13:57:52', '2022-11-18 22:56:54'),
(45, 0, 'FIFA 23 PS4', 'EA SPORTS??FIFA 23 brings you all the realism of the beautiful game with the Men\'s and Women\'s FIFA World Cup?? the inclusion of women\'s club teams and new ways to play your favorite modes.Compete in the men\'s and women\'s FIFA World Cup?? the most important soccer tournaments in the world, which will be available in FIFA 23 during the season, play for the first time with women\'s teams and face any of your friends thanks to Cross- Play.Enjoy a new way to play and build your dream squad with FUT Moments and a revamped chemistry system in FIFA Ultimate Team??or make your football dreams come true in Career Mode as you define your personality as a footballer or become one. of the most important figures of the technical direction.In VOLTA FOOTBALL and Pro Clubs, bring more personality to the pitch with new levels of customization and improved street and stadium gameplay.?However you play, experience the beautiful game with more than 19,000 players, more than 700 teams, more than 100 stadiums and more than 30 leagues, including the UEFA Champions League and the Premier League, with unmatched realism.?Everything in FIFA 23.', 34, 44, 'CD', '0', '10', 0, NULL, 6, 10, '4', '', 1, '1970-01-01', 1, 2, 480, 0, 1, '3', 'https://cdn.akamai.steamstatic.com/steam/apps/256852627/movie480_vp9.webm?t=1633113400', 0, 8, '6.9', NULL, NULL, NULL, '2022-11-01 13:13:36', '2022-12-31 19:40:20'),
(46, 0, 'Call of Duty Modern Warfare II', 'Call of Duty®: Modern Warfare® II immerses players in an unprecedented global conflict featuring the return of the iconic Task Force 141 Operators.Infinity Ward brings next-gen gameplay to fans with fully-fledged weapon handling. new, a new armory, and other graphical and gameplay innovations that shoot the franchise to new heights.Modern Warfare® II will launch with a single-player global campaign, immersive Multiplayer combat, and a co-op Special Ops experience.', 34, 35, 'CD', '0', '10', 0, NULL, 7, 1, '4', '', 1, '1970-01-01', 1, 1, 225, 0, 4, '0', '', 0, 9.1, '6.8', '', '', '', '2022-11-01 16:54:19', '2023-02-23 01:21:09'),
(47, 0, 'The Last of Us Part II', 'Five years later...After a perilous journey through post-apocalyptic America, Ellie and Joel settle in Wyoming.Life in a thriving community provides them with stability, despite the threat of the infected and desperate survivors.After a violent event that disturbs the peace, Ellie begins a journey in search of justice.?In hunting down those responsible, she faces the terrible physical and emotional repercussions of her actions.??Discover a story full of emotion that will test your concept of good and evil.??Delve into a world full of beauty and danger, where you will go through quiet mountains or ruins taken by vegetation.??Enjoy an action-survival game with tense melee combat, fluid movement, and dynamic stealth mechanics.', 34, 46, 'CD', '0', '10', 0, NULL, 23, 10, '5', '', 1, '1970-01-01', 0, 1, 0, 0, 2, '0', '', 0, 6.5, '6.7', '', '', '', '2022-11-01 17:11:51', '2023-01-28 17:31:14'),
(48, 0, 'Nickelodeon Kart Racers 3: Slime Speedway', 'Rebuilt and reimagined from the ground up, Nickelodeon Kart Racers returns bigger and better than ever!?Includes a voice cast of over 40 iconic characters.?Drift, slide and speed your way to the finish on tracks inspired by legendary Nickelodeon animations like SpongeBob SquarePants, Teenage Mutant Ninja Turtles, Avatar: The Last Airbender and more!Key Game Features:??An iconic voice cast of over 40 Nickelodeon characters!??A great feature for the first time in Nickelodeon Kart Racers: voice acting!??Transform your new go-kart or motorcycle into boats to navigate entirely new terrain??Discover never-before-seen levels of customization: pair Raphael with the Portable Reptar, change paint and parts, or try millions of possible combinations!??Choose from 90 team members to match your playstyle with unique special abilities??Intense Slime-filled alternate paths on 36 different tracks, new and old??Take on racer friends in a mayhem-filled arena mode??Intense local multiplayer! in split screen and online!', 34, 47, 'CD', '14102022', '10', 0, NULL, 10, 10, '', '', 1, '1970-01-01', 0, 0, 0, 0, 5, '', '', 0, 6, '6.6', NULL, NULL, NULL, '2022-11-01 19:40:46', '2022-11-01 19:51:40'),
(49, 0, 'NBA 2K23', 'Rise to the challenge and realize your full potential in NBA 2K23.?Test yourself against the best players in the world and prove your talent in MyCAREER or The W. Unite current stars with eternal legends in MyTEAM.?Build your own dynasty as a GM, or lead the league in a new direction as Commissioner in My NBA.?Take on NBA or WNBA teams in PLAY NOW and experience realistic gameplay.?How Will You Answer The Call???The next evolution of ultra-realistic gameplay has come to New Gen with NBA 2K23.?New ways to attack off the dribble and at the rim combine with an intuitive 1v1 positional shading system to unlock even more control at both ends of the court in the most authentic basketball eEXPerience to date.??The City is yours in the most immersive MyCAREER journey to date.?Perfect your game, build your brand and decide how to write your story on and off the pitch.?Choose your team and take on the best MyPLAYERS in a brand new City, packed with stunning views, stadiums and pitches ready for you to be next.???Step back in time with era-specific visuals that captured Michael Jordan\'s rise from college sensation to global icon, with immersive Jordan Challenges chronicling his career dominance.?Step into his shoes to recreate his otherworldly stats and iconic last shots, while hearing first-hand accounts from those who witnessed his maturation from budding star to basketball legend.???Play without limits as you collect and assemble a group of legendary talent from any era in MyTEAM.?Dominate the pitch every season and bring your vision to life with an extensive set of customization tools to create the perfect look for your starting lineup.', 34, 44, 'CD', '0', '10', 0, NULL, 9, 10, '4', '', 1, '2022-12-03', 1, 0, 268, 0, 4, '0', '', 0, 8.8, '6.5', '', '', '', '2022-11-01 19:47:03', '2023-01-15 03:09:26'),
(50, 0, 'ELDEN RING', 'THE NEW FANTASY ACTION RPG.Arise, smutty one, and be guided by grace to wield the power of the Elden Ring and become an Elden Lord in the Midlands.??A vast world full of excitementA vast world where open fields, with a wide variety of situations, and huge dungeons, with complex and three-dimensional layouts, seamlessly connect.?As you explore, you are accompanied by the excitement of discovering overwhelming and unknown threats, which brings a great sense of accomplishment.??Create your own characterIn addition to customizing your character\'s appearance, you can freely combine the weapons, armor, and magic you wish to equip.?You can develop your character according to your style of play, such as increasing your muscle strength to become a strong warrior or mastering magic.??An epic drama born from a mythA multilayered story told in fragments.?An epic drama in which the diverse thoughts of the characters intersect in the Middle Lands.??Unique online mode that indirectly connects you with othersIn addition to the multiplayer mode, where you can directly connect with other players and travel together, the game features a unique asynchronous online mode, which allows you to feel the presence of other players.', 34, 48, 'CD', '0', '10', 0, NULL, 11, 10, '4', '', 1, '2022-11-03', 0, 1, 0, 0, 0, '0', '', 0, 7.2, '6.4', '', '', '', '2022-11-01 20:05:07', '2023-01-30 13:40:46'),
(51, 0, 'Minecraft', 'Dream it, build it! Creation knows no limits in Minecraft.?From the dream house you always wanted to have, to your own private island.?We present you a paradise of construction by blocks.?The limits are set by your own imagination.  take refuge Oh no???Skeletons, zombies, creepers!?When night falls??be careful.?The monsters are on the prowl, waiting to hunt down all the unconscious who dare to come out at night.?So make sure you build a shelter capable of withstanding their relentless attacks.', 34, 49, 'CD', '28112011', '10', 0, NULL, 12, 10, '', '', 1, '2022-10-03', 0, 0, 0, 0, 5, '', '', 0, 7.3, '6.3', NULL, NULL, NULL, '2022-11-01 20:12:37', '2022-11-01 20:15:36'),
(52, 0, 'JoJo\'s Bizarre Adventure: All-Star Battle R', 'Jojo\'s Bizarre Adventure, famous for its charismatic heroes, striking art style, and unforgettable catchphrases (\"Yare yare daze...\"), has a new installment on the way: JoJo\'s Bizarre Adventure: All-Star Battle R!??Incredible visual effects, true to the style of Hirohiko ArakiJoJo\'s Bizarre Adventure: All-Star Battle R captures JoJo\'s classic off-the-wall art style, letting you experience the JoJo universe with stunning visuals that will make you feel like the JoJo manga. Hirohiko Araki has come to life.?Now control of Hirohiko Araki\'s characters is in your hands and you will feel like you are inside the manga, where images and text come together to invoke the characteristic \"?', 34, 50, 'CD', '0', '10', 60, NULL, 11, 10, '', '', 1, '2022-09-03', 0, 0, 0, 0, 5, '', '', 0, 7.4, '6.2', NULL, NULL, NULL, '2022-11-01 20:20:35', '2022-11-17 20:11:01'),
(53, 0, 'NieR Replicant', 'An ancient lie that will last forever...NieR Replicant ver.1.22474487139... is an updated version of NieR Replicant, originally released in Japan in April 2010.Discover a unique prequel to the masterpiece NieR:Automata, a title which has received excellent reviews.?With this update you will enjoy carefully updated graphics, a fascinating story and much more!The protagonist is a good-natured young man from a remote village who, in order to save his sister Yonah, who suffers from a deadly disease known as runic necrosis, sets out to find the sealed Verses in the company of the strange talking book Grimoire Weiss.Discover the story of NieR Replicant for the first time in the West with the brother as the protagonist.', 34, 51, 'CD', '22042021', '10', 50, NULL, 13, 10, '', '', 1, '2022-08-03', 0, 0, 0, 0, 5, '', '', 0, 7.5, '6.1', NULL, NULL, NULL, '2022-11-01 20:26:35', '2022-11-01 20:28:09'),
(54, 0, 'Construction Simulator', 'Construction Simulator is back, bigger and better than ever!?Return to work with a fleet of vehicles that will surprise you.?Apart from brands like Caterpillar, CASE and BELL, which are already regulars in the Construction Simulator series, you will be able to drive new official machines from partners like DAF and Doosan, more than 70 in total.Build to your heart\'s content on two maps inspired by landscapes from the US and Germany.More than 90 exciting tasks are waiting for you on both maps, there is always something new to explore!Each map has its own campaign where you can have your own construction company.?You will start from scratch with the help of Hape, your mentor.?You will be obtaining bigger and more interesting jobs so that your company grows and increases your fleet.?You will also meet different clients who will challenge you.?You will need all your skills to complete tasks, such as renovating the port area to attract more tourists or helping the decaying city center recover.On the European map, inspired by the idyllic cities of southwestern Germany, you will find rolling hills and beautiful riversides.?At Friedenberg, your mission will be to help design renewable energy solutions and improve the city\'s infrastructure during the campaign.?Aside from the big jobs, you will be given various tasks that will test all the equipment you get.?Feel the pride of your achievements as you tour the city!Of course, players will be able to continue enjoying brands and machinery from previous installments of the franchise.?All these official partners arrive with new and previously seen machinery with an improved appearance: Atlas, BELL, Bobcat, Bomag, CASE, Caterpillar©, Kenworth, Liebherr, MAN, Mack Trucks, Meiller-Kipper, Palfinger, Still and Wirtgen. Group.In addition to the well-known official partners, players will be able to enjoy a new selection: Benninghoven from Wirtgen Group, Cifa, DAF, Doosan, Nooteboom, Scania, Schwing Stetter and Wacker Neuson.?Enjoy official personal protective equipment for your player character with the new official partner: Engelbert Strauss.You\'ll find over 70 machines from these official partners, faithfully recreating their real-life counterparts.?Not only will you be able to grow your own building empire, you can also invite up to three friends to join you.?Coordinate and build together to finish contracts even more efficiently!Features:??More than 70 machines, vehicles, trucks and accessories.??Two huge maps based on the USA and Germany.??Each of the maps includes its own campaign.??Complete challenges with more than 90 contracts.??9 new official partners, 25 in total.??Online multiplayer mode with up to four players.', 34, 52, 'CD', '2092022', '10', 320, NULL, 14, 3, '', '', 1, '2022-07-03', 0, 0, 0, 0, 5, '', '', 0, 7.6, '6', NULL, NULL, NULL, '2022-11-01 20:40:34', '2022-11-01 20:42:24'),
(55, 0, 'RESIDENT EVIL REVELATIONS', 'The story takes place before the bioterrorist attacks in Kijuju and Lanshiang, when the BSAA was still a developing organization.?He and Jill Valentine board a ghost ship in the Mediterranean Sea in search of her old partner, Chris Redfield.?He discovers the hidden truth behind the destruction of a floating city.?Or play Strike Mode and go on a network co-op kill spree with friends.', 34, 53, 'CD', '0', '10', 240, NULL, 15, 9, '', '', 1, '2022-06-03', 1, 0, 250, 0, 8, '', '', 0, 7.7, '5.9', NULL, NULL, NULL, '2022-11-01 20:49:57', '2022-11-18 23:44:07'),
(56, 0, 'Saints Row', 'As a future boss or boss, with Neenah, Kevin and Eli at your side, you will create the Saints and face the Panteros, Idols and Marshall as you build your empire in the streets of Santo Ileso and have to fight for the control of the city.?Ultimately, Saints Row is a startup story, only the Saints are in the business of crime.Enjoy the biggest and best playground ever created on Saints Row;?Santo Ileso\'s sprawling and unique environment is the backdrop for a wild and vast sandbox of exciting shenanigans, criminal deals and spectacular missions;?The road to the top is littered with shootouts, reckless driving, and wingsuit flights.FEATURES??Witness the birth of the Saints: Enjoy a story full of action, crime, extraordinary scenes and surprises of the house, finished off with a sense of humor.??Discover the Wild and Weird West ??Immerse yourself in Saint Unharmed, the biggest and best playground ever created on Saints Row, divided into nine unique districts, surrounded by the vast and majestic beauty of the desert Southwest.??Build your own criminal empire: Conquer the city block by block, declare war on enemy factions and rule the streets with an iron fist thanks to ingenious criminal enterprises.??Shoot, Shoot LOTS: Fire revolvers from the hip, fire and forget with the rocket launcher, or shred at close range with heavy melee hits, including brutal takedowns.?A wide variety of exotic and familiar weapons, all customizable and deadly fun.??Dominate the streets and the skies: cross urban and desert environments in any of the cars, motorcycles, planes, helicopters, VTOL, hoverbikes, hoverboards, karts or equip yourself with a wingsuit and take flight.??Unprecedented Customization: Create the boss of your dreams, thanks to the most extensive character customization pack ever seen in the series;?Complete the look with awesome weapon and vehicle options.??24/7 Co-op Mode: Enjoy everything the game has to offer with a friend at any time, thanks to seamless drop-in/drop-out co-op mode to avoid taking you out of the crazy action.?Play politely or tease your partner.?After all, who is the boss here?', 34, 45, 'CD', '0', '10', 280, NULL, 16, 9, '', '', 1, '2022-05-03', 0, 0, 0, 0, 6, '', '', 0, 7.8, '5.8', NULL, NULL, NULL, '2022-11-04 00:18:36', '2022-11-09 19:56:07'),
(59, 0, 'Gran Turismo Sport', 'The ultimate racing experience is back and better than ever on PS4. ??Experience the most realistic cars with true to life graphics.??Drive 140 of the fastest and most desired cars in the world, from exclusive prototypes to the best in the world of motorsport.??Race on 19 different tracks and venues, including the legendary Nürburgring and Tokyo Expressway. THE NEW STANDARD OF RACING ??World novelty, the only official FIA online championship.?Race for your country of origin or for your favorite car manufacturer.??The new physics engine and realistic handling provide ideal driving experiences for novices and veterans alike.??Divisions by age, region and driving style: Drivers of different abilities can experience the thrill of online racing. For more information about your reservation, including how to cancel your reservation, please refer to the Sony Entertainment Network Terms of Service and User Agreement.?Automatic download requires that the Automatic System Sign-in and Automatic Sign-in features be enabled on the PS4??system. Players 1-2Network Players 2-20 PlayStation®Plus Subscription RequiredDUALSHOCK®4 Vibration FunctionHD Video Output 480p ??720p ??1080i ??1080pRemote Play SupportedPlayStation®VR Headset + PlayStation®Camera Compatible', 34, 46, 'CD', '0', '10', 320, NULL, 1, 3, '', '', 1, '2022-04-03', 0, 0, 0, 0, 6, '', '', 0, 7.9, '5.7', NULL, NULL, NULL, '2022-11-15 15:40:49', NULL),
(60, 0, 'Subnautica: Below Zero PS4', 'Below Zero is an underwater adventure game that takes place in an alien ocean world.?It is a new chapter of the Subnautica universe, developed by Unknown Worlds.Return to Planet 4546BDive into an all-new sub-zero expedition, in an arctic region of planet 4546B.?You will arrive with little more than what you are wearing and a survival kit to investigate what happened to your sister...Find out the truthAlterra left in a hurry after a mysterious incident.?A few research stations remain in the area.?What happened to the scientists who lived and worked here??Records, items, and databases hidden among the debris paint a new picture of the incident.?With limited resources, you must improvise to survive on your own.Discover unexplored biomesSwim under the illuminated arch of the Twisted Bridges.?Be captivated by the huge sparkling crystals in the Crystal Caves.?Climb the snow-capped peaks and venture into the icy caves of the Glacier Basin.?Dodge steaming thermal vents to find ancient alien artifacts.?Below Zero features all-new environments to survive, analyze, and explore.Build Habitats and VehiclesSurvive harsh weather and build large habitats, scavenge for resources and craft equipment.?Take to the snowy tundra in a Snowfox hovercraft.?Explore both enchanting and dangerous biomes in your modular Seatruck.Investigate alien life formsSomething unknown lurks in every corner.?Swim through the huge Titan Hollow Fish, face the shadow Leviathan and visit the adorable pengalads.?Keep alert.?Not all creatures are friendly in this strange world.Survives Freezing TemperaturesJump in, the water is warm.?Subzero temperatures in this arctic region pose a new threat.?New climatic conditions create a blanket over surface habitats.?Craft a warm thermal suit, drink hot coffee from the pipes, and snuggle up to the thermal lilies to warm up.an ocean of intrigueWhat happened to your sister??Who were the aliens that came here before??Why were they on this planet??Can the truth help us find comfort??Below Zero expands on the history of the Subnautica universe, delving into the mystery presented in the original game.', 34, 46, 'CD', '0', '10', 0, NULL, 13, 10, '', '', 1, '1970-01-01', 0, 0, 0, 0, 6, '', '', 0, 8, '5.6', NULL, NULL, NULL, '2022-11-15 16:54:40', NULL),
(61, 0, 'Ghostbusters: Spirits Unleashed', 'Ghostbusters: Spirits Unleashed is a multiplayer game that will entertain veterans and newbies alike.?Four proton pack-wielding ghostbusters face off against a ghost seeking to possess the various locations in an asymmetrical multiplayer battle (online or offline).?As you progress through the game, you\'ll unlock cosmetic items and upgrades that will transform the experience for both sides.?The aesthetics and feel of the game will provide fans with an immersive experience in the universe of the franchise, and the opportunity to live out their fantasies as a Ghostbuster.?Whichever side you choose, it\'s a game that\'s easy to learn and fun to master!This asymmetrical game is like playing hide-and-seek.?As in previous IllFonic games, matches are 4v1 matchups where you can be part of a ghost hunting team or the ghost itself.?The game can be played alone or with up to four friends.?It will have an online mode and an offline mode in which you will play alone with the support of the AI.Ghostbusters: Spirits Unleashed features all the iconic gear and gadgets fans have come to expect.?Anyone playing Ghostbusters will have a blast with the Proton Pack, PKE Meter, and Ghost Traps.?Ghosts have several abilities in their arsenal that make owning the different locations a lot of fun, such as possessing items, runny nose, and more.?Additionally, the game\'s base of operations is made up of two locations that many will recognize: The Fire Station and Ray\'s Books of the Occult!?It is here where you can choose missions, modify your character, practice with the proton packs and discover everything there is to learn.', 34, 46, 'CD', '0', '10', 0, NULL, 18, 10, '', '', 1, '2023-11-01', 0, 0, 0, 0, 6, '0', '', 0, 7.5, '5.5', '', '', '', '2022-11-15 17:18:58', '2023-01-28 17:29:23'),
(62, 0, 'The Sinking City', 'The Sinking City is an open world investigation and adventure game inspired by the universe of HP Lovecraft, the master of horror.?The semi-submerged city of Oakmont is in the grip of supernatural forces.?You are a private investigator and you must find out what has possessed the city... and the minds of its inhabitants.- A harrowing atmosphere and plot inspired by the Lovecraftian universe.- A huge open world that you can explore on foot, by boat, in a diving suit...- High replayability thanks to an open investigation system: each case can be solved in different ways, and its conclusion will depend on your actions.- An arsenal of weapons from the 20s with which to face terrifying creatures.- Manage your sanity to discern the truth behind the madness.', 34, 46, 'CD', '0', '10', 0, NULL, 18, 10, '', '', 1, '1970-01-01', 0, 0, 0, 0, 6, '', '', 0, 8.3, '5.4', NULL, NULL, NULL, '2022-11-15 18:24:54', '2022-11-17 20:39:32'),
(63, 0, 'A Way Out PS4', 'From the creators of Brothers ??A Tale of Two Sons comes A Way Out, a unique cooperative adventure where you take on the role of one of two prisoners making a perilous escape beyond the prison walls.What starts as a fast-paced escape soon turns into an exciting and unpredictable adventure like you\'ve never seen or played before.A Way Out is a two player experience.?Each player controls one of the main characters, Leo and Vincent, in a forced alliance to escape from prison and gain freedom.Live the full experience with your friends with the free trial feature: friends pass.?If you buy the full game, you can invite any of your friends online, regardless of whether they bought it or not.?From the in-game menu, invite your friend to unlock the Free Trial, and then you\'ll be ready to play the full experience together.', 34, 46, 'CD', '0', '10', 250, NULL, 18, 9, '', '', 1, '1970-01-01', 0, 0, 0, 0, 8, '0', '', 0, 8.8, '5.3', '', '', '', '2022-11-15 18:26:43', '2023-01-28 17:34:04'),
(64, 0, 'Toy Story 3 PS4', 'Originally released on the PSP??(PlayStation®Portable) system, enjoy Disney?', 34, 67, 'CD', '0', '10', 80, NULL, 19, 10, '', '', 1, '1970-01-01', 0, 0, 0, 0, 6, '', '', 0, 7.8, '5.2', NULL, NULL, NULL, '2022-11-15 18:29:42', '2022-11-15 18:31:06'),
(65, 0, 'ff fantasy', 'dd', 34, 44, 'CD', '0', '10', 50, NULL, 18, 10, '', '', 1, '1970-01-01', 0, 0, 0, 0, 5, '', '', 0, 5.8, '5.1', NULL, NULL, NULL, '2022-11-15 22:58:56', '2022-11-16 17:43:45'),
(66, 0, 'Pokemon Purple NINTENDO', 'The Pokémon series evolves with?Pokémon Scarlet??and??Pokémon Purple?for?Nintendo Switch?!?Travel with your friends and explore an open world inhabited by new Pokémon.  Languages German, English, Spanish, French, Italian, Japanese, Korean, Chinese', 8, 75, 'CD', '0', '10', 400, NULL, 21, 3, '', '', 1, '1970-01-01', 0, 0, 0, 0, 5, '', '', 0, 5.6, '5', NULL, NULL, NULL, '2022-11-19 20:21:01', '2022-11-19 20:23:04'),
(67, 0, 'Pokemon Scarlet NINTENDO', 'The Pokémon series evolves with?Pokémon Scarlet??and??Pokémon Purple?for?Nintendo Switch?!?Travel with your friends and explore an open world inhabited by new Pokémon. ?  Languages German, English, Spanish, French, Italian, Japanese, Korean, Chinese', 8, 75, 'CD', '0', '10', 300, NULL, 21, 9, '', '', 1, '2010-12-06', 0, 0, 0, 0, 6, '', '', 0, 5.4, '4.9', NULL, NULL, NULL, '2022-11-19 20:24:26', NULL),
(68, 0, 'Bayonetta 3 NINTENDO', 'It\'s spell time! ?     Show off your might, shoot with relish, and take down bad guys with heart-stopping style in Bayonetta 3 for Nintendo Switch!?Join Bayonetta in this ultra-frenzied action game, and take on a mysterious evil force using his iconic pistols and a host of new demonic techniques.', 8, 75, 'CD', '0', '10', 500, NULL, 22, 2, '6', '', 1, '2010-11-06', 0, 0, 0, 0, 5, '0', '', 0, 5.3, '4.8', NULL, NULL, NULL, '2022-11-19 20:27:11', '2023-01-09 21:20:06'),
(73, 0, 'Atque exercitationem', 'sdgfdsg', 34, 46, 'CD', '0', '10', 0, NULL, 20, 10, '6', '', 1, '1970-01-01', 0, 0, 0, 0, 5, '0', '', 0, 9.8, '4.7', '', '', '', '2022-12-22 19:40:38', '2023-01-28 19:34:26'),
(74, 0, 'Distinctio Et dolor', 'dfdf', 40, 55, 'CD', '0', '10', 500, NULL, 2, 2, '4', 'assets/product_video/14929330611671713300.mp4', 1, '2010-09-06', 0, 1, 0, 0, 2, '3', 'https://www.youtube.com/watch?v=AOuw9knWuJs', 0, 5, '4.6', NULL, NULL, NULL, '2022-12-22 19:43:27', '2022-12-29 14:54:15'),
(75, 1, 'demo1', 'demo', 38, 39, '4567', '8', '10', 0, NULL, 19, NULL, '0', 'assets/product_video/16740034191671774920.mp4', 1, NULL, 0, 0, 0, 0, 0, '1', 'https://www.youtube.com/watch?v=lhTopL6Izh0', 0, 0, NULL, NULL, NULL, NULL, '2022-12-23 13:14:41', '2022-12-23 13:56:33'),
(76, 0, 'New Game1', 'It\'s spell time! ?     Show off your might, shoot with relish, and take down bad guys with heart-stopping style in Bayonetta 3 for Nintendo Switch!?Join Bayonetta in this ultra-frenzied action game, and take on a mysterious evil force using his iconic pistols and a host of new demonic techniques', 40, 55, 'CD', '0', '10', 0, NULL, 22, 1, '4', '', 1, '2023-03-02', 0, 1, 0, 0, 0, '2', 'https://www.youtube.com/watch?v=AOuw9knWuJs', 0, 5.2, '4.5', '', '', '', '2022-12-28 21:20:48', '2023-02-02 19:00:29'),
(80, 3, 'vcv', 'vcvcvg', 34, 52, 'CD', '34', '10', 0, NULL, 20, NULL, '0', '', 1, NULL, 0, 0, 0, 0, 0, '0', '', 0, 0, NULL, NULL, NULL, NULL, '2023-01-28 17:53:36', NULL),
(81, 0, 'Possimus harum dolo', 'd fedfdsfdasf daesfaf', 2, 22, 'Est repudiandae sit', '0', '430', 589, NULL, 13, 1, '2', '', 1, '2013-09-07', 0, 0, 0, 0, 7, '0', '', 0, 100, '12', '27', '56', '76', '2023-02-20 14:04:49', NULL),
(82, 0, 'New Game added', 'dsfsfds11', 34, 35, 'CD', '', '15', 0, NULL, 19, 1, '5', '', 1, '1970-01-01', 0, 0, 0, 0, 0, '', '', 0, 6.8, '8.2', NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(83, 0, 'Sonics Unleased PS3', 'Sonic Unleashed is a platform game in which the player controls the titular Sonic the Hedgehog in two modes: fast-paced levels that take place during daytime, showcasing and using Sonic\'s trademark speed as seen in previous games in the series, and slower, night-time levels, during which Sonic transforms into the Werehog, and gameplay switches to an action-based, brawler style of play, in which Sonic battles Gaia enemies (those created by the main enemy in the game, Dark Gaia)', 40, 63, 'CD', '', '38', 78, NULL, 17, 10, '', '', 1, '1970-01-01', 0, 0, 0, 0, 0, '', '', 0, 7.8, '7.8', NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(85, 0, 'Resident Evil 2', 'None', 40, 54, 'CD', '0', '35', 69, NULL, 15, 10, '', '', 1, '1970-01-01', 0, 0, 0, 0, 0, '0', '', 0, 8.6, '8.6', '', '', '', '0000-00-00 00:00:00', '2023-02-21 17:43:36'),
(86, 0, 'Resident Evil 3', 'None', 40, 54, 'CD', '0', '35', 69, NULL, 15, 10, '', '', 1, '1970-01-01', 0, 0, 0, 0, 1, '0', '', 0, 8.6, '8.6', '', '', '', '0000-00-00 00:00:00', '2023-02-23 01:19:10'),
(87, 0, 'FIFA 19 Legacy Edition PS3', 'FIFA 19 Legacy Edition will include the same innovative gameplay from FIFA 17 and FIFA 18 without any significant further development or enhancement.', 40, 41, 'CD', '0', '48', 99, NULL, 6, 5, '', '', 1, '1970-01-01', 0, 0, 0, 0, 0, '0', '', 0, 6, '6', '', '', '', '0000-00-00 00:00:00', '2023-02-24 00:09:50'),
(88, 0, 'DMC Devil May Cry', 'DmC: Devil May Cry is an action-adventure hack and slash video game. Players take on the role of Dante as he uses his powers and weaponry to fight against enemies and navigate the treacherous Limbo.[2] Like previous games in the series, Dante can perform combos by attacking with his sword, Rebellion, and shooting with his twin pistols, Ebony and Ivory', 40, 55, 'CD', '0', '38', 69, NULL, 15, 10, '', '', 1, '1970-01-01', 0, 0, 0, 0, 0, '0', '', 0, 7.7, '7.7', '', '', '', '0000-00-00 00:00:00', '2023-02-24 00:15:14'),
(89, 0, 'Resident Evil 1', 'dfd', 40, 54, 'CD', '0', '35', 69, NULL, 15, 10, '', '', 1, '2020-01-03', 0, 0, 0, 0, 0, '0', '', 0, 8.4, '8.4', '', '', '', '0000-00-00 00:00:00', '2023-02-24 18:42:46'),
(117, 0, 'Resident Evil 20', 'dfd', 40, 54, 'CD', '0', '35', 69, NULL, 15, 10, '', '', 1, '2020-01-03', 0, 0, 0, 0, 0, '0', '', 0, 8.4, '8.4', '', '', '', '0000-00-00 00:00:00', '2023-02-28 15:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `product_group`
--

CREATE TABLE `product_group` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sorting` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1= active | 0 = hidden',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_group`
--

INSERT INTO `product_group` (`id`, `title`, `sorting`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Featured Products', '1', 1, '2022-06-30 00:00:00', '0000-00-00 00:00:00'),
(3, 'Comming Soon', '2', 1, '2022-06-30 00:00:00', '0000-00-00 00:00:00'),
(4, 'Most Popular', '3', 1, '2022-07-04 00:00:00', '0000-00-00 00:00:00'),
(5, 'Trending Games', '4', 1, '2022-07-04 00:00:00', '0000-00-00 00:00:00'),
(6, 'Recently Viewed', '0', 1, '2022-08-05 00:00:00', '0000-00-00 00:00:00'),
(8, 'Others', '5', 1, '2022-09-15 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `image`, `product_id`) VALUES
(1, 'assets/product_image/2961408441655732465.jpg', 2),
(2, 'assets/product_image/963898431655732465.png', 2),
(3, 'assets/product_image/13046386031655732465.jpg', 4),
(4, 'assets/product_image/8162369511655732575.jpg', 3),
(5, 'assets/product_image/3368136121655732575.jpg', 3),
(7, 'assets/product_image/7869295751655732788.jpg', 3),
(8, 'assets/product_image/18944205881655732788.jpg', 3),
(9, 'assets/product_image/17886916761655978757.png', 5),
(10, 'assets/product_image/14989581171655979329.jpg', 6),
(11, 'assets/product_image/2117692281655982499.webp', 7),
(12, 'assets/product_image/10515887921655982499.webp', 7),
(16, 'assets/product_image/4934886841655982561.webp', 8),
(17, 'assets/product_image/4593450571655987435.webp', 7),
(18, 'assets/product_image/6329300381655987435.webp', 7),
(19, 'assets/product_image/19427627361655988838.webp', 9),
(20, 'assets/product_image/20809259311655988838.webp', 9),
(21, 'assets/product_image/19973103321655990468.webp', 8),
(22, 'assets/product_image/4117864061655990468.webp', 8),
(23, 'assets/product_image/5173412301656067262.png', 10),
(25, 'assets/product_image/11712482041656068028.png', 5),
(26, 'assets/product_image/7978582301656068028.png', 5),
(27, 'assets/product_image/13981131571656077568.png', 11),
(28, 'assets/product_image/15885792121656143916.png', 12),
(29, 'assets/product_image/8748383321656144107.jpg', 13),
(30, 'assets/product_image/13048567481656233214.png', 14),
(32, 'assets/product_image/7930264981656576740.png', 16),
(33, 'assets/product_image/17208042471656953497.jpg', 12),
(34, 'assets/product_image/183615101656953758.jpg', 3),
(35, 'assets/product_image/19896529621656954596.jfif', 4),
(37, 'assets/product_image/20566206731657175250.jpg', 16),
(38, 'assets/product_image/3090652331657175431.jpg', 17),
(39, 'assets/product_image/12545632061657175682.jpg', 18),
(40, 'assets/product_image/9301596191657176212.jpg', 19),
(41, 'assets/product_image/12528162501657795931.jpg', 15),
(42, 'assets/product_image/14716238711657795931.jpg', 15),
(43, 'assets/product_image/15189044661657819893.webp', 20),
(44, 'assets/product_image/1212222141657821011.webp', 21),
(45, 'assets/product_image/3941941291657824644.webp', 22),
(46, 'assets/product_image/10279825891657995770.mp4', 23),
(47, 'assets/product_image/2844360881658142146.jpg', 24),
(48, 'assets/product_image/275828051658747571.webp', 25),
(49, 'assets/product_image/9242756771658747861.webp', 26),
(50, 'assets/product_image/5661676791658836128.webp', 27),
(51, 'assets/product_image/21306357301658904781.jpg', 30),
(52, 'assets/product_image/1975584021658904781.jpg', 30),
(53, 'assets/product_image/10504768261658904781.jpg', 30),
(54, 'assets/product_image/12086969111658913448.webp', 31),
(55, 'assets/product_image/12958694361658919829.jpg', 32),
(56, 'assets/product_image/3113412351663137317.png', 33),
(57, 'assets/product_image/3540105441663150825.PNG', 34),
(58, 'assets/product_image/14956395011663248391.PNG', 35),
(59, 'assets/product_image/18999798601663315045.png', 36),
(60, 'assets/product_image/6734985291663574788.jpg', 37),
(61, 'assets/product_image/1592555921663575263.gif', 37),
(62, 'assets/product_image/20594471531665125639.png', 38),
(63, 'assets/product_image/11010296501665125962.png', 39),
(64, 'assets/product_image/12476913411665393152.png', 40),
(65, 'assets/product_image/15542611781666244914.png', 43),
(66, 'assets/product_image/10638974551666245472.jpg', 44),
(67, 'assets/product_image/17211285051667279616.webp', 45),
(68, 'assets/product_image/9869461241667292859.webp', 46),
(69, 'assets/product_image/7939327411667293911.jpg', 47),
(70, 'assets/product_image/20886788291667302846.webp', 48),
(71, 'assets/product_image/8735827031667303223.webp', 49),
(72, 'assets/product_image/9331056101667304307.jpg', 50),
(73, 'assets/product_image/9543345141667304757.webp', 51),
(74, 'assets/product_image/14153412001667305235.webp', 52),
(75, 'assets/product_image/10925818811667305595.webp', 53),
(76, 'assets/product_image/385546941667306434.webp', 54),
(77, 'assets/product_image/14339870851667306997.webp', 55),
(78, 'assets/product_image/15896558711667492316.webp', 56),
(79, 'assets/product_image/12026007001667548973.webp', 57),
(80, 'assets/product_image/15622923781668496784.jpg', 58),
(81, 'assets/product_image/19955408261668498049.jpg', 59),
(82, 'assets/product_image/16927120931668502480.webp', 60),
(83, 'assets/product_image/18405180561668503938.webp', 61),
(84, 'assets/product_image/11363738401668507894.webp', 62),
(85, 'assets/product_image/1275446241668508003.webp', 63),
(86, 'assets/product_image/12008736411668508182.webp', 64),
(87, 'assets/product_image/18305512731668524336.webp', 65),
(88, 'assets/product_image/6412133211668860461.webp', 66),
(89, 'assets/product_image/2470924031668860666.webp', 67),
(90, 'assets/product_image/4762936781668860831.webp', 68),
(91, 'assets/product_image/1982880601671707120.png', 69),
(92, 'assets/product_image/13108560271671707615.jpeg', 70),
(93, 'assets/product_image/8322498001671707726.jpg', 71),
(94, 'assets/product_image/12471385291671709103.jpg', 72),
(95, 'assets/product_image/7599540541671709238.jpg', 73),
(96, 'assets/product_image/18085480821671709407.jpg', 74),
(97, 'assets/product_image/9562882311671772481.jpeg', 75),
(98, 'assets/product_image/5696178991672233648.png', 76),
(99, 'assets/product_image/20824510731672292706.png', 77),
(100, 'assets/product_image/16515490161672294280.jpg', 78),
(101, 'assets/product_image/1745630851673270159.png', 79),
(102, 'assets/product_image/10501157761674899616.webp', 80),
(103, 'assets/product_image/15366217911676873089.png', 81),
(104, 'assets/product_image/14850227201676972616.webp', 85),
(105, 'assets/product_image/3483202781676972734.jpg', 86),
(106, 'assets/product_image/6495532241676972792.webp', 87),
(107, 'assets/product_image/5233291601676972823.webp', 88),
(108, 'assets/product_image/12969291831677078769.webp', 89);

-- --------------------------------------------------------

--
-- Table structure for table `seller_billing_info`
--

CREATE TABLE `seller_billing_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `card_number` bigint(20) NOT NULL,
  `card_expire` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_cvv` int(11) NOT NULL,
  `card_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_first` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_last` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_zip` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seller_billing_info`
--

INSERT INTO `seller_billing_info` (`id`, `user_id`, `card_number`, `card_expire`, `card_cvv`, `card_type`, `billing_first`, `billing_last`, `billing_country`, `billing_address`, `billing_address2`, `billing_city`, `billing_state`, `billing_zip`, `created_at`, `updated_at`) VALUES
(1, 2, 4480601555957622, '10/2026', 692, 'Visa', 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 4242424242424242, '04/2024', 123, 'Visa', 'hakim', 'saiffee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 4242424242424242, '04/2024', 123, 'Visa', 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '2022-09-15 14:59:26', '2022-09-15 14:59:26'),
(4, 4, 5555555555554444, '04/2024', 452, 'Switch', 'NEHA', 's', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sell_product`
--

CREATE TABLE `sell_product` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_owner` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=place ask | 2=sell now',
  `price` float NOT NULL,
  `dis_price` float NOT NULL,
  `payment_fee` float NOT NULL DEFAULT '0',
  `trans_fee` float NOT NULL DEFAULT '0',
  `validity_day` int(5) NOT NULL,
  `exp_date` date DEFAULT NULL,
  `card_number` bigint(20) NOT NULL,
  `card_expire` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_cvv` int(11) NOT NULL,
  `billing_first` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_last` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_zip` int(11) DEFAULT NULL,
  `game_condition` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sold_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = active | 1 = progress | 2 = complete | 3 = expire',
  `is_new` int(11) NOT NULL DEFAULT '0',
  `is_ship_in_2_days` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sell_product`
--

INSERT INTO `sell_product` (`id`, `product_id`, `product_owner`, `user_id`, `status`, `price`, `dis_price`, `payment_fee`, `trans_fee`, `validity_day`, `exp_date`, `card_number`, `card_expire`, `card_cvv`, `billing_first`, `billing_last`, `billing_country`, `billing_address`, `billing_address2`, `billing_city`, `billing_state`, `billing_zip`, `game_condition`, `sold_status`, `is_new`, `is_ship_in_2_days`, `created_at`, `updated_at`) VALUES
(1, 37, 0, 4, 1, 5102, 4438, 0, 0, 7, '2022-09-26', 5555555555554444, '04/2024', 452, 'NEHA', 's', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '50', 2, 1, 0, '2022-09-19 16:30:50', '2022-09-19 16:30:50'),
(2, 37, 0, 1, 2, 1570, 1365.9, 0, 0, 0, '0000-00-00', 4242424242424242, '04/2024', 123, 'hakim', 'saiffee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '50', 2, 1, 0, '2022-09-19 17:38:42', '2022-09-19 17:38:42'),
(3, 37, 0, 3, 2, 479, 417, 0, 0, 0, '0000-00-00', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 2, 0, 0, '2022-09-19 22:13:25', '2022-09-19 22:13:25'),
(4, 37, 0, 3, 2, 997, 867, 0, 0, 0, '0000-00-00', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 2, 0, 0, '2022-09-19 22:15:18', '2022-09-19 22:15:18'),
(5, 37, 0, 2, 2, 463, 393.55, 0, 0, 0, '0000-00-00', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 2, 1, 0, '2022-09-20 13:42:07', '2022-09-20 13:42:07'),
(6, 37, 0, 2, 1, 380, 323, 0, 0, 1, '2022-09-21', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 3, 1, 0, '2022-09-20 13:49:45', '2022-09-20 13:49:45'),
(9, 20, 0, 2, 1, 42, 35.7, 0, 0, 1, '2022-09-21', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 2, 0, 0, '2022-09-20 14:03:18', '2022-09-20 14:03:18'),
(10, 37, 0, 1, 1, 100, 85, 0, 0, 1, '2022-09-21', 4242424242424242, '04/2024', 123, 'hakim', 'saiffee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '50', 2, 1, 0, '2022-09-20 15:29:05', '2022-09-20 15:29:05'),
(11, 37, 0, 3, 2, 196, 167, 0, 0, 0, '0000-00-00', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 2, 0, 0, '2022-09-21 14:44:49', '2022-09-21 14:44:49'),
(12, 37, 0, 3, 1, 518, 440, 0, 0, 1, '2022-09-22', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 2, 1, 0, '2022-09-21 14:49:27', '2022-09-21 14:49:27'),
(14, 33, 0, 2, 1, 588, 499.8, 0, 0, 1, '2022-09-22', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 2, 0, 0, '2022-09-21 20:36:44', '2022-09-21 20:36:44'),
(15, 37, 0, 3, 1, 392, 334, 0, 0, 1, '2022-09-22', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 2, 0, 1, '2022-09-21 20:57:08', '2022-09-21 20:57:08'),
(16, 25, 0, 3, 1, 534, 454, 0, 0, 1, '2022-09-22', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 2, 1, 1, '2022-09-21 21:40:26', '2022-09-21 21:40:26'),
(17, 36, 0, 2, 1, 360, 306, 0, 0, 3, '2022-09-25', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '79', 3, 1, 0, '2022-09-22 15:43:52', '2022-09-22 15:43:52'),
(18, 45, 0, 2, 1, 480, 408, 0, 0, 1, '2022-11-02', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '84', 2, 0, 1, '2022-11-01 13:41:17', '2022-11-01 13:41:17'),
(19, 57, 3, 3, 4, 200, 170, 0, 0, 1, '2022-11-05', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '35', 3, 0, 1, '2022-11-04 16:03:19', '2022-11-04 16:03:19'),
(20, 50, 0, 2, 4, 380, 323, 0, 0, 1, '2022-11-05', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '66', 3, 0, 1, '2022-11-04 19:39:03', '2022-11-04 19:39:03'),
(21, 46, 0, 3, 4, 200, 170, 0, 0, 1, '2022-11-09', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '67', 3, 1, 0, '2022-11-08 22:19:13', '2022-11-08 22:19:13'),
(22, 55, 0, 2, 2, 250, 0, 0, 0, 0, '0000-00-00', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '80', 2, 0, 1, '2022-11-10 17:35:14', '2022-11-10 17:35:14'),
(23, 37, 0, 2, 2, 200, 170, 0, 0, 0, '0000-00-00', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '71', 2, 0, 1, '2022-11-10 18:37:41', '2022-11-10 18:37:41'),
(24, 21, 0, 1, 4, 200, 170, 0, 0, 1, '2022-11-15', 4242424242424242, '04/2024', 123, 'hakim', 'saiffee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '50', 3, 1, 0, '2022-11-14 16:19:41', '2022-11-14 16:19:41'),
(26, 59, 0, 2, 4, 280, 238, 0, 0, 1, '2022-11-17', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 3, 0, 1, '2022-11-16 17:25:43', '2022-11-16 17:25:43'),
(27, 37, 0, 3, 1, 380, 323, 0, 0, 1, '2022-11-18', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '70', 3, 0, 1, '2022-11-17 20:02:23', '2022-11-17 20:02:23'),
(29, 15, 0, 1, 4, 560, 476, 0, 0, 1, '2022-11-23', 4242424242424242, '04/2024', 123, 'hakim', 'saiffee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '66', 3, 1, 1, '2022-11-22 20:16:49', '2022-11-22 20:16:49'),
(30, 25, 0, 1, 1, 500, 425, 0, 0, 1, '2022-12-23', 4242424242424242, '04/2024', 123, 'hakim', 'saiffee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '50', 3, 1, 1, '2022-12-22 15:55:23', '2022-12-22 15:55:23'),
(32, 45, 0, 3, 1, 280, 238, 0, 0, 1, '2022-12-31', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '90', 3, 0, 1, '2022-12-30 15:51:31', '2022-12-30 15:51:31'),
(33, 12, 0, 3, 4, 250, 212.5, 0, 0, 1, '2023-01-04', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 0, 0, '2023-01-03 13:57:17', '2023-01-03 13:57:17'),
(34, 15, 0, 3, 4, 180, 153, 0, 0, 1, '2023-01-04', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 0, 0, '2023-01-03 14:42:58', '2023-01-03 14:42:58'),
(35, 20, 0, 1, 4, 100, 85, 0, 0, 1, '2023-01-04', 4242424242424242, '04/2024', 123, 'hakim', 'saiffee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '50', 3, 1, 1, '2023-01-03 18:14:08', '2023-01-03 18:14:08'),
(36, 48, 0, 3, 4, 316, 269, 0, 0, 1, '2023-01-05', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 1, 0, '2023-01-04 14:58:55', '2023-01-04 14:58:55'),
(37, 36, 0, 2, 2, 120, 102, 0, 0, 0, '2023-01-05', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '65', 2, 0, 1, '2023-01-05 19:00:24', '2023-01-05 19:00:24'),
(38, 36, 0, 2, 1, 280, 238, 0, 0, 1, '2023-01-06', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '100', 2, 1, 1, '2023-01-05 19:07:08', '2023-01-05 19:07:08'),
(39, 45, 0, 2, 1, 380, 323, 0, 0, 1, '2023-01-06', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '65', 3, 0, 1, '2023-01-05 19:58:54', '2023-01-05 19:58:54'),
(41, 3, 0, 2, 1, 80, 68, 0, 0, 1, '2023-01-10', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 3, 0, 0, '2023-01-09 17:13:35', '2023-01-09 17:13:35'),
(42, 20, 0, 2, 1, 180, 153, 0, 0, 1, '2023-01-11', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 2, 0, 0, '2023-01-10 22:05:46', '2023-01-10 22:05:46'),
(45, 20, 0, 2, 4, 88, 74.8, 0, 0, 1, '2023-01-12', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 3, 0, 1, '2023-01-11 15:40:56', '2023-01-11 15:40:56'),
(47, 37, 0, 2, 4, 87, 73.95, 0, 0, 1, '2023-01-12', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 3, 0, 0, '2023-01-11 15:50:37', '2023-01-11 15:50:37'),
(48, 12, 0, 2, 1, 222, 188.7, 0, 0, 1, '2023-01-12', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 2, 0, 1, '2023-01-11 15:54:24', '2023-01-11 15:54:24'),
(50, 46, 0, 3, 1, 225, 191.25, 0, 0, 1, '2023-01-12', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 2, 0, 0, '2023-01-11 16:25:26', '2023-01-11 16:25:26'),
(51, 73, 0, 3, 4, 720, 612, 0, 0, 1, '2023-01-12', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 0, 1, '2023-01-11 22:27:43', '2023-01-11 22:27:43'),
(52, 48, 0, 3, 4, 520, 442, 0, 0, 1, '2023-01-12', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 0, 0, '2023-01-11 22:52:49', '2023-01-11 22:52:49'),
(55, 20, 0, 3, 4, 80, 68, 0, 0, 1, '2023-01-15', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '57', 3, 0, 0, '2023-01-14 02:01:12', '2023-01-14 02:01:12'),
(56, 54, 0, 3, 4, 80, 68, 0, 0, 1, '2023-01-15', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '32', 3, 0, 1, '2023-01-14 02:10:23', '2023-01-14 02:10:23'),
(64, 21, 0, 2, 2, 99, 0, 0, 0, 0, '0000-00-00', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 2, 0, 0, '2023-01-16 21:35:41', '2023-01-16 21:35:41'),
(66, 37, 0, 2, 4, 168, 142.8, 0, 0, 1, '2023-01-18', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 3, 0, 0, '2023-01-16 22:16:02', '2023-01-16 22:16:02'),
(67, 46, 0, 2, 4, 288, 244.8, 0, 0, 1, '2023-01-18', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '100', 3, 0, 1, '2023-01-17 17:30:00', '2023-01-17 17:30:00'),
(68, 49, 0, 2, 4, 128, 108.8, 0, 0, 1, '2023-01-18', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 3, 0, 0, '2023-01-17 18:05:44', '2023-01-17 18:05:44'),
(69, 17, 0, 3, 1, 238, 202.3, 0, 0, 1, '2023-01-19', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '70', 3, 0, 1, '2023-01-17 18:09:11', '2023-01-17 18:09:11'),
(70, 25, 0, 2, 1, 198, 168.3, 0, 0, 1, '2023-01-19', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 3, 0, 0, '2023-01-17 18:14:07', '2023-01-17 18:14:07'),
(71, 45, 0, 1, 4, 120, 102, 0, 0, 1, '2023-01-18', 4242424242424242, '04/2024', 123, 'hakim', 'saiffee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '50', 3, 0, 0, '2023-01-17 18:16:48', '2023-01-17 18:16:48'),
(72, 48, 0, 1, 4, 500, 425, 0, 0, 1, '2023-01-18', 4242424242424242, '04/2024', 123, 'hakim', 'saiffee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '50', 3, 0, 0, '2023-01-17 18:24:32', '2023-01-17 18:24:32'),
(73, 21, 0, 1, 4, 100, 85, 0, 0, 1, '2023-01-18', 4242424242424242, '04/2024', 123, 'hakim', 'saiffee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '50', 3, 0, 0, '2023-01-17 20:24:03', '2023-01-17 20:24:03'),
(74, 20, 0, 1, 4, 200, 170, 0, 0, 1, '2023-01-18', 4242424242424242, '04/2024', 123, 'hakim', 'saiffee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '50', 3, 1, 0, '2023-01-17 20:44:54', '2023-01-17 20:44:54'),
(75, 46, 0, 3, 4, 198, 168.3, 0, 0, 1, '2023-01-21', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '43', 3, 1, 1, '2023-01-18 17:02:41', '2023-01-18 17:02:41'),
(77, 63, 0, 2, 1, 308, 261.8, 0, 0, 1, '2023-01-19', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '85', 3, 1, 0, '2023-01-18 18:16:21', '2023-01-18 18:16:21'),
(78, 20, 0, 1, 1, 100, 85, 0, 0, 1, '2023-01-20', 4242424242424242, '04/2024', 123, 'hakim', 'saiffee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '50', 3, 1, 1, '2023-01-19 13:54:04', '2023-01-19 13:54:04'),
(79, 49, 0, 1, 2, 268, 227.8, 0, 0, 0, '2023-01-21', 4242424242424242, '04/2024', 123, 'hakim', 'saiffee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '50', 2, 0, 0, '2023-01-21 23:20:15', '2023-01-21 23:20:15'),
(80, 12, 0, 2, 1, 288, 244.8, 0, 0, 1, '2023-01-22', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '65', 2, 0, 0, '2023-01-21 23:23:32', '2023-01-21 23:23:32'),
(81, 47, 0, 2, 4, 78, 66.3, 0, 0, 1, '2023-01-23', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 3, 0, 0, '2023-01-22 02:00:47', '2023-01-22 02:00:47'),
(82, 15, 0, 1, 4, 208, 176.8, 0, 0, 1, '2023-01-26', 4242424242424242, '04/2024', 123, 'hakim', 'saiffee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '74', 3, 0, 0, '2023-01-25 02:43:48', '2023-01-25 02:43:48'),
(83, 15, 0, 2, 4, 198, 168.3, 0, 0, 1, '2023-01-26', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 3, 0, 0, '2023-01-25 02:46:28', '2023-01-25 02:46:28'),
(84, 45, 0, 2, 4, 288, 244.8, 0, 0, 1, '2023-01-26', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 3, 0, 0, '2023-01-25 02:48:10', '2023-01-25 02:48:10'),
(85, 37, 0, 2, 4, 288, 244.8, 0, 0, 1, '2023-01-27', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 3, 1, 0, '2023-01-26 00:56:01', '2023-01-26 00:56:01'),
(86, 37, 0, 3, 4, 258, 219.3, 0, 0, 1, '2023-01-27', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 0, 0, '2023-01-26 17:49:30', '2023-01-26 17:49:30'),
(87, 52, 0, 1, 4, 222, 188.7, 0, 0, 1, '2023-01-27', 4242424242424242, '04/2024', 123, 'hakim', 'saiffee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '50', 3, 0, 0, '2023-01-26 17:52:35', '2023-01-26 17:52:35'),
(88, 48, 0, 3, 4, 323, 274.55, 0, 0, 1, '2023-01-27', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 0, 0, '2023-01-26 18:31:51', '2023-01-26 18:31:51'),
(90, 49, 0, 1, 4, 228, 193.8, 0, 0, 1, '2023-01-29', 4242424242424242, '04/2024', 123, 'hakim', 'saiffee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '88', 3, 1, 1, '2023-01-28 16:53:51', '2023-01-28 16:53:51'),
(94, 12, 0, 2, 4, 480, 408, 0, 0, 1, '2023-02-03', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 3, 1, 0, '2023-02-02 16:05:17', '2023-02-02 16:05:17'),
(97, 15, 0, 3, 4, 568, 482.8, 0, 0, 1, '2023-02-04', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 0, 0, '2023-02-03 14:30:49', '2023-02-03 14:30:49'),
(98, 44, 0, 3, 4, 788, 669.8, 0, 0, 1, '2023-02-04', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 0, 0, '2023-02-03 14:41:41', '2023-02-03 14:41:41'),
(101, 25, 0, 3, 4, 888, 754.8, 0, 0, 1, '2023-02-04', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 0, 0, '2023-02-03 16:23:39', '2023-02-03 16:23:39'),
(103, 47, 0, 1, 4, 420, 357, 0, 0, 1, '2023-02-04', 4242424242424242, '04/2024', 123, 'hakim', 'saiffee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '50', 3, 0, 0, '2023-02-03 16:31:52', '2023-02-03 16:31:52'),
(104, 2, 0, 3, 4, 88, 74.8, 0, 0, 1, '2023-02-04', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 0, 0, '2023-02-03 16:33:11', '2023-02-03 16:33:11'),
(105, 17, 0, 3, 4, 1228, 1043.8, 0, 0, 1, '2023-02-04', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 0, 0, '2023-02-03 17:00:26', '2023-02-03 17:00:26'),
(106, 33, 0, 3, 4, 1088, 924.8, 0, 0, 1, '2023-02-04', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 0, 0, '2023-02-03 19:26:48', '2023-02-03 19:26:48'),
(108, 50, 0, 3, 4, 1388, 1179.8, 0, 0, 1, '2023-02-04', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 0, 0, '2023-02-03 20:26:25', '2023-02-03 20:26:25'),
(109, 53, 0, 3, 1, 78, 66.3, 0, 0, 1, '2023-02-05', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 1, 1, '2023-02-04 00:08:33', '2023-02-04 00:08:33'),
(110, 34, 0, 3, 1, 238, 202.3, 0, 0, 1, '2023-02-10', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 1, 1, '2023-02-09 16:31:33', '2023-02-09 16:31:33'),
(111, 20, 0, 2, 1, 232, 197.2, 0, 0, 1, '2023-02-12', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 3, 0, 0, '2023-02-11 01:08:43', '2023-02-11 01:08:43'),
(112, 15, 0, 3, 1, 138, 117.3, 0, 0, 1, '2023-02-12', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 0, 0, '2023-02-11 01:11:58', '2023-02-11 01:11:58'),
(113, 56, 0, 3, 1, 188, 159.8, 0, 0, 1, '2023-02-12', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 1, 1, '2023-02-11 01:58:39', '2023-02-11 01:58:39'),
(114, 46, 0, 3, 4, 322, 273.7, 0, 0, 14, '2023-02-25', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 0, 1, '2023-02-11 02:10:25', '2023-02-11 02:10:25'),
(115, 51, 0, 3, 4, 132, 114.84, 0, 0, 14, '2023-03-01', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '80', 3, 1, 1, '2023-02-15 23:36:21', '2023-02-15 23:36:21'),
(116, 33, 0, 3, 1, 138, 120.06, 0, 0, 1, '2023-02-19', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 1, 1, '2023-02-18 03:44:27', '2023-02-18 03:44:27'),
(117, 25, 0, 1, 4, 500, 435, 15, 50, 1, '2023-02-21', 4242424242424242, '04/2024', 123, 'hakim', 'saiffee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '50', 3, 1, 1, '2023-02-20 13:57:58', '2023-02-20 13:57:58'),
(118, 3, 0, 1, 4, 117, 162.21, 3.51, 11.7, 1, '2023-02-21', 4242424242424242, '04/2024', 123, 'hakim', 'saiffee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '50', 3, 1, 1, '2023-02-20 19:22:24', '2023-02-20 19:22:24'),
(119, 3, 0, 3, 4, 555, 657.15, 16.65, 55.5, 1, '2023-02-22', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 1, 1, '2023-02-21 14:57:27', '2023-02-21 14:57:27'),
(120, 34, 0, 3, 4, 222, 280.86, 6.66, 22.2, 1, '2023-02-23', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 1, 1, '2023-02-22 22:14:31', '2023-02-22 22:14:31'),
(121, 64, 0, 3, 4, 138, 185.94, 4.14, 13.8, 1, '2023-02-23', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '79', 3, 1, 1, '2023-02-22 22:20:57', '2023-02-22 22:20:57'),
(122, 59, 0, 3, 4, 145, 193.85, 4.35, 14.5, 1, '2023-02-24', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '79', 3, 1, 1, '2023-02-23 01:11:33', '2023-02-23 01:11:33'),
(123, 47, 0, 1, 4, 420, 504.6, 12.6, 42, 1, '2023-02-24', 4242424242424242, '04/2024', 123, 'hakim', 'saiffee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', 453331, '50', 3, 1, 1, '2023-02-23 20:52:22', '2023-02-23 20:52:22'),
(124, 55, 0, 3, 4, 123, 168.99, 3.69, 12.3, 1, '2023-02-25', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 1, 1, '2023-02-24 00:28:00', '2023-02-24 00:28:00'),
(125, 34, 0, 3, 4, 111, 155.43, 3.33, 11.1, 1, '2023-02-25', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 1, 1, '2023-02-24 00:36:15', '2023-02-24 00:36:15'),
(126, 3, 0, 2, 4, 123, 168.99, 3.69, 12.3, 1, '2023-02-25', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '76', 3, 1, 1, '2023-02-24 00:40:58', '2023-02-24 00:40:58'),
(127, 20, 0, 2, 2, 138, 90.06, 4.14, 13.8, 0, '2023-02-24', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 2, 1, 1, '2023-02-24 00:41:24', '2023-02-24 00:41:24'),
(128, 21, 0, 2, 4, 1099, 1271.87, 32.97, 109.9, 1, '2023-02-25', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '50', 3, 1, 1, '2023-02-24 01:00:53', '2023-02-24 01:00:53'),
(129, 48, 0, 2, 4, 146, 194.98, 4.38, 14.6, 1, '2023-02-25', 4480601555957622, '10/2026', 692, 'yu', 'lee', '香港', 'K', '2', '九龍城', '九龍', 222, '68', 3, 1, 1, '2023-02-24 01:03:41', '2023-02-24 01:03:41'),
(130, 37, 0, 3, 4, 132, 179.16, 3.96, 13.2, 1, '2023-03-01', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 1, 1, '2023-02-28 23:30:33', '2023-02-28 23:30:33'),
(131, 35, 0, 3, 4, 123, 168.99, 3.69, 12.3, 1, '2023-03-02', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '63', 3, 1, 1, '2023-03-01 01:52:27', '2023-03-01 01:52:27'),
(132, 37, 0, 3, 4, 133, 180.29, 3.99, 13.3, 1, '2023-03-02', 4242424242424242, '04/2024', 123, 'Wong', 's', 'Honk kong', 'b221 baker street', 'b221 baker street', 'Honk kong', 'Honk kong', 234555, '50', 3, 1, 1, '2023-03-01 22:32:57', '2023-03-01 22:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `id` int(11) NOT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` text COLLATE utf8_unicode_ci,
  `linkedin` text COLLATE utf8_unicode_ci,
  `youtube` text COLLATE utf8_unicode_ci,
  `whatsapp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `footer_about` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`id`, `facebook`, `twitter`, `linkedin`, `youtube`, `whatsapp`, `footer_about`) VALUES
(1, NULL, NULL, NULL, NULL, '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500');

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `title`, `link`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Facebook', 'https://facebook.com', 'assets/social_icon/4914137431657112841.png', '2022-07-05 00:00:00', '0000-00-00 00:00:00'),
(2, 'instagram', 'https://www.instagram.com/', 'assets/social_icon/16773510771657110257.png', '2022-07-06 00:00:00', '0000-00-00 00:00:00'),
(5, 'WECHAT', 'https://pc.weixin.qq.com/?lang=zh_HK', 'assets/social_icon/7347762991657443667.png', '2022-07-10 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `step_charge`
--

CREATE TABLE `step_charge` (
  `id` int(11) NOT NULL,
  `charge` double DEFAULT NULL,
  `step` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `step_charge`
--

INSERT INTO `step_charge` (`id`, `charge`, `step`, `created_at`, `updated_at`) VALUES
(1, 80, 1, '2022-10-10 09:47:36', '2022-10-10 09:47:36'),
(2, 120, 2, '2022-10-10 09:47:36', '2022-10-10 09:47:36'),
(3, 150, 3, '2022-10-10 09:47:36', '2022-10-10 09:47:36'),
(4, 220, 4, '2022-10-10 09:47:36', '2022-10-10 09:47:36'),
(5, 300, 5, '2022-10-10 09:47:36', '2022-10-10 09:47:36'),
(6, 350, 6, '2022-10-10 09:47:36', '2022-10-10 09:47:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reset_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) DEFAULT '1',
  `email_verified` int(1) DEFAULT '0',
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'HKD',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paypal_info` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `token`, `reset_token`, `status`, `email_verified`, `currency`, `create_date`, `update_date`, `paypal_info`) VALUES
(1, 'Hakimuddin', 'Saifee', 'hakim.webwiders@gmail.com', '0', 'MTIzNDU2', '', '23229cb8e5716d3eae6072b520d6c9f4', 1, 1, 'HKD', '2022-09-14 17:34:17', '2023-01-06 19:45:08', '{\"id\": \"I-GX94C5S75BFK\", \"plan\": {\"currency_code\": \"HKD\", \"payment_definitions\": [{\"type\": \"REGULAR\", \"amount\": {\"value\": \"243.25\", \"currency\": \"HKD\"}, \"cycles\": \"12\", \"frequency\": \"MONTH\", \"charge_models\": [{\"type\": \"TAX\", \"amount\": {\"value\": \"0.00\", \"currency\": \"HKD\"}}, {\"type\": \"SHIPPING\", \"amount\": {\"value\": \"0.00\", \"currency\": \"HKD\"}}], \"frequency_interval\": \"1\"}], \"merchant_preferences\": {\"setup_fee\": {\"value\": \"0.00\", \"currency\": \"HKD\"}, \"auto_bill_amount\": \"YES\", \"max_fail_attempts\": \"11\"}}, \"links\": [{\"rel\": \"self\", \"href\": \"https://api-m.sandbox.paypal.com/v1/payments/billing-agreements/I-GX94C5S75BFK\", \"method\": \"GET\"}], \"payer\": {\"status\": \"unverified\", \"payer_info\": {\"email\": \"shrinkcomekta@gmail.com\", \"payer_id\": \"7C8DWGU8HAHXE\", \"last_name\": \"Sodawala\", \"first_name\": \"Ekta\", \"shipping_address\": {\"city\": \"Wolverhampton\", \"line1\": \"1 Main Terrace\", \"line2\": \"Wolverhampton, West Midlands, W12 4LQ\", \"state\": \"West Midlands\", \"postal_code\": \"W12 4LQ\", \"country_code\": \"GB\"}}, \"payment_method\": \"paypal\"}, \"state\": \"Active\", \"start_date\": \"2023-01-03T00:00:00Z\", \"description\": \"PayPal payment agreement that overrides merchant preferences and shipping fee and tax information.\", \"shipping_address\": {\"city\": \"Wolverhampton\", \"line1\": \"1 Main Terrace\", \"line2\": \"Wolverhampton, West Midlands, W12 4LQ\", \"state\": \"West Midlands\", \"postal_code\": \"W12 4LQ\", \"country_code\": \"GB\"}, \"agreement_details\": {\"cycles_completed\": \"0\", \"cycles_remaining\": \"12\", \"next_billing_date\": \"2023-01-02T10:00:00Z\", \"final_payment_date\": \"2023-12-02T10:00:00Z\", \"outstanding_balance\": {\"value\": \"0.00\", \"currency\": \"HKD\"}, \"failed_payment_count\": \"0\"}}'),
(2, 'richy1022', 'lee', 'richy1022@outlook.com', '0', 'Y3gxNjgxNjg=', '', '', 1, 1, 'HKD', '2022-09-14 18:05:41', '2022-11-10 17:37:04', NULL),
(3, 'SST', 'LI', 'sstli@outlook.com', '0', 'Y3gxNjgxNjg=', '', '', 1, 1, 'HKD', '2022-09-14 18:12:42', '2023-02-11 02:00:51', '{\"id\": \"I-XDTU92WMGK7U\", \"plan\": {\"currency_code\": \"HKD\", \"payment_definitions\": [{\"type\": \"REGULAR\", \"amount\": {\"value\": \"243.25\", \"currency\": \"HKD\"}, \"cycles\": \"12\", \"frequency\": \"MONTH\", \"charge_models\": [{\"type\": \"TAX\", \"amount\": {\"value\": \"0.00\", \"currency\": \"HKD\"}}, {\"type\": \"SHIPPING\", \"amount\": {\"value\": \"0.00\", \"currency\": \"HKD\"}}], \"frequency_interval\": \"1\"}], \"merchant_preferences\": {\"setup_fee\": {\"value\": \"0.00\", \"currency\": \"HKD\"}, \"auto_bill_amount\": \"YES\", \"max_fail_attempts\": \"11\"}}, \"links\": [{\"rel\": \"self\", \"href\": \"https://api-m.sandbox.paypal.com/v1/payments/billing-agreements/I-XDTU92WMGK7U\", \"method\": \"GET\"}], \"payer\": {\"status\": \"unverified\", \"payer_info\": {\"email\": \"shrinkcomekta@gmail.com\", \"payer_id\": \"7C8DWGU8HAHXE\", \"last_name\": \"Sodawala\", \"first_name\": \"Ekta\", \"shipping_address\": {\"city\": \"Wolverhampton\", \"line1\": \"1 Main Terrace\", \"line2\": \"Wolverhampton, West Midlands, W12 4LQ\", \"state\": \"West Midlands\", \"postal_code\": \"W12 4LQ\", \"country_code\": \"GB\"}}, \"payment_method\": \"paypal\"}, \"state\": \"Active\", \"start_date\": \"2022-09-15T00:00:00Z\", \"description\": \"PayPal payment agreement that overrides merchant preferences and shipping fee and tax information.\", \"shipping_address\": {\"city\": \"Wolverhampton\", \"line1\": \"1 Main Terrace\", \"line2\": \"Wolverhampton, West Midlands, W12 4LQ\", \"state\": \"West Midlands\", \"postal_code\": \"W12 4LQ\", \"country_code\": \"GB\"}, \"agreement_details\": {\"cycles_completed\": \"0\", \"cycles_remaining\": \"12\", \"next_billing_date\": \"2022-09-14T10:00:00Z\", \"final_payment_date\": \"2023-08-14T10:00:00Z\", \"outstanding_balance\": {\"value\": \"0.00\", \"currency\": \"HKD\"}, \"failed_payment_count\": \"0\"}}'),
(4, 'Neha', 'singh', 'neha.webwiders@gmail.com', '0', 'MTIzNDU2', '', '', 0, 1, 'USD', '2022-09-19 15:58:13', '2022-09-19 16:29:13', NULL),
(5, 'rr', 'rr', 'richy0430@outlook.com', '0', 'Y3gxNjgxNjg=', '', '', 1, 1, 'HKD', '2023-01-18 19:46:05', '2023-01-18 19:47:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_billing_info`
--

CREATE TABLE `user_billing_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_shipping_info`
--

CREATE TABLE `user_shipping_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_shipping_info`
--

INSERT INTO `user_shipping_info` (`id`, `user_id`, `first_name`, `last_name`, `country`, `address`, `address2`, `city`, `state`, `zipcode`, `created_at`, `updated_at`) VALUES
(1, 3, 'SST', 'LEE', 'HK', 'TUEN MUN', '', 'HK', 'TUEN MUN', '001', '2022-11-16 00:37:34', '2022-11-16 00:37:34'),
(2, 2, 'ss', 'li', '印度', 'G/F 6', 'Tai', 'hk', 'Other (Non US)', '000', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'Hakim', 'saifee', 'Ukraine', 'rtrtygry', 'scdsf', 'rtrt', 'rtt', 'rtrty', '2022-11-09 20:18:29', '2022-11-09 20:18:29'),
(4, 4, 'Hakimuddin', 'Saifee', 'India', '112, Baker stree Indore', 'scdsf', 'Indore', 'MP', '453331', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 5, 'yu hin', 'lee', 'hk', 'kwai ting road', '', 'hk', 'kwai chung', '000', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 2, 34, '2022-09-16 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 20, '2022-09-22 00:00:00', '0000-00-00 00:00:00'),
(4, 2, 25, '2022-09-22 00:00:00', '0000-00-00 00:00:00'),
(5, 2, 33, '2022-09-22 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 37, '2022-10-20 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 52, '2022-12-22 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 68, '2023-01-02 00:00:00', '0000-00-00 00:00:00'),
(11, 2, 37, '2023-01-10 00:00:00', '0000-00-00 00:00:00'),
(13, 3, 2, '2023-01-15 00:00:00', '0000-00-00 00:00:00'),
(14, 1, 50, '2023-01-30 00:00:00', '0000-00-00 00:00:00'),
(15, 1, 64, '2023-01-30 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkout_quee`
--
ALTER TABLE `checkout_quee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_type`
--
ALTER TABLE `class_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_conversion_rate`
--
ALTER TABLE `currency_conversion_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exchange_list`
--
ALTER TABLE `exchange_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exchange_order`
--
ALTER TABLE `exchange_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_banner`
--
ALTER TABLE `footer_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_rates`
--
ALTER TABLE `grade_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_key` (`brand`),
  ADD KEY `color_key` (`class_type`);

--
-- Indexes for table `product_group`
--
ALTER TABLE `product_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_billing_info`
--
ALTER TABLE `seller_billing_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell_product`
--
ALTER TABLE `sell_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `step_charge`
--
ALTER TABLE `step_charge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_billing_info`
--
ALTER TABLE `user_billing_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_shipping_info`
--
ALTER TABLE `user_shipping_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `checkout_quee`
--
ALTER TABLE `checkout_quee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `class_type`
--
ALTER TABLE `class_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `currency_conversion_rate`
--
ALTER TABLE `currency_conversion_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exchange_list`
--
ALTER TABLE `exchange_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `exchange_order`
--
ALTER TABLE `exchange_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `footer_banner`
--
ALTER TABLE `footer_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grade_rates`
--
ALTER TABLE `grade_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `product_group`
--
ALTER TABLE `product_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `seller_billing_info`
--
ALTER TABLE `seller_billing_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sell_product`
--
ALTER TABLE `sell_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `social`
--
ALTER TABLE `social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `step_charge`
--
ALTER TABLE `step_charge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_billing_info`
--
ALTER TABLE `user_billing_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_shipping_info`
--
ALTER TABLE `user_shipping_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `brand_key` FOREIGN KEY (`brand`) REFERENCES `brands` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `color_key` FOREIGN KEY (`class_type`) REFERENCES `class_type` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
