-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 20, 2024 at 07:55 AM
-- Server version: 8.1.0
-- PHP Version: 7.4.26

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
-- Table structure for table `backup_recovery_log`
--

DROP TABLE IF EXISTS `backup_recovery_log`;
CREATE TABLE IF NOT EXISTS `backup_recovery_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `br_name` varchar(200) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activity` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `book_list`;
CREATE TABLE IF NOT EXISTS `book_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `book_list_id` varchar(200) DEFAULT NULL,
  `user_id` int NOT NULL,
  `package_id` int NOT NULL,
  `tourguide_id` int DEFAULT NULL,
  `book_pax` int DEFAULT '1',
  `pax_type` varchar(255) NOT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '0=pending,1=confirm, 2=cancelled\r\n',
  `remark` varchar(250) DEFAULT NULL,
  `schedule` date DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `book_list`
--

INSERT INTO `book_list` (`id`, `book_list_id`, `user_id`, `package_id`, `tourguide_id`, `book_pax`, `pax_type`, `status`, `remark`, `schedule`, `date_created`) VALUES
(7, 'CV4FG5HI6J', 7, 10, 7, 1, 'Adult,Baby', 2, NULL, '2023-12-03', '2023-12-03 22:36:40'),
(8, 'CV7KL8MN9O', 16, 10, 7, 1, 'Adult,Baby', 3, '7', '2024-01-12', '2024-01-12 23:26:09'),
(9, 'CVPQR0STU1', 7, 13, 7, 1, 'Adult,Baby', 3, NULL, '2024-01-13', '2024-01-12 23:27:42'),
(10, 'CV2VWX3YZ4', 16, 13, 7, 8, 'Adult,Baby', 1, '7', '2024-01-20', '2024-01-13 13:10:23'),
(11, 'CV5AB6CD7E', 7, 13, 7, 1, '', 2, NULL, '2024-01-13', '2024-01-13 13:11:44'),
(12, 'CV1KL2MN3O', 16, 12, 7, 1, '', 2, 'Booking declined', '2024-01-14', '2024-01-13 20:08:33'),
(13, 'CV24ZH5MSD', 16, 11, NULL, 1, '', 3, NULL, '2024-01-15', '2024-01-14 20:19:43'),
(14, 'CV24TOG9LH', 18, 11, NULL, 1, '', 2, NULL, '2024-01-17', '2024-01-15 06:21:32'),
(15, 'CV24HCDHMR', 18, 11, NULL, 1, '', 3, NULL, '2024-01-15', '2024-01-15 06:35:46'),
(16, 'CV24CU5RVG', 19, 11, NULL, 1, '', 2, 'Booking declined', '0000-00-00', '2024-01-15 07:04:09'),
(17, 'CV24AN3455', 19, 11, NULL, 1, '', 2, 'Booking declined', '0000-00-00', '2024-01-15 07:04:28'),
(18, 'CV24LQUORK', 19, 11, NULL, 1, '', 2, 'Booking declined', '0000-00-00', '2024-01-15 07:04:41'),
(19, 'CV24QNPOVX', 18, 13, 27, 1, '', 1, NULL, '2024-01-20', '2024-01-15 07:49:40'),
(20, 'CV24J05BUC', 26, 10, 7, 12, 'Adult,Baby', 0, NULL, '2024-01-19', '2024-01-19 23:06:34'),
(21, 'CV245M6VF7', 26, 12, 27, 1, '', 1, NULL, '2024-01-20', '2024-01-20 12:35:33'),
(22, 'CV243DUBP5', 26, 12, 27, 1, '', 1, NULL, '2024-01-20', '2024-01-20 12:35:38'),
(23, 'CV2471NF09', 26, 12, 27, 1, 'Adult,Baby', 1, NULL, '2024-01-20', '2024-01-20 12:41:13'),
(24, 'CV24AKN0J5', 26, 12, 27, 1, '', 0, NULL, '2024-01-20', '2024-01-20 12:44:57'),
(25, 'CV24PKHQLQ', 26, 13, 7, 5, 'Adult,Baby,Student,SeniorCitizen', 0, NULL, '2024-01-22', '2024-01-20 14:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

DROP TABLE IF EXISTS `inquiry`;
CREATE TABLE IF NOT EXISTS `inquiry` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text,
  `email` text,
  `subject` varchar(250) NOT NULL,
  `message` text,
  `status` tinyint NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`id`, `name`, `email`, `subject`, `message`, `status`, `date_created`) VALUES
(8, 'vincent', 'cachaperovin@gmail.com', 'Accept', 'Test Message', 1, '2023-12-03 23:30:17');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
CREATE TABLE IF NOT EXISTS `packages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pax` int DEFAULT '10',
  `title` text,
  `tour_location` text,
  `cost` double NOT NULL,
  `description` text,
  `upload_path` text,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1 =active ,2 = Inactive',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `termsCondition` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `pax`, `title`, `tour_location`, `cost`, `description`, `upload_path`, `status`, `date_created`, `termsCondition`) VALUES
(10, 80, 'ROUND TOUR A', '- Corregidor Island Lighthouse\r\n- Corregidor Island\r\n- Aguinaldo Shrine and Museum\r\n- Malinta Tunnel', 300, '&lt;p&gt;Explore The Variety of Locations in Cavite City&lt;/p&gt;', 'uploads/package_10', 1, '2023-12-03 22:24:24', '   <li><strong>Eligibility:</strong>             <ul>                 <li>Individuals of all ages are welcome to book the tour place.</li>                 <li>Children under a certain age may require adult supervision, and the tour place will provide details upon request.</li>             </ul>         </li>          <li><strong>Code of Conduct:</strong>             <ul>                 <li>Visitors are expected to adhere to the tour place\'s rules and regulations during their visit.</li>                 <li>Any disruptive or inappropriate behavior may result in the termination of the tour and future booking restrictions.</li>             </ul>         </li>          <li><strong>Changes to the Itinerary:</strong>             <ul>                 <li>The tour place reserves the right to modify or cancel the tour itinerary due to unforeseen circumstances.</li>                 <li>In such cases, reasonable efforts will be made to notify the visitors in advance.</li>             </ul>         </li>          <li><strong>Limitation of Liability:</strong>             <ul>                 <li>The tour place is not responsible for any loss, injury, or damage to personal belongings during the visit.</li>                 <li>Visitors participate at their own risk and are encouraged to follow safety guidelines provided by the tour place.</li>             </ul>         </li>          <li><strong>Photography and Media:</strong>             <ul>                 <li>Visitors may be photographed or recorded during the tour for promotional purposes.</li>                 <li>By booking, visitors grant permission for the use of their likeness in promotional materials.</li>             </ul>         </li>          <li><strong>Weather Conditions:</strong>             <ul>                 <li>In the event of adverse weather conditions, the tour place reserves the right to cancel or reschedule the tour for safety reasons.</li>             </ul>         </li>          <li><strong>Governing Law:</strong>             <ul>                 <li>These terms and conditions are governed by the laws of the jurisdiction where the tour place is located.</li>             </ul>         </li>          <li><strong>Updates:</strong>             <ul>                 <li>The tour place reserves the right to update or modify these terms at any time without prior notice.</li>             </ul>         </li>     </ol>'),
(11, 10, 'ROUND TOUR B', '-ClockTower\r\n-Light House\r\n-SanRoqueChurch\r\n-ErmitadePortaVagaHistoricalMonument', 300, '&lt;p&gt;&lt;span style=&quot;color: rgb(33, 37, 41); font-family: &amp;quot;Roboto Slab&amp;quot;, -apple-system, BlinkMacSystemFont, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 16px;&quot;&gt;Explore The Variety of Locations in Cavite City&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(33, 37, 41); font-family: &amp;quot;Roboto Slab&amp;quot;, -apple-system, BlinkMacSystemFont, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 16px;&quot;&gt;With our top most visited locations near the edge.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Clock Tower&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Light House&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-San Roque Church&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Ermitade PortaVaga Historical Monument&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(33, 37, 41); font-family: &amp;quot;Roboto Slab&amp;quot;, -apple-system, BlinkMacSystemFont, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 16px;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 'uploads/package_11', 1, '2023-12-03 23:27:03', '   <li><strong>Eligibility:</strong>             <ul>                 <li>Individuals of all ages are welcome to book the tour place.</li>                 <li>Children under a certain age may require adult supervision, and the tour place will provide details upon request.</li>             </ul>         </li>          <li><strong>Code of Conduct:</strong>             <ul>                 <li>Visitors are expected to adhere to the tour place\'s rules and regulations during their visit.</li>                 <li>Any disruptive or inappropriate behavior may result in the termination of the tour and future booking restrictions.</li>             </ul>         </li>          <li><strong>Changes to the Itinerary:</strong>             <ul>                 <li>The tour place reserves the right to modify or cancel the tour itinerary due to unforeseen circumstances.</li>                 <li>In such cases, reasonable efforts will be made to notify the visitors in advance.</li>             </ul>         </li>          <li><strong>Limitation of Liability:</strong>             <ul>                 <li>The tour place is not responsible for any loss, injury, or damage to personal belongings during the visit.</li>                 <li>Visitors participate at their own risk and are encouraged to follow safety guidelines provided by the tour place.</li>             </ul>         </li>          <li><strong>Photography and Media:</strong>             <ul>                 <li>Visitors may be photographed or recorded during the tour for promotional purposes.</li>                 <li>By booking, visitors grant permission for the use of their likeness in promotional materials.</li>             </ul>         </li>          <li><strong>Weather Conditions:</strong>             <ul>                 <li>In the event of adverse weather conditions, the tour place reserves the right to cancel or reschedule the tour for safety reasons.</li>             </ul>         </li>          <li><strong>Governing Law:</strong>             <ul>                 <li>These terms and conditions are governed by the laws of the jurisdiction where the tour place is located.</li>             </ul>         </li>          <li><strong>Updates:</strong>             <ul>                 <li>The tour place reserves the right to update or modify these terms at any time without prior notice.</li>             </ul>         </li>     </ol>'),
(12, 10, 'ROUND TOUR C', '-Mile Long Barracks\r\n-Museum\r\n-Ladislao Diwa Shrine\r\n-Noveleta Tribunal 3', 300, '&lt;p&gt;&lt;span style=&quot;color: rgb(33, 37, 41); font-family: &amp;quot;Roboto Slab&amp;quot;, -apple-system, BlinkMacSystemFont, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 16px;&quot;&gt;Explore The Variety of Locations in Cavite City&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(33, 37, 41); font-family: &amp;quot;Roboto Slab&amp;quot;, -apple-system, BlinkMacSystemFont, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 16px;&quot;&gt;With our top most visited locations near the Noveleta.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Mile Long Barracks&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Museum&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Ladislao Diwa Shrine&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Noveleta Tribunal 3&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;', 'uploads/package_12', 1, '2023-12-03 23:32:47', '   <li><strong>Eligibility:</strong>             <ul>                 <li>Individuals of all ages are welcome to book the tour place.</li>                 <li>Children under a certain age may require adult supervision, and the tour place will provide details upon request.</li>             </ul>         </li>          <li><strong>Code of Conduct:</strong>             <ul>                 <li>Visitors are expected to adhere to the tour place\'s rules and regulations during their visit.</li>                 <li>Any disruptive or inappropriate behavior may result in the termination of the tour and future booking restrictions.</li>             </ul>         </li>          <li><strong>Changes to the Itinerary:</strong>             <ul>                 <li>The tour place reserves the right to modify or cancel the tour itinerary due to unforeseen circumstances.</li>                 <li>In such cases, reasonable efforts will be made to notify the visitors in advance.</li>             </ul>         </li>          <li><strong>Limitation of Liability:</strong>             <ul>                 <li>The tour place is not responsible for any loss, injury, or damage to personal belongings during the visit.</li>                 <li>Visitors participate at their own risk and are encouraged to follow safety guidelines provided by the tour place.</li>             </ul>         </li>          <li><strong>Photography and Media:</strong>             <ul>                 <li>Visitors may be photographed or recorded during the tour for promotional purposes.</li>                 <li>By booking, visitors grant permission for the use of their likeness in promotional materials.</li>             </ul>         </li>          <li><strong>Weather Conditions:</strong>             <ul>                 <li>In the event of adverse weather conditions, the tour place reserves the right to cancel or reschedule the tour for safety reasons.</li>             </ul>         </li>          <li><strong>Governing Law:</strong>             <ul>                 <li>These terms and conditions are governed by the laws of the jurisdiction where the tour place is located.</li>             </ul>         </li>          <li><strong>Updates:</strong>             <ul>                 <li>The tour place reserves the right to update or modify these terms at any time without prior notice.</li>             </ul>         </li>     </ol>'),
(13, 100, 'CLOSE OUT NOVELETA', '- AGUINALDO SHRINE\r\n- NOVELETA TRIBUNAL 1\r\n- NOVELETA TRIBUNAL 2\r\n- NOVELETA HALL', 250, '&lt;p&gt;EXPLORE OUTSIDE CAVITE CITY WITH THEIR PARTNER IN MUNICIPALITY&lt;/p&gt;&lt;p&gt;- AGUINALDO SHRINE&lt;/p&gt;&lt;p&gt;- NOVELETA TRIBUNAL 1&lt;/p&gt;&lt;p&gt;- NOVELETA TRIBUNAL 2&lt;/p&gt;&lt;p&gt;- NOVELETA HALL&lt;/p&gt;', 'uploads/package_13', 1, '2023-12-03 23:35:08', '   <li><strong>Eligibility:</strong>             <ul>                 <li>Individuals of all ages are welcome to book the tour place.</li>                 <li>Children under a certain age may require adult supervision, and the tour place will provide details upon request.</li>             </ul>         </li>          <li><strong>Code of Conduct:</strong>             <ul>                 <li>Visitors are expected to adhere to the tour place\'s rules and regulations during their visit.</li>                 <li>Any disruptive or inappropriate behavior may result in the termination of the tour and future booking restrictions.</li>             </ul>         </li>          <li><strong>Changes to the Itinerary:</strong>             <ul>                 <li>The tour place reserves the right to modify or cancel the tour itinerary due to unforeseen circumstances.</li>                 <li>In such cases, reasonable efforts will be made to notify the visitors in advance.</li>             </ul>         </li>          <li><strong>Limitation of Liability:</strong>             <ul>                 <li>The tour place is not responsible for any loss, injury, or damage to personal belongings during the visit.</li>                 <li>Visitors participate at their own risk and are encouraged to follow safety guidelines provided by the tour place.</li>             </ul>         </li>          <li><strong>Photography and Media:</strong>             <ul>                 <li>Visitors may be photographed or recorded during the tour for promotional purposes.</li>                 <li>By booking, visitors grant permission for the use of their likeness in promotional materials.</li>             </ul>         </li>          <li><strong>Weather Conditions:</strong>             <ul>                 <li>In the event of adverse weather conditions, the tour place reserves the right to cancel or reschedule the tour for safety reasons.</li>             </ul>         </li>          <li><strong>Governing Law:</strong>             <ul>                 <li>These terms and conditions are governed by the laws of the jurisdiction where the tour place is located.</li>             </ul>         </li>          <li><strong>Updates:</strong>             <ul>                 <li>The tour place reserves the right to update or modify these terms at any time without prior notice.</li>             </ul>         </li>     </ol>');

-- --------------------------------------------------------

--
-- Table structure for table `rate_review`
--

DROP TABLE IF EXISTS `rate_review`;
CREATE TABLE IF NOT EXISTS `rate_review` (
  `id` int NOT NULL AUTO_INCREMENT,
  `book_list_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `package_id` int NOT NULL,
  `rate` int NOT NULL,
  `review` text,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb3;

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

