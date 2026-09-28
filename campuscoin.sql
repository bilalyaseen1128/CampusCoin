-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 28, 2026 at 01:26 AM
-- Server version: 8.4.7
-- PHP Version: 8.5.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `campuscoin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$1IqLpWXI4ZP39SLeVS2CHej84C5Mw//LaaWHSHqfwtLmUaXtBqlRm', NULL, '2026-09-27 12:28:27', '2026-09-27 12:28:27');

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

DROP TABLE IF EXISTS `bookmarks`;
CREATE TABLE IF NOT EXISTS `bookmarks` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `bookmark_key` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saving_tip_id` bigint UNSIGNED DEFAULT NULL,
  `insight_id` bigint UNSIGNED DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_bm_user` (`user_id`),
  KEY `fk_bm_tip` (`saving_tip_id`),
  KEY `fk_bm_insight` (`insight_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `user_id`, `bookmark_key`, `saving_tip_id`, `insight_id`, `note`, `created_at`, `updated_at`) VALUES
(3, 4, 'budget-performance', NULL, NULL, NULL, '2026-09-26 15:32:58', '2026-09-26 15:32:58'),
(4, 4, 'subscriptions', NULL, NULL, NULL, '2026-09-26 15:34:26', '2026-09-26 15:34:26'),
(5, 7, 'daily-spending', NULL, NULL, NULL, '2026-09-27 19:58:48', '2026-09-27 19:58:48');

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

DROP TABLE IF EXISTS `budgets`;
CREATE TABLE IF NOT EXISTS `budgets` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `month` date NOT NULL,
  `limit_amount` decimal(10,2) NOT NULL,
  `amount_spent` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_budget_user_cat_month` (`user_id`,`category_id`,`month`),
  KEY `fk_budgets_category` (`category_id`)
) ;

--
-- Dumping data for table `budgets`
--

INSERT INTO `budgets` (`id`, `user_id`, `category_id`, `month`, `limit_amount`, `amount_spent`, `created_at`, `updated_at`) VALUES
(7, 7, 2, '2026-09-01', 25000.00, 25000.00, '2026-09-27 19:58:07', '2026-09-27 20:07:54');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('income','expense') COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget_class` enum('need','want','saving') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_categories_user_type_name` (`user_id`,`type`,`name`),
  KEY `idx_categories_type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `name`, `type`, `budget_class`, `is_default`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Allowance', 'income', NULL, 1, '2026-09-25 04:40:21', '2026-09-25 04:40:21'),
