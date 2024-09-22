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
-- Table structure for table `tbl_event_attendees`
--

DROP TABLE IF EXISTS `tbl_event_attendees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_event_attendees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(45) DEFAULT NULL,
  `EventId` int(11) DEFAULT NULL,
  `EventReserveDate` datetime DEFAULT NULL,
  `DeletedTag` tinyint(1) DEFAULT 0,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` varchar(45) DEFAULT 'SYSTEM',
  `UpdatedDate` datetime DEFAULT current_timestamp(),
  `UpdatedBy` varchar(45) DEFAULT 'SYSTEM',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_event_attendees`
--

LOCK TABLES `tbl_event_attendees` WRITE;
/*!40000 ALTER TABLE `tbl_event_attendees` DISABLE KEYS */;
INSERT INTO `tbl_event_attendees` VALUES (1,'Suser',1,'2024-09-22 13:34:30',0,'2024-09-22 13:34:30','SYSTEM','2024-09-22 13:34:30','SYSTEM'),(2,'Aerickson',1,'2024-09-22 13:34:30',0,'2024-09-22 13:34:30','SYSTEM','2024-09-22 13:34:30','SYSTEM'),(3,'Aerickson',2,'2024-09-22 13:34:30',0,'2024-09-22 13:34:30','SYSTEM','2024-09-22 13:34:30','SYSTEM'),(4,'Tmasanque',2,'2024-09-22 13:34:30',0,'2024-09-22 13:34:30','SYSTEM','2024-09-22 13:34:30','SYSTEM'),(5,'Tmasanque',1,'2024-09-22 13:34:30',0,'2024-09-22 13:34:30','SYSTEM','2024-09-22 13:34:30','SYSTEM');
/*!40000 ALTER TABLE `tbl_event_attendees` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-22 16:38:57
