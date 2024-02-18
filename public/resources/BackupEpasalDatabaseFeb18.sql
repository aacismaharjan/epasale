CREATE DATABASE  IF NOT EXISTS `test_epasal_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `test_epasal_db`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: test_epasal_db
-- ------------------------------------------------------
-- Server version	8.0.35

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
-- Temporary view structure for view `see_orders_detail`
--

DROP TABLE IF EXISTS `see_orders_detail`;
/*!50001 DROP VIEW IF EXISTS `see_orders_detail`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `see_orders_detail` AS SELECT 
 1 AS `created_at`,
 1 AS `order_detail_id`,
 1 AS `order_id`,
 1 AS `seller_id`,
 1 AS `seller_name`,
 1 AS `customer_id`,
 1 AS `customer_name`,
 1 AS `product_id`,
 1 AS `category_name`,
 1 AS `quantity`,
 1 AS `unit_price`,
 1 AS `total_amount`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `tbl_categories`
--

DROP TABLE IF EXISTS `tbl_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(20) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categories`
--

LOCK TABLES `tbl_categories` WRITE;
/*!40000 ALTER TABLE `tbl_categories` DISABLE KEYS */;
INSERT INTO `tbl_categories` VALUES (2,'Beef'),(1,'Chicken'),(6,'Juice'),(5,'Snacks'),(7,'Soft Drinks'),(4,'Sweets & Deserts'),(3,'Veg');
/*!40000 ALTER TABLE `tbl_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_order_details`
--

DROP TABLE IF EXISTS `tbl_order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_order_details` (
  `order_detail_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`order_detail_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `tbl_order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_orders` (`order_id`),
  CONSTRAINT `tbl_order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_order_details`
--

LOCK TABLES `tbl_order_details` WRITE;
/*!40000 ALTER TABLE `tbl_order_details` DISABLE KEYS */;
INSERT INTO `tbl_order_details` VALUES (9,47,1,1,NULL),(10,47,2,3,NULL),(11,47,7,1,NULL),(12,48,1,1,NULL),(13,48,2,3,NULL),(14,48,7,1,NULL),(15,49,1,1,NULL),(16,49,2,3,NULL),(17,49,7,1,NULL),(18,50,2,1,NULL),(19,50,3,1,NULL),(20,51,19,1,NULL),(21,51,20,1,NULL),(22,52,19,1,NULL),(23,52,20,1,NULL),(24,53,17,1,NULL),(25,53,18,1,NULL),(26,53,20,1,NULL),(27,54,3,2,NULL),(28,54,4,2,NULL),(29,54,17,1,NULL),(30,55,18,5,NULL),(31,55,19,6,NULL),(32,56,18,1,NULL),(33,56,19,1,NULL),(34,56,39,2,NULL),(35,57,18,1,NULL),(36,57,19,1,NULL),(37,58,41,1,NULL),(38,58,42,5,NULL),(39,59,9,1,NULL),(40,59,19,1,NULL),(41,59,20,1,NULL),(42,60,40,1,NULL),(43,61,18,1,NULL),(44,62,16,4,NULL),(45,63,50,1,NULL),(46,64,4,1,NULL),(47,64,5,1,NULL),(48,65,19,1,NULL),(49,65,20,1,NULL),(50,66,41,1,NULL),(51,66,42,2,NULL),(52,66,46,1,NULL),(53,67,13,2,NULL),(54,67,37,1,NULL),(55,67,38,1,NULL),(56,67,39,1,NULL),(57,67,41,1,NULL),(58,67,43,1,NULL),(59,67,46,1,NULL),(60,68,49,1,NULL),(61,69,40,1,NULL),(62,69,42,1,NULL),(63,70,44,1,NULL),(64,70,45,1,NULL);
/*!40000 ALTER TABLE `tbl_order_details` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `update_total_amount` AFTER INSERT ON `tbl_order_details` FOR EACH ROW BEGIN
    DECLARE orderTotal DECIMAL(10, 2);

    -- Calculate the total amount for the order
    SELECT SUM(unit_price * quantity) INTO orderTotal
    FROM tbl_order_details od
    INNER JOIN tbl_products p on p.product_id = od.product_id
    WHERE order_id = NEW.order_id;

    -- Update the total_amount in tbl_orders
    UPDATE tbl_orders
    SET total_amount = orderTotal
    WHERE order_id = NEW.order_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tbl_orders`
