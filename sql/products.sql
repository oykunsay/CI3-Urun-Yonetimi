-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: product_db
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

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
-- Table structure for table `product_descriptions`
--

DROP TABLE IF EXISTS `product_descriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_descriptions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned NOT NULL,
  `language_code` varchar(5) DEFAULT 'tr',
  `title` varchar(255) NOT NULL COMMENT 'Türkçe Ürün Başlık',
  `sub_title` varchar(255) DEFAULT NULL COMMENT 'Ek Bilgi Başlığı',
  `sub_description` text DEFAULT NULL COMMENT 'Ek Bilgi Açıklaması',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `seo_url` varchar(255) DEFAULT NULL COMMENT 'Seo Adresi',
  `description` longtext DEFAULT NULL COMMENT 'Ürün Açıklama (CKEditor)',
  `video_embed_code` text DEFAULT NULL COMMENT 'Video Embed Kodu',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `fk_desc_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_descriptions`
--

LOCK TABLES `product_descriptions` WRITE;
/*!40000 ALTER TABLE `product_descriptions` DISABLE KEYS */;
INSERT INTO `product_descriptions` VALUES (1,1,'tr','dasasd888','dsads','adsdas','dsa','dsaads','dsaads','dasads','<p>sdaa</p>\r\n','sdads'),(2,2,'tr','dasasd','dsads','adsdas','dsa','dsaads','dsaads','dasads','<p>sdaa</p>\r\n','sdads'),(3,3,'tr','das','dsa','dsa','dsa','dsa','dasdsa','dsasd','<p>asddsaads</p>\r\n','adsads'),(4,4,'tr','dsafdsfds','dfsdfsfds','fdsfds','sdfdfs','dfsfddfsfds','fdsfdsfd','fdsfds','<p>dfs</p>\r\n','fdssdf'),(5,5,'tr','dsafds','fsdfdssdf','dfsfds','fdsfds','dfsfdsdfs','dfsfdsdfs','dfsfdsdfs','<p>fdsdfssfdsdsf</p>\r\n','dfsfdsd'),(6,6,'tr','dsa','dsa','ads','sda','dsa','dsa','dsa','<p>das</p>\r\n','dasds'),(7,7,'tr','daasd','ghj','hgh','ghj','ghjg','jgh','ghj','<p>jhggjh</p>\r\n','ghj'),(8,8,'tr','dsadas','ggfhg','gfh','gfh','fhgfg','ghf','gfh','<p>fhg</p>\r\n','fhghfg');
/*!40000 ALTER TABLE `product_descriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_discounts`
--

DROP TABLE IF EXISTS `product_discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_discounts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned DEFAULT NULL,
  `customer_group` varchar(50) DEFAULT 'Musteri',
  `priority` int(11) DEFAULT 0,
  `discount_value` decimal(15,4) NOT NULL DEFAULT 10.0000 COMMENT 'İndirimli Fiyat veya Oran',
  `type` enum('price','percentage') NOT NULL DEFAULT 'price',
  `currency` enum('TL','USD','EUR') DEFAULT 'TL',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_idx` (`product_id`),
  CONSTRAINT `fk_product_id_discounts` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_discounts`
--

