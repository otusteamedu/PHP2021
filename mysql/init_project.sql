-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: docker_demo
-- ------------------------------------------------------
-- Server version	5.7.35

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
-- Table structure for table `migrations`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE IF NOT EXISTS `migrations` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                              `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `batch` int(11) NOT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` SELECT 1,'2021_11_04_133032_create_users_table',1  WHERE NOT EXISTS (SELECT * FROM `migrations` WHERE id=1);
INSERT INTO `migrations` SELECT 2,'2021_11_04_140029_create_users_table',2  WHERE NOT EXISTS (SELECT * FROM `migrations` WHERE id=2);
INSERT INTO `migrations` SELECT 3,'2016_06_01_000001_create_oauth_auth_codes_table',3  WHERE NOT EXISTS (SELECT * FROM `migrations` WHERE id=3);
INSERT INTO `migrations` SELECT 4,'2016_06_01_000002_create_oauth_access_tokens_table',3  WHERE NOT EXISTS (SELECT * FROM `migrations` WHERE id=4);
INSERT INTO `migrations` SELECT 5,'2016_06_01_000003_create_oauth_refresh_tokens_table',3  WHERE NOT EXISTS (SELECT * FROM `migrations` WHERE id=5);
INSERT INTO `migrations` SELECT 6,'2016_06_01_000004_create_oauth_clients_table',3  WHERE NOT EXISTS (SELECT * FROM `migrations` WHERE id=6);
INSERT INTO `migrations` SELECT 7,'2016_06_01_000005_create_oauth_personal_access_clients_table',3  WHERE NOT EXISTS (SELECT * FROM `migrations` WHERE id=7);
INSERT INTO `migrations` SELECT 8,'2021_11_05_201901_create_requests_table',4  WHERE NOT EXISTS (SELECT * FROM `migrations` WHERE id=8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
                                       `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                                       `user_id` bigint(20) unsigned DEFAULT NULL,
                                       `client_id` bigint(20) unsigned NOT NULL,
                                       `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                       `scopes` text COLLATE utf8mb4_unicode_ci,
                                       `revoked` tinyint(1) NOT NULL,
                                       `created_at` timestamp NULL DEFAULT NULL,
                                       `updated_at` timestamp NULL DEFAULT NULL,
                                       `expires_at` datetime DEFAULT NULL,
                                       PRIMARY KEY (`id`),
                                       KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
                                    `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                                    `user_id` bigint(20) unsigned NOT NULL,
                                    `client_id` bigint(20) unsigned NOT NULL,
                                    `scopes` text COLLATE utf8mb4_unicode_ci,
                                    `revoked` tinyint(1) NOT NULL,
                                    `expires_at` datetime DEFAULT NULL,
                                    PRIMARY KEY (`id`),
                                    KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE IF NOT EXISTS `oauth_clients` (
                                 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                 `user_id` bigint(20) unsigned DEFAULT NULL,
                                 `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                 `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                 `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `personal_access_client` tinyint(1) NOT NULL,
                                 `password_client` tinyint(1) NOT NULL,
                                 `revoked` tinyint(1) NOT NULL,
                                 `created_at` timestamp NULL DEFAULT NULL,
                                 `updated_at` timestamp NULL DEFAULT NULL,
                                 PRIMARY KEY (`id`),
                                 KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` SELECT 1,NULL,'Lumen Personal Access Client','JTfiH6WSu8aF1o9TBIAWKll1RsA20GVHMec3SM9i',NULL,'http://localhost',1,0,0,'2021-11-04 14:12:07','2021-11-04 14:12:07' WHERE NOT EXISTS (SELECT * FROM `oauth_clients` WHERE id=1);
INSERT INTO `oauth_clients` SELECT 2,NULL,'Lumen Password Grant Client','ycteIUYcMSaO8Y9LA2G7eSILjPOMorL5bHasw03U','users','http://localhost',0,1,0,'2021-11-04 14:12:07','2021-11-04 14:12:07' WHERE NOT EXISTS (SELECT * FROM `oauth_clients` WHERE id=2);
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
                                                 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                                 `client_id` bigint(20) unsigned NOT NULL,
                                                 `created_at` timestamp NULL DEFAULT NULL,
                                                 `updated_at` timestamp NULL DEFAULT NULL,
                                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` SELECT 1,1,'2021-11-04 14:12:07','2021-11-04 14:12:07' WHERE NOT EXISTS (SELECT * FROM `oauth_personal_access_clients` WHERE id=1);
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
                                        `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                                        `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                                        `revoked` tinyint(1) NOT NULL,
                                        `expires_at` datetime DEFAULT NULL,
                                        PRIMARY KEY (`id`),
                                        KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE IF NOT EXISTS `requests` (
                            `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                            `message_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `status` enum('В обратотке','Готово','Ошибка') COLLATE utf8mb4_unicode_ci NOT NULL,
                            `data` blob NOT NULL,
                            `created_at` timestamp NULL DEFAULT NULL,
                            `updated_at` timestamp NULL DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE IF NOT EXISTS `users` (
                         `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                         `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email_verified_at` timestamp NULL DEFAULT NULL,
                         `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` SELECT 1,'Marley Bechtelar','raphaelle.fritsch@example.net',NULL,'$2y$10$VBxifyRkIYZ1QK1rQD7RLug0E4cLRAYbJXpS26HFpdxDwpYlZqBNm',NULL,'2021-11-04 14:01:28','2021-11-04 14:01:28' WHERE NOT EXISTS (SELECT * FROM `users` WHERE id=1);
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

-- Dump completed on 2021-11-06 15:30:26
