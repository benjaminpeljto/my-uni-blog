-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: web_blog_08_07_2023
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blogs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `create_time` datetime NOT NULL,
  `likes` int DEFAULT '0',
  `user_id` int unsigned NOT NULL,
  `category_id` int unsigned DEFAULT NULL,
  `summary` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_id_UNIQUE` (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `category_id_idx` (`category_id`),
  CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (26,'hehbhbds','kansjdna ajs da sdas dkas djas djas dja sjdh asjdjas djas djas dja sdj asjd asj dasn djas djasn djasn djas jas djasn dasn djasn djans djasn djasn djasn djnas djna sjdn asjdn ajsn dajs djasn djasn da. ajs bdias da. iasjd asd.','2024-05-31 00:12:44',0,41,3,NULL),(27,'Moj tajtl','ja kreno i hopala. eto tako smo mi. Kad god isli. krenuli i isli. ma sta god radili smo teku ponijeli i isli dugim stazama puta. aaaaaaaaa','2024-05-31 18:36:37',0,42,6,NULL),(28,'sdfsdfsd','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget ultricies nisl. Ut blandit tortor ac volutpat elementum. Mauris et bibendum ante. Curabitur tristique diam vel efficitur dignissim. In maximus egestas tincidunt. Nullam id mattis sem. Proin ac sodales ligula. Praesent ut scelerisque libero. Proin gravida dui sapien, non sollicitudin nulla imperdiet id. Quisque ut leo dui. Nam varius, nisl in bibendum aliquam, ligula odio posuere sem, non feugiat tellus velit at ante. Sed aliquam enim sit amet leo ullamcorper, vel rutrum sem venenatis. Vivamus pellentesque lorem felis, non finibus diam tempor vehicula. Vivamus eget magna non lacus volutpat efficitur id id lectus. Etiam bibendum interdum ex, eget ultricies neque.','2024-05-31 19:15:40',0,42,4,NULL),(29,'Lorem','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget ultricies nisl. Ut blandit tortor ac volutpat elementum. Mauris et bibendum ante. Curabitur tristique diam vel efficitur dignissim. In maximus egestas tincidunt. Nullam id mattis sem. Proin ac sodales ligula. Praesent ut scelerisque libero. Proin gravida dui sapien, non sollicitudin nulla imperdiet id. Quisque ut leo dui. Nam varius, nisl in bibendum aliquam, ligula odio posuere sem, non feugiat tellus velit at ante. Sed aliquam enim sit amet leo ullamcorper, vel rutrum sem venenatis. Vivamus pellentesque lorem felis, non finibus diam tempor vehicula. Vivamus eget magna non lacus volutpat efficitur id id lectus. Etiam bibendum interdum ex, eget ultricies neque.','2024-05-31 19:16:01',0,42,4,NULL);
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_id_UNIQUE` (`id`),
  UNIQUE KEY `category_name_UNIQUE` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (4,'Cars'),(1,'Fashion'),(3,'Fitness'),(8,'Food'),(2,'Lifestyle'),(5,'Music'),(7,'Sports'),(6,'Travel');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorite_blogs`
--

DROP TABLE IF EXISTS `favorite_blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favorite_blogs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `favorite_id_UNIQUE` (`id`),
  KEY `fb_user_id_idx` (`user_id`),
  KEY `fb_blog_id_idx` (`blog_id`),
  CONSTRAINT `fb_blog_id` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fb_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorite_blogs`
--

LOCK TABLES `favorite_blogs` WRITE;
/*!40000 ALTER TABLE `favorite_blogs` DISABLE KEYS */;
INSERT INTO `favorite_blogs` VALUES (26,26,41);
/*!40000 ALTER TABLE `favorite_blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `featured_blogs`
--

DROP TABLE IF EXISTS `featured_blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `featured_blogs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `featured_blog_id_idx` (`blog_id`),
  CONSTRAINT `featured_blog_id` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `featured_blogs`
--

LOCK TABLES `featured_blogs` WRITE;
/*!40000 ALTER TABLE `featured_blogs` DISABLE KEYS */;
INSERT INTO `featured_blogs` VALUES (19,26);
/*!40000 ALTER TABLE `featured_blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `blog_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `likes_users_FK` (`user_id`),
  KEY `likes_blogs_FK` (`blog_id`),
  CONSTRAINT `likes_blogs_FK` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `likes_users_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (31,42,29),(32,42,28);
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `last_name` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `email` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `age` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `profile_picture` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'https://i.imgur.com/w367Hjs.jpeg',
  `admin` tinyint NOT NULL DEFAULT '0',
  `profile_picture_delete_hash` varchar(100) COLLATE utf8mb3_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (40,'Naida','Panjeta','naidapanjeta@gmail.com','17c00213ec89867b3598b4f972da329f','24','https://i.imgur.com/CeKesqG.png',0,'RDDdSpKJwAjrc78'),(41,'Benjamin','Peljto','benjaminpeljto00@gmail.com','00b19bfe043e029582cfa844b105654a','22','https://i.imgur.com/2NpFMoi.jpeg',0,'hUAQKPeJplyZBp6'),(42,'Anes','Pleh','znaciboze99@hotmail.com','00b19bfe043e029582cfa844b105654a','44','https://i.imgur.com/dMaO7OG.jpeg',0,'SpSw7YqH8Nw4A4s'),(43,'Benjamin','Peljto','admin@email.com','b549bd8404dd2ddf379742f88e65279f','23','https://i.imgur.com/w367Hjs.jpeg',1,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'web_blog_08_07_2023'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-01 13:34:08
