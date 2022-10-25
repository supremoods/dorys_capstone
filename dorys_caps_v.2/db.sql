-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2022 at 02:49 PM
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
  `address` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `user_token`, `fullname`, `email`, `address`, `number`, `password`, `avatar`, `status`) VALUES
(2, '6e59879b29a54e43', 'John Lappay', 'lappay.john@gmail.com', 'Phase 3 Blk 3, Lot 20, Tanigue St./Kaunlaran Village, Caloocan City', '0992114073', '$2y$10$mpFfEVmzf4NkG4svMRjpEuHCxuc5LSgNFBG4p17.G7Ax8TqMK6pEi', 'oreo.png', 'inactive'),
(9, '635193d692d0d', 'John Doe', 'john.doe@gmail.com', 'this is a sample address/this is a sample address 2', '09972114073', '$2y$10$whIypU4JdWT3tHhTG.vMn.41GGFWuG.hyyGasbHa.ZY0XkSBney/a', '1663308169880.jpg', 'active');

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
(69, '142faa1a5aafe2b0', '6e59879b29a54e43', '2022-10-08 09:31:05', '2022-10-19 12:47:22'),
(70, 'ac1cc4aff6b4cff5', '6e59879b29a54e43', '2022-10-10 11:31:49', NULL),
(71, 'e4667dd354d552f4', '6e59879b29a54e43', '2022-10-18 02:26:58', '2022-10-19 01:00:29'),
(72, 'a591b0ec7805f8d6', '635193d692d0d', '2022-10-21 02:54:16', '2022-10-21 03:18:40'),
(73, '8228d27bfd344ef9', '6e59879b29a54e43', '2022-10-21 03:20:12', '2022-10-21 03:20:33'),
(74, 'e5872d38575a1fdb', '6e59879b29a54e43', '2022-10-21 03:25:03', '2022-10-21 03:25:28'),
(75, 'e35a056aa24bd97c', '6e59879b29a54e43', '2022-10-21 03:26:09', NULL),
(76, 'dd9e6e52b534c87b', '635193d692d0d', '2022-10-21 10:34:58', NULL),
(77, '1c915e89ef2b3f1c', '6e59879b29a54e43', '2022-10-21 11:20:23', NULL),
(78, '0485c3c7d1213a9b', '6e59879b29a54e43', '2022-10-22 09:36:21', '2022-10-22 12:10:53'),
(79, '888c21f19e86b75c', '635193d692d0d', '2022-10-22 12:11:07', NULL),
(80, 'a21e5127c3fe162b', '635193d692d0d', '2022-10-22 12:43:51', '2022-10-22 05:23:31'),
(81, 'a64cdc54bc1ad279', '635193d692d0d', '2022-10-22 05:23:48', '2022-10-22 05:24:02'),
(82, 'f51516d4110916df', '635193d692d0d', '2022-10-22 05:25:34', '2022-10-22 06:50:38'),
(83, 'facab3906aa97baf', '635193d692d0d', '2022-10-22 06:53:38', '2022-10-22 11:16:55'),
(84, '1d3267e2d201ed46', '635193d692d0d', '2022-10-22 11:54:16', NULL),
(85, '7ff5bcec8412ea96', '635193d692d0d', '2022-10-23 01:55:22', NULL),
(86, '0fed15cb519f72d0', '6e59879b29a54e43', '2022-10-23 04:36:35', NULL),
(87, '132f9391f513b4b6', '6e59879b29a54e43', '2022-10-24 09:26:30', NULL),
(88, 'c8903e0a720ec54d', '6e59879b29a54e43', '2022-10-24 10:11:12', '2022-10-24 07:56:41'),
(89, 'b879f5671dafb03b', '635193d692d0d', '2022-10-24 07:56:55', '2022-10-25 12:05:25'),
(90, 'cad8cbdca2994990', '6e59879b29a54e43', '2022-10-25 12:05:57', NULL),
(91, '363244918a0feb5e', '6e59879b29a54e43', '2022-10-25 09:50:55', '2022-10-25 09:53:28'),
(92, '5a2b966ab705fc78', '635193d692d0d', '2022-10-25 09:53:49', '2022-10-25 10:23:21'),
(93, 'ed9055cd0551e7b9', '635193d692d0d', '2022-10-25 10:33:17', '2022-10-25 10:33:26'),
(94, 'eba684d158ed0610', '635193d692d0d', '2022-10-25 11:51:54', NULL);

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
(3, '8de42f70f3bc82f1962b96cada', 'Longos, Malabon', 'https://goo.gl/maps/VZomZsNYu12ehXJT7', '09972114073', '09923124442', 'dorysresort@gmail.com', 'https://www.twitter.com/', 'https://www.facebook.com/', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.117569972251!2d120.95702681375505!3d14.649266879812126!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b5b6ba02957f:0x91b89c7caf3fb618!2s20 Hasa-Hasa!5e0!3m2!1sfil!2sph!4v1659932886552!5m2!1sfil!2sph');

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE `queries` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`id`, `email`, `phone`, `message`) VALUES
(2, 'lappay.john@gmail.com', '09972114073', 'this is a sample test message for contact us section'),
(3, 'lappay.john@gmail.com', '09972114073', 'supreasdasdoi asjdas asjsjsjs asasdkjasdjkasdasd'),
(4, 'john.doe@gmail.com', '0997211403', 'supremoasd askjdja as dajkd basd a \nasdasdasdasda');

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
(28, '3d33ff16f6211482', 'pending'),
(29, '32cb8fcee9341d07', 'pending'),
(34, 'daf72bbe5255b430', 'pending');

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
  `settlement_fee` double NOT NULL,
  `message` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `user_token`, `service_token`, `reservation_token`, `start_datetime`, `end_datetime`, `mode_of_payment`, `settlement_fee`, `message`) VALUES
(30, '6e59879b29a54e43', '916c696fa61a769c', '3d33ff16f6211482', '2022-10-27 08:44:00', '2022-10-27 18:25:00', 'cash', 2000, 'asdasdlkajnn asasas daskjasd  askjbnasdasdaasdasjkbasd'),
(31, '635193d692d0d', 'f375ebf2b8154017', '32cb8fcee9341d07', '2022-10-24 10:20:00', '2022-10-24 22:20:00', 'cash', 1500, 'asdasdasdasdasd'),
(36, '635193d692d0d', '916c696fa61a769c', 'daf72bbe5255b430', '2022-10-24 10:32:00', '2022-10-24 22:32:00', 'cash', 2400, 'sdasdasd asd assads dasas dsasa');

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
(42, '459daba73a28dd8b', 'VIP', 'fully air conditioned,videoke,bbq grill,water dispenser,food warmer', 'Capacity: 12 persons', 'slide1.jpg', '500'),
(43, 'f375ebf2b8154017', 'Alfresco', 'videoke,bbq grill,water dispenser,food warmer', 'Capacity: 30 persons', 'slide2.jpg', '500'),
(44, '916c696fa61a769c', 'Gazebo', 'videoke,water dispenser,food warmer', 'Capacity: 8 persons', 'slide5.jpg', '200');

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
-- Indexes for table `queries`
--
ALTER TABLE `queries`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `client_log_history`
--
ALTER TABLE `client_log_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `request_reservation`
--
ALTER TABLE `request_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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