DROP TABLE IF EXISTS `system_info`;
CREATE TABLE IF NOT EXISTS `system_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

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

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `avatar` varchar(250) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `role` varchar(255) DEFAULT 'user',
  `otp` int DEFAULT NULL,
  `expire_time` datetime DEFAULT NULL,
  `account_validation` varchar(150) DEFAULT 'UNVERIFIED',
  `status` varchar(255) NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`id`),
  UNIQUE KEY `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`, `role`, `otp`, `expire_time`, `account_validation`, `status`) VALUES
(1, 'Adminstrator', 'Admin', 'vincent.cachapero@cvsu.edu.ph', '0192023a7bbd73250516f069df18b500', 'uploads/1701614880_DSC_8900.JPG', NULL, 1, '2021-01-20 14:02:37', '2024-01-14 15:53:29', 'admin', NULL, NULL, 'UNVERIFIED', 'ACTIVE'),
(7, 'Vincent', 'Cachapero', 'clydesolas1@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'uploads/1701617760_1701614880_DSC_8900.JPG', NULL, 0, '2023-12-03 20:30:50', '2024-01-19 18:51:05', 'tour_guide', NULL, NULL, 'UNVERIFIED', 'ACTIVE'),
(14, 'Clyde', 'Solas', 'solasclyde7@gmail.com', 'c3ca7b614a0ba5896a5852b9a56f9d5b', NULL, NULL, 0, '2024-01-13 12:49:00', '2024-01-14 15:42:58', 'user', NULL, NULL, 'UNVERIFIED', 'ACTIVE'),
(16, 'Vincent', 'Cachapero', 'vincent.cachapero@cvsu.edu.ph', 'd1081ee2ac8fb14cd6464bf4d3c7a08a', NULL, NULL, 0, '2024-01-14 15:38:06', NULL, 'user', NULL, NULL, 'UNVERIFIED', 'ACTIVE'),
(17, 'Clyde', 'Solas', 'clyde.solas@cvsu.edu.ph', '84d6dee9e0aed825517bf229c091b206', NULL, NULL, 0, '2024-01-15 01:32:34', NULL, 'user', NULL, NULL, 'UNVERIFIED', 'ACTIVE'),
(18, 'king', 'vincent', 'cachaperovin@gmail.com', '2ab29e375426ceb9e2e75627d8ccb439', NULL, NULL, 0, '2024-01-15 03:32:57', NULL, 'user', NULL, NULL, 'UNVERIFIED', 'ACTIVE'),
(19, 'John Paul', 'Magno', 'johnpaul.magno@cvsu.edu.ph', '1d974d36be91cdcbaa6004b99b5a21c8', NULL, NULL, 0, '2024-01-15 07:02:49', NULL, 'user', NULL, NULL, 'UNVERIFIED', 'ACTIVE'),
(20, 'clyde', 'solas', 'peterlosingwendy123@gmail.com', '0ec7e726dd08bb968cfb73862248b6ca', NULL, NULL, 0, '2024-01-15 11:05:20', NULL, 'user', NULL, NULL, 'UNVERIFIED', 'ACTIVE'),
(21, 'Clyde', 'Solas', 'monroha.clyde67@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, 0, '2024-01-19 09:42:54', NULL, 'user', NULL, NULL, 'UNVERIFIED', 'ACTIVE'),
(22, 'clyde', 'solas', 'sdfsd', 'dsfsd', NULL, NULL, 0, '2024-01-19 18:08:24', NULL, 'user', NULL, NULL, 'UNVERIFIED', 'sdfsd'),
(23, 'dsfds', 'fsdfsd', 'sdfsd@dfgdf.fh', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, 0, '2024-01-19 18:16:07', NULL, 'user', NULL, NULL, 'UNVERIFIED', 'ACTIVE'),
(24, 'gdfg', 'dfgdfg', 'd@dfgdfg.fgdfgdf', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, 0, '2024-01-19 18:19:17', NULL, 'user', NULL, NULL, 'UNVERIFIED', 'ACTIVE'),
(25, 'eger', 'reer', 'ge@sdfsd.fdg', 'aadc7581f5f73c00af21bb0163fb2ee6', NULL, NULL, 0, '2024-01-19 18:31:01', '2024-01-19 18:51:14', 'tour_guide', NULL, NULL, 'UNVERIFIED', 'ARCHIVED'),
(26, 'Clyde', 'SolasS', 'clydesolas01@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, 0, '2024-01-19 19:04:10', '2024-01-19 20:47:30', 'user', NULL, NULL, 'UNVERIFIED', 'ACTIVE'),
(27, 'John', 'Doe', 'sclyd13@gmail.com', 'a33bc9ae74aa9c6bbd3be06eee21f638', NULL, NULL, 0, '2024-01-19 19:07:04', '2024-01-20 15:49:48', 'tour_guide', NULL, NULL, 'UNVERIFIED', 'ACTIVE');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
