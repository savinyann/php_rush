-- MySQL dump 10.13  Distrib 5.5.58, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: pool_php_rush
-- ------------------------------------------------------
-- Server version	5.5.58-0+deb8u1

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (0,NULL,NULL),(1,'Weapon',0),(2,'Armor',0),(3,'Consumable',0),(4,'Mercenary',0),(5,'Dagger',1),(6,'One-Handed Axe',1),(7,'One-Handed Mace',1),(8,'One-Handed Sword',1),(9,'Two-Handed Axe',1),(10,'Two-Handed Mace',1),(11,'Two-Handed Sword',1),(12,'Bow',1),(13,'Gun',1),(14,'Shield',1),(15,'Wand',1),(16,'Book',1),(17,'Helmet',2),(18,'Shoulder',2),(19,'Breast Plate',2),(20,'Gloves',2),(21,'Armguards',2),(22,'Pants',2),(23,'Boots',2),(24,'Warrior',4),(25,'Mage',4),(26,'Priest',4),(27,'Archer',4),(28,'Thief',4),(29,'Bobo',NULL),(30,'Bobo2',28);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `picture` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT 'description',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Excalibur',3000,8,'pict/excalibur.jpeg','description'),(2,'Mjolnir',3000,7,'pict/mjolnir.jpg','description'),(12,'Luna Bow',3000,12,'pict/luna_bow.jpg','description'),(13,'Destruction Staff',3000,15,'pict/wand.jpg','description'),(14,'Zuan and Wuan',2500,24,'pict/warrior.jpg','description'),(15,'Bibi and Lulu',2500,25,'pict/wizard.jpg','description'),(16,'Sinbad and Rikku',2500,28,'pict/thief.jpg','description'),(17,'Zephy and Fanny',2500,27,'pict/archer.jpg','description'),(18,'Emile and Yuna',2500,27,'pict/priest.jpg','description'),(19,'Longsword',1000,11,'pict/longsword.jpeg','description'),(20,'Wooden sword',50,8,'pict/wooden_sword.jpg','description'),(21,'Kirito Sword',5000,8,'pict/kirito_sword.jpg','description'),(22,'Asuna Sword',5000,8,'pict/asuna_sword','description'),(23,'Composite Bow',5000,12,'pict/composite_bow.jpg','description'),(24,'Great Axe',5000,6,'pict/great_axe.jpg','description'),(25,'Hallebard',5000,10,'pict/hallebard.jpg','description'),(26,'Imgur',5000,6,'pict/imgur.jpg','description'),(27,'Orcish Mace',500,7,'pict/orcish_mace.jpg','description'),(28,'Reammer',3500,10,'pict/reammer.jpg','description'),(29,'Polarys',2500,9,'pict/polarys.jpg','description'),(30,'Aeterna',4500,9,'pict/aeterna.jpg','description'),(31,'Muramasa',2500,9,'pict/muramasa.jpg','description'),(32,'Master Sword',3000,9,'pict/master_sword.jpg','description'),(33,'Sulfura',3000,10,'pict/sulfura.jpg','description'),(34,'Dual Guns',3000,13,'pict/dual_gun.jpg','description'),(35,'Assault Rifle',3500,13,'pict/assault_rifle.jpg','description'),(36,'Hyrule Shield',1500,14,'pict/hyurule_shield.jpg','description'),(37,'My Little Shield',500,14,'pict/mlp_shield.jpg','description'),(38,'Magical Scepter',2750,15,'pict/magical_scepter.png','description'),(39,'Boba Fett Helmet',1500,17,'pict/boba_fett_helmet.jpg','description'),(40,'Halo Helmet',3500,17,'pict/halo_helmet.jpg','description'),(41,'Leather Shoulder',750,18,'pict/leather_shoulder.jpg','description'),(42,'Steel Shoulder',1750,18,'pict/steel_shoulder.jpg','description'),(43,'Roman Armor',1750,19,'pict/roman_armor.jpg','description'),(44,'Pack Armor',50,19,'pict/pack_armor.jpg','description'),(45,'Megalodon',50,19,'pict/megalodon.jpg','description'),(46,'Purple Claw',50,19,'pict/purple_claw.jpg','description'),(47,'Plate Gauntlet',50,19,'pict/plate_gauntlet.jpg','description'),(48,'Leather Armguard',500,19,'pict/leather_arm_guard.jpg','description'),(49,'Yuna and Tidus',5500,4,'pict/yuna_tidus.jpg','description'),(50,'MK440',5050,1,NULL,'description');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `admin` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Yann03','$2y$10$Fwxmjf71ZWvj/24kfAA/TuXyBdiN81cXEGMwP7IgU5suLiIOJvRWa','mdp@1234.fr',1),(2,'Erick','$2y$10$FTQ8emShjIGo8KQk6/B0PuHIHQw1UfZ0w83JUGgMaQojPusjJKaY6','savinerick@hotmail.com',0),(3,'bobo','$2y$10$Ke5CxHvM6hCcTRx0fWScUOXt23gjQWOlckKSViWratwKTS/xOcUTW','bobo@bobo.bobo',0);
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

-- Dump completed on 2017-12-16 18:07:57
