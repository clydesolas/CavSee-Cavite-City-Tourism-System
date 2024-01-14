-- MySQL dump 10.13  Distrib 5.7.36, for Win64 (x86_64)
--
-- Host: localhost    Database: tourism_db
-- ------------------------------------------------------
-- Server version	8.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `backup_recovery_log`
--

DROP TABLE IF EXISTS `backup_recovery_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backup_recovery_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `br_name` varchar(200) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activity` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup_recovery_log`
--

LOCK TABLES `backup_recovery_log` WRITE;
/*!40000 ALTER TABLE `backup_recovery_log` DISABLE KEYS */;
INSERT INTO `backup_recovery_log` VALUES (49,'test','2024-01-14 18:47:38','Back up '),(50,'backup_2024-01-14_19-54-28.zip','2024-01-14 19:54:28','Back up '),(51,'backup_2024-01-14_19-58-18.zip','2024-01-14 19:58:18','Back up '),(52,'backup_2024-01-14_19-58-34.zip','2024-01-14 19:58:34','Back up '),(53,'backup_2024-01-14_19-58-41.zip','2024-01-14 19:58:41','Back up '),(54,'backup_2024-01-14_19-58-59.zip','2024-01-14 19:58:59','Back up '),(55,'backup_2024-01-14_20-05-34.zip','2024-01-14 20:05:34','Back up '),(56,'backup_2024-01-14_20-05-47.zip','2024-01-14 20:05:47','Back up '),(57,'backup_2024-01-14_20-06-26.zip','2024-01-14 20:06:26','Back up ');
/*!40000 ALTER TABLE `backup_recovery_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book_list`
--

DROP TABLE IF EXISTS `book_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `book_list_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `package_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '0=pending,1=confirm, 2=cancelled\r\n',
  `schedule` date DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_list`
--

LOCK TABLES `book_list` WRITE;
/*!40000 ALTER TABLE `book_list` DISABLE KEYS */;
INSERT INTO `book_list` VALUES (7,NULL,7,10,2,'2023-12-03','2023-12-03 22:36:40'),(8,NULL,7,10,3,'2024-01-12','2024-01-12 23:26:09'),(9,NULL,7,13,3,'2024-01-13','2024-01-12 23:27:42'),(10,NULL,7,13,3,'2024-01-13','2024-01-13 13:10:23'),(11,NULL,7,13,2,'2024-01-13','2024-01-13 13:11:44'),(12,NULL,7,12,0,'2024-01-14','2024-01-13 20:08:33');
/*!40000 ALTER TABLE `book_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inquiry`
--

DROP TABLE IF EXISTS `inquiry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inquiry` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text,
  `email` text,
  `subject` varchar(250) NOT NULL,
  `message` text,
  `status` tinyint NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inquiry`
--