LOCK TABLES `product_discounts` WRITE;
/*!40000 ALTER TABLE `product_discounts` DISABLE KEYS */;
INSERT INTO `product_discounts` VALUES (18,1,'Müşteri',1,19696.0000,'price','TL',NULL,NULL),(19,1,'Müşteri',1,120.0000,'price','TL',NULL,NULL),(20,1,'Müşteri',1,2322.0000,'price','TL',NULL,NULL);
/*!40000 ALTER TABLE `product_discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `fk_image_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_prices`
--

DROP TABLE IF EXISTS `product_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_prices` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned NOT NULL,
  `currency` enum('TL','USD','EUR') NOT NULL,
  `price` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `price_type` tinyint(1) DEFAULT 1 COMMENT '1: Satış Fiyatı, 2: İkinci Satış Fiyatı',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `fk_price_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=224 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_prices`
--

LOCK TABLES `product_prices` WRITE;
/*!40000 ALTER TABLE `product_prices` DISABLE KEYS */;
INSERT INTO `product_prices` VALUES (9,3,'TL',1.0000,1),(10,3,'USD',1.0000,1),(11,3,'EUR',1.0000,1),(12,3,'TL',1.0000,2),(13,4,'TL',1.0000,1),(14,4,'USD',1.0000,1),(15,4,'EUR',1.0000,1),(16,4,'TL',1.0000,2),(17,5,'TL',1.0000,1),(18,5,'USD',1.0000,1),(19,5,'EUR',1.0000,1),(20,5,'TL',1.0000,2),(21,6,'TL',1.0000,1),(22,6,'USD',1.0000,1),(23,6,'EUR',1.0000,1),(24,6,'TL',1.0000,2),(25,7,'TL',1.0000,1),(26,7,'USD',1.0000,1),(27,7,'EUR',1.0000,1),(28,7,'TL',1.0000,2),(208,8,'TL',12.0000,1),(209,8,'USD',12.0000,1),(210,8,'EUR',22.0000,1),(214,2,'TL',1.0000,1),(215,2,'USD',1.0000,1),(216,2,'EUR',1.0000,1),(217,2,'TL',1.0000,2),(221,1,'TL',1.0000,1),(222,1,'USD',1.0000,1),(223,1,'EUR',1.0000,1);
/*!40000 ALTER TABLE `product_prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_code` varchar(100) NOT NULL COMMENT 'Ürün Kodu',
  `stock_amount` int(11) DEFAULT 0 COMMENT 'Miktar',
  `subtract_stock` tinyint(1) DEFAULT 1 COMMENT 'Stoktan Düş (1: Evet, 0: Hayır)',
  `tax_rate` decimal(5,2) DEFAULT 18.00 COMMENT 'Vergi Oranı %',
  `extra_discount_percent` int(3) DEFAULT 0 COMMENT 'Sepet Ekstra İndirim %',
  `status` tinyint(1) DEFAULT 1 COMMENT 'Durum (1: Açık, 0: Pasif)',
  `show_features` tinyint(1) DEFAULT 1 COMMENT 'Özellik Bölümü (1: Göster, 0: Gizle)',
  `validity_date` date DEFAULT NULL COMMENT 'Yeni Ürün Geçerlilik Süresi',
  `sort_order` int(11) DEFAULT 0 COMMENT 'Sıralama',
  `show_on_homepage` tinyint(1) DEFAULT 0 COMMENT 'Anasayfada Göster',
  `is_new` tinyint(1) DEFAULT 0 COMMENT 'Yeni Ürün (Evet/Hayır)',
  `allow_installments` tinyint(1) DEFAULT 1 COMMENT 'Taksit (Evet/Hayır)',
  `warranty_period` varchar(50) DEFAULT NULL COMMENT 'Garanti Süresi',
  `main_image` varchar(255) DEFAULT NULL COMMENT 'Ürün Ana Resmi',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'d0da48ee-624c-70f1-9ded-b4679a85f1df',1,1,18.00,10,1,1,'2026-08-12',1,0,1,1,'1','Screenshot_2026-02-03_at_00_36_03.png','2026-02-01 11:39:26','2026-02-03 13:03:26'),(2,'d0da48ee-624c-70f1-9ded-b4679a85f1df',1,1,18.00,10,1,1,'2026-08-12',1,1,1,0,'1','ed54d89432f125b28c533725627d230a.png','2026-02-01 11:40:36','2026-02-01 11:40:36'),(3,'d0da48ee-624c-70f1-9ded-b4679a85f1df',1,1,18.00,10,1,1,'2026-08-12',1,1,1,0,'1','450bb6249df469db0ecfc289b2dd1a83.png','2026-02-01 11:52:21','2026-02-01 11:52:21'),(4,'d0da48ee-624c-70f1-9ded-b4679a85f1df',1,1,18.00,10,1,1,'2026-08-12',1,1,1,1,'1','c686142819831d05d72d6e90a491742b.png','2026-02-01 11:57:47','2026-02-01 11:57:47'),(5,'d0da48ee-624c-70f1-9ded-b4679a85f1dk',1,1,18.00,10,1,1,'2026-08-12',1,1,1,1,'1','8609fd037b82717e7f2d5d388c415aac.png','2026-02-01 12:05:35','2026-02-01 12:05:35'),(6,'d0da48ee-624c-70f1-9ded-b4679a85f1dg',1,1,18.00,10,1,1,'2026-08-12',1,1,1,1,'1','646b4ce77ba7b175696830daeef02b4f.png','2026-02-01 13:07:22','2026-02-01 13:07:22'),(7,'d0da48ee-624c-70f1-9ded-b4679a85f1df',1,1,18.00,10,1,1,'2026-08-12',1,1,1,0,'1','fec4746f6942b10c61ad69ce464c8b9c.png','2026-02-01 14:31:09','2026-02-01 14:31:09'),(8,'dfdsdfs',3,1,18.00,10,0,1,'2026-08-12',0,0,1,1,'3','Screenshot_2026-02-02_at_14_20_40.png','2026-02-02 11:34:58','2026-02-03 13:03:04');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-03 17:58:21
