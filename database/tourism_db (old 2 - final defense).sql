-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2024 at 12:29 PM
-- Server version: 10.6.15-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u578342230_tourism_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `backup_recovery_log`
--

CREATE TABLE `backup_recovery_log` (
  `id` int(11) NOT NULL,
  `br_name` varchar(200) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `activity` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `backup_recovery_log`
--

INSERT INTO `backup_recovery_log` (`id`, `br_name`, `date_added`, `activity`) VALUES
(49, 'test', '2024-01-14 18:47:38', 'Back up '),
(50, 'backup_2024-01-14_19-54-28.zip', '2024-01-14 19:54:28', 'Back up '),
(51, 'backup_2024-01-14_19-58-18.zip', '2024-01-14 19:58:18', 'Back up '),
(52, 'backup_2024-01-14_19-58-34.zip', '2024-01-14 19:58:34', 'Back up '),
(53, 'backup_2024-01-14_19-58-41.zip', '2024-01-14 19:58:41', 'Back up '),
(54, 'backup_2024-01-14_19-58-59.zip', '2024-01-14 19:58:59', 'Back up '),
(55, 'backup_2024-01-14_20-05-34.zip', '2024-01-14 20:05:34', 'Back up '),
(56, 'backup_2024-01-14_20-05-47.zip', '2024-01-14 20:05:47', 'Back up '),
(57, 'backup_2024-01-14_20-06-26.zip', '2024-01-14 20:06:26', 'Back up '),
(58, 'backup_2024-01-14_20-07-25.zip', '2024-01-14 20:07:25', 'Back up '),
(59, 'backup_2024-01-14_20-51-15.zip', '2024-01-14 20:51:15', 'Back up '),
(60, 'backup_2024-01-14_20-51-23.zip', '2024-01-14 20:51:23', 'Back up '),
(61, 'backup_2024-01-14_20-52-07.zip', '2024-01-14 20:52:08', 'Back up '),
(62, 'backup_2024-01-14_20-52-31.zip', '2024-01-14 20:52:31', 'Back up '),
(63, 'backup_2024-01-14_20-53-12.zip', '2024-01-14 20:53:12', 'Back up '),
(64, 'backup_2024-01-14_20-54-56.zip', '2024-01-14 20:54:56', 'Back up '),
(65, 'backup_2024-01-14_20-55-35.zip', '2024-01-14 20:55:35', 'Back up '),
(66, 'backup_2024-01-14_20-57-45.zip', '2024-01-14 20:57:45', 'Back up '),
(67, 'backup_2024-01-14_20-57-53.zip', '2024-01-14 20:57:53', 'Back up '),
(68, 'backup_2024-01-14_21-12-47.zip', '2024-01-14 21:12:47', 'Back up '),
(69, 'backup_2024-01-14_21-13-23.zip', '2024-01-14 21:13:23', 'Back up '),
(70, 'backup_2024-01-14_21-13-52.zip', '2024-01-14 21:13:52', 'Back up '),
(71, 'backup_2024-01-14_21-14-04.zip', '2024-01-14 21:14:04', 'Back up '),
(72, 'backup_2024-01-14_21-18-10.zip', '2024-01-14 21:18:10', 'Back up '),
(73, 'backup_2024-01-14_21-18-43.zip', '2024-01-14 21:18:43', 'Back up '),
(74, 'backup_2024-01-14_21-20-37.zip', '2024-01-14 21:20:37', 'Back up '),
(75, 'backup_2024-01-14_21-21-41.zip', '2024-01-14 21:21:41', 'Back up '),
(76, 'wewe', '2024-01-14 21:23:42', 'Back up '),
(77, 'backup_2024-01-14_21-52-04.zip', '2024-01-14 21:52:05', 'Back up '),
(78, 'backup_2024-01-14_21-23-42.zip', '2024-01-14 21:52:12', 'Recovered'),
(79, 'backup_2024-01-14_21-21-41.zip', '2024-01-14 21:52:53', 'Recovered'),
(80, 'backup_2024-01-14_21-23-42.zip', '2024-01-14 21:53:47', 'Recovered'),
(81, 'backup_2024-01-14_21-23-42.zip', '2024-01-14 21:54:18', 'Recovered'),
(82, 'backup_2024-01-14_21-23-42.zip', '2024-01-14 21:56:22', 'Recovered'),
(83, 'backup_2024-01-14_21-23-42.zip', '2024-01-14 21:57:00', 'Recovered'),
(84, 'backup_2024-01-15_05-16-52.zip', '2024-01-14 21:16:52', 'Back up '),
(85, 'backup_2024-01-15_05-17-21.zip', '2024-01-14 21:17:21', 'Back up '),
(86, 'backup_2024-01-15_14-29-37.zip', '2024-01-15 06:29:37', 'Back up '),
(87, 'backup_2024-01-15_14-29-37.zip', '2024-01-15 06:29:59', 'Recovered');

-- --------------------------------------------------------

--
-- Table structure for table `book_list`
--

CREATE TABLE `book_list` (
  `id` int(11) NOT NULL,
  `book_list_id` varchar(200) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=pending,1=confirm, 2=cancelled\r\n',
  `remark` varchar(250) DEFAULT NULL,
  `schedule` date DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `book_list`
--

INSERT INTO `book_list` (`id`, `book_list_id`, `user_id`, `package_id`, `status`, `remark`, `schedule`, `date_created`) VALUES
(7, 'CV4FG5HI6J', 7, 10, 2, NULL, '2023-12-03', '2023-12-03 22:36:40'),
(8, 'CV7KL8MN9O', 16, 10, 3, NULL, '2024-01-12', '2024-01-12 23:26:09'),
(9, 'CVPQR0STU1', 7, 13, 3, NULL, '2024-01-13', '2024-01-12 23:27:42'),
(10, 'CV2VWX3YZ4', 16, 13, 3, NULL, '2024-01-13', '2024-01-13 13:10:23'),
(11, 'CV5AB6CD7E', 7, 13, 2, NULL, '2024-01-13', '2024-01-13 13:11:44'),
(12, 'CV1KL2MN3O', 16, 12, 2, 'Booking declined', '2024-01-14', '2024-01-13 20:08:33'),
(13, 'CV24ZH5MSD', 16, 11, 1, NULL, '2024-01-15', '2024-01-14 20:19:43'),
(14, 'CV24TOG9LH', 18, 11, 1, NULL, '2024-01-17', '2024-01-15 06:21:32'),
(15, 'CV24HCDHMR', 18, 11, 1, NULL, '2024-01-15', '2024-01-15 06:35:46'),
(16, 'CV24CU5RVG', 19, 11, 2, 'Booking declined', '0000-00-00', '2024-01-15 07:04:09'),
(17, 'CV24AN3455', 19, 11, 2, 'Booking declined', '0000-00-00', '2024-01-15 07:04:28'),
(18, 'CV24LQUORK', 19, 11, 2, 'Booking declined', '0000-00-00', '2024-01-15 07:04:41'),
(19, 'CV24QNPOVX', 18, 13, 1, NULL, '2024-01-20', '2024-01-15 07:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`id`, `name`, `email`, `subject`, `message`, `status`, `date_created`) VALUES
(8, 'vincent', 'cachaperovin@gmail.com', 'Accept', 'Test Message', 1, '2023-12-03 23:30:17');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `tour_location` text DEFAULT NULL,
  `cost` double NOT NULL,
  `description` text DEFAULT NULL,
  `upload_path` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 =active ,2 = Inactive',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `tour_location`, `cost`, `description`, `upload_path`, `status`, `date_created`) VALUES
(10, 'ROUND TOUR A', '- Corregidor Island Lighthouse\r\n- Corregidor Island\r\n- Aguinaldo Shrine and Museum\r\n- Malinta Tunnel', 300, '&lt;p&gt;Explore The Variety of Locations in Cavite City&lt;/p&gt;', 'uploads/package_10', 1, '2023-12-03 22:24:24'),
(11, 'ROUND TOUR B', '-ClockTower\r\n-Light House\r\n-SanRoqueChurch\r\n-ErmitadePortaVagaHistoricalMonument', 300, '&lt;p&gt;&lt;span style=&quot;color: rgb(33, 37, 41); font-family: &amp;quot;Roboto Slab&amp;quot;, -apple-system, BlinkMacSystemFont, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 16px;&quot;&gt;Explore The Variety of Locations in Cavite City&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(33, 37, 41); font-family: &amp;quot;Roboto Slab&amp;quot;, -apple-system, BlinkMacSystemFont, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 16px;&quot;&gt;With our top most visited locations near the edge.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Clock Tower&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Light House&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-San Roque Church&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Ermitade PortaVaga Historical Monument&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(33, 37, 41); font-family: &amp;quot;Roboto Slab&amp;quot;, -apple-system, BlinkMacSystemFont, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 16px;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 'uploads/package_11', 1, '2023-12-03 23:27:03'),
(12, 'ROUND TOUR C', '-Mile Long Barracks\r\n-Museum\r\n-Ladislao Diwa Shrine\r\n-Noveleta Tribunal 3', 300, '&lt;p&gt;&lt;span style=&quot;color: rgb(33, 37, 41); font-family: &amp;quot;Roboto Slab&amp;quot;, -apple-system, BlinkMacSystemFont, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 16px;&quot;&gt;Explore The Variety of Locations in Cavite City&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(33, 37, 41); font-family: &amp;quot;Roboto Slab&amp;quot;, -apple-system, BlinkMacSystemFont, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 16px;&quot;&gt;With our top most visited locations near the Noveleta.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Mile Long Barracks&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Museum&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Ladislao Diwa Shrine&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Noveleta Tribunal 3&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;', 'uploads/package_12', 1, '2023-12-03 23:32:47'),
(13, 'CLOSE OUT NOVELETA', '- AGUINALDO SHRINE\r\n- NOVELETA TRIBUNAL 1\r\n- NOVELETA TRIBUNAL 2\r\n- NOVELETA HALL', 250, '&lt;p&gt;EXPLORE OUTSIDE CAVITE CITY WITH THEIR PARTNER IN MUNICIPALITY&lt;/p&gt;&lt;p&gt;- AGUINALDO SHRINE&lt;/p&gt;&lt;p&gt;- NOVELETA TRIBUNAL 1&lt;/p&gt;&lt;p&gt;- NOVELETA TRIBUNAL 2&lt;/p&gt;&lt;p&gt;- NOVELETA HALL&lt;/p&gt;', 'uploads/package_13', 1, '2023-12-03 23:35:08');

-- --------------------------------------------------------

--
-- Table structure for table `rate_review`
--

CREATE TABLE `rate_review` (
  `id` int(11) NOT NULL,
  `book_list_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `rate_review`
--

INSERT INTO `rate_review` (`id`, `book_list_id`, `user_id`, `package_id`, `rate`, `review`, `date_created`) VALUES
(19, 9, 7, 13, 3, '&lt;b&gt;Gre&lt;/b&gt;at!', '2024-01-13 17:58:04'),
(32, 10, 16, 13, 4, 'Wow, great view&lt;br&gt;', '2024-01-13 19:12:57'),
(36, 8, 16, 10, 1, 'Poor &lt;br&gt;', '2024-01-13 19:21:07');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(11) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'CavSee: Cavite City Tourism Management System'),
(6, 'short_name', 'CC - Tourism MS'),
(11, 'logo', 'uploads/1701613500_CorregidorFreedomFire.jpeg'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/1701615900_AG.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `avatar` varchar(250) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `role` varchar(255) DEFAULT 'user',
  `otp` int(11) DEFAULT NULL,
  `expire_time` datetime DEFAULT NULL,
  `account_validation` varchar(150) DEFAULT 'UNVERIFIED'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`, `role`, `otp`, `expire_time`, `account_validation`) VALUES
(1, 'Adminstrator', 'Admin', 'vincent.cachapero@cvsu.edu.ph', '0192023a7bbd73250516f069df18b500', 'uploads/1701614880_DSC_8900.JPG', NULL, 1, '2021-01-20 14:02:37', '2024-01-14 15:53:29', 'admin', NULL, NULL, 'UNVERIFIED'),
(7, 'Vincent', 'Cachapero', 'clydesolas1@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'uploads/1701617760_1701614880_DSC_8900.JPG', NULL, 0, '2023-12-03 20:30:50', '2024-01-14 15:42:55', 'user', NULL, NULL, 'UNVERIFIED'),
(14, 'Clyde', 'Solas', 'solasclyde7@gmail.com', 'c3ca7b614a0ba5896a5852b9a56f9d5b', NULL, NULL, 0, '2024-01-13 12:49:00', '2024-01-14 15:42:58', 'user', NULL, NULL, 'UNVERIFIED'),
(15, 'clyde', 'solas', 'clydesolas01@gmail.com', 'c3ca7b614a0ba5896a5852b9a56f9d5b', NULL, NULL, 0, '2024-01-14 15:23:18', NULL, 'user', NULL, NULL, 'UNVERIFIED'),
(16, 'Vincent', 'Cachapero', 'vincent.cachapero@cvsu.edu.ph', 'd1081ee2ac8fb14cd6464bf4d3c7a08a', NULL, NULL, 0, '2024-01-14 15:38:06', NULL, 'user', NULL, NULL, 'UNVERIFIED'),
(17, 'Clyde', 'Solas', 'clyde.solas@cvsu.edu.ph', '84d6dee9e0aed825517bf229c091b206', NULL, NULL, 0, '2024-01-15 01:32:34', NULL, 'user', NULL, NULL, 'UNVERIFIED'),
(18, 'king', 'vincent', 'cachaperovin@gmail.com', '2ab29e375426ceb9e2e75627d8ccb439', NULL, NULL, 0, '2024-01-15 03:32:57', NULL, 'user', NULL, NULL, 'UNVERIFIED'),
(19, 'John Paul', 'Magno', 'johnpaul.magno@cvsu.edu.ph', '1d974d36be91cdcbaa6004b99b5a21c8', NULL, NULL, 0, '2024-01-15 07:02:49', NULL, 'user', NULL, NULL, 'UNVERIFIED'),
(20, 'clyde', 'solas', 'peterlosingwendy123@gmail.com', '0ec7e726dd08bb968cfb73862248b6ca', NULL, NULL, 0, '2024-01-15 11:05:20', NULL, 'user', NULL, NULL, 'UNVERIFIED');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `backup_recovery_log`
--
ALTER TABLE `backup_recovery_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_list`
--
ALTER TABLE `book_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rate_review`
--
ALTER TABLE `rate_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `backup_recovery_log`
--
ALTER TABLE `backup_recovery_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `book_list`
--
ALTER TABLE `book_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rate_review`
--
ALTER TABLE `rate_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
