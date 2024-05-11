-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: peljto
-- ------------------------------------------------------
-- Server version	8.0.31

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (2,'Workout helps the mind','Regular exercise not only benefits the body but also has a positive impact on the mind. Studies show that working out helps reduce stress, improve memory and cognitive function, and increase overall happiness. Exercise releases endorphins that improve mood, and it also promotes the growth of new brain cells, leading to better mental health. So, whether it\'s a quick jog or a full gym session, working out is an excellent way to keep both your body and mind in shape.','2023-05-09 14:30:45',0,1,3,NULL),(3,'Car guy','Cars have become an integral part of modern life. They are a symbol of freedom and provide convenience in transportation. Cars come in different shapes, sizes, and types, and each has its own unique features and benefits. From sports cars that offer speed and agility to family SUVs that provide space and comfort, there\'s a car for everyone. Cars have also evolved over time, with advanced technology and safety features that make driving safer and more enjoyable. While cars have their advantages, they also have their downsides, such as environmental impact and traffic congestion. Despite this, cars remain an essential part of our daily lives and will continue to shape the way we live and work.','2023-02-19 18:30:45',0,18,4,NULL),(10,'Ćevapćići till the end','Ćevapćići, a traditional dish from the Balkans, is a type of grilled sausage made from  ground meat, typically beef or lamb. These finger-sized sausages are a popular street food and can be found in many restaurants and homes throughout the region.\r\n\r\nThe preparation of ćevapćići varies from region to region, but generally involves mixing ground meat with spices such as paprika, salt, and pepper. The mixture is then formed into small sausage shapes and grilled over an open flame until cooked through and slightly charred.\r\n\r\nĆevapćići are typically served with a variety of accompaniments, including flatbread, raw onions, ajvar (a roasted red pepper spread), and kajmak (a type of clotted cream). They are often eaten as a main course or as part of a larger meal.\r\n\r\nOne of the reasons for the popularity of Ćevapćići is their simplicity and versatility. They can be enjoyed as a quick snack or as part of a larger meal, and can be easily customized to suit individual tastes. Whether served with bread and condiments or as part of a more elaborate dish, Ćevapćići are a delicious and satisfying food that has been enjoyed for generations.','2023-01-11 09:30:55',0,12,8,NULL),(11,'I love Beatles so much','The Beatles are one of the most iconic and influential bands in the history of music. Formed in Liverpool, England in 1960, the band consisted of John Lennon, Paul McCartney, George Harrison, and Ringo Starr. Their unique sound and innovative approach to songwriting revolutionized popular music and had a lasting impact on generations to come. From their early hits like Love Me Do and Please Please Me to later masterpieces like Sgt. Pepper\'s Lonely Hearts Club Band and Abbey Road, the Beatles remain one of the most beloved and enduring bands of all time.','2023-05-01 12:59:59',0,32,5,NULL),(12,'The Rhythmic Journey of a Talented Drummer','In a world filled with music, some individuals have an innate ability to create captivating rhythms and mesmerizing beats. Benjamin, a talented 23-year-old drummer, is one such individual. With his unwavering passion for music and his undeniable skill behind the drum kit, Benjamin has embarked on a rhythmic journey that is both awe-inspiring and soul-stirring. Let\'s delve into the world of this extraordinary musician and explore the beats that drive his life.','2023-06-19 12:59:59',59,33,2,NULL),(13,'An Unforgettable Musical Journey','Embarking on a mesmerizing musical journey, renowned guitar virtuoso joins forces with the exceptionally talented and soulful vocalist, Džejla Ramović. This electrifying collaboration promises to captivate audiences worldwide as they embark on a thrilling tour that fuses the magic of Džejla\'s voice with the unparalleled artistry of the guitar maestro. At the forefront of this collaboration is the captivating vocalist, Džejla Ramović, whose melodious voice and commanding stage presence have gained her recognition as one of the industry\'s rising stars. With her versatile range and emotive delivery, Džejla effortlessly infuses each performance with passion and raw emotion, leaving audiences spellbound. Her magnetic stage presence creates a perfect synergy with the guitar maestro, whose intricate melodies and soulful solos add depth and richness to each musical arrangement. As the tour unfolds, audiences can expect an extraordinary blend of musical genres, ranging from soulful ballads to high-energy rock anthems. Džejla\'s powerful vocals, combined with the guitar maestro\'s virtuosic playing, will transport listeners through a captivating sonic journey. Each performance promises to be a celebration of musical excellence, showcasing the unique chemistry and dynamic interplay between the guitar and Džejla\'s voice. Beyond their individual talents, this collaboration also emphasizes the importance of gender equality and the empowerment of women in the music industry. Džejla Ramović\'s meteoric rise and artistic brilliance serve as an inspiration to aspiring female musicians, highlighting their ability to command stages and challenge conventional norms. The guitar maestro\'s support and partnership further amplify this message, breaking barriers and fostering a more inclusive music scene. With the guitar maestro and Džejla Ramović uniting their talents on this exhilarating tour, music enthusiasts are in for an unforgettable experience. Together, they exemplify the transformative power of collaboration, while showcasing the remarkable artistry and dedication that defines their craft. Prepare to be enthralled as these two musical forces take center stage, weaving a tapestry of unforgettable melodies that will resonate long after the tour\'s final chord.','2022-08-22 19:10:33',3,10,2,NULL),(19,'Porsche 911 GT3 RS ','Simply put, the 2023 Porsche 911 GT3 and the all-out track-attack GT3 RS are utterly transcendent, blending everything we love about the standard 911 with otherworldly performance, uncompromised driving enjoyment, and hot-lap capability. A naturally aspirated 4.0-liter flat-six engine makes demonic sounds as it howls up to its 9000 rpm redline, producing 502 horsepower along the way in the GT3 and GT3 Touring. That same engine is twisted to 518 horsepower in the new GT3 RS, but it\'s that model\'s wild race-car aerodynamic elements—ideas cribbed from GT and Formula 1 race cars—that comprise its major engineering advancements. A six-speed manual is standard in GT3 models but we\'ve proven the optional seven-speed PDK automatic is quicker, as it shifts quicker than a human and seems to be linked to the driver\'s cerebral cortex. The GT3 RS comes only with the PDK gearbox. While the GT3 and GT3 Touring models are designed to thrill on the world\'s most challenging race courses, they\'re nearly as supple-riding and easy to live with as the regular 911 when driven on city streets. It\'s this dual-purpose nature that makes the GT3 one of our favorite sports cars and why it easily earns a place on the highest pedestal of automotive icons. As for the GT3 RS, it\'s as serious about lap times as a 911 can get and still be licensed. We can\'t wait to drive it to see if it\'s too radical a car for anything but track duty','2023-07-08 12:26:49',0,27,4,NULL),(26,'My title','This asklda  dffsd fds s f fd sd fsd f sdf sd fsd f sf sd ff sdfsd f s df sf dsf s fsd. sdf sd  dsf  fd sd f sdf sdf sd f sdf  df fsf s df ds fsd f sf sd  gaergffs  gsiugfiuaui ddf zui dsui  eiuies fuz ffezfuuzd uf uzsz f z ezu fzudfszuzuf dfz fiuz idf df zfdz ufdzufdzfafd . fadi zdfziuuf diudfiuzuz   iuoaziudfaui iuaz iufz adisufz ads da mmnds mnds mnsd mnds mnsd msdf mnsdf mndsa nmasd. nsda n fn sesdf  dsfads afmsd fmsda nbsd nsd ns fms fsd bs.','2024-03-28 18:02:54',0,38,2,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorite_blogs`
--

LOCK TABLES `favorite_blogs` WRITE;
/*!40000 ALTER TABLE `favorite_blogs` DISABLE KEYS */;
INSERT INTO `favorite_blogs` VALUES (14,11,27),(15,12,27),(17,10,27),(27,19,38),(28,26,38);
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `featured_blogs`
--

LOCK TABLES `featured_blogs` WRITE;
/*!40000 ALTER TABLE `featured_blogs` DISABLE KEYS */;
INSERT INTO `featured_blogs` VALUES (18,10);
/*!40000 ALTER TABLE `featured_blogs` ENABLE KEYS */;
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
  `profile_picture` longblob,
  `admin` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Benjamin','Peljto','testemail1@example.com','testpassword1','22',NULL,0),(10,'Ervin','Pehlic','testemail9@example.com','testpassword9','22',NULL,0),(12,'Ermin','Pehlic','testemail10@example.com','testpassword10','22',NULL,0),(18,'Tarik','Panjeta','testemail14@example.com','testpassword14','23',NULL,0),(27,'Tarik','Panjeta','tariik2000@gmail.com','3665a76e271ada5a75368b99f774e404','23',NULL,0),(32,'Neko','Nekic','neko@gmail.com','25d55ad283aa400af464c76d713c07ad','44',NULL,0),(33,'Neki','Neko','nekoaa@gmail.com','25d55ad283aa400af464c76d713c07ad','55',NULL,0),(38,'Emir','Kugic','emir.kugic64@hotmail.com','2978c5887bedfab5dc89594d4ac7cbd4','25',NULL,0),(39,'lhj','jkh','emir.kugic64@hotmail.comkj','2978c5887bedfab5dc89594d4ac7cbd4','55',NULL,0);
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

-- Dump completed on 2024-05-11 17:41:46
