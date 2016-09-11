-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: postee-db
-- ------------------------------------------------------
-- Server version	5.7.11

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `core_extension`
--

DROP TABLE IF EXISTS `core_extension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_extension` (
  `id` int(11) NOT NULL,
  `extension_name` varchar(255) DEFAULT NULL,
  `version` varchar(48) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_extension`
--

LOCK TABLES `core_extension` WRITE;
/*!40000 ALTER TABLE `core_extension` DISABLE KEYS */;
INSERT INTO `core_extension` VALUES (1,'version','0.0.0.1'),(2,'status','0.0.1.0');
/*!40000 ALTER TABLE `core_extension` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_posts`
--

DROP TABLE IF EXISTS `core_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `author` varchar(48) DEFAULT NULL,
  `published_date` varchar(48) DEFAULT NULL,
  `tags` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_posts`
--

LOCK TABLES `core_posts` WRITE;
/*!40000 ALTER TABLE `core_posts` DISABLE KEYS */;
INSERT INTO `core_posts` VALUES (1,'Great Hollywood Mystery','Did you know that Hollywood is remaking the 1994 film The Crow? Additionally, did you realize that it was probably going to start filming soon? According to The Wrap, who spoke with multiple sources attached.','Geek','01-01-2001','geek,news'),(2,'Lego Strikes Again','Your Lego Steve and Alex minifigs are great, but you’re pretty limited when it comes to faithful Lego clothing options. Fortunately the new Minecraft Skin Packs have arrived to address that little problem.','Lee Mathews','01-01-2001','geek,minecraft'),(3,'iPhone 7 News','Removing the traditional 3.5mm headphone jack from the iPhone 7 has been widely regarded as a bad idea, but Apple appears dead-set on compounding its error by making adapters for the iPhone expensive and annoying to deal with.','Geek','01-01-2001','geek,iphone'),(4,'Google DeepMind','We all become accustomed to the tone and pattern of human speech at an early age, and any deviations from what we have come to accept as “normal” are immediately recognizable.','Geek','01-01-2001','geek,google'),(5,'Best Deathstars','What’s that you say? There’s only two actual Death Stars in the Star Wars movies? Even though the image of the Death Star appears in Attack of the Clones (hologram), Revenge of the','Geek','01-01-2001','geek');
/*!40000 ALTER TABLE `core_posts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-11 20:06:50
