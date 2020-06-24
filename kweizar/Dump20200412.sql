-- MySQL dump 10.13  Distrib 8.0.12, for macos10.13 (x86_64)
--
-- Host: localhost    Database: kwzr
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ELEMENT`
--

DROP TABLE IF EXISTS `ELEMENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ELEMENT` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section_id` int NOT NULL,
  `imgSrc` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `destinationType` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `destinationContent` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7E05A023D823E37A` (`section_id`),
  CONSTRAINT `FK_7E05A023D823E37A` FOREIGN KEY (`section_id`) REFERENCES `SECTION` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ELEMENT`
--

LOCK TABLES `ELEMENT` WRITE;
/*!40000 ALTER TABLE `ELEMENT` DISABLE KEYS */;
INSERT INTO `ELEMENT` VALUES (1,2,'img/newer/merch.png','Logo and Cover shirts','We can send shirts to any part in the world','',''),(2,3,'img/newer/hctitlecover.png','Human Convergence','The first Single for the Human Convergence Album','iframe','https://www.youtube.com/watch?v=_0Nir6f18Fs'),(3,3,'img/newer/sharingtitlecover.png','Sharing Sources Playthrough','The first Single for the Human Convergence Album','iframe','https://www.youtube.com/watch?v=6bVKOufqg6I'),(4,3,'img/newer/hypertitlecover.png','Hyperspace Drum Playthrough','The first Single for the Human Convergence Album','iframe','https://www.youtube.com/watch?v=XR_Prj1j7sc'),(5,3,'img/newer/layertitlecover.png','Layer of Abstraction Guitar Playthrough','David Salas\' guitar playthrough','iframe','https://www.youtube.com/watch?v=UTGZfTKe58E');
/*!40000 ALTER TABLE `ELEMENT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MAIN_COMPONENT`
--

DROP TABLE IF EXISTS `MAIN_COMPONENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `MAIN_COMPONENT` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MAIN_COMPONENT`
--

LOCK TABLES `MAIN_COMPONENT` WRITE;
/*!40000 ALTER TABLE `MAIN_COMPONENT` DISABLE KEYS */;
INSERT INTO `MAIN_COMPONENT` VALUES (1,'testing','testing','https://kweizar.band');
/*!40000 ALTER TABLE `MAIN_COMPONENT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SECTION`
--

DROP TABLE IF EXISTS `SECTION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `SECTION` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int NOT NULL,
  `sectiontype_id` int NOT NULL,
  `title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `subTitle` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_123684F5727ACA70` (`parent_id`),
  KEY `IDX_123684F576379936` (`sectiontype_id`),
  CONSTRAINT `FK_123684F5727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `MAIN_COMPONENT` (`id`),
  CONSTRAINT `FK_123684F576379936` FOREIGN KEY (`sectiontype_id`) REFERENCES `SECTION_TYPE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SECTION`
--

LOCK TABLES `SECTION` WRITE;
/*!40000 ALTER TABLE `SECTION` DISABLE KEYS */;
INSERT INTO `SECTION` VALUES (1,1,1,'Home','Main Screen'),(2,1,2,'Merch','Available merch for now'),(3,1,4,'Videos','Latest video streaming'),(4,1,5,'Contact','Do you want to get in touch with the band'),(5,1,2,'Social','Check kweizar on different social Networks');
/*!40000 ALTER TABLE `SECTION` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SECTION_TYPE`
--

DROP TABLE IF EXISTS `SECTION_TYPE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `SECTION_TYPE` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `template` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SECTION_TYPE`
--

LOCK TABLES `SECTION_TYPE` WRITE;
/*!40000 ALTER TABLE `SECTION_TYPE` DISABLE KEYS */;
INSERT INTO `SECTION_TYPE` VALUES (1,'Home','KweizarPageBundle:Publish/components:home.html.twig',''),(2,'Basic Section','KweizarPageBundle:Publish/components:basicSection.html.twig',''),(4,'Element Slider','KweizarPageBundle:Publish/components:elementSlider.html.twig','not sure'),(5,'Contact','KweizarPageBundle:Publish/components:contact.html.twig','not sure');
/*!40000 ALTER TABLE `SECTION_TYPE` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-12 20:35:08
