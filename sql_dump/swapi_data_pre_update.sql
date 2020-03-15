-- MySQL dump 10.15  Distrib 10.0.38-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: swapi
-- ------------------------------------------------------
-- Server version	10.0.38-MariaDB-0ubuntu0.16.04.1

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
-- Table structure for table `swapi_character`
--

DROP TABLE IF EXISTS `swapi_character`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `swapi_character` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `height` varchar(45) DEFAULT NULL,
  `mass` varchar(45) DEFAULT NULL,
  `hair_color` varchar(45) DEFAULT NULL,
  `birth_year` varchar(45) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `homeworld_name` varchar(45) DEFAULT NULL,
  `species_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `swapi_character`
--

LOCK TABLES `swapi_character` WRITE;
/*!40000 ALTER TABLE `swapi_character` DISABLE KEYS */;
INSERT INTO `swapi_character` VALUES (12,'Luke Skywalker','172','77','blond','19BBY','male','Tatooine','Human'),(13,'C-3PO','167','75','n/a','112BBY','n/a','Tatooine','Droid'),(14,'R2-D2','96','32','n/a','33BBY','n/a','Naboo','Droid'),(15,'Darth Vader','202','136','none','41.9BBY','male','Tatooine','Human'),(16,'Leia Organa','150','49','brown','19BBY','female','Alderaan','Human'),(17,'Owen Lars','178','120','brown, grey','52BBY','male','Tatooine','Human'),(18,'Beru Whitesun lars','165','75','brown','47BBY','female','Tatooine','Human'),(19,'R5-D4','97','32','n/a','unknown','n/a','Tatooine','Droid'),(20,'Biggs Darklighter','183','84','black','24BBY','male','Tatooine','Human'),(21,'Obi-Wan Kenobi','182','77','auburn, white','57BBY','male','Stewjon','Human');
/*!40000 ALTER TABLE `swapi_character` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-15 23:14:22
