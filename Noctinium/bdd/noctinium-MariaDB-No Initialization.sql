-- MySQL dump 10.16  Distrib 10.1.48-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: db
-- ------------------------------------------------------
-- Server version	10.1.48-MariaDB-0+deb9u2

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
-- Table structure for table `commentevent`
--

DROP TABLE IF EXISTS `commentevent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commentevent`(
  `commentevent_id` INT NOT NULL AUTO_INCREMENT,
  `commentevent_content` VARCHAR(500) NOT NULL,
  `commentevent_date` DATETIME NOT NULL,
  `commentevent_user_id` INT NOT NULL,
  `commentevent_events_id` INT NOT NULL,
  PRIMARY KEY(`commentevent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentevent`
--

LOCK TABLES `commentevent` WRITE;
/*!40000 ALTER TABLE `commentevent` DISABLE KEYS */;
/*!40000 ALTER TABLE `commentevent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentorganiser`
--

DROP TABLE IF EXISTS `commentorganiser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commentorganiser`(
  `commentorganiser_id` INT NOT NULL AUTO_INCREMENT,
  `commentorganiser_content` VARCHAR(500) NOT NULL,
  `commentorganiser_date` DATETIME NOT NULL,
  `commentorganiser_user_id` INT NOT NULL,
  `commentorganiser_organiser_id` INT NOT NULL,
  PRIMARY KEY(`commentorganiser_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentorganiser`
--

LOCK TABLES `commentorganiser` WRITE;
/*!40000 ALTER TABLE `commentorganiser` DISABLE KEYS */;
/*!40000 ALTER TABLE `commentorganiser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events`(
  `event_id` INT NOT NULL AUTO_INCREMENT,
  `event_title` VARCHAR(30) NOT NULL,
  `event_datetime` DATETIME NOT NULL,
  `event_location` VARCHAR(50) NOT NULL,
  `event_description` VARCHAR(1000) NOT NULL,
  `event_music` INT NOT NULL,
  `event_type` INT NOT NULL,
  `event_private` TINYINT(1) DEFAULT(0) NOT NULL,
  `event_maskedlocation` DATETIME DEFAULT(NULL) NULL,
  `event_price` DECIMAL DEFAULT(0) NULL,
  `event_creation` DATETIME NOT NULL,
  `event_user_id` INT NOT NULL,
  `event_imageevent_id` INT NOT NULL,
  PRIMARY KEY(`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imageevent`
--

DROP TABLE IF EXISTS `imageevent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imageevent`(
  `imageevent_id` INT NOT NULL AUTO_INCREMENT,
  `imageevent_url` VARCHAR(50) NOT NULL,
  PRIMARY KEY(`imageevent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imageevent`
--

LOCK TABLES `imageevent` WRITE;
/*!40000 ALTER TABLE `imageevent` DISABLE KEYS */;
/*!40000 ALTER TABLE `imageevent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imageuser`
--

DROP TABLE IF EXISTS `imageuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imageuser`(
  `imageuser_id` INT NOT NULL AUTO_INCREMENT,
  `imageuser_url` VARCHAR(50) NOT NULL,
  PRIMARY KEY(`imageuser_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imageuser`
--

LOCK TABLES `imageuser` WRITE;
/*!40000 ALTER TABLE `imageuser` DISABLE KEYS */;
/*!40000 ALTER TABLE `imageuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rating`(
  `rating_id` INT NOT NULL AUTO_INCREMENT,
  `rating_value` INT NOT NULL,
  `rating_user_id` INT NOT NULL,
  `rating_organiser_id` INT NOT NULL,
  PRIMARY KEY(`rating_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating`
--

LOCK TABLES `rating` WRITE;
/*!40000 ALTER TABLE `rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user`(
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `user_surname` VARCHAR(40) NOT NULL,
  `user_name` VARCHAR(40) NOT NULL,
  `user_username` VARCHAR(40) NOT NULL,
  `user_email` VARCHAR(50) NOT NULL,
  `user_telephone` VARCHAR(10) NOT NULL,
  `user_birthdate` DATE NOT NULL,
  `user_password` VARCHAR(60) NOT NULL,
  `user_timecreation` DATETIME NOT NULL,
  `user_imageuser_id` INT NOT NULL,
  `user_type` INT DEFAULT(1) NOT NULL,
  `user_typesubscription` INT DEFAULT(1) NOT NULL,
  `user_description` VARCHAR(1000)  NULL,
  `user_instagram` VARCHAR(50) NULL,
  `user_twitter` VARCHAR(50) NULL,
  `user_site` VARCHAR(50) NULL,
  PRIMARY KEY(`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-27 22:44:47
