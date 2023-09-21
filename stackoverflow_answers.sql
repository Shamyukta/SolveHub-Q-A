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
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `answers` (
  `answer_id` int NOT NULL AUTO_INCREMENT,
  `answerer_display_name` varchar(50) NOT NULL,
  `question_id` int NOT NULL,
  `posted_datetime` datetime NOT NULL,
  `answer_text` text NOT NULL,
  `is_best` tinyint(1) DEFAULT '0',
  `is_accepted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`answer_id`),
  KEY `answerer_display_name` (`answerer_display_name`),
  KEY `answers_ibfk_2` (`question_id`),
  FULLTEXT KEY `answer_text` (`answer_text`),
  CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`answerer_display_name`) REFERENCES `users` (`display_name`),
  CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (1,'MZG06WFW0TW',30,'2021-05-05 05:04:29','egestas ligula. Nullam feugiat placerat velit. Quisque varius. Nam porttitor scelerisque neque. Nullam nisl. Maecenas malesuada fringilla',1,0),(2,'UVW55WOB5OV',30,'2021-05-02 10:18:42','cursus. Nunc mauris elit, dictum eu, eleifend nec, malesuada ut, sem. Nulla interdum. Curabitur dictum. Phasellus in felis. Nulla tempor',1,1),(3,'TPP41CPE4XO',13,'2022-03-19 01:14:24','sit amet diam eu dolor egestas rhoncus. Proin nisl sem, consequat nec, mollis vitae,',0,0),(4,'PXO33WPD8CE',19,'2021-07-21 07:47:33','nibh sit amet orci. Ut sagittis lobortis mauris. Suspendisse aliquet molestie tellus. Aenean egestas hendrerit',0,1),(5,'MZG06WFW0TW',38,'2021-06-01 01:11:07','sem eget massa. Suspendisse eleifend. Cras sed leo. Cras vehicula aliquet libero. Integer in magna. Phasellus',0,0),(6,'HYE18WCK1DU',17,'2022-04-04 09:05:29','mauris a nunc. In at pede. Cras vulputate velit eu sem.',1,1),(7,'TLO44AYL8GV',20,'2021-12-29 10:55:23','quam. Curabitur vel lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur',0,1),(8,'CUU53GFD7XD',37,'2021-12-24 05:42:03','Ut tincidunt vehicula risus. Nulla eget metus eu erat semper rutrum. Fusce dolor quam, elementum at, egestas',0,0),(9,'MZG06WFW0TW',39,'2021-05-02 03:03:25','dolor, tempus non, lacinia at, iaculis quis, pede. Praesent eu dui. Cum sociis natoque penatibus et',1,0),(10,'PXO33WPD8CE',34,'2021-03-02 08:37:50','Phasellus vitae mauris sit amet lorem semper auctor. Mauris vel turpis. Aliquam adipiscing',0,0),(11,'YLI32KRL4OJ',4,'2021-01-24 07:57:42','adipiscing elit. Etiam laoreet, libero et tristique pellentesque, tellus sem mollis dui, in sodales elit erat',1,0),(12,'NDQ94OBQ7RY',29,'2022-02-08 01:56:20','Quisque porttitor eros nec tellus. Nunc lectus pede, ultrices a, auctor non, feugiat nec, diam. Duis mi enim,',1,1),(13,'UVW55WOB5OV',41,'2021-04-23 02:08:34','eu arcu. Morbi sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus',0,1),(14,'SMI64OCK1PP',43,'2022-05-12 11:14:37','sit amet risus. Donec egestas. Aliquam nec enim. Nunc ut erat. Sed nunc est, mollis non, cursus non, egestas',0,1),(15,'CFU65WCM1FH',18,'2021-03-20 10:18:59','Proin velit. Sed malesuada augue ut lacus. Nulla tincidunt, neque vitae semper egestas, urna justo faucibus',0,1),(16,'NIG77EAR4HM',5,'2021-08-26 05:46:20','laoreet lectus quis massa. Mauris vestibulum, neque sed dictum eleifend, nunc risus varius orci, in consequat enim diam vel',1,0),(17,'TES15PFI8QQ',14,'2022-03-09 05:55:10','accumsan neque et nunc. Quisque ornare tortor at risus. Nunc ac sem',0,0),(18,'CGM36RKB1TS',37,'2021-07-20 12:40:56','consectetuer, cursus et, magna. Praesent interdum ligula eu enim. Etiam imperdiet dictum magna. Ut tincidunt',0,0),(19,'CUU53GFD7XD',30,'2022-04-27 10:06:27','nibh lacinia orci, consectetuer euismod est arcu ac orci. Ut semper',0,1),(20,'BSQ62BIL6FX',17,'2022-03-11 12:58:31','condimentum. Donec at arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Donec',0,0),(21,'YLI32KRL4OJ',48,'2021-08-20 08:52:06','Curabitur dictum. Phasellus in felis. Nulla tempor augue ac ipsum. Phasellus vitae mauris sit amet lorem',0,0),(22,'HYR17JOD4BH',46,'2022-06-02 11:06:16','mi tempor lorem, eget mollis lectus pede et risus. Quisque libero',1,1),(23,'HYE18WCK1DU',21,'2022-02-06 09:24:09','sit amet nulla. Donec non justo. Proin non massa non ante bibendum ullamcorper. Duis cursus,',1,1),(24,'CUU53GFD7XD',17,'2021-09-06 02:19:50','a, facilisis non, bibendum sed, est. Nunc laoreet lectus quis massa. Mauris vestibulum, neque sed',1,0),(25,'TES15PFI8QQ',29,'2021-08-19 07:05:08','id, ante. Nunc mauris sapien, cursus in, hendrerit consectetuer, cursus et, magna. Praesent interdum',1,0),(26,'EMP14XRO8NW',47,'2021-09-19 10:30:18','rhoncus. Proin nisl sem, consequat nec, mollis vitae, posuere at, velit. Cras lorem lorem,',0,1),(27,'YLI32KRL4OJ',33,'2021-07-18 05:52:26','varius et, euismod et, commodo at, libero. Morbi accumsan laoreet ipsum. Curabitur consequat, lectus sit amet luctus vulputate, nisi sem',0,1),(28,'SMI64OCK1PP',28,'2022-02-25 01:41:23','scelerisque sed, sapien. Nunc pulvinar arcu et pede. Nunc sed orci',1,1),(29,'NDQ94OBQ7RY',32,'2021-07-20 11:01:12','dolor vitae dolor. Donec fringilla. Donec feugiat metus sit amet ante. Vivamus non lorem vitae',1,1),(30,'EMP14XRO8NW',49,'2021-02-18 08:09:50','viverra. Donec tempus, lorem fringilla ornare placerat, orci lacus vestibulum lorem, sit amet ultricies sem magna',1,0),(31,'BSQ62BIL6FX',11,'2022-03-21 02:21:52','arcu eu odio tristique pharetra. Quisque ac libero nec ligula consectetuer rhoncus. Nullam velit dui, semper',0,0),(32,'BSQ62BIL6FX',21,'2021-09-11 09:30:58','scelerisque dui. Suspendisse ac metus vitae velit egestas lacinia. Sed congue, elit sed consequat auctor, nunc nulla',1,1),(33,'EMP14XRO8NW',15,'2022-06-14 04:50:31','ornare sagittis felis. Donec tempor, est ac mattis semper, dui lectus rutrum urna, nec luctus felis purus ac tellus. Suspendisse',0,0),(34,'EMP14XRO8NW',7,'2021-04-08 02:01:45','Donec tempus, lorem fringilla ornare placerat, orci lacus vestibulum lorem, sit amet ultricies sem magna nec quam. Curabitur vel',1,0),(35,'TLO44AYL8GV',40,'2022-01-25 09:58:47','libero mauris, aliquam eu, accumsan sed, facilisis vitae, orci. Phasellus dapibus quam quis diam. Pellentesque habitant',1,0),(36,'UVW55WOB5OV',17,'2021-03-17 07:39:04','vulputate dui, nec tempus mauris erat eget ipsum. Suspendisse sagittis. Nullam vitae diam. Proin dolor. Nulla semper tellus id',0,0),(37,'HXC49QNS4LW',2,'2021-08-17 07:50:17','dis parturient montes, nascetur ridiculus mus. Aenean eget magna. Suspendisse tristique neque venenatis lacus. Etiam bibendum fermentum metus. Aenean',0,1),(38,'JBW64VNP7VK',3,'2021-02-06 10:36:07','eu enim. Etiam imperdiet dictum magna. Ut tincidunt orci quis lectus.',0,1),(39,'NYC22DXV7DU',10,'2021-12-28 06:13:19','nostra, per inceptos hymenaeos. Mauris ut quam vel sapien imperdiet ornare. In faucibus. Morbi',1,0),(40,'CUU53GFD7XD',45,'2021-01-16 07:36:36','convallis in, cursus et, eros. Proin ultrices. Duis volutpat nunc sit amet metus. Aliquam erat',0,1),(41,'BSQ62BIL6FX',18,'2022-01-26 05:22:29','dapibus quam quis diam. Pellentesque habitant morbi tristique senectus et netus et',0,1),(42,'BSQ62BIL6FX',25,'2021-07-07 02:52:16','quis accumsan convallis, ante lectus convallis est, vitae sodales nisi magna sed dui. Fusce aliquam, enim nec tempus scelerisque,',0,1),(43,'TLO44AYL8GV',5,'2022-03-11 07:51:34','cursus et, magna. Praesent interdum ligula eu enim. Etiam imperdiet dictum magna. Ut tincidunt',0,1),(44,'CUU53GFD7XD',38,'2021-04-28 02:24:18','ornare. Fusce mollis. Duis sit amet diam eu dolor egestas rhoncus. Proin nisl sem, consequat nec, mollis vitae, posuere at,',0,1),(45,'TES15PFI8QQ',9,'2021-09-30 05:57:09','Integer tincidunt aliquam arcu. Aliquam ultrices iaculis odio. Nam interdum enim non nisi. Aenean',0,0),(46,'NYC22DXV7DU',11,'2021-11-06 06:34:46','eu dui. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eget magna. Suspendisse',1,1),(47,'NDQ94OBQ7RY',21,'2021-08-08 10:53:35','aliquet libero. Integer in magna. Phasellus dolor elit, pellentesque a, facilisis non, bibendum sed, est.',0,1),(48,'JNV40OXH7CE',39,'2021-03-05 07:08:35','sed dictum eleifend, nunc risus varius orci, in consequat enim diam vel arcu. Curabitur ut',0,1),(49,'NDQ94OBQ7RY',39,'2021-09-01 02:49:18','odio. Aliquam vulputate ullamcorper magna. Sed eu eros. Nam consequat dolor vitae dolor. Donec fringilla. Donec feugiat',1,0),(50,'NOM24GSL5YE',16,'2021-12-25 08:26:49','Aliquam ornare, libero at auctor ullamcorper, nisl arcu iaculis enim, sit',0,1),(51,'BIS57OAY2HY',53,'2022-04-15 20:49:37','Sorry I am not an expert in databases but I found this answer from a databases website, hope it helps',0,0),(52,'BIS57OAY2HY',53,'2022-04-15 20:54:34','Hey I made a mistake in my previous answer. My knowledge on database was a little off. I have updated my database knowledge and posted a new version. Hope it helps.',0,0),(53,'CCG81MBL4MF',54,'2022-04-15 20:57:13','No there is no limit.',1,1),(54,'BIS57OAY2HY',54,'2022-04-15 20:57:58','Yes I think there is a limit of 2000 for each database',0,1),(55,'PPB86BNB1FN',54,'2022-04-15 20:59:00','No I dont think so',0,1),(56,'TPP41CPE4XO',56,'2022-04-15 21:11:05','Lets say u have 10 cats. You can store it in database 1 database 2 database 3 database 4 database 5 database 6 database 7 database 8 database 9 database 10 respectively',0,0),(57,'RS7671',57,'2022-04-27 13:39:41','Iam fine',0,0),(58,'RS7671',58,'2022-04-27 15:40:18','Hi hello',0,1),(59,'RS7671',58,'2022-04-28 14:10:35','Hi',1,1),(60,'rahul',54,'2022-05-04 22:43:11','Definitely not infinity',1,1),(63,'Kungfu Panda',63,'2022-05-14 13:13:45','Use the grid search feature of the param builder in pyspark',0,0),(71,'rahul',54,'2022-05-14 15:27:40','Definitely not minus infinity',0,0),(72,'rahul',54,'2022-05-14 15:28:13','Definitely not zero too',0,0),(74,'rahul',66,'2022-05-15 23:22:47','Adding an answer',0,0),(76,'rahul',75,'2022-05-16 01:08:38','abdcfdjkd',1,1);
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
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
