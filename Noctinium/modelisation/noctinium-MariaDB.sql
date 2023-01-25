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
CREATE TABLE `commentevent` (
  `commentevent_id` varchar(0) DEFAULT NULL,
  `commentevent_content` varchar(0) DEFAULT NULL,
  `commentevent_date` varchar(0) DEFAULT NULL,
  `commentevent_user_id` varchar(0) DEFAULT NULL,
  `commentevent_event_id` varchar(0) DEFAULT NULL
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
CREATE TABLE `commentorganiser` (
  `commentorganiser_id` varchar(0) DEFAULT NULL,
  `commentorganiser_content` varchar(0) DEFAULT NULL,
  `commentorganiser_date` varchar(0) DEFAULT NULL,
  `commentorganiser_user_id` varchar(0) DEFAULT NULL,
  `commentorganiser_organiser_id` varchar(0) DEFAULT NULL
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
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `event_id` varchar(0) DEFAULT NULL,
  `event_title` varchar(0) DEFAULT NULL,
  `event_datetime` varchar(0) DEFAULT NULL,
  `event_location` varchar(0) DEFAULT NULL,
  `event_description` varchar(0) DEFAULT NULL,
  `event_music` varchar(0) DEFAULT NULL,
  `event_type` varchar(0) DEFAULT NULL,
  `event_private` varchar(0) DEFAULT NULL,
  `event_maskedlocation` varchar(0) DEFAULT NULL,
  `event_price` varchar(0) DEFAULT NULL,
  `event_user_id` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imageevent`
--

DROP TABLE IF EXISTS `imageevent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imageevent` (
  `imageevent_id` varchar(0) DEFAULT NULL,
  `imageevent_url` varchar(0) DEFAULT NULL,
  `imageevent_event_id` varchar(0) DEFAULT NULL
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
CREATE TABLE `imageuser` (
  `imageuser_id` varchar(0) DEFAULT NULL,
  `imageuser_url` varchar(0) DEFAULT NULL
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
CREATE TABLE `rating` (
  `rating_id` varchar(0) DEFAULT NULL,
  `rating_value` varchar(0) DEFAULT NULL,
  `rating_user_id` varchar(0) DEFAULT NULL,
  `rating_organiser_id` varchar(0) DEFAULT NULL
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
CREATE TABLE `user` (
  `user_id` varchar(0) DEFAULT NULL,
  `user_surname` varchar(0) DEFAULT NULL,
  `user_name` varchar(0) DEFAULT NULL,
  `user_username` varchar(0) DEFAULT NULL,
  `user_email` varchar(0) DEFAULT NULL,
  `user_telephone` varchar(0) DEFAULT NULL,
  `user_birthdate` varchar(0) DEFAULT NULL,
  `user_password` varchar(0) DEFAULT NULL,
  `user_timecreation` varchar(0) DEFAULT NULL,
  `user_type` varchar(0) DEFAULT NULL,
  `user_typesubcription` varchar(0) DEFAULT NULL,
  `user_decription` varchar(0) DEFAULT NULL,
  `user_instagram` varchar(0) DEFAULT NULL,
  `user_twitter` varchar(0) DEFAULT NULL,
  `user_site` varchar(0) DEFAULT NULL,
  `user_imageuser_id` varchar(0) DEFAULT NULL
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
