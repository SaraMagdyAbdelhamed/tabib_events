-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 31, 2018 at 05:18 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tabyeb_events`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `updated_by` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(4, 'underground', NULL, '2018-05-23 13:48:15', '2018-05-30 08:14:09', 1, NULL),
(5, 'music', NULL, '2018-05-23 14:04:58', '2018-05-30 08:14:26', 1, NULL),
(6, 'Drama', NULL, '2018-05-25 17:43:34', '2018-05-30 08:14:57', 1, NULL),
(7, 'festival', NULL, '2018-05-30 08:16:03', '2018-05-30 08:16:03', 1, NULL),
(8, 'Conferences', NULL, '2018-05-30 08:16:46', '2018-05-30 08:16:46', 1, NULL),
(9, 'Seminars', NULL, '2018-05-30 08:17:21', '2018-05-30 08:17:21', 1, NULL),
(11, 'Award Ceremonies', NULL, '2018-05-30 08:18:24', '2018-05-30 08:18:24', 1, NULL),
(12, 'new event', NULL, '2018-06-23 12:20:21', '2018-06-23 12:20:21', 1, NULL),
(13, 'Exhibitions', NULL, '2018-07-02 02:44:20', '2018-07-02 02:44:20', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `symbol` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `rate` double(11,6) DEFAULT NULL,
  `def` int(11) DEFAULT '0',
  `subdivision_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `symbol`, `rate`, `def`, `subdivision_name`, `sort_order`) VALUES
(1, 'Euro', 'EUR', 0.811060, 0, 'cents', 3),
(2, 'Egyptian Pound', 'EGP', 17.649000, 0, 'piastres', 2),
(3, 'US Dollar', 'USD', 1.000000, 1, 'cents', 1),
(4, 'Saudi Ryal', 'SAR', 3.750200, 0, 'dirhams', 9),
(5, 'French Frank', 'FF', 3.750938, 0, 'cents', NULL),
(6, 'Japanese Yen', 'JPY', 106.275002, 0, 'cen', 4),
(7, 'Emirates Dirham', 'AED', 3.672955, 0, 'fils', 16),
(8, 'Great Britain Pound', 'GBP', 0.713370, 0, 'pence', 6),
(9, 'Algerian Dinar', 'DZD', 114.001999, 0, 'centimes', 18),
(10, 'Australian Dollar', 'AUD', 1.302756, 0, 'cents', 5),
(11, 'Bahraini Dinar', 'BHD', 0.377045, 0, 'fils', 12),
(12, 'Canadian Dollar', 'CAD', 1.290264, 0, 'cents', 13),
(13, 'Chinese Yuan Renminbi', 'CNY', 6.286600, 0, 'fen', 14),
(14, 'Hong Kong Dollar', 'HKD', 7.849950, 0, 'cents', 17),
(15, 'Indian Rupee', 'INR', 65.079597, 0, 'paise', 19),
(16, 'Jordanian Dinar', 'JOD', 0.709503, 0, 'fils', 21),
(17, 'Korean Won', 'KRW', 1060.900024, 0, 'chon', 22),
(18, 'Kuwaiti Dinar', 'KWD', 0.299600, 0, 'fils', NULL),
(19, 'Pakistan Rupee', 'PKR', 115.709900, 0, 'paisa', 23),
(20, 'Qatari Rial', 'QAR', 3.641481, 0, 'dirhams', 24),
(21, 'Russian Rouble', 'RUB', 57.327999, 0, '', 15),
(22, 'Singapore Dollar', 'SGD', 1.310530, 0, 'cents', NULL),
(23, 'South African Rand', 'ZAR', 11.831755, 0, 'cents', 11),
(24, 'Taiwan Dollar', 'TWD', 28.988857, 0, 'cents', 17),
(25, 'Thailand Baht', 'THB', 31.174000, 0, 'satang', 12),
(26, 'Malaysian Ringgit', 'MYR', 3.862497, 0, 'sen', NULL),
(27, 'Kenyan shilling', 'KES', 100.749046, 0, 'Cents', 10),
(28, 'Turkish lira', 'TRY', 3.954900, 0, 'Lira', 8),
(29, 'Polish', 'PLN', 3.422548, 0, NULL, 7);

-- --------------------------------------------------------

--
-- Table structure for table `entities`
--

DROP TABLE IF EXISTS `entities`;
CREATE TABLE IF NOT EXISTS `entities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `table_name` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entities`
--

INSERT INTO `entities` (`id`, `name`, `table_name`) VALUES
(1, NULL, 'categories'),
(2, NULL, 'fixed_pages'),
(3, NULL, 'genders'),
(4, NULL, 'geo_cities'),
(5, NULL, 'geo_countries'),
(6, NULL, 'geo_regions'),
(7, NULL, 'offer_categories'),
(8, NULL, 'offer_requests'),
(9, NULL, 'offers'),
(10, NULL, 'rules'),
(11, NULL, 'specializations'),
(12, NULL, 'sponsor_categories'),
(13, NULL, 'users'),
(14, NULL, 'users_info');

-- --------------------------------------------------------

--
-- Table structure for table `entity_localizations`
--

DROP TABLE IF EXISTS `entity_localizations`;
CREATE TABLE IF NOT EXISTS `entity_localizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) DEFAULT NULL,
  `field` varchar(255) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `value` text,
  `cleared_text` text,
  `lang_id` int(11) DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `venue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `longtuide` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `start_datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `end_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_paid` tinyint(1) DEFAULT '0',
  `use_ticketing_system` tinyint(1) DEFAULT '0',
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `tele_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `show_in_mobile` tinyint(1) DEFAULT '1',
  `is_active` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `updated_by` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `image`, `venue`, `latitude`, `longtuide`, `address`, `start_datetime`, `end_datetime`, `is_paid`, `use_ticketing_system`, `website`, `tele_code`, `mobile`, `email`, `code`, `show_in_mobile`, `is_active`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(8, 'El Saqya Concent', 'saqya', '', 'saqya', '30.049276888613115', '31.221135722198483', 'Al Gazira, Giza Governorate, Egypt', '2018-06-29 06:00:00', '2018-06-29 04:00:00', 0, 1, 'http://www.eventakom.com', NULL, '01227775312', 'salmaomario@yahoo.com', '56315661', 1, 1, '2018-05-31 11:20:18', '2018-06-25 08:15:17', 1, NULL),