--

DROP TABLE IF EXISTS `tbl_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `order_status` enum('Pending','Processing','Packaging','Out for Delivery','Completed','Cancelled') DEFAULT 'Pending',
  `payment_method` enum('Khalti','COD') DEFAULT 'COD',
  `payment_status` enum('Paid','Unpaid') DEFAULT 'Unpaid',
  `total_amount` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `city` varchar(25) DEFAULT 'Kathmandu',
  `address` varchar(50) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `landmark` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tbl_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_orders`
--

LOCK TABLES `tbl_orders` WRITE;
/*!40000 ALTER TABLE `tbl_orders` DISABLE KEYS */;
INSERT INTO `tbl_orders` VALUES (47,1,'Cancelled','COD','Paid',58.00,'2024-01-21 13:27:38','Kathmandu',NULL,NULL,NULL,NULL),(48,1,'Completed','COD','Paid',58.00,'2024-01-21 13:29:35','Kathmandu',NULL,NULL,NULL,NULL),(49,1,'Completed','COD','Paid',58.00,'2024-01-21 13:31:45','Kathmandu',NULL,NULL,NULL,NULL),(50,1,'Completed','COD','Paid',30.00,'2024-01-21 13:32:29','Kathmandu',NULL,NULL,NULL,NULL),(51,1,'Completed','COD','Paid',11.99,'2024-01-26 09:07:01','Kathmandu',NULL,NULL,NULL,NULL),(52,26,'Completed','COD','Paid',11.99,'2024-02-02 13:39:04','Kathmandu',NULL,NULL,NULL,NULL),(53,NULL,'Pending','COD','Unpaid',28.00,'2024-02-06 03:05:00','Kathmandu',NULL,NULL,NULL,NULL),(54,8,'Completed','COD','Paid',77.00,'2024-02-09 22:05:42','Kathmandu',NULL,NULL,NULL,NULL),(55,1,'Completed','COD','Paid',102.94,'2024-02-14 18:12:33','Kathmandu',NULL,NULL,NULL,NULL),(56,1,'Completed','COD','Paid',458.99,'2024-02-15 06:32:20','Kathmandu',NULL,NULL,NULL,NULL),(57,1,'Completed','COD','Paid',18.99,'2024-02-16 08:15:48','Kathmandu',NULL,NULL,NULL,NULL),(58,1,'Completed','COD','Paid',1250.00,'2024-02-16 22:26:05','Kathmandu',NULL,NULL,NULL,NULL),(59,31,'Completed','COD','Paid',27.99,'2024-02-16 23:30:27','Kathmandu',NULL,NULL,NULL,NULL),(60,31,'Completed','COD','Paid',100.00,'2024-02-16 23:31:37','Kathmandu',NULL,NULL,NULL,NULL),(61,31,'Completed','COD','Paid',11.00,'2024-02-16 23:32:01','Kathmandu',NULL,NULL,NULL,NULL),(62,31,'Completed','COD','Paid',76.00,'2024-02-17 10:50:45','Kathmandu',NULL,NULL,NULL,NULL),(63,1,'Completed','COD','Paid',120.00,'2024-02-17 11:41:33','Kathmandu',NULL,NULL,NULL,NULL),(64,1,'Completed','COD','Paid',22.00,'2024-02-17 20:22:50','Kathmandu',NULL,NULL,NULL,NULL),(65,1,'Completed','COD','Paid',11.99,'2024-02-17 21:54:07','Kathmandu','Kalanki','2min walk from it','9810154589','Nagarjun, Kavre Daily Khupatole'),(66,32,'Completed','COD','Paid',970.00,'2024-02-17 22:04:23','Kathmandu','Baneshwor','Leave it at library block','9813535725','Shanti Marg, Apex Building'),(67,1,'Completed','COD','Paid',1207.98,'2024-02-17 22:30:32','Kathmandu','Kalanki','','9810154589','Kalanki Temple'),(68,1,'Completed','COD','Paid',100.00,'2024-02-18 11:21:52','Kathmandu','Baneshwor','Library Block','9810154589','Shanti Marg, Apex Building'),(69,32,'Completed','COD','Paid',300.00,'2024-02-18 12:01:08','Kathmandu','Baneshwor','Khola ko side ma aayesi call me','9810154589','Khupatole, Siddhartha College'),(70,32,'Completed','COD','Paid',400.00,'2024-02-18 13:05:08','Kathmandu','Baneshwor','Nice one','9810154589','Khupatole, Siddhartha College');
/*!40000 ALTER TABLE `tbl_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_products`
--

DROP TABLE IF EXISTS `tbl_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `product_photo_url` varchar(255) NOT NULL,
  `product_description` varchar(512) NOT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) DEFAULT '1',
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `tbl_products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`),
  CONSTRAINT `tbl_products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `tbl_categories` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_products`
--

LOCK TABLES `tbl_products` WRITE;
/*!40000 ALTER TABLE `tbl_products` DISABLE KEYS */;
INSERT INTO `tbl_products` VALUES (1,'Banana Smoothie','public/img/products/PROD_BananaSmoothie1708096359.webp','Delicious and spicy chicken curry made with authentic spices.',15.00,1,'2023-12-29 21:50:49',1,1),(2,'Grilled Chicken Wings','public/img/products/product.jpg','Tender and flavorful grilled chicken wings, perfect for appetizers.',12.00,2,'2023-12-29 21:50:49',1,1),(3,'Beef Stir-Fry','public/img/products/product.jpg','Savory beef stir-fry with a mix of fresh vegetables and special sauce.',18.00,2,'2023-12-29 21:50:49',1,2),(4,'Vegetarian Pizza','public/img/products/product.jpg','A classic vegetarian pizza with a variety of colorful veggies and cheese.',14.00,2,'2023-12-29 21:50:49',1,3),(5,'Chocolate Brownie','public/img/products/product.jpg','Rich and gooey chocolate brownie, a delightful treat for chocolate lovers.',8.00,2,'2023-12-29 21:50:49',1,7),(6,'Crispy Potato Chips','public/img/products/product.jpg','Thin and crispy potato chips, perfect for snacking anytime.',4.00,2,'2023-12-29 21:50:49',1,3),(7,'Fresh Fruit Juice','public/img/products/product.jpg','Refreshing mixed fruit juice with a blend of tropical flavors.',7.00,5,'2023-12-29 21:50:49',1,6),(8,'Chilled Coke','public/img/products/product.jpg','Classic chilled Coca-Cola, the perfect companion for any meal.',1.00,5,'2023-12-29 21:50:49',1,7),(9,'Butter Chicken','public/img/products/product.jpg','Creamy and buttery chicken curry, a popular North Indian dish.',16.00,5,'2023-12-29 21:50:49',1,1),(10,'Beef Burger','public/img/products/product.jpg','Juicy beef burger with lettuce, tomato, and a special sauce.',10.00,5,'2023-12-29 21:50:49',1,2),(11,'Vegetable Spring Rolls','public/img/products/product.jpg','Crispy and delicious vegetable spring rolls, a great appetizer.',6.00,5,'2023-12-29 21:50:49',1,3),(12,'Rasgulla','public/img/products/product.jpg','Soft and spongy Rasgulla, a popular Indian sweet dessert.',9.00,5,'2023-12-29 21:50:49',1,4),(13,'Cheese Nachos','public/img/products/product.jpg','Cheesy and flavorful nachos topped with salsa and guacamole.',8.99,11,'2023-12-29 21:50:49',1,3),(14,'Mango Lassi','public/img/products/product.jpg','Cool and refreshing mango lassi, a traditional Indian yogurt drink.',5.99,11,'2023-12-29 21:50:49',1,6),(15,'Pepsi','public/img/products/product.jpg','Carbonated Pepsi, a fizzy and refreshing beverage for any occasion.',2.49,11,'2023-12-29 21:50:49',1,7),(16,'Chicken Biryani','public/img/products/product.jpg','Fragrant and flavorful chicken biryani, a popular rice dish.',19.00,11,'2023-12-29 21:50:49',1,1),(17,'Beef Kebabs','public/img/products/product.jpg','Tender and spiced beef kebabs, perfect for barbecue lovers.',13.00,7,'2023-12-29 21:50:49',1,2),(18,'Vegetable Noodles','public/img/products/product.jpg','Stir-fried vegetable noodles with a blend of savory sauces.',11.00,7,'2023-12-29 21:50:49',1,3),(19,'Gulab Jamun','public/img/products/product.jpg','Soft and sweet Gulab Jamun, a classic Indian dessert.',7.99,7,'2023-12-29 21:50:49',1,4),(20,'Potato Wedges','public/img/products/product.jpg','Crispy and seasoned potato wedges, a tasty side dish.',4.00,7,'2023-12-29 21:50:49',1,5),(37,'C Momo','public/img/products/C Momo.jpeg','Good aalu chop',100.00,7,'2024-01-16 14:07:20',1,3),(38,'Aalu Chop','public/img/products/Aloo-chop-WS-1-500x375.jpg','Good aalu chop',100.00,7,'2024-01-16 14:08:10',1,5),(39,'Cheeze Pizzza','public/img/products/cheese pizza.jpg','Very tasty',220.00,7,'2024-01-16 14:12:17',1,3),(40,'Aalo Chop (Piece of 4)','public/img/products/Aloo-chop-WS-1-500x375.jpg','Tasty and hot aalo chop',100.00,1,'2024-02-09 21:07:14',1,3),(41,'Chicken Chowmein','public/img/products/Chicken Chowmein.jpg','Chicken Chowmein, Noodles, ',250.00,1,'2024-02-15 09:25:01',1,1),(42,'French Fries','public/img/products/PROD_FrenchFries1708096666.jpg','French Fries, Aalo Chips, Crisps',200.00,1,'2024-02-16 21:02:46',1,3),(43,'French Fries','public/img/products/PROD_FrenchFries1708097145.jpg','French Fries, Aalo Chips, Crisps',200.00,1,'2024-02-16 21:10:45',1,3),(44,'Fried Rice','public/img/products/PROD_FriedRice1708099439.jpg','Fried Rice, bhuteko bhat',250.00,20,'2024-02-16 21:48:59',1,5),(45,'Aalo Chop','public/img/products/PROD_AaloChop1708099475.jpg','Good aalo chop',150.00,20,'2024-02-16 21:49:35',1,5),(46,'Cheese Pizza','public/img/products/PROD_CheesePizza1708099516.jpg','Veg Pizza',320.00,20,'2024-02-16 21:50:16',1,5),(47,'C Momo','public/img/products/PROD_CMomo1708099547.jpeg','C Momo',200.00,20,'2024-02-16 21:50:47',1,2),(48,'C Momo','public/img/products/PROD_CMomo1708099575.jpeg','C Momo',200.00,20,'2024-02-16 21:51:15',1,2),(49,'2Piece Rasgulla','public/img/products/PROD_2PieceRasgulla1708149207.webp','Rasgulla',100.00,32,'2024-02-17 11:38:27',1,4),(50,'1 Cup Coffee','public/img/products/PROD_1CupCoffee1708149234.jpg','Coffee',120.00,32,'2024-02-17 11:38:54',1,7);
/*!40000 ALTER TABLE `tbl_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_roles`
--

DROP TABLE IF EXISTS `tbl_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_roles` (
  `role_id` int NOT NULL,
  `role_name` varchar(25) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_roles`
--

LOCK TABLES `tbl_roles` WRITE;
/*!40000 ALTER TABLE `tbl_roles` DISABLE KEYS */;
INSERT INTO `tbl_roles` VALUES (1,'Admin'),(2,'Seller'),(3,'User'),(4,'Delivery Person'),(5,'Guest');
/*!40000 ALTER TABLE `tbl_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_shops`
--

DROP TABLE IF EXISTS `tbl_shops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_shops` (
  `shop_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `shop_name` varchar(50) NOT NULL,
  `shop_photo_url` varchar(255) NOT NULL,
  `shop_city` varchar(25) NOT NULL,
  `shop_address` varchar(50) NOT NULL,
  `shop_lon` decimal(17,14) DEFAULT NULL,
  `shop_lat` decimal(17,14) DEFAULT NULL,
  `shop_contact_no` varchar(20) NOT NULL,
  `is_active` int DEFAULT '1',
  `is_verified` int DEFAULT '0',
  PRIMARY KEY (`shop_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tbl_shops_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_shops`
--

LOCK TABLES `tbl_shops` WRITE;
/*!40000 ALTER TABLE `tbl_shops` DISABLE KEYS */;
INSERT INTO `tbl_shops` VALUES (1,1,'Divine Shop','public/img/shops/SHOP_DivineShop1708241999.jpg','Kathmandu','Nagarjun 4, Kalimati',85.29099150000000,27.69546510000000,'9810154589',1,1),(2,20,'RS Laphing Centre','public/img/shops/SHOP_RSLaphingCentre1708099393.jpg','Kathmandu','Bafal',85.28843304000000,27.69533161000000,'9810154589',1,1),(3,7,'Burger House and Crunchy Fried Chicken','public/img/shops/SHOP_BurgerHouseandCrunchyFriedChicken1708100045.jpg','Kathmandu','Bafal',85.28843304000000,27.69533161000000,'9810154589',1,1),(4,5,'Himalayan Java','public/img/shops/SHOP_HimalayanJava1708100163.jpg','Kathmandu','Bafal',85.28843304000000,27.69533161000000,'9810154589',0,1),(5,2,'Everest Hotel','public/img/shops/SHOP_EverestHotel1708104713.jpg','Kathmandu','Bafal',85.28843304000000,27.69533161000000,'9810154589',1,1),(6,11,'Everest Hotel','public/img/shops/SHOP_EverestHotel1708100279.jpg','Kathmandu','Bafal',85.28843304000000,27.69533161000000,'9810154589',1,1),(7,32,'Newari Khaja Ghar','public/img/shops/SHOP_NewariKhajaGhar1708147988.jpg','Lalitpur','Bafal',85.29109647579321,27.69549827763137,'9810154589',1,1),(8,33,'Thakali Khana ','public/img/shops/SHOP_ThakaliKhana1708228981.jpg','Kathmandu','Bafal',85.28267596000000,27.69432057000000,'9810154589',1,1);
/*!40000 ALTER TABLE `tbl_shops` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_insert_user_role` AFTER INSERT ON `tbl_shops` FOR EACH ROW BEGIN
    -- Call the UpdateUserRole stored procedure with user_id and verification_status parameters
    CALL UpdateUserRole(NEW.user_id, NEW.is_verified);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_update_user_role` AFTER UPDATE ON `tbl_shops` FOR EACH ROW BEGIN
    -- Call the UpdateUserRole stored procedure with user_id and verification_status parameters
    CALL UpdateUserRole(NEW.user_id, NEW.is_verified);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tbl_user_roles`
--

DROP TABLE IF EXISTS `tbl_user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user_roles` (
  `user_role_id` int NOT NULL AUTO_INCREMENT,
  `role_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`user_role_id`),
  UNIQUE KEY `unique_user_roles` (`role_id`,`user_id`),
  KEY `role_id` (`role_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tbl_user_roles_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tbl_roles` (`role_id`),
  CONSTRAINT `tbl_user_roles_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_roles`
--

LOCK TABLES `tbl_user_roles` WRITE;
/*!40000 ALTER TABLE `tbl_user_roles` DISABLE KEYS */;
INSERT INTO `tbl_user_roles` VALUES (1,1,1),(8,1,8),(13,1,13),(18,1,18),(21,2,1),(2,2,2),(5,2,5),(7,2,7),(11,2,11),(20,2,20),(38,2,32),(36,2,33),(29,3,1),(3,3,3),(28,3,5),(6,3,6),(30,3,7),(10,3,10),(14,3,14),(15,3,15),(19,3,19),(31,3,20),(23,3,30),(24,3,31),(32,3,32),(35,3,33),(4,4,4),(9,4,9),(12,4,12),(17,4,17),(16,5,16);
/*!40000 ALTER TABLE `tbl_user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_photo_url` varchar(255) DEFAULT 'public/img/user/default.jpg',
  `password_hash` varchar(256) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `gender` enum('M','F','O') DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_users`
--

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` VALUES (1,'public/img/user/USER_Aashish1708179744.jpg','075f231e1cb73dfb51151a6a4d76c8c29f23b195','Aashish','Maharjan','aashishmaharjan2001@gmail.com','9841234567','M','1990-05-15','2023-12-29 21:49:47',1),(2,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Sneha','Gurung','sneha.gurung@example.com','9812345678','F','1985-08-22','2023-12-29 21:49:47',1),(3,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Rajesh','Pandey','rajesh.pandey@example.com','9856789012','M','1992-02-10','2023-12-29 21:49:47',0),(4,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Anushka','Tamang','anushka.tamang@example.com','9807654321','F','1988-11-05','2023-12-29 21:49:47',1),(5,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Suman','Thapa','suman.thapa@example.com','9845678901','M','1995-04-18','2023-12-29 21:49:47',1),(6,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Shreya','Acharya','shreya.acharya@example.com','9812345678','F','1987-07-27','2023-12-29 21:49:47',1),(7,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Pranav','Rai','pranav.rai@example.com','9856789012','M','1993-09-30','2023-12-29 21:49:47',1),(8,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Ishita','Dahal','ishita.dahal@example.com','9807654321','F','1984-12-12','2023-12-29 21:49:47',1),(9,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Aryan','Lama','aryan.lama@example.com','9845678901','M','1998-06-25','2023-12-29 21:49:47',1),(10,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Reema','Sharma','reema.sharma@example.com','9812345678','F','1986-03-08','2023-12-29 21:49:47',1),(11,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Nabin','Magar','nabin.magar@example.com','9856789012','M','1991-01-20','2023-12-29 21:49:47',1),(12,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Priya','Basnet','priya.basnet@example.com','9807654321','F','1989-10-14','2023-12-29 21:49:47',1),(13,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Roshan','Giri','roshan.giri@example.com','9845678901','M','1996-07-03','2023-12-29 21:49:47',1),(14,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Alisha','Rana','alisha.rana@example.com','9812345678','F','1983-04-28','2023-12-29 21:49:47',1),(15,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Rajat','Koirala','rajat.koirala@example.com','9856789012','M','1994-11-15','2023-12-29 21:49:47',1),(16,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Priyanka','Shakya','priyanka.shakya@example.com','9807654321','F','1982-08-05','2023-12-29 21:49:47',1),(17,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Binod','Bhattarai','binod.bhattarai@example.com','9845678901','M','1997-02-28','2023-12-29 21:49:47',0),(18,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Nisha','Poudel','nisha.poudel@example.com','9812345678','F','1980-09-10','2023-12-29 21:49:47',1),(19,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Ramesh','Limbu','ramesh.limbu@example.com','9856789012','M','1999-04-05','2023-12-29 21:49:47',1),(20,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Shikha','Subedi','shikha.subedi@example.com','9807654321','F','1981-12-18','2023-12-29 21:49:47',1),(23,'public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Alisha ','Pokhrel','alishapokhrel@gmail.com','9813535725','F',NULL,'2024-01-07 22:01:54',1),(26,'public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Subham ','Kadariya','subham@gmail.com','9813535725','M',NULL,'2024-01-26 09:10:26',1),(29,'public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Alisha','Pokhrel','alishapokhrel01@gmail.com','9810154589','F',NULL,'2024-02-15 09:15:31',1),(30,'public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Subham ','Kadariya','subhamkadariya01@gmail.com','9813535725','M',NULL,'2024-02-16 23:20:43',1),(31,'public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Bharat','Khanal','bharatkhanal@gmail.com','9813535725','M',NULL,'2024-02-16 23:29:07',1),(32,'public/img/user/USER_Aaditya1708147591.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Aaditya','Shrestha','aadityashrestha@gmail.com','9813535725','M','2000-01-01','2024-02-17 11:09:03',1),(33,'public/img/user/USER_Anisha1708228680.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Anisha','Maharjan','anishamaharjan@gmail.com','9813535725','F','2024-02-18','2024-02-18 09:31:53',1);
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `view_users`
--

DROP TABLE IF EXISTS `view_users`;
/*!50001 DROP VIEW IF EXISTS `view_users`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `view_users` AS SELECT 
 1 AS `user_role_id`,
 1 AS `role_id`,
 1 AS `user_id`,
 1 AS `role_name`,
 1 AS `user_photo_url`,
 1 AS `password_hash`,
 1 AS `fname`,
 1 AS `lname`,
 1 AS `email`,
 1 AS `contact_no`,
 1 AS `gender`,
 1 AS `dob`,
 1 AS `created_at`,
 1 AS `is_active`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'test_epasal_db'
--

--
-- Dumping routines for database 'test_epasal_db'
--
/*!50003 DROP PROCEDURE IF EXISTS `UpdateUserRole` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateUserRole`(IN p_user_id INT, IN p_verification_status INT)
BEGIN
    -- Check if the user_id exists
    IF EXISTS (SELECT 1 FROM tbl_shops WHERE user_id = p_user_id AND is_verified = p_verification_status) THEN
        -- Check if the verification status is active
        IF p_verification_status = 1 THEN
            -- Insert user role as "Seller"
            INSERT INTO tbl_user_roles (role_id, user_id)
            VALUES (2, p_user_id)
            ON DUPLICATE KEY UPDATE role_id = VALUES(role_id);
        ELSE
            -- Remove user role as "Seller"
            DELETE FROM tbl_user_roles
            WHERE user_id = p_user_id AND role_id = 2;
        END IF;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `see_orders_detail`
--

/*!50001 DROP VIEW IF EXISTS `see_orders_detail`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `see_orders_detail` AS select `o`.`created_at` AS `created_at`,`od`.`order_detail_id` AS `order_detail_id`,`od`.`order_id` AS `order_id`,`p`.`user_id` AS `seller_id`,`u`.`fname` AS `seller_name`,`o`.`user_id` AS `customer_id`,`cus`.`fname` AS `customer_name`,`od`.`product_id` AS `product_id`,`cat`.`category_name` AS `category_name`,`od`.`quantity` AS `quantity`,`p`.`unit_price` AS `unit_price`,(`od`.`quantity` * `p`.`unit_price`) AS `total_amount` from (((((`tbl_order_details` `od` join `tbl_products` `p` on((`p`.`product_id` = `od`.`product_id`))) join `tbl_orders` `o` on((`o`.`order_id` = `od`.`order_id`))) join `tbl_users` `u` on((`u`.`user_id` = `p`.`user_id`))) join `tbl_users` `cus` on((`cus`.`user_id` = `o`.`user_id`))) join `tbl_categories` `cat` on((`cat`.`category_id` = `p`.`category_id`))) order by `o`.`created_at` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_users`
--

/*!50001 DROP VIEW IF EXISTS `view_users`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_users` AS select `ur`.`user_role_id` AS `user_role_id`,`r`.`role_id` AS `role_id`,`u`.`user_id` AS `user_id`,`r`.`role_name` AS `role_name`,`u`.`user_photo_url` AS `user_photo_url`,`u`.`password_hash` AS `password_hash`,`u`.`fname` AS `fname`,`u`.`lname` AS `lname`,`u`.`email` AS `email`,`u`.`contact_no` AS `contact_no`,`u`.`gender` AS `gender`,`u`.`dob` AS `dob`,`u`.`created_at` AS `created_at`,`u`.`is_active` AS `is_active` from ((`tbl_user_roles` `ur` join `tbl_roles` `r` on((`r`.`role_id` = `ur`.`role_id`))) left join `tbl_users` `u` on((`ur`.`user_id` = `u`.`user_id`))) order by `u`.`fname` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-18 13:52:06
