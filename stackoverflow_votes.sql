CREATE DATABASE  IF NOT EXISTS `stackoverflow` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `stackoverflow`;
-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: stackoverflow
-- ------------------------------------------------------
-- Server version	8.0.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `votes` (
  `voter_display_name` varchar(50) NOT NULL,
  `votetype` varchar(20) NOT NULL,
  `answer_id` int NOT NULL,
  `votedatetime` datetime NOT NULL,
  PRIMARY KEY (`voter_display_name`,`answer_id`),
  KEY `votes_ibfk_2` (`answer_id`),
  CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`voter_display_name`) REFERENCES `users` (`display_name`),
  CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`answer_id`) ON DELETE CASCADE,
  CONSTRAINT `votes_chk_1` CHECK ((`votetype` in (_utf8mb4'upvote',_utf8mb4'downvote',_utf8mb4'flagged')))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votes`
--

LOCK TABLES `votes` WRITE;
/*!40000 ALTER TABLE `votes` DISABLE KEYS */;
INSERT INTO `votes` VALUES ('BSQ62BIL6FX','flagged',17,'2022-07-03 02:12:44'),('BSQ62BIL6FX','upvote',23,'2022-09-04 09:14:07'),('CCG81MBL4MF','flagged',11,'2022-04-17 18:16:17'),('CFU65WCM1FH','upvote',16,'2022-12-30 03:23:01'),('CFU65WCM1FH','downvote',49,'2023-01-26 09:51:01'),('CUU53GFD7XD','downvote',33,'2022-10-16 11:15:25'),('EMP14XRO8NW','downvote',43,'2022-12-30 05:04:14'),('ERW73IYG9DD','flagged',23,'2023-03-07 10:24:33'),('FOT95EPE3FG','flagged',20,'2022-11-05 01:56:47'),('FOT95EPE3FG','upvote',40,'2023-03-01 10:11:24'),('HYE18WCK1DU','downvote',9,'2022-12-28 06:28:20'),('JBW64VNP7VK','downvote',3,'2022-09-11 04:33:36'),('JBW64VNP7VK','flagged',7,'2022-11-04 03:24:00'),('JBW64VNP7VK','upvote',45,'2022-10-20 02:09:39'),('JNV40OXH7CE','downvote',32,'2022-12-28 10:50:27'),('JNV40OXH7CE','upvote',38,'2022-09-06 09:54:06'),('JNV40OXH7CE','downvote',44,'2022-07-11 06:30:56'),('Kungfu Panda','upvote',63,'2022-05-14 13:19:15'),('LSI76ECK2YK','flagged',47,'2023-02-09 10:50:32'),('LSI76ECK2YK','upvote',49,'2022-10-07 12:30:43'),('MFM76GML6JF','downvote',12,'2023-01-23 03:21:39'),('MFM76GML6JF','flagged',33,'2022-10-23 12:05:08'),('MFM76GML6JF','upvote',34,'2022-12-06 04:20:33'),('MZG06WFW0TW','flagged',46,'2023-03-24 06:44:22'),('NDQ94OBQ7RY','flagged',11,'2023-02-06 01:36:29'),('NIG77EAR4HM','downvote',48,'2022-08-31 03:20:37'),('NOM24GSL5YE','downvote',41,'2022-09-25 06:09:24'),('NYC22DXV7DU','flagged',37,'2023-03-04 08:13:24'),('NYC22DXV7DU','flagged',38,'2022-09-16 01:26:01'),('PPB86BNB1FN','downvote',1,'2022-09-11 09:07:07'),('PPB86BNB1FN','upvote',49,'2023-03-29 02:11:32'),('PXO33WPD8CE','flagged',5,'2023-02-07 11:03:13'),('PXO33WPD8CE','flagged',17,'2023-03-11 06:08:46'),('PXO33WPD8CE','downvote',25,'2022-10-12 07:51:06'),('PXO33WPD8CE','downvote',26,'2023-03-08 06:06:13'),('rahul','upvote',53,'2022-05-04 22:52:45'),('rahul','flagged',60,'2022-05-05 00:19:37'),('rahul','upvote',63,'2022-05-15 23:06:12'),('rahul','flagged',71,'2022-05-14 15:27:42'),('rahul','flagged',72,'2022-05-14 15:28:14'),('SMI64OCK1PP','downvote',5,'2022-09-30 12:49:25'),('SMI64OCK1PP','upvote',22,'2022-09-25 02:46:00'),('SMI64OCK1PP','downvote',48,'2022-06-19 04:59:52'),('TES15PFI8QQ','upvote',6,'2022-06-30 02:47:23'),('TES15PFI8QQ','flagged',7,'2022-11-02 05:18:42'),('TES15PFI8QQ','flagged',11,'2022-08-30 10:12:58'),('TLO44AYL8GV','downvote',34,'2022-07-01 06:36:09'),('TPP41CPE4XO','downvote',39,'2022-12-28 01:49:58'),('UVW55WOB5OV','flagged',11,'2022-12-19 05:47:10'),('UVW55WOB5OV','downvote',28,'2022-06-25 04:17:42'),('YLI32KRL4OJ','flagged',16,'2022-07-23 07:45:48'),('YLI32KRL4OJ','downvote',37,'2022-09-24 10:46:02'),('YLI32KRL4OJ','downvote',39,'2022-09-23 05:44:59'),('ZIC61CBQ1IO','flagged',21,'2022-08-26 10:38:41'),('ZIC61CBQ1IO','upvote',23,'2022-07-29 12:16:37'),('ZIC61CBQ1IO','upvote',40,'2023-02-23 01:58:23');
/*!40000 ALTER TABLE `votes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-30 17:06:25
