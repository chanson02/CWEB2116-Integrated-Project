-- MariaDB dump 10.19  Distrib 10.5.23-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: EqManage
-- ------------------------------------------------------
-- Server version	10.5.23-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `categoryName` (`categoryName`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (8,'Games');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barcodeID` int(11) NOT NULL,
  `imgID` int(11) NOT NULL,
  `equipment` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `totalQuantity` int(11) NOT NULL DEFAULT 1,
  `leftQuantity` int(11) NOT NULL DEFAULT 1,
  `availability` tinyint(1) NOT NULL DEFAULT 1,
  `users_id` int(11) DEFAULT NULL,
  `lastLog_id` int(11) DEFAULT NULL,
  `popularity` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `category_idx` (`category`),
  KEY `users_id_idx` (`users_id`),
  KEY `lastLog_id_idx` (`lastLog_id`),
  CONSTRAINT `category_idxfk` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lastLog_id_idxfk` FOREIGN KEY (`lastLog_id`) REFERENCES `log` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_id_idxfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment`
--

LOCK TABLES `equipment` WRITE;
/*!40000 ALTER TABLE `equipment` DISABLE KEYS */;
INSERT INTO `equipment` VALUES (16,52089115,93281432,'Dice',8,10,10,1,13,49,1);
/*!40000 ALTER TABLE `equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `checkoutRequests_id` int(11) DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `checkoutRequestDate` datetime DEFAULT NULL,
  `expectedReturnDate` datetime DEFAULT NULL,
  `checkoutDate` datetime DEFAULT NULL,
  `returnDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `checkoutRequests_id_idxfk_idx` (`checkoutRequests_id`,`equipment_id`),
  KEY `equipment_id_idx` (`equipment_id`),
  KEY `users_id_idx` (`users_id`),
  CONSTRAINT `checkoutRequests_id_idxfk` FOREIGN KEY (`checkoutRequests_id`) REFERENCES `requests` (`id`),
  CONSTRAINT `equipment_id_idxfk` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_id_idxfk` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (49,69,16,13,'2023-11-29 23:27:09','2023-11-30 15:30:00','2023-11-29 23:28:28','2023-11-29 23:28:46');
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `target` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `target_idxfk` (`target`),
  CONSTRAINT `target_idxfk` FOREIGN KEY (`target`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (63,13,'Notification!!!',1,'2023-11-28 20:58:36'),(65,13,'Request was sent by the student. See details at requests page',1,'2023-11-29 23:03:21'),(66,13,'Your checkout request was rejected',0,'2023-11-29 23:27:01'),(67,13,'Your checkout request was accepted',0,'2023-11-29 23:27:09'),(68,13,'Your checkout request was rejected',0,'2023-11-29 23:27:15'),(69,13,'Your checkout request was rejected',0,'2023-11-29 23:27:26'),(70,13,'Your checkout request was rejected',0,'2023-11-29 23:27:34'),(71,13,'Your checkout request was rejected',0,'2023-11-29 23:27:39'),(72,13,'Dice was successfully checked out',0,'2023-11-29 23:28:28'),(73,13,'Dice was successfully returned',0,'2023-11-29 23:28:46');
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `checkoutQty` int(11) NOT NULL DEFAULT 0,
  `requestDate` datetime DEFAULT NULL,
  `expectedReturnDate` datetime DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `state` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `users_id_idx` (`users_id`),
  KEY `equipment_id_idx` (`equipment_id`),
  CONSTRAINT `equipment_id_idxfk_1` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_id_idxfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests` VALUES (68,13,16,'Commons','We\'ve been gambling during lunch time.',2,'2023-11-29 22:56:29','2023-11-30 15:30:00','b056eb1587586b71e2da9acfe4fbd19e',0,'rejected'),(69,13,16,'Commons','We\'ve been gambling during lunch time.',2,'2023-11-29 23:01:33','2023-11-30 15:30:00','9dfcd5e558dfa04aaf37f137a1d9d3e5',1,'approved'),(70,13,16,'Commons','We\'ve been gambling during lunch time.',2,'2023-11-29 23:03:21','2023-11-30 15:30:00','7cbbc409ec990f19c78c75bd1e06f215',0,'rejected'),(71,13,16,'Somewhere else','idk i want to use it somewhere else',2,'2023-11-29 23:10:58','2023-11-30 15:30:00','0a113ef6b61820daa5611c870ed8d5ee',0,'rejected'),(72,13,16,'Somewhere else','idk i want to use it somewhere else',2,'2023-11-29 23:11:50','2023-11-30 15:30:00','c86a7ee3d8ef0b551ed58e354a836f2b',0,'rejected'),(73,13,16,'Somewhere else','idk i want to use it somewhere else',2,'2023-11-29 23:12:30','2023-11-30 15:30:00','be3159ad04564bfb90db9e32851ebf9c',0,'rejected');
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (11,'Amalan Pulendran','amalan','$2y$10$1TTqbDLRxVztMHLl57ALmOxTL3HNpJyLuOwLDaJ/zO128NB4xgMBK','amalan@dunwoody.edu','877a9ba7a98f75b90a9d49f53f15a858',1,0),(12,'administrator 1','administrator','$2y$10$AncUYYIqHmAZgAolD4rMxeQ8CQLg8ospCwtAS3jhiAyStqw8pqS4S','amalan@dunwoody.edu','bf8229696f7a3bb4700cfddef19fa23f',0,0),(13,'Cooper Hanson','hancooj','$2y$10$mZw7bYOeYrwzQHuPuNXA7uXUb97a0u3k3LQzLt2S7Su6b7eDo0AYW','hancooj@dunwoody.edu','bf62768ca46b6c3b5bea9515d1a1fc45',0,1);
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

-- Dump completed on 2023-12-04 14:50:26
