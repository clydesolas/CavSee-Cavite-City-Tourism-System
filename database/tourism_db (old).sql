-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2023 at 04:38 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tourism_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_list`
--

CREATE TABLE `book_list` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `package_id` int(30) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=pending,1=confirm, 2=cancelled\r\n',
  `schedule` date DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_list`
--

INSERT INTO `book_list` (`id`, `user_id`, `package_id`, `status`, `schedule`, `date_created`) VALUES
(3, 5, 8, 3, '2021-06-18', '2021-06-19 11:51:50'),
(7, 1, 10, 0, '2023-12-03', '2023-12-03 22:36:40');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(30) NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `id` int(30) NOT NULL,
  `title` text DEFAULT NULL,
  `tour_location` text DEFAULT NULL,
  `cost` double NOT NULL,
  `description` text DEFAULT NULL,
  `upload_path` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 =active ,2 = Inactive',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `package_id` int(30) NOT NULL,
  `rate` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rate_review`
--

INSERT INTO `rate_review` (`id`, `user_id`, `package_id`, `rate`, `review`, `date_created`) VALUES
(5, 7, 9, 5, '&lt;p&gt;HAHAHAHAHAHAHAHA&lt;/p&gt;', '2023-12-03 20:40:04');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/1701614880_DSC_8900.JPG', NULL, 1, '2021-01-20 14:02:37', '2023-12-03 22:48:11'),
(7, 'vincent', 'cachapero', 'vincent20', '0ec7e726dd08bb968cfb73862248b6ca', 'uploads/1701617760_1701614880_DSC_8900.JPG', NULL, 0, '2023-12-03 20:30:50', '2023-12-03 23:36:31');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `book_list`
--
ALTER TABLE `book_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rate_review`
--
ALTER TABLE `rate_review`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
