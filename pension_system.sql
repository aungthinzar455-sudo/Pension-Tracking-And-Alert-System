-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2026 at 01:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pension_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `actor_role` enum('Admin','User') NOT NULL,
  `actor_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `target_user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `actor_role`, `actor_id`, `action`, `target_user_id`, `created_at`) VALUES
(1, 'User', 7, 'Logged in to system', NULL, '2026-01-17 13:35:58'),
(2, 'User', 7, 'Logged in to system', NULL, '2026-01-17 13:35:59'),
(3, 'User', 0, 'Logged in to system', NULL, '2026-01-19 04:02:17'),
(4, 'User', 0, 'Logged in to system', NULL, '2026-01-19 04:02:24'),
(5, 'User', 0, 'Logged in to system', NULL, '2026-01-19 04:02:27'),
(6, 'User', 0, 'Logged in to system', NULL, '2026-01-19 07:54:34'),
(7, 'User', 0, 'Logged in to system', NULL, '2026-01-19 07:54:37'),
(8, 'User', 7, 'Uploaded life certificate', NULL, '2026-01-19 08:01:25'),
(9, 'User', 0, 'Logged in to system', NULL, '2026-01-19 08:01:35'),
(10, 'User', 0, 'Logged in to system', NULL, '2026-02-12 14:46:53'),
(11, 'User', 0, 'Logged in to system', NULL, '2026-02-12 14:46:57'),
(12, 'User', 0, 'Logged in to system', NULL, '2026-02-12 14:47:46'),
(13, 'User', 0, 'Logged in to system', NULL, '2026-02-12 14:47:49'),
(14, 'User', 0, 'Logged in to system', NULL, '2026-02-12 14:47:49'),
(15, 'User', 0, 'Logged in to system', NULL, '2026-02-12 14:47:49'),
(16, 'User', 0, 'Logged in to system', NULL, '2026-02-12 14:47:49'),
(17, 'User', 0, 'Logged in to system', NULL, '2026-02-12 14:48:06'),
(18, 'User', 0, 'Logged in to system', NULL, '2026-02-12 14:50:13'),
(19, 'User', 0, 'Logged in to system', NULL, '2026-02-12 14:50:14'),
(20, 'User', 0, 'Logged in to system', NULL, '2026-02-12 14:50:15'),
(21, 'User', 0, 'Logged in to system', NULL, '2026-02-12 14:50:17'),
(22, 'User', 0, 'Logged in to system', NULL, '2026-02-12 14:50:22'),
(23, 'User', 0, 'Logged in to system', NULL, '2026-02-12 14:51:43'),
(24, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:24:11'),
(25, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:24:19'),
(26, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:24:49'),
(27, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:25:32'),
(28, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:25:53'),
(29, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:28:01'),
(30, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:28:03'),
(31, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:28:13'),
(32, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:28:14'),
(33, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:28:17'),
(34, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:28:22'),
(35, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:29:22'),
(36, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:29:24'),
(37, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:30:18'),
(38, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:30:19'),
(39, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:32:59'),
(40, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:33:01'),
(41, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:33:53'),
(42, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:33:58'),
(43, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:34:02'),
(44, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:34:06'),
(45, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:34:10'),
(46, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:34:14'),
(47, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:34:18'),
(48, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:34:22'),
(49, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:34:27'),
(50, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:34:31'),
(51, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:34:35'),
(52, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:34:39'),
(53, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:34:43'),
(54, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:34:47'),
(55, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:34:51'),
(56, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:34:55'),
(57, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:34:59'),
(58, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:35:03'),
(59, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:35:08'),
(60, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:35:08'),
(61, 'User', 0, 'Logged in to system', NULL, '2026-02-13 03:35:10'),
(62, 'User', 7, 'Logged in to system', NULL, '2026-02-13 07:58:01'),
(63, 'User', 7, 'Logged in to system', NULL, '2026-02-13 07:58:03'),
(64, 'User', 0, 'Logged in to system', NULL, '2026-02-13 08:13:20'),
(65, 'User', 0, 'Logged in to system', NULL, '2026-02-13 08:13:27'),
(66, 'User', 0, 'Logged in to system', NULL, '2026-02-13 08:13:34'),
(67, 'User', 0, 'Logged in to system', NULL, '2026-02-13 08:13:36'),
(68, 'User', 0, 'Logged in to system', NULL, '2026-02-14 08:58:42'),
(69, 'User', 0, 'Logged in to system', NULL, '2026-02-14 08:58:44'),
(70, 'User', 0, 'Logged in to system', NULL, '2026-02-14 08:58:49'),
(71, 'User', 0, 'Logged in to system', NULL, '2026-02-14 08:58:53'),
(72, 'User', 0, 'Logged in to system', NULL, '2026-02-14 11:59:56'),
(73, 'User', 0, 'Logged in to system', NULL, '2026-02-14 12:00:11'),
(74, 'User', 0, 'Logged in to system', NULL, '2026-02-14 12:00:37'),
(75, 'User', 0, 'Logged in to system', NULL, '2026-02-14 12:00:39'),
(76, 'User', 0, 'Logged in to system', NULL, '2026-02-15 16:50:52'),
(77, 'User', 0, 'Logged in to system', NULL, '2026-02-15 16:51:01'),
(78, 'User', 7, 'Logged in to system', NULL, '2026-02-15 17:30:19'),
(79, 'User', 7, 'Logged in to system', NULL, '2026-02-15 17:30:22'),
(80, 'User', 7, 'Logged in to system', NULL, '2026-02-15 18:13:12'),
(81, 'User', 7, 'Logged in to system', NULL, '2026-02-15 18:13:14'),
(82, 'User', 7, 'Uploaded life certificate', NULL, '2026-02-15 18:33:33'),
(83, 'User', 7, 'Uploaded life certificate', NULL, '2026-02-16 12:49:50'),
(84, 'User', 7, 'Uploaded life certificate', NULL, '2026-02-16 12:50:11'),
(85, 'User', 7, 'Uploaded life certificate', NULL, '2026-02-16 12:52:19'),
(86, 'User', 7, 'Uploaded life certificate', NULL, '2026-02-16 12:52:23'),
(87, 'User', 7, 'Uploaded life certificate', NULL, '2026-02-16 12:52:26'),
(88, 'User', 7, 'Uploaded life certificate', NULL, '2026-02-16 12:52:39'),
(89, 'User', 7, 'Uploaded life certificate', NULL, '2026-02-16 13:29:35'),
(90, 'User', 7, 'Uploaded life certificate', NULL, '2026-02-16 13:32:46');

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `type` varchar(20) DEFAULT 'info',
  `is_read` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alerts`
--

INSERT INTO `alerts` (`id`, `user_id`, `message`, `type`, `is_read`, `created_at`) VALUES
(1, 42, ',,,,', 'warning', 1, '2026-01-17 12:26:35'),
(2, 7, '...', 'success', 1, '2026-01-17 12:26:54'),
(3, 42, 'your acc is safe!', 'success', 1, '2026-01-17 12:29:11'),
(4, 42, 'hello', 'success', 1, '2026-01-17 12:52:54');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Open',
  `admin_reply` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `user_id`, `subject`, `message`, `status`, `admin_reply`, `created_at`) VALUES
(1, 7, 'hello', 'my pension status', 'Resolved', 'remaining 9000', '2026-01-06 12:55:42'),
(2, 37, 'hello', 'kkk', 'Resolved', 'ok', '2026-01-07 17:33:08'),
(3, 7, 'Information Technology', 'wcsd', 'Open', NULL, '2026-02-16 13:38:12');

-- --------------------------------------------------------

--
-- Table structure for table `life_certificates`
--

CREATE TABLE `life_certificates` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `certificate_file` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `life_certificates`
--

INSERT INTO `life_certificates` (`id`, `user_id`, `certificate_file`, `expiry_date`, `status`, `uploaded_at`) VALUES
(1, 7, 'uploads/life_certificates/1767707196_ChatGPT Image Mar 29, 2025, 07_32_41 PM.png', '2028-11-06', 'Valid', '2026-01-06 13:46:36'),
(2, 37, 'uploads/life_certificates/1767807134_ChatGPT Image Mar 29, 2025, 07_20_17 PM.png', '2026-01-31', 'Valid', '2026-01-07 17:32:14'),
(3, 42, 'uploads/life_certificates/1768049404_ChatGPT Image Mar 29, 2025, 07_32_41 PM.png', '2026-03-31', 'Pending', '2026-01-10 12:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `pension`
--

CREATE TABLE `pension` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pension`
--

INSERT INTO `pension` (`id`, `user_id`, `amount`, `status`, `updated_at`) VALUES
(2, 7, 8000.00, 'Active', '2026-02-12 14:52:11'),
(3, 37, 6000.00, 'Active', '2026-01-08 11:13:18'),
(4, 42, 8000.00, 'Active', '2026-01-17 12:27:58');

-- --------------------------------------------------------

--
-- Table structure for table `pensioner_profile`
--

CREATE TABLE `pensioner_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dob` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `aadhaar_no` varchar(20) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_no` varchar(30) DEFAULT NULL,
  `ifsc_code` varchar(20) DEFAULT NULL,
  `retirement_date` date DEFAULT NULL,
  `pension_type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pensioner_profile`
--

INSERT INTO `pensioner_profile` (`id`, `user_id`, `dob`, `address`, `aadhaar_no`, `bank_name`, `account_no`, `ifsc_code`, `retirement_date`, `pension_type`, `created_at`) VALUES
(1, 7, '2024-04-14', 'parul university ', '32932893', 'hdfc', 'e2e29', '2111', '2025-09-16', 'Government', '2026-01-06 13:17:01'),
(2, 42, '1970-02-10', 'parul university', '2323242', 'hdfc', '31312121', '34232', '2020-06-15', 'Government', '2026-01-10 12:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `pension_applications`
--

CREATE TABLE `pension_applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pension_type` varchar(50) DEFAULT NULL,
  `aadhaar_file` varchar(255) DEFAULT NULL,
  `bank_file` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pension_applications`
--

INSERT INTO `pension_applications` (`id`, `user_id`, `pension_type`, `aadhaar_file`, `bank_file`, `status`, `applied_at`) VALUES
(1, 7, 'Government', '1767516785_aadhaar_ChatGPT Image Apr 2, 2025, 12_20_32 AM.png', '1767516785_bank_ChatGPT Image Apr 2, 2025, 12_20_32 AM.png', 'Approved', '2026-01-04 08:53:05'),
(2, 37, 'Government', '1767806439_aadhaar_ChatGPT Image Mar 29, 2025, 07_32_41 PM.png', '1767806439_bank_ChatGPT Image Mar 29, 2025, 07_32_41 PM.png', 'Approved', '2026-01-07 17:20:39'),
(3, 38, 'Private', '1767942048_aadhaar_ChatGPT Image Apr 2, 2025, 12_20_32 AM.png', '1767942048_bank_ChatGPT Image Apr 2, 2025, 12_20_32 AM.png', 'Approved', '2026-01-09 07:00:48'),
(4, 42, 'Government', '1768049223_aadhaar_ChatGPT Image Apr 2, 2025, 12_20_32 AM.png', '1768049223_bank_ChatGPT Image Mar 29, 2025, 07_20_17 PM.png', 'Approved', '2026-01-10 12:47:03');

-- --------------------------------------------------------

--
-- Table structure for table `pension_details`
--

CREATE TABLE `pension_details` (
  `user_id` int(11) NOT NULL,
  `monthly_amount` decimal(10,2) DEFAULT NULL,
  `pension_start_date` date DEFAULT NULL,
  `status` enum('Active','Suspended','Stopped') DEFAULT NULL,
  `last_credited_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pension_history`
--

CREATE TABLE `pension_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `month_year` varchar(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `credited_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deduction` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pension_history`
--

INSERT INTO `pension_history` (`id`, `user_id`, `month_year`, `amount`, `status`, `credited_date`, `created_at`, `deduction`) VALUES
(1, 7, 'JANUARY', 7000.00, 'Credited', '2026-01-01', '2026-01-06 14:03:05', 0.00),
(2, 37, 'JANUARY', 8000.00, 'Pending', '2026-01-01', '2026-01-07 17:23:28', 0.00),
(3, 37, 'JANUARY', 8000.00, 'Credited', '2026-01-01', '2026-01-07 17:27:00', 0.00),
(4, 7, 'JANUARY', 6000.00, 'Credited', '2025-08-01', '2026-01-08 10:53:12', 0.00),
(5, 7, 'JANUARY', 6000.00, 'Credited', '2025-08-12', '2026-01-10 12:54:39', 0.00),
(6, 42, 'NOVEMBER', 8000.00, 'Credited', '2025-11-05', '2026-01-10 12:55:25', 0.00),
(7, 42, 'DECEMBER', 8000.00, 'Credited', '2026-01-06', '2026-01-10 13:13:38', 0.00),
(8, 42, 'DECEMBER', 8000.00, 'Credited', '2026-01-06', '2026-01-10 13:21:20', 0.00),
(9, 42, 'DECEMBER', 8000.00, 'Credited', '2026-01-06', '2026-01-10 13:21:40', 0.00),
(10, 42, 'JANUARY', 8000.00, 'Credited', '2026-01-08', '2026-01-17 12:24:21', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL,
  `is_verified` tinyint(4) DEFAULT 0,
  `login_otp` varchar(10) DEFAULT NULL,
  `otp_expires_at` datetime DEFAULT NULL,
  `login_otp_expires_at` datetime DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` datetime DEFAULT NULL,
  `failed_attempts` int(11) DEFAULT 0,
  `account_status` enum('active','blocked') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `otp`, `is_verified`, `login_otp`, `otp_expires_at`, `login_otp_expires_at`, `profile_photo`, `created_at`, `last_login`, `failed_attempts`, `account_status`) VALUES
(7, 'THINZAR AUNG', 'aungthinzar455@gmail.com', NULL, '$2y$10$PPXdv9UhYlEsbZ3YmToitexFQccpNbxInvsQI/kYBQizF/zoG2a5G', NULL, 1, '315220', NULL, '2026-02-21 16:27:09', NULL, '2026-02-21 13:38:24', NULL, 0, 'active'),
(37, 'client', 'avasarmaru123@gmail.com', NULL, '$2y$10$qcIAmNXolsrh6TQtshXZPuWDj9x0wNIwuCgEAnij.Cy2E5RUV/7TK', NULL, 1, NULL, NULL, NULL, NULL, '2026-02-21 13:38:24', NULL, 0, 'active'),
(38, 'zuwi', 'zuhamabeid@gmail.com', NULL, '$2y$10$0w8ZKfE9zpP5H4uBlq.1.umDnx5aqzUDflC.F5dil9RgTCUzKl3jW', NULL, 1, '180531', NULL, '2026-02-13 04:30:54', NULL, '2026-02-21 13:38:24', NULL, 0, 'active'),
(40, 'douza', 'test@gmail.com', NULL, '$2y$10$6PgJKSznY/XSiF1q0M1fo.XDwKUy8ubfsh16.kiHRWIE.1Lf0/U6m', '922115', 0, NULL, '2026-01-09 20:36:20', NULL, NULL, '2026-02-21 13:38:24', NULL, 0, 'active'),
(42, 'flower1', '2305101020103@paruluniversity.ac.in', NULL, '$2y$10$VWxmU/cm8.8.jTJm3ixfMe.y102NmPfrbC8xNxF8ov1lFIYcKceLq', NULL, 1, NULL, NULL, NULL, NULL, '2026-02-21 13:38:24', NULL, 0, 'active'),
(43, 'hjhjh', 'aungthinzar455@gmail.comm', NULL, '$2y$10$uYrQEtSYzoFjO4Y8RQGj4OTrJRB9cwhK6x3Tg/SW/p.AgVivQM/le', '553043', 0, NULL, '2026-01-19 09:07:12', NULL, NULL, '2026-02-21 13:38:24', NULL, 0, 'active'),
(44, 'ZUZU', 'ksaidsimai@gmail.com', NULL, '$2y$10$AHcA9Ulu2X8M2cU6/VcNUePCM9WO7UxevYaxmvXTGUl1loBNFRvRi', '481591', 0, NULL, '2026-02-13 04:32:24', NULL, NULL, '2026-02-21 13:38:24', NULL, 0, 'active'),
(45, 'Rose', '', '8141194754', '$2y$10$xJB1ZQm6DKyXHeo.2QalBOJSh2.QGZ1huK6.uhpboBl8gGrKqSFDG', '623058', 0, NULL, '2026-02-21 12:18:01', NULL, NULL, '2026-02-21 13:38:24', NULL, 0, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `life_certificates`
--
ALTER TABLE `life_certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pension`
--
ALTER TABLE `pension`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pensioner_profile`
--
ALTER TABLE `pensioner_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pension_applications`
--
ALTER TABLE `pension_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pension_details`
--
ALTER TABLE `pension_details`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `pension_history`
--
ALTER TABLE `pension_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD UNIQUE KEY `email_3` (`email`),
  ADD UNIQUE KEY `phone_2` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `life_certificates`
--
ALTER TABLE `life_certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pension`
--
ALTER TABLE `pension`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pensioner_profile`
--
ALTER TABLE `pensioner_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pension_applications`
--
ALTER TABLE `pension_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pension_history`
--
ALTER TABLE `pension_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pension_details`
--
ALTER TABLE `pension_details`
  ADD CONSTRAINT `pension_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
