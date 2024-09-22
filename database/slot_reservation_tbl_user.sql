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
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(100) NOT NULL,
  `Username` varchar(45) DEFAULT NULL,
  `Password` longtext DEFAULT NULL,
  `Salt` longtext DEFAULT NULL,
  `Role` varchar(45) DEFAULT NULL,
  `Fname` varchar(45) DEFAULT NULL,
  `Mname` varchar(45) DEFAULT NULL,
  `Lname` varchar(45) DEFAULT NULL,
  `GenderId` int(11) DEFAULT NULL,
  `CourseId` int(11) DEFAULT NULL,
  `psgc` varchar(45) DEFAULT NULL,
  `DeletedTag` tinyint(1) DEFAULT 0,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` varchar(45) DEFAULT 'SYSTEM',
  `UpdatedDate` datetime DEFAULT current_timestamp(),
  `UpdatedBy` varchar(45) DEFAULT 'SYSTEM',
  `ProfilePhoto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES (1,'eadriano.it@gmail.com',NULL,'$2y$10$B1WFb/yD7rRnPCwykA84a.9mtXhzv7jZANYDCzkRxu1tJ4aE3nBxK','$2y$10$4K5jV4Q4K5jV4Q4K5jV4Q4K5jV4Q4K5jV4Q4K5jV4Q4K5j','Teacher',NULL,NULL,NULL,NULL,NULL,NULL,0,'2024-09-21 20:55:46','SYSTEM','2024-09-21 20:55:46','SYSTEM','profile.png'),(2,'eadriano.222@gmail.com','Suser','$2y$10$iIAGEL9jOcVbglvjjQpoNeghwXqYpIUM4ZTEyv/8fgv5Nbd2ateHe','$2y$10$4K5jV4Q4K5jV4Q4K5jV4Q4K5jV4Q4K5jV4Q4K5jV4Q4K5j','Teacher','sample','','user',2,2,NULL,0,'2024-09-21 21:06:07','SYSTEM','2024-09-21 16:41:17','Suser','profile.png'),(3,'','Aerickson',NULL,NULL,'Student','Adriano','','Erickson',1,2,NULL,0,'2024-09-21 22:38:51','SYSTEM','2024-09-21 16:38:51','Aerickson','profile.png'),(4,'tifanymasanque2017@gmail.com','Pmas','$2y$10$qN6B9tgE/VpjF.IPCLoA0O/yqfFjM99x/Frf9YT/n7amBUZjv0xVy','$2y$10$4K5jV4Q4K5jV4Q4K5jV4Q4K5jV4Q4K5jV4Q4K5jV4Q4K5j','ADMIN','paning','','mas',2,1,NULL,0,'2024-09-21 22:44:55','SYSTEM','2024-09-21 16:48:11','Pmas','profile.png'),(5,'masanquet@gmail.com','Tmasanque','$2y$10$lPWOWYQQSV9wQF8FkBmsv.mn3NljbuK6BRjrpVi0m3PiPGGh7xSqy','$2y$10$4K5jV4Q4K5jV4Q4K5jV4Q4K5jV4Q4K5jV4Q4K5jV4Q4K5j','TSU Staff','Tifany','hipolito','masanque',2,1,NULL,0,'2024-09-22 07:57:21','SYSTEM','2024-09-22 01:57:59','Tmasanque','tmasanque.jpg');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
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
