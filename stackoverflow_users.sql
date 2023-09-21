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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `display_name` varchar(50) NOT NULL,
  `passcode` char(32) NOT NULL,
  `city` varchar(60) DEFAULT NULL,
  `state` varchar(60) DEFAULT NULL,
  `country` varchar(60) NOT NULL,
  `aboutme` longtext,
  `emailhash` varchar(50) NOT NULL,
  `user_level` varchar(20) DEFAULT 'bronze',
  `points` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`display_name`),
  CONSTRAINT `users_chk_1` CHECK ((`user_level` in (_utf8mb4'gold',_utf8mb4'silver',_utf8mb4'bronze'))),
  CONSTRAINT `users_chk_2` CHECK ((`user_level` in (_utf8mb4'gold',_utf8mb4'silver',_utf8mb4'bronze')))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('#####','e10adc3949ba59abbe56e057f20f883e',NULL,NULL,'Afganistan',NULL,'abc@gmail.com','bronze',0),('######','d8578edf8458ce06fbc5bb76a58c5ca4',NULL,NULL,'Afganistan',NULL,'uk@gmail.com','bronze',0),('AXE87SZT3FU','MRA14ODD2CD','Bellevue','College','United States','id sapien. Cras dolor dolor, tempus non, lacinia at, iaculis','integer.vulputate.risus@icloud.net','gold',624.13),('BIS57OAY2HY','JMF28EYN7GF','Columbus','Essex','United States','molestie. Sed id risus quis diam luctus lobortis. Class aptent','facilisis@aol.org','gold',330.84),('BSQ62BIL6FX','DVW51NLC1MX','Milwaukee','Worcester','United States','urna, nec luctus felis purus ac tellus. Suspendisse sed dolor.','integer@hotmail.edu','gold',471.82),('CCG81MBL4MF','FBP42IGU5RC','South Burlington','Aurora','United States','augue scelerisque mollis. Phasellus libero mauris, aliquam eu, accumsan sed,','fringilla.porttitor.vulputate@protonmail.ca','bronze',32.5),('CDFGJK09','ahgdgd$@','Brooklyn','New York','United States','Hey there!','harrypotter@hogwards.com','bronze',0),('CFU65WCM1FH','NKM18RUO2HR','Casper','Honolulu','United States','Nullam vitae diam. Proin dolor. Nulla semper tellus id nunc','adipiscing.fringilla@google.couk','bronze',0),('CGM36RKB1TS','QVN55GWE3SM','Lakewood','Annapolis','United States','a, facilisis non, bibendum sed, est. Nunc laoreet lectus quis','purus.in@yahoo.net','gold',366.59),('CUU53GFD7XD','BUK30XWQ4SX','Lewiston','Louisville','United States','vel arcu. Curabitur ut odio vel est tempor bibendum. Donec','cum.sociis.natoque@outlook.net','bronze',0),('DDN08DOX9DW','RIF26DCC7LY','Tuscaloosa','Bellevue','United States','Proin dolor. Nulla semper tellus id nunc interdum feugiat. Sed','dolor.fusce@protonmail.net','silver',72.08),('EMP14XRO8NW','HNC17WJF5SQ','Tulsa','Gresham','United States','aliquam iaculis, lacus pede sagittis augue, eu tempor erat neque','elit.pharetra@google.com','bronze',0),('ERW73IYG9DD','IAT64HKK0WF','Hartford','South Burlington','United States','vel arcu eu odio tristique pharetra. Quisque ac libero nec','aliquam.fringilla.cursus@aol.org','silver',144.05),('FOT95EPE3FG','PEU07QTS8GT','Salt Lake City','Gulfport','United States','blandit enim consequat purus. Maecenas libero est, congue a, aliquet','nunc.ullamcorper@outlook.net','bronze',0),('GPP57TPH6GO','HEP43UZK5CA','Norfolk','Erie','United States','non enim. Mauris quis turpis vitae purus gravida sagittis. Duis','enim.etiam@icloud.edu','silver',63.99),('hari rahul','d8578edf8458ce06fbc5bb76a58c5ca4',NULL,NULL,'Antigua & Barbuda',NULL,'hari@gmail.com','bronze',0),('haripriya ','d8578edf8458ce06fbc5bb76a58c5ca4',NULL,NULL,'India',NULL,'haripriya@gmail.com','bronze',1),('HXC49QNS4LW','ZPM93ODF7DK','Great Falls','Fort Wayne','United States','Nunc quis arcu vel quam dignissim pharetra. Nam ac nulla.','sapien.cursus@icloud.couk','gold',624.84),('HYE18WCK1DU','FDY19QKW6BN','Kansas City','Tucson','United States','scelerisque scelerisque dui. Suspendisse ac metus vitae velit egestas lacinia.','luctus.ut@outlook.org','bronze',0),('HYR17JOD4BH','BGN81IRM5UO','Fort Smith','Fort Collins','United States','vitae, sodales at, velit. Pellentesque ultricies dignissim lacus. Aliquam rutrum','orci@protonmail.edu','silver',122.13),('IDR83LDN8YA','QHB88HHN8TI','Athens','Bellevue','United States','Duis risus odio, auctor vitae, aliquet nec, imperdiet nec, leo.','tincidunt.adipiscing@icloud.com','silver',117.2),('INN44YEN9QL','ZRB62EYC2KQ','Iowa City','Kaneohe','United States','ornare tortor at risus. Nunc ac sem ut dolor dapibus','et.commodo@outlook.net','gold',195.77),('IQW23ZRT4IN','JUG33OIG7FG','Columbia','Independence','United States','in magna. Phasellus dolor elit, pellentesque a, facilisis non, bibendum','iaculis.lacus@icloud.com','silver',101.33),('ISX03YUU7KI','XAV98PTA0AS','Waterbury','Kailua','United States','ipsum dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero','sit.amet.ornare@outlook.net','gold',180.7),('JBW64VNP7VK','NGM49FJJ1JQ','Georgia','Knoxville','United States','Integer sem elit, pharetra ut, pharetra sed, hendrerit a, arcu.','malesuada@icloud.couk','bronze',0),('JNV40OXH7CE','IXA49ARF6QW','Dover','Lansing','United States','sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos.','mattis.velit@yahoo.couk','bronze',0),('karthik','d8578edf8458ce06fbc5bb76a58c5ca4',NULL,NULL,'Angola',NULL,'karthik@nyu.edu','bronze',0),('KFC77SEL2LJ','WAD54IGE2UL','Aurora','Indianapolis','United States','volutpat. Nulla dignissim. Maecenas ornare egestas ligula. Nullam feugiat placerat','eleifend@google.org','silver',140.46),('Kungfu Panda','d8578edf8458ce06fbc5bb76a58c5ca4','Brooklyn','NY','Afganistan','Im a panda guy','kungfu@gmail.com','silver',77),('LSI76ECK2YK','MHY51BPF6PX','Baltimore','Iowa City','United States','justo. Praesent luctus. Curabitur egestas nunc sed libero. Proin sed','tempus.lorem.fringilla@outlook.net','gold',276.3),('MFM76GML6JF','NTI76WIJ2AU','Hillsboro','Evansville','United States','lectus, a sollicitudin orci sem eget massa. Suspendisse eleifend. Cras','a.magna@hotmail.ca','bronze',0),('MZG06WFW0TW','UHQ61XKH3SY','Rockford','Aurora','United States','ligula consectetuer rhoncus. Nullam velit dui, semper et, lacinia vitae,','volutpat.nulla@hotmail.couk','silver',76.8),('NDQ94OBQ7RY','BJO70TWW3KW','Miami','Helena','United States','Suspendisse ac metus vitae velit egestas lacinia. Sed congue, elit','aliquet.proin@hotmail.org','silver',103.11),('NIG77EAR4HM','XCA18VMN5VL','Oklahoma City','Southaven','United States','elementum, lorem ut aliquam iaculis, lacus pede sagittis augue, eu','vivamus.nisi@icloud.edu','silver',130.12),('NOM24GSL5YE','TWW67QIM2UG','Wyoming','Chesapeake','United States','enim, sit amet ornare lectus justo eu arcu. Morbi sit','donec.fringilla@aol.org','bronze',0),('NYC22DXV7DU','BBC62QXV7NS','Houston','West Valley City','United States','eget tincidunt dui augue eu tellus. Phasellus elit pede, malesuada','posuere.at.velit@hotmail.org','bronze',0),('NYW98JAU1GR','TNE27QGR9FF','Davenport','West Jordan','United States','interdum. Nunc sollicitudin commodo ipsum. Suspendisse non leo. Vivamus nibh','ipsum@yahoo.net','silver',91.28),('ONA03YKT5VA','VCF60TPR4IC','Olympia','Lafayette','United States','ultricies ligula. Nullam enim. Sed nulla ante, iaculis nec, eleifend','semper.auctor.mauris@yahoo.com','bronze',0),('PIC87URC9HQ','XJP54PLQ6OT','Savannah','Milwaukee','United States','facilisis lorem tristique aliquet. Phasellus fermentum convallis ligula. Donec luctus','libero.proin@aol.ca','bronze',0),('PPB86BNB1FN','FLY04PMT6CL','Lafayette','Austin','United States','nec, mollis vitae, posuere at, velit. Cras lorem lorem, luctus','suscipit.nonummy@protonmail.couk','bronze',0),('PXF25DEQ1GF','RNS03NUU3ZX','Fort Smith','Seattle','United States','amet risus. Donec egestas. Aliquam nec enim. Nunc ut erat.','tincidunt.pede@icloud.couk','silver',101.05),('PXO33WPD8CE','ZCJ53OVV5AP','Hilo','Huntsville','United States','nulla ante, iaculis nec, eleifend non, dapibus rutrum, justo. Praesent','nulla.dignissim.maecenas@aol.net','silver',76.42),('rahul','d8578edf8458ce06fbc5bb76a58c5ca4',NULL,NULL,'India',NULL,'rahul@gmail.com','silver',183),('RDA89NFP8FV','QNV79YHK8BP','Eugene','Pike Creek','United States','ut odio vel est tempor bibendum. Donec felis orci, adipiscing','nascetur@hotmail.net','bronze',0),('ronaldo@771','a152e841783914146e4bcd4f39100686',NULL,NULL,'Argentina',NULL,'ronaldo@gmail.com','bronze',0),('RS7671','d41d8cd98f00b204e9800998ecf8427e','Brooklyn','New York','India','Im a CS student','rs7671@gmail.com','bronze',-10),('SAM40CML6SY','HFT45EGX2YI','Cedar Rapids','Huntsville','United States','et malesuada fames ac turpis egestas. Aliquam fringilla cursus purus.','maecenas@icloud.edu','silver',113.93),('SCH43KNM6LU','NUD70HBF6HK','Oklahoma City','Flint','United States','Suspendisse aliquet, sem ut cursus luctus, ipsum leo elementum sem,','sed.dui@hotmail.couk','silver',90.39),('shanthisree','d8578edf8458ce06fbc5bb76a58c5ca4',NULL,NULL,'India',NULL,'shanthisree@gmail.com','bronze',0),('SMI64OCK1PP','QPW72HSX8GZ','Owensboro','Nashville','United States','pede. Praesent eu dui. Cum sociis natoque penatibus et magnis','a.dui@hotmail.ca','bronze',0),('SMS45ROA5BB','IHU24ONR4TX','North Las Vegas','Salem','United States','Proin vel arcu eu odio tristique pharetra. Quisque ac libero','donec.vitae.erat@aol.net','silver',145.17),('TES15PFI8QQ','WHZ33TKJ7MS','Savannah','Harrisburg','United States','sed dictum eleifend, nunc risus varius orci, in consequat enim','congue@outlook.edu','bronze',0),('THD12SMH4KP','OGB48FGG8IO','Colchester','Norman','United States','sed dolor. Fusce mi lorem, vehicula et, rutrum eu, ultrices','nam.nulla@hotmail.ca','bronze',0),('TLO44AYL8GV','VSX50ENE3SS','Lincoln','Boise','United States','risus. Donec egestas. Aliquam nec enim. Nunc ut erat. Sed','gravida.molestie.arcu@aol.edu','gold',596.76),('TPP41CPE4XO','HFL46PUS6RQ','Boise','Meridian','United States','vel quam dignissim pharetra. Nam ac nulla. In tincidunt congue','magna.duis.dignissim@protonmail.org','bronze',1),('UDG04IQU5UX','NRP21KOK6XQ','Portland','Bellevue','United States','egestas blandit. Nam nulla magna, malesuada vel, convallis in, cursus','enim.non.nisi@icloud.net','bronze',0),('UVW55WOB5OV','JOR10SVZ7FL','South Bend','Aurora','United States','massa. Quisque porttitor eros nec tellus. Nunc lectus pede, ultrices','dui.augue@outlook.edu','silver',147.83),('WPD94GLC7SV','SCV34WRP6QV','Rockford','Pittsburgh','United States','orci, adipiscing non, luctus sit amet, faucibus ut, nulla. Cras','proin@outlook.org','silver',65.13),('XRZ13BHI5VF','GQJ16PXS5QI','Colchester','Sterling Heights','United States','egestas. Duis ac arcu. Nunc mauris. Morbi non sapien molestie','eu@yahoo.edu','bronze',0),('YLI32KRL4OJ','JEJ74SXN2PE','Boise','Bellevue','United States','augue, eu tempor erat neque non quam. Pellentesque habitant morbi','proin.mi@protonmail.edu','bronze',156),('ZIC61CBQ1IO','SGV36CNF1EC','Kansas City','Gulfport','United States','ac libero nec ligula consectetuer rhoncus. Nullam velit dui, semper','orci.sem@protonmail.org','silver',107.19);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `User_status_check` BEFORE UPDATE ON `users` FOR EACH ROW BEGIN
    DECLARE flagged_count INT DEFAULT 0;
    DECLARE questions_asked INT DEFAULT 0;
    select count(*) into flagged_count from (select answer_id from answers where answerer_display_name=NEW.display_name) as user_answers, votes as v where v.answer_id = user_answers.answer_id and v.votetype="flagged";
    select count(*) into questions_asked from questions where questioner_display_name= NEW.display_name;
    IF (NEW.points < 60 AND OLD.user_level != "bronze") THEN
	    SET NEW.user_level = "bronze";
    ELSEIF NEW.points BETWEEN 60 AND 154 THEN
	    IF (flagged_count<4) THEN
          SET NEW.user_level = "silver";
	    ELSE 
          SET NEW.user_level = "bronze";
        END IF;  
    ELSEIF (NEW.points >=155) AND (questions_asked >= 2) THEN
	    IF (flagged_count<2) THEN
          SET NEW.user_level = "gold";
	    ELSEIF (flagged_count<4) THEN 
          SET NEW.user_level = "silver";  
        ELSE SET NEW.user_level = "bronze";
        END IF;
    ELSEIF (NEW.points >=155) AND (questions_asked <2) THEN
          IF (flagged_count<4) THEN 
            SET NEW.user_level = "silver";
          ELSE  
             SET NEW.user_level = "bronze";
          END IF;   
    END IF;    
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-30 17:06:25
