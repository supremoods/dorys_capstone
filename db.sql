-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 21, 2022 at 09:39 AM
-- Server version: 10.5.16-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u376903371_dorys_db`
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
(1, '8de42f70f3bc82f1962b96cada', 'admin', '@dorysAdmin');

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
(9, '8de42f70f3bc82f1962b96cada', 'DWadsadsadjakl');

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
(2, '6e59879b29a54e43', 'John Lappay', 'lappay.john@gmail.com', 'Phase 3 Blk 3, Lot 20, Tanigue St. Kaunlaran Village, Caloocan City', '0992114073', '$2y$10$mpFfEVmzf4NkG4svMRjpEuHCxuc5LSgNFBG4p17.G7Ax8TqMK6pEi', 'oreo.png', 'inactive'),
(16, '6368d334c2edd', 'Nam Do San', 'namDoSan@gmail.com', NULL, NULL, '$2y$10$OxHOjuLA/sgka/eERTdDxuKlg903P.399OlOcFiFgzYTCslzA.mBW', NULL, 'inactive'),
(18, '6369ec85056e7', 'Simon Dave D. Talon', 'talonsero14@gmail.com', 'Malabon City/', '09998529009', '$2y$10$DGKCHEEcbIgKS6T.u.tb0uDHAsPYbkjo1k5uSnMTym6Z/.aNsJEva', NULL, 'inactive'),
(20, '636cb9572c3f8', 'tricia', 'triciapaz19@gmail.com', 'Basta City/', '09291314949', '$2y$10$BDRdDEIMtl01uAJ5jDdDc.45L2PxmgYrZ9nWFLvubsdshJAXz75iu', NULL, 'inactive'),
(21, '636ce19342872', 'Jerome Villajos', 'jeromevillajos12@gmail.com', 'Purok  6 Hernandez St. Catmon, Malabon City./', '09297575119', '$2y$10$ocfBOCaDPy7Jxrg5n5O35OhvvQ7QWDZgbOlzZepGHJfYfzNjdKyB.', NULL, 'active'),
(24, '6374f1263e714', 'Simon Dave D. Talon', 'talonsero14@gmail.com', 'Malabanias/', '0918 351 8409', '$2y$10$4a2Gp7fcyjkh8.CEov8GLeCxoOMJJ998ld50KhdvLOlxWJx8Z0Nkm', NULL, 'inactive'),
(25, '6375c997ccd3a', 'serra', 'serra@gmail.com', NULL, NULL, '$2y$10$OtePHWD84UItsNG9b.jtJOeq7t676o7ZS7EXBOS2v0Jyv9RS4vJ1K', NULL, 'inactive'),
(26, '6375c9ba1f96e', 'rondina', 'reymond09@gmail.com', 'swadasdada/', '09297575119', '$2y$10$NHx1sOMbP41PZzNxjii8uufB8fStfqmqnPU67ZLf0MTMe2KvkGEku', NULL, 'active');

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
(94, 'eba684d158ed0610', '635193d692d0d', '2022-10-25 11:51:54', NULL),
(95, '664b9aa9ef391539', '635193d692d0d', '2022-10-25 10:51:20', '2022-10-26 12:57:56'),
(96, 'e90fba96469e44e3', '635193d692d0d', '2022-10-26 04:57:35', NULL),
(97, '894be9cc29d7454b', '635193d692d0d', '2022-10-27 10:47:26', '2022-10-27 11:30:06'),
(98, '1b419f7b3154c2cb', '635aa86ac7fe2', '2022-10-27 11:49:18', '2022-10-30 03:03:47'),
(99, '788f403ca588572e', '635193d692d0d', '2022-10-28 09:22:04', '2022-10-28 11:14:13'),
(100, 'f6e32802d19be239', '635193d692d0d', '2022-10-28 11:46:09', '2022-10-29 12:11:30'),
(101, '615a2b6f94935e56', '635193d692d0d', '2022-10-29 01:25:33', NULL),
(102, '70b36a8f8b08bef5', '635193d692d0d', '2022-10-29 05:32:05', NULL),
(103, 'c64e93dab629cd1c', '635193d692d0d', '2022-10-31 01:07:40', NULL),
(104, '3af0d8c845efd588', '635193d692d0d', '2022-10-31 08:19:03', NULL),
(105, 'd3aacc39120fc881', '635193d692d0d', '2022-10-31 09:21:29', '2022-11-02 01:00:31'),
(106, 'f30cf970e84dc466', '635193d692d0d', '2022-11-01 01:53:15', NULL),
(107, 'e8f6643e75c2931a', '635193d692d0d', '2022-11-01 11:25:29', '2022-11-01 11:36:32'),
(108, 'fc299ee21c77b844', '635193d692d0d', '2022-11-01 11:26:25', NULL),
(109, '58fd1bef61d1c0f8', '635aa86ac7fe2', '2022-11-01 11:36:54', NULL),
(110, '5838e5018b9a81e8', '635aa86ac7fe2', '2022-11-02 01:00:47', '2022-11-02 01:30:30'),
(111, 'e049a37373064f7f', '635aa86ac7fe2', '2022-11-02 01:32:10', '2022-11-02 01:46:51'),
(112, '7f301dec2eb991ab', '635193d692d0d', '2022-11-02 01:47:09', '2022-11-02 01:49:55'),
(113, 'e04b475acde5e502', '6e59879b29a54e43', '2022-11-02 01:50:12', '2022-11-02 02:05:15'),
(114, '94ca6fcbaaad80a7', '635193d692d0d', '2022-11-02 03:03:11', NULL),
(115, 'f976b74d1ba0384d', '635193d692d0d', '2022-11-05 05:05:03', '2022-11-05 11:48:53'),
(116, '75dfe322c4dd0dd2', '635193d692d0d', '2022-11-06 12:14:58', NULL),
(117, '6da9b658a9f6f7b6', '6368d334c2edd', '2022-11-07 05:43:27', '2022-11-07 06:32:26'),
(118, 'a2097e786751c57b', '6368d334c2edd', '2022-11-07 06:34:07', '2022-11-07 06:34:44'),
(119, '18db430f4fc20e14', '635193d692d0d', '2022-11-07 06:34:55', '2022-11-07 06:34:59'),
(120, '9941a5fa1b9e97f0', '6368d334c2edd', '2022-11-07 06:35:16', NULL),
(121, '4a33b15dbdb2ba53', '635193d692d0d', '2022-11-07 10:12:31', NULL),
(122, '6ec769e238e9f2e8', '6368d334c2edd', '2022-11-07 11:16:30', '2022-11-07 11:34:55'),
(123, '57fa976969adc49c', '6368d334c2edd', '2022-11-08 12:06:30', '2022-11-08 12:08:07'),
(124, '82772e488da1306b', '6368d334c2edd', '2022-11-08 10:36:26', '2022-11-08 10:37:15'),
(125, '5320d708ee1a0761', '635193d692d0d', '2022-11-08 10:37:29', '2022-11-08 10:49:01'),
(126, '414257ba2e7410f0', '6369c3c7e17e8', '2022-11-08 10:49:47', '2022-11-08 11:02:35'),
(127, '5d0152d827495e28', '6369c3c7e17e8', '2022-11-08 11:51:35', NULL),
(128, 'df84c44214329e91', '635193d692d0d', '2022-11-08 01:32:34', '2022-11-08 01:35:39'),
(129, '13f02a1431ee9746', '6369c3c7e17e8', '2022-11-08 01:34:37', '2022-11-08 01:38:28'),
(130, '9ebfe04f489412dd', '6368d334c2edd', '2022-11-08 01:35:59', '2022-11-08 01:36:30'),
(131, '658e35b3ba248e46', '6369ec85056e7', '2022-11-08 01:43:42', '2022-11-08 02:43:37'),
(132, '0c1a9950f999863a', '6e59879b29a54e43', '2022-11-08 02:19:22', NULL),
(133, '1541a874f6d65e85', '6369c3c7e17e8', '2022-11-08 02:48:50', '2022-11-08 02:57:59'),
(134, '3cfbf750464c667a', '6369c3c7e17e8', '2022-11-08 07:58:58', NULL),
(135, '7c9df0912ded1690', '6369c3c7e17e8', '2022-11-08 07:58:58', '2022-11-08 08:54:48'),
(136, '4d9f2a1c80a382eb', '6369c3c7e17e8', '2022-11-09 07:38:44', '2022-11-09 07:40:59'),
(137, '4ca52d1289f901ed', '636cb9572c3f8', '2022-11-10 04:42:27', '2022-11-10 04:53:53'),
(138, '9e0f0f67497d51c6', '6369ec85056e7', '2022-11-10 04:53:14', '2022-11-10 05:38:56'),
(139, '07910bd99b6b10de', '6369c3c7e17e8', '2022-11-10 06:39:31', '2022-11-10 07:11:45'),
(140, '02534b0fc9de2034', '6369c3c7e17e8', '2022-11-10 07:32:25', '2022-11-10 07:32:50'),
(141, '1021b1320f085dce', '636ce19342872', '2022-11-10 07:33:48', '2022-11-10 09:08:09'),
(142, '1f94bb34ea866e26', '63724a61e12f8', '2022-11-14 10:02:24', NULL),
(143, '9a34bd5c59e43ce6', '6e59879b29a54e43', '2022-11-14 11:09:39', '2022-11-14 11:35:30'),
(144, '31f8c10c691622f1', '636ce19342872', '2022-11-14 11:38:12', NULL),
(145, 'f229d36641264abc', '636ce19342872', '2022-11-15 07:53:53', '2022-11-15 07:54:47'),
(146, 'ba14b83d87ae4043', '636ce19342872', '2022-11-15 07:55:36', NULL),
(147, '9014ba7983d4fa4e', '636ce19342872', '2022-11-15 10:57:30', NULL),
(148, '9779822221eb74b5', '636ce19342872', '2022-11-15 11:01:23', NULL),
(149, 'a4e2ea425d72cc4e', '636ce19342872', '2022-11-15 11:34:38', NULL),
(150, '749b5c27d1180d82', '636ce19342872', '2022-11-15 09:49:57', NULL),
(151, '49479fdcc85b28d9', '636ce19342872', '2022-11-15 10:33:21', '2022-11-15 10:47:35'),
(152, '98b31cda5bf21de4', '636ce19342872', '2022-11-15 10:52:45', NULL),
(153, 'fb1aca4441637cef', '636ce19342872', '2022-11-15 10:58:00', NULL),
(154, '1888d21741023528', '636ce19342872', '2022-11-15 10:59:08', NULL),
(155, 'b0546a3d699d9d2d', '636ce19342872', '2022-11-15 11:00:12', NULL),
(156, 'c4dee7018ff828ca', '636ce19342872', '2022-11-16 10:40:29', '2022-11-16 10:43:35'),
(157, '0b5be6a29fb5c92e', '636ce19342872', '2022-11-16 02:47:32', NULL),
(158, 'e536ba4cda68c22a', '636ce19342872', '2022-11-16 06:42:30', NULL),
(159, '4a8b4c3dd985b750', '6374ee497b509', '2022-11-16 10:06:21', '2022-11-16 10:17:27'),
(160, '457d332dffa8eaba', '636ce19342872', '2022-11-16 10:07:38', NULL),
(161, 'c15b5f6fc2fa9f5f', '636ce19342872', '2022-11-16 10:07:40', NULL),
(162, '32a1783db84ca3bf', '636ce19342872', '2022-11-16 10:12:42', NULL),
(163, '10eff0639764588a', '636ce19342872', '2022-11-16 10:14:00', NULL),
(164, 'ac08c8942929a8e9', '6374f1263e714', '2022-11-16 10:18:17', '2022-11-16 11:06:21'),
(165, '278c88cb88da606f', '636ce19342872', '2022-11-16 10:36:24', NULL),
(166, 'ba58d3851c279723', '6374f1263e714', '2022-11-17 08:06:16', NULL),
(167, '09bb5525240158fc', '636ce19342872', '2022-11-17 10:16:02', NULL),
(168, 'c34e9de679460db9', '636ce19342872', '2022-11-17 10:16:02', NULL),
(169, '6d50a5e3a71cdb64', '636ce19342872', '2022-11-17 10:17:19', NULL),
(170, 'bb56ae4847d2b0d2', '636ce19342872', '2022-11-17 10:17:19', '2022-11-17 10:32:12'),
(171, 'e2f97251e1e1d3e5', '636ce19342872', '2022-11-17 10:32:24', '2022-11-17 10:34:36'),
(172, 'fe41cf8ca53c06b7', '6374f1263e714', '2022-11-17 10:32:31', NULL),
(173, 'c1c910ed5c388551', '636ce19342872', '2022-11-17 10:35:15', '2022-11-17 10:35:32'),
(174, '03edb12a0eed42d5', '6374f1263e714', '2022-11-17 10:36:18', '2022-11-17 10:38:23'),
(175, '6f0c41d7bba77222', '636ce19342872', '2022-11-17 10:38:55', '2022-11-17 10:40:00'),
(176, '6d10e6119efe6d9d', '6369ec85056e7', '2022-11-17 10:41:33', '2022-11-17 10:43:48'),
(177, '047ea1dacce8a7c2', '636ce19342872', '2022-11-17 10:48:20', NULL),
(178, 'eeecd7fb093fe9a7', '636ce19342872', '2022-11-17 10:48:21', '2022-11-17 10:53:59'),
(179, 'e786c11059cb15ae', '636ce19342872', '2022-11-17 01:41:17', '2022-11-17 01:41:28'),
(180, '54297f5188c61073', '6375c9ba1f96e', '2022-11-17 01:42:26', NULL),
(181, '0fb6b28ab2e6f958', '636ce19342872', '2022-11-18 07:19:25', NULL),
(182, '909f9936035d4381', '636ce19342872', '2022-11-20 12:50:56', NULL),
(183, '7d2bc8b28f6349c1', '636ce19342872', '2022-11-21 09:53:52', NULL);

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
  `instagram` varchar(255) NOT NULL,
  `iframe` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`id`, `admin_id`, `address`, `gmap`, `phone_number_1`, `phone_number_2`, `email`, `twitter`, `facebook`, `instagram`, `iframe`) VALUES
(4, '', 'Longos, Malabon', 'https://goo.gl/maps/VZomZsNYu12ehXJT7', '09972114073', '09923124442', 'dorysresort@gmail.com', 'https://www.twitter.com/', 'https://www.facebook.com/', 'https://www.instagram.com/', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.117569972251!2d120.95702681375505!3d14.649266879812126!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b5b6ba02957f:0x91b89c7caf3fb618!2s20 Hasa-Hasa!5e0!3m2!1sfil!2sph!4v1659932886552!5m2!1sfil!2sph');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `start`) VALUES
(12, 'Unavailable', '2022-11-09 00:00:00'),
(13, 'Unavailable', '2022-11-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` int(11) NOT NULL,
  `gcash_qr` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`id`, `gcash_qr`, `number`, `name`) VALUES
