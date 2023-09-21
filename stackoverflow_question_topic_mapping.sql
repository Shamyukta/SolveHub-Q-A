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
-- Table structure for table `question_topic_mapping`
--

DROP TABLE IF EXISTS `question_topic_mapping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question_topic_mapping` (
  `subtopic_id` int NOT NULL,
  `question_id` int NOT NULL,
  PRIMARY KEY (`subtopic_id`,`question_id`),
  KEY `question_topic_mapping_ibfk_1` (`question_id`),
  CONSTRAINT `question_topic_mapping_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE,
  CONSTRAINT `question_topic_mapping_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_topic_mapping`
--

LOCK TABLES `question_topic_mapping` WRITE;
/*!40000 ALTER TABLE `question_topic_mapping` DISABLE KEYS */;
INSERT INTO `question_topic_mapping` VALUES (1,6),(2,7),(3,7),(4,7),(5,8),(6,10),(6,11),(6,13),(6,16),(7,16),(7,18),(8,18),(7,19),(7,21),(8,22),(6,24),(7,24),(8,24),(9,24),(10,24),(11,26),(12,27),(13,27),(13,28),(14,29),(15,31),(16,32),(17,32),(18,32),(19,32),(16,33),(17,33),(17,34),(17,35),(20,35),(17,37),(21,38),(25,38),(21,40),(22,40),(22,42),(22,43),(23,44),(23,46),(24,47),(25,47),(23,49),(25,49),(1,52),(2,52),(2,53),(2,54),(2,55),(12,56),(1,60),(2,60),(1,63),(5,63),(16,66),(17,66),(23,77),(24,77),(25,77);
/*!40000 ALTER TABLE `question_topic_mapping` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-30 17:06:24