(10, 'El Saqya Concent', 'saqya', '', 'saqya', '30.050688476335125', '31.22199402908325', 'Al Gazira, Giza Governorate, Egypt', '2016-10-11 06:00:00', '0000-00-00 00:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01227775312', 'salmaomario@yahoo.com', '020', 1, 1, '2018-05-31 14:30:17', '2018-07-15 13:39:10', 47, NULL),
(11, 'OraMaki Event ', 'Ora Maki Event ', '', 'saqya ', '30.045915', '31.22429', NULL, '2018-06-29 18:00:00', '2018-06-29 21:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01227775312', 'salmaomario@yahoo.com', NULL, 1, 1, '2018-06-04 13:08:17', '2018-06-06 07:01:00', 41, NULL),
(12, 'SamHarris Event ', 'SamHarris Event ', '', 'saqya ', '30.045915', '31.22429', NULL, '2018-06-29 18:00:00', '2018-06-29 21:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01227775312', 'salmaomario@yahoo.com', NULL, 1, 1, '2018-06-04 13:12:01', '2018-06-06 07:01:08', 41, NULL),
(13, 'Ora Maki 2 Event', 'saqya', '', 'saqya', '30.045915', '31.22429', NULL, '1970-01-01 06:00:00', '1970-01-01 04:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01227775312', 'salmaomario@yahoo.com', '020', 1, 1, '2018-06-04 13:18:41', '2018-06-25 09:17:35', 41, NULL),
(14, 'Ora Maki 24444 Event ', 'SamHarris Event ', '', 'saqya ', '30.045915', '31.22429', NULL, '2018-06-29 18:00:00', '2018-06-29 21:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01227775312', 'salmaomario@yahoo.com', NULL, 1, 1, '2018-06-04 13:20:37', '2018-06-06 11:11:38', 36, NULL),
(15, 'Ora Maki 5555 Event ', 'SamHarris Event ', '', 'saqya ', '30.045915', '31.22429', NULL, '2018-06-29 18:00:00', '2018-06-29 21:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01227775312', 'salmaomario@yahoo.com', NULL, 1, 1, '2018-06-04 13:28:09', '2018-06-11 12:36:00', 41, NULL),
(18, 'Kheima Ramadan', 'Ramadan Event ', '', 'saqya ', '30.045915', '31.22429', NULL, '2018-06-29 18:00:00', '2018-06-29 21:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01227775312', 'salmaomario@yahoo.com', NULL, 1, 1, '2018-06-10 11:50:07', '2018-06-14 12:38:18', 36, NULL),
(20, 'Kheima Ramadan will be rejected', 'Ramadan Event ', '', 'saqya ', '30.045915', '31.22429', NULL, '2018-06-29 18:00:00', '2018-06-29 21:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01227775312', 'salmaomario@yahoo.com', NULL, 1, 1, '2018-06-11 13:33:33', '2018-06-20 13:12:08', 36, NULL),
(23, 'Test Edit Event', 'saqya', '', 'saqya', '30.045915', '31.22429', NULL, '1970-01-01 06:00:00', '1970-01-01 04:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01227775312', 'salmaomario@yahoo.com', '020', 1, 1, '2018-06-19 02:28:32', '2018-06-25 09:00:47', 36, NULL),
(24, 'Omar Khairat', 'Opera House', '', 'Opera House', '30.022806863746357', '31.207265853881836', 'Inside Cairo Uni, Oula, Giza, Giza Governorate, Egypt', '2027-02-07 06:00:00', '2029-02-07 04:00:00', 0, 1, 'http://www.eventakom.com', '+20', '01227775312', 'salmaomario@yahoo.com', '15668647', 1, 0, '2018-06-19 02:31:12', '2018-07-15 13:59:06', 36, NULL),
(25, 'test', 'tt', '', 'ttt', '30.045915', '31.22429', NULL, '2018-06-29 18:00:00', '2018-06-29 21:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01', 'salmaomario@yahoo.com', NULL, 1, 1, '2018-06-19 02:32:04', '2018-06-21 12:13:02', 36, NULL),
(26, 'test', 'tt', '', 'ttt', '30.045915', '31.22429', NULL, '2018-06-29 18:00:00', '2018-06-29 21:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01', 'salmaomario@yahoo.com', NULL, 1, 1, '2018-06-19 02:32:22', '2018-06-21 11:23:45', 36, NULL),
(29, 'Jaddal', 'Jaddal Band', '', 'Cairo, Egypt', '30.045727628836843', '31.41180215959389', NULL, '2018-06-06 09:30:00', '2018-06-07 02:00:00', 1, NULL, 'http://www.xupevali.org.au', NULL, '563', 'deso@mailinator.com', '190', 1, 1, '2018-06-23 12:43:43', '2018-06-23 12:46:22', 48, 1),
(32, 'Samson Hutchinson', 'Modi est a dignissimos minus velit voluptatum omnis tempore vel', '', 'Voluptatibus qui ex dignissimos molestias porro exercitationem fuga Aliqua Et occaecat ea', '30.047059762805294', '32.5693651023837', NULL, '1970-01-01 12:00:00', '1970-01-01 10:00:00', 1, NULL, 'http://www.cesyfucezyrarub.org.au', NULL, '707', 'bido@mailinator.net', '536', 1, 1, '2018-06-24 09:04:25', '2018-06-24 12:25:23', 1, 1),
(33, 'Benedict Weaver', 'Facere reprehenderit dolores modi cupiditate ut non aut vitae iusto', '', 'musuem', '30.047059762805294', '32.5693651023837', 'طومان باي، Cairo Governorate, Egypt', '2018-06-12 12:00:00', '2018-06-12 04:00:00', 0, NULL, 'http://www.qocidid.me', NULL, '0123268895', 'zunudugova@mailinator.net', '906', 1, 1, '2018-06-25 08:52:03', '2018-06-25 08:52:03', 1, NULL),
(34, 'Test Edit Event', 'Test Edit Event', '', 'saqya ', '30.045915', '31.22429', NULL, '2018-06-29 18:00:00', '2018-06-29 21:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01227775312', 'salmaomario@yahoo.com', NULL, 1, 0, '2018-06-27 12:12:18', '2018-06-27 12:12:18', 41, NULL),
(35, 'Test Edit Event', 'Test Edit Event', '', 'saqya ', '30.045915', '31.22429', NULL, '2018-06-29 18:00:00', '2018-06-29 21:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01227775312', 'salmaomario@yahoo.com', NULL, 1, 0, '2018-06-27 12:13:38', '2018-06-27 12:13:38', 41, NULL),
(36, 'Test Edit Event', 'Test Edit Event', '', 'saqya ', '30.045915', '31.22429', NULL, '2018-06-29 18:00:00', '2018-06-29 21:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01227775312', 'salmaomario@yahoo.com', NULL, 1, 0, '2018-06-27 12:14:45', '2018-06-27 12:14:45', 41, NULL),
(37, 'Test Edit Event', 'Test Edit Event', '', 'saqya ', '30.045915', '31.22429', NULL, '2018-06-29 18:00:00', '2018-06-29 21:00:00', 0, 0, 'http://www.eventakom.com', '+20', '01227775312', 'salmaomario@yahoo.com', NULL, 1, 0, '2018-06-27 12:16:08', '2018-06-27 12:16:08', 41, NULL),
(38, 'Test Edit Event', 'Test Edit Event', '', 'saqya ', '30.045915', '31.22429', NULL, '2018-06-29 18:00:00', '2018-06-29 21:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01227775312', 'salmaomario@yahoo.com', NULL, 1, 0, '2018-07-09 19:51:45', '2018-07-09 19:51:45', 36, NULL),
(39, 'Test Edit Event', 'Test Edit Event', '', 'saqya ', '30.045915', '31.22429', NULL, '2018-06-29 18:00:00', '2018-06-29 21:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01227775312', 'salmaomario@yahoo.com', NULL, 1, 0, '2018-07-09 20:04:54', '2018-07-09 20:04:54', 36, NULL),
(40, 'Tarik Reed', 'Sed quis consequat Cum veritatis sint culpa necessitatibus ex tempora voluptatem dolor et expedita laborum labore nisi ex optio id', '', 'Consequatur Excepteur sint libero autem aute quis', '30.042998197763644', '31.444163312255796', 'Ali Al Sibai, Cairo Governorate, Egypt', '1981-05-24 12:00:00', '2011-05-16 10:00:00', 0, NULL, 'http://www.wotukiduvo.co', NULL, '99364363463', 'secosadom@mailinator.net', '11', 1, 1, '2018-07-10 08:21:10', '2018-07-10 08:21:10', 1, NULL),
(41, 'Leah Roach', 'Iusto voluptatem quaerat non sed consequatur Et nisi asperiores necessitatibus sit fugit nulla adipisci rerum', '', 'CFC mall', '30.0361148', '31.420975099999964', 'Taha Hussein, القاهرة الجديدة، Cairo Governorate 11371, Egypt', '1970-01-01 12:00:00', '1970-01-01 10:00:00', 0, NULL, 'http://www.qilexywewaxi.me.uk', NULL, '22045345345', 'dikigeq@mailinator.net', '243', 1, 1, '2018-07-10 08:23:14', '2018-07-15 12:27:33', 1, 1),
(42, 'Test Edit Event', 'Test Edit Event', '', 'saqya ', '30.045915', '31.22429', NULL, '2018-06-29 18:00:00', '2018-06-29 21:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01227775312', 'salmaomario@yahoo.com', NULL, 1, 0, '2018-07-10 13:18:54', '2018-07-10 13:18:54', 36, NULL),
(43, 'big Event', 'Test Edit Event', '', 'saqya ', '30.045915', '31.22429', NULL, '2018-06-29 18:00:00', '2018-06-29 21:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01025113059', 'salmaomario@yahoo.com', NULL, 1, 0, '2018-07-10 13:57:45', '2018-07-10 13:57:45', 36, NULL),
(44, 'big Event', 'big band Event', '', 'cairo ', '30.045915', '31.22429', NULL, '2018-06-29 18:00:00', '2018-06-29 21:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01025113059', 'salmaomario@yahoo.com', NULL, 1, 0, '2018-07-10 14:46:52', '2018-07-10 14:46:52', 36, NULL),
(45, 'big Event', 'big band Event', '', 'cairo ', '30.045915', '31.22429', NULL, '2018-06-29 18:00:00', '2018-06-29 21:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01025113059', 'salmaomario@yahoo.com', NULL, 1, 0, '2018-07-15 13:45:30', '2018-07-15 13:45:30', 36, NULL),
(46, 'big summer Event', 'big band Event', '', 'cairo ', '30.045915', '31.22429', NULL, '2018-06-29 18:00:00', '2018-06-29 21:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01025113059', 'salmaomario@yahoo.com', NULL, 1, 0, '2018-07-15 13:46:18', '2018-07-15 13:46:18', 36, NULL),
(47, 'Fitzgerald Dunn', 'Enim qui atque voluptatem Et nobis velit quo dolor quia', '', 'the big show', '30.033784652534013', '31.440901746093687', '185 Moustafa Kamel Axis, Cairo Governorate, Egypt', '2019-10-15 12:00:00', '2020-02-15 00:00:00', 0, NULL, 'http://www.duja.ca', NULL, '6054545454', 'cuxu@mailinator.net', '409', 1, 1, '2018-07-15 13:48:16', '2018-07-15 13:48:16', 1, NULL),
(48, 'sumer dance Event', 'big band Event', '', 'cairo ', '30.045915', '31.22429', NULL, '2018-06-29 18:00:00', '2018-06-29 21:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01025113059', 'salmaomario@yahoo.com', NULL, 1, 0, '2018-07-15 15:52:52', '2018-07-15 15:52:52', 36, NULL),
(49, 'sumer dance Event', 'big band Event', '', 'cairo ', '30.045915', '31.22429', NULL, '1974-12-21 19:46:40', '2018-06-29 21:00:00', 1, 1, 'http://www.eventakom.com', '+20', '01025113059', 'salmaomario@yahoo.com', NULL, 1, 0, '2018-07-15 15:53:36', '2018-07-15 15:53:36', 36, NULL),
(50, 'Sybill Herrera', 'Ipsam excepteur veniam at eaque deleniti omnis veniam vel commodi nulla explicabo Sit eius a quasi omnis odit', '', 'CFC', '30.043146796311134', '31.42236231738275', 'Sint expedita ea impedit est', '2018-07-01 12:00:00', '2018-07-19 10:00:00', 0, NULL, 'http://www.wozelazosocabu.net', NULL, '472', 'saryrozulu@mailinator.com', '203', 1, 1, '2018-07-17 04:47:32', '2018-07-17 04:47:32', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_bookings`
--

DROP TABLE IF EXISTS `event_bookings`;
CREATE TABLE IF NOT EXISTS `event_bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `event_ticket_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_tickets` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_bookings`
--

INSERT INTO `event_bookings` (`id`, `event_id`, `event_ticket_id`, `name`, `number_of_tickets`, `created_at`, `created_by`, `user_id`) VALUES
(1, 8, 15, 'عمرو دياب', 22, '2018-04-12 13:27:22', NULL, 36),
(2, 8, 16, 'عمرو', 58, '2018-07-24 00:00:00', NULL, 44);

-- --------------------------------------------------------

--
-- Table structure for table `event_booking_tickets`
--

DROP TABLE IF EXISTS `event_booking_tickets`;
CREATE TABLE IF NOT EXISTS `event_booking_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_number` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_used` tinyint(1) DEFAULT NULL,
  `pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_booking_tickets`
--

INSERT INTO `event_booking_tickets` (`id`, `event_id`, `booking_id`, `barcode`, `serial_number`, `is_used`, `pdf`) VALUES
(1, 8, 1, '8888888888888888', '224', 0, NULL),
(2, 8, 2, '88888888888888887', '789', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_categories`
--

DROP TABLE IF EXISTS `event_categories`;
CREATE TABLE IF NOT EXISTS `event_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=252 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_categories`
--

INSERT INTO `event_categories` (`id`, `event_id`, `category_id`) VALUES
(46, 18, 4),
(47, 20, 5),
(48, 23, 6),
(49, 24, 7),
(50, 25, 8),
(51, 26, 9),
(55, 29, 11),
(56, 10, 12),
(57, 14, 13),
(58, 15, 4),
(59, 15, 5),
(60, 15, 11),
(61, 16, 4),
(62, 16, 5),
(63, 16, 11),
(67, 18, 4),
(68, 18, 5),
(69, 18, 11),
(70, 19, 4),
(71, 19, 5),
(72, 19, 11),
(73, 20, 4),
(74, 20, 5),
(75, 20, 11),
(76, 21, 4),
(77, 21, 5),
(78, 21, 11),
(88, 22, 4),
(89, 22, 5),
(90, 22, 11),
(97, 25, 4),
(98, 25, 5),
(99, 25, 11),
(100, 26, 4),
(101, 26, 5),
(102, 26, 11),
(115, 7, 4),
(116, 7, 5),
(117, 7, 11),
(132, 29, 4),
(155, 32, 4),
(162, 8, 4),
(163, 8, 5),
(164, 8, 7),
(165, 8, 11),
(166, 33, 4),
(167, 33, 6),
(168, 33, 7),
(169, 33, 8),
(175, 23, 4),
(176, 23, 5),
(177, 23, 11),
(184, 13, 4),
(185, 13, 5),
(186, 13, 11),
(187, 34, 4),
(188, 34, 5),
(189, 34, 11),
(190, 35, 4),
(191, 35, 5),
(192, 35, 11),
(193, 36, 4),
(194, 36, 5),
(195, 36, 11),
(196, 37, 4),
(197, 37, 5),
(198, 37, 11),
(199, 38, 4),
(200, 38, 5),
(201, 38, 11),
(202, 39, 4),
(203, 39, 5),
(204, 39, 11),
(205, 40, 5),
(206, 40, 7),
(209, 42, 4),
(210, 42, 5),
(211, 42, 11),
(212, 43, 4),
(213, 43, 5),
(214, 43, 11),
(215, 44, 4),
(216, 44, 5),
(217, 44, 11),
(218, 45, 4),
(219, 45, 5),
(220, 45, 11),
(221, 46, 4),
(222, 46, 5),
(223, 46, 11),
(224, 41, 4),
(225, 41, 5),
(226, 10, 4),
(227, 10, 5),
(228, 10, 11),
(229, 47, 7),
(230, 48, 4),
(231, 48, 5),
(232, 48, 11),
(233, 49, 4),
(234, 49, 5),
(235, 49, 11),
(236, 24, 5),
(237, 24, 6),
(238, 50, 6),
(239, 50, 9),
(240, 50, 11),
(241, 50, 12),
(243, 52, 7),
(244, 52, 8),
(245, 52, 11),
(246, 52, 12),
(247, 52, 13),
(248, 53, 6),
(249, 53, 7),
(250, 53, 8),
(251, 51, 4);

-- --------------------------------------------------------

--
-- Table structure for table `event_join_requests`
--

DROP TABLE IF EXISTS `event_join_requests`;
CREATE TABLE IF NOT EXISTS `event_join_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_accepted` tinyint(1) DEFAULT '0',
  `is_accepted_update` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_media`
--

DROP TABLE IF EXISTS `event_media`;
CREATE TABLE IF NOT EXISTS `event_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT 'type 1 => file - type 2 => video ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_owners`
--

DROP TABLE IF EXISTS `event_owners`;
CREATE TABLE IF NOT EXISTS `event_owners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_specializations`
--

DROP TABLE IF EXISTS `event_specializations`;
CREATE TABLE IF NOT EXISTS `event_specializations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `specialization_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_specializations`
--

INSERT INTO `event_specializations` (`id`, `event_id`, `specialization_id`) VALUES
(1, 8, 1),
(2, 13, 2),
(3, 19, 3);

-- --------------------------------------------------------

--
-- Table structure for table `event_tickets`
--

DROP TABLE IF EXISTS `event_tickets`;
CREATE TABLE IF NOT EXISTS `event_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Main',
  `price` decimal(10,2) DEFAULT NULL,
  `available_tickets` int(11) DEFAULT NULL,
  `current_available_tickets` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_tickets`
--

INSERT INTO `event_tickets` (`id`, `event_id`, `name`, `price`, `available_tickets`, `current_available_tickets`, `currency_id`) VALUES
(1, 1, 'VIP', '850.00', 2000, NULL, 1),
(2, 1, 'Gold', '500.00', 1500, NULL, 2),
(3, 2, 'VIP', '850.00', 2000, NULL, 1),
(4, 2, 'Gold', '500.00', 1500, NULL, 2),
(5, 3, 'VIP', '850.00', 2000, NULL, 1),
(6, 3, 'Gold', '500.00', 1500, NULL, 2),
(7, 4, 'VIP', '850.00', 2000, NULL, 1),
(8, 4, 'Gold', '500.00', 1500, NULL, 2),
(9, 5, 'VIP', '850.00', 2000, NULL, 1),
(10, 5, 'Gold', '500.00', 1500, NULL, 2),
(11, 6, 'VIP', '850.00', 2000, NULL, 1),
(12, 6, 'Gold', '500.00', 1500, NULL, 2),
(13, 7, 'VIP', '850.00', 2000, 2000, 1),
(14, 7, 'Gold', '500.00', 1500, 1500, 2),
(15, 8, 'VIP', '850.00', 2000, 2000, 1),
(16, 8, 'Gold', '500.00', 1500, 1500, 2),
(17, 9, 'VIP', '850.00', 2000, 2000, 1),
(18, 9, 'Gold', '500.00', 1500, 1500, 2),
(19, 10, 'VIP', '850.00', 2000, 2000, 1),
(20, 10, 'Gold', '500.00', 1500, 1500, 2),
(21, 11, 'VIP', '850.00', 2000, 2000, 1),
(22, 11, 'Gold', '500.00', 1500, 1500, 2),
(23, 12, 'VIP', '850.00', 2000, 2000, 1),
(24, 12, 'Gold', '500.00', 1500, 1500, 2),
(25, 13, 'VIP', '850.00', 2000, 2000, 1),
(26, 13, 'Gold', '500.00', 1500, 1500, 2),
(27, 14, 'VIP', '850.00', 2000, 2000, 1),
(28, 14, 'Gold', '500.00', 1500, 1500, 2),
(29, 15, 'VIP', '850.00', 2000, 2000, 1),
(30, 15, 'Gold', '500.00', 1500, 1500, 2),
(31, 16, 'VIP', '850.00', 2000, 2000, 1),
(32, 16, 'Gold', '500.00', 1500, 1500, 2),
(35, 18, 'VIP', '850.00', 2000, 2000, 1),
(36, 18, 'Gold', '500.00', 1500, 1500, 2),
(37, 19, 'VIP', '850.00', 2000, 2000, 1),
(38, 19, 'Gold', '500.00', 1500, 1500, 2),
(39, 20, 'VIP', '850.00', 2000, 2000, 1),
(40, 20, 'Gold', '500.00', 1500, 1500, 2),
(41, 21, 'VIP', '850.00', 2000, 2000, 1),
(42, 21, 'Gold', '500.00', 1500, 1500, 2),
(43, 22, 'VIP', '850.00', 2000, 2000, 1),
(44, 22, 'Gold', '500.00', 1500, 1500, 2),
(45, 23, 'VIP', '850.00', 2000, 2000, 1),
(46, 23, 'Gold', '500.00', 1500, 1500, 2),
(47, 24, 'VIP', '850.00', 2000, 2000, 1),
(48, 24, 'Gold', '500.00', 1500, 1500, 2),
(49, 25, 'VIP', '850.00', 2000, 2000, 1),
(50, 25, 'Gold', '500.00', 1500, 1500, 2),
(51, 26, 'VIP', '850.00', 2000, 2000, 1),
(52, 26, 'Gold', '500.00', 1500, 1500, 2),
(53, 27, 'Mia Ratliff', '761.00', 958, 958, 17),
(54, 28, 'Mia Ratliff', '761.00', 958, 958, 17),
(55, 29, 'Jaddal', '819.00', 696, 696, 2),
(56, 30, 'Maxine Hall', '194.00', 783, 783, 28),
(57, 31, 'Megan Finch', '754.00', 909, 909, 3),
(58, 32, 'Samson Hutchinson', '201.00', 337, 337, 29),
(59, 34, 'VIP', '850.00', 2000, 2000, 1),
(60, 34, 'Gold', '500.00', 1500, 1500, 2),
(61, 35, 'VIP', '850.00', 2000, 2000, 1),
(62, 35, 'Gold', '500.00', 1500, 1500, 2),
(63, 36, 'VIP', '850.00', 2000, 2000, 1),
(64, 36, 'Gold', '500.00', 1500, 1500, 2),
(65, 38, 'VIP', '850.00', 2000, 2000, 1),
(66, 38, 'Gold', '500.00', 1500, 1500, 2),
(67, 39, 'VIP', '850.00', 2000, 2000, 1),
(68, 39, 'Gold', '500.00', 1500, 1500, 2),
(69, 42, 'VIP', '850.00', 2000, 2000, 1),
(70, 42, 'Gold', '500.00', 1500, 1500, 2),
(71, 43, 'VIP', '850.00', 2000, 2000, 1),
(72, 43, 'Gold', '500.00', 1500, 1500, 2),
(73, 44, 'VIP', '850.00', 2000, 2000, 1),
(74, 44, 'Gold', '500.00', 1500, 1500, 2),
(75, 45, 'VIP', '850.00', 2000, 2000, 1),
(76, 45, 'Gold', '500.00', 1500, 1500, 2),
(77, 46, 'VIP', '850.00', 2000, 2000, 1),
(78, 46, 'Gold', '500.00', 1500, 1500, 2),
(79, 48, 'VIP', '850.00', 2000, 2000, 1),
(80, 48, 'Gold', '500.00', 1500, 1500, 2),
(81, 49, 'VIP', '850.00', 2000, 2000, 1),
(82, 49, 'Gold', '500.00', 1500, 1500, 2);

-- --------------------------------------------------------

--
-- Table structure for table `event_workshops`
--

DROP TABLE IF EXISTS `event_workshops`;
CREATE TABLE IF NOT EXISTS `event_workshops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `work_shop_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fixed_pages`
--

DROP TABLE IF EXISTS `fixed_pages`;
CREATE TABLE IF NOT EXISTS `fixed_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `body` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fixed_pages`
--

INSERT INTO `fixed_pages` (`id`, `name`, `body`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, 'About Us', '<h1>About Eventakom</h1>\r\n<p style=\"text-align: left;\">Eventakom aims to make any events reachable to you.</p>', '2018-05-03 12:51:40', '2018-06-25 07:00:17', 1),
(2, 'Terms and Conditions', '<h2 style=\"text-align: left;\">Terms and Conditions:<br /><span class=\"s1\" style=\"letter-spacing: 0.8px;\"></span></h2>\r\n<p style=\"text-align: left;\">1- The website is not responsible for any personal info that you publish</p>', '2018-05-03 12:52:13', '2018-06-25 07:05:05', 1),
(3, 'Privacy and Policy', '<h2>Privacy and Policy:</h2>\r\n<p style=\"text-align: left;\">1- Your privacy is your responsibility.&nbsp;</p>', '2018-05-03 12:52:28', '2018-06-25 07:07:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

DROP TABLE IF EXISTS `genders`;
CREATE TABLE IF NOT EXISTS `genders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `name`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `geo_cities`
--

DROP TABLE IF EXISTS `geo_cities`;
CREATE TABLE IF NOT EXISTS `geo_cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `application_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `geo_cities`
--

INSERT INTO `geo_cities` (`id`, `name`, `code`, `latitude`, `longitude`, `country_id`, `application_id`) VALUES
(1, 'Ryad', NULL, '24.77426500', '46.73858600', 195, 1),
(2, 'Makka', NULL, '21.42251000', '39.82616800', 195, 1),
(3, 'Madinah', NULL, '24.47090100', '39.61223600', 195, 1),
(4, 'Qussem', NULL, '26.09408800', '43.97345400', 195, 1),
(5, 'Sharqia', NULL, '19.10714500', '50.11123300', 195, 1),
(6, 'Qasser', NULL, '18.21679700', '42.50376500', 195, 1),
(7, 'Tabouk', NULL, '28.38350000', '36.56620000', 195, 1),
(8, 'Hael', NULL, '27.52364700', '41.69663200', 195, 1),
(9, 'North Borders', NULL, '29.72490000', '42.23620000', 195, 1),
(10, 'Gazran', NULL, '16.90968300', '42.56790200', 195, 1),
(11, 'Najran', NULL, '17.56560000', '44.22890000', 195, 1),
(12, 'Baha', NULL, '20.02170000', '41.47130000', 195, 1),
(13, 'Gouf', NULL, '29.88740000', '39.32060000', 195, 1),
(14, 'Cairo', NULL, NULL, NULL, 66, 1),
(15, 'Alexandria', NULL, NULL, NULL, 66, 1),
(16, 'Mansoura', NULL, NULL, NULL, 66, 1),
(17, 'Tanta', NULL, NULL, NULL, 66, 1),
(18, 'Assuit', NULL, NULL, NULL, 66, 1),
(19, 'Aswar', NULL, NULL, NULL, 66, 1),
(20, 'Luxor', NULL, NULL, NULL, 66, 1),
(21, 'Hurghada', NULL, NULL, NULL, 66, 1),
(22, 'Sharm El Sheikh', NULL, NULL, NULL, 66, 1),
(23, 'Port Said ', NULL, NULL, NULL, 66, 1),
(24, 'Ismailia', NULL, NULL, NULL, 66, 1);

-- --------------------------------------------------------

--
-- Table structure for table `geo_countries`
--

DROP TABLE IF EXISTS `geo_countries`;
CREATE TABLE IF NOT EXISTS `geo_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iso_code` varchar(44) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iso_code_alpha3` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tele_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `continent_id` int(11) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `geo_countries`
--

INSERT INTO `geo_countries` (`id`, `name`, `iso_code`, `iso_code_alpha3`, `tele_code`, `timezone`, `continent_id`, `is_default`) VALUES
(1, 'Afghanistan', 'AF', NULL, '+93', '+02:00', NULL, 0),
(2, 'Åland Islands', 'AX', NULL, NULL, '+02:00', NULL, 0),
(3, 'Albania', 'AL', NULL, '+355', '+02:00', NULL, 0),
(4, 'Algeria', 'DZ', NULL, '+213', '+2:00', NULL, 0),
(5, 'American Samoa', 'AS', NULL, '+1-684', '+02:00', NULL, 0),
(6, 'Andorra', 'AD', NULL, '+376', '+02:00', NULL, 0),
(7, 'Angola', 'AO', NULL, '+244', '+02:00', NULL, 0),
(8, 'Anguilla', 'AI', NULL, '+1-264', '+02:00', NULL, 0),
(9, 'Antarctica', 'AQ', NULL, '+672', '+02:00', NULL, 0),
(10, 'Antigua and Barbuda', 'AG', NULL, '+1-268', '+02:00', NULL, 0),
(11, 'Argentina', 'AR', NULL, '+54', '+02:00', NULL, 0),
(12, 'Armenia', 'AM', NULL, '+374', '+02:00', NULL, 0),
(13, 'Aruba', 'AW', NULL, '+297', '+02:00', NULL, 0),
(14, 'Australia', 'AU', NULL, '+61', '+02:00', NULL, 0),
(15, 'Austria', 'AT', NULL, '+43', '+02:00', NULL, 0),
(16, 'Azerbaijan', 'AZ', NULL, '+994', '+02:00', NULL, 0),
(17, 'Bahrain', 'BH', NULL, '+973', '+02:00', NULL, 0),
(18, 'Bahamas', 'BS', NULL, '+1-242', '+02:00', NULL, 0),
(19, 'Bangladesh', 'BD', NULL, '+880', '+02:00', NULL, 0),
(20, 'Barbados', 'BB', NULL, '+1-246', '+02:00', NULL, 0),
(21, 'Belarus', 'BY', NULL, '+375', '+01:00', NULL, 0),
(22, 'Belgium', 'BE', NULL, '+32', '+02:00', NULL, 0),
(23, 'Belize', 'BZ', NULL, '+501', '+02:00', NULL, 0),
(24, 'Benin', 'BJ', NULL, '+229', '+02:00', NULL, 0),
(25, 'Bermuda', 'BM', NULL, '+1-441', '+02:00', NULL, 0),
(26, 'Bhutan', 'BT', NULL, '+975', '+02:00', NULL, 0),
(27, 'Bolivia, Plurinational State of', 'BO', NULL, '+591', '+02:00', NULL, 0),
(28, 'Bonaire, Sint Eustatius and Saba', 'BQ', NULL, '+387', '+02:00', NULL, 0),
(29, 'Bosnia and Herzegovina', 'BA', NULL, '+267', '+02:00', NULL, 0),
(30, 'Botswana', 'BW', NULL, '', '+02:00', NULL, 0),
(31, 'Bouvet Island', 'BV', NULL, '+55', '+02:00', NULL, 0),
(32, 'Brazil', 'BR', NULL, '', '+02:00', NULL, 0),
(33, 'British Indian Ocean Territory', 'IO', NULL, '+673', '+02:00', NULL, 0),
(34, 'Brunei Darussalam', 'BN', NULL, '+359', '+02:00', NULL, 0),
(35, 'Bulgaria', 'BG', NULL, '+226', '+02:00', NULL, 0),
(36, 'Burkina Faso', 'BF', NULL, '+257', '+02:00', NULL, 0),
(37, 'Burundi', 'BI', NULL, NULL, '+02:00', NULL, 0),
(38, 'Cambodia', 'KH', NULL, '+855', '+02:00', NULL, 0),
(39, 'Cameroon', 'CM', NULL, '+237', '+02:00', NULL, 0),
(40, 'Canada', 'CA', NULL, '+1', '+02:00', NULL, 0),
(41, 'Cape Verde', 'CV', NULL, '+238', '+02:00', NULL, 0),
(42, 'Cayman Islands', 'KY', NULL, '+1-345', '+02:00', NULL, 0),
(43, 'Central African Republic', 'CF', NULL, '+236', '+02:00', NULL, 0),
(44, 'Chad', 'TD', NULL, '+235', '+02:00', NULL, 0),
(45, 'Chile', 'CL', NULL, '+56', '+02:00', NULL, 0),
(46, 'China', 'CN', NULL, '+86', '+02:00', NULL, 0),
(47, 'Christmas Island', 'CX', NULL, '+53', '+02:00', NULL, 0),
(48, 'Cocos (Keeling) Islands', 'CC', NULL, '+61', '+02:00', NULL, 0),
(49, 'Colombia', 'CO', NULL, '+57', '+02:00', NULL, 0),
(50, 'Comoros', 'KM', NULL, '+269', '+02:00', NULL, 0),
(51, 'Congo', 'CG', NULL, '+243', '+02:00', NULL, 0),
(52, 'Congo, the Democratic Republic of the', 'CD', NULL, '+242', '+02:00', NULL, 0),
(53, 'Cook Islands', 'CK', NULL, '+682', '+02:00', NULL, 0),
(54, 'Costa Rica', 'CR', NULL, '+506', '+05:30', NULL, 0),
(55, 'Côte d\'Ivoire', 'CI', NULL, '+225', '+01:00', NULL, 0),
(56, 'Croatia', 'HR', NULL, '+385', '+02:00', NULL, 0),
(57, 'Cuba', 'CU', NULL, '+53', '+02:00', NULL, 0),
(58, 'Curaçao', 'CW', NULL, NULL, '+02:00', NULL, 0),
(59, 'Cyprus', 'CY', NULL, '+855', '+02:00', NULL, 0),
(60, 'Czech Republic', 'CZ', NULL, '+237', '+02:00', NULL, 0),
(61, 'Denmark', 'DK', NULL, '+45', '+02:00', NULL, 0),
(62, 'Djibouti', 'DJ', NULL, '+253', '+02:00', NULL, 0),
(63, 'Dominica', 'DM', NULL, '+1-767', '+01:00', NULL, 0),
(64, 'Dominican Republic', 'DO', NULL, '+1-809', '+02:00', NULL, 0),
(65, 'Ecuador', 'EC', NULL, '+593 ', '+02:00', NULL, 0),
(66, 'Egypt', 'EG', NULL, '+20', '+02:00', NULL, 0),
(67, 'El Salvador', 'SV', NULL, '+503', '+02:00', NULL, 0),
(68, 'Equatorial Guinea', 'GQ', NULL, '+240', '+02:00', NULL, 0),
(69, 'Eritrea', 'ER', NULL, '+291', '+02:00', NULL, 0),
(70, 'Estonia', 'EE', NULL, '+372', '+02:00', NULL, 0),
(71, 'Ethiopia', 'ET', NULL, '+251', '+02:00', NULL, 0),
(72, 'Falkland Islands (Malvinas)', 'FK', NULL, '+500', '+02:00', NULL, 0),
(73, 'Faroe Islands', 'FO', NULL, '+298', '+02:00', NULL, 0),
(74, 'Fiji', 'FJ', NULL, '+679', '+02:00', NULL, 0),
(75, 'Finland', 'FI', NULL, '+358', '+02:00', NULL, 0),
(76, 'France', 'FR', NULL, '+33', '+02:00', NULL, 0),
(77, 'French Guiana', 'GF', NULL, '+594', '+02:00', NULL, 0),
(78, 'French Polynesia', 'PF', NULL, '+689', '+02:00', NULL, 0),
(79, 'French Southern Territories', 'TF', NULL, NULL, '+02:00', NULL, 0),
(80, 'Gabon', 'GA', NULL, '+241', '+01:00', NULL, 0),
(81, 'Gambia', 'GM', NULL, '+220', '+02:00', NULL, 0),
(82, 'Georgia', 'GE', NULL, '+995', '+02:00', NULL, 0),
(83, 'Germany', 'DE', NULL, '+49', '+02:00', NULL, 0),
(84, 'Ghana', 'GH', NULL, '+233', '+02:00', NULL, 0),
(85, 'Gibraltar', 'GI', NULL, NULL, '+02:00', NULL, 0),
(86, 'Greece', 'GR', NULL, '+30', '+02:00', NULL, 0),
(87, 'Greenland', 'GL', NULL, '+299', '+02:00', NULL, 0),
(88, 'Grenada', 'GD', NULL, '+1-473', '+02:00', NULL, 0),
(89, 'Guadeloupe', 'GP', NULL, '+590', '+02:00', NULL, 0),
(90, 'Guam', 'GU', NULL, '+1-671', '+02:00', NULL, 0),
(91, 'Guatemala', 'GT', NULL, '+502', '+02:00', NULL, 0),
(92, 'Guernsey', 'GG', NULL, NULL, '+02:00', NULL, 0),
(93, 'Guinea', 'GN', NULL, '+224', '+02:00', NULL, 0),
(94, 'Guinea-Bissau', 'GW', NULL, '+245', '+02:00', NULL, 0),
(95, 'Guyana', 'GY', NULL, '+592', '+02:00', NULL, 0),
(96, 'Haiti', 'HT', NULL, '+509', '+02:00', NULL, 0),
(97, 'Heard Island and McDonald Islands', 'HM', NULL, '', '+02:00', NULL, 0),
(98, 'Holy See (Vatican City State)', 'VA', NULL, '', '+02:00', NULL, 0),
(99, 'Honduras', 'HN', NULL, '+504', '+02:00', NULL, 0),
(100, 'Hong Kong', 'HK', NULL, '+852', '+02:00', NULL, 0),
(101, 'Hungary', 'HU', NULL, '+36', '+02:00', NULL, 0),
(102, 'Iceland', 'IS', NULL, '+354', '+02:00', NULL, 0),
(103, 'India', 'IN', NULL, '+91', '+02:00', NULL, 0),
(104, 'Indonesia', 'ID', NULL, '+62', '+02:00', NULL, 0),
(105, 'Iran, Islamic Republic of', 'IR', NULL, '+98', '+02:00', NULL, 0),
(106, 'Iraq', 'IQ', NULL, '+964', '+02:00', NULL, 0),
(107, 'Ireland', 'IE', NULL, '+353', '+02:00', NULL, 0),
(108, 'Isle of Man', 'IM', NULL, NULL, '+02:00', NULL, 0),
(109, 'Israel', 'IL', NULL, '+972', '+02:00', NULL, 0),
(110, 'Italy', 'IT', NULL, '+39', '+02:00', NULL, 0),
(111, 'Jamaica', 'JM', NULL, '+1-876', '+02:00', NULL, 0),
(112, 'Japan', 'JP', NULL, '+81', '+02:00', NULL, 0),
(113, 'Jersey', 'JE', NULL, NULL, '+02:00', NULL, 0),
(114, 'Jordan', 'JO', NULL, '+962', '+02:00', NULL, 0),
(115, 'Kazakhstan', 'KZ', NULL, '+7', '+02:00', NULL, 0),
(116, 'Kenya', 'KE', NULL, '+254', '+02:00', NULL, 0),
(117, 'Kiribati', 'KI', NULL, '+686', '+02:00', NULL, 0),
(118, 'Korea, Democratic People\'s Republic of', 'KP', NULL, '+850', '+02:00', NULL, 0),
(119, 'Korea, Republic of', 'KR', NULL, '+82', '+02:00', NULL, 0),
(120, 'Kuwait', 'KW', NULL, '+965', '+02:00', NULL, 0),
(121, 'Kyrgyzstan', 'KG', NULL, '+996', '+02:00', NULL, 0),
(122, 'Lao People\'s Democratic Republic', 'LA', NULL, '+856', '+02:00', NULL, 0),
(123, 'Latvia', 'LV', NULL, '+371', '+02:00', NULL, 0),
(124, 'Lebanon', 'LB', NULL, '+961', '+02:00', NULL, 0),
(125, 'Lesotho', 'LS', NULL, '+266', '+02:00', NULL, 0),
(126, 'Liberia', 'LR', NULL, '+231', '+02:00', NULL, 0),
(127, 'Libya', 'LY', NULL, '+218', '+02:00', NULL, 0),
(128, 'Liechtenstein', 'LI', NULL, '+423', '+02:00', NULL, 0),
(129, 'Lithuania', 'LT', NULL, '+370', '+02:00', NULL, 0),
(130, 'Luxembourg', 'LU', NULL, '+352', '+02:00', NULL, 0),
(131, 'Macao', 'MO', NULL, '+853', '+02:00', NULL, 0),
(132, 'Macedonia, the Former Yugoslav Republic of', 'MK', NULL, '+389', '+02:00', NULL, 0),
(133, 'Madagascar', 'MG', NULL, '+261', '+02:00', NULL, 0),
(134, 'Malawi', 'MW', NULL, '+265', '+02:00', NULL, 0),
(135, 'Malaysia', 'MY', NULL, '+60', '+02:00', NULL, 0),
(136, 'Maldives', 'MV', NULL, '+960', '+02:00', NULL, 0),
(137, 'Mali', 'ML', NULL, '+223', '+02:00', NULL, 0),
(138, 'Malta', 'MT', NULL, '+356', '+02:00', NULL, 0),
(139, 'Marshall Islands', 'MH', NULL, '+692', '+02:00', NULL, 0),
(140, 'Martinique', 'MQ', NULL, '+596', '+02:00', NULL, 0),
(141, 'Mauritania', 'MR', NULL, '+222', '+02:00', NULL, 0),
(142, 'Mauritius', 'MU', NULL, '+230', '+02:00', NULL, 0),
(143, 'Mayotte', 'YT', NULL, '+269', '+02:00', NULL, 0),
(144, 'Mexico', 'MX', NULL, '+52', '+02:00', NULL, 0),
(145, 'Micronesia, Federated States of', 'FM', NULL, '+691', '+01:00', NULL, 0),
(146, 'Moldova, Republic of', 'MD', NULL, '+373', '+02:00', NULL, 0),
(147, 'Monaco', 'MC', NULL, '+377', '+02:00', NULL, 0),
(148, 'Mongolia', 'MN', NULL, '+976', '+02:00', NULL, 0),
(149, 'Montenegro', 'ME', NULL, NULL, '+02:00', NULL, 0),
(150, 'Montserrat', 'MS', NULL, '+1-664', '+01:00', NULL, 0),
(151, 'Morocco', 'MA', NULL, '+212', '+02:00', NULL, 0),
(152, 'Mozambique', 'MZ', NULL, '+258', '+02:00', NULL, 0),
(153, 'Myanmar', 'MM', NULL, '+95', '+02:00', NULL, 0),
(154, 'Namibia', 'NA', NULL, '+264', '+02:00', NULL, 0),
(155, 'Nauru', 'NR', NULL, '+674', '+02:00', NULL, 0),
(156, 'Nepal', 'NP', NULL, '+977', '+02:00', NULL, 0),
(157, 'Netherlands', 'NL', NULL, '+31', '+02:00', NULL, 0),
(158, 'New Caledonia', 'NC', NULL, '+687', '+02:00', NULL, 0),
(159, 'New Zealand', 'NZ', NULL, '+64', '+02:00', NULL, 0),
(160, 'Nicaragua', 'NI', NULL, '+505', '+02:00', NULL, 0),
(161, 'Niger', 'NE', NULL, '+227', '+02:00', NULL, 0),
(162, 'Nigeria', 'NG', NULL, '+234', '+02:00', NULL, 0),
(163, 'Niue', 'NU', NULL, '+683', '+02:00', NULL, 0),
(164, 'Norfolk Island', 'NF', NULL, '+672', '+02:00', NULL, 0),
(165, 'Northern Mariana Islands', 'MP', NULL, '+1-670', '+02:00', NULL, 0),
(166, 'Norway', 'NO', NULL, '+47', '+02:00', NULL, 0),
(167, 'Oman', 'OM', NULL, '+968', '+02:00', NULL, 0),
(168, 'Pakistan', 'PK', NULL, '+92', '+02:00', NULL, 0),
(169, 'Palau', 'PW', NULL, '+680', '+02:00', NULL, 0),
(170, 'Palestine, State of', 'PS', NULL, '+970', '+02:00', NULL, 0),
(171, 'Panama', 'PA', NULL, '+507', '+01:00', NULL, 0),
(172, 'Papua New Guinea', 'PG', NULL, '+675', '+02:00', NULL, 0),
(173, 'Paraguay', 'PY', NULL, '+595', '+02:00', NULL, 0),
(174, 'Peru', 'PE', NULL, '+51', '+02:00', NULL, 0),
(175, 'Philippines', 'PH', NULL, '+63', '+02:00', NULL, 0),
(176, 'Pitcairn', 'PN', NULL, '', '+02:00', NULL, 0),
(177, 'Poland', 'PL', NULL, '+48', '+02:00', NULL, 0),
(178, 'Portugal', 'PT', NULL, '+351', '+02:00', NULL, 0),
(179, 'Puerto Rico', 'PR', NULL, '+1-787 or +1-939', '+02:00', NULL, 0),
(180, 'Qatar', 'QA', NULL, '+974 ', '+02:00', NULL, 0),
(181, 'Réunion', 'RE', NULL, '+262', '+02:00', NULL, 0),
(182, 'Romania', 'RO', NULL, '+40', '+02:00', NULL, 0),
(183, 'Russian Federation', 'RU', NULL, '+7', '+02:00', NULL, 0),
(184, 'Rwanda', 'RW', NULL, '+250', '+02:00', NULL, 0),
(185, 'Saint Barthélemy', 'BL', NULL, NULL, '+02:00', NULL, 0),
(186, 'Saint Helena, Ascension and Tristan da Cunha', 'SH', NULL, NULL, '+02:00', NULL, 0),
(187, 'Saint Kitts and Nevis', 'KN', NULL, NULL, '+02:00', NULL, 0),
(188, 'Saint Lucia', 'LC', NULL, NULL, '+02:00', NULL, 0),
(189, 'Saint Martin (French part)', 'MF', NULL, NULL, '+02:00', NULL, 0),
(190, 'Saint Pierre and Miquelon', 'PM', NULL, NULL, '+02:00', NULL, 0),
(191, 'Saint Vincent and the Grenadines', 'VC', NULL, NULL, '+02:00', NULL, 0),
(192, 'Samoa', 'WS', NULL, NULL, '+02:00', NULL, 0),
(193, 'San Marino', 'SM', NULL, NULL, '+02:00', NULL, 0),
(194, 'Sao Tome and Principe', 'ST', NULL, NULL, '+02:00', NULL, 0),
(195, 'Saudi Arabia', 'SA', NULL, '+966', '+02:00', NULL, 0),
(196, 'Senegal', 'SN', NULL, NULL, '+02:00', NULL, 0),
(197, 'Serbia', 'RS', NULL, NULL, '+02:00', NULL, 0),
(198, 'Seychelles', 'SC', NULL, NULL, '+02:00', NULL, 0),
(199, 'Sierra Leone', 'SL', NULL, NULL, '+02:00', NULL, 0),
(200, 'Singapore', 'SG', NULL, NULL, '+02:00', NULL, 0),
(201, 'Sint Maarten (Dutch part)', 'SX', NULL, NULL, '+02:00', NULL, 0),
(202, 'Slovakia', 'SK', NULL, NULL, '+02:00', NULL, 0),
(203, 'Slovenia', 'SI', NULL, NULL, '+02:00', NULL, 0),
(204, 'Solomon Islands', 'SB', NULL, NULL, '+02:00', NULL, 0),
(205, 'Somalia', 'SO', NULL, NULL, '+02:00', NULL, 0),
(206, 'South Africa', 'ZA', NULL, NULL, '+02:00', NULL, 0),
(207, 'South Georgia and the South Sandwich Islands', 'GS', NULL, NULL, '+02:00', NULL, 0),
(208, 'South Sudan', 'SS', NULL, NULL, '+02:00', NULL, 0),
(209, 'Spain', 'ES', NULL, '+34', '+02:00', NULL, 0),
(210, 'Sri Lanka', 'LK', NULL, '+94', '+02:00', NULL, 0),
(211, 'Sudan', 'SD', NULL, '+249', '+02:00', NULL, 0),
(212, 'Suriname', 'SR', NULL, NULL, '+02:00', NULL, 0),
(213, 'Svalbard and Jan Mayen', 'SJ', NULL, NULL, '+02:00', NULL, 0),
(214, 'Swaziland', 'SZ', NULL, NULL, '+02:00', NULL, 0),
(215, 'Sweden', 'SE', NULL, '+46', '+02:00', NULL, 0),
(216, 'Switzerland', 'CH', NULL, '+41', '+02:00', NULL, 0),
(217, 'Syrian Arab Republic', 'SY', NULL, '+963', '+02:00', NULL, 0),
(218, 'Taiwan, Province of China', 'TW', NULL, '+886', '+02:00', NULL, 0),
(219, 'Tajikistan', 'TJ', NULL, '+992', '+02:00', NULL, 0),
(220, 'Tanzania, United Republic of', 'TZ', NULL, '+255', '+02:00', NULL, 0),
(221, 'Thailand', 'TH', NULL, '+66', '+02:00', NULL, 0),
(222, 'Timor-Leste', 'TL', NULL, NULL, '+02:00', NULL, 0),
(223, 'Togo', 'TG', NULL, NULL, '+02:00', NULL, 0),
(224, 'Tokelau', 'TK', NULL, '+690', '+02:00', NULL, 0),
(225, 'Tonga', 'TO', NULL, '+676', '+02:00', NULL, 0),
(226, 'Trinidad and Tobago', 'TT', NULL, '+1-868', '+02:00', NULL, 0),
(227, 'Tunisia', 'TN', NULL, '+216', '+02:00', NULL, 0),
(228, 'Turkey', 'TR', NULL, '+90', '+02:00', NULL, 0),
(229, 'Turkmenistan', 'TM', NULL, '+993', '+02:00', NULL, 0),
(230, 'Turks and Caicos Islands', 'TC', NULL, '+1-649', '+08:00', NULL, 0),
(231, 'Tuvalu', 'TV', NULL, '+688', '+02:00', NULL, 0),
(232, 'Uganda', 'UG', NULL, '+256', '+02:00', NULL, 0),
(233, 'Ukraine', 'UA', NULL, '+380', '+02:00', NULL, 0),
(234, 'United Arab Emirates', 'AE', NULL, '+971', '+02:00', NULL, 0),
(235, 'United Kingdom', 'GB', NULL, '+44', '+02:00', NULL, 0),
(236, 'United States', 'US', NULL, '+1', '+02:00', NULL, 0),
(237, 'United States Minor Outlying Islands', 'UM', NULL, '+1', '+02:00', NULL, 0),
(238, 'Uruguay', 'UY', NULL, '+598', '+02:00', NULL, 0),
(239, 'Uzbekistan', 'UZ', NULL, '+998', '+02:00', NULL, 0),
(240, 'Vanuatu', 'VU', NULL, '+678', '+02:00', NULL, 0),
(241, 'Venezuela, Bolivarian Republic of', 'VE', NULL, '+58', '+01:00', NULL, 0),
(242, 'Viet Nam', 'VN', NULL, '+84', '+05:00', NULL, 0),
(243, 'Virgin Islands, British', 'VG', NULL, '+1-284', '+02:00', NULL, 0),
(244, 'Virgin Islands, U.S.', 'VI', NULL, '+1-340', '+05:00', NULL, 0),
(245, 'Wallis and Futuna', 'WF', NULL, '+681', '+02:00', NULL, 0),
(246, 'Western Sahara', 'EH', NULL, NULL, '+02:00', NULL, 0),
(247, 'Yemen', 'YE', NULL, '+967', '+03:00', NULL, 0),
(248, 'Zambia', 'ZM', NULL, '+260', '+02:00', NULL, 0),
(249, 'Zimbabwe', 'ZW', NULL, '+263', '+05:00', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `geo_regions`
--

DROP TABLE IF EXISTS `geo_regions`;
CREATE TABLE IF NOT EXISTS `geo_regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `application_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `geo_regions`
--

INSERT INTO `geo_regions` (`id`, `name`, `city_id`, `application_id`) VALUES
(1, 'Ryad', 195, 1),
(2, 'Makka', 195, 1),
(3, 'Madinah', 195, 1),
(4, 'Qussem', 195, 1),
(5, 'Sharqia', 195, 1),
(6, 'Qasser', 195, 1),
(7, 'Tabouk', 195, 1),
(8, 'Hael', 195, 1),
(9, 'North Borders', 195, 1),
(10, 'Gazran', 195, 1),
(11, 'Najran', 195, 1),
(12, 'Baha', 195, 1),
(13, 'Gouf', 195, 1),
(14, 'Cairo', 66, 1),
(15, 'Alexandria', 66, 1),
(16, 'Mansoura', 66, 1),
(17, 'Tanta', 66, 1),
(18, 'Assuit', 66, 1),
(19, 'Aswar', 66, 1),
(20, 'Luxor', 66, 1),
(21, 'Hurghada', 66, 1),
(22, 'Sharm El Sheikh', 66, 1),
(23, 'Port Said ', 66, 1),
(24, 'Ismailia', 66, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` varchar(255) DEFAULT NULL,
  `msg_ar` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `description_ar` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `notification_type_id` int(11) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `is_sent` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `schedule` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `msg`, `msg_ar`, `description`, `description_ar`, `user_id`, `entity_id`, `item_id`, `notification_type_id`, `is_read`, `is_sent`, `created_at`, `schedule`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications_push`
--

DROP TABLE IF EXISTS `notifications_push`;
CREATE TABLE IF NOT EXISTS `notifications_push` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_id` int(11) DEFAULT NULL,
  `device_token` varchar(255) DEFAULT NULL,
  `mobile_os` varchar(255) DEFAULT NULL,
  `lang_id` tinyint(1) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notification_types`
--

DROP TABLE IF EXISTS `notification_types`;
CREATE TABLE IF NOT EXISTS `notification_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `msg` varchar(255) DEFAULT NULL,
  `msg_ar` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `description_ar` varchar(255) DEFAULT NULL,
  `is_push` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification_types`
--

INSERT INTO `notification_types` (`id`, `name`, `msg`, `msg_ar`, `description`, `description_ar`, `is_push`) VALUES
(1, 'User Activated', 'Your account is activated mobile {mob} password {pass}', 'تم تفعيل حسابك  موبيل 0م0  كلمة السر 0س0', NULL, NULL, 1),
(2, 'User Not Activated', 'Your account cannot be activated for this reason {txt}', 'لم يتم تفعيل حسابم لهذا السبب 00', NULL, NULL, 1),
(3, 'Doctor Account Added', 'Your Profile Added to Tabib Events App. mobile :  {mob} password : {pass}', 'تم انشاء حساب جديد في طبيب ايفينت  موبيل: 0م0 - كلمة السر 0س0', 'Your profile added to  Tabyeb Event application, Please review and update it and send it again to us', NULL, 1),
(4, 'New Survey Added', 'New Survey Added', 'New Survey Added', NULL, NULL, 1),
(5, 'notifications', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
CREATE TABLE IF NOT EXISTS `offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `number_of_views` int(11) DEFAULT '0',
  `number_of_calls` int(11) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '0',
  `sponsor_id` int(11) DEFAULT '0',
  `rating_avg` float(11,0) DEFAULT '0',
  `total_number_of_ratings` int(11) DEFAULT '0',
  `total_sum_ratings` int(11) DEFAULT '0',
  `start_datetime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `end_datetime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `updated_by` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `name`, `description`, `image`, `number_of_views`, `number_of_calls`, `is_active`, `sponsor_id`, `rating_avg`, `total_number_of_ratings`, `total_sum_ratings`, `start_datetime`, `end_datetime`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 'Buddy 30 %', 'Buddy discount', 'offer_images/1528885286looking for.jpg', 7, 8, 1, 44, 0, 2, 4, '2018-07-11 16:25:43', '2018-07-27 17:05:14', 1, NULL, '2018-06-13 08:21:26', '2018-07-18 12:28:07'),
(6, 'Pepsi discount 60 %', 'pepsi discount', 'offer_images/1529878855looking for.jpg', 1, 3, 1, 46, NULL, NULL, NULL, '2018-07-09 16:25:48', '2018-07-27 17:05:11', 1, NULL, '2018-06-13 09:43:48', '2018-07-18 12:27:21'),
(8, '7% discount', '7% discount on Huawei products for a limited time', 'offer_images/1529878877pepsi.jpg', 5, 4, 1, 46, NULL, NULL, NULL, '2018-07-27 16:25:51', '2018-07-27 16:25:51', 1, NULL, '2018-06-23 12:48:28', '2018-06-24 20:21:17');

-- --------------------------------------------------------

--
-- Table structure for table `offer_categories`
--

DROP TABLE IF EXISTS `offer_categories`;
CREATE TABLE IF NOT EXISTS `offer_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offer_categories`
--

INSERT INTO `offer_categories` (`id`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 'Buddy 30 %', 1, NULL, '2018-06-13 08:21:26', '2018-06-13 08:21:26'),
(6, 'Pepsi discount 60 %', 1, NULL, '2018-06-13 09:43:48', '2018-06-24 20:20:55'),
(8, '7% discount', 1, NULL, '2018-06-23 12:48:28', '2018-06-24 20:21:17');

-- --------------------------------------------------------

--
-- Table structure for table `offer_offer_categories`
--

DROP TABLE IF EXISTS `offer_offer_categories`;
CREATE TABLE IF NOT EXISTS `offer_offer_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_id` int(11) DEFAULT NULL,
  `offer_category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offer_offer_categories`
--

INSERT INTO `offer_offer_categories` (`id`, `offer_id`, `offer_category_id`) VALUES
(1, 3, 6),
(2, 6, 8),
(3, 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `offer_requests`
--

DROP TABLE IF EXISTS `offer_requests`;
CREATE TABLE IF NOT EXISTS `offer_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `offer_id` int(11) DEFAULT NULL,
  `is_accepted` tinyint(1) DEFAULT '0',
  `is_accepted_update` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

DROP TABLE IF EXISTS `rules`;
CREATE TABLE IF NOT EXISTS `rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`id`, `name`) VALUES
(1, 'Backend User'),
(2, 'Doctor'),
(3, 'Super Admin'),
(4, 'Data Entry'),
(5, 'Organizer'),
(6, 'Sponsor'),
(7, 'Admin Doctor');

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

DROP TABLE IF EXISTS `specializations`;
CREATE TABLE IF NOT EXISTS `specializations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `specializations`
--

INSERT INTO `specializations` (`id`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'test1', NULL, NULL, NULL, NULL),
(2, 'test2', NULL, NULL, NULL, NULL),
(3, 'test 3 ', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sponsor_categories`
--

DROP TABLE IF EXISTS `sponsor_categories`;
CREATE TABLE IF NOT EXISTS `sponsor_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsor_categories`
--

INSERT INTO `sponsor_categories` (`id`, `name`, `image`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Muhamed Musa', 'logo/ar/1526992021_male.jpg', 1, 1, '2018-05-22 10:27:01', '2018-06-27 07:59:53'),
(2, 'english', 'logo/ar/1527090741_looking for.jpg', 1, 1, '2018-05-23 13:51:54', '2018-05-23 13:52:21'),
(3, 'Toshiba', 'logo/ar/1527421592_looking for.jpg', 1, NULL, '2018-05-27 09:46:32', '2018-05-27 09:46:32'),
(4, 'Huawei', 'logo/ar/1529763897_download (1).png', 1, NULL, '2018-06-23 12:24:57', '2018-06-23 12:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

DROP TABLE IF EXISTS `surveys`;
CREATE TABLE IF NOT EXISTS `surveys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT '',
  `is_realtime` tinyint(1) DEFAULT '1' COMMENT '0= not realtime , 1 = realtime firebase',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`id`, `event_id`, `name`, `is_realtime`, `created_at`, `updated_at`) VALUES
(1, 8, 'survey about survey', 1, '2018-07-31 09:15:23', '2018-07-31 09:15:23'),
(2, 9, 'testing don\'t show', 1, '2018-07-31 09:15:23', '2018-07-31 09:15:23'),
(3, 8, 'survey again', 1, '2018-07-31 09:20:20', '2018-07-31 09:20:20');

-- --------------------------------------------------------

--
-- Table structure for table `survey_answer_users`
--

DROP TABLE IF EXISTS `survey_answer_users`;
CREATE TABLE IF NOT EXISTS `survey_answer_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `survey_questions`
--

DROP TABLE IF EXISTS `survey_questions`;
CREATE TABLE IF NOT EXISTS `survey_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `survey_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_questions`
--

INSERT INTO `survey_questions` (`id`, `survey_id`, `name`) VALUES
(1, 1, 'what is the name of ay 7aga ?'),
(2, 1, 'what is the name brdo auy 7aga ?'),
(3, 1, 'what is the name of ay 7aga ?'),
(4, 1, 'what is the name brdo auy 7aga ?'),
(5, 3, 'what is the name of ay 7aga 3?'),
(6, 3, 'what is the name brdo auy 7aga 3?'),
(7, 3, 'what is the name of ay 7aga 3?'),
(8, 3, 'what is the name brdo auy 7aga 3 ?'),
(9, 2, 'shouldn\'t show');

-- --------------------------------------------------------

--
-- Table structure for table `survey_question_answers`
--

DROP TABLE IF EXISTS `survey_question_answers`;
CREATE TABLE IF NOT EXISTS `survey_question_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `survey_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT '',
  `number_of_selections` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_question_answers`
--

INSERT INTO `survey_question_answers` (`id`, `survey_id`, `question_id`, `name`, `number_of_selections`) VALUES
(1, 1, 1, 'm3rfsh 1', 0),
(2, 1, 1, 'm3rfsh 2', 0),
(3, 3, 5, 'm3rfsh 3', 0),
(4, 3, 6, 'm3rfsh 4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

DROP TABLE IF EXISTS `system_settings`;
CREATE TABLE IF NOT EXISTS `system_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `value`) VALUES
(1, 'contact_us', 'info@eventakom.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tele_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `is_mobile_verified` tinyint(1) DEFAULT '0',
  `is_email_verified` tinyint(1) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `device_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_os` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_social` tinyint(1) DEFAULT NULL,
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_valid_token` tinyint(1) DEFAULT NULL,
  `social_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_id` tinyint(1) DEFAULT NULL,
  `mobile_verification_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_mobile_verification_code_expired` tinyint(1) DEFAULT NULL,
  `email_verification_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `verification_count` int(11) DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `longitude` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `tele_code`, `mobile`, `country_id`, `city_id`, `gender_id`, `photo`, `birthdate`, `is_active`, `is_mobile_verified`, `is_email_verified`, `created_by`, `updated_by`, `created_at`, `updated_at`, `device_token`, `mobile_os`, `is_social`, `api_token`, `is_valid_token`, `social_token`, `lang_id`, `mobile_verification_code`, `is_mobile_verification_code_expired`, `email_verification_code`, `verification_date`, `verification_count`, `last_login`, `longitude`, `latitude`, `timezone`, `remember_token`, `deleted_at`) VALUES
(1, 'admin', '$2y$10$ZbvTptQsZEfD5FZcHrxA6uTnG.cx/fZBnelHFerW19xI2f1Qifyia', 'super', 'admin', 'super@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-31 06:48:45', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2018-07-31 08:48:45', NULL, '2018-07-31 06:48:45', NULL, NULL, 'Africa/Cairo', 'p7GcatorQVdyUFg80IPMmP67Fz2tkc9RBCdGdOVKnl3cNSVk5nyBaEy6hvPA', NULL),
(36, 'SalmaOmar', '$2y$10$Dr7FSXEf1vzxHkbAMqxBeuuNeZOfyiRitMCSMjzLstVHCsXdS2Aoq', 'Salma', 'Omar', 'salma.omar@pentavalue.com', '+20', '1227775315', 195, 1, 2, 'mobile_users/NEogRziLjX.jpeg', '1988-04-30 22:00:00', 1, 1, 1, NULL, NULL, '2018-06-11 13:15:20', '2018-06-20 14:09:27', 'c0u7NmRxxGg:APA91bFPmiJX0BuBU8ieXIPjBxREDdN3j0AOeIwEU-639vGWKkazzlA6AfFbchB2T5ojcdxqh3leb0EqGHdMC0VtLTDJ5VHgQBHctnZOhYtl4joM2FFX3mP5LaZycP7Z8Sr-vhQovWh_', 'android', NULL, '857956bafd6ad6a752e0ea4bfe35c0f057eacf568965837efa61aaefe66936b2dd62baee44409239', NULL, NULL, 2, 'Xhmw', 1, 'gnsa', '2018-06-20 14:09:27', 2, '2018-06-11 13:15:20', '46.73858600', '24.77426500', '+02:00', NULL, NULL),
(37, 'SalmaAhmed', '$2y$10$CDk83K0uQOiO.FnxfjWmlOg1pI9cUsQTVM8upKSPESHvPPS1UG8Wm', 'Salma', 'Ahmed', 'salmaomario@yahoo.commmm', '+20', '1007225558', 195, 1, 2, 'mobile_users/oRt5oEkGEO.jpeg', '1990-05-21 21:00:00', 0, 0, 0, NULL, NULL, '2018-05-28 13:34:29', '2018-05-28 13:34:29', 'c0u7NmRxxGg:APA91bFPmiJX0BuBU8ieXIPjBxREDdN3j0AOeIwEU-639vGWKkazzlA6AfFbchB2T5ojcdxqh3leb0EqGHdMC0VtLTDJ5VHgQBHctnZOhYtl4joM2FFX3mP5LaZycP7Z8Sr-vhQovWh_', 'android', NULL, NULL, NULL, NULL, 1, 't4cO', 0, 'JCSi', '2018-06-20 12:11:03', NULL, NULL, '46.73858600', '24.77426500', '+02:00', NULL, NULL),
(38, 'OmarIbrahim', '$2y$10$BOneSUbwy1EFsDE.7IzzL.XipT2k7EgopBpkImVutKRmlm9FQHn7e', 'Omar', 'Ibrahim', 'omar.brahim@pentavalue.com', '+20', '1002848469', 195, 1, 1, 'mobile_users/wrdMcQmOAz.png', '2006-10-12 13:47:11', 1, 1, 0, NULL, NULL, '2018-06-04 13:22:50', '2018-06-25 14:05:07', 'testtesttest', 'android', NULL, '41c491540fd3bc8398b18b02fd19a827305dc98cec1760fbacc15aebdffc5ed70b75f60533b20b02', NULL, NULL, 2, 'NQg9', 0, '1Kzb', '2018-06-25 16:16:20', NULL, '2018-06-25 14:05:07', '46.73858600', '24.77426500', 'Africa/Cairo', 'p8SvsVN1wdlGv9oPqrugP9nEsNvMt4ef48fIrpqoIzGI09xCia6sDeiLUFTo', NULL),
(39, 'aliIbrahim', '$2y$10$ZbvTptQsZEfD5FZcHrxA6uTnG.cx/fZBnelHFerW19xI2f1Qifyia', 'ali', 'Ibrahim', 'omar.ebrahim@pentavalue.com', '+20', '10028484691', 195, 1, 1, '/mobile_users/T5YKymJugi.png', '2006-10-12 13:47:11', 1, 1, 0, NULL, NULL, '2018-05-28 14:11:22', '2018-06-26 08:04:56', 'testtesttest', 'android', NULL, '64d105f82972e0b024a9c618458de5757288e6330ba0a64e0b171b806b7220505acc3e5c6c393a1a', NULL, NULL, 1, 'DDyg', 1, 'mCDs', '2018-06-26 10:06:58', NULL, '2018-06-26 08:04:56', '46.73858600', '24.77426500', 'Africa/Cairo', 'jits4FKaSYFRxkbQMoaTgIsNJu9O7zeQPeszUWPJO2VnGAEntox1nN99ydfn', NULL),
(40, 'DaliaNagy', '$2y$10$Q4lIwGB3CJIKlRMsc2TRpesHb.4gHnAsghBQHjg3nQ/lx9NsLj4qW', 'Dalia', 'Nagy', 'salma.side@gmail.com', '+20', '1096787227', 195, 1, 2, 'mobile_users/4q0glQfHLR.jpeg', '1995-06-17 21:00:00', 1, 1, 0, NULL, NULL, '2018-05-28 14:36:08', '2018-05-28 14:36:08', 'c0u7NmRxxGg:APA91bFPmiJX0BuBU8ieXIPjBxREDdN3j0AOeIwEU-639vGWKkazzlA6AfFbchB2T5ojcdxqh3leb0EqGHdMC0VtLTDJ5VHgQBHctnZOhYtl4joM2FFX3mP5LaZycP7Z8Sr-vhQovWh_', 'android', NULL, 'ff24ce0922c938b7d54146914127f99a7e2f69c8edd3aebe589bdf75ac8985eff04992877e796a2b', NULL, NULL, 1, 'cyjq', 1, 'FOc6', '2018-06-13 10:08:35', NULL, '2018-05-28 14:36:08', '46.73858600', '24.77426500', '+02:00', NULL, NULL),
(41, 'OraMaki', '$2y$10$t8zmRCqtvVT5BZV6veWIMeJZG/yS26GJac.pXZGeznYw4o7BVFgX2', 'Ora', 'Maki', 'salm@gmail.com', '+20', '1227770000', 195, 1, 2, 'mobile_users/bQ9ArLuWOm.jpeg', '2002-06-25 21:00:00', 1, 1, 0, NULL, NULL, '2018-07-08 07:33:58', '2018-07-08 07:33:58', 'c0u7NmRxxGgAPA91bFPmiJX0BuBU8ieXIPjBxREDdN3j0AOeIwEU639vGWKkazzlA6AfFbchB2T5ojcdxqh3leb0EqGHdMC0VtLTDJ5VHgQBHctnZOhYtl4joM2FFX3mP5LaZycP7Z8SrvhQovWh_', 'android', NULL, 'eb0faebbff1745d0ee0922babe83d89e72d04e63f786be4b4f3ed153e29f466c8477ef36401a99d6', NULL, NULL, 1, 'spMJ', 1, 'zOdc', '2018-07-08 07:33:58', NULL, '2018-07-08 07:33:58', '46.73858600', '24.77426500', '+02:00', NULL, NULL),
(42, 'nermmineahmed', '$2y$10$UXYvKFn0N7OLB.oxpsngVuTOxNykVptCMnMIyqUCbHkTp/uY.aGdC', 'nermmine', 'ahmed', 'nou@gmail.com', '+20', '1005517724', 195, 1, 2, '/mobile_users/Zd4zBiHqW8.jpeg', '2003-05-27 13:51:13', 1, 1, 0, NULL, NULL, '2018-06-03 15:40:37', '2018-06-03 15:41:22', 'testtesttest', 'android', NULL, 'c169e972d3a05634a4dfbc12ddc940f1523836da5d545144b55d0d9bea9ba7e7fbb2c6c6fe63829a', NULL, NULL, 1, 'iPo5', 1, 'GDhl', '2018-06-13 10:10:11', 5, '2018-06-03 15:40:37', '46.73858600', '24.77426500', '+02:00', NULL, NULL),
(43, 'nermineatef', '$2y$10$e9wJ5dhBm49l6aWMdlxPaOSsOP1IYb1BKT.twzfl9XSHUmE5DPubO', 'nermine', 'atef', 'nermine.atef12@gmail.com', '+20', '1005517725', 195, 1, NULL, 'mobile_users/qwvVNOVJBq.jpeg', NULL, 0, 0, 0, NULL, NULL, '2018-05-28 15:46:26', '2018-05-28 15:46:26', 'c0u7NmRxxGg:APA91bFPmiJX0BuBU8ieXIPjBxREDdN3j0AOeIwEU-639vGWKkazzlA6AfFbchB2T5ojcdxqh3leb0EqGHdMC0VtLTDJ5VHgQBHctnZOhYtl4joM2FFX3mP5LaZycP7Z8Sr-vhQovWh_', 'android', NULL, NULL, NULL, NULL, 1, 'OvyR', 0, '73HT', '2018-06-03 15:35:13', NULL, NULL, '46.73858600', '24.77426500', '+02:00', NULL, NULL),
(44, 'DanHeggs', NULL, NULL, NULL, 'salmaomario@yahoo.comm', NULL, '01002544569', NULL, NULL, NULL, 'backend_users/1528278563606.jpg', NULL, 1, 0, 0, NULL, NULL, '2018-05-29 07:49:55', '2018-06-06 07:49:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-20 12:11:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'samharriis', NULL, NULL, NULL, 'salmaomario@yahoo.commmm', NULL, '01002544569', NULL, NULL, NULL, 'backend_users/samharriis1527587678323.jpg', NULL, 1, 0, 0, NULL, NULL, '2018-05-29 07:54:38', '2018-05-29 07:54:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-20 12:11:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 'DanDee', NULL, NULL, NULL, 'salmaomario@yahoo.comhhhhhhhh', NULL, '2561256125', NULL, NULL, NULL, 'backend_users/DanDee1527587767666.jpg', NULL, 1, 0, 0, NULL, NULL, '2018-05-29 07:56:07', '2018-05-29 07:56:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-20 12:11:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 'OraMaki', '$2y$10$wdjRuwMjLjWjBrJMdHs9FugmDLapkV5MaVJ3V/hHdJUnH4V/oqOZu', 'Ora', 'Maki', 'salmaomario@yahoo.comcom', '+20', '1227775316', 195, 1, NULL, 'mobile_users/NTV9Ubz1uP.jpeg', NULL, 0, 0, 0, NULL, NULL, '2018-06-20 12:08:40', '2018-06-20 12:08:40', 'c0u7NmRxxGg:APA91bFPmiJX0BuBU8ieXIPjBxREDdN3j0AOeIwEU-639vGWKkazzlA6AfFbchB2T5ojcdxqh3leb0EqGHdMC0VtLTDJ5VHgQBHctnZOhYtl4joM2FFX3mP5LaZycP7Z8Sr-vhQovWh_', 'android', NULL, NULL, NULL, NULL, 1, 'CdoB', 0, 'd6wK', '2018-06-20 12:10:45', NULL, NULL, '46.73858600', '24.77426500', '+02:00', NULL, NULL),
(48, 'OraMaki2', '$2y$10$ZiusSsYjvROI4dPtUdq1Ou6LEfZjLhtp.INy/jYnQUwgJirp6dqCW', 'Ora', 'Maki', 'salmaomario@yahoo.comqqaaa', '+20', '12277753129999', 195, 1, NULL, 'mobile_users/Eyj2yjbJX7.jpeg', NULL, 0, 0, 1, NULL, NULL, '2018-06-20 12:12:03', '2018-06-20 12:12:38', 'c0u7NmRxxGg:APA91bFPmiJX0BuBU8ieXIPjBxREDdN3j0AOeIwEU-639vGWKkazzlA6AfFbchB2T5ojcdxqh3leb0EqGHdMC0VtLTDJ5VHgQBHctnZOhYtl4joM2FFX3mP5LaZycP7Z8Sr-vhQovWh_', 'android', NULL, NULL, NULL, NULL, 1, 'T17m', 0, 'iPK3', '2018-07-28 00:06:35', NULL, NULL, '46.73858600', '24.77426500', '+02:00', NULL, NULL),
(49, 'MalekMaktabi', '$2y$10$L3MqCbMXPfRhbKZBOcexYuJZmJG3jXD6xeVJttRxv8gDNZ025fPp.', 'Malek', 'Maktabi', 'salma.omar@pentavalue.comd', '+20', '1227775312', 195, 1, NULL, 'mobile_users/jtvcf6vI9j.jpeg', NULL, 0, 0, 0, NULL, NULL, '2018-06-20 13:19:40', '2018-06-20 13:19:40', 'c0u7NmRxxGg:APA91bFPmiJX0BuBU8ieXIPjBxREDdN3j0AOeIwEU-639vGWKkazzlA6AfFbchB2T5ojcdxqh3leb0EqGHdMC0VtLTDJ5VHgQBHctnZOhYtl4joM2FFX3mP5LaZycP7Z8Sr-vhQovWh_', 'android', NULL, NULL, NULL, NULL, 1, 'DfWr', 0, 'xAyS', '2018-06-20 14:08:31', NULL, NULL, '46.73858600', '24.77426500', '+02:00', NULL, NULL),
(50, 'ahmed.yacoub', '$2y$10$eKb4VbZHHwx7n5QJviwRRO.QZ4jfDACF5yhvklWvo5hHpFYvEQKcm', 'Ahmed Yacoub', NULL, 'ahmed.yacoup@pentavalue.com', NULL, '0123456789', NULL, NULL, NULL, 'backend_users/1530708959812.jpg', NULL, 1, 0, 0, NULL, NULL, '2018-07-04 10:55:59', '2018-07-04 10:55:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'SaraMagdy', '$2y$10$COeK0mnemTR29DXHoECUsOuGzKk7rhkWJ5f/9fXfBG6zPmXHHBpRO', 'SaraMagdy', NULL, 'saramagdyahmed6@pentavalue.com', '+20', '01122297688', 195, 1, 1, 'mobile_users/hDwztPy7TA.png', NULL, 0, 0, 0, 36, NULL, '2018-07-18 09:27:20', '2018-07-18 12:30:52', 'c0u7NmRxxGg:APA91bFPmiJX0BuBU8ieXIPjBxREDdN3j0AOeIwEU', 'android', NULL, NULL, NULL, NULL, 1, '3hZM', 1, 'lMs6', '2018-07-25 11:03:38', 1, NULL, '46.73858600', '24.77426500', '+02:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

DROP TABLE IF EXISTS `users_info`;
CREATE TABLE IF NOT EXISTS `users_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `mobile2` varchar(255) DEFAULT '',
  `mobile3` varchar(255) DEFAULT '',
  `region_id` int(11) DEFAULT '0',
  `address` varchar(255) DEFAULT '',
  `is_backend` tinyint(1) DEFAULT '0',
  `is_profile_completed` tinyint(1) DEFAULT '0',
  `specialization_id` int(11) DEFAULT '0',
  `allow_push_notification` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`id`, `user_id`, `mobile2`, `mobile3`, `region_id`, `address`, `is_backend`, `is_profile_completed`, `specialization_id`, `allow_push_notification`) VALUES
(1, 51, '', NULL, 1, NULL, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_going`
--

DROP TABLE IF EXISTS `user_going`;
CREATE TABLE IF NOT EXISTS `user_going` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `is_accepted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_going`
--

INSERT INTO `user_going` (`id`, `user_id`, `event_id`, `is_accepted`) VALUES
(9, 36, 24, 1),
(10, 37, 24, 0),
(11, 43, 8, 1),
(12, 44, 8, 1),
(13, 51, 42, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_rules`
--

DROP TABLE IF EXISTS `user_rules`;
CREATE TABLE IF NOT EXISTS `user_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `rule_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_rules`
--

INSERT INTO `user_rules` (`id`, `user_id`, `rule_id`) VALUES
(3, 1, 1),
(4, 1, 3),
(5, 9, 4),
(6, 9, 1),
(9, 7, 3),
(10, 7, 1),
(11, 11, 4),
(12, 11, 1),
(13, 12, 2),
(14, 13, 2),
(17, 16, 2),
(18, 17, 2),
(19, 18, 2),
(20, 19, 2),
(21, 20, 2),
(22, 21, 2),
(23, 22, 2),
(24, 23, 4),
(25, 23, 1),
(26, 24, 2),
(27, 25, 2),
(28, 26, 2),
(29, 27, 2),
(30, 28, 2),
(31, 29, 2),
(32, 30, 2),
(33, 31, 2),
(34, 32, 2),
(35, 33, 2),
(36, 34, 2),
(37, 35, 2),
(38, 36, 5),
(39, 37, 2),
(40, 38, 2),
(41, 39, 2),
(42, 40, 2),
(43, 41, 2),
(44, 42, 2),
(45, 43, 2),
(48, 45, 4),
(49, 45, 1),
(50, 46, 6),
(51, 46, 1),
(54, 44, 6),
(55, 44, 1),
(56, 47, 5),
(57, 48, 5),
(58, 49, 2),
(59, 50, 3),
(60, 50, 1),
(61, 51, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_sponsor_categories`
--

DROP TABLE IF EXISTS `user_sponsor_categories`;
CREATE TABLE IF NOT EXISTS `user_sponsor_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `sponsor_category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_target_cities`
--

DROP TABLE IF EXISTS `user_target_cities`;
CREATE TABLE IF NOT EXISTS `user_target_cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_target_regions`
--

DROP TABLE IF EXISTS `user_target_regions`;
CREATE TABLE IF NOT EXISTS `user_target_regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_target_specializations`
--

DROP TABLE IF EXISTS `user_target_specializations`;
CREATE TABLE IF NOT EXISTS `user_target_specializations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `specialization_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

DROP TABLE IF EXISTS `workshops`;
CREATE TABLE IF NOT EXISTS `workshops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `start_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `end_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `workshop_owners`
--

DROP TABLE IF EXISTS `workshop_owners`;
CREATE TABLE IF NOT EXISTS `workshop_owners` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `workshop_specializations`
--

DROP TABLE IF EXISTS `workshop_specializations`;
CREATE TABLE IF NOT EXISTS `workshop_specializations` (
  `id` int(11) NOT NULL,
  `workshop_id` int(11) NOT NULL,
  `specialization_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
