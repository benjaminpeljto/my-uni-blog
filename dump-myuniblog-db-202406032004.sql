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
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (60,'Lorem Ipsum','Nunc condimentum felis eu mollis ullamcorper. Duis eu ipsum lectus. Phasellus in orci consectetur, pulvinar tortor quis, feugiat dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent placerat mi mi, sit amet pulvinar massa accumsan vel. Pellentesque placerat quam in aliquet sodales. Praesent at lacus vitae tellus laoreet dictum. Cras cursus dui et diam finibus, eu malesuada ligula luctus. Vestibulum fermentum vitae arcu sed ornare. Fusce tellus nunc, convallis nec ante eget, elementum mollis nibh. Praesent tempus in sapien vitae maximus. Etiam auctor non libero eu fermentum. Vestibulum sit amet mi vel sem placerat imperdiet id id justo. Cras euismod euismod est. In molestie lectus sed dolor aliquet, id egestas lorem bibendum.','2024-06-03 19:55:17',0,42,5,NULL),(61,'Lorem opet','Mauris fermentum nulla sed nisl tristique, lobortis dapibus lorem feugiat. Aenean a dignissim sem, sed ornare justo. Sed in mattis velit, nec maximus ante. Mauris odio elit, dignissim semper tortor at, sollicitudin sodales dolor. Pellentesque in finibus nulla, vitae vehicula lorem. Nam lobortis semper ante sed iaculis. Duis malesuada eget lectus ut pretium. Morbi vitae ligula a metus rhoncus pretium in eu arcu. Vestibulum iaculis, tortor non laoreet fermentum, mi ex vestibulum metus, a luctus eros nibh nec dui. Pellentesque suscipit, quam sed lobortis semper, ante lacus ultrices velit, quis malesuada leo turpis aliquam urna.','2024-06-03 19:55:43',0,42,7,NULL),(62,'Idemo opet','Fusce vitae risus faucibus purus varius commodo gravida nec sapien. Quisque placerat imperdiet nulla ac placerat. Morbi ut ipsum sodales justo convallis viverra sed sit amet erat. Suspendisse potenti. Duis sagittis malesuada facilisis. Curabitur dolor ipsum, feugiat nec vestibulum et, tempor sit amet eros. Nam eu pulvinar nibh. Nam hendrerit sagittis orci in dapibus. Praesent condimentum nisi non dolor ultrices porta. Nulla pulvinar turpis non diam placerat, eget placerat neque dictum. Sed venenatis velit at ligula aliquam, ut lacinia mauris dapibus. Proin ac ligula et dolor fermentum fermentum. Donec sed elementum arcu. Pellentesque eget eleifend ex, eu fermentum elit. Vivamus dapibus mi ac lectus mattis, sed elementum nibh placerat.\r\n\r\n','2024-06-03 19:57:07',0,45,6,NULL),(63,'Nesto novo','Phasellus faucibus a dolor ac lobortis. Sed posuere dolor quis odio vulputate sodales. Suspendisse commodo justo libero, ullamcorper tempus magna porta ut. Fusce bibendum eleifend est. Proin semper varius risus sit amet euismod. Etiam vehicula sodales faucibus. Pellentesque ut lorem eros. Nam ut lectus commodo, iaculis diam vitae, consequat est. Aliquam hendrerit erat eget lacus rhoncus blandit. Vestibulum orci augue, porttitor in eleifend eu, posuere eu nisi. Pellentesque neque velit, vestibulum at justo id, sollicitudin convallis velit. Maecenas luctus massa eget lorem molestie sollicitudin id eleifend eros.','2024-06-03 19:59:26',0,40,5,NULL),(64,'Nesto novo','\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...\"\r\nPhasellus faucibus a dolor ac lobortis. Sed posuere dolor quis odio vulputate sodales. Suspendisse commodo justo libero, ullamcorper tempus magna porta ut. Fusce bibendum eleifend est. Proin semper varius risus sit amet euismod. Etiam vehicula sodales faucibus. Pellentesque ut lorem eros. Nam ut lectus commodo, iaculis diam vitae, consequat est. Aliquam hendrerit erat eget lacus rhoncus blandit. Vestibulum orci augue, porttitor in eleifend eu, posuere eu nisi. Pellentesque neque velit, vestibulum at justo id, sollicitudin convallis velit. Maecenas luctus massa eget lorem molestie sollicitudin id eleifend eros.\r\n\r\n','2024-06-03 20:00:29',0,41,4,NULL),(65,'Eto zato','Odavno je uspostavljena činjenica da čitača ometa razumljivi tekst dok gleda raspored elemenata na stranici. Smisao korištenja Lorem Ipsum-a jest u tome što umjesto \'sadržaj ovjde, sadržaj ovjde\' imamo normalni raspored slova i riječi, pa čitač ima dojam da gleda tekst na razumljivom jeziku. Mnogi programi za stolno izdavaštvo i uređivanje web stranica danas koriste Lorem Ipsum kao zadani model teksta, i ako potražite \'lorem ipsum\' na Internetu, kao rezultat dobit ćete mnoge stranice u izradi. Razne verzije razvile su se tijekom svih tih godina, ponekad slučajno, ponekad namjerno (s dodatkom humora i slično).','2024-06-03 20:01:53',0,40,2,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorite_blogs`
--

LOCK TABLES `favorite_blogs` WRITE;
/*!40000 ALTER TABLE `favorite_blogs` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (74,40,64),(75,40,62),(76,40,60),(77,41,64),(78,41,65),(79,41,62),(80,45,64),(81,45,60),(82,45,63);
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
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (40,'Tarik','Panjeta','tarikpanjeta@gmail.com','00b19bfe043e029582cfa844b105654a','24','https://i.imgur.com/CeKesqG.png',0,'RDDdSpKJwAjrc78',0),(41,'Benjamin','Peljto','benjaminpeljto00@gmail.com','00b19bfe043e029582cfa844b105654a','22','https://i.imgur.com/eW5UC4N.png',0,'PQsEOzWJUBeRSEE',0),(42,'Neko','Ozbiljan','znaciboze99@hotmail.com','00b19bfe043e029582cfa844b105654a','44','https://i.imgur.com/dMaO7OG.jpeg',0,'SpSw7YqH8Nw4A4s',0),(43,'Benjamin','Peljto','admin@email.com','b549bd8404dd2ddf379742f88e65279f','23','https://i.imgur.com/w367Hjs.jpeg',1,NULL,0),(45,'Testni','Korisnik','benjaminpeljto00@hotmail.com','00b19bfe043e029582cfa844b105654a','25','https://i.imgur.com/YTRLzUL.png',0,'snZtEwOXQRxvZlk',0);
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

-- Dump completed on 2024-06-03 20:04:08