LOCK TABLES `inquiry` WRITE;
/*!40000 ALTER TABLE `inquiry` DISABLE KEYS */;
INSERT INTO `inquiry` VALUES (8,'vincent','cachaperovin@gmail.com','Accept','Test Message',1,'2023-12-03 23:30:17');
/*!40000 ALTER TABLE `inquiry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text,
  `tour_location` text,
  `cost` double NOT NULL,
  `description` text,
  `upload_path` text,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1 =active ,2 = Inactive',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packages`
--

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages` VALUES (10,'ROUND TOUR A','- Corregidor Island Lighthouse\r\n- Corregidor Island\r\n- Aguinaldo Shrine and Museum\r\n- Malinta Tunnel',300,'&lt;p&gt;Explore The Variety of Locations in Cavite City&lt;/p&gt;','uploads/package_10',1,'2023-12-03 22:24:24'),(11,'ROUND TOUR B','-ClockTower\r\n-Light House\r\n-SanRoqueChurch\r\n-ErmitadePortaVagaHistoricalMonument',300,'&lt;p&gt;&lt;span style=&quot;color: rgb(33, 37, 41); font-family: &amp;quot;Roboto Slab&amp;quot;, -apple-system, BlinkMacSystemFont, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 16px;&quot;&gt;Explore The Variety of Locations in Cavite City&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(33, 37, 41); font-family: &amp;quot;Roboto Slab&amp;quot;, -apple-system, BlinkMacSystemFont, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 16px;&quot;&gt;With our top most visited locations near the edge.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Clock Tower&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Light House&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-San Roque Church&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Ermitade PortaVaga Historical Monument&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(33, 37, 41); font-family: &amp;quot;Roboto Slab&amp;quot;, -apple-system, BlinkMacSystemFont, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 16px;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;','uploads/package_11',1,'2023-12-03 23:27:03'),(12,'ROUND TOUR C','-Mile Long Barracks\r\n-Museum\r\n-Ladislao Diwa Shrine\r\n-Noveleta Tribunal 3',300,'&lt;p&gt;&lt;span style=&quot;color: rgb(33, 37, 41); font-family: &amp;quot;Roboto Slab&amp;quot;, -apple-system, BlinkMacSystemFont, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 16px;&quot;&gt;Explore The Variety of Locations in Cavite City&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(33, 37, 41); font-family: &amp;quot;Roboto Slab&amp;quot;, -apple-system, BlinkMacSystemFont, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 16px;&quot;&gt;With our top most visited locations near the Noveleta.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Mile Long Barracks&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Museum&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Ladislao Diwa Shrine&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#212529&quot; face=&quot;Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 16px;&quot;&gt;-Noveleta Tribunal 3&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;','uploads/package_12',1,'2023-12-03 23:32:47'),(13,'CLOSE OUT NOVELETA','- AGUINALDO SHRINE\r\n- NOVELETA TRIBUNAL 1\r\n- NOVELETA TRIBUNAL 2\r\n- NOVELETA HALL',250,'&lt;p&gt;EXPLORE OUTSIDE CAVITE CITY WITH THEIR PARTNER IN MUNICIPALITY&lt;/p&gt;&lt;p&gt;- AGUINALDO SHRINE&lt;/p&gt;&lt;p&gt;- NOVELETA TRIBUNAL 1&lt;/p&gt;&lt;p&gt;- NOVELETA TRIBUNAL 2&lt;/p&gt;&lt;p&gt;- NOVELETA HALL&lt;/p&gt;','uploads/package_13',1,'2023-12-03 23:35:08');
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rate_review`
--

DROP TABLE IF EXISTS `rate_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rate_review` (
  `id` int NOT NULL AUTO_INCREMENT,
  `book_list_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `package_id` int NOT NULL,
  `rate` int NOT NULL,
  `review` text,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rate_review`
--

LOCK TABLES `rate_review` WRITE;
/*!40000 ALTER TABLE `rate_review` DISABLE KEYS */;
INSERT INTO `rate_review` VALUES (19,9,7,13,4,'Great','2024-01-13 17:58:04'),(32,10,7,13,3,'&lt;p&gt;okkkk&lt;br&gt;&lt;/p&gt;','2024-01-13 19:12:57'),(36,8,7,10,3,'&lt;p&gt;ok&lt;br&gt;&lt;/p&gt;','2024-01-13 19:21:07');
/*!40000 ALTER TABLE `rate_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_info`
--

DROP TABLE IF EXISTS `system_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_info`
--

LOCK TABLES `system_info` WRITE;
/*!40000 ALTER TABLE `system_info` DISABLE KEYS */;
INSERT INTO `system_info` VALUES (1,'name','CavSee: Cavite City Tourism Management System'),(6,'short_name','CC - Tourism MS'),(11,'logo','uploads/1701613500_CorregidorFreedomFire.jpeg'),(13,'user_avatar','uploads/user_avatar.jpg'),(14,'cover','uploads/1701615900_AG.jpg');
/*!40000 ALTER TABLE `system_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` text NOT NULL,
  `avatar` text,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'user',
  `otp` int DEFAULT NULL,
  `expire_time` datetime DEFAULT NULL,
  `account_validation` varchar(150) DEFAULT 'UNVERIFIED',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Adminstrator','Admin','clyde.solas@cvsu.edu.ph','0192023a7bbd73250516f069df18b500','uploads/1701614880_DSC_8900.JPG',NULL,1,'2021-01-20 14:02:37','2024-01-13 09:55:40','admin',NULL,NULL,'UNVERIFIED'),(7,'Vincent','Cachapero','clydesolas1@gmail.com','25d55ad283aa400af464c76d713c07ad','uploads/1701617760_1701614880_DSC_8900.JPG',NULL,0,'2023-12-03 20:30:50','2024-01-14 15:42:55','user',NULL,NULL,'UNVERIFIED'),(14,'Clyde','Solas','solasclyde7@gmail.com','c3ca7b614a0ba5896a5852b9a56f9d5b',NULL,NULL,0,'2024-01-13 12:49:00','2024-01-14 15:42:58','user',NULL,NULL,'UNVERIFIED');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-14 20:07:25
