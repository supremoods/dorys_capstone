-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2022 at 04:40 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dors_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_id`, `username`, `password`) VALUES
(1, '8de42f70f3bc82f1962b96cada', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(255) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `admin_id`, `message`) VALUES
(3, '8de42f70f3bc82f1962b96cada', 'This is a test');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `user_token` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `user_token`, `fullname`, `email`, `address`, `number`, `password`, `avatar`, `status`) VALUES
(2, '6e59879b29a54e43', 'john lappay', 'lappayjohn@gmail.com', 'asdk qoiwd ', '09972114073', '$2y$10$mpFfEVmzf4NkG4svMRjpEuHCxuc5LSgNFBG4p17.G7Ax8TqMK6pEi', 'oreo.png', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `client_log_history`
--

CREATE TABLE `client_log_history` (
  `id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `user_token` varchar(255) NOT NULL,
  `log_in_stamp` datetime DEFAULT NULL,
  `log_out_stamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_log_history`
--

INSERT INTO `client_log_history` (`id`, `session_id`, `user_token`, `log_in_stamp`, `log_out_stamp`) VALUES
(55, '5ee2f99850532abc', '6e59879b29a54e43', '2023-09-22 12:15:52', '2023-09-22 12:16:17'),
(56, '72b340d2ac168767', '6e59879b29a54e43', '2022-09-23 12:23:12', '2022-09-23 12:23:26'),
(57, 'f14f226abba9ada3', '6e59879b29a54e43', '2022-09-23 08:26:09', '2022-09-23 08:26:36'),
(58, 'dec22eca01f7286a', '6e59879b29a54e43', '2022-09-23 08:31:00', '2022-09-23 08:31:01'),
(59, '6b758d460dd63fca', '6e59879b29a54e43', '2022-09-23 08:51:02', '2022-09-23 11:14:17'),
(60, '748f01bf3b8e899e', '6e59879b29a54e43', '2022-09-25 01:21:47', NULL),
(61, 'b64b6d28002632fe', '6e59879b29a54e43', '2022-09-26 01:24:49', NULL),
(62, 'b8f2bd61b302dfbc', '6e59879b29a54e43', '2022-09-27 10:05:55', '2022-09-27 10:05:57'),
(63, '0d2187206460d5da', '6e59879b29a54e43', '2022-09-27 11:27:11', NULL),
(64, 'b7725d067c526bba', '6e59879b29a54e43', '2022-10-03 07:18:50', NULL),
(65, '3c76d72299e02d4a', '6e59879b29a54e43', '2022-10-04 10:15:17', '2022-10-04 10:50:00'),
(66, 'f984608fa768e7e0', '6e59879b29a54e43', '2022-10-04 10:50:07', NULL),
(67, '6a7799d3b2139684', '6e59879b29a54e43', '2022-10-08 12:29:13', NULL),
(68, '55b187f9e22316ad', '6e59879b29a54e43', '2022-10-08 01:12:01', NULL),
(69, '142faa1a5aafe2b0', '6e59879b29a54e43', '2022-10-08 09:31:05', NULL),
(70, 'ac1cc4aff6b4cff5', '6e59879b29a54e43', '2022-10-10 11:31:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gmap` varchar(255) NOT NULL,
  `phone_number_1` varchar(255) NOT NULL,
  `phone_number_2` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `iframe` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`id`, `admin_id`, `address`, `gmap`, `phone_number_1`, `phone_number_2`, `email`, `twitter`, `facebook`, `iframe`) VALUES
(3, '8de42f70f3bc82f1962b96cada', 'Longos, Malabon', 'https://goo.gl/maps/VZomZsNYu12ehXJT7', '09972114073', '09923124442', 'diakoisangrobot12@gmail.com', 'https://www.twitter.com/', 'https://www.facebook.com/', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.117569972251!2d120.95702681375505!3d14.649266879812126!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b5b6ba02957f:0x91b89c7caf3fb618!2s20 Hasa-Hasa!5e0!3m2!1sfil!2sph!4v1659932886552!5m2!1sfil!2sph');

-- --------------------------------------------------------

--
-- Table structure for table `request_reservation`
--

CREATE TABLE `request_reservation` (
  `id` int(11) NOT NULL,
  `reservation_token` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_reservation`
--

INSERT INTO `request_reservation` (`id`, `reservation_token`, `status`) VALUES
(27, '60b7f650dcbd4b6f', 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `user_token` varchar(255) NOT NULL,
  `service_token` varchar(255) NOT NULL,
  `reservation_token` varchar(255) NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `mode_of_payment` varchar(255) NOT NULL,
  `settlement_fee` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `user_token`, `service_token`, `reservation_token`, `start_datetime`, `end_datetime`, `mode_of_payment`, `settlement_fee`) VALUES
(28, '6e59879b29a54e43', 'f2d5233d569bf1b0', '60b7f650dcbd4b6f', '2022-10-10 09:31:00', '2022-10-10 21:31:00', 'cash', 2500);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `services_token` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `features` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `images` longtext NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `services_token`, `name`, `features`, `description`, `images`, `price`) VALUES
(41, 'f2d5233d569bf1b0', 'Street Photography', 'traffic  lights,pedestrian', 'This is a sample description', 'IMG_20211210_160105.jpg, IMG_20211210_160144.jpg', '2500');

-- --------------------------------------------------------

--
-- Table structure for table `services_gallery`
--

CREATE TABLE `services_gallery` (
  `id` int(11) NOT NULL,
  `reservation_token` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `website_stats`
--

CREATE TABLE `website_stats` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(255) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `website_stats`
--

INSERT INTO `website_stats` (`id`, `admin_id`, `shutdown`) VALUES
(1, '8de42f70f3bc82f1962b96cada', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_log_history`
--
ALTER TABLE `client_log_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_reservation`
--
ALTER TABLE `request_reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services_gallery`
--
ALTER TABLE `services_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_stats`
--
ALTER TABLE `website_stats`
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
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `client_log_history`
--
ALTER TABLE `client_log_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `request_reservation`
--
ALTER TABLE `request_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `services_gallery`
--
ALTER TABLE `services_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `website_stats`
--
ALTER TABLE `website_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