(2, 'GCash-MyQR-08112022140545.PNG.jpg', '09297575119', 'J****E V*L**J*S');

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE `queries` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `timeStamp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`id`, `email`, `phone`, `message`, `timeStamp`) VALUES
(30, 'jerico.victoria@gmail.com', '09972114073', 'sdsdssss', '2022-10-29'),
(31, 'jerico.victoria@gmail.com', '09972114073', 'asdasd askjdahsdasbd asjkajskdjkhasda', '2022-11-01'),
(32, 'talonsero14@gmail.com', '09998529009', 'dkdasjdioajdsal', '2022-11-08');

-- --------------------------------------------------------

--
-- Table structure for table `request_reservation`
--

CREATE TABLE `request_reservation` (
  `id` int(11) NOT NULL,
  `reservation_token` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_reservation`
--

INSERT INTO `request_reservation` (`id`, `reservation_token`, `status`, `date_created`) VALUES
(49, '86deefcb58f68ea9', 'confirmed', '2022-11-14 15:34:35'),
(52, 'a82336906dce5f4b', 'pending', '2022-11-14 15:34:35'),
(53, '57b757cf92a64140', 'pending', '2022-11-14 15:34:35'),
(54, 'fd337ace03ddc127', 'confirmed', '2022-11-14 15:34:35'),
(55, '9bde598ce2e3acac', 'cancelled', '2022-11-14 15:34:35'),
(56, 'e2fa2cc5a96479f3', 'pending', '2022-11-14 15:34:35'),
(58, '734682aac95d3952', 'confirmed', '2022-11-14 15:34:35'),
(60, '47ca465fd81f1263', 'pending', '2022-11-14 15:34:35'),
(62, 'b5b061d3ffb43ecc', 'confirmed', '2022-11-14 15:34:35'),
(63, '1c0827997ccea611', 'pending', '2022-11-14 15:34:35'),
(64, 'd635c8c907bc1131', 'pending', '2022-11-07 15:34:35'),
(66, '481a4837e3828b02', 'pending', '2022-11-15 03:21:25'),
(67, 'aa3a315cc82a2a80', 'confirmed', '2022-11-16 14:10:12'),
(69, '0c5b125e49adcd3f', 'confirmed', '2022-11-17 00:10:37'),
(70, '2e4c296226851107', 'pending', '2022-11-17 02:42:34'),
(71, '1fa13a6c88cc0f1b', 'confirmed', '2022-11-17 05:44:23');

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
  `message` longtext DEFAULT NULL,
  `gcash_ref_num` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `paid_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `user_token`, `service_token`, `reservation_token`, `start_datetime`, `end_datetime`, `mode_of_payment`, `settlement_fee`, `message`, `gcash_ref_num`, `payment_type`, `paid_amount`) VALUES
(51, '635193d692d0d', '459daba73a28dd8b', '86deefcb58f68ea9', '2022-11-11 15:00:00', '2022-11-11 20:00:00', 'gcash', 2500, 'asdssasdas', '3444234 33331 1111', 'Downpayment', 750),
(55, '635193d692d0d', '916c696fa61a769c', '57b757cf92a64140', '2022-11-14 08:00:00', '2022-11-14 16:00:00', 'gcash', 1600, 'sdsdd', '2222 333 1111', 'Downpayment', 480),
(56, '635193d692d0d', '459daba73a28dd8b', 'fd337ace03ddc127', '2022-11-14 13:00:00', '2022-11-14 19:00:00', 'gcash', 3000, 'sdasdasdas', '2333232 222 1112233', 'Downpayment', 900),
(57, '635193d692d0d', 'f375ebf2b8154017', '9bde598ce2e3acac', '2022-11-11 10:00:00', '2022-11-11 13:00:00', 'gcash', 1500, 'sss', '2323223 11111 222', 'Downpayment', 450),
(58, '635193d692d0d', 'f375ebf2b8154017', 'e2fa2cc5a96479f3', '2022-11-11 14:00:00', '2022-11-11 22:00:00', 'gcash', 4000, 'dfsdsfdfd', '877222', 'Downpayment', 1200),
(60, '6369ec85056e7', 'f375ebf2b8154017', '734682aac95d3952', '2022-11-11 05:00:00', '2022-11-11 08:00:00', 'gcash', 1500, 'dsadasdwadasda', '218932182924', 'Downpayment', 450),
(62, '6369ec85056e7', 'f375ebf2b8154017', '47ca465fd81f1263', '2022-11-10 07:00:00', '2022-11-10 09:00:00', 'gcash', 1000, 'dwadsadsa', '7006 650 644106', 'Downpayment', 300),
(64, '636cb9572c3f8', '916c696fa61a769c', 'b5b061d3ffb43ecc', '2022-11-10 00:00:00', '2022-11-10 01:00:00', 'gcash', 200, 'libre po ba?', '2918312483701385', 'Downpayment', 60),
(65, '6369ec85056e7', '459daba73a28dd8b', '1c0827997ccea611', '2022-11-11 10:00:00', '2022-11-11 13:00:00', 'gcash', 1500, '', '31241312312', 'Downpayment', 450),
(66, '636ce19342872', '459daba73a28dd8b', 'd635c8c907bc1131', '2022-11-12 07:00:00', '2022-11-12 14:00:00', 'gcash', 3500, '', '2000193988', 'Downpayment', 1050),
(68, '636ce19342872', '459daba73a28dd8b', '481a4837e3828b02', '2022-11-23 08:00:00', '2022-11-23 12:00:00', 'gcash', 2000, '', '423264332423', 'Downpayment', 600),
(69, '6374ee497b509', '459daba73a28dd8b', 'aa3a315cc82a2a80', '2022-11-17 13:00:00', '2022-11-17 16:00:00', 'gcash', 1500, '', '', 'Downpayment', 450),
(71, '6374f1263e714', '916c696fa61a769c', '0c5b125e49adcd3f', '2022-11-30 13:00:00', '2022-11-30 15:00:00', 'gcash', 400, '', '', 'Downpayment', 120),
(72, '6369ec85056e7', '459daba73a28dd8b', '2e4c296226851107', '2022-11-20 08:00:00', '2022-11-20 10:00:00', 'gcash', 1000, '', '', 'Downpayment', 300),
(73, '6375c9ba1f96e', 'f375ebf2b8154017', '1fa13a6c88cc0f1b', '2022-11-20 06:00:00', '2022-11-20 09:00:00', 'gcash', 1500, '', '2093289328392', 'Downpayment', 450);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `services_token` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `features` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `images` longtext NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `services_token`, `name`, `features`, `description`, `images`, `price`) VALUES
(42, '459daba73a28dd8b', 'VIP', 'fully air conditioned,videoke,bbq grill,water dispenser,food warmer', 'Capacity: 12 persons\n\n- FULLY AIR CONDITIONED\n- VIDEOKE / 65 INCH TV\n- BARBECUE GRILL\n- WATER DISPENSER\n- FOOD WARMER', 'slide1.jpg,5.jpg,4.jpg,3.jpg', '500'),
(43, 'f375ebf2b8154017', 'Alfresco', 'videoke,bbq grill,water dispenser,food warmer', 'Capacity: 30 persons\n\n- VIDEOKE\n- BARBECUE GRILL\n- WATER DISPENSER \n- FOOD WARMER', 'slide2.jpg', '500'),
(44, '916c696fa61a769c', 'Gazebo', 'videoke,water dispenser,food warmer', 'Capacity: 8 persons\n\n- VIDEOKE \n- BARBECUE GRILL \n- WATER DISPENSER', 'slide5.jpg', '200');

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
  `mode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `website_stats`
--

INSERT INTO `website_stats` (`id`, `admin_id`, `mode`) VALUES
(1, '8de42f70f3bc82f1962b96cada', 'Disabled');

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
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `client_log_history`
--
ALTER TABLE `client_log_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `request_reservation`
--
ALTER TABLE `request_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

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
