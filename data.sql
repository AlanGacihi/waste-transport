-- MySQL dump 10.13  Distrib 8.0.25, for macos11 (x86_64)
--
-- Host: localhost    Database: waste_transport
-- ------------------------------------------------------
-- Server version	8.3.0

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calendar`
--

DROP TABLE IF EXISTS `calendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calendar` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `sdate` date NOT NULL,
  `servid` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `calendar_servid_foreign` (`servid`),
  CONSTRAINT `calendar_servid_foreign` FOREIGN KEY (`servid`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendar`
--

LOCK TABLES `calendar` WRITE;
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
INSERT INTO `calendar` VALUES (1,'2018-01-03',1),(2,'2018-01-03',4),(3,'2018-01-04',5),(4,'2018-01-11',5),(5,'2018-01-17',1),(6,'2018-01-17',4),(7,'2018-01-18',5),(8,'2018-01-18',3),(9,'2018-01-25',5),(10,'2018-01-25',3),(11,'2018-01-31',1),(12,'2018-01-31',4),(13,'2018-02-01',5),(14,'2018-02-08',5),(15,'2018-02-14',1),(16,'2018-02-14',4),(17,'2018-02-15',5),(18,'2018-02-22',5),(19,'2018-02-28',1),(20,'2018-02-28',4),(21,'2018-03-01',5),(22,'2018-03-05',3),(23,'2018-03-08',5),(24,'2018-03-12',3),(25,'2018-03-14',1),(26,'2018-03-14',4),(27,'2018-03-15',5),(28,'2018-03-19',3),(29,'2018-03-22',5),(30,'2018-03-26',3),(31,'2018-03-28',1),(32,'2018-03-28',4),(33,'2018-03-29',5),(34,'2018-04-02',3),(35,'2018-04-05',5),(36,'2018-04-09',3),(37,'2018-04-11',1),(38,'2018-04-11',4),(39,'2018-04-12',5),(40,'2018-04-16',3),(41,'2018-04-19',5),(42,'2018-04-23',3),(43,'2018-04-25',1),(44,'2018-04-25',4),(45,'2018-04-26',5),(46,'2018-04-30',3),(47,'2018-05-03',5),(48,'2018-05-07',3),(49,'2018-05-09',1),(50,'2018-05-09',4),(51,'2018-05-10',5),(52,'2018-05-14',3),(53,'2018-05-17',5),(54,'2018-05-21',3),(55,'2018-05-23',1),(56,'2018-05-23',4),(57,'2018-05-24',5),(58,'2018-05-28',3),(59,'2018-05-31',5),(60,'2018-06-03',5),(61,'2018-06-04',3),(62,'2018-06-06',1),(63,'2018-06-06',4),(64,'2018-06-07',5),(65,'2018-06-10',5),(66,'2018-06-11',3),(67,'2018-06-14',5),(68,'2018-06-17',5),(69,'2018-06-18',3),(70,'2018-06-20',1),(71,'2018-06-20',4),(72,'2018-06-21',5),(73,'2018-06-24',5),(74,'2018-06-25',3),(75,'2018-06-28',5),(76,'2018-07-01',5),(77,'2018-07-02',3),(78,'2018-07-04',1),(79,'2018-07-04',4),(80,'2018-07-05',5),(81,'2018-07-08',5),(82,'2018-07-09',3),(83,'2018-07-12',5),(84,'2018-07-15',5),(85,'2018-07-16',3),(86,'2018-07-18',1),(87,'2018-07-18',4),(88,'2018-07-19',5),(89,'2018-07-22',5),(90,'2018-07-23',3),(91,'2018-07-26',5),(92,'2018-07-29',5),(93,'2018-07-30',3),(94,'2018-08-01',1),(95,'2018-08-01',4),(96,'2018-08-02',5),(97,'2018-08-05',5),(98,'2018-08-06',3),(99,'2018-08-09',5),(100,'2018-08-13',3),(101,'2018-08-15',1),(102,'2018-08-15',4),(103,'2018-08-16',5),(104,'2018-08-19',5),(105,'2018-08-20',3),(106,'2018-08-23',5),(107,'2018-08-26',5),(108,'2018-08-27',3),(109,'2018-08-30',5),(110,'2018-09-03',3),(111,'2018-09-06',5),(112,'2018-09-10',3),(113,'2018-09-12',1),(114,'2018-09-12',4),(115,'2018-09-13',5),(116,'2018-09-17',3),(117,'2018-09-20',5),(118,'2018-09-24',3),(119,'2018-09-26',1),(120,'2018-09-26',4),(121,'2018-09-27',5),(122,'2018-10-01',3),(123,'2018-10-04',5),(124,'2018-10-08',3),(125,'2018-10-10',1),(126,'2018-10-10',4),(127,'2018-10-11',5),(128,'2018-10-15',3),(129,'2018-10-18',5),(130,'2018-10-22',3),(131,'2018-10-24',1),(132,'2018-10-24',4),(133,'2018-10-25',5),(134,'2018-10-29',3),(135,'2018-11-01',5),(136,'2018-11-05',3),(137,'2018-11-07',1),(138,'2018-11-07',4),(139,'2018-11-08',5),(140,'2018-11-12',3),(141,'2018-11-15',5),(142,'2018-11-19',3),(143,'2018-11-21',1),(144,'2018-11-21',4),(145,'2018-11-22',5),(146,'2018-11-26',3),(147,'2018-11-29',5),(148,'2018-12-05',1),(149,'2018-12-05',4),(150,'2018-12-06',5),(151,'2018-12-13',5),(152,'2018-12-19',1),(153,'2018-12-20',5),(154,'2018-12-27',5);
/*!40000 ALTER TABLE `calendar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,'Home',1,'2024-12-06 00:53:49','2024-12-06 00:53:49'),(2,'Calendar',1,'2024-12-06 00:53:49','2024-12-06 00:53:49');
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'0001_01_01_000003_create_menu_items_table',1),(5,'0001_01_01_000004_create_services_table',1),(6,'0001_01_01_000005_create_calendar_table',1),(7,'0001_01_01_000006_create_resdems_table',1),(8,'2024_12_05_070149_create_personal_access_tokens_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resdems`
--

DROP TABLE IF EXISTS `resdems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resdems` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `demand` date NOT NULL,
  `servid` int unsigned NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `resdems_user_id_foreign` (`user_id`),
  KEY `resdems_servid_foreign` (`servid`),
  CONSTRAINT `resdems_servid_foreign` FOREIGN KEY (`servid`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  CONSTRAINT `resdems_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resdems`
--

LOCK TABLES `resdems` WRITE;
/*!40000 ALTER TABLE `resdems` DISABLE KEYS */;
INSERT INTO `resdems` VALUES (1,1,'2018-01-04',5,1),(2,1,'2018-01-11',5,1),(3,1,'2018-01-18',4,2),(4,1,'2018-01-18',5,1),(5,1,'2018-01-17',3,1),(6,1,'2018-01-24',5,1),(7,1,'2018-01-30',1,3),(8,1,'2018-01-31',4,1),(9,1,'2018-02-01',5,1),(10,1,'2018-02-08',5,1),(11,1,'2018-02-13',4,1),(12,1,'2018-02-15',5,1),(13,1,'2018-02-22',5,1),(14,1,'2018-02-27',1,2),(15,1,'2018-03-02',4,1),(16,1,'2018-03-01',5,1),(17,1,'2018-03-04',3,2),(18,1,'2018-03-08',5,1),(19,1,'2018-03-15',5,1),(20,1,'2018-03-21',5,1),(21,1,'2018-03-29',5,1),(22,1,'2018-04-03',3,6),(23,1,'2018-04-05',5,1),(24,1,'2018-04-11',3,19),(25,1,'2018-04-09',4,1),(26,1,'2018-04-10',5,1),(27,1,'2018-04-19',5,1),(28,1,'2018-04-26',5,1),(29,1,'2018-04-29',3,5),(30,1,'2018-05-03',5,1),(31,1,'2018-05-06',3,4),(32,1,'2018-05-10',5,1),(33,1,'2018-05-16',3,3),(34,1,'2018-05-17',5,1),(35,1,'2018-05-21',3,3),(36,1,'2018-05-22',1,1),(37,1,'2018-05-24',4,1),(38,1,'2018-05-24',5,1),(39,1,'2018-05-27',3,3),(40,1,'2018-05-31',5,1),(41,1,'2018-06-03',5,1),(42,1,'2018-06-04',3,5),(43,1,'2018-06-04',1,3),(44,1,'2018-06-06',4,3),(45,1,'2018-06-07',5,1),(46,1,'2018-06-10',5,1),(47,1,'2018-06-10',3,2),(48,1,'2018-06-14',5,1),(49,1,'2018-06-17',5,1),(50,1,'2018-06-20',3,2),(51,1,'2018-06-20',4,1),(52,1,'2018-06-21',5,1),(53,1,'2018-06-24',5,1),(54,1,'2018-06-25',3,2),(55,1,'2018-06-27',5,1),(56,1,'2018-07-01',5,1),(57,1,'2018-07-02',3,1),(58,1,'2018-07-02',4,3),(59,1,'2018-07-05',5,1),(60,1,'2018-07-08',5,1),(61,1,'2018-07-08',3,3),(62,1,'2018-07-12',5,1),(63,1,'2018-07-15',5,1),(64,1,'2018-07-16',3,1),(65,1,'2018-07-18',1,1),(66,1,'2018-07-19',4,2),(67,1,'2018-07-19',5,1),(68,1,'2018-07-22',5,1),(69,1,'2018-07-22',3,1),(70,1,'2018-07-26',5,1),(71,1,'2018-07-29',5,1),(72,1,'2018-07-31',3,2),(73,1,'2018-08-26',5,1),(74,1,'2018-08-29',3,3),(75,1,'2018-08-27',1,1),(76,1,'2018-08-29',4,1),(77,1,'2018-08-30',5,1),(78,1,'2018-09-01',3,4),(79,1,'2018-09-06',5,1),(80,1,'2018-09-09',3,3),(81,1,'2018-09-10',1,3),(82,1,'2018-09-13',5,1),(83,1,'2018-09-18',3,2),(84,1,'2018-09-20',5,1),(85,1,'2018-09-23',3,1),(86,1,'2018-09-24',4,2),(87,1,'2018-09-27',5,1),(88,1,'2018-09-29',3,1),(89,1,'2018-10-04',5,1),(90,1,'2018-10-10',3,2),(91,1,'2018-10-10',5,1),(92,1,'2018-10-15',3,2),(93,1,'2018-10-18',5,1),(94,1,'2018-10-22',3,6),(95,1,'2018-10-25',5,1),(96,1,'2018-10-31',3,3),(97,1,'2018-11-01',5,1),(98,1,'2018-11-04',3,13),(99,1,'2018-11-05',1,2),(100,1,'2018-11-07',4,1),(101,1,'2018-11-15',5,1),(102,1,'2018-11-17',3,7),(103,1,'2018-11-22',5,1),(104,1,'2018-11-26',3,3),(105,1,'2018-11-29',5,1),(106,1,'2018-12-06',5,1),(107,1,'2018-12-13',5,1),(108,1,'2018-12-19',4,2),(109,1,'2018-12-20',5,1),(110,1,'2018-12-26',5,1);
/*!40000 ALTER TABLE `resdems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `wtype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'pla','Plastic waste: PET bottle, cosmetic flasks (PP+HDPE), bags.'),(2,'gla','Glass waste: coloured and white glass.'),(3,'green','Green waste: compostable garden waste.'),(4,'pap','Paper waste: newspapers, books, cardboard boxes.'),(5,'com','Communal waste: solid, residential, non-degradable, non-hazardous waste.');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Test User','test@example.com',1,'2024-12-06 00:53:49','$2y$12$lFNid.E11DGcpDq7adO0PuJZ7fOfUSQ2y8n6y/lrBt3uUq/XR.1Lm','24zoJv74QV','2024-12-06 00:53:49','2024-12-06 00:53:49');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-06  6:54:57