(2, NULL, 'Part-time Job', 'income', NULL, 1, '2026-09-25 04:40:21', '2026-09-25 04:40:21'),
(3, NULL, 'Scholarship', 'income', NULL, 1, '2026-09-25 04:40:21', '2026-09-25 04:40:21'),
(4, NULL, 'Gift', 'income', NULL, 1, '2026-09-25 04:40:21', '2026-09-25 04:40:21'),
(5, NULL, 'Other Income', 'income', NULL, 1, '2026-09-25 04:40:21', '2026-09-25 04:40:21'),
(6, NULL, 'Food', 'expense', 'need', 1, '2026-09-25 04:40:21', '2026-09-25 04:40:21'),
(7, NULL, 'Transport', 'expense', 'need', 1, '2026-09-25 04:40:21', '2026-09-25 04:40:21'),
(8, NULL, 'Hostel/Rent', 'expense', 'need', 1, '2026-09-25 04:40:21', '2026-09-25 04:40:21'),
(9, NULL, 'Academics', 'expense', 'need', 1, '2026-09-25 04:40:21', '2026-09-25 04:40:21'),
(10, NULL, 'Subscriptions', 'expense', 'want', 1, '2026-09-25 04:40:21', '2026-09-25 04:40:21'),
(11, NULL, 'Entertainment', 'income', NULL, 1, '2026-09-25 04:40:21', '2026-09-25 20:33:15'),
(12, NULL, 'Miscellaneous', 'expense', 'want', 1, '2026-09-25 04:40:21', '2026-09-25 04:40:21'),
(15, NULL, 'Uncategorized', 'income', NULL, 1, '2026-09-27 20:08:41', '2026-09-27 20:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
CREATE TABLE IF NOT EXISTS `contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `type`, `title`, `text`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Saving Tip', 'Small habits, tracked consistently, beat big resolutions.', 'Practical ways students save more without earning more — curated by the CampusCoin team. Mark the ones you try and watch your streak grow.', 'Published', '2026-09-27 08:15:28', '2026-09-27 08:17:59'),
(3, 'Saving Tip', 'Save Money', 'Money is basic need', 'Published', '2026-09-27 20:09:03', '2026-09-27 20:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `insights`
--

DROP TABLE IF EXISTS `insights`;
CREATE TABLE IF NOT EXISTS `insights` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `month` date NOT NULL,
  `summary_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip_text` text COLLATE utf8mb4_unicode_ci,
  `flagged_category_id` bigint UNSIGNED DEFAULT NULL,
  `growth_percent` decimal(6,2) DEFAULT NULL,
  `generated_by` enum('ai','rule_based') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ai',
  `generated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_insight_user_month` (`user_id`,`month`),
  KEY `fk_insights_category` (`flagged_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `needs_wants_items`
--

DROP TABLE IF EXISTS `needs_wants_items`;
CREATE TABLE IF NOT EXISTS `needs_wants_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_type` enum('need','want','saving') COLLATE utf8mb4_unicode_ci NOT NULL,
  `explanation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notes_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(3, 7, 'saving', 'I NEED A LAPTOP', '2026-09-27 19:59:18', '2026-09-27 19:59:18');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('arifjunaid033@gmail.com', '$2y$12$R0kQnmFEAsG2YCz5Z0j3..DEA3CujzLeS20ArnG.2bkrICv7dkXhy', '2026-09-26 13:16:31'),
('arifjunaid039@gmail.com', '$2y$12$qUKFFXwE3iuSmjb5Rn9I5OSLFDb25cbrtGy2OoFdLx1D8DMxBrCcK', '2026-09-26 13:14:47');

-- --------------------------------------------------------

--
-- Table structure for table `recurring_transactions`
--

DROP TABLE IF EXISTS `recurring_transactions`;
CREATE TABLE IF NOT EXISTS `recurring_transactions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `type` enum('income','expense') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `frequency` enum('weekly','monthly','yearly') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'monthly',
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `next_run_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_recurring_user` (`user_id`),
  KEY `idx_recurring_next_run` (`next_run_date`,`is_active`),
  KEY `fk_recurring_category` (`category_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `report_exports`
--

DROP TABLE IF EXISTS `report_exports`;
CREATE TABLE IF NOT EXISTS `report_exports` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `month` date NOT NULL,
  `format` enum('pdf','image') COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailed_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_export_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saving_tips`
--

DROP TABLE IF EXISTS `saving_tips`;
CREATE TABLE IF NOT EXISTS `saving_tips` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `tip_text` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `potential_savings` decimal(10,2) NOT NULL DEFAULT '0.00',
  `month` date NOT NULL,
  `status` enum('active','dismissed','pinned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `generated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_tips_rank` (`user_id`,`status`,`potential_savings`),
  KEY `fk_tips_category` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_sessions_user` (`user_id`),
  KEY `idx_sessions_last_activity` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1G4GX9EAUzSfUa4su8vG2SNP5gD5YRmkeKglCIy4', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJlSXpZTDkzOUpGQk5rVmo5eHlSVlc3em9zTE1uYVg1VkxIdFNqb3JqIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL3NhdmluZy10aXBzIiwicm91dGUiOiJzYXZpbmcudGlwcyJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6NywicGFzc3dvcmRfaGFzaF93ZWIiOiI0ZTc0MjM1MjcwNTk2MmZmOWE1OGEyMDMyNjdjMmIzOWY5YWY2ZmVlYmE3YmRmYjVkNDY4OWU2OTAwMDZkZTVjIiwibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MSwicGFzc3dvcmRfaGFzaF9hZG1pbiI6IjRiYzdlZGYyN2M5MzQzOTg1MzlhZjhhOGViNjJiNDEwOGMyYWE3ZTkxMWFhZDE3OTM5NWFmNjRmZTMzMWE3OTkifQ==', 1790558779),
('pVDSayqq5xgni9EDQVbuCYpsBBEzxf81oBOocSj4', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJVdFNkbUQyUElMR1lHS2NYRGxtNlRKODM0ZEJPaDdwb0FKdlI3bUtlIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luIiwicm91dGUiOiJsb2dpbiJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6NywicGFzc3dvcmRfaGFzaF93ZWIiOiI0ZTc0MjM1MjcwNTk2MmZmOWE1OGEyMDMyNjdjMmIzOWY5YWY2ZmVlYmE3YmRmYjVkNDY4OWU2OTAwMDZkZTVjIn0=', 1790555023);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `type` enum('income','expense') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_date` date NOT NULL,
  `ai_suggested_category_id` bigint UNSIGNED DEFAULT NULL,
  `recurring_id` bigint UNSIGNED DEFAULT NULL,
  `is_flagged` tinyint(1) NOT NULL DEFAULT '0',
  `flag_reason` enum('large_amount','possible_duplicate') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_tx_user_date` (`user_id`,`transaction_date`),
  KEY `idx_tx_user_category_date` (`user_id`,`category_id`,`transaction_date`),
  KEY `idx_tx_user_type_date` (`user_id`,`type`,`transaction_date`),
  KEY `fk_tx_category` (`category_id`),
  KEY `fk_tx_ai_category` (`ai_suggested_category_id`),
  KEY `fk_tx_recurring` (`recurring_id`)
) ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `category_id`, `type`, `amount`, `description`, `transaction_date`, `ai_suggested_category_id`, `recurring_id`, `is_flagged`, `flag_reason`, `deleted_at`, `created_at`, `updated_at`) VALUES
(31, 7, 2, 'income', 25000.00, 'Part time job', '2026-09-01', NULL, NULL, 0, NULL, NULL, '2026-09-27 19:48:28', '2026-09-27 19:48:52'),
(33, 7, 9, 'expense', 1000.00, 'uni fees', '2026-09-20', NULL, NULL, 0, NULL, NULL, '2026-09-27 20:07:13', '2026-09-27 20:07:13');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

DROP TABLE IF EXISTS `transaction_history`;
CREATE TABLE IF NOT EXISTS `transaction_history` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('income','expense') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `action` enum('created','updated','deleted','restored') COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_txh_tx` (`transaction_id`),
  KEY `idx_txh_user_created` (`user_id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_history`
--

INSERT INTO `transaction_history` (`id`, `transaction_id`, `user_id`, `category_id`, `description`, `type`, `amount`, `transaction_date`, `action`, `old_values`, `new_values`, `created_at`) VALUES
(5, 31, 7, 2, 'Part time job', 'income', 15000.00, '2026-09-01', 'created', NULL, '{\"id\": 31, \"type\": \"income\", \"amount\": \"15000.00\", \"user_id\": 7, \"created_at\": \"2026-09-28T00:48:28.000000Z\", \"updated_at\": \"2026-09-28T00:48:28.000000Z\", \"category_id\": \"2\", \"description\": \"Part time job\", \"transaction_date\": \"2026-09-01T00:00:00.000000Z\"}', '2026-09-27 19:48:28'),
(6, 31, 7, 2, 'Part time job', 'income', 25000.00, '2026-09-01', 'updated', '{\"id\": 31, \"type\": \"income\", \"amount\": \"15000.00\", \"user_id\": 7, \"created_at\": \"2026-09-28T00:48:28.000000Z\", \"deleted_at\": null, \"is_flagged\": 0, \"updated_at\": \"2026-09-28T00:48:28.000000Z\", \"category_id\": 2, \"description\": \"Part time job\", \"flag_reason\": null, \"recurring_id\": null, \"transaction_date\": \"2026-09-01T00:00:00.000000Z\", \"ai_suggested_category_id\": null}', '{\"id\": 31, \"type\": \"income\", \"amount\": \"25000.00\", \"user_id\": 7, \"created_at\": \"2026-09-28T00:48:28.000000Z\", \"deleted_at\": null, \"is_flagged\": 0, \"updated_at\": \"2026-09-28T00:48:52.000000Z\", \"category_id\": \"2\", \"description\": \"Part time job\", \"flag_reason\": null, \"recurring_id\": null, \"transaction_date\": \"2026-09-01T00:00:00.000000Z\", \"ai_suggested_category_id\": null}', '2026-09-27 19:48:52'),
(9, 31, 7, 2, 'Part time job', 'income', 25000.00, '2026-09-01', 'updated', '{\"id\": 31, \"type\": \"income\", \"amount\": \"25000.00\", \"user_id\": 7, \"created_at\": \"2026-09-28T00:48:28.000000Z\", \"deleted_at\": null, \"is_flagged\": 0, \"updated_at\": \"2026-09-28T00:48:52.000000Z\", \"category_id\": 2, \"description\": \"Part time job\", \"flag_reason\": null, \"recurring_id\": null, \"transaction_date\": \"2026-09-01T00:00:00.000000Z\", \"ai_suggested_category_id\": null}', '{\"id\": 31, \"type\": \"income\", \"amount\": \"25000.00\", \"user_id\": 7, \"created_at\": \"2026-09-28T00:48:28.000000Z\", \"deleted_at\": null, \"is_flagged\": 0, \"updated_at\": \"2026-09-28T00:48:52.000000Z\", \"category_id\": \"2\", \"description\": \"Part time job\", \"flag_reason\": null, \"recurring_id\": null, \"transaction_date\": \"2026-09-01T00:00:00.000000Z\", \"ai_suggested_category_id\": null}', '2026-09-27 19:49:37'),
(10, 33, 7, 9, 'uni fees', 'expense', 1000.00, '2026-09-20', 'created', NULL, '{\"id\": 33, \"type\": \"expense\", \"amount\": \"1000.00\", \"user_id\": 7, \"created_at\": \"2026-09-28T01:07:13.000000Z\", \"updated_at\": \"2026-09-28T01:07:13.000000Z\", \"category_id\": \"9\", \"description\": \"uni fees\", \"transaction_date\": \"2026-09-20T00:00:00.000000Z\"}', '2026-09-27 20:07:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('student','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'student',
  `academic_year` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monthly_allowance_baseline` decimal(10,2) NOT NULL DEFAULT '0.00',
  `monthly_savings_goal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `font_size` enum('small','medium','large') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_users_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `academic_year`, `monthly_allowance_baseline`, `monthly_savings_goal`, `dark_mode`, `font_size`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Junaid arif', 'arifjunaid549@gmail.com', NULL, '$2y$12$eCJsaWeFBffzN8ZXdteZre4mB0QI5jbm.owF5Y.fls7a6cp9Iq64m', 'student', 'First Year', 0.00, 0.00, 0, 'medium', 1, 'E6gczM2fZcguxMaU8aOFeHr72mLs6wBB61wXQu3gLCOvqo580Xr1HKHNZjR5', '2026-09-26 02:52:13', '2026-09-27 06:25:08'),
(7, 'Bilal', 'Bilal@gmail.com', NULL, '$2y$12$cmt3kVL57ugJaEVKv5WWpen8d9T5Xe1KMvMQv7PVNLuB61sB55QZe', 'student', NULL, 0.00, 0.00, 0, 'medium', 1, 'oqR3BpGwKfrmsl1BAyigqDelGnBuucdSYIEdzXlY4SSSMOMvPm8fNuLehTh0', '2026-09-27 19:23:43', '2026-09-27 19:23:43');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `fk_bm_insight` FOREIGN KEY (`insight_id`) REFERENCES `insights` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bm_tip` FOREIGN KEY (`saving_tip_id`) REFERENCES `saving_tips` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bm_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `budgets`
--
ALTER TABLE `budgets`
  ADD CONSTRAINT `fk_budgets_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_budgets_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_categories_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `insights`
--
ALTER TABLE `insights`
  ADD CONSTRAINT `fk_insights_category` FOREIGN KEY (`flagged_category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_insights_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recurring_transactions`
--
ALTER TABLE `recurring_transactions`
  ADD CONSTRAINT `fk_recurring_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_recurring_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report_exports`
--
ALTER TABLE `report_exports`
  ADD CONSTRAINT `fk_export_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `saving_tips`
--
ALTER TABLE `saving_tips`
  ADD CONSTRAINT `fk_tips_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tips_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `fk_sessions_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_tx_ai_category` FOREIGN KEY (`ai_suggested_category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tx_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tx_recurring` FOREIGN KEY (`recurring_id`) REFERENCES `recurring_transactions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tx_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD CONSTRAINT `fk_txh_tx` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_txh_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
