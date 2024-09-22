-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: slot_reservation
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.11-MariaDB

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
-- Table structure for table `tbl_content_home`
--

DROP TABLE IF EXISTS `tbl_content_home`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_content_home` (
  `ContentId` int(11) NOT NULL AUTO_INCREMENT,
  `ContentTitle` varchar(45) DEFAULT NULL,
  `Description` longtext DEFAULT NULL,
  `ContentImage` varchar(45) DEFAULT NULL,
  `PostCreatedby` varchar(45) DEFAULT NULL,
  `CommentAction` tinyint(1) DEFAULT 1,
  `DeletedTag` tinyint(1) DEFAULT 0,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` varchar(45) DEFAULT 'SYSTEM',
  `UpdatedDate` datetime DEFAULT NULL,
  `UpdatedBy` varchar(45) DEFAULT NULL,
  `IsImportant` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ContentId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_content_home`
--

LOCK TABLES `tbl_content_home` WRITE;
/*!40000 ALTER TABLE `tbl_content_home` DISABLE KEYS */;
INSERT INTO `tbl_content_home` VALUES (1,'Sample 1','Description 1','ccs_shirt.jpg','Aerickson',0,0,'2024-09-22 08:08:29','SYSTEM',NULL,NULL,NULL),(2,'sample 2','My Family 2','meeting_ccs.jpg','Tmasanque',1,0,'2024-09-22 07:08:50','SYSTEM',NULL,NULL,NULL),(3,'Sample 3','Description 3','ccs_shirt.jpg','Aerickson',0,0,'2024-09-22 08:08:29','SYSTEM',NULL,NULL,NULL),(4,'sample 4','My Family 4','meeting_ccs.jpg','Tmasanque',1,0,'2024-09-22 08:08:50','SYSTEM',NULL,NULL,NULL),(5,'Sample 5','Description 5','ccs_shirt.jpg','Aerickson',0,0,'2024-09-22 08:08:29','SYSTEM',NULL,NULL,NULL),(6,'sample 2','My Family 6','meeting_ccs.jpg','Tmasanque',1,0,'2024-09-22 08:08:50','SYSTEM',NULL,NULL,NULL),(7,'Sample Title','Description 7','ccs_shirt.jpg','Aerickson',0,0,'2024-09-22 08:08:29','SYSTEM',NULL,NULL,NULL),(8,'sample 2','<b>CSS ANNOUNCEMENT.</b>','meeting_ccs.jpg','Tmasanque',1,0,'2024-09-22 08:08:50','SYSTEM',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_content_home` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-22 16:38:56
